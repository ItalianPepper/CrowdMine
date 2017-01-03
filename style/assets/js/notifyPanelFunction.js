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
}).ready();

function generateNotificationsList(data, destination){
    if(data.length > 0){
        for(var i in data){
            var listaNotificheObject = [];
            listaNotificheObject.idNotifica = data[i].idNotify;
            listaNotificheObject.href = data[i].href;
            listaNotificheObject.corpo = data[i].text;
            listaNotificheObject.letto = data[i].read;

            destination.children(':first').before(notificaToRowString(listaNotificheObject));
        };
    }
}

function notificaToRowString(listaNotificheObject){
    return '<li class="list-group-item" style="background-color: #3399FF" id="'+listaNotificheObject.idNotifica+'"><a href="'+listaNotificheObject.href+'">'+listaNotificheObject.corpo+'</a></li>';
}


$("#lista-notifiche").click(function(event){

    var target = $(event.target);

    if(target.is("li")) {

        var idNotifica = target.id;

        $.ajax({
            type: "POST",
            url: "pannelloNotifiche",
            dataType: "json",
            data: {idnotifica:idNotifica},
            success: function () {
                $("#lista-notifiche").find("#"+idNotifca).remove();
            }
        })
    }
});


$("#lista-notifiche-all").click(function(event){

    var target = $(event.target);

    if(target.is("li")) {

        var idNotifica = target.id;

        $.ajax({
            type: "POST",
            url: "pannelloNotifiche",
            dataType: "json",
            data: {idnotifica:idNotifica},
            success: function () {
                $("#lista-notifiche").find("#"+idNotifca).css("background-color","");
            }
        })
    }


});

