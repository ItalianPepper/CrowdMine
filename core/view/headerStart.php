 <title>Crowdmine</title>

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
        /*da qui*/

        body .app-container.no-sidebar{
            padding-left: 0px;
        }
        body .app-container.no-sidebar .navbar{
            margin-left: 0px;
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
        }

    </style>