<?php
/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 14/12/2016
 * Time: 17:26
 */

include_once MODEL_DIR.'MacroCategoria.php';
include_once MODEL_DIR.'MicroCategoria.php';

include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once MANAGER_DIR . "UtenteManager.php";


$utenteManager = new UtenteManager();

include_once VIEW_DIR . "visitaProfiloPersonale.php";

?>