<?php

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "Utente.php";

$q = $_GET['key'];
$size = strlen($q);
$utenti = getAllUtenti();
$hint = "";
$arr = array();
foreach ($utenti as $u) {
    $nome = $u->getNome();
    $cognome = $u->getCognome();
    if ((strtolower($q) == strtolower(substr($nome, 0, $size))) || (strtolower($q) == strtolower(substr($cognome, 0, $size))) || (strtolower($q) == strtolower(substr($nome." ".$cognome, 0, $size)))){
//        $hint = $hint . "<li><a style='background: white; color: black;' href='".DOMINIO_SITO."/profilo/".$u->getId()."' target='_blank'>".$nome." ".$cognome."</a></li>";
        $arr[] = "<div onclick='inviaDati(".$u->getId().")'><a style='color: black;'><div class='row'><div class='col-md-2'><img width='50px' heigth='50px' src='".$u->getImmagine()."'/></div><div class='col-md-2'></div><div class='col-md-7'>".$nome." ".$cognome."</div></div><span hidden='true'>[".DOMINIO_SITO."/profilo/".$u->getId()."]</span>(".$u->getEmail().")</div></div></a></div>";
    }
}
echo json_encode($arr);
//if ($hint != ""){
//    echo $hint;
//}
//else echo $q;

function getAllUtenti() {
    $GET_ALL_UTENTI = "SELECT * FROM `utente`";
    $query = sprintf($GET_ALL_UTENTI);
    $res = Controller::getDB()->query($query);
    $annunci = array();
    if ($res) {
        while ($obj = $res->fetch_assoc()) {
            $utente = new Utente($obj['nome'], $obj['cognome'], $obj['telefono'], $obj['e-mail'], $obj['citta'], $obj['password'], $obj['descrizione'], $obj['immagine'], $obj['tipologia'], $obj['data'], $obj['id'],$obj['professione']);
            $utenti[] = $utente;
        }
    }
    return $utenti;
}
