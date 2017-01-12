/**
 * Created by LongSky on 12/01/2017.
 */


function call() {
    "use strict";
    console.log("inizio call");
    clearjQueryCache();
    $.ajax({
        url: "/CrowdMine/updateChat",
        dataType: 'text',
        async: true,
        success: function (data) {
            console.log("__"+data+"__");
            if(data!="") {
                $('#messaggi_inviati').empty()
                $('#messaggi_inviati').append(data);
                $('#messaggi_inviati').animate({scrollTop: $('#messaggi_inviati').prop("scrollHeight")}, 0);
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
    },3000);
});

function clearjQueryCache() {
    for (var x in jQuery.cache) {
        delete jQuery.cache[x];
    }
}
