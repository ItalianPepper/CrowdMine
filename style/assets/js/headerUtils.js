/**
 * Created by LongSky on 07/01/2017.
 */
function MessagesUpdate(url) {

    this.call = function() {
        "use strict";
        //console.log("inizio call");
        clearjQueryCache();
        $.ajax({
            url: url+"updateMessIcon",
            dataType: 'json',
            async: true,
            success: function (data) {
                //console.log(data);
                if (data == 0) {
                    $("#mess").hide();
                } else {
                    $("#mess").show();
                    $("#mess").html(data);
                }
            },
            error: function (data) {
                console.log("error");
                console.log(data);
            }
        });
    };

    this.call();
    console.log("inizio poll");
    setInterval(this.call, 5000);

}

function clearjQueryCache() {
    for (var x in jQuery.cache) {
        delete jQuery.cache[x];
    }
}

