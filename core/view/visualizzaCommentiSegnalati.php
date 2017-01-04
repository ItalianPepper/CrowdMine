<?php
/**
 *
 */
include_once MODEL_DIR . "/Commento.php";
include_once MODEL_DIR . "/Annuncio.php";
include_once VIEW_DIR . 'header.php';
include_once CONTROL_DIR . "/commentiSegnalati.php";

$searched = array();
if (isset($_SESSION["commentiSegnalati"])){
    $searched = unserialize($_SESSION["commentiSegnalati"]);
    unset($_SESSION["commentiSegnalati"]);
} else {
    echo "no!";
}

?>

<div class="col-md-12 col-sm-12 app-container">
    <?php
    for ($i = 0; $i < count($searched); $i++) {
        echo $searched[$i]->getId();
        echo $searched[$i]->getIdAnnuncio();
        echo $searched[$i]->getIdUtente();
        echo $searched[$i]->getCorpo();
        echo $searched[$i]->getData();
    }
    ?>
</div>