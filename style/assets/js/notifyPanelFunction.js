/**
 * Created by darkv on 22/12/2016.
 */

$(function poll(){
    setTimeout(function(){
        $.ajax({
            type: "POST",
            url: "pannelloNotifiche",
            dataType: "json",
            success: function(data){
                var listaNotifiche = document.getElementById('lista-notifiche');
                generateNotificationsList(data, listaNotifiche);
                poll();
            }
        });
    }, 30000);
}).onLoad();

function generateNotificationsList(data, destination){
    if(data.length > 0){
        $.each(data, function (key, value) {
            var listaNotificheObject = [];
            listaNotificheObject.href = key;
            listaNotificheObject.corpo = value;

            destination.children(':first').before(notificaToRowString(listaNotificheObject));
        });
    }
}

function notificaToRowString(listaNotificheObject){
    return '<li><a href="'+listaNotificheObject.href+'">'+listaNotificheObject.corpo+'</a></li>';
}