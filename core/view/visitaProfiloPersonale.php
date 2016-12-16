<!DOCTYPE html>
<html>
<?php
include_once MODEL_DIR."Utente.php";
include_once MODEL_DIR.'MacroCategoria.php';
include_once MODEL_DIR.'MicroCategoria.php';
include_once CONTROL_DIR.'SelezionaMacroControl.php';
include_once MODEL_DIR  . 'MicroListObject.php';
include_once CONTROL_DIR  .  'SelezionaMicroControl.php';


if(isset($_SESSSION['user'])){
    $utente = $_SESSION['user'];
}
else{
    $utente = new Utente("empty", "empty", "empty", "empty", "empty", "empty", "empty", "empty", "empty", "empty", "empty");
    //header("/home.php");
}

if (isset($_SESSION["macro"])){
    $macroList = unserialize($_SESSION['macro']);
    unset($_SESSION["macro"]);
} else {
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "macro non settata";
    header("Location: " . DOMINIO_SITO);
}

if (isset($_SESSION["macroUtente"])){
    $macroListUtente = unserialize($_SESSION['macroUtente']);
    unset($_SESSION["macroUtente"]);
} else {
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "macro Utente non settata";
    header("Location: " . DOMINIO_SITO);
}

if (isset($_SESSION["micro"])){
    $microList = unserialize($_SESSION['micro']);
    unset($_SESSION["micro"]);
} else {
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "micro non settata";
    header("Location: " . DOMINIO_SITO);
}

