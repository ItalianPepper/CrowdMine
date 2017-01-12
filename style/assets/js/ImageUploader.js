/**
 * ImageUploader.js - a client-side image resize and upload javascript module
 * 
 */
 
var ImageUploader = function(config) {

    if (!config || (!config.inputElement) || (!config.inputElement.getAttribute) || config.inputElement.getAttribute('type') !== 'file') {
        throw new Error('Config object passed to ImageUploader constructor must include "inputElement" set to be an element of type="file"');
    }
    this.setConfig(config);

    var This = this;
	
	this.images = [];
	this.xhr = null;
	this.processing = false;
	
	This.progressObject = {
		total : 1,
		done : 0,
		currentItemTotal : 0,
		currentItemDone : 0
	};
	
	var preview = document.getElementById('previewImage');
	var spin = document.getElementById('spin');
	
	This.startProcessing = function(){
		This.processing = true;
		preview.style.opacity = 0.5;
		spin.style.display="block";

        if (This.config.onStart) {
            This.config.onStart();
        }
	};
	
	This.endProcessing = function(){
		This.processing = false;
		preview.style.opacity = 1;
		spin.style.display="none";
        if (This.config.onProcessingEnd) {
            This.config.onProcessingEnd();
        }
	};
	
    this.config.inputElement.addEventListener('change', function(event) {
        var fileArray = [];
        var cursor = 0;
		This.images = [];
		
		This.startProcessing();
		
		setTimeout(function(){
			
			for (; cursor < This.config.inputElement.files.length; ++cursor) {
				fileArray.push(This.config.inputElement.files[cursor]);
			}
			This.progressObject = {
				total : parseInt(fileArray.length, 10),
				done : 0,
				currentItemTotal : 0,
				currentItemDone : 0
			};
			if (This.config.onProgress) {
				This.config.onProgress(This.progressObject);
			}
			This.handleFileList(fileArray);
		},500);
		
    }, false);

    if (This.config.debug) {
        console.log('Initialised ImageUploader for ' + This.config.inputElement);
    }

};

ImageUploader.prototype.handleFileList = function(fileArray) {
    var This = this;
    if (fileArray.length > 1) {
        var file = fileArray.shift();
        this.handleFileSelection(file, function() {
            This.handleFileList(fileArray);
        });
    } else if (fileArray.length === 1) {
        this.handleFileSelection(fileArray[0],function(){This.endProcessing()});
    }
};



ImageUploader.prototype.getExifOrientation = function(file, callback) {
    var reader = new FileReader();
    reader.onload = function(e) {

        var view = new DataView(e.target.result);
        if (view.getUint16(0, false) != 0xFFD8) return callback(-2,e.target.result);
        var length = view.byteLength, offset = 2;
        while (offset < length) {
            var marker = view.getUint16(offset, false);
            offset += 2;
            if (marker == 0xFFE1) {
                if (view.getUint32(offset += 2, false) != 0x45786966) return callback(-1,e.target.result);
                var little = view.getUint16(offset += 6, false) == 0x4949;
                offset += view.getUint32(offset + 4, little);
                var tags = view.getUint16(offset, little);
                offset += 2;
                for (var i = 0; i < tags; i++)
                    if (view.getUint16(offset + (i * 12), little) == 0x0112)
                        return callback(view.getUint16(offset + (i * 12) + 8, little));
            }
            else if ((marker & 0xFF00) != 0xFF00) break;
            else offset += view.getUint16(offset, false);
        }
        return callback(-1,e.target.result);
    };
    reader.readAsArrayBuffer(file.slice(0, 64 * 1024));
}

ImageUploader.prototype.handleFileSelection = function(file, completionCallback) {
	
    var img = document.createElement('img');
    this.currentFile = file;
    var This = this;
	
	this.getExifOrientation(file,function(rot,src){
		var reader = new FileReader();
		reader.onload = function(e) {
			img.src = e.target.result;
			setTimeout(function() {
				This.scaleImage(img,rot, completionCallback);
			}, 1);

		};
		reader.readAsDataURL(file);
	});
	
};

