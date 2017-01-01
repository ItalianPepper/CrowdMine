<?php
include_once MODEL_DIR . "/Annuncio.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";
$idUtente = "1";
if (isset($_SESSION["annunciSegnalati"]) && isset($_SESSION["listaUtentiAssociati"])) {
    $annunci = unserialize($_SESSION["annunciSegnalati"]);
    $listaUtentiAssociati = unserialize($_SESSION["listaUtentiAssociati"]);
    unset($_SESSION["annunciSegnalati"]);
    unset($_SESSION["listaUtentiAssociati"]);
} else {
    header("Location: " . DOMINIO_SITO . "/annunciSegnalati");
}
include_once VIEW_DIR . 'header.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\rating.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\Annuncio\annuncioUtenteLoggato.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">


    <?php
    for ($i = 0; $i < count($annunci); $i++) {
        $id = $annunci[$i]->getId();
        echo "<script>";
        echo "$(document).ready(function(){";
        echo "$(\".btn.btn-link$id\").click(function(){";
        echo "$(\".row.col-md-12.col-sm-12.card.contenitore$id\").toggle(250);";
        echo "$(\".row.col-md-12.col-sm-12.card.candidature$id\").hide(250);";
        echo "});";
        echo "});";
        echo "</script>";
    }
    ?>

    <?php
    for ($i = 0; $i < count($annunci); $i++) {
        $id = $annunci[$i]->getId();
        echo "<script>";
        echo "$(document).ready(function(){";
        echo "$(\".btn.btn-warning$id\").click(function(){";
        echo "$(\".row.col-md-12.col-sm-12.card.candidature$id\").toggle(250);";
        echo "$(\".row.col-md-12.col-sm-12.card.contenitore$id\").hide(250);";
        echo "});";
        echo "});";
        echo "</script>";
    }
    ?>


    <script>
        $(document).ready(function () {
            $(".btn.btn-warning").click(function () {
                $(".row.col-md-12.col-sm-12.card.candidature").toggle(250);
                $(".row.col-md-12.col-sm-12.card.contenitore").hide(250);

            });
        });
    </script>

</head>

