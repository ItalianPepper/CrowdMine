<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>

    <style>
        div.section .profile {
            margin-bottom: 0px;
        }

        .app-container .app-heading.no-flex{
            display:inline-block;
            width:100%;
        }

        body .app-container .app-heading .app-title{
            min-height:80px;
        }

        .card.card-tab .tab-content .tab-pane.active.tab-pane-cards{
            display: inline-block;
        }

        .tab-pane.tab-pane-cards .card-header {
            padding: 30px;
            border-bottom: 1px solid #dfe6e8;
            background-color: #fff;
        }

    </style>


    <style>
        h1 {
            font-size: 1rem;

        }

        @media (min-width: 1px) {
            h1 {
                font-size: medium;
            }

        }

        @media (min-width: 750px) {
            h1 {
                font-size: medium;
            }

        }

        @media (min-width: 970px) {
            h1 {
                font-size: x-large;
            }

        }

        @media (min-width: 1200px) {
            h1 {
                font-size: xx-large;
            }

        }

        a.morelink {
            text-decoration:none;
            outline: none;
        }
        .morecontent span {
            display: none;

        }


    </style>

    <?php
        if(isset($user))
        $fullname = $user->getNome()." ".$user->getCognome();
    ?>

</head>
<body>
<div class="app app-default">

    <?php include_once VIEW_DIR."headerSideBar.php";?>
    <div class="app-container">

        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>
        <div class="row">
            <div class="col-lg-12">
                            <?php
                            for ($i = 0; $i < count($annunci); $i++) {
                                $aId = $annunci[$i]->getId();
                                $u = $listaUtenti[$annunci[$i]->getIdUtente()];
                                ?>

                                <div class="col-md-10 col-sm-10" style="margin-top: 5%">

                                    <div class="card">

                                        <div class="card-header ">

                                            <div class="card-title" style="float: left">

                                                <div class="media" style="width: 20%; float: left">
                                                    <a href="<?php echo DOMINIO_SITO."\ProfiloUtente\\".$u->getId(); ?>">
                                                        <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                                                    </a>
                                                </div>

                                                <div style="float: left; margin-left: 5%;">
                                                    <h1 style="border-bottom: 1px solid #eee; padding-bottom: 5%">
                                                        <?php

                                                        echo $u->getNome() . " " . $u->getCognome() ?>
                                                    </h1>
                                                    <h1><?php echo $annunci[$i]->getTitolo();?></h1>

                                                </div>

                                            </div>

                                            <a href="<?php echo DOMINIO_SITO; ?>/segnalaAnnuncioControl?id=<?php echo $annunci[$i]->getId();?>">
                                                <i class="fa fa-legal" aria-hidden="true" style="font-size: 200%"></i>
                                            </a>

                                            <a href="<?php echo DOMINIO_SITO; ?>/aggiungiPreferitiControl?id=<?php echo $annunci[$i]->getId();?>">
                                                <i class="fa fa-star" aria-hidden="true" style="font-size: 200%"></i>
                                            </a>

                                        </div>

                                        <div class="card-body">
                                            <div class="comment more" style="word-wrap: break-word;">
                                                <?php echo $annunci[$i]->getDescrizione();?>
                                            </div>
                                            <br>

                                            <div style="margin-top: 3%">
                                                <?php
                                                if(isset($AnnunciMicroRef[$aId]))
                                                    for($z=0;$z<count($AnnunciMicroRef[$aId]); $z++){
                                                        $micro = $listaMicro[$AnnunciMicroRef[$aId][$z]];
                                                        echo randomColorLabel($micro->getNome(), $micro->getNome());
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="media-comment" style="">
                                            <button class="btn btn-link <?php echo $annunci[$i]->getId();?>">
                                                <i class="fa fa-comments-o"></i><?php echo isset($listaCommenti[$aId])?count($listaCommenti[$aId]):0 ?>Comments
                                            </button>
                                            <button class="btn btn-default <?php echo $annunci[$i]->getId();?>">info</button>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $annunci[$i]->getId();?>">Candidati</button>
                                        </div>


                                        <div class="row col-md-12 col-sm-12 card contenitore <?php echo $annunci[$i]->getId(); ?>" style="margin-left: 0; display: none">
                                            <?php
                                            if(isset($listaCommenti[$aId]))
                                                for($z=0;$z<count($listaCommenti[$aId]); $z++){

                                                    ?>
                                                    <div class="comment-body" style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                                                        <div class="media-heading">
                                                            <h4 class="title">
                                                                <?php
                                                                $u = $listaUtenti[$listaCommenti[$aId][$z]->getIdUtente()];
                                                                echo $u->getNome()." ".$u->getCognome()
                                                                ?>
                                                            </h4>
                                                            <h5 class="timeing"><?php
                                                                echo $listaCommenti[$aId][$z]->getData();
                                                                ?>
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-5 col-sm-5 options"
                                                             style="float: right; margin-top: -8%; margin-right: -23%">
                                                            <a href="<?php echo DOMINIO_SITO;?>/segnalaCommento?id=<?php echo $listaCommenti[$aId][$z]->getId(); ?>">
                                                                <button
                                                                        style="background-color: Transparent;background-repeat:no-repeat; border: none;cursor:pointer; overflow: hidden; outline:none;">
                                                                    <i class="fa fa-close"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="media-content">
                                                            <?php
                                                            echo $listaCommenti[$aId][$z]->getCorpo();
                                                            ?>
                                                        </div>

                                                    </div>


                                                    <?php

                                                }

                                            ?>

                                            <div class="col-md-12 form-commento">
                                                <form action="<?php echo DOMINIO_SITO;?>/commentaAnnuncioControl" method="post">
                                                    <div class="col-md-10 input-comment">
                                                        <input type="text" class="form-control" placeholder="Scrivi un commento..."
                                                               name="commento">
                                                        <input type="hidden" name ="idAnnuncio" hidden value="<?php echo $annunci[$i]->getId();?>">
                                                    </div>
                                                    <div class="col-md-2 btn-comment">
                                                        <button type="submit" class="btn btn-info">Commenta</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="row col-md-12 col-sm-12 card info <?php echo $annunci[$i]->getId(); ?>" style="margin-left: 0; display: none">
                                            <h5>
                                                <i class="fa fa-location-arrow"></i>
                                                <?php echo $annunci[$i]->getLuogo();?></h5>
                                            <h5>
                                                <i class="fa fa-money"></i>
                                                <?php echo $annunci[$i]->getRetribuzione();?></h5>
                                            <h5>
                                                <i class="fa fa-clock-o"></i>
                                                <?php echo $annunci[$i]->getData();?></h5>
                                            <h5>
                                                <i class="fa fa-briefcase"></i>
                                                <?php echo $annunci[$i]->getTipologia();?></h5>
                                        </div>

                                    </div>
                                </div>


                                <?php
                            }

                            ?>
            </div>

                        <?php
                        for ($i = 0; $i < count($annunci); $i++) {
                            $aId = $annunci[$i]->getId();
                            ?>
                            <div class="modal fade" id="myModal<?php echo $annunci[$i]->getId();?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Candidati</h4>
                                        </div>
                                        <form action="<?php echo DOMINIO_SITO;?>/aggiungiCandidaturaControl" method="post">
                                            <div class="modal-body">
                                                Inserisci Descrizione
                                                <textarea name="descrizione" rows="3" class="form-control" placeholder="Descrizione..."></textarea>
                                                <input type="text" value="<?php echo $annunci[$i]->getId();?>" name="idAnnuncio" hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Chiudi</button>
                                                <button type="submit" class="btn btn-sm btn-success">Candidati</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
        </div>
    </div>


                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackCheckUtils.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackList.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR;?>assets\js\notifyPanelFunction.js"></script>

                <script>
                    function setModalForm(action,text){
                        $("#ConfirmModal form").attr("action",action);
                        $(".modal-body").html("<p>"+text+"</p>")
                    }
                </script>

                <script type="text/javascript">

                    $(document).ready(function(){
                        <?php
                        for ($i = 0; $i < count($annunci); $i++) {
                            echo "annuncioButtons(" . $annunci[$i]->getId() . "); ";
                        }
                        ?>
                    });

                    function annuncioButtons(id){
                        $(".btn.btn-link."+id).click(function(){
                            $(".row.col-md-12.col-sm-12.card.contenitore."+id).toggle(250);
                            $(".row.col-md-12.col-sm-12.card.info."+id).hide(250);
                        });

                        $(".btn.btn-default."+id).click(function(){
                            $(".row.col-md-12.col-sm-12.card.contenitore."+id).hide(250);
                            $(".row.col-md-12.col-sm-12.card.info."+id).toggle(250);
                        });
                    }

                    /*redirect to hash*/
                    hashes=location.hash.split("#");
                    if(hashes[1]) {
                        $('.nav-tabs a[href="#' + hashes[1] + '"]').tab('show');
                    }
                    if(hashes[2]){
                        $('html, body').animate({
                            scrollTop: $("#"+hashes[2]+"").offset().top
                        }, 2000);
                    }

                    <?php

                        if(isset($sideBarIconName)) {
                            /*evidenzio l'icona nella barra laterale*/
                            echo '$("#' . $sideBarIconName . '").toggleClass("active");';
                        }
                    ?>

                    $('[data-toggle="tooltip"]').tooltip();

                </script>

                <?php

                if (isset($_SESSION['toast-type']) && isset($_SESSION['toast-message'])) {
                    ?>
                    <script>
                        $(document).ready(function () {
                            "use strict";
                            $("#feedback-tab").click();
                            $("#feedback-collapse-panel").click();
                        });
                        toastr["<?php echo $_SESSION['toast-type'] ?>"]("<?php echo $_SESSION['toast-message'] ?>");
                    </script>
                    <?php
                    unset($_SESSION['toast-type']);
                    unset($_SESSION['toast-message']);
                }
                ?>


</body>

</html>
