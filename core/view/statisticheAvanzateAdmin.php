<!DOCTYPE html>
<html>
<head>
    <title>CrowdMine</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\rating.css">

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
                        <li class="navbar-title">Dashboard</li>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-tab">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li role="tab1" class="active">
                                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Generale</a>
                            </li>
                            <li role="tab2">
                                <a href="#tab2" aria-controls="tab1" role="tab" data-toggle="tab">Annunci</a>
                            </li>
                            <li role="tab3">
                                <a href="#tab3" aria-controls="tab1" role="tab" data-toggle="tab">Utenti</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1"><!--Inizio tab1-->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Generale</div>
                                        <div class="section-body">
                                            <div>
                                                <canvas id="graficoGeneraleAnnunci"/>
                                            </div>
                                            <br>
                                            <div>
                                                Numero di Annunci pubblicati oggi:<span id="adsNumber"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="section">
                                                <div class="section-title">Macro Categorie</div>
                                                <div class="section-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <select id="selectMacro" style="width:100%"
                                                                    class="select2">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="fromdatemacro">Da</label>
                                                            <input id="fromdatemacro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="atdatemacro">A</label>
                                                            <input id="atdatemacro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <button id="submitMacro"
                                                                        class="btn btn-primary">Mostra Risultati
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div>
                                                                <canvas id="macroCategoriaGrafico"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="section">
                                                <div class="section-title">Micro Categorie</div>
                                                <div class="section-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <select id="selectMicro" style="width:100%"
                                                                    class="select2">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="fromdatemicro">Da</label>
                                                            <input id="fromdatemicro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="atdatemicro">A</label>
                                                            <input id="atdatemicro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <button id="submitMicro"
                                                                        class="btn btn-primary">Mostra Risultati
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div>
                                                                <canvas id="microCategoriaGrafico"/>
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
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Macro Categorie Preferite Dagli Utenti</div>
                                        <div class="section-body">
                                            <table id="macroUtenti" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Macro Categoria</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Macro Categorie Offerte Degli Annunci</div>
                                        <div class="section-body">
                                            <table id="macroAnnunci" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Macro Categoria</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12col-xs-12">
                                    <div class="section">
                                        <div class="section-title"><p id="labelMacro"></p></div>
                                        <div class="section-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div id="container-micro">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <nav id="pagination">
                                                </nav>
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
</body>

<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
<script src="<?php echo STYLE_DIR; ?>assets\js\Chart.min.js"></script>

<script type="text/javascript">


    //caricamento Generale
    $("#tab1").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabGenerale",
            dataType: "json",
            data: {option:"graphics"},
            success: function(response){
                var dates = $.map(response, function(value,key){return key});
                var values = $.map(response, function(value, key){return value});
                drawGeneralChart(dates,values);
            }
        });
    });

    $("#tab1").ready(function () {
        $.ajax({
            type: "POST",
            url:"tabGenerale",
            dataType: "json",
            data:  {option:"adsNumber"},
            success: function(response){
                $("#adsNumber").text(" "+response);
            }
        })
    });