<body>
<div class="app app-default">

    <?php include_once "asidePannelloBackend.php" ?>
    <div class="app-container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body app-heading">
                        <div class="app-title">
                            <div class="title"><span
                                    class="highlight">Annunci Segnalati</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Lista Annunci Segnalati
                    </div>

                    <div class="card-body">
                        <?php
                        for ($i = 0;
                             $i < count($annunci);
                             $i++) {

                            ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">

                                    <div class="media social-post">
                                        <div class="media-left">
                                            <a href="<?php echo DOMINIO_SITO; ?>/ProfiloUtente/<?php echo $annunci[$i]->getIdUtente(); ?>">
                                                <img src="<?php echo STYLE_DIR; ?>img\<?php echo
                                                $listaUtentiAssociati[$annunci[$i]->getIdUtente()]->getImmagineProfilo();
                                                ?>"/>
                                            </a>
                                        </div>
                                        <div class="section">
                                            <div class="section-body">
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <h4 class="title"><?php echo $listaUtentiAssociati[$annunci[$i]->getIdUtente()]->getNome() . " " .
                                                                $listaUtentiAssociati[$annunci[$i]->getIdUtente()]->getCognome() ?></h4>
                                                    </div>
                                                    <h4><b><?php echo $annunci[$i]->getTitolo(); ?></b></h4>

                                                    <div class="media-content">
                                                        <?php echo $annunci[$i]->getDescrizione(); ?>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-xs-12 simple-row"
                                                         style="padding-left: 0px">
                                                    <span class="label label-primary" style="background-color:#94119B"
                                                          ;="">Informatica</span>
                                                        <span class="label label-primary"
                                                              style="background-color:#C95115"
                                                              ;="">Prova4</span>
                                                    </div>

                                                    <div class="media-action">
                                                        <button class="btn btn-link" data-toggle="modal"
                                                                data-target="#myModal2-<?php echo $annunci[$i]->getId(); ?>""><i class="fa fa-check"
                                                                                                                                 style="font-size: 18px"></i>
                                                        Conferma
                                                        </button>
                                                        <button class="btn btn-link" data-toggle="modal"
                                                                data-target="#myModal3-<?php echo $annunci[$i]->getId(); ?>""><i class="fa fa-close"
                                                                                                                                 style="font-size: 18px"></i>
                                                        Elimina
                                                        </button>
                                                        <?php if ($user->getRuolo() == "moderatore") { ?>
                                                            <button class="btn btn-link"><i class="fa fa-check-circle"
                                                                                            data-toggle="modal"
                                                                                            data-target="#myModal4-<?php echo $annunci[$i]->getId(); ?>"
                                                                                            style="font-size: 18px"></i>
                                                                invia all'amministratore
                                                            </button>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="myModal2-<?php echo $annunci[$i]->getId(); ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                        aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Attivare l'annuncio?</h4>
                                            </div>
                                            <form action="attivaAnnuncioControl" method="post">
                                                <div class="modal-footer">
                                                    <input type="text" name="idAnnuncio" hidden
                                                           value="<?php echo $annunci[$i]->getId(); ?>">
                                                    <button type="button" class="btn btn-sm btn-default"
                                                            data-dismiss="modal">
                                                        Chiudi
                                                    </button>
                                                    <button type="submit" class="btn btn-sm btn-success">Attiva</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="myModal3-<?php echo $annunci[$i]->getId(); ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                        aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Disattivare l'annuncio?</h4>
                                            </div>
                                            <form action="disattivaAnnuncioControl" method="post">
                                                <div class="modal-footer">
                                                    <input type="text" name="idAnnuncio" hidden
                                                           value="<?php echo $annunci[$i]->getId(); ?>">
                                                    <button type="button" class="btn btn-sm btn-default"
                                                            data-dismiss="modal">
                                                        Chiudi
                                                    </button>
                                                    <button type="submit" class="btn btn-sm btn-success">Disattiva
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="myModal4-<?php echo $annunci[$i]->getId(); ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                        aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Inviare all'amministratore?</h4>
                                            </div>
                                            <form action="inviaAnnuncioAdmin" method="post">
                                                <div class="modal-footer">
                                                    <input type="text" name="idAnnuncio" hidden
                                                           value="<?php echo $annunci[$i]->getId(); ?>">
                                                    <button type="button" class="btn btn-sm btn-default"
                                                            data-dismiss="modal">
                                                        Chiudi
                                                    </button>
                                                    <button type="submit" class="btn btn-sm btn-success">Invia</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>


                    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/vendor.js"></script>
                    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/app.js"></script>
                    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>

                    <script type="text/javascript">
                        function toggleMe(a) {
                            var e = document.getElementById(a);
                            if (!e)return true;
                            if (e.style.display == "none") {
                                e.style.display = "block"
                            }
                            else {
                                e.style.display = "none"
                            }
                            return true;
                        }
                    </script>
                    <script type="text/javascript"
                            src="http://viralpatel.net/blogs/demo/jquery/jquery.shorten.1.0.js"></script>
                    <script>
                        $(document).ready(function () {
                            var showChar = 500;
                            var ellipsestext = "...";
                            var moretext = "altro";
                            var lesstext = "..meno";
                            $('.more').each(function () {
                                var content = $(this).html();

                                if (content.length > showChar) {

                                    var c = content.substr(0, showChar);
                                    var h = content.substr(showChar - 1, content.length - showChar);

                                    var html = c + '<span class="moreelipses">' + ellipsestext + '</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                                    $(this).html(html);
                                }

                            });

                            $(".morelink").click(function () {
                                if ($(this).hasClass("less")) {
                                    $(this).removeClass("less");
                                    $(this).html(moretext);
                                } else {
                                    $(this).addClass("less");
                                    $(this).html(lesstext);
                                }
                                $(this).parent().prev().toggle();
                                $(this).prev().toggle();
                                return false;
                            });
                        });
                    </script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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

</body>

</html>
