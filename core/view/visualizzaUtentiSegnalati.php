<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>
    <style>
        .navbar-collapse.in {
            overflow-y: hidden;
        }

        .media-action form {
            display: inline-block;
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
                                        class="highlight">Utenti Segnalati</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($user->getRuolo() == RuoloUtente::AMMINISTRATORE){?>
            <div class="row" >
                <div class="col-lg-12 col-md-12 col-xs-12" >
                    <div class="card" >
                        <div class="card-header" >
                            In evidenza
                        </div >
                        <div class="card-body" >
                            <div class="row" >
                                <div class="col-lg-12 col-md-12 col-xs-12" >
                                    <div class="media social-post" >
                                        <div class="section" >
                                            <?php
                                            for ($i = 0; $i < count($usersAdmin); $i++) {
                                                $utente = $usersAdmin[$i];
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12 <?php echo ($i == 0) ? '' : 'overlined-row' ?>">
                                                        <div class="media social-post">
                                                            <div class="media-left">
                                                                <a href="<?php echo DOMINIO_SITO . '/ProfiloUtente/' . $utente->getId() ?>">
                                                                    <img src="<?php echo getUserImageBig($utente); ?>"/>
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

                                                                        <div class="col-lg-12 col-md-12 col-xs-12 pull-left"
                                                                             style="padding:0px">
                                                                            <div class="media-action">
                                                                                <button class="btn btn-link" type="button"
                                                                                        data-toggle="modal"
                                                                                        data-target="#myModal"
                                                                                        onclick="setModalForm(<?php echo "'" . DOMINIO_SITO . "/banUtente','" . $utente->getId() . "'"; ?>,'Sicuro di voler bannare l\'utente?')">
                                                                                    <i class="fa fa-check"></i> Conferma ban
                                                                                </button>
                                                                                <form action="SegnalazioneUtenteControl"
                                                                                      method="post">
                                                                                    <button class="btn btn-link"
                                                                                            name="idUtenteElimina"
                                                                                            type="submit"
                                                                                            value="<?php echo $utente->getId() ?>">
                                                                                        <i class="fa fa-close"></i> Elimina
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
                    </div>
                </div>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Lista Utenti Segnalati
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="media social-post">
                                <div class="section">
                                    <?php
                                    for ($i = 0; $i < count($usersReported); $i++) {
                                        $utente = $usersReported[$i];
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 <?php echo ($i == 0) ? '' : 'overlined-row' ?>">
                                                <div class="media social-post">
                                                    <div class="media-left">
                                                        <a href="<?php echo DOMINIO_SITO . '/ProfiloUtente/' . $utente->getId() ?>">
                                                            <img src="<?php echo getUserImageBig($utente);?>"/>
                                                        </a>
                                                    </div>
                                                    <div class="section">
                                                        <div class="section-body">
                                                            <div class="media-body">
                                                                <div class="pull-left">
                                                                    <div class="media-heading">
                                                                        <h4 class="title"><?php echo $utente->getNome() . " " . $utente->getCognome() ?></h4>
                                                                        <div class="description"><?php echo $utente->getDescrizione() ?></div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12 col-xs-12 pull-left" style="padding:0px">
                                                                    <div class="media-action">
                                                                        <button class="btn btn-link" type="button"
                                                                                data-toggle="modal" data-target="#myModal"
                                                                                onclick="setModalForm(<?php echo "'" . DOMINIO_SITO . "/banUtente','" . $utente->getId() . "'"; ?>,'Sicuro di voler bannare l\'utente?')">
                                                                            <i class="fa fa-check"></i> Conferma ban
                                                                        </button>
                                                                        <form action="SegnalazioneUtenteControl" method="post">
                                                                            <button class="btn btn-link"
                                                                                    name="idUtenteElimina" type="submit"
                                                                                    value="<?php echo $utente->getId() ?>">
                                                                                <i class="fa fa-close"></i> Elimina
                                                                            </button>
                                                                        </form>
                                                                        <form action="SegnalazioneUtenteControl"
                                                                              method="post">
                                                                            <button class="btn btn-link"
                                                                                    name="idUtenteAdmin" type="submit"
                                                                                    value="<?php echo $utente->getId() ?>">
                                                                                <i class="fa fa-check-circle"></i> invia
                                                                                all'amministratore
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
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Conferma Ban</h4>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <input type="hidden" id="idUser" name="idUser">
                                <input type="hidden" name="referer"
                                       value="<?php echo DOMINIO_SITO . '/UtentiSegnalati'; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Ban Utente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>

        <script>
            /*evidenzio segnalazioni nella barra laterale*/
            $("#segnalazioni").toggleClass("active");
            $('[data-toggle="tooltip"]').tooltip();

            function setModalForm(action, userid, text) {
                $("#myModal form").attr("action", action);
                $("#idUser").attr("value", userid);
                $(".modal-body").html("<p>" + text + "</p>")
            }

        </script>

        <?php
        if (isset($_SESSION['toast-type']) && isset($_SESSION['toast-message'])) {
            ?>
            <script>
                toastr["<?php echo $_SESSION['toast-type'] ?>"]("<?php echo $_SESSION['toast-message'] ?>");
            </script>
            <?php
            unset($_SESSION['toast-type']);
            unset($_SESSION['toast-message']);
        }
        ?>
    </div>
</div>
</body>
</html>