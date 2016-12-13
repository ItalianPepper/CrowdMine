<?php

include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MODEL_DIR . "/Commento.php";



if($_SERVER["REQUEST_METHOD"]=="POST") {

    $idAnnuncio = $_POST['idAnnuncio'];
    $message = $_POST['commento'];
    if (isset($_SESSION["listaCommenti"])) {
        echo "ok!";
        $arrComm = unserialize($_SESSION["listaCommenti"]);
        unset($_SESSION["listaCommenti"]);
    }
}


$arrayCommenti = array();
array_push($arrComm,  new Commento(1,$idAnnuncio,1,$message,"2016-12-12 00:00:00"));
array_push($arrayCommenti, $arrComm);
$_SESSION["listaCommenti"] = serialize($arrayCommenti);
$_SESSION['toast-type'] = "success";
$_SESSION['toast-message'] = "Annuncio Commentato";
for ($i = 0; $i<count($arrComm); $i++) {
    echo $arrComm[$i]->getCorpo();
}
echo count($arrComm);
//header("Location: " . DOMINIO_SITO . "/home");




?>