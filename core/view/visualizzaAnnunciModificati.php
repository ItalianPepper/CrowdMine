<!DOCTYPE html>

<head>

    <title>Crowdmine | Annunci Modificati</title>
    <?php include_once VIEW_DIR."headerStart.php";?>

    <script>
        $(document).ready(function(){

            $(".btn.btn-warning").click(function () {
                $(".row.col-md-12.col-sm-12.card.candidature").toggle(250);
                $(".row.col-md-12.col-sm-12.card.contenitore").hide(250);

            });

            <?php
            for ($i = 0; $i < count($annunci); $i++) {
                echo "annuncioButtons(" . $annunci[$i]->getId() . ")";
            }
            ?>
        });

        function annuncioButtons(id){
            $(".btn.btn-link"+id).click(function(){;
                $(".row.col-md-12.col-sm-12.card.contenitore"+id).toggle(250);
                $(".row.col-md-12.col-sm-12.card.candidature"+id).hide(250);
            });

            $(".btn.btn-warning"+id).click(function(){
                $(".row.col-md-12.col-sm-12.card.candidature"+id).toggle(250);
                $(".row.col-md-12.col-sm-12.card.contenitore"+id).hide(250);
            });
        }

    </script>
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
                                    class="highlight">Annunci Modificati</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Lista Annunci Modificati
                    </div>

                    <div class="card-body">
                        <?php
                        for ($i = 0; $i < count($annunci); $i++) {
                            $aId = $annunci[$i]->getId();
                            $u = $listaUtenti[$annunci[$i]->getIdUtente()];
                            ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">

                                    <div class="media social-post">
                                        <div class="media-left">
                                            <a href="<?php echo DOMINIO_SITO; ?>/ProfiloUtente/<?php echo $annunci[$i]->getIdUtente(); ?>">
                                                <img src="<?php echo getUserImageBig($u);
                                                ?>"/>
                                            </a>
                                        </div>
                                        <div class="section">
                                            <div class="section-body">
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <h4 class="title"><?php echo getUserFullName($u); ?></h4>
                                                    </div>
                                                    <h4><b><?php echo $annunci[$i]->getTitolo(); ?></b></h4>

                                                    <div class="media-content">
                                                        <?php echo $annunci[$i]->getDescrizione(); ?>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-xs-12 simple-row"
                                                         style="padding-left: 0px">
                                                        <?php
                                                        if(isset($AnnunciMicroRef[$aId]))
                                                            for($z=0;$z<count($AnnunciMicroRef[$aId]); $z++){
                                                                $micro = $listaMicro[$AnnunciMicroRef[$aId][$z]];
                                                                echo randomColorLabel($micro->getNome(), $micro->getNome())." ";
                                                            }
                                                        ?>
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
                                            <form action="<?php echo DOMINIO_SITO; ?>/attivaAnnuncioControl" method="post">
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
                                            <form action="<?php echo DOMINIO_SITO; ?>/disattivaAnnuncioControl" method="post">
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
                                            <form action="<?php echo DOMINIO_SITO; ?>/inviaAnnuncioAdmin" method="post">
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
    </div>


        <?php include_once VIEW_DIR."footerStart.php";?>

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

</body>

<?php include_once VIEW_DIR."footerEnd.php";?>

</html>