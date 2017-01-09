/**
 * Created by darkv on 22/12/2016.
 */

function poll() {
    setTimeout(function () {
        $.ajax({
            type: "POST",
            url: "pannelloNotifiche",
            dataType: "json",
            success: function (data) {
                generateNotificationsList(data);
                poll();
            }
        });
    }, 1000);
}

$(document).ready(function(){
    poll();
})

function generateNotificationsList(data){
    if (data != null && data.length >0) {

        $("#lista-notifiche").find("#notNotifies").remove();

        for (var i in data) {
            var listaNotificheObject = [];
            listaNotificheObject.idNotifica = data[i].idNotify;
            listaNotificheObject.href = data[i].href;
            listaNotificheObject.corpo = data[i].text;
            listaNotificheObject.letto = data[i].read;

            $("#lista-notifiche").children(':first').before(notificaToRowString(listaNotificheObject));
            $("#notification-count").text(data.length);
        }

    }else{

        if(!($("#notNotifies").length >0 )){
            $("#notification-count").text(0);
            $("#lista-notifiche").append($("<li>").attr("class", "list-group-item").attr("id", "notNotifies").text("Non ci sono notifiche"));
        }
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