///////////////////////////////////////////////////////////////// TAB 2 ///////////////////////////////////////////////
    $("#tab2").ready(function(){
        $("#submitMacro").attr("disabled", "true");
        $("#submitMicro").attr("disabled", "true");
    });


    $("#tab2").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabAnnunci",
            dataType: "json",
            data: {option:"selectMacro"},
            success: function (response) {
                var arrayMacroElements = $.map(response, function (el) {
                    return el;
                });
                appendMacroElements(arrayMacroElements)
            }
        })
    });

    function appendMacroElements(arrayMacroElements) {
      $.each(arrayMacroElements, function (i,item){
          $("#selectMacro").append($("<option>").text(item).attr("value",item));
      });
    }

    $("#tab2").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabAnnunci",
            dataType: "json",
            data: {option:"selectMicro"},
            success: function (response) {
                var arrayMicroElements = $.map(response, function (el) {
                    return el;
                });
                appendMicroElements(arrayMicroElements);
            }
        });
    });

    function appendMicroElements(arrayMicroElements) {
        $.each(arrayMicroElements, function (i,item){
            $("#selectMicro").append($("<option>").text(item).attr("value",item));
        });
    }

    $("#submitMacro").click(function () {

        var from = $("#fromdatemacro").val();
        var at = $("#atdatemacro").val();

        $.ajax({
            type: "POST",
            url: "tabAnnunci",
            dataType: "json",
            data: {fromdatemacro:from, atdatemacro:at},
            success: function(response){
                var dates = $.map(response, function(value,key){return key});
                var values = $.map(response, function(value, key){return value});
                drawMacroDateChart(dates,values);
            }
        });
    });


    $("#submitMicro").click(function () {

        var from = $("#fromdatemicro").val();
        var at = $("#atdatemicro").val();

        $.ajax({
            type: "POST",
            url: "tabAnnunci", //controller della pagina
            dataType: "json",
            data: {fromdatemicro:from, atdatemicro:at},
            success: function(response){
                    var dates = $.map(response, function(value,key){return key});
                    var values = $.map(response, function(value, key){return value});
                drawMicroDateChart(dates,values);
            }
        });
    });


    $("#fromdatemacro,#atdatemacro").change(function () {

        //funzione da attivare ogni qualvolta si seleziona una data.
        var fromDate = $("#fromdatemacro").val();
        var atDate = $("#atdatemacro").val();

        if (fromDate != "" && atDate != "") {
            if (Date.parse(fromDate) > Date.parse(atDate)) {
                $("#submitMacro").attr("disabled", "true");
            } else {
                $("#submitMacro").removeAttr("disabled");
            }
        }
    });


    $("#fromdatemicro,#atdatemicro").change(function () {

        //funzione da attivare ogni qualvolta si seleziona una data.
        var fromDate = $("#fromdatemicro").val();
        var atDate = $("#atdatemicro").val();

        if (fromDate != "" && atDate != "" ) {

            if (Date.parse(fromDate) > Date.parse(atDate)) {
                $("#submitMicro").attr("disabled", "true");
            } else {
                $("#submitMicro").removeAttr("disabled");
            }
        }

    });
