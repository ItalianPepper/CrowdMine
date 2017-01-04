<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>

    <style>
        div.section .profile {
            margin-bottom: 0px;
        }

        .app-container .app-heading.no-flex{
            display:inline-block;
            width:100%;
        }

        body .app-container .app-heading .app-title{
            min-height:80px;
        }

        .card.card-tab .tab-content .tab-pane.active.tab-pane-cards{
            display: inline-block;
        }

        .tab-pane.tab-pane-cards .card-header {
            padding: 30px;
            border-bottom: 1px solid #dfe6e8;
            background-color: #fff;
        }

    </style>


    <style>
        h1 {
            font-size: 1rem;

        }

        @media (min-width: 1px) {
            h1 {
                font-size: medium;
            }

        }

        @media (min-width: 750px) {
            h1 {
                font-size: medium;
            }

        }

        @media (min-width: 970px) {
            h1 {
                font-size: x-large;
            }

        }

        @media (min-width: 1200px) {
            h1 {
                font-size: xx-large;
            }

        }

        a.morelink {
            text-decoration:none;
            outline: none;
        }
        .morecontent span {
            display: none;

        }


    </style>


    <?php $fullname = $visitedUser->getNome()." ".$visitedUser->getCognome();?>


</head>
<body>
<div class="app app-default">
    <div class="app-container no-sidebar">

        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body app-heading no-flex">
                        <div class="pull-left" style="display: flex;">
                            <img class="profile-img pull-left" src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                            <div class="app-title pull-left">
                                <div class="title"><span class="highlight"><?php echo $fullname;?></span></div>
                                <div class="description"><?php echo $visitedUser->getDescrizione();?></div>
                            </div>
                        </div>
                        <div class="profile-buttons-container pull-right">
                            <div class="profile-buttons">
                            <?php
                            if(isset($user)) {
                                if ($user->getRuolo() == RuoloUtente::AMMINISTRATORE) {
                                    if (($visitedUser->getRuolo() == RuoloUtente::UTENTE) && ($visitedUser->getStato() != StatoUtente::BANNATO)) {
                                        ?>

                                        <div class="profile-action">
                                            <button onclick="setModalForm('<?php echo DOMINIO_SITO; ?>/eleggiModeratore','Sei sicuro di voler rendere <strong><?php echo $fullname ?></strong> un moderatore?' )"
                                                    class="btn btn-success btn btn-default btn-xs"
                                                    data-toggle="modal" data-target="#ConfirmModal">
                                                Eleggi a Moderatore
                                            </button>
                                        </div>
                                        <?php
                                    } elseif (($visitedUser->getRuolo() == RuoloUtente::MODERATORE) && ($visitedUser->getStato() != StatoUtente::BANNATO)) {
                                        ?>
                                        <div class="profile-action">
                                            <button onclick="setModalForm('<?php echo DOMINIO_SITO; ?>/destituisciModeratore','Sei sicuro di voler destituire <strong><?php echo $fullname ?></strong> dal ruolo di moderatore?' )"
                                                    class="btn btn-danger btn btn-default btn-xs"
                                                    data-toggle="modal" data-target="#ConfirmModal">
                                                Destituisci Moderatore
                                            </button>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                if (($user->getRuolo() == RuoloUtente::MODERATORE) || ($user->getRuolo() == RuoloUtente::AMMINISTRATORE)) {
                                    if ($visitedUser->getStato() != StatoUtente::BANNATO && $visitedUser->getStato() != StatoUtente::RICORSO) {
                                        ?>
                                        <div class="profile-action">
                                            <button onclick="setModalForm('<?php echo DOMINIO_SITO; ?>/banUtente','Sei sicuro di voler bannare <strong><?php echo $fullname ?></strong>?' )"
                                                    class="btn btn-danger btn btn-default btn-xs"
                                                     data-toggle="modal" data-target="#ConfirmModal">
                                                     Ban Utente
                                            </button>
                                        </div>
                                        <?php
                                    } elseif ($visitedUser->getStato() == StatoUtente::BANNATO || $visitedUser->getStato() == StatoUtente::RICORSO) {

                                        ?>
                                        <div class="profile-action">
                                            <button onclick="setModalForm('<?php echo DOMINIO_SITO; ?>/riattivaUtente','Riattivare <strong><?php echo $fullname ?></strong>?' )"
                                                    class="btn btn-success btn btn-default btn-xs"
                                                    data-toggle="modal" data-target="#ConfirmModal">
                                                Riattiva Utente
                                            </button>
                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                                <?php

                                if ($visitedUser->getStato() == StatoUtente::ATTIVO) {
                                    ?>
                                    <div class="profile-action">
                                        <button onclick="setModalForm('<?php echo DOMINIO_SITO; ?>/segnalaUtente','Sei sicuro di voler segnalare <strong><?php echo $fullname ?></strong>?' )"
                                                class="btn btn-warning btn btn-default btn-xs"
                                                data-toggle="modal" data-target="#ConfirmModal">
                                            Segnala Utente
                                        </button>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-tab">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li role="tab1" class="active">
                                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Profilo</a>
                            </li>
                            <li role="tab2">
                                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Annunci</a>
                            </li>
                            <li role="tab3">
                                <a href="#tab3" id="feedback-tab-3" aria-controls="tab3" role="tab" data-toggle="tab"
                                   id="feedback-tab">Feedback</a>
                            </li>
                            <li role="tab4">
                                <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Statistiche</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title profile">
                                            <i class="icon fa fa-user" aria-hidden="true"></i>
                                            Dati anagrafici
                                        </div>


                                        <div class="panel panel-default" style="border: none;box-shadow: none;">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 simple-row">
                                                        Nome
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 simple-row">
                                                        <?php echo $visitedUser->getNome()?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Cognome
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        <?php echo $visitedUser->getCognome()?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Data di nascita
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        <?php echo $visitedUser->getDataNascita()?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Localit&agrave;
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        <?php echo $visitedUser->getCitta()?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-xs-5 overlined-row">
                                                        Email
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-7 overlined-row">
                                                        <?php echo $visitedUser->getEmail()?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="section">
                                        <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i>
                                            Categorie
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse5">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Macrocategorie
                                                    </h4>
                                                </div>
                                            </a>
                                            <div id="profile-collapse5" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php
                                                        if(count($macroListUtente)>0) { ?>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-xs-12 simple-row">
                                                                    <?php
                                                                    foreach ($macroListUtente as $macro) {
                                                                        randomColorLabel($macro->getNome() . $macro->getId(), $macro->getNome());
                                                                        echo " ";
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse6">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Microcategorie
                                                    </h4>
                                                </div>
                                            </a>
                                            <div id="profile-collapse6" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php
                                                            $rowType = "simple-row";

                                                            for($i=0;$i<count($macroListUtente);$i++) {
                                                                $macro = $macroListUtente[$i];
                                                                $found = false;

                                                                foreach ($microListUtente as $micro) {

                                                                    $m = $micro->getMicroCategoria();

                                                                    if($m->getIdMacrocategoria()==$macro->getId()) {

                                                                        if($found == false){
                                                                            $found = true;

                                                                            echo '<div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-xs-12 '.$rowType.'">';
                                                                            echo '    <span class="label label-default">'.$macro->getNome().'</span> ';


                                                                            if($rowType== "simple-row") $rowType = "overlined-row";

                                                                        }
                                                                        randomColorLabel($m->getNome() . $m->getId(), $m->getNome());
                                                                        echo " ";
                                                                    }

                                                                    if($found){
                                                                        echo '  </div></div>';
                                                                    }
                                                                }
                                                            }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane tab-pane-cards" id="tab2">
                            <?php
                            for ($i = 0; $i < count($annunci); $i++) {
                                $aId = $annunci[$i]->getId();
                            ?>

                            <div class="col-md-10 col-sm-10" style="margin-top: 5%">

                                <div class="card">

                                    <div class="card-header ">

                                        <div class="card-title" style="float: left">

                                            <div class="media" style="width: 20%; float: left">
                                                <a href="#">
                                                    <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                                                </a>
                                            </div>

                                            <div style="float: left; margin-left: 5%;">
                                                <h1 style="border-bottom: 1px solid #eee; padding-bottom: 5%">
                                                        <?php
                                                        $u = $listaUtenti[$annunci[$i]->getIdUtente()];
                                                        echo $u->getNome() . " " . $u->getCognome() ?>
                                                </h1>
                                                <h1><?php echo $annunci[$i]->getTitolo();?></h1>

                                            </div>

                                        </div>

                                        <a href="<?php echo DOMINIO_SITO; ?>/segnalaAnnuncioControl?id=<?php echo $annunci[$i]->getId();?>">
                                            <i class="fa fa-legal" aria-hidden="true" style="font-size: 200%"></i>
                                        </a>

                                        <a href="<?php echo DOMINIO_SITO; ?>/aggiungiPreferitiControl?id=<?php echo $annunci[$i]->getId();?>">
                                            <i class="fa fa-star" aria-hidden="true" style="font-size: 200%"></i>
                                        </a>

                                    </div>

                                    <div class="card-body">
                                        <div class="comment more" style="word-wrap: break-word;">
                                            <?php echo $annunci[$i]->getDescrizione();?>
                                        </div>
                                        <br>

                                        <div style="margin-top: 3%">
                                            <?php
                                            if(isset($AnnunciMicroRef[$aId]))
                                                for($z=0;$z<count($AnnunciMicroRef[$aId]); $z++){
                                                    $micro = $listaMicro[$AnnunciMicroRef[$aId][$z]];
                                                    echo randomColorLabel($micro->getNome(), $micro->getNome());
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="media-comment" style="">
                                        <button class="btn btn-link <?php echo $annunci[$i]->getId();?>">
                                            <i class="fa fa-comments-o"></i><?php echo isset($listaCommenti[$aId])?count($listaCommenti[$aId]):0 ?>Comments
                                        </button>
                                        <button class="btn btn-default <?php echo $annunci[$i]->getId();?>">info</button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $annunci[$i]->getId();?>">Candidati</button>
                                    </div>


                                    <div class="row col-md-12 col-sm-12 card contenitore <?php echo $annunci[$i]->getId(); ?>" style="margin-left: 0; display: none">
                                        <?php
                                        if(isset($listaCommenti[$aId]))
                                            for($z=0;$z<count($listaCommenti[$aId]); $z++){

                                                ?>
                                                <div class="comment-body" style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                                                    <div class="media-heading">
                                                        <h4 class="title">
                                                            <?php
                                                            $u = $listaUtenti[$listaCommenti[$aId][$z]->getIdUtente()];
                                                            echo $u->getNome()." ".$u->getCognome()
                                                            ?>
                                                        </h4>
                                                        <h5 class="timeing"><?php
                                                            echo $listaCommenti[$aId][$z]->getData();
                                                            ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 options"
                                                         style="float: right; margin-top: -8%; margin-right: -23%">
                                                        <a href="<?php echo DOMINIO_SITO;?>/segnalaCommento?id=<?php echo $listaCommenti[$aId][$z]->getId(); ?>">
                                                            <button
                                                                    style="background-color: Transparent;background-repeat:no-repeat; border: none;cursor:pointer; overflow: hidden; outline:none;">
                                                                <i class="fa fa-close"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="media-content">
                                                        <?php
                                                        echo $listaCommenti[$aId][$z]->getCorpo();
                                                        ?>
                                                    </div>

                                                </div>


                                                <?php

                                        }

                                        ?>

                                        <div class="col-md-12 form-commento">
                                            <form action="<?php echo DOMINIO_SITO;?>/commentaAnnuncioControl" method="post">
                                                <div class="col-md-10 input-comment">
                                                    <input type="text" class="form-control" placeholder="Scrivi un commento... <?php echo $annunci[$i]->getId();?>"
                                                           name="commento">
                                                    <input type="hidden" name ="idAnnuncio" hidden value="<?php echo $annunci[$i]->getId();?>">
                                                </div>
                                                <div class="col-md-2 btn-comment">
                                                    <button type="submit" class="btn btn-info">Commenta</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row col-md-12 col-sm-12 card info <?php echo $annunci[$i]->getId(); ?>" style="margin-left: 0; display: none">
                                        <h5>
                                            <i class="fa fa-location-arrow"></i>
                                            <?php echo $annunci[$i]->getLuogo();?></h5>
                                        <h5>
                                            <i class="fa fa-money"></i>
                                            <?php echo $annunci[$i]->getRetribuzione();?></h5>
                                        <h5>
                                            <i class="fa fa-clock-o"></i>
                                            <?php echo $annunci[$i]->getData();?></h5>
                                        <h5>
                                            <i class="fa fa-briefcase"></i>
                                            <?php echo $annunci[$i]->getTipologia();?></h5>
                                    </div>

                                </div>
                            </div>


                        <?php
                        }

                        ?>
                        </div>
                        <!--Feedback-->
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="panel panel-default compact-panel">
                                    <a id="feedback-collapse-panel" class="panel-default collapse-title"
                                       data-toggle="collapse"
                                       href="#feedback-collapse">
                                        <div class="panel-heading">
                                            <h4 class="media-heading">
                                                Inserisci Feedback
                                            </h4>
                                            <p>Clicca qui per inserire un feedback</p>
                                        </div>
                                    </a>
                                    <div id="feedback-collapse" class="panel-collapse collapse">
                                        <form action="inserisciFeedback" method="post">
                                            <div class="panel-body">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xs-12 simple-row">
                                                            <div class="section">
                                                                <div class="section-title">
                                                                    Your user name
                                                                </div>
                                                                <div class="section-body __indent">
                                                                    <img src="http://placehold.it/100x100"
                                                                         class="img-responsive">
                                                                </div>

                                                                <div class="section-title">
                                                                    Rating
                                                                </div>
                                                                <div class="section-body">
                                                                    <div class="rating">
                                                                        <input type="radio" id="star5" name="rating"
                                                                               value="5"/><label
                                                                                class="full" for="star5"
                                                                                title="Awesome - 5 stars"></label>
                                                                        <input type="radio" id="star4half" name="rating"
                                                                               value="4.5"/><label
                                                                                class="half" for="star4half"
                                                                                title="Pretty good - 4.5 stars"></label>
                                                                        <input type="radio" id="star4" name="rating"
                                                                               value="4"/><label
                                                                                class="full" for="star4"
                                                                                title="Pretty good - 4 stars"></label>
                                                                        <input type="radio" id="star3half" name="rating"
                                                                               value="3.5"/><label
                                                                                class="half" for="star3half"
                                                                                title="Meh - 3.5 stars"></label>
                                                                        <input type="radio" id="star3" name="rating"
                                                                               value="3"/><label
                                                                                class="full" for="star3"
                                                                                title="Meh - 3 stars"></label>
                                                                        <input type="radio" id="star2half" name="rating"
                                                                               value="2.5"/><label
                                                                                class="half" for="star2half"
                                                                                title="Kinda bad - 2.5 stars"></label>
                                                                        <input type="radio" id="star2" name="rating"
                                                                               value="2"/><label
                                                                                class="full" for="star2"
                                                                                title="Kinda bad - 2 stars"></label>
                                                                        <input type="radio" id="star1half" name="rating"
                                                                               value="1.5"/><label
                                                                                class="half" for="star1half"
                                                                                title="Meh - 1.5 stars"></label>
                                                                        <input type="radio" id="star1" name="rating"
                                                                               value="1"/><label
                                                                                class="full" for="star1"
                                                                                title="Sucks big time - 1 star"></label>
                                                                        <input type="radio" id="starhalf" name="rating"
                                                                               value="0.5"/><label
                                                                                class="half" for="starhalf"
                                                                                title="Sucks big time - 0.5 stars"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-xs-12 simple-row">
                                                            <input name="feedback-name" type="text" class="form-control"
                                                                   required id="feedback-title"

                                                                   placeholder="Inserisci il titolo del feedback">
                                                            <textarea name="feedback-textArea" rows="3"
                                                                      class="form-control" required
                                                                      id="feedback-textarea"
                                                                      placeholder="Descrizione"></textarea>
                                                            <button type="submit" class="btn btn-success"
                                                                    id="button-add-feedback">Inserisci Feeedback
                                                            </button>

                                                            <div class="alert alert-danger  alert-dismissible"
                                                                 role="alert"
                                                                 id="feedback-erros" style="display: none">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- out of form -->
                            <div class="row" style="margin-top: 3%">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="media social-post">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
                                                </a>
                                            </div>
                                            <div class="section">
                                                <div class="section-body">
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4 class="title">Scott White</h4>
                                                        </div>
                                                        <div class="rating-content" onclick="return false;">
                                                            <div class="rating">
                                                                <input type="radio" id="star5" name="rating0"
                                                                       value="5"/><label
                                                                        class="full" for="star5"
                                                                        title="Awesome - 5 stars"></label>
                                                                <input type="radio" id="star4half" name="rating0"
                                                                       value="4.5"/><label
                                                                        class="half" for="star4half"
                                                                        title="Pretty good - 4.5 stars"></label>
                                                                <input type="radio" id="star4" name="rating0"
                                                                       value="4"/><label
                                                                        class="full" for="star4"
                                                                        title="Pretty good - 4 stars"></label>
                                                                <input type="radio" id="star3half" name="rating0"
                                                                       value="3.5" checked/><label
                                                                        class="half" for="star3half"
                                                                        title="Meh - 3.5 stars"></label>
                                                                <input type="radio" id="star3" name="rating0"
                                                                       value="3"/><label
                                                                        class="full" for="star3"
                                                                        title="Meh - 3 stars"></label>
                                                                <input type="radio" id="star2half" name="rating0"
                                                                       value="2.5"/><label
                                                                        class="half" for="star2half"
                                                                        title="Kinda bad - 2.5 stars"></label>
                                                                <input type="radio" id="star2" name="rating0"
                                                                       value="2"/><label
                                                                        class="full" for="star2"
                                                                        title="Kinda bad - 2 stars"></label>
                                                                <input type="radio" id="star1half" name="rating0"
                                                                       value="1.5"/><label
                                                                        class="half" for="star1half"
                                                                        title="Meh - 1.5 stars"></label>
                                                                <input type="radio" id="star1" name="rating0"
                                                                       value="1"/><label
                                                                        class="full" for="star1"
                                                                        title="Sucks big time - 1 star"></label>
                                                                <input type="radio" id="starhalf" name="rating0"
                                                                       value="0.5"/><label
                                                                        class="half" for="starhalf"
                                                                        title="Sucks big time - 0.5 stars"></label>
                                                            </div>
                                                        </div>
                                                        <h5 style="margin-top: 0px"><b>Feedback Title</b></h5>
                                                        <div class="media-content">
                                                            Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                            elit. Aenean commodo
                                                            ligula
                                                            eget dolor. Aenean massa. Cum sociis natoque penatibus
                                                            et magnis dis
                                                            parturient
                                                            montes, nascetur ridiculus mus. Donec quam felis,
                                                            ultricies nec,
                                                            pellentesque
                                                            eu, pretium quis, sem. Nulla consequat massa quis enim.
                                                            Donec.
                                                        </div>
                                                        <div class="media-action">
                                                            <button class="btn btn-link"><i
                                                                        class="fa fa-exclamation-circle"></i>
                                                                Segnala
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 3%">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="section">
                                                    <div class="media social-post">
                                                        <div class="media-left">
                                                            <a href="#">
                                                                <img
                                                                        src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
                                                            </a>
                                                        </div>
                                                        <div class="section">
                                                            <div class="section-body">
                                                                <div class="media-body">
                                                                    <div class="media-heading">
                                                                        <h4 class="title">Scott White</h4>
                                                                    </div>
                                                                    <div class="rating-content" onclick="return false;">
                                                                        <div class="rating">
                                                                            <input type="radio" id="star5"
                                                                                   name="rating1"
                                                                                   value="5"/><label
                                                                                    class="full" for="star5"
                                                                                    title="Awesome - 5 stars"></label>
                                                                            <input type="radio" id="star4half"
                                                                                   name="rating1"
                                                                                   value="4.5"/><label
                                                                                    class="half" for="star4half"
                                                                                    title="Pretty good - 4.5 stars"></label>
                                                                            <input type="radio" id="star4"
                                                                                   name="rating1"
                                                                                   value="4"/><label
                                                                                    class="full" for="star4"
                                                                                    title="Pretty good - 4 stars"></label>
                                                                            <input type="radio" id="star3half"
                                                                                   name="rating1"
                                                                                   value="3.5" checked/><label
                                                                                    class="half" for="star3half"
                                                                                    title="Meh - 3.5 stars"></label>
                                                                            <input type="radio" id="star3"
                                                                                   name="rating1"
                                                                                   value="3"/><label
                                                                                    class="full" for="star3"
                                                                                    title="Meh - 3 stars"></label>
                                                                            <input type="radio" id="star2half"
                                                                                   name="rating1"
                                                                                   value="2.5"/><label
                                                                                    class="half" for="star2half"
                                                                                    title="Kinda bad - 2.5 stars"></label>
                                                                            <input type="radio" id="star2"
                                                                                   name="rating1"
                                                                                   value="2"/><label
                                                                                    class="full" for="star2"
                                                                                    title="Kinda bad - 2 stars"></label>
                                                                            <input type="radio" id="star1half"
                                                                                   name="rating1"
                                                                                   value="1.5"/><label
                                                                                    class="half" for="star1half"
                                                                                    title="Meh - 1.5 stars"></label>
                                                                            <input type="radio" id="star1"
                                                                                   name="rating1"
                                                                                   value="1"/><label
                                                                                    class="full" for="star1"
                                                                                    title="Sucks big time - 1 star"></label>
                                                                            <input type="radio" id="starhalf"
                                                                                   name="rating1"
                                                                                   value="0.5"/><label
                                                                                    class="half" for="starhalf"
                                                                                    title="Sucks big time - 0.5 stars"></label>
                                                                        </div>
                                                                    </div>
                                                                    <h5 style="margin-top: 0px"><b>Feedback Title</b>
                                                                    </h5>
                                                                    <div class="media-content">
                                                                        Lorem ipsum dolor sit amet, consectetuer
                                                                        adipiscing
                                                                        elit. Aenean commodo
                                                                        ligula
                                                                        eget dolor. Aenean massa. Cum sociis natoque
                                                                        penatibus
                                                                        et magnis dis
                                                                        parturient
                                                                        montes, nascetur ridiculus mus. Donec quam
                                                                        felis,
                                                                        ultricies nec,
                                                                        pellentesque
                                                                        eu, pretium quis, sem. Nulla consequat massa
                                                                        quis enim.
                                                                        Donec.
                                                                    </div>
                                                                    <div class="media-action">
                                                                        <button class="btn btn-link"><i
                                                                                    class="fa fa-exclamation-circle"></i>
                                                                            Segnala
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row" style="margin-top: 3%">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="section">
                                                                <div class="media social-post">
                                                                    <div class="media-left">
                                                                        <a href="#">
                                                                            <img
                                                                                    src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
                                                                        </a>
                                                                    </div>
                                                                    <div class="section">
                                                                        <div class="section-body">
                                                                            <div class="media-body">
                                                                                <div class="media-heading">
                                                                                    <h4 class="title">Scott White</h4>
                                                                                </div>
                                                                                <div class="rating-content"
                                                                                     onclick="return false;">
                                                                                    <div class="rating">
                                                                                        <input type="radio" id="star5"
                                                                                               name="rating2"
                                                                                               value="5"/><label
                                                                                                class="full" for="star5"
                                                                                                title="Awesome - 5 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star4half"
                                                                                               name="rating2"
                                                                                               value="4.5"/><label
                                                                                                class="half"
                                                                                                for="star4half"
                                                                                                title="Pretty good - 4.5 stars"></label>
                                                                                        <input type="radio" id="star4"
                                                                                               name="rating2"
                                                                                               value="4"/><label
                                                                                                class="full" for="star4"
                                                                                                title="Pretty good - 4 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star3half"
                                                                                               name="rating2"
                                                                                               value="3.5"
                                                                                               checked/><label
                                                                                                class="half"
                                                                                                for="star3half"
                                                                                                title="Meh - 3.5 stars"></label>
                                                                                        <input type="radio" id="star3"
                                                                                               name="rating2"
                                                                                               value="3"/><label
                                                                                                class="full" for="star3"
                                                                                                title="Meh - 3 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star2half"
                                                                                               name="rating2"
                                                                                               value="2.5"/><label
                                                                                                class="half"
                                                                                                for="star2half"
                                                                                                title="Kinda bad - 2.5 stars"></label>
                                                                                        <input type="radio" id="star2"
                                                                                               name="rating2"
                                                                                               value="2"/><label
                                                                                                class="full" for="star2"
                                                                                                title="Kinda bad - 2 stars"></label>
                                                                                        <input type="radio"
                                                                                               id="star1half"
                                                                                               name="rating2"
                                                                                               value="1.5"/><label
                                                                                                class="half"
                                                                                                for="star1half"
                                                                                                title="Meh - 1.5 stars"></label>
                                                                                        <input type="radio" id="star1"
                                                                                               name="rating2"
                                                                                               value="1"/><label
                                                                                                class="full" for="star1"
                                                                                                title="Sucks big time - 1 star"></label>
                                                                                        <input type="radio"
                                                                                               id="starhalf"
                                                                                               name="rating2"
                                                                                               value="0.5"/><label
                                                                                                class="half"
                                                                                                for="starhalf"
                                                                                                title="Sucks big time - 0.5 stars"></label>
                                                                                    </div>
                                                                                </div>
                                                                                <h5 style="margin-top: 0px"><b>Feedback
                                                                                        Title</b></h5>
                                                                                <div class="media-content">
                                                                                    Lorem ipsum dolor sit amet,
                                                                                    consectetuer adipiscing
                                                                                    elit. Aenean commodo
                                                                                    ligula
                                                                                    eget dolor. Aenean massa. Cum sociis
                                                                                    natoque penatibus
                                                                                    et magnis dis
                                                                                    parturient
                                                                                    montes, nascetur ridiculus mus.
                                                                                    Donec quam felis,
                                                                                    ultricies nec,
                                                                                    pellentesque
                                                                                    eu, pretium quis, sem. Nulla
                                                                                    consequat massa quis enim.
                                                                                    Donec.
                                                                                </div>
                                                                                <div class="media-action">
                                                                                    <button class="btn btn-link"><i
                                                                                                class="fa fa-exclamation-circle"></i>
                                                                                        Segnala
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Statistiche-->
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="section">
                                        <div class="section-title">
                                            Your user name
                                        </div>
                                        <div class="section-body __indent">
                                            <img src="http://placehold.it/100x100"
                                                 class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Statistica Feedback Totale</div>
                                        <div class="section-body">
                                            <div class="ct-chart-pie ct-perfect-fourth"></div>
                                            <div class="col-sm-4">
                                                <ul class="chart-label">
                                                    <li class="ct-label ct-series-a">Feedback
                                                        positivi
                                                    </li>
                                                    <li class="ct-label ct-series-b">Feedback
                                                        negativi
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Micro Categoria</th>
                                                        <th>Feedback positivi</th>
                                                        <th>Feedback Negativi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        for ($i = 0; $i < count($annunci); $i++) {
                        $aId = $annunci[$i]->getId();
                        ?>
                            <div class="modal fade" id="myModal<?php echo $annunci[$i]->getId();?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Candidati</h4>
                                        </div>
                                        <form action="<?php echo DOMINIO_SITO;?>/aggiungiCandidaturaControl" method="post">
                                            <div class="modal-body">
                                                Inserisci Descrizione
                                                <textarea name="descrizione" rows="3" class="form-control" placeholder="Descrizione.. <?php echo $annunci[$i]->getId();?>"></textarea>
                                                <input type="text" value="<?php echo $annunci[$i]->getId();?>" name="idAnnuncio" hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Chiudi</button>
                                                <button type="submit" class="btn btn-sm btn-success">Candidati</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        ?>

                        <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="ConfirmModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" method="POST" class="form form-horizontal" id="tel-input">

                                        <input type="hidden" name="idUser" value="<?php echo $visitedUser->getId(); ?>">
                                        <input type="hidden" name="referer" value="<?php echo DOMINIO_SITO.'/ProfiloUtente/'.$visitedUser->getId(); ?>">

                                        <div class="modal-header">
                                            <strong>Conferma operazione</strong>
                                        </div>
                                        <div class="modal-body"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Chiudi</button>
                                            <button type="submit" class="btn btn-sm btn-success">Conferma</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackCheckUtils.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>
                <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackList.js"></script>

                <script>
                    function setModalForm(action,text){
                        $("#ConfirmModal form").attr("action",action);
                        $(".modal-body").html("<p>"+text+"</p>")
                    }
                </script>

                <script type="text/javascript">

                    $(document).ready(function(){
                        <?php
                        for ($i = 0; $i < count($annunci); $i++) {
                            echo "annuncioButtons(" . $annunci[$i]->getId() . ")";
                        }
                        ?>
                    });

                    function annuncioButtons(id){
                        $(".btn.btn-link."+id).click(function(){
                            $(".row.col-md-12.col-sm-12.card.contenitore."+id).toggle(250);
                            $(".row.col-md-12.col-sm-12.card.info."+id).hide(250);
                        });

                        $(".btn.btn-default."+id).click(function(){
                            $(".row.col-md-12.col-sm-12.card.contenitore."+id).hide(250);
                            $(".row.col-md-12.col-sm-12.card.info."+id).toggle(250);
                        });
                    }

                    /*redirect to hash*/
                    hashes=location.hash.split("#");
                    if(hashes[1]) {
                        $('.nav-tabs a[href="#' + hashes[1] + '"]').tab('show');
                    }
                    if(hashes[2]){
                        $('html, body').animate({
                            scrollTop: $("#"+hashes[2]+"").offset().top
                        }, 2000);
                    }

                </script>

                <?php

                if (isset($_SESSION['toast-type']) && isset($_SESSION['toast-message'])) {
                    ?>
                    <script>
                        $(document).ready(function () {
                            "use strict";
                            $("#feedback-tab").click();
                            $("#feedback-collapse-panel").click();
                        });
                        toastr["<?php echo $_SESSION['toast-type'] ?>"]("<?php echo $_SESSION['toast-message'] ?>");
                    </script>
                    <?php
                    unset($_SESSION['toast-type']);
                    unset($_SESSION['toast-message']);
                }
                ?>


</body>

</html>
