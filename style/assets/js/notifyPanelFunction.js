/**
 * Created by darkv on 22/12/2016.
 */

function NotifyPanel(url) {

    var This = this;

    this.panelRetrieve = function () {

        $.ajax({
            type: "POST",
            url: url+"pannelloNotifiche",
            dataType: "json",
            success: function (data) {
                console.log(data);
                This.generateNotificationsList(data);
            }
        });
    };

    this.poll = function() {
        //call every 15 seconds
        setInterval(This.panelRetrieve, 15000);
    };

    this.generateNotificationsList = function(data) {
        if (data != null && data.length > 0) {

            $("#lista-notifiche").find("#notNotifies").remove();

            for (var i in data) {
                var listaNotificheObject = [];
                var idNotify = data[i].idNotify;
                if (!($("#" + idNotify).length > 0)) {
                    listaNotificheObject.idNotifica = data[i].idNotify;
                    listaNotificheObject.href = data[i].href;
                    listaNotificheObject.corpo = data[i].text;
                    listaNotificheObject.letto = data[i].read;

                    $("#lista-notifiche").append(This.notificaToRowString(listaNotificheObject));
                    $("#notification-count").text(data.length);
                    $("#notification-count").show();
                }
            }

        } else {

            if (!($("#notNotifies").length > 0 )) {
                $("#notification-count").hide();
                $("#lista-notifiche").append(This.notificaToRowString({idNotifica:"notNotifies",href:'#',corpo:"Non ci sono notifiche"}));
            }else{
                $("#notification-count").show();
            }
        }
    };

    this.notificaToRowString = function(listaNotificheObject) {
        return '<li id="' + listaNotificheObject.idNotifica + '">' +
            '<a href="' + listaNotificheObject.href +
            '"><div class="message"><div class="content"><div class="title">' +
            listaNotificheObject.corpo + '</div></div></div></a></li>';
    };

     $("#lista-notifiche").click(function (event) {

        var target = $(event.target);

        if (target.is("li")) {

            var idNotifica = target.id;

            $.ajax({
                type: "POST",
                url: url+"pannelloNotifiche",
                dataType: "json",
                data: {idnotifica: idNotifica},
                success: function () {
                    $("#lista-notifiche").find("#" + idNotifca).remove();
                }
            })
        }
    });


    $("#lista-notifiche-all").click(function (event) {

        var target = $(event.target);

        if (target.is("li")) {

            var idNotifica = target.id;

            $.ajax({
                type: "POST",
                url: url+"pannelloNotifiche",
                dataType: "json",
                data: {idnotifica: idNotifica},
                success: function () {
                    $("#lista-notifiche").find("#" + idNotifca).css("background-color", "");
                }
            })
        }


    });

    //first call
    this.panelRetrieve();
    //start polling after 15 seconds
    this.poll();
}
