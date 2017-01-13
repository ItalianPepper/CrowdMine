<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>
    <style>
        .navbar-collapse.in {
            overflow-y: hidden;
        }
    </style>
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
                            <div class="title"><span
                                        class="highlight">Utenti Bannati</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Lista Utenti Bannati
                    </div>
                    <div class="card-body">
                        <?php
                        foreach ($utentiBannati as $utente) {
                            ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="media social-post">
                                        <div class="media-left">
                                            <a href="<?php echo DOMINIO_SITO.'/ProfiloUtente/'.$utente->getId()?>">
                                                <img src="<?php echo getUserImageBig($utente);?>"/>
                                            </a>
                                        </div>
                                        <div class="section">
                                            <div class="section-body">
                                                <div class="media-body">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <h4 class="title"><?php echo getUserFullName($utente); ?></h4>
                                                            <div class="description"><?php echo $utente->getDescrizione() ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="pull-right" style="margin-top: 4px">
                                                        <button type="button" class="btn btn-warning btn-xs" <?php if($utente->getStato()!=StatoUtente::RICORSO) echo "disabled";?>>
                                                            <i class="fa fa-bullhorn"></i> Ricorso
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-xs-12 pull-left"
                                                         style="padding:0px">
                                                        <div class="media-action">
                                                            <form action="riattivaUtente" method="post">
                                                                <input type="hidden" name="idUser" value="<?php echo $utente->getId(); ?>">
                                                                <input type="hidden" name="referer" value="UtentiBannati" >
                                                                <button type="submit" class="btn btn-link"><i class="fa fa-check"></i>
                                                                    Riattiva
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>

    <script>
        /*evidenzio altro nella barra laterale*/
        $("#altro").toggleClass("active");
    </script>

</body>
</html>