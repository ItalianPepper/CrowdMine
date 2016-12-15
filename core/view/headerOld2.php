
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
            <img class="profile-img" src="<?php echo STYLE_DIR ?>./assets/images/profile.png">
          </button>
        </li>
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
      
      <ul class="nav navbar-nav navbar-right" style="padding-left: 0px;">
        <li class="dropdown notification">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div>
            <div class="title">I miei annunci</div>
            <div class="count">0</div>
          </a>
          <div class="dropdown-menu">
            <ul>
              <li class="dropdown-header">I miei annunci</li>
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
                  <span class="badge badge-danger pull-right">5</span>
                   I miei preferiti
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