/////////////////////////////////////////////TAB 3////////////////////////////////////////////////////////

    $("#tab3").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data: {macrocategorie:"utenti"},
            success: function (response) {
                var arrayMacroUtenti = $.map(response, function (el) {
                    return el;
                });
                appendMacroUtentiToTable(arrayMacroUtenti);
            }
        });
    });

    function appendMacroUtentiToTable(arrayMacroUtenti) {
        $.each(arrayMacroUtenti, function (i,el) {
            $("#macroUtenti").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>")
                        .attr("scope", "row")
                        .text(i+1))
                    .append($("<td>")
                        .append($("<button>")
                            .attr("id",el)
                            .attr("type", "button")
                            .attr("class", "btn btn-info")
                            .attr("onclick", "bufferingMicroUtentiTable(this,1)")
                            .text(el)
                        )
                    )
                );
        });

    }

    function bufferingMicroUtentiTable(buttonSelected,initialPage) {

        var nameButton = buttonSelected.id;
        var type="Utenti";
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{macroCategoriaUtenti: nameButton,initpage:initialPage},
            success: function (response) {
                var arrayMicro = $.map(response, function (el) {
                    return el;
                });

                appendMicroToTable(type,nameButton, arrayMicro);
            }
        });
    }

    $("#tab3").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data: {macrocategorie:"annunci"},
            success: function (response) {
                var arrayMacroAnnunci = $.map(response, function (el) {
                    return el;
                });
                appendMacroAnnunciToTable(arrayMacroAnnunci);
            }
        });
    });

    function appendMacroAnnunciToTable(arrayMacroAnnunci) {
        $.each(arrayMacroAnnunci, function (i,el) {
            $("#macroAnnunci").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>")
                        .attr("scope", "row")
                        .text(i+1))
                    .append($("<td>")
                        .append($("<button>")
                            .attr("id",el)
                            .attr("type", "button")
                            .attr("class", "btn btn-info")
                            .attr("onclick", "bufferingMicroAnnunciTable(this,1)")
                            .text(el)
                        )
                    )
                );
        });
    }


    function bufferingMicroAnnunciTable(buttonSelected,initialPage){
        var nameButton = buttonSelected.id;
        var type = "Annunci";
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{macroCategoriaAnnunci:nameButton,initpage:initialPage},
            success: function (response) {
                var arrayMicro = $.map(response, function (el) {
                    return el;
                });

                appendMicroToTable(type,nameButton,arrayMicro);
            }
        });
    }

    function appendMicroToTable(type,nameButton,arrayMicro) {
        var labelMacro = type+" - "+nameButton;
        $("#pagination ul").remove();
        $("#container-micro table").remove();

        $("#container-micro").append($("<table>")
                .attr("id", "micro")
                .attr("class", "datatable table")
                .attr("cellspacing", "0")
                .attr("width", "100%")
            .append($("<thead>"))
            .append($("<tbody>")));

        $("#labelMacro").text(labelMacro);

        $("#micro").find("thead")
            .append($("<tr>")
                .append($("<th></th>").text("#"))
                .append($("<th></th>").text("Micro Categorie")));

        $.each(arrayMicro, function (i,el) {
            $("#micro").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>").text(i+1))
                    .append($("<td>").text(el)
                    )
                );
        });
        pagination(type,nameButton);
    }

    function pagination(type, nameMacro){
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{pagination:"maxPage"},
            success:function (response) {
                var dimensionPaging = response;
                appendingPaging(dimensionPaging,type,nameMacro);
            }
        });
    }

    function appendingPaging(dimensionPaging, type, nameMacro) {

        $("#pagination").append($("<ul>").attr("class", "pagination"));

        $("#pagination ul")
            .append($("<li>")
                .attr("id", "page" + 1)
                .attr("class", "active")
                .attr("onclick", "goToPage(" + "'" + type + "'" + "," + "'" + nameMacro +"'"+ ","+"'"+ 1 +"'" +")")
                .append($("<a>").text(1)));


        for (var i = 2; i < dimensionPaging+1; i++) {
            $("#pagination ul")
                .append($("<li>")
                    .attr("id", "page" + i)
                    .attr("onclick", "goToPage(" + "'" + type + "'" + "," + "'" + nameMacro +"'"+ "," + "'" +i+ "'" + ")")
                    .append($("<a>").text(i)));
        }
    }

    function goToPage(type,nameMacro,numberPage){

        $("#pagination  ul li").each(function(i,el){
            el.removeAttribute("class");
        });

        $("#page"+numberPage).attr("class","active");

        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{type:type, macrocategoria:nameMacro, pagination:numberPage},
            success: function (response) {
            var arrayMicroPage = $.map(response, function (el) {
                return el;
            });
                updatePage(arrayMicroPage)
            }
        });
    }


    function updatePage(arrayMicroPage){
        $("#micro tr").remove();

        $.each(arrayMicroPage, function (i,el) {
            $("#micro").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>").text(i + 1))
                    .append($("<td>").text(el)
                    )
                );
        });
    }

    function drawGeneralChart(dates, values) {

        var ctxGenerale = document.getElementById("graficoGeneraleAnnunci").getContext("2d");

        var generaleData = {
            labels: dates,
            datasets: [
                {
                    label:"Generale",
                    data: values,
                    backgroundColor: "rgba(0, 255, 0, 0.3)",
                    borderColor: "rgba(0, 255, 0, 0.3)",
                    borderWidth: 1
                }
            ]
        };

        var generaleChart = new Chart.Line(ctxGenerale, {
            data: generaleData,
            options: {
                pointHitRadius: 3,
                responsive: true,
                tooltipEvents: [],
                showTooltips: true,
                onAnimationComplete: function () {
                    this.showTooltip(this.segments, true);
                },
                tooltipTemplate: "<%= label %>  -  <%= value %>"
            }

        });
    }


    function drawMacroDateChart(dates, values) {

        var ctxMacro = document.getElementById("macroCategoriaGrafico").getContext("2d");

        var macroData = {
            labels: dates,
            datasets: [
                {
                    label:$("#selectMacro").val(),
                    data: values,
                    backgroundColor: "rgba(255, 0, 0, 0.3)",
                    borderColor: "rgba(255, 0, 0, 0.3)",
                    borderWidth: 1
                }
            ]

        };

        var macroChart = new Chart.Line(ctxMacro, {
            data: macroData,
            options: {
                pointHitRadius: 3,
                responsive: true,
                tooltipEvents: [],
                showTooltips: true,
                onAnimationComplete: function () {
                    this.showTooltip(this.segments, true);
                },
                tooltipTemplate: "<%= label %>  -  <%= value %>"
            }
        });
    }


    function drawMicroDateChart(dates,values) {

        var ctxMicro = document.getElementById("microCategoriaGrafico").getContext("2d");

        var microData = {
            labels: dates,
            datasets: [
                {
                    label: $("#selectMicro").val(),
                    data: values, //dati micro
                    backgroundColor: "rgba(0, 0, 255, 0.3)",
                    borderColor: "rgba(0, 0, 255, 0.3)",
                    borderWidth: 1
                }
            ]
        };

        var microChart = new Chart.Line(ctxMicro, {
            data: microData,
            options: {
                pointHitRadius: 3,
                responsive: true,
                tooltipEvents: [],
                showTooltips: true,
                onAnimationComplete: function () {
                    this.showTooltip(this.segments, true);
                },
                tooltipTemplate: "<%= label %>  -  <%= value %>"
            }
        });
    }
</script>
</html>