ImageUploader.prototype.scaleImage = function(img,rot, completionCallback) {
	
	var orientation = rot;
    var canvas = document.createElement('canvas');
	var minsize = Math.min(img.width,img.height);

	var x = (img.width - minsize) / 2;
	if(orientation<2) x = 0;
	
    canvas.width = minsize;
    canvas.height = minsize;
	
	var ctx = canvas.getContext('2d');

	ctx.translate(minsize/2, minsize/2);
	
    switch (orientation) {
        case 2:
        // horizontal flip
        ctx.scale(-1, 1);
        break;
      case 3:
        // 180° rotate left
        ctx.rotate(Math.PI);
        break;
      case 4:
        // vertical flip
        ctx.scale(1, -1);
        break;
        case 5:
        // vertical flip + 90 rotate right
        ctx.rotate(0.5 * Math.PI);
        ctx.scale(1, -1);
        break;
        case 6:
        // 90° rotate right
        ctx.rotate(0.5 * Math.PI);
        break;
      case 7:
        // horizontal flip + 90 rotate right
        ctx.rotate(0.5 * Math.PI);
        ctx.scale(-1, 1);
        break;
      case 8:
        // 90° rotate left
        ctx.rotate(-0.5 * Math.PI);
        break;
    }
	
	ctx.translate(-img.width/2, -img.height/2);
	
    ctx.drawImage(img, 0,0, img.width, img.height);

    while (canvas.width >= (2 * this.config.maxWidth)) {
        canvas = this.getHalfScaleCanvas(canvas);
    }

    if (canvas.width > this.config.maxWidth) {
        canvas = this.scaleCanvasWithAlgorithm(canvas);
    }
	
    var imageData = canvas.toDataURL('image/jpeg', this.config.quality);
	var blobBin = atob(imageData.split(',')[1]);
	var array = [];
	for(var i = 0; i < blobBin.length; i++) {
	  array.push(blobBin.charCodeAt(i));
	}
	blob = new Blob([new Uint8Array(array)], {type: 'image/jpeg', name: "fileName.jpeg"});
	
	var file = blob;
	file.lastModifiedDate = new Date();
    file.name = "fileName.jpeg";
	
	document.getElementById('previewImage').src = imageData;
	this.images.push(file);
	
	if(completionCallback){
		completionCallback();
    }
};

ImageUploader.prototype.abortUpload = function(){
	if(this.xhr){
		this.xhr.abort();
		this.xhr = null;
	}
}

ImageUploader.prototype.tryUpload = function(fd) {
	
	var This = this;
	
	var handle = setInterval(function(){
		
		if(!This.processing){
			This.abortUpload();
			This.performUpload(fd);
			console.log("upload");
			clearInterval(handle);
		}
	}, 10);
	
	setTimeout(function(){
		if(handle){
			clearInterval(handle);
		}
	},10000);
}

ImageUploader.prototype.performUpload = function(fd) {
	
    var xhr = new XMLHttpRequest();
	this.xhr = xhr;
	
    var This = this;
    var uploadInProgress = true;
    var headers = this.config.requestHeaders;
	
    xhr.onload = function(e) {
        uploadInProgress = false;
        This.uploadComplete(e,xhr);
    };
    xhr.upload.addEventListener("progress", function(e) {
        This.progressUpdate(e.loaded, e.total);
    }, false);
    xhr.open('POST', this.config.uploadUrl, true);
    
    if(typeof headers === 'object' && headers !== null) {
        Object.keys(headers).forEach(function(key,index) {
            if(typeof headers[key] !== 'string') {
                var headersArray = headers[key];
                for(var i = 0, j = headersArray.length; i < j; i++) {
                    xhr.setRequestHeader(key, headersArray[i]);
                }   
            } else {
                xhr.setRequestHeader(key, headers[key]);                
            }
        });
    }
	
	if(This.images.length>0){
		fd.append("image", This.images[0]);
	}
    
    xhr.send(fd);

    if (this.config.timeout) {
        setTimeout(function() {
            if (uploadInProgress) {
                xhr.abort();
                This.uploadComplete({
                    target: {
                        status: 'Timed out' 
                    }
                },xhr);
            }
        }, this.config.timeout);
    }
    
    if (this.config.debug) {
        var resizedImage = document.createElement('img');
        this.config.workspace.appendChild(document.createElement('br'));
        this.config.workspace.appendChild(resizedImage);

        //resizedImage.src = imageData;
    }
};

ImageUploader.prototype.uploadComplete = function(event, xhr) {
    this.progressUpdate(1, 1);
	if (this.config.onComplete) {
        this.config.onComplete(event, xhr);
    }
};

ImageUploader.prototype.progressUpdate = function(itemDone, itemTotal) {
    console.log('Uploaded '+itemDone+' of '+itemTotal);
    this.progressObject.currentItemDone = itemDone;
    this.progressObject.currentItemTotal = itemTotal;
    if (this.config.onProgress) {
        this.config.onProgress(this.progressObject);
    }
};