if (isset($_SESSION["microUtente"])){
    $microListUtente = unserialize($_SESSION['microUtente']);
    unset($_SESSION["microUtente"]);
} else {
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "micro Utente non settata";
    header("Location: " . DOMINIO_SITO);
}
?>

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
                            <div class="title"><span class="highlight"><?php echo $utente->getNome()." ".$utente->getCognome()?></span></div>
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
                                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Privacy e sicurezza</a>
                            </li>
                            <li role="tab3">
                                <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Annunci e offerte di lavoro</a>
                            </li>
                            <li role="tab4">
                                <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Segnalazioni</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding tab-content">

                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i>
                                            Elementi base
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#profile-collapse1">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Indirizzi Email
                                                    </h4>
                                                    <p>Aggiungi o rimuovi indirizzi email</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row" id="edit-mail">
                                                            <div class="col-lg-2 col-md-2 col-xs-3 simple-row">
                                                                Email
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-9 simple-row">
                                                                <?php echo $utente->getEmail();?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a onclick="$('#edit-mail').toggleWith('#edit-mail-input')">Modifica</a></li>
                                                                    <li><a href="#">Rimuovi</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="edit-mail-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-envelope" aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" class="form-control" placeholder="Nuova Email" aria-describedby="basic-addon1" value="fakemail@gmail.com">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#edit-mail-input').toggleWith('#edit-mail')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#profile-collapse2">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Numero di telefono
                                                    </h4>
                                                    <p>Modifica numero di telefono</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row" id="edit-tel">
                                                            <div class="col-lg-2 col-md-2 col-xs-3 simple-row">
                                                                Tel.
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-9 simple-row">
                                                                <?php echo $utente->getTelefono();?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a onclick="$('#edit-tel').toggleWith('#edit-tel-input')">Modifica</a></li>
                                                                    <li><a href="#">Rimuovi</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="edit-tel-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-phone" aria-hidden="true"></i>
																			</span>
                                                                        <input id="numberTelephoneChange" type="text" class="form-control" placeholder="Nuovo Numero" aria-describedby="basic-addon1" value="<?php echo $utente->getTelefono()?>">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right" >Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#edit-tel-input').toggleWith('#edit-tel')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#profile-collapse3">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Cambia password
                                                    </h4>
                                                    <p>Segli un'unica password per proteggere i tuoi dati</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row" id="edit-mail">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 simple-row">
                                                                La nuova password deve essere composta da almeno 8 caratteri, deve contenere maiuscole e minuscole, e deve essere presente almeno un numero.
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <form action="modificaPassword" method="post" class="form form-horizontal" id="tel-input">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-lock" aria-hidden="true"></i>
																			</span>
                                                                        <input name="PasswordAttuale" type="text" class="form-control" placeholder="Password attuale" aria-describedby="basic-addon1" value="">
                                                                    </div>
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-lock" aria-hidden="true"></i>
																			</span>
                                                                        <input name="NuovaPassword" type="text" class="form-control" placeholder="Nuova Password" aria-describedby="basic-addon1" value="">
                                                                    </div>
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-lock" aria-hidden="true"></i>
																			</span>
                                                                        <input name="ConfermaNuovaPassword" type="text" class="form-control" placeholder="Conferma nuova Password" aria-describedby="basic-addon1" value="">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#profile-collapse4">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Dati anagrafici
                                                    </h4>
                                                    <p>Visualizza e modifica i dati anagrafici del tuo account</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse4" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row" id="edit-name">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 simple-row">
                                                                Nome
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 simple-row">
                                                                <?php echo $utente->getNome() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a onclick="$('#edit-name').toggleWith('#edit-name-input')">Modifica</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="edit-name-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-user" aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" class="form-control" placeholder="Nuovo Nome" aria-describedby="basic-addon1" value="<?php echo $utente->getNome() ?>">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#edit-name-input').toggleWith('#edit-name')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-surname">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Cognome
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php echo $utente->getCognome() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a onclick="$('#edit-surname').toggleWith('#edit-surname-input')">Modifica</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="edit-surname-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-user" aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" class="form-control" placeholder="Nuovo Cognome" aria-describedby="basic-addon1" value="<?php echo $utente->getCognome() ?>">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#edit-surname-input').toggleWith('#edit-surname')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-birthdate">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Data di nascita
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php echo $utente->getDataNascita() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a onclick="$('#edit-birthdate').toggleWith('#edit-birthdate-input')">Modifica</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="edit-birthdate-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-calendar" aria-hidden="true"></i>
																			</span>
                                                                        <input type="date" class="form-control" aria-describedby="basic-addon1" value="<?php echo $utente->getDataNascita() ?>">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#edit-birthdate-input').toggleWith('#edit-birthdate')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-location">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Localit&agrave;
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php echo $utente->getCitta() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a onclick="$('#edit-location').toggleWith('#edit-location-input')">Modifica</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="edit-location-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-map-marker" aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" class="form-control" placeholder="Nuova Localit&agrave;" aria-describedby="basic-addon1" value="<?php echo $utente->getCitta() ?>">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#edit-location-input').toggleWith('#edit-location')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section">
                                        <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i>
                                            Gestione categorie
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#profile-collapse5">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Visualizza, aggiungi macrocategorie
                                                    </h4>
                                                    <p>Visualizza, aggiungi ed elimina le macrocategorie di competenza</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse5" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php
                                                        foreach($macroListUtente as $macro) { ?>
                                                            <div class="row">
                                                                <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                    <span class="label label-primary"><?php echo $macro->getNome() ?></span>
                                                                </div>

                                                                <div class="dropdown corner-dropdown">
                                                                    <button class="btn btn-default dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                        <li><a href="<?php echo "rimuoviMacroUtenteControl?idMacro=".$macro->getId() ?>">Rimuovi</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <!--<div class="row">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 simple-row">
                                                                <span class="label label-primary">Informatica</span>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a href="#">Rimuovi</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <span class="label label-success">Graphic Design</span>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a href="#">Rimuovi</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
-->
                                                        <div class="row" id="add-macro">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <a onclick="$('#add-macro').toggleWith('#macro-input')" >
                                                                    <i class="fa fa-plus"></i>
                                                                    Aggiungi macrocategoria
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" action="aggiungiMacroUtente" method="post" id="macro-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">

                                                                    <div class="input-group">
                                                        	            <span class="input-group-addon" id="basic-addon1">
																            <i class="fa fa-tag" aria-hidden="true"></i>
															            </span>

                                                                        <select class="form-control select2" name="getIdMacro" form="macro-input">
                                                                            <?php
                                                                            foreach ($macroList as $macro) {
                                                                                if(!array_search($macro, $macroListUtente)) { ?>
                                                                                    <option value="<?php echo $macro->getId() ?>"><?php echo $macro->getNome() ?></option>
                                                                                <?php   }
                                                                            } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#macro-input').toggleWith('#add-macro')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#profile-collapse6">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Visualizza, aggiungi microcategorie
                                                    </h4>
                                                    <p>Visualizza, aggiungi ed elimina le microcategorie di competenza</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse6" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php
                                                        foreach($microListUtente as $micro) {?>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-9 col-xs-12 overlined-row">
                                                                <span class="label label-default"><?php echo $micro->getMacroCategoria()->getNome() ?></span>
                                                                <span class="label label-info"><?php echo $micro->getMicroCategoria()->getNome() ?></span>
                                                            </div>
                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a href="<?php echo "rimuoviMicroUtenteControl?idMacro=".$micro->getMicroCategoria()->getId()?>">Rimuovi</a></li>
                                                                </ul>
                                                            </div>
                                                        </div> <?php }?>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-9 col-xs-12 overlined-row">
                                                                <span class="label label-default">Informatica</span>
                                                                <span class="label label-warning">Javascript</span>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a href="#">Rimuovi</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="row" id="add-micro">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <a onclick="$('#add-micro').toggleWith('#micro-input')" >
                                                                    <i class="fa fa-plus"></i>
                                                                    Aggiungi microcategoria
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="micro-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-tag" aria-hidden="true"></i>
																			</span>
                                                                        <select class="form-control select2">
                                                                            <option value="AL">Informatica</option>
                                                                            <option value="WY">Graphic Design</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-tags" aria-hidden="true"></i>
																			</span>
                                                                        <select class="form-control select2">
                                                                            <option value="AL">Php</option>
                                                                            <option value="WY">Javascript</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#micro-input').toggleWith('#add-micro')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
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
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#privacy-collapse1">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Blocca Utente
                                                    </h4>
                                                    <p>Vedi l'elenco ed effettua i cambiamenti che desideri apportare</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 simple-row">

                                                                <div class="media social-post profile-block">
                                                                    <div class="media-left">
                                                                        <a href="#">
                                                                            <img src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="media-heading">
                                                                            <h4 class="title"><?php  ?></h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a href="#">Sblocca</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="row" id="add-userblock">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <a onclick="$('#add-userblock').toggleWith('#userblock-input')" >
                                                                    <i class="fa fa-plus"></i>
                                                                    Blocca nuovo utente
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="userblock-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-user" aria-hidden="true"></i>
																			</span>
                                                                        <select class="form-control select2">
                                                                            <option value="AL">Fabiano Pecorelli</option>
                                                                            <option value="WY">Antonio Luca D'avanzo</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#userblock-input').toggleWith('#add-userblock')">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#privacy-collapse2">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Visibilit&agrave; informazioni personali
                                                    </h4>
                                                    <p>Scegli quali informazioni del tuo profilo vuoi rendere visibile agli altri utenti</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 simple-row">
                                                                Indirizzi Email
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-xs-8 simple-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox1">
                                                                    <label for="checkbox1">
                                                                        Blocca
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Numeri di telefono
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-xs-8 overlined-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox2">
                                                                    <label for="checkbox2">
                                                                        blocca
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Dati anagrafici
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-xs-8 overlined-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox3">
                                                                    <label for="checkbox3">
                                                                        blocca
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#privacy-collapse3">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Condivisione di dati con terze parti
                                                    </h4>
                                                    <p>Scegli se possiamo condividere le informazioni di base del tuo profilo con terze parti</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-xs-8 simple-row">
                                                                Acconsenti al trattamento di dati personali da terze parti?
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-xs-4 simple-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox4">
                                                                    <label for="checkbox4">
                                                                        Acconsento
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#privacy-collapse4">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Processo di verifica in due passaggi
                                                    </h4>
                                                    <p>Attiva questa funzionalit&agrave; per una maggiore protezione nel tuo account</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse4" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-xs-8 simple-row">
                                                                Processo di verifica in due passaggi
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-xs-4 simple-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox4">
                                                                    <label for="checkbox4">
                                                                        Attivato
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#privacy-collapse5">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Cancellazione Account
                                                    </h4>
                                                    <p>Se lo desideri, puoi eliminare il tuo account dal sistema</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse5" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row" id="edit-mail">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 simple-row">
                                                                Eseguendo questa procedura il tuo account sarà rimosso da CrowdMine.
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <form action="cancellaAccount" class="form form-horizontal" id="tel-input">
                                                                <div class="col-lg-12 col-md-12 col-xs-12 simple-row">
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-danger pull-right">Cancella Account</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nullaip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nullaip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nullaip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nullaip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla
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
    /*toggle element and toggle self element*/
    $.fn.toggleWith = function(id) {
        $(id).toggle('fast');
        $(this).toggle('fast');
    };
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



</body>
</html>