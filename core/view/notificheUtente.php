<!DOCTYPE html>
<html>
<head>
    <title>Crowdmine | Notifiche</title>
    <?php include_once VIEW_DIR."headerStart.php";?>
    <style>
        .row {
            height: 100%;
        }
    </style>
</head>
<body>
<div class="app app-default">
    <div class="app-container no-sidebar">
        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">Notifiche</div>
                    <div class="card">
                        <div class="card-body">
                            <div id="lista-notifiche-all" >

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once VIEW_DIR."footerStart.php";?>

<script>
    $(document).ready(function () {

        panelRetrieve = function () {
            $.ajax({
                type: "POST",
                url:"<?php echo DOMINIO_SITO;?>/pannelloNotificheUtente",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    generateNotificationsList(data);
                }
            });
        };

        poll = function() {
            //call every 15 seconds
            setInterval(panelRetrieve, 15000);
        };

        generateNotificationsList = function(data) {
            if (data != null && data.length > 0) {

                $("#lista-notifiche-all").find("#notNotifies").remove();

                for (var i in data) {
                    var listaNotificheObject = [];
                    var idNotify = data[i].idNotify;
                    if (!($("#" + idNotify).length > 0)) {
                        listaNotificheObject.idNotifica = data[i].idNotify;
                        listaNotificheObject.href = data[i].href;
                        listaNotificheObject.corpo = data[i].text;
                        listaNotificheObject.letto = data[i].read;
                        listaNotificheObject.classe = (i==0)?"simple-row":"overlined-row";

                        $("#lista-notifiche-all").append(notificaToRowString(listaNotificheObject));
                    }
                }

            }else {

                if (!($("#notNotifies").length > 0 )) {
                    $("#lista-notifiche-all").append(notificaToRowString({
                        idNotifica: "notNotifies",
                        href: '#',
                        corpo: "Non ci sono notifiche",
                        classe: "simple-row"
                    }));
                }
            }
        };

        notificaToRowString = function(listaNotificheObject) {
            return '<div class="row" id="' + listaNotificheObject.idNotifica + '"><div class="col-lg-12 '+listaNotificheObject.classe+'">' +
                '<a href="' + listaNotificheObject.href +
                '"><div class="message"><div class="content"><div class="title">' +
                listaNotificheObject.corpo + '</div></div></div></a></div></div>';
        };

        //first call
        panelRetrieve();
        //start polling after 15 seconds
        poll();
    });
</script>

<?php include_once VIEW_DIR."footerEnd.php";?>

</body>
</html>