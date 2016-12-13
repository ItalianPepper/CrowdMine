<?php
/**
 *
 */
include_once MODEL_DIR . "/Annuncio.php";

$annunci = array();
if (isset($_SESSION["annunciSegnalati"])){
    $annunci = unserialize($_SESSION["annunciSegnalati"]);
    unset($_SESSION["annunciSegnalati"]);
} else {
    echo "no!";
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Flat Admin V.3 - Free flat-design bootstrap administrator templates</title>

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\rating.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">
    <style>
        .navbar-collapse.in
        {
            overflow-y: hidden;
        }
    </style>
</head>
<body>
<div class="app app-default">

    <?php include "asidePannelloModeratore.php" ?>

    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
        <div class="dropdown-background">
            <div class="bg"></div>
        </div>
        <div class="dropdown-container">
            {{list}}
        </div>
    </script>
    <div class="app-container">
        <nav class="navbar navbar-default" id="navbar">
            <div class="container-fluid">
                <div class="navbar-collapse collapse in">
                    <ul class="nav navbar-nav navbar-mobile">
                        <li>
                            <button type="button" class="sidebar-toggle">
                                <i class="fa fa-bars"></i>
                            </button>
                        </li>
                        <li class="logo">
                            <a class="navbar-brand" href="#"><span class="highlight">Moderatore</span> </a>
                        </li>
                        <li>
                            <button type="button" class="navbar-toggle">
                                <img class="profile-img" src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                            </button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-left">
                        <li class="navbar-search hidden-sm">
                            <input id="search" type="text" placeholder="Search..">
                            <button class="btn-search"><i class="fa fa-search"></i></button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown notification warning">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="icon"><i class="fa fa-comments" aria-hidden="true"></i></div>
                                <div class="title">Unread Messages</div>
                                <div class="count">99</div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li class="dropdown-header">Message</li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-warning pull-right">10</span>
                                            <div class="message">
                                                <img class="profile" src="https://placehold.it/100x100">
                                                <div class="content">
                                                    <div class="title">"Payment Confirmation.."</div>
                                                    <div class="description">Alan Anderson</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-warning pull-right">5</span>
                                            <div class="message">
                                                <img class="profile" src="https://placehold.it/100x100">
                                                <div class="content">
                                                    <div class="title">"Hello World"</div>
                                                    <div class="description">Marco Harmon</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-warning pull-right">2</span>
                                            <div class="message">
                                                <img class="profile" src="https://placehold.it/100x100">
                                                <div class="content">
                                                    <div class="title">"Order Confirmation.."</div>
                                                    <div class="description">Brenda Lawson</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown notification danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
                                <div class="title">System Notifications</div>
                                <div class="count">10</div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li class="dropdown-header">Notification</li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">8</span>
                                            <div class="message">
                                                <div class="content">
                                                    <div class="title">New Order</div>
                                                    <div class="description">$400 total</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">14</span>
                                            Inbox
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">5</span>
                                            Issues Report
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="profile-img" src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                                <div class="title">Profile</div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="profile-info">
                                    <h4 class="username">Scott White</h4>
                                </div>
                                <ul class="action">
                                    <li>
                                        <a href="#">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">5</span>
                                            My Inbox
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Setting
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
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
                <div class="card card-mini">
                    <div class="card-header">
                        Lista Annunci Segnalati
                    </div>

                        <div class="col-md-12 col-sm-12 app-container">
                            <?php
                            for ($i = 0; $i < count($annunci); $i++) {

                            ?>
                            <div class="row" style="margin-right: 20%; height: auto; margin-bottom: 5%">

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
                                        <div class="col-md-1 col-sm-2 preferites">
                                            <ul class="card-action">
                                                <li class="dropdown">
                                                    <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-cog" style="font-size: 200%;"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="cancellaAnnuncio?id=<?php echo $annunci[$i]->getId(); ?>" >Cancella annuncio</a></li>
                                                        <li><a href="modificaAnnuncio?id=<?php echo $annunci[$i]->getId(); ?>" >Modifica annuncio</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
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
                                    </div>

                                    <div class="media-comment" style="">
                                        <button class="btn btn-link<?php echo $annunci[$i]->getId();?>">
                                        </button>
                                        <button type="button" class="btn btn-warning<?php echo $annunci[$i]->getId();?>">
                                    </div>


                                    <div class="row col-md-12 col-sm-12 card contenitore<?php echo $annunci[$i]->getId();?>" style="margin-left: 0; display: none">

                                    </div


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

</body>
</html>