<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 02/12/16
 * Time: 11:21
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["option"])) {

        if ($_POST["option"] == "selectMicro2") {
            $result = stubMicroCategorie2();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

        if ($_POST["option"] == "selectMicro3") {
            $result = stubMicroCategorie3();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

        if ($_POST["option"] == "selectMacro") {
            //$macroCategoriaManager = new AnnuncioManager();

            // $result = $macroCategoriaManager->getListMacroCategorie();

            $result = stubMacroCategorie();

            header("Content-Type: application/json");
            echo json_encode($result);

        } else if ($_POST["option"] == "selectMicro") {
            //$macroCategoriaManager = new AnnuncioManager();

            // $result = $macroCategoriaManager->getListMacroCategorie();

            $result = stubMicroCategorie();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

    }

}

function arrayUtenti(){
    $arrayUtentiFunc = array ( array("Nome" => "Giuseppe", "FeedBack" => "84", "MicroCategoria" => "PHP", "MacroCategoria" => "Informatica"),
        array("Nome" => "Giorgio", "FeedBack" => "48", "MicroCategoria" => "PHP", "MacroCategoria" => "Informatica"),
        array("Nome" => "Gigi", "FeedBack" => "8", "MicroCategoria" => "JAVA", "MacroCategoria" => "Informatica"),
    );
    return $arrayUtentiFunc;
}

function stubMacroCategorie()
{
    $arrayTest = array("Informatica", "Ristorazione", "Bancario");
    return $arrayTest;
}

function stubMicroCategorie()
{
    $microsName = array("PHP", "C", "JAVA", "C++");
    return $microsName;
}

function stubMicroCategorie2()
{
    $microsName = array("Cameriere", "Caposala", "Cuoco");
    return $microsName;
}

function stubMicroCategorie3()
{
    $microsName = array("Direttore", "Dipendente");
    return $microsName;
}

/*
     $("#mostraRisultati").click(function () {

     var macro = $("#selectMacro").val();
     var micro = $("#selectMicro").val();
     var dataRicerca = {};

     if (micro != null) {

     dataRicerca = {
     selectMacro: macro, selectMicro: micro
     }
     } else {
     dataRicerca = {
     selectMacro: macro, selectMicro: 0
     }
     }

     $.ajax({
     type: "POST",
     url: "classificaUtenti",
     dataType: "json",
     data: dataRicerca,
     success: function (response) {
     var arrayUtenti = $.map(response, function (el) {
     return el;
     });
     updatePage(arrayUtenti);
     }
     });
     });


     function updatePage(arrayUtenti) {
     $("#tabellaRisultati tbody tr").remove();
     $.each(arrayUtenti, function (i, el) {
     $("#tabellaRisultati").find("tbody")
     .append($("<tr>")
     .append($("<th></th>").attr("scope", "row").text(i + 1))
     .append($("<td>").text(el))
     );
     });
     }*/