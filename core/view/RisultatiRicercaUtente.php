<!DOCTYPE html>
<html>
<head>
    <title>CrowdMine | Ricerca Utente</title>
    <?php include_once VIEW_DIR ."headerStart.php"?>
</head>
<body>
<div class="app app-default">
    <div class="app-container no-sidebar">

        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">Ricerca Utenti</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <form action="<?php echo DOMINIO_SITO;?>/ricercaUtente" method="post">
                                            <input type="text" class="form-control" placeholder="Nome, Cognome, Email..." name="inputSearch">
                                            <div align="center">
                                                <button type="submit" class="btn btn-primary">Ricerca</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(isset($listaUtenti)){?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">Risultati Ricerca</div>
                                <div class="card-body">
                                    <?php
                                    foreach ($listaUtenti as $user) {
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="media social-post">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img src="<?php if($user->getImmagineProfilo()!=null){
                                                                echo $user->getImmagineProfilo();
                                                            }; ?>"/>
                                                        </a>
                                                    </div>
                                                    <div class="section">
                                                        <div class="section-body">
                                                            <div class="media-body">
                                                                <div class="pull-left">
                                                                    <div class="media-heading">
                                                                        <h4 class="title"><?php echo $user->getNome()." ".$user->getCognome(); ?></h4>
                                                                        <div class="description"><?php echo $user->getDescrizione();?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include_once VIEW_DIR."footerStart.php"?>
</body>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
</html>