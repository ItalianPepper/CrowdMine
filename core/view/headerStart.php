
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo STYLE_DIR; ?>img/icon_crowdmine.png" type="image/x-icon" />

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/rating.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/yellow.css">

    <?php include_once VIEW_DIR."ViewUtils.php";?>
    <noscript><?php include_once VIEW_DIR."noscriptView.php";?></noscript>

    <style>
        /*da qui*/

        body .app-container{
            min-height: 900px;
        }

        body .app-container.no-sidebar{
            padding-left: 0px;
        }
        body .app-container.no-sidebar .navbar{
            margin-left: 0px;
        }

        body .app-container.no-sidebar .app-head{
            height:0px;
        }

        .navbar .navbar-collapse .navbar-nav > li.dropdown.no-drop:hover:after ,
        .navbar .navbar-collapse .navbar-nav > li.dropdown.no-drop:hover .dropdown-menu{
            display: none;
        }

        .navbar ul li ul{
            list-style: none;
            padding: 0;
        }

        footer{
            position: absolute;
            width: 100%;
        }

        @media (min-width: 767px) {
            .navbar {
                position: absolute;
                width: 100%;
                margin: 0;
                padding: 0;
                border:0;
                margin-left: -180px;
                z-index: 114;
            }

            .container-fluid {
                padding: 0;
                margin: 0;
            }

            aside.app-sidebar {
                z-index: 1;
            }

            .app-head {
                height: 90px;
            }

            body .app-container.no-sidebar .app-head{
                height:120px;
            }

        }

    </style>

 <?php $fullname = (isset($fullname))?$fullname:"Crowdmine";?>

 <script>
  function inserciValore() {
      var valueInputTextForm = $("#search").val();
      $("#value-to-send").attr("value",valueInputTextForm);
      $("#form-ricercaAnnunci").submit();

  }
 </script>
