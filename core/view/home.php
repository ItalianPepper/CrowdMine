
<?php include_once VIEW_DIR . 'header.php';?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

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
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


    <?php
    for ($i = 0; $i < count($annunci); $i++) {
        $id = $annunci[$i]->getId();

        ?>

        <script>
            $(document).ready(function(){
                $(".btn.btn-link.<?php echo $id?> ").click(function(){
                    $(".row.col-md-12.col-sm-12.card.contenitore.<?php echo $id?>").toggle(250);
                    $(".row.col-md-12.col-sm-12.card.info.<?php echo $id?>").hide(250);
                });
            });
        </script>

        <script>
            $(document).ready(function(){
                $(".btn.btn-default.<?php echo $id?> ").click(function(){
                    $(".row.col-md-12.col-sm-12.card.contenitore.<?php echo $id?>").hide(250);
                    $(".row.col-md-12.col-sm-12.card.info.<?php echo $id?>").toggle(250);
                });
            });
        </script>


        <?php
    }
    ?>


</head>

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

<body >
<div class="app app-default">
    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a class="sidebar-brand" href="#"><span class="highlight">Flat v3</span> Admin</a>
            <button type="button" class="sidebar-toggle">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <ul class="sidebar-nav">

                <li class="">
                    <a href="inserisciAnnuncio">
                        <div class="icon">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <div class="title">Aggiungi Annuncio</div>
                    </a>
                </li>

                <li class="">
                    <a href="./messaging.html">
                        <div class="icon">
                            <i class="fa fa-server" aria-hidden="true"></i>
                        </div>
                        <div class="title">I miei annunci</div>
                    </a>
                </li>

                <li class="">
                    <a href="annunciPreferiti">
                        <div class="icon">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="title">Preferiti</div>
                    </a>
                </li>

                <li class="">
                    <a href="ricercaAnnuncio">
                        <div class="icon">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div class="title">Ricerca</div>
                    </a>
                </li>

                <li class="">
                    <a href="">
                        <div class="icon">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </div>
                        <div class="title">Statistiche</div>
                    </a>
                </li>

                <li class="">
                    <a href="">
                        <div class="icon">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </div>
                        <div class="title">Impostazioni</div>
                    </a>
                </li>


            </ul>
        </div>
        <div class="sidebar-footer">
            <ul class="menu">
                <li>
                    <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                    </a>
                </li>
                <li><a href="#"><span class="flag-icon flag-icon-th flag-icon-squared"></span></a></li>
            </ul>
        </div>
    </aside>
    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
        <div class="dropdown-background">
            <div class="bg"></div>
        </div>
        <div class="dropdown-container">
            {{list}}
        </div>
    </script>

    <div class="col-md-12 col-sm-12 col-xs-12 app-container">
        <?php
        for ($i = 0; $i < count($annunci); $i++) {
        $aId = $annunci[$i]->getId();
        ?>
        <div class="col-md-10 col-sm-10" style="margin-top: 5%">

            <div class="card">

                <div class="card-header ">

                    <div class="card-title" style="float: left">

                        <div class="media" style="width: 20%; float: left">
                            <a href="#">
                                <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                            </a>
                        </div>

                        <div style="float: left; margin-left: 5%;">
                            <h1 style="border-bottom: 1px solid #eee; padding-bottom: 5%">
                                <?php
                                $u = $listaUtenti[$annunci[$i]->getIdUtente()];
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
                            </div>


                            <?php

                        }

                    ?>

                    <div class="col-md-12 form-commento">
                        <form action="<?php echo DOMINIO_SITO;?>/commentaAnnuncioControl" method="post">
                            <div class="col-md-10 input-comment">
                                <input type="text" class="form-control" placeholder="Scrivi un commento... <?php echo $annunci[$i]->getId();?>"
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
            <?php
        }

        ?>
        </div>

</div>
</div>





















    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/vendor.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/app.js"></script>
    <script type="text/javascript">
        function toggleMe(a){
            var e=document.getElementById(a);
            if(!e)return true;
            if(e.style.display=="none"){
                e.style.display="block"
            }
            else{
                e.style.display="none"
            }
            return true;
        }
    </script>

    <script>
        $(document).ready(function(){
            <?php
            for ($i = 0; $i < count($annunci); $i++) {
                echo "annuncioButtons(" . $annunci[$i]->getId() . ")";
            }
            ?>
        });
        $(document).ready(function() {
            var showChar = 100;
            var ellipsestext = "...";
            var moretext = "altro";
            var lesstext = "..meno";
            $('.more').each(function() {
                var content = $(this).html();

                if(content.length > showChar) {

                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar-1, content.length - showChar);

                    var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';

                    $(this).html(html);
                }

            });

            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
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


