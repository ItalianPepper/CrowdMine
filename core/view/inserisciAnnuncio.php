<?php
/**
 *
 * @author Vincenzo Russo
 * @version 1.0
 * @since 30/05/16
 */
include_once VIEW_DIR . 'header.php';

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">
    <style>
        .form-control{
            color:#817b7b;
        }
    </style>
    <script type="text/javascript">

        var microCountArray = 0;
        var microListObjectArray =[];
        var microListObject = function (nomeMacro,nomeMicro,idMicro) {
            this.nomeMacro = nomeMacro;
            this.nomeMicro = nomeMicro;
            this.idMicro = idMicro;
        };

        $(document).ready(function () {


            $.ajax(
                {
                    url:"getMacrosForInsertAnnuncio",
                    type: "POST",
                    dataType: "JSON",
                    async: true,
                    success:function (data) {

                        $("#macro").empty();
                        $("#macro").append("<option value='' disabled selected>Seleziona la MacroCategoria</option>");
                        if (data.length > 0) {
                            for (var i in data) {
                                var macro = [];
                                macro.id = data[i].macroId;
                                macro.nome = data[i].macroName;


                                $("#macro").append("<option value='"+macro.id+"'>"+macro.nome+"</option>");

                            }
                        }
                        else
                        {
                            $("#macro").html("<option disabled selected>Nessuna Macrocategoria Disponibile</option>");
                        }
                    }
                }
            )
        });

        function caricaMicro() {
            var idMacro = $("#macro").val();
            $("#micro").prop("disabled", false);
            $.ajax(
                {
                    url: "getMicrosByMacroForInsertAnnuncio",
                    type: "POST",
                    data: {"macroId": idMacro},
                    dataType: "JSON",
                    async: true,
                    success: function (data) {
                        $("#insert-micro-button").prop("disabled", false);
                        $("#micro").empty();
                        $("#micro").append("<option value='' disabled selected>Seleziona la microcategoria</option>");
                        if (data.length > 0) {
                            for (var i in data) {
                                var micro = [];
                                micro.id = data[i].microId;
                                micro.nome = data[i].microName;


                                $("#micro").append("<option value='" + micro.id + "'>" + micro.nome + "</option>");

                            }
                        }
                        else {
                            $("#micro").html("<option disabled selected>Nessuna Macrocategoria Disponibile</option>");
                        }
                    },
                    error: function () {
                        toastr[data["toastType"]](data["toastMessage"]);
                    }

                }
            )
        }

        function insertMicro() {

            var nomeMacro = $("#macro").find('option:selected').text();
            var nomeMicro = $("#micro").find('option:selected').text();
            var idMicro = $("#micro").val();
            var obj = new microListObject(nomeMacro,nomeMicro,idMicro);
            microListObjectArray[microCountArray] = obj;
            var label = <?php randomColorLabel(obj.nomeMacro, $micro->getMicroCategoria()->getNome()) ?>;
            microCountArray++;
            var html = '<div class="row" id='+obj.idMicro+'>'+
                '                                    <div class="col-lg-6 col-md-9 col-xs-12 overlined-row">'+label+
                '                                    </div>'+
                '                                    <div class="dropdown corner-dropdown">'+
                '                                        <button class="btn btn-link"><i class="fa fa-close" onclick="'+deletemicro(obj.idMicro)+'"></i> Elimina</button>'+
                '                                    </div>'+
                '                                </div>';




        }

    </script>
</head>
<body>

<div class="app app-default">
    <?php include_once "asidePannelloBackend.php" ?>


    <div class="col-md-12 col-sm-12 app-container">

        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="row" style="padding: 15px">
                        <div class="card-header" style="padding: 30px;">Inserisci un Annuncio</div>
                        <form action="inserisciAnnuncioControl" method="post" style="padding: 30px">

                            <div class="col-md-6">


                                <div class="form-group">
                                    <input id="form_name" type="text" name="name" class="form-control"
                                           placeholder="Titolo" required="required"
                                    >

                                </div>

                                <div class="form-group">
                                    <input id="form_lastname" type="number" name="surname" class="form-control"
                                           placeholder="Inserisci retribuzione in euro" required="required"
                                           data-error="Lastname is required.">
                                </div>

                                <div class="form-group">
                                    <input id="form_name" type="text" name="name" class="form-control"
                                           placeholder="Luogo" required="required"
                                    >

                                </div>
                                <div class="form-group" style="margin-bottom: 15px">
                                    <div class="selectContainer">
                                        <select  class="form-control" id="macro" onchange="caricaMicro()">
                                            <option value="" disabled selected>Seleziona Una Macrocategoria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 15px" >
                                    <div class="selectContainer">
                                        <select  class="form-control" id="micro" disabled="" title="Seleziona prima la macro">
                                            <option value="" disabled selected>Seleziona Una Microcategoria</option>
                                        </select>
                                    </div>
                                </div>

                                <button id="insert-micro-button" onclick="insertMicro()" type="button" class="btn btn-success" disabled>Inserisci Microcategoria</button>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                                    <textarea id="form_message" name="message" class="form-control"
                                                              placeholder="Inserisci descrizione" rows="4"
                                                              required="required"
                                                              data-error="Please,leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12" id="micro-destination">
                                <div class="row">
                                    <div class="col-lg-6 col-md-9 col-xs-12 overlined-row">
                                        ciao
                                    </div>
                                    <div class="dropdown corner-dropdown">
                                        <button class="btn btn-link"><i class="fa fa-close"></i> Elimina</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackList.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackCheckUtils.js"></script>
<?php

if (isset($_SESSION['toast-type']) && isset($_SESSION['toast-message'])) {
    ?>
    <script>
        toastr["<?php echo $_SESSION['toast-type'] ?>"]("<?php echo $_SESSION['toast-message'] ?>");
    </script>
    <?php
    unset($_SESSION['toast-type']);
    unset($_SESSION['toast-message']);
}
?>

</body>

</html>
