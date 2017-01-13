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
    <div class="app-container no-sidebar">
        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>
        <div class="row">
            <div class="card">
                <div class="card-header">Statistiche Disponibili</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="section">
                                <div class="section-title">Macro Categorie</div>
                                <div class="section-body"><p>Vedi l'andamento delle Macro Categorie di annunci.</p></div>
                            </div>
                            <a href="<?php echo DOMINIO_SITO;?>/visualizzaStatisticheMacroCategorie" class="card card-banner card-green-light">
                                <div class="card-body">
                                    <i class="icon fa fa-bar-chart"></i>
                                    <div class="content">
                                        <div class="title">Statistiche Macro Categorie</div>
                                        <div class="value"><span class="sign"></span></div>
                                    </div>
                                </div>
                            </a>
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
</html>