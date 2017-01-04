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
          <img class="img-responsive" style="height: 75%;" src="<?php echo STYLE_DIR ?>/img/Favicon_3.png" />  
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
        
     <ul class="nav navbar-nav navbar-right" style="padding-left: 0px">
      <li style="padding-left: 12px"><a href="#"><span class="fa fa-sign-out"></span> Iscriviti</a></li>
      <li style="padding-left: 12px"><a href="#"><span class="fa fa-sign-in"></span> Login</a></li>
    </ul>
        
      </ul>
    </div>
  </div>
</nav>
  
  <script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/vendor.js"></script>
  <script type="text/javascript" src="<?php echo STYLE_DIR ?>/assets/js/app.js"></script>
