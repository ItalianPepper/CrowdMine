var seed = 1;

function random() {
    var x = Math.sin(seed++) * 10000;
    return x - Math.floor(x);
}

function hashcode(str){
    var hash = 0;
    if (str.length == 0) return hash;
    for (i = 0; i < str.length; i++) {
        char = str.charCodeAt(i);
        hash = ((hash<<5)-hash)+char;
        hash = hash & hash; // Convert to 32bit integer
    }
    return hash;
}

/**
 * generate random color based on hash string
 *
 */
function colorByHash(hash, lumCap){

    if(lumCap==null) lumCap=0.82;
    f = 255; //luminance scale factor

    seed = (hashcode(hash)%1000);

    r = random();
    g = random();
    b = random();

    luminance = 0.2126*r + 0.7152*g + 0.0722*b;

    //reducing by same percentage of lumCap (darker colors)
    if(luminance>lumCap)
        f=lumCap*255;

    r=Math.floor(r*f);
    g=Math.floor(r*g);
    b=Math.floor(r*b);

    return "#"+r.toString(16)+g.toString(16)+b.toString(16);
}

/**
 * print a label with random generated background color
 * @param hash seed for random generator
 * @param content text content
 */
function randomColorLabel(hash, content){
    return "<span class='label label-primary' style='background-color:"+colorByHash(hash)+"';>"+content+"</span>";
}
