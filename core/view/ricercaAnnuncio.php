<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <?php include_once VIEW_DIR."headerStart.php";?>
    <style>
        .form-control {
            color: #817b7b;
        }
    </style>
</head>

<body>

<div class="app app-default">

    <?php include_once VIEW_DIR."headerSideBar.php";?>
    <div class="app-container">

        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>

        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="row" style="padding: 15px">
                        <div class="card-header" style="padding: 30px;">Ricerca un Annuncio</div>
                        <form action="ricercaAnnuncioControl" method="post" style="padding: 30px">

                            <div class="col-md-6">


                                <div class="form-group">
                                    <input id="form_name" type="text" name="titolo" class="form-control"
                                           placeholder="Titolo"
                                    >

                                </div>

                                <div class="form-group">
                                    <input id="form_name" type="date" name="data" class="form-control"
                                           placeholder="Utente"
                                    >
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control select2" name="luogo" id="listacitta"  required>

                                        </select>
                                        <div class="input-group-addon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 15px">
                                    <div class="selectContainer">
                                        <select class="form-control" id="macro" name="macro" onchange="caricaMicro()">
                                            <option value="" disabled selected>Seleziona Una Macrocategoria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 15px">
                                    <div class="selectContainer">
                                        <select class="form-control" id="micro" name="micro" disabled=""
                                                onchange="checkIfIsSelectedMicro()"
                                                title="Seleziona prima la macro">
                                            <option value="" disabled selected>Seleziona Una Microcategoria</option>
                                        </select>
                                    </div>
                                </div>

                                <button id="insert-micro-button" onclick="insertMicro()" type="button" style="margin-bottom: 10px"
                                        class="btn btn-success" disabled>Inserisci Microcategoria
                                </button>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="form_name" type="text" name="utente" class="form-control"
                                           placeholder="Utente"
                                    >

                                </div>
                                <div>
                                    <div class="radio radio-inline">
                                        <input type="radio" name="tipologia" id="radio5" value="Domanda" checked>
                                        <label for="radio5">
                                            Domanda
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" name="tipologia" id="radio6" value="Offerta" >
                                        <label for="radio6">
                                            Offerta
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="lista-Micro" value="" id="listaMicroJson">
                                <button type="reset" class="btn btn-danger btn-md">Cancella</button>
                                <button type="submit" class="btn btn-primary btn-md">Ricerca Annuncio</button>

                            </div>

                            <div class="col-lg-12 col-md-12 col-xs-12" id="micro-destination">

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
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\styleUtils.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>/scripts/caricacitta.js"></script>


<script type="text/javascript">

    var microCountArray = 0;
    var microListObjectArray = [];
    var microListObject = function (nomeMacro, nomeMicro, idMicro) {
        this.nomeMacro = nomeMacro;
        this.nomeMicro = nomeMicro;
        this.idMicro = idMicro;
    };

    $(document).ready(function () {


        $.ajax(
            {
                url: "<?php echo DOMINIO_SITO;?>/getMacrosForInsertAnnuncio",
                type: "POST",
                dataType: "JSON",
                async: true,
                success: function (data) {

                    $("#macro").empty();
                    $("#macro").append("<option value='' disabled selected>Seleziona la MacroCategoria</option>");
                    if (data.length > 0) {
                        for (var i in data) {
                            var macro = [];
                            macro.id = data[i].macroId;
                            macro.nome = data[i].macroName;


                            $("#macro").append("<option value='" + macro.id + "'>" + macro.nome + "</option>");

                        }
                    }
                    else {
                        $("#macro").html("<option disabled selected>Nessuna Macrocategoria Disponibile</option>");
                    }
                }
            }
        )
    });
    function checkIfIsSelectedMicro() {
        if ($("#micro").find('option:selected').text() !== "Seleziona la microcategoria") {
            $("#insert-micro-button").prop("disabled", false);
        }
    }
    function caricaMicro() {
        var idMacro = $("#macro").val();
        $("#micro").prop("disabled", false);
        $.ajax(
            {
                url: "<?php echo DOMINIO_SITO;?>/getMicrosByMacroForInsertAnnuncio",
                type: "POST",
                data: {"macroId": idMacro},
                dataType: "JSON",
                async: true,
                success: function (data) {

                    $("#micro").empty();
                    $("#micro").append("<option value='' disabled selected>Seleziona la microcategoria</option>");
                    if (data.length > 0) {
                        for (var i in data) {
                            var micro = [];
                            micro.id = data[i].microId;
                            micro.nome = data[i].microName;


                            $("#micro").append("<option value='" + micro.id + "'>" + micro.nome + "</option>");

                        }

                        if ($("#micro").find('option:selected').text() == "Seleziona la microcategoria") {
                            $("#insert-micro-button").prop("disabled", true);
                        }
                    }
                    else {
                        $("#micro").html("<option disabled selected>Nessuna Macrocategoria Disponibile</option>");
                        $("#insert-micro-button").prop("disabled", true);
                    }
                },
                error: function () {
                    toastr[data["toastType"]](data["toastMessage"]);
                }

            }
        )
    }
    function deleteMicro(idMicro) {

        for (var i = 0; i < microListObjectArray.length; i++) {
            if (microListObjectArray[i].idMicro == idMicro) {
                microListObjectArray.splice(i, 1);
                $("#" + idMicro + "-micro").fadeOut();
                microCountArray--;
            }
        }
        $("#listaMicroJson").val(JSON.stringify(microListObjectArray));
        console.log(microListObjectArray);
    }

    function insertMicro() {

        var nomeMacro = $("#macro").find('option:selected').text();
        var nomeMicro = $("#micro").find('option:selected').text();
        var idMicro = $("#micro").val();
        var obj = new microListObject(nomeMacro, nomeMicro, idMicro);
        var duplicate = false;
        for (var i = 0; i < microListObjectArray.length; i++) {
            if (microListObjectArray[i].idMicro == idMicro) {
                toastr.error("Microcategoria gia inserita");
                duplicate = true;
                break;
            }
        }
        if (!duplicate) {
            microListObjectArray[microCountArray] = obj;
            var label = randomColorLabel(obj.nomeMacro, obj.nomeMicro);
            console.log(label);

            microCountArray++;
            var html = "<div class='row' id='" + obj.idMicro + "-micro'>" +
                "                                    <div class='col-lg-6 col-md-9 col-xs-12 overlined-row'>'" + label +
                "                                   <div class='dropdown corner-dropdown'>" +
                "                                       <i class='fa fa-close' onclick='deleteMicro(" + obj.idMicro + ")'></i>" +
                "                                 </div>" +
                "                                </div>" +
                "                                  </div>";

            $("#micro-destination").append(html);
        }

        $("#listaMicroJson").val(JSON.stringify(microListObjectArray));


    }


</script>

<script>
    $("#ricercaAnnuncio").toggleClass("active");
    $('[data-toggle="tooltip"]').tooltip();
</script>

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
