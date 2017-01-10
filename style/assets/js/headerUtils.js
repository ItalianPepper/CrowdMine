/**
 * Created by LongSky on 07/01/2017.
 */

function call() {
    "use strict";
    console.log("inizio call");
    clearjQueryCache();
    $.ajax({
        url: "/CrowdMine/updateMessIcon",
        dataType: 'json',
        async: true,
        success: function (data) {
            console.log(data);
            if(data == 0){
                $("#mess").hide();
            }else{
                $("#mess").show();
                $("#mess").html(data);
            }
        },
        error: function (data) {
            console.log ("error");
            console.log (data);
        }
    });
}


$(document).ready(function(){
    console.log("inizio poll");
    setInterval(function(){
        call();
    },5000);
});

function clearjQueryCache() {
    for (var x in jQuery.cache) {
        delete jQuery.cache[x];
    }
}


