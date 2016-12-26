<html>
<head>
        <title>Flat Admin V.3 - Free flat-design bootstrap administrator templates</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR ?>/assets/css/vendor.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR ?>/assets/css/flat-admin.css">

        <!-- Theme -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR ?>/assets/css/theme/blue-sky.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR ?>/assets/css/theme/blue.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR ?>/assets/css/theme/red.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR ?>/assets/css/theme/yellow.css">
        
    </head>
<body>
  <div class="app app-default">

<script type="text/ng-template" id="sidebar-dropdown.tpl.html">
  <div class="dropdown-background">
    <div class="bg"></div>
  </div>
  <div class="dropdown-container">
    {{list}}
  </div>
</script>


<div class="app-container app-full" style="padding-left:0px">
  <nav class="navbar navbar-default" id="navbar" style="padding: 0px; border-width: 0px; ">
  <div class="container-fluid" style="padding: 0px;">
    <div class="navbar-collapse collapse in" style="background: rgba(16, 14, 23, 0.87);">
      <ul class="nav navbar-nav navbar-mobile" style="padding-left: 0px;">
        <!-- Button per far apparire il menu a sinistra su mobile
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        -->
        <li class="logo">
          <img class="img-responsive" style="height: 75%; " src="<?php echo STYLE_DIR ?>/img/Favicon_3.png" />  
          <a class="navbar-brand" href="#"><span class="highlight">Alfredo Fiorillo</span></a>     </li>
        
        <li>
          <button type="button" class="navbar-toggle">
           
            <i class="fa fa-navicon" style="color: white"></i>
          </button>
        </li>
      
        <!--
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        -->
      </ul>
    
      <ul class="nav navbar-nav navbar-left" style="padding-left: 0px;margin-left: 0px;">
        <li class="logo">
                <img class="img-responsive" style="height: 55%; max-width: 90%" src="<?php echo STYLE_DIR ?>/img/Logo_Crowdmine_3.png" />
        </li>  
        <li class="navbar-search hidden-sm" style="margin-left: 0px;">
          <input id="search" type="text" placeholder="Cerca annunci di lavoro.." style="width: 450px; height: 28px">
          <button class="btn-search" style="height: 28px"><i class="fa fa-search"></i></button>
          <a href="#" class="text-center " style="color: #029be6">Avanzata</a>
        </li>
        
      </ul>
      
      <!-- DA QUI PARTE LA NAVBAR CON LE TRE ICONE -->  
      <ul class="nav navbar-nav navbar-right" style="padding-left: 0px;">
        <?php
        
            //session_start();
            //$utente = $_SESSION['utente'];

            //Per ora sto simulando un utente loggato
            $utente = new Utente(1, 'Simone', 'Giak', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine" );
            //$utente = null;
            if ($utente == null){
                //include_once VIEW_DIR . 'headerNoLog.php';
                echo '<li style="padding-left: 12px"><a href="#"><span class="fa fa-sign-out"></span> Iscriviti</a></li>';
                echo '<li style="padding-left: 12px"><a href="#"><span class="fa fa-sign-in"></span> Login</a></li>';
            }
            else include_once VIEW_DIR . 'headerNavBar.php';

        ?>
        
        
      </ul> <!-- END -->
    </div>
  </div>
</nav>

