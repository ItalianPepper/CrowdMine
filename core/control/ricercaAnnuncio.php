<?php

include_once MANAGER_DIR . 'MacroCategoriaManager.php';

$macroManager = new MacroCategoriaManager();
$macro = array();
$macro = $macroManager->getListaMacrocategorie();
$_SESSION['macro'] = serialize($macro);




include_once VIEW_DIR . "ricercaAnnuncio.php";

?>

