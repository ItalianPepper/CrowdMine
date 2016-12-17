<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 16/12/2016
 * Time: 01:18
 */

//include_once MODEL_DIR . 'MicroCategoria.php';
//include_once MANAGER_DIR . 'UtenteManager.php';
//include_once MANAGER_DIR  .  'MacroCategoriaManager.php';
include_once MODEL_DIR  . 'MicroListObject.php';

//$user = unserialize($_SESSION["user"]);

//$utenteManager = new UtenteManager();
//$microListUtente = $utenteManager->getMicroUtente($user);
//$microManager = new MicrocategoriaManager();
//$macroManager = new MacroCategoriaManager();


$microListUtente = array();
$microList = array();
for ($i=0; $i<5; $i++){
    $microUtente = new MicroCategoria("IdMacroUtente", "nomeMicroUtente", "IdMicroUtente");
    array_push($microListUtente, $microUtente);
}

for ($i=0; $i<5; $i++){
    $micro = new MicroCategoria("idMacro", "nomeMicro", "idMicro");
    array_push($microList, $micro);
}

//$microList = $microManager->findAll();
//$microListUtente = $microManager->findMicrocategoriaByUser($user);

$microListObjectUtente = array();
foreach ($microListUtente as $micro){
    //$macro = $macroManager->getMacroById($micro->getIdMacrocategoria());
    array_push($microListObjectUtente, new MicroListObject($micro, new MacroCategoria("idMacro", "macroNameByManager")));
}

$microListObject = array();
foreach ($microList as $micro){
    //$macro = $macroManager->getMacroById($micro->getIdMacrocategoria());
    array_push($microListObject, new MicroListObject($micro, new MacroCategoria("idMacro", "macroNameByManager")));
}


$_SESSION['micro'] = serialize($microListObject);
$_SESSION['microUtente'] = serialize($microListObjectUtente);

//header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");