ImageUploader.prototype.scaleCanvasWithAlgorithm = function(canvas) {
    var scaledCanvas = document.createElement('canvas');

    var scale = this.config.maxWidth / canvas.width;

    scaledCanvas.width = canvas.width * scale;
    scaledCanvas.height = canvas.height * scale;

    var srcImgData = canvas.getContext('2d').getImageData(0, 0, canvas.width, canvas.height);
    var destImgData = scaledCanvas.getContext('2d').createImageData(scaledCanvas.width, scaledCanvas.height);

    this.applyBilinearInterpolation(srcImgData, destImgData, scale);

    scaledCanvas.getContext('2d').putImageData(destImgData, 0, 0);

    return scaledCanvas;
};

ImageUploader.prototype.getHalfScaleCanvas = function(canvas) {
    var halfCanvas = document.createElement('canvas');
    halfCanvas.width = canvas.width / 2;
    halfCanvas.height = canvas.height / 2;

    halfCanvas.getContext('2d').drawImage(canvas, 0, 0, halfCanvas.width, halfCanvas.height);

    return halfCanvas;
};

ImageUploader.prototype.applyBilinearInterpolation = function(srcCanvasData, destCanvasData, scale) {
    function inner(f00, f10, f01, f11, x, y) {
        var un_x = 1.0 - x;
        var un_y = 1.0 - y;
        return (f00 * un_x * un_y + f10 * x * un_y + f01 * un_x * y + f11 * x * y);
    }
    var i, j;
    var iyv, iy0, iy1, ixv, ix0, ix1;
    var idxD, idxS00, idxS10, idxS01, idxS11;
    var dx, dy;
    var r, g, b, a;
    for (i = 0; i < destCanvasData.height; ++i) {
        iyv = i / scale;
        iy0 = Math.floor(iyv);
        // Math.ceil can go over bounds
        iy1 = (Math.ceil(iyv) > (srcCanvasData.height - 1) ? (srcCanvasData.height - 1) : Math.ceil(iyv));
        for (j = 0; j < destCanvasData.width; ++j) {
            ixv = j / scale;
            ix0 = Math.floor(ixv);
            // Math.ceil can go over bounds
            ix1 = (Math.ceil(ixv) > (srcCanvasData.width - 1) ? (srcCanvasData.width - 1) : Math.ceil(ixv));
            idxD = (j + destCanvasData.width * i) * 4;
            // matrix to vector indices
            idxS00 = (ix0 + srcCanvasData.width * iy0) * 4;
            idxS10 = (ix1 + srcCanvasData.width * iy0) * 4;
            idxS01 = (ix0 + srcCanvasData.width * iy1) * 4;
            idxS11 = (ix1 + srcCanvasData.width * iy1) * 4;
            // overall coordinates to unit square
            dx = ixv - ix0;
            dy = iyv - iy0;
            // I let the r, g, b, a on purpose for debugging
            r = inner(srcCanvasData.data[idxS00], srcCanvasData.data[idxS10], srcCanvasData.data[idxS01], srcCanvasData.data[idxS11], dx, dy);
            destCanvasData.data[idxD] = r;

            g = inner(srcCanvasData.data[idxS00 + 1], srcCanvasData.data[idxS10 + 1], srcCanvasData.data[idxS01 + 1], srcCanvasData.data[idxS11 + 1], dx, dy);
            destCanvasData.data[idxD + 1] = g;

            b = inner(srcCanvasData.data[idxS00 + 2], srcCanvasData.data[idxS10 + 2], srcCanvasData.data[idxS01 + 2], srcCanvasData.data[idxS11 + 2], dx, dy);
            destCanvasData.data[idxD + 2] = b;

            a = inner(srcCanvasData.data[idxS00 + 3], srcCanvasData.data[idxS10 + 3], srcCanvasData.data[idxS01 + 3], srcCanvasData.data[idxS11 + 3], dx, dy);
            destCanvasData.data[idxD + 3] = a;
        }
    }
};

ImageUploader.prototype.setConfig = function(customConfig) {
    this.config = customConfig;
    this.config.debug = this.config.debug || false;
    this.config.quality = 1.00;
    if (0.00 < customConfig.quality && customConfig.quality <= 1.00) {
        this.config.quality = customConfig.quality;
    }
    if (!this.config.maxWidth) {
        this.config.maxWidth = 1024;
    }

    // Create container if none set
    if (!this.config.workspace) {
        this.config.workspace = document.createElement('div');
        document.body.appendChild(this.config.workspace);
    }
};