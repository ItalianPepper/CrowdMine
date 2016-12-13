<!DOCTYPE html>
<html>
<head>
    <title>Flat Admin V.3 - Free flat-design bootstrap administrator templates</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\rating.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">

    <style>
        div.section .profile {
            margin-bottom: 0px;
        }

    </style>


</head>
<body>
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
                    <a href="../index.html">
                        <div class="icon">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <div class="title">Dashboard</div>
                    </a>
                </li>
                <li class="@@menu.messaging">
                    <a href="../messaging.html">
                        <div class="icon">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                        </div>
                        <div class="title">Messaging</div>
                    </a>
                </li>
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="icon">
                            <i class="fa fa-cube" aria-hidden="true"></i>
                        </div>
                        <div class="title">UI Kits</div>
                    </a>
                    <div class="dropdown-menu">
                        <ul>
                            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> UI Kits</li>
                            <li><a href="../uikits/customize.html">Customize</a></li>
                            <li><a href="../uikits/components.html">Components</a></li>
                            <li><a href="../uikits/card.html">Card</a></li>
                            <li><a href="../uikits/form.html">Form</a></li>
                            <li><a href="../uikits/table.html">Table</a></li>
                            <li><a href="../uikits/icons.html">Icons</a></li>
                            <li class="line"></li>
                            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Advanced Components</li>
                            <li><a href="../uikits/pricing-table.html">Pricing Table</a></li>
                            <!-- <li><a href="../uikits/timeline.html">Timeline</a></li> -->
                            <li><a href="../uikits/chart.html">Chart</a></li>
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
                            <li><a href="../pages/form.html">Form</a></li>
                            <li><a href="../pages/profile.html">Profile</a></li>
                            <li><a href="../pages/search.html">Search</a></li>
                            <li class="line"></li>
                            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Landing</li>
                            <!-- <li><a href="../pages/landing.html">Landing</a></li> -->
                            <li><a href="../pages/login.html">Login</a></li>
                            <li><a href="../pages/register.html">Register</a></li>
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
                            <a class="navbar-brand" href="#"><span class="highlight">Flat v3</span> Admin</a>
                        </li>
                        <li>
                            <button type="button" class="navbar-toggle">
                                <img class="profile-img" src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                            </button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-left">
                        <li class="navbar-title">Profile</li>
                        <li class="navbar-search hidden-sm">
                            <input id="search" type="text" placeholder="Search..">
                            <button class="btn-search"><i class="fa fa-search"></i></button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown notification">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div>
                                <div class="title">New Orders</div>
                                <div class="count">0</div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li class="dropdown-header">Ordering</li>
                                    <li class="dropdown-empty">No New Ordered</li>
                                    <li class="dropdown-footer">
                                        <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
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
                            <a href="/html/pages/profile.html" class="dropdown-toggle" data-toggle="dropdown">
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body app-heading">
                        <img class="profile-img" src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                        <div class="app-title">
                            <div class="title"><span class="highlight">Scott White</span></div>
                            <div class="description">Frontend Developer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-tab">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li role="tab1" class="active">
                                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Profilo</a>
                            </li>
                            <li role="tab2">
                                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Annunci</a>
                            </li>
                            <li role="tab3">
                                <a href="#tab3" id="feedback-tab-3" aria-controls="tab3" role="tab" data-toggle="tab" id="feedback-tab">Feedback</a>
                            </li>
                            <li role="tab4">
                                <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Statistiche</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title profile">
                                            <i class="icon fa fa-user" aria-hidden="true"></i>
                                            Dati anagrafici
                                        </div>


                                        <div class="panel panel-default" style="border: none;box-shadow: none;">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 simple-row">
                                                        Nome
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 simple-row">
                                                        Scott
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Cognome
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        White
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Professione
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        Web Designer
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Data di nascita
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        22/04/1989
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Localit&agrave;
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        Fisciano
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        CAP
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        84048
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Partita Iva
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        12345678912
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Sito Web
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        www.fakesite.com
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section">
                                        <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i>
                                            Categorie
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse5">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Macrocategorie
                                                    </h4>
                                                </div>
                                            </a>
                                            <div id="profile-collapse5" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-xs-12 simple-row">
                                                                <span class="label label-primary">Informatica</span>
                                                                <span class="label label-success">Graphic Design</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse6">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Microcategorie
                                                    </h4>
                                                </div>
                                            </a>
                                            <div id="profile-collapse6" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-xs-12 simple-row">
                                                                <span class="label label-default">Informatica</span>
                                                                <span class="label label-info">Php</span>
                                                                <span class="label label-warning">Javascript</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-xs-12 overlined-row">
                                                                <span class="label label-default">Graphic Design</span>
                                                                <span
                                                                    class="label label-danger">Adobe Illustrator</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nullaip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nullaip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla
                        </div>
                        <!--Feedback-->
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="panel panel-default compact-panel">
                                    <a id="feedback-collapse-panel" class="panel-default collapse-title"
                                       data-toggle="collapse"
                                       href="#feedback-collapse">
                                        <div class="panel-heading">
                                            <h4 class="media-heading">
                                                Inserisci Feedback
                                            </h4>
                                            <p>Clicca qui per inserire un feedback</p>
                                        </div>
                                    </a>
                                    <div id="feedback-collapse" class="panel-collapse collapse">
                                        <form action="inserisciFeedback" method="post">
                                            <div class="panel-body">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xs-12 simple-row">
                                                            <div class="section">
                                                                <div class="section-title">
                                                                    Your user name
                                                                </div>
                                                                <div class="section-body __indent">
                                                                    <img src="http://placehold.it/100x100"
                                                                         class="img-responsive">
                                                                </div>

                                                                <div class="section-title">
                                                                    Rating
                                                                </div>
                                                                <div class="section-body">
                                                                    <div class="rating">
                                                                        <input type="radio" id="star5" name="rating"
                                                                               value="5"/><label
                                                                            class="full" for="star5"
                                                                            title="Awesome - 5 stars"></label>
                                                                        <input type="radio" id="star4half" name="rating"
                                                                               value="4.5"/><label
                                                                            class="half" for="star4half"
                                                                            title="Pretty good - 4.5 stars"></label>
                                                                        <input type="radio" id="star4" name="rating"
                                                                               value="4"/><label
                                                                            class="full" for="star4"
                                                                            title="Pretty good - 4 stars"></label>
                                                                        <input type="radio" id="star3half" name="rating"
                                                                               value="3.5"/><label
                                                                            class="half" for="star3half"
                                                                            title="Meh - 3.5 stars"></label>
                                                                        <input type="radio" id="star3" name="rating"
                                                                               value="3"/><label
                                                                            class="full" for="star3"
                                                                            title="Meh - 3 stars"></label>
                                                                        <input type="radio" id="star2half" name="rating"
                                                                               value="2.5"/><label
                                                                            class="half" for="star2half"
                                                                            title="Kinda bad - 2.5 stars"></label>
                                                                        <input type="radio" id="star2" name="rating"
                                                                               value="2"/><label
                                                                            class="full" for="star2"
                                                                            title="Kinda bad - 2 stars"></label>
                                                                        <input type="radio" id="star1half" name="rating"
                                                                               value="1.5"/><label
                                                                            class="half" for="star1half"
                                                                            title="Meh - 1.5 stars"></label>
                                                                        <input type="radio" id="star1" name="rating"
                                                                               value="1"/><label
                                                                            class="full" for="star1"
                                                                            title="Sucks big time - 1 star"></label>
                                                                        <input type="radio" id="starhalf" name="rating"
                                                                               value="0.5"/><label
                                                                            class="half" for="starhalf"
                                                                            title="Sucks big time - 0.5 stars"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-xs-12 simple-row">
                                                            <input name="feedback-name" type="text" class="form-control"
                                                                   required id="feedback-title"

                                                                   placeholder="Inserisci il titolo del feedback">
                                                            <textarea name="feedback-textArea" rows="3"
                                                                      class="form-control" required
                                                                      id="feedback-textarea"
                                                                      placeholder="Descrizione"></textarea>
                                                            <button type="submit" class="btn btn-success"
                                                                    id="button-add-feedback">Inserisci Feeedback
                                                            </button>

                                                            <div class="alert alert-danger  alert-dismissible"
                                                                 role="alert"
                                                                 id="feedback-erros" style="display: none">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- out of form -->
                            <div class="row" style="margin-top: 3%">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="media social-post">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
                                                </a>
                                            </div>
                                            <div class="section">
                                                <div class="section-body">
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4 class="title">Scott White</h4>
                                                        </div>
                                                        <div class="rating-content" onclick="return false;">
                                                            <div class="rating">
                                                                <input type="radio" id="star5" name="rating0"
                                                                       value="5"/><label
                                                                    class="full" for="star5"
                                                                    title="Awesome - 5 stars"></label>
                                                                <input type="radio" id="star4half" name="rating0"
                                                                       value="4.5"/><label
                                                                    class="half" for="star4half"
                                                                    title="Pretty good - 4.5 stars"></label>
                                                                <input type="radio" id="star4" name="rating0"
                                                                       value="4"/><label
                                                                    class="full" for="star4"
                                                                    title="Pretty good - 4 stars"></label>
                                                                <input type="radio" id="star3half" name="rating0"
                                                                       value="3.5" checked/><label
                                                                    class="half" for="star3half"
                                                                    title="Meh - 3.5 stars"></label>
                                                                <input type="radio" id="star3" name="rating0"
                                                                       value="3"/><label
                                                                    class="full" for="star3"
                                                                    title="Meh - 3 stars"></label>
                                                                <input type="radio" id="star2half" name="rating0"
                                                                       value="2.5"/><label
                                                                    class="half" for="star2half"
                                                                    title="Kinda bad - 2.5 stars"></label>
                                                                <input type="radio" id="star2" name="rating0"
                                                                       value="2"/><label
                                                                    class="full" for="star2"
                                                                    title="Kinda bad - 2 stars"></label>
                                                                <input type="radio" id="star1half" name="rating0"
                                                                       value="1.5"/><label
                                                                    class="half" for="star1half"
                                                                    title="Meh - 1.5 stars"></label>
                                                                <input type="radio" id="star1" name="rating0"
                                                                       value="1"/><label
                                                                    class="full" for="star1"
                                                                    title="Sucks big time - 1 star"></label>
                                                                <input type="radio" id="starhalf" name="rating0"
                                                                       value="0.5"/><label
                                                                    class="half" for="starhalf"
                                                                    title="Sucks big time - 0.5 stars"></label>
                                                            </div>
                                                        </div>
                                                        <h5 style="margin-top: 0px"><b>Feedback Title</b></h5>
                                                        <div class="media-content">
                                                            Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                            elit. Aenean commodo
                                                            ligula
                                                            eget dolor. Aenean massa. Cum sociis natoque penatibus
                                                            et magnis dis
                                                            parturient
                                                            montes, nascetur ridiculus mus. Donec quam felis,
                                                            ultricies nec,
                                                            pellentesque
                                                            eu, pretium quis, sem. Nulla consequat massa quis enim.
                                                            Donec.
                                                        </div>
                                                        <div class="media-action">
                                                            <button class="btn btn-link"><i
                                                                    class="fa fa-exclamation-circle"></i>
                                                                Segnala
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 3%">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="section">
                                                    <div class="media social-post">
                                                        <div class="media-left">
                                                            <a href="#">
                                                                <img
                                                                    src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
                                                            </a>
                                                        </div>
                                                        <div class="section">
                                                            <div class="section-body">
                                                                <div class="media-body">
                                                                    <div class="media-heading">
                                                                        <h4 class="title">Scott White</h4>
                                                                    </div>
                                                                    <div class="rating-content" onclick="return false;">
                                                                        <div class="rating">
                                                                            <input type="radio" id="star5"
                                                                                   name="rating1"
                                                                                   value="5"/><label
                                                                                class="full" for="star5"
                                                                                title="Awesome - 5 stars"></label>
                                                                            <input type="radio" id="star4half"
                                                                                   name="rating1"
                                                                                   value="4.5"/><label
                                                                                class="half" for="star4half"
                                                                                title="Pretty good - 4.5 stars"></label>
                                                                            <input type="radio" id="star4"
                                                                                   name="rating1"
                                                                                   value="4"/><label
                                                                                class="full" for="star4"
                                                                                title="Pretty good - 4 stars"></label>
                                                                            <input type="radio" id="star3half"
                                                                                   name="rating1"
                                                                                   value="3.5" checked/><label
                                                                                class="half" for="star3half"
                                                                                title="Meh - 3.5 stars"></label>
                                                                            <input type="radio" id="star3"
                                                                                   name="rating1"
                                                                                   value="3"/><label
                                                                                class="full" for="star3"
                                                                                title="Meh - 3 stars"></label>
                                                                            <input type="radio" id="star2half"
                                                                                   name="rating1"
                                                                                   value="2.5"/><label
                                                                                class="half" for="star2half"
                                                                                title="Kinda bad - 2.5 stars"></label>
                                                                            <input type="radio" id="star2"
                                                                                   name="rating1"
                                                                                   value="2"/><label
                                                                                class="full" for="star2"
                                                                                title="Kinda bad - 2 stars"></label>
                                                                            <input type="radio" id="star1half"
                                                                                   name="rating1"
                                                                                   value="1.5"/><label
                                                                                class="half" for="star1half"
                                                                                title="Meh - 1.5 stars"></label>
                                                                            <input type="radio" id="star1"
                                                                                   name="rating1"
                                                                                   value="1"/><label
                                                                                class="full" for="star1"
                                                                                title="Sucks big time - 1 star"></label>
                                                                            <input type="radio" id="starhalf"
                                                                                   name="rating1"
                                                                                   value="0.5"/><label
                                                                                class="half" for="starhalf"
                                                                                title="Sucks big time - 0.5 stars"></label>
                                                                        </div>
                                                                    </div>
                                                                    <h5 style="margin-top: 0px"><b>Feedback Title</b>
                                                                    </h5>
                                                                    <div class="media-content">
                                                                        Lorem ipsum dolor sit amet, consectetuer
                                                                        adipiscing
                                                                        elit. Aenean commodo
                                                                        ligula
                                                                        eget dolor. Aenean massa. Cum sociis natoque
                                                                        penatibus
                                                                        et magnis dis
                                                                        parturient
                                                                        montes, nascetur ridiculus mus. Donec quam
                                                                        felis,
                                                                        ultricies nec,
                                                                        pellentesque
                                                                        eu, pretium quis, sem. Nulla consequat massa
                                                                        quis enim.
                                                                        Donec.
                                                                    </div>
                                                                    <div class="media-action">
                                                                        <button class="btn btn-link"><i
                                                                                class="fa fa-exclamation-circle"></i>
                                                                            Segnala
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row" style="margin-top: 3%">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="section">
                                                                <div class="media social-post">
                                                                    <div class="media-left">
                                                                        <a href="#">
                                                                            <img
                                                                                src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
                                                                        </a>
                                                                    </div>
                                                                    <div class="section">
                                                                        <div class="section-body">
                                                                            <div class="media-body">
                                                                                <div class="media-heading">
                                                                                    <h4 class="title">Scott White</h4>
                                                                                </div>
                                                                                <div class="rating-content"
                                                                                     onclick="return false;">
                                                                                    <div class="rating">
                                                                                        <input type="radio" id="star5"
                                                                                               name="rating2"
                                                                                               value="5"/><label
                                                                                            class="full" for="star5"
                                                                                            title="Awesome - 5 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star4half"
                                                                                               name="rating2"
                                                                                               value="4.5"/><label
                                                                                            class="half" for="star4half"
                                                                                            title="Pretty good - 4.5 stars"></label>
                                                                                        <input type="radio" id="star4"
                                                                                               name="rating2"
                                                                                               value="4"/><label
                                                                                            class="full" for="star4"
                                                                                            title="Pretty good - 4 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star3half"
                                                                                               name="rating2"
                                                                                               value="3.5"
                                                                                               checked/><label
                                                                                            class="half" for="star3half"
                                                                                            title="Meh - 3.5 stars"></label>
                                                                                        <input type="radio" id="star3"
                                                                                               name="rating2"
                                                                                               value="3"/><label
                                                                                            class="full" for="star3"
                                                                                            title="Meh - 3 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star2half"
                                                                                               name="rating2"
                                                                                               value="2.5"/><label
                                                                                            class="half" for="star2half"
                                                                                            title="Kinda bad - 2.5 stars"></label>
                                                                                        <input type="radio" id="star2"
                                                                                               name="rating2"
                                                                                               value="2"/><label
                                                                                            class="full" for="star2"
                                                                                            title="Kinda bad - 2 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star1half"
                                                                                               name="rating2"
                                                                                               value="1.5"/><label
                                                                                            class="half" for="star1half"
                                                                                            title="Meh - 1.5 stars"></label>
                                                                                        <input type="radio" id="star1"
                                                                                               name="rating2"
                                                                                               value="1"/><label
                                                                                            class="full" for="star1"
                                                                                            title="Sucks big time - 1 star"></label>
                                                                                        <input type="radio"
                                                                                               id="starhalf"
                                                                                               name="rating2"
                                                                                               value="0.5"/><label
                                                                                            class="half" for="starhalf"
                                                                                            title="Sucks big time - 0.5 stars"></label>
                                                                                    </div>
                                                                                </div>
                                                                                <h5 style="margin-top: 0px"><b>Feedback
                                                                                        Title</b></h5>
                                                                                <div class="media-content">
                                                                                    Lorem ipsum dolor sit amet,
                                                                                    consectetuer adipiscing
                                                                                    elit. Aenean commodo
                                                                                    ligula
                                                                                    eget dolor. Aenean massa. Cum sociis
                                                                                    natoque penatibus
                                                                                    et magnis dis
                                                                                    parturient
                                                                                    montes, nascetur ridiculus mus.
                                                                                    Donec quam felis,
                                                                                    ultricies nec,
                                                                                    pellentesque
                                                                                    eu, pretium quis, sem. Nulla
                                                                                    consequat massa quis enim.
                                                                                    Donec.
                                                                                </div>
                                                                                <div class="media-action">
                                                                                    <button class="btn btn-link"><i
                                                                                            class="fa fa-exclamation-circle"></i>
                                                                                        Segnala
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Statistiche-->
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="section">
                                        <div class="section-title">
                                            Your user name
                                        </div>
                                        <div class="section-body __indent">
                                            <img src="http://placehold.it/100x100"
                                                 class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Statistica Feedback Totale</div>
                                        <div class="section-body">
                                            <div class="ct-chart-pie ct-perfect-fourth"></div>
                                            <div class="col-sm-4">
                                                <ul class="chart-label">
                                                    <li class="ct-label ct-series-a">Feedback
                                                        positivi
                                                    </li>
                                                    <li class="ct-label ct-series-b">Feedback
                                                        negativi
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Micro Categoria</th>
                                                        <th>Feedback positivi</th>
                                                        <th>Feedback Negativi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackCheckUtils.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackList.js"></script>

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
