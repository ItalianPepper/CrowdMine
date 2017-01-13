<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>
</head>
<body>
<div class="app app-default">
    <?php include_once VIEW_DIR."headerSideBar.php";?>
    <div class="app-container">
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