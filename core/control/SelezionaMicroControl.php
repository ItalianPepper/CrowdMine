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

//START STUB
for ($i=0; $i<5; $i++){
    $microUtente = new MicroCategoria("idMacro".$i, "nomeMicro".$i, "idMicro".$i);
    array_push($microListUtente, $microUtente);
}

for ($i=0; $i<10; $i++){
    $micro = new MicroCategoria("idMacro".$i, "nomeMicro".$i, "idMicro".$i);
    array_push($microList, $micro);
}
//END STUB

//$microList = $microManager->findAll();
//$microListUtente = $microManager->findMicrocategoriaByUser($user);

$microListObjectUtente = array();
$i=0;
foreach ($microListUtente as $micro){
    //$macro = $macroManager->getMacroById($micro->getIdMacrocategoria()); ***usare $macro come input di MacroCategoria***
    array_push($microListObjectUtente, new MicroListObject($micro, new MacroCategoria("idMacro".$i, "nomeMacro".$i)));
    $i++;
}

$microListObject = array();
$i=0;
foreach ($microList as $micro){
    //$macro = $macroManager->getMacroById($micro->getIdMacrocategoria());
    array_push($microListObject, new MicroListObject($micro, new MacroCategoria("idMacro".$i, "nomeMacro".$i)));
    $i++;
}


$_SESSION['micro'] = serialize($microListObject);
$_SESSION['microUtente'] = serialize($microListObjectUtente);

//header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");