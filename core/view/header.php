<!DOCTYPE html>
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

<div class="app-container" style="padding-left:0px">

  <nav class="navbar navbar-default" id="navbar" style="padding: 0px; border-width: 0px; ">
  <div class="container-fluid"  style="padding: 0px;">
    <div class="navbar-collapse collapse in" style="background: rgba(16, 14, 23, 0.87);" >
      
      <ul class="nav navbar-nav navbar-mobile" style="padding-left: 0px;">
        
        <!-- logo su mobile -->
        
        <li class="logo">
          <img class="img-responsive" style="height: 75%; " src="<?php echo STYLE_DIR ?>/img/Favicon_3.png" />  
          <a class="navbar-brand" href="#"><span class="highlight">Alfredo Fiorillo</span></a>
        </li>
        
        <li>
          <button type="button" class="navbar-toggle">
            <img class="profile-img" src="<?php echo STYLE_DIR ?>./assets/images/profile.png">
          </button>
        </li>
      </ul>
    
      <ul class="nav navbar-nav navbar-left col-md-2" >
          <!-- Logo su pc -->  
          <li class="logo">
                <img class="img-responsive" style="height: 55%; max-width: 100%" src="<?php echo STYLE_DIR ?>/img/Logo_Crowdmine_3.png" />
            </li>                
      </ul>  
        
      <ul class="nav navbar-nav navbar-center col-md-7">
        <!--<li class="navbar-title">Dashboard</li>
        <li class="logo">
            <img class="img-responsive" style="height: 75%; width: 30%" src="<?php echo STYLE_DIR ?>/img/Logo_Crowdmine_2.png" />
        </li>  
         -->
        <li class="navbar-search hidden-sm col-md-12">
            
          <input  class="search-form col-md-8" id="search" type="text" placeholder="Cerca annunci di lavoro..." > <!--style="height: 60%; padding-right: 0px; padding-left: 5px"-->

          <button class="btn-search"><i class="fa fa-search"></i></button> 
          <div class="col-md-2" style="padding-right: 0px; padding-left: 5px">
                <!-- BARRA DI RICERCA->FORM->SCRITTA AVANZATE-->       
                <div class="col-md-4" style="padding-right: 10px; padding-left: 10px; padding-top: 7px">
                     <a href="#" class="text-center ">Avanzata</a>
                </div>
          </div>
        </li>  
        
      </ul>
        
      <ul class="nav navbar-nav navbar-right  col-md-3" >
         <!-- MENU I MIEI ANNUNCI -->
         <li class="dropdown notification">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon"><i class="fa fa-folder-open-o" aria-hidden="true"></i></div>
            <div class="title">I miei annunci</div>
            <div class="count">0</div>
          </a>
          <div class="dropdown-menu">
            <ul>
              <li class="dropdown-header">I miei annunci</li>
              <li class="dropdown-empty">Nessun annuncio</li>
              <li class="dropdown-footer">
                <a href="#">Visualizza tutto <i class="fa fa-angle-right" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
        </li>
        
        <!-- MENU MESSAGGI -->
        <li class="dropdown notification warning">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon"><i class="fa fa-comments" aria-hidden="true"></i></div>
            <div class="title">Messaggi</div>
            <div class="count">99</div>
          </a>
          
          <div class="dropdown-menu">
            <ul>
              <li class="dropdown-header">Messaggi</li>
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
                      <div class="description">Marco  Harmon</div>
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
                <a href="#">Visualizza tutti <i class="fa fa-angle-right" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
         
        </li>
       
        
        <!-- MENU NOTIFICHE -->
        <li class="dropdown notification danger">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
            <div class="title">Notifiche</div>
            <div class="count">10</div>
          </a>
            
            
          <div class="dropdown-menu">
            <ul>
              <li class="dropdown-header">Notifiche</li>
              <!--<li>
                <a href="#">
                  <span class="badge badge-danger pull-right">8</span>
                  <div class="message">
                    <div class="content">
                      <div class="title">I miei ordini</div>
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
              -->
              <li class="dropdown-footer">
                <a href="#">Visualizza tutte <i class="fa fa-angle-right" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
        </li>
        
        
         <!-- MEMU PROFILO -->
        <li class="dropdown profile">
          <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="<?php echo STYLE_DIR ?>./assets/images/profile.png">
            <div class="title">Profilo</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username">Alfredo Fiorillo</h4>
            </div>
            <ul class="action">
              <li>
                <a href="#">
                  Profilo
                </a>
              </li>
              <li>
                <a href="#">
                  I miei preferiti
                </a>
              </li>
               <li>
                <a href="#">
                  Statistiche
                </a>
               </li>
              <li>
                <a href="#">
                  Impostazioni
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



  
  <script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/vendor.js"></script>
  <script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/app.js"></script>
