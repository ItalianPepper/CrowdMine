<?php
/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 14/12/2016
 * Time: 17:26
 */

include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once MANAGER_DIR . "MicroCategoriaManager.php";
include_once MANAGER_DIR . "MacroCategoriaManager.php";

$MICROS_PER_PAGE = 10; //aka pageSize
$page = 1;  //default page

$microManager = new MicroCategoriaManager();
$macroManager = new MacroCategoriaManager();

//add getMacrosCount to Manager
$numMicros = $microManager->getMicroCount();

$numPages = ceil($numMicros/$MICROS_PER_PAGE);

if (isset($_URL) && isset($_URL[1])) {
    $page = (int)testInput($_URL[1]);

    //page index must be between 1 and numpages
    if($page<1 || $page>$numPages)
        $page = 1;
}

/*start/end boundaries for page*/
$pageStart = ($page-1)*$MICROS_PER_PAGE;
$pageEnd = min($page*$MICROS_PER_PAGE,$numMicros);

/*array of macros per page-1, index here starts by 0 */
$micros = $microManager->getMicrosPage($page-1,$MICROS_PER_PAGE);
$macroList = $macroManager->getAllMacros();

$microPageInfo = "Showing ".$pageStart.
    " to ".$pageEnd.
    " of ".$numMicros." entries";

include_once VIEW_DIR."visualizzaIndexMicrocategorie.php";

?>