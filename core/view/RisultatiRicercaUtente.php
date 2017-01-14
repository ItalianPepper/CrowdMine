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
                            <div class="card-header" style="padding: 24px 28px;">Ricerca Utenti</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <form action="<?php echo DOMINIO_SITO;?>/ricercaUtente" method="post">
                                            <div class="col-lg-8 col-md-10 col-sm-10 col-xs-12">
                                                <input type="text" class="form-control" placeholder="Nome, Cognome, Email..." name="inputSearch"
                                                       value="<?php echo isset($input)?$input:'';?>">
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="push-left">
                                                    <button type="submit" class="btn btn-primary">Ricerca</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                            for ($i = 0; $i < count($listaUtenti); $i++) {
                                $utente = $listaUtenti[$i];
                                ?>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12 <?php echo ($i == 0) ? '' : 'overlined-row' ?>">
                                        <div class="media social-post">
                                            <div class="media-left">
                                                <a href="<?php echo DOMINIO_SITO . '/ProfiloUtente/' . $utente->getId() ?>">
                                                    <img src="<?php echo getUserImageBig($utente);?>"/>
                                                </a>
                                            </div>
                                            <div class="">
                                                <div class="section-body">
                                                    <div class="media-body">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="<?php echo DOMINIO_SITO . '/ProfiloUtente/' . $utente->getId() ?>">
                                                                <h4 class="title"><?php echo $utente->getNome() . " " . $utente->getCognome() ?></h4>
                                                                </a>
                                                                    <div class="description"><?php echo $utente->getCitta() ?></div>
                                                                <br>
                                                                <div class="description"><?php echo $utente->getDescrizione() ?></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include_once VIEW_DIR."footerStart.php"?>
<?php include_once VIEW_DIR."footerEnd.php"?>
</body>

</html>