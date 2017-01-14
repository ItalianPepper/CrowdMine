<?php
/**
 *
 */
include_once MODEL_DIR . "Commento.php";
include_once MODEL_DIR . "Annuncio.php";
include_once CONTROL_DIR . "commentiSegnalati.php";

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>
</head>
<body>
<div class="app app-default">

    <?php include "asidePannelloBackend.php" ?>

    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
        <div class="dropdown-background">
            <div class="bg"></div>
        </div>
        <div class="dropdown-container">
            {{list}}
        </div>
    </script>

    <div class="app-container">
        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body app-heading">
                        <div class="app-title">
                            <div class="title"><span class="highlight">Commenti Segnalati</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($listaCommentiSegnalati) && count($listaCommentiSegnalati) > 0) {
            ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            Lista Commenti Segnalati
                        </div>

                        <div class="card-body">
                            <?php
                            for ($i = 0; $i < count($listaCommentiSegnalati); $i++) {
                                $aId = $listaCommentiSegnalati[$i]->getId();
                                $u = $listaUtentiCommenti[$i];
                                ?>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">

                                        <div class="media social-post">
                                            <div class="media-left">
                                                <a href="<?php echo DOMINIO_SITO; ?>/ProfiloUtente/<?php echo $listaCommentiSegnalati[$i]->getIdUtente(); ?>">
                                                    <img src="<?php echo getUserImageBig($u); ?>"/>
                                                </a>
                                            </div>
                                            <div class="section">
                                                <div class="section-body">
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4 class="title"><?php echo getUserFullName($u) ?></h4>
                                                        </div>
                                                        <h4><b><?php echo $listaAnnunciCommenti[$i]->getTitolo(); ?></b></h4>

                                                        <div class="media-content">
                                                            <?php echo $listaCommentiSegnalati[$i]->getCorpo(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

</body>
</html>