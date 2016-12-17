<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 14/12/2016
 * Time: 18:23
 */

include_once MODEL_DIR . 'MicroCategoria.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once MANAGER_DIR  .  'MacroCategoriaManager.php';

//$user = unserialize($_SESSION["user"]);

$utenteManager = new UtenteManager();
//$macroListUtente = $utenteManager->getMacroUtente($user);
$macroManager = new MacroCategoriaManager();


$macroListUtente = array();
$macroList = array();
for ($i=0; $i<5; $i++){
    $macroUtente = new MacroCategoria("idMacroUtente", "nomeMacroUtente");
    array_push($macroListUtente, $macroUtente);
}

for ($i=0; $i<5; $i++){
    $macro = new MacroCategoria("idMacro", "nomeMacro1");
    array_push($macroList, $macro);
}

$_SESSION['macro'] = serialize($macroList);
$_SESSION['macroUtente'] = serialize($macroListUtente);

//header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");