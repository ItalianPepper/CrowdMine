
<?php

$annunci = null;
$commenti = null;

if (isset($_SESSION['annunci'])) {
    $annunci = unserialize($_SESSION['annunci']);
    unset($_SESSION['annunci']);
    if (isset($_SESSION['commenti'])) {
        $commenti = unserialize($_SESSION['commenti']);
        unset($_SESSION['commenti']);
        echo "its'ok";
    }
} else {
    echo "no";
}

include_once VIEW_DIR . 'header.php';
?>



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
                    <a href="/core/template/index.html">
                        <div class="icon">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <div class="title">Dashboard</div>
                    </a>
                </li>
                <li class="@@menu.messaging">
                    <a href="/core/template/messaging.html">
                        <div class="icon">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                        </div>
                        <div class="title">Messaging</div>
                    </a>
                </li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="icon">
                            <i class="fa fa-cube" aria-hidden="true"></i>
                        </div>
                        <div class="title">UI Kits</div>
                    </a>
                    <div class="dropdown-menu">
                        <ul>
                            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> UI Kits</li>
                            <li><a href="/core/template/uikits/customize.html">Customize</a></li>
                            <li><a href="/core/template/uikits/components.html">Components</a></li>
                            <li><a href="/core/template/uikits/card.html">Card</a></li>
                            <li><a href="/core/template/uikits/form.html">Form</a></li>
                            <li><a href="/core/template/uikits/table.html">Table</a></li>
                            <li><a href="/core/template/uikits/icons.html">Icons</a></li>
                            <li class="line"></li>
                            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Advanced Components</li>
                            <li><a href="/core/template/uikits/pricing-table.html">Pricing Table</a></li>
                            <!-- <li><a href="../uikits/timeline.html">Timeline</a></li> -->
                            <li><a href="/core/template/uikits/chart.html">Chart</a></li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="icon">
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                        </div>
                        <div class="title">Pages</div>
                    </a>
                    <div class="dropdown-menu">
                        <ul>
                            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Admin</li>
                            <li><a href="/core/template/pages/form.html">Form</a></li>
                            <li><a href="/core/template/pages/profile.html">Profile</a></li>
                            <li><a href="/core/template/pages/search.html">Search</a></li>
                            <li class="line"></li>
                            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Landing</li>
                            <!-- <li><a href="../pages/landing.html">Landing</a></li> -->
                            <li><a href="/core/template/pages/login.html">Login</a></li>
                            <li><a href="/core/template/pages/register.html">Register</a></li>
                            <!-- <li><a href="../pages/404.html">404</a></li> -->
                        </ul>
                    </div>
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
                            <h1 style="border-bottom: 1px solid #eee; padding-bottom: 5%">JetBrains</h1>
                            <h1><?php echo $annunci[$i]->getTitolo();?></h1>

                        </div>

                    </div>

                    <a href="segnalaAnnuncioControl?id=<?php echo $annunci[$i]->getId();?>">
                        <i class="fa fa-legal" aria-hidden="true" style="font-size: 200%"></i>
                    </a>

                    <a href="aggiungiPreferitiControl?id=<?php echo $annunci[$i]->getId();?>">
                        <i class="fa fa-star" aria-hidden="true" style="font-size: 200%"></i>
                    </a>

                </div>

                <div class="card-body">
                    <div class="comment more" style="word-wrap: break-word;">
                        <?php echo $annunci[$i]->getDescrizione();?>
                    </div>
                    <br>

                    <div style="margin-top: 3%">
                        <span class="label label-primary">Informatica</span>
                        <span class="label label-primary">Informatica</span>
                    </div>
                </div>

                <div class="media-comment" style="">
                    <button class="btn btn-link <?php echo $annunci[$i]->getId();?>">
                        <i class="fa fa-comments-o"></i><?php echo count($commenti[$i]) ?>Comments
                    </button>
                    <button class="btn btn-default <?php echo $annunci[$i]->getId();?>">info</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $annunci[$i]->getId();?>">Candidati</button>
                </div>

                <div class="modal fade" id="myModal<?php echo $annunci[$i]->getId();?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Candidati</h4>
                            </div>
                            <form action="aggiungiCandidaturaControl" method="post">
                                <div class="modal-body">
                                    Inserisci Descrizione
                                    <textarea name="descrizione" rows="3" class="form-control" placeholder="Descrizione.. <?php echo $annunci[$i]->getId();?>"></textarea>
                                    <input type="text" value="<?php echo $annunci[$i]->getId();?>" name="idAnnuncio" hidden>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Chiudi</button>
                                    <button type="submit" class="btn btn-sm btn-success">Candidati</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row col-md-12 col-sm-12 card contenitore <?php echo $annunci[$i]->getId(); ?>" style="margin-left: 0; display: none">
                <?php
                for ($j = 0; $j < count($commenti[$i]); $j++) {
                    if ($annunci[$i]->getId() == $commenti[$i][$j]->getIdAnnuncio()) {
                        ?>

                        <div class="comment-body" style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                            <div class="media-heading">
                                <h4 class="title">Scott White</h4>
                                <h5 class="timeing"><?php
                                    echo $commenti[$i][$j]->getData();
                                    ?></h5>
                            </div>
                            <div class="col-md-5 col-sm-5 options"
                                 style="float: right; margin-top: -8%; margin-right: -23%">
                                <a href="segnalaCommento?id=<?php echo $commenti[$i][$j]->getId(); ?>">
                                    <button
                                            style="background-color: Transparent;background-repeat:no-repeat; border: none;cursor:pointer; overflow: hidden; outline:none;">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="media-content">
                                <?php
                                echo $commenti[$i][$j]->getCorpo();
                                ?>
                            </div>

                        </div>


                        <?php
                    }
                }

                ?>

                <div class="col-md-12 form-commento">
                    <form action="commentaAnnuncioControl" method="post">
                        <div class="col-md-10 input-comment">
                            <input type="text" class="form-control" placeholder="Scrivi un commento... <?php echo $annunci[$i]->getId();?>"
                                   name="commento">
                            <input type="text" name ="idAnnuncio" hidden value="<?php echo $annunci[$i]->getId();?>">
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
    <script type="text/javascript" src="http://viralpatel.net/blogs/demo/jquery/jquery.shorten.1.0.js"></script>
    <script>
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


