<?php
/**
 *
 * @author Vincenzo Russo
 * @version 1.0
 * @since 30/05/16
 */
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

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".btn.btn-link").click(function(){
                $(".row.col-md-12.col-sm-12.card.contenitore").toggle(250);
            });
        });
    </script>
    <script type="text/javascript">
        function caricaAnnunciRicercati(){

        }
    </script>
</head>

<style>
    h1 {
        font-size: 1rem;
    }

    @media (min-width: 1px) {
        h1 {
            font-size: xx-small;
        }
    }

    @media (min-width: 750px) {
        h1 {
            font-size: 13px;
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

<body onload="caricaAnnunciRicercati()">
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

    <div class="col-md-12 col-sm-12 app-container">

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
                            <h1>JetBrains</h1>
                        </div>

                        <div class="offerta col-md-12 col-sm-12">
                            <h1>Offerta Programmatore PHP</h1>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-2 preferites">
                        <a>
                        <button style="
                                background-color: Transparent;
                                background-repeat:no-repeat;
                                border: none;
                                cursor:pointer;
                                overflow: hidden;
                                outline:none;">
                            <i class="fa fa-star-o" style="font-size: 200%;" data-toggle="modal" data-target="#myModal2"></i>
                        </button>
                        </a>
                        <ul class="card-action">
                            <li class="dropdown">
                                <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-cog" style="font-size: 200%;"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#myModal">Segnala</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Conferma segnalazione</h4>
                                </div>
                                <form action="segnalaAnnuncioControl" method="post">
                                <div class="modal-body">Inserisci una descrizione per segnalare
                                    <textarea name="descrizione" rows="3" class="form-control" placeholder="Descrizione.."></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Chiudi</button>
                                    <button type="submit" class="btn btn-sm btn-danger">Segnala</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Aggiungere ai preferiti?</h4>
                            </div>
                            <form action="aggiungiPreferitiControl" method="post">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Chiudi</button>
                                    <button type="submit" class="btn btn-sm btn-success">Aggiungi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row col-md-12 col-sm-12 col-xs-12 card-body" style="margin-left: 0%">
                    <div class="media-body comment more">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Vestibulum laoreet, nunc eget laoreet sagittis,
                        quam ligula sodales orci, congue imperdiet eros tortor ac lectus.
                        Duis eget nisl orci. Aliquam mattis purus non mauris
                        blandit id luctus felis convallis.
                        Integer varius egestas vestibulum.
                        Nullam a dolor arcu, ac tempor elit. Donec.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Vestibulum laoreet, nunc eget laoreet sagittis,
                        quam ligula sodales orci, congue imperdiet eros tortor ac lectus.
                        Duis eget nisl orci. Aliquam mattis purus non mauris
                        blandit id luctus felis convallis.
                        Integer varius egestas vestibulum.
                        Nullam a dolor arcu, ac tempor elit. Donec.
                    </div>

                </div>

                <div class="row col-md-12 col-sm-12 col-xs-12 media-categories" style="margin-left: 2%; margin-bottom: 2%; margin-top: -2%">
                    <span class="label label-primary">Informatica</span>
                    <span class="label label-warning">Web Developer</span>
                    <span class="label label-primary">Fisciano</span>
                    <span class="label label-primary">2000€</span>
                </div>

                <div class="media-comment" style="">
                    <button class="btn btn-link">
                        <i class="fa fa-comments-o"></i> 10 Comments
                    </button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal1">Candidati</button>
                </div>
                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Conferma candidatura</h4>
                            </div>
                            <form action="aggiungiCandidaturaControl" method="post">
                            <div class="modal-body">Inserisci una descrizione per candidarti
                                <textarea name="descrizione" rows="3" class="form-control" placeholder="Descrizione.."></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-success">Conferma</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="row col-md-12 col-sm-12 card contenitore" style="margin-left: 0; display: none">

                    <div class="row col-md-12 col-sm-12 comment-body" style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                        <div class="col-md-1 col-sm-1 media-left" style="margin-top: 1%">
                            <a href="#">
                                <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                            </a>
                        </div>
                        <div class="media-heading">
                            <h4 class="title">Scott White</h4>
                            <h5 class="timeing">20 mins ago</h5>
                        </div>
                        <div class="media-content">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate.</div>
                    </div>
                    <div class="row col-md-12 col-sm-12 comment-body" style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                        <div class="col-md-1 col-sm-1 media-left" style="margin-top: 1%">
                            <a href="#">
                                <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                            </a>
                        </div>
                        <div class="media-heading">
                            <h4 class="title">Scott White</h4>
                            <h5 class="timeing">20 mins ago</h5>
                        </div>
                        <div class="media-content">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate.</div>
                    </div>
                    <div class="col-md-12 form-commento">
                        <form action="commentaAnnuncioControl" method="post">
                        <div class="col-md-10 input-comment">
                              <input type="text" class="form-control" placeholder="Scrivi un commento..." name="commento">
                            </div>
                            <div class="col-md-2 btn-comment">
                                <button type="submit" class="btn btn-info">Commenta</button>
                            </div>
                    </div>
                    </form>

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

</body>

</html>
