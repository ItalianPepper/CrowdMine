<?php
/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 14/12/2016
 * Time: 17:26
 */

include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once MANAGER_DIR . "MacroCategoriaManager.php";

$MACROS_PER_PAGE = 10; //aka pageSize
$page = 1;  //default page

$macroManager = new MacroCategoriaManager();

//add getMacrosCount to Manager
$numMacros = $macroManager->getMacroCount();

$numPages = ceil($numMacros/$MACROS_PER_PAGE);

if (isset($_URL) && isset($_URL[1])) {
    $page = (int)testInput($_URL[1]);

    if($page<1 || $page>$numPages)
        $page = 1;
}


$pageStart = ($page-1)*$MACROS_PER_PAGE;
$pageEnd = min($page*$MACROS_PER_PAGE,$numMacros);

/*
 * add getMacros(page,pageSize) by page Method to Manager
 *  pseudo.
 *      SELECT * FROM macro BETWEEN pageStart AND pageEnd
*/
//$macros = Array(new MacroCategoria(1,"Informatica"),new MacroCategoria(2,"Graphic Design"));
$macros = $macroManager->getMacrosPage($page-1,$MACROS_PER_PAGE);


$macroPageInfo = "Showing ".$pageStart.
    " to ".$pageEnd.
    " of ".$numMacros." entries";

//include is more coherent if interaction begins in this control
include_once VIEW_DIR."visualizzaIndexMacrocategorie.php";

?>