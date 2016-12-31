<?php
include_once MODEL_DIR . "/Annuncio.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";
$idUtente="1";
if (isset($_SESSION["annunciSegnalati"])){
    $annunci = unserialize($_SESSION["annunciSegnalati"]);
    unset($_SESSION["annunciSegnalati"]);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
        $(document).ready(function(){
            $(".btn.btn-warning").click(function(){
                $(".row.col-md-12.col-sm-12.card.candidature").toggle(250);
                $(".row.col-md-12.col-sm-12.card.contenitore").hide(250);

            });
        });
    </script>

</head>

<style>

    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-style: normal;
        font-variant-ligatures: normal;
        font-variant-caps: normal;
        font-variant-numeric: normal;
        font-weight: normal;
        font-stretch: normal;
        font-size: inherit;
        line-height: 1;
        font-family: FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    ////*****/////

    h1 {
        font-size: 1rem;
    }

    h4 {
        font-size: 20px;
    }

    i {
        font-size: 300%;
    }

    @media (min-width: 1px) {
        h1 {
            font-size: xx-small;
        }
        h4 {
            font-size: 10px;
        }
        .fa.fa-check {
            font-size: 50%;
        }
        .fa.fa-close {
            font-size: 50%;

        }
        .fa.fa-mail-reply-all {
            font-size: 50%;

        }

    }

    @media (min-width: 750px) {
        h1 {
            font-size: 13px;
        }
        h4 {
            font-size: 13px;
        }
        .fa.fa-check {
            font-size: 100%;
        }
        .fa.fa-close {
            font-size: 100%;

        }
        .fa.fa-mail-reply-all {
            font-size: 100%;

        }

    }

    @media (min-width: 970px) {
        h1 {
            font-size: x-large;
        }
        h4 {
            font-size: 20px;
        }
        .fa.fa-check {
            font-size: 200%;
        }
        .fa.fa-close {
            font-size: 200%;

        }
        .fa.fa-mail-reply-all {
            font-size: 200%;
        }

    }

    @media (min-width: 1200px) {
        h1 {
            font-size: xx-large;

        }
        h4 {
            font-size: 35px;
        }
        .fa.fa-check {
            font-size: 300%;
        }
        .fa.fa-close {
            font-size: 300%;
        }
        .fa.fa-mail-reply-all {
            font-size: 300%;
        }

    }

    a.morelink {
        text-decoration:none;
        outline: none;
    }
    .morecontent span {
        display: none;

    }
    .media-left img{
        border-radius: 50%; }


</style>

<body>
<div class="app app-default">

    <?php include_once "asidePannelloBackend.php"?>
    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
        <div class="dropdown-background">
            <div class="bg"></div>
        </div>
        <div class="dropdown-container">
            {{list}}
        </div>
    </script>

    <div class="col-md-12 col-sm-12 app-container">
        <?php
        for ($i = 0; $i < count($annunci); $i++) {

        ?>
        <div class="row" style="margin-right: 20%; height: auto; margin-bottom: 5%; background-color: white">

            <div class="card">

                <div class="row col-md-12 col-sm-12 col-xs-12 card-header" style="margin-left: 0%">
                    <div class="col-md-3 col-sm-3 media-left">
                        <a href="#">
                            <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                        </a>
                    </div>
                    <div class="col-md-7 annuncioTitle" style="width: 100%;">

                        <div class="owner col-md-12 col-sm-12" style="border-bottom: 1px solid #eee;">
                            <h1><?php echo "Nome del proprietario" ?></h1>
                        </div>

                        <div class="offerta col-md-12 col-sm-12">
                            <h1><?php echo $annunci[$i]->getTitolo(); ?></h1>
                        </div>
                    </div>

                </div>

                <div class="row col-md-12 col-sm-12 col-xs-12 card-body" style="margin-left: 0%">
                    <div class="media-body comment more">
                        <?php echo $annunci[$i]->getDescrizione(); ?>
                    </div>

                </div>

                <div class="row col-md-12 col-sm-12 col-xs-12 media-categories"
                     style="margin-left: 2%; margin-bottom: 2%; margin-top: -2%;">
                    <span class="label label-warning">Informatica</span>
                    <span class="label label-default">Web Developer</span>
                    <span class="label label-info"><?php echo $annunci[$i]->getLuogo();?></span>
                    <span class="label label-primary"><?php echo $annunci[$i]->getRetribuzione();?>€</span>
                    <div class="media-action">
                        <button class="btn btn-link" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-check"style="font-size: 200%;"></i> Attiva</button>
                        <button class="btn btn-link" data-toggle="modal" data-target="#myModal3"><i class="fa fa-close" style="font-size: 200%;"></i> Disattiva</button>
                        <button class="btn btn-link" data-toggle="modal" data-target="#myModal4"><i class="fa fa-check-circle" style="font-size: 200%;"></i> Invia all'amministratore</button>
                    </div>
                </div>

                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Attivare l'annuncio?</h4>
                            </div>
                            <form action="attivaAnnuncioControl" method="post">
                                <div class="modal-footer">
                                    <input type="text" name ="idAnnuncio" hidden value="<?php echo $annunci[$i]->getId();?>">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                        Chiudi
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-success">Attiva</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Disattivare l'annuncio?</h4>
                            </div>
                            <form action="disattivaAnnuncioControl" method="post">
                                <div class="modal-footer">
                                    <input type="text" name ="idAnnuncio" hidden value="<?php echo $annunci[$i]->getId();?>">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                        Chiudi
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-success">Disattiva</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Inviare all'amministratore?</h4>
                            </div>
                            <form action="inviaAnnuncioAdmin" method="post">
                                <div class="modal-footer">
                                    <input type="text" name ="idAnnuncio" hidden value="<?php echo $annunci[$i]->getId();?>">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                        Chiudi
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-success">Invia</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>

    </div>
    <?php

    }
    ?>

    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/vendor.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>

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
    <script type="text/javascript" src="http://viralpatel.net/blogs/demo/jquery/jquery.shorten.1.0.js"></script>
    <script>
        $(document).ready(function() {
            var showChar = 500;
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
