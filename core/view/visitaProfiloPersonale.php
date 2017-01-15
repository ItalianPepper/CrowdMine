<!DOCTYPE html>
<html>
<head>

    <title>CrowdMine | Profilo Personale</title>

    <?php
    include_once VIEW_DIR."headerStart.php";
    $fullname = $user->getNome()." ".$user->getCognome();
    ?>
</head>

<body>

<div class="app app-default">
    <div class="app-container no-sidebar">

        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body app-heading">
                        <img class="profile-img" src="<?php echo $profileImg;?>">
                        <div class="app-title">
                            <div class="title"><span
                                        class="highlight"><?php echo $user->getNome() . " " . $user->getCognome() ?></span>
                            </div>
                            <div class="description"><?php echo $user->getDescrizione(); ?></div>
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
                                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Privacy e
                                    sicurezza</a>
                            </li>
                            <li role="tab3">
                                <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Annunci e offerte di
                                    lavoro</a>
                            </li>
                            <li role="tab4">
                                <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Segnalazioni</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding tab-content">

                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i>
                                            Elementi base
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse1">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Indirizzo Email
                                                    </h4>
                                                    <p>Visualizza il tuo indirizzo email</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row" id="edit-mail">
                                                            <div class="col-lg-2 col-md-2 col-xs-3 simple-row">
                                                                Email
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-9 simple-row">
                                                                <?php echo $user->getEmail(); ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse2">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Numero di telefono
                                                    </h4>
                                                    <p>Modifica numero di telefono</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row" id="edit-tel">
                                                            <div class="col-lg-2 col-md-2 col-xs-3 simple-row">
                                                                Tel.
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-9 simple-row">
                                                                <?php echo $user->getTelefono(); ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenu1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right"
                                                                    aria-labelledby="dropdownMenu1">
                                                                    <li>
                                                                        <a onclick="$('#edit-tel').toggleWith('#edit-tel-input')">Modifica</a>
                                                                    </li>
                                                                    <li><a href="#">Rimuovi</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="edit-tel-input"
                                                                  style="display:none" action="<?php echo DOMINIO_SITO;?>/CambiaNumeroControl"
                                                                  method="post">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-phone"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input id="numberTelephoneChange" type="text"
                                                                               class="form-control" name="nuovoNumero"
                                                                               placeholder="Nuovo Numero"
                                                                               aria-describedby="basic-addon1"
                                                                               value="<?php if (isset($user))
                                                                               {echo $user->getTelefono();} ?>">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#edit-tel-input').toggleWith('#edit-tel')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse3">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Cambia password
                                                    </h4>
                                                    <p>Segli un'unica password per proteggere i tuoi dati</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row" id="edit-mail">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 simple-row">
                                                                La nuova password deve essere composta da almeno 8
                                                                caratteri, deve contenere maiuscole e minuscole, e deve
                                                                essere presente almeno un numero.
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <form action="<?php echo DOMINIO_SITO;?>/modificaPassword" method="post"
                                                                  class="form form-horizontal" id="tel-input">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-lock"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input required id="password-attuale"
                                                                               name="PasswordAttuale" type="text"
                                                                               class="form-control"
                                                                               placeholder="Password attuale"
                                                                               aria-describedby="basic-addon1" value="">
                                                                    </div>
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-lock"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input required id="nuova-password"
                                                                               name="NuovaPassword" type="text"
                                                                               class="form-control"
                                                                               placeholder="Nuova Password"
                                                                               aria-describedby="basic-addon1" value="">
                                                                    </div>
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-lock"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input required id="conferma-nuova-password"
                                                                               name="ConfermaNuovaPassword" type="text"
                                                                               class="form-control"
                                                                               placeholder="Conferma nuova Password"
                                                                               aria-describedby="basic-addon1" value="">
                                                                    </div>
                                                                    <div class="alert alert-danger  alert-dismissible"
                                                                         role="alert"
                                                                         id="password-errors" style="display: none">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right"
                                                                                        id="save-pass-button">Salva
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse4">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Dati anagrafici
                                                    </h4>
                                                    <p>Visualizza e modifica i dati anagrafici del tuo account</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse4" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row" id="edit-name">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 simple-row">
                                                                Nome
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 simple-row">
                                                                <?php echo $user->getNome() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenu1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right"
                                                                    aria-labelledby="dropdownMenu1">
                                                                    <li>
                                                                        <a onclick="$('#edit-name').toggleWith('#edit-name-input')">Modifica</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form action="<?php echo DOMINIO_SITO;?>/modificaDati" method="post"
                                                                  class="form form-horizontal" id="edit-name-input"
                                                                  style="display:none">
                                                                <input type="hidden" name="formName" value="name">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-user"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" name="name"
                                                                               class="form-control"
                                                                               placeholder="Nuovo Nome"
                                                                               aria-describedby="basic-addon1"
                                                                        >
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#edit-name-input').toggleWith('#edit-name')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-surname">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Cognome
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php echo $user->getCognome() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenu1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right"
                                                                    aria-labelledby="dropdownMenu1">
                                                                    <li>
                                                                        <a onclick="$('#edit-surname').toggleWith('#edit-surname-input')">Modifica</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form action="<?php echo DOMINIO_SITO;?>/modificaDati" method="post"
                                                                  class="form form-horizontal" id="edit-surname-input"
                                                                  style="display:none">
                                                                <input type="hidden" name="formName" value="surname">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-user"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" name="surname"
                                                                               class="form-control"
                                                                               placeholder="Nuovo Cognome"
                                                                               aria-describedby="basic-addon1"
                                                                        >
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#edit-surname-input').toggleWith('#edit-surname')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-description">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Descrizione
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php
                                                                    $description = $user->getDescrizione();
                                                                    if(($description == "") || (!isset($description))){
                                                                        echo "Nessuna Descrizione inserita.";
                                                                    }
                                                                    else{
                                                                        echo $user->getDescrizione();
                                                                    }

                                                                ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenu1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right"
                                                                    aria-labelledby="dropdownMenu1">

                                                                    <?php
                                                                    $description = $user->getDescrizione();
                                                                    if ((isset($description)) || ($user->getDescrizione() == "")) {
                                                                        ?>
                                                                        <li>
                                                                            <a onclick="$('#edit-description').toggleWith('#edit-description-input')">Aggiungi</a>
                                                                        </li>
                                                                    <?php } else { ?>
                                                                        <li>
                                                                            <a onclick="$('#edit-description').toggleWith('#edit-description-input')">Modifica</a>
                                                                        </li>
                                                                    <?php } ?>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form action="<?php echo DOMINIO_SITO;?>/modificaDati" method="post"
                                                                  class="form form-horizontal"
                                                                  id="edit-description-input" style="display:none">
                                                                <input type="hidden" name="formName"
                                                                       value="description">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-map-marker"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" name="description"
                                                                               placeholder="Descrizione"
                                                                               class="form-control"
                                                                               aria-describedby="basic-addon1">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#edit-description-input').toggleWith('#edit-description')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-birthdate">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Data di nascita
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php echo $user->getDataNascita() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenu1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right"
                                                                    aria-labelledby="dropdownMenu1">
                                                                    <li>
                                                                        <a onclick="$('#edit-birthdate').toggleWith('#edit-birthdate-input')">Modifica</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form action="<?php echo DOMINIO_SITO;?>/modificaDati" method="post"
                                                                  class="form form-horizontal" id="edit-birthdate-input"
                                                                  style="display:none">
                                                                <input type="hidden" name="formName" value="birthdate">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-calendar"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input type="date" name="birthdate"
                                                                               class="form-control"
                                                                               aria-describedby="basic-addon1"
                                                                               value="<?php echo $user->getDataNascita() ?>">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#edit-birthdate-input').toggleWith('#edit-birthdate')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-location">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Localit&agrave;
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php echo $user->getCitta() ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenu1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right"
                                                                    aria-labelledby="dropdownMenu1">
                                                                    <li>
                                                                        <a onclick="$('#edit-location').toggleWith('#edit-location-input')">Modifica</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form action="<?php echo DOMINIO_SITO;?>/modificaDati" method="post"
                                                                  class="form form-horizontal" id="edit-location-input"
                                                                  style="display:none">
                                                                <input type="hidden" name="formName" value="location">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-map-marker"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" name="location"
                                                                               class="form-control"
                                                                               placeholder="Nuova Localit&agrave;"
                                                                               aria-describedby="basic-addon1"
                                                                        >
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#edit-location-input').toggleWith('#edit-location')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row" id="edit-partitaIva">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Partita IVA
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-xs-8 overlined-row">
                                                                <?php
                                                                $patitaIva = $user->getPartitaIva();
                                                                if (($user->getPartitaIva() == "") || (!isset($patitaIva))) {
                                                                    echo "Non hai inserito la partita IVA";
                                                                } else {
                                                                    echo $user->getPartitaIva();
                                                                }
                                                                ?>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenu1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right"
                                                                    aria-labelledby="dropdownMenu1">
                                                                    <?php
                                                                    $patitaIva = $user->getPartitaIva();
                                                                    if ((isset($patitaIva)) || ($user->getPartitaIva() == "")) {
                                                                        ?>
                                                                        <li>
                                                                            <a onclick="$('#edit-partitaIva').toggleWith('#edit-partitaIva-input')">Aggiungi</a>
                                                                        </li>
                                                                    <?php } else { ?>
                                                                        <li>
                                                                            <a onclick="$('#edit-partitaIva').toggleWith('#edit-partitaIva-input')">Modifica</a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- FORM MODIFICA !-->
                                                        <div class="row">
                                                            <form action="<?php echo DOMINIO_SITO;?>/modificaDati" method="post"
                                                                  class="form form-horizontal"
                                                                  id="edit-partitaIva-input" style="display:none">
                                                                <input type="hidden" name="formName" value="partitaIva">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-map-marker"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <input type="text" name="partitaIva"
                                                                               class="form-control"
                                                                               placeholder="Partita IVA"
                                                                               aria-describedby="basic-addon1">
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#edit-partitaIva-input').toggleWith('#edit-partitaIva')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section">
                                        <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i>
                                            Gestione categorie
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse5">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Visualizza, aggiungi macrocategorie
                                                    </h4>
                                                    <p>Visualizza, aggiungi ed elimina le macrocategorie di
                                                        competenza</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse5" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php
                                                        foreach ($macroListUtente as $macro) { ?>
                                                            <div class="row">
                                                                <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                    <span class="label label-primary"><?php echo $macro->getNome() ?></span>
                                                                </div>

                                                                <div class="dropdown corner-dropdown">
                                                                    <button class="btn btn-default dropdown-toggle"
                                                                            id="dropdownMenu1" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="true">
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right"
                                                                        aria-labelledby="dropdownMenu1">
                                                                        <li>
                                                                            <a href="<?php echo "rimuoviMacroUtenteControl?idMacro=" . $macro->getId() ?>">Rimuovi</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                        <div class="row" id="add-macro">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <a onclick="$('#add-macro').toggleWith('#macro-input')">
                                                                    <i class="fa fa-plus"></i>
                                                                    Aggiungi macrocategoria
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal"
                                                                  action="<?php echo DOMINIO_SITO;?>/aggiungiMacroUtente" method="post"
                                                                  id="macro-input" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">

                                                                    <div class="input-group">
                                                        	            <span class="input-group-addon"
                                                                              id="basic-addon1">
																            <i class="fa fa-tag" aria-hidden="true"></i>
															            </span>

                                                                        <select class="form-control select2"
                                                                                name="getIdMacro" form="macro-input">
                                                                            <?php
                                                                            foreach ($macroList as $macro) {
                                                                                if (array_search($macro, $macroListUtente) === FALSE) { ?>
                                                                                    <option value="<?php echo $macro->getId() ?>"><?php echo $macro->getNome() ?></option>
                                                                                <?php }
                                                                            } ?>
                                                                            <option value="" disabled selected>Seleziona
                                                                                la Macrocategoria
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#macro-input').toggleWith('#add-macro')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#profile-collapse6">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Visualizza, aggiungi microcategorie
                                                    </h4>
                                                    <p>Visualizza, aggiungi ed elimina le microcategorie di
                                                        competenza</p>
                                                </div>
                                            </a>
                                            <div id="profile-collapse6" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php
                                                        foreach ($microListUtente as $micro) { ?>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-9 col-xs-12 overlined-row">
                                                                    <span class="label label-default"><?php echo $micro->getMacroCategoria()->getNome() ?></span>

                                                                    <?php randomColorLabel($micro->getMicroCategoria()->getNome(), $micro->getMicroCategoria()->getNome()) ?>
                                                                </div>
                                                                <div class="dropdown corner-dropdown">

                                                                    <button class="btn btn-default dropdown-toggle"
                                                                            type="button" id="dropdownMenu1"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="true">
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right"
                                                                        aria-labelledby="dropdownMenu1">
                                                                        <li>
                                                                            <a href="<?php echo "rimuoviMicroUtenteControl?idMicro=" . $micro->getMicroCategoria()->getId() ?>">Rimuovi</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <?php } ?>
                                                        <div class="row" id="add-micro">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <a onclick="$('#add-micro').toggleWith('#micro-input')">
                                                                    <i class="fa fa-plus"></i>
                                                                    Aggiungi microcategoria
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="micro-input"
                                                                  style="display:none" action="<?php echo DOMINIO_SITO;?>/aggiungiMicroUtente"
                                                                  method="post">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-tag"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <select class="form-control select2"
                                                                                name="macro" id="id-macro-selected">
                                                                            <?php
                                                                            foreach ($macroList as $macro) {
                                                                                ?>
                                                                                <option value="<?php echo $macro->getId() ?>"><?php echo $macro->getNome() ?></option>
                                                                                <?php
                                                                            } ?>
                                                                            <option value="" disabled selected>Seleziona
                                                                                la Macrocategoria
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group" id="creaMicro">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <input type="text" class="form-control"
                                                                                       placeholder="Crea una nuova Microcategoria"
                                                                                       name="newMicro" required
                                                                                       id="create-new-micro">

                                                                                <button type="submit"
                                                                                        id="save-new-micro"
                                                                                        class="btn btn-success pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-primary pull-right"
                                                                                        onclick="$('#micro-input').toggleWith('#micro-input1')">
                                                                                    Seleziona
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#micro-input').toggleWith('#add-micro')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="alert alert-danger  alert-dismissible"
                                                                         role="alert"
                                                                         id="micro-errors" style="display: none">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="micro-input1"
                                                                  style="display:none" action="<?php echo DOMINIO_SITO;?>/aggiungiMicroUtente"
                                                                  method="post">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-tag"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <select class="form-control select2"
                                                                                name="macro" id="macro"
                                                                                onchange="caricaMicro()">
                                                                            <?php
                                                                            foreach ($macroList as $macro) {
                                                                                ?>
                                                                                <option value="<?php echo $macro->getId() ?>"><?php echo $macro->getNome() ?></option>
                                                                                <?php
                                                                            } ?>
                                                                            <option value="" disabled selected>Seleziona
                                                                                la Macrocategoria
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group">
																			<span class="input-group-addon"
                                                                                  id="basic-addon1">
																				<i class="fa fa-tags"
                                                                                   aria-hidden="true"></i>
																			</span>
                                                                        <select class="form-control select2" id="micro"
                                                                                name="idMicro" form="micro-input1">
                                                                            <option value="" disabled selected>Seleziona
                                                                                la Microcategoria
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group" id="selectMicro">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit"
                                                                                        id="save-new-micro1"
                                                                                        class="btn btn-success pull-right">
                                                                                    Salva
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-primary pull-right"
                                                                                        onclick="$('#micro-input1').toggleWith('#micro-input')">
                                                                                    Crea
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        onclick="$('#micro-input1').toggleWith('#add-micro')">
                                                                                    Cancella
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="alert alert-danger  alert-dismissible"
                                                                         role="alert"
                                                                         id="micro-errors1" style="display: none">
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
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="section">
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse" href="#privacy-collapse1">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Blocca Utente
                                                    </h4>
                                                    <p>Vedi l'elenco ed effettua i cambiamenti che desideri apportare</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php
                                                        foreach($blockedUsers as $u){?>
                                                            <div class="row">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <div class="media social-post profile-block">
                                                                    <div class="media-left">
                                                                        <a href="<?php echo DOMINIO_SITO.'/ProfiloUtente/'.$u->getId()?>">
                                                                            <img src="<?php echo getUserImageBig($u); ?>">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="media-heading">
                                                                            <h4 class="title"><?php echo getUserFullName($u);?></h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="dropdown corner-dropdown">

                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                                    <li><a href="<?php echo "sbloccaUtente?idUtente=".$u->getId()?>">Sblocca</a></li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                        <?php }?>
                                                        <div class="row" id="add-userblock">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
                                                                <a onclick="$('#add-userblock').toggleWith('#userblock-input')" >
                                                                    <i class="fa fa-plus"></i>
                                                                    Blocca nuovo utente
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row">
                                                            <form class="form form-horizontal" id="userblock-input" action="<?php echo DOMINIO_SITO;?>/bloccaUtente" method = "post" style="display:none">
                                                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">

                                                                </div>
                                                                <div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
                                                                    <div class="input-group">
																			<span class="input-group-addon" id="basic-addon1">
																				<i class="fa fa-user" aria-hidden="true"></i>
																			</span>
                                                                        <select class="form-control select2" name="blockUserid" id="user-search">
                                                                            <option value="AL">Fabiano Pecorelli</option>
                                                                            <option value="WY">Antonio Luca D'avanzo</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                <button type="submit" class="btn btn-primary pull-right">Salva</button>
                                                                                <button type="button" class="btn btn-default pull-right" onclick="$('#userblock-input').toggleWith('#add-userblock')">Cancella</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#privacy-collapse2">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Visibilit&agrave; informazioni personali
                                                    </h4>
                                                    <p>Scegli quali informazioni del tuo profilo vuoi rendere visibile
                                                        agli altri utenti</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 simple-row">
                                                                Indirizzi Email
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-xs-8 simple-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox1">
                                                                    <label for="checkbox1">
                                                                        Blocca
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Numeri di telefono
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-xs-8 overlined-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox2">
                                                                    <label for="checkbox2">
                                                                        blocca
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-xs-4 overlined-row">
                                                                Dati anagrafici
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-xs-8 overlined-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox3">
                                                                    <label for="checkbox3">
                                                                        blocca
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#privacy-collapse3">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Condivisione di dati con terze parti
                                                    </h4>
                                                    <p>Scegli se possiamo condividere le informazioni di base del tuo
                                                        profilo con terze parti</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-xs-8 simple-row">
                                                                Acconsenti al trattamento di dati personali da terze
                                                                parti?
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-xs-4 simple-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox4">
                                                                    <label for="checkbox4">
                                                                        Acconsento
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#privacy-collapse4">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Processo di verifica in due passaggi
                                                    </h4>
                                                    <p>Attiva questa funzionalit&agrave; per una maggiore protezione nel
                                                        tuo account</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse4" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-xs-8 simple-row">
                                                                Processo di verifica in due passaggi
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-xs-4 simple-row">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="checkbox4">
                                                                    <label for="checkbox4">
                                                                        Attivato
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default compact-panel">
                                            <a class="panel-default collapse-title" data-toggle="collapse"
                                               href="#privacy-collapse5">
                                                <div class="panel-heading">
                                                    <h4 class="media-heading">
                                                        Cancellazione Account
                                                    </h4>
                                                    <p>Se lo desideri, puoi eliminare il tuo account dal sistema</p>
                                                </div>
                                            </a>
                                            <div id="privacy-collapse5" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <!-- FORM INSERIMENTO !-->
                                                        <div class="row" id="edit-mail">
                                                            <div class="col-lg-9 col-md-9 col-xs-12 simple-row">
                                                                Eseguendo questa procedura il tuo account sarà rimosso
                                                                da CrowdMine.
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-xs-12 simple-row">
                                                                <div class="form-footer">
                                                                    <div class="form-group">
                                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                                            <button class="btn btn-danger pull-right"
                                                                                    data-toggle="modal"
                                                                                    data-target="#CancelAccountModal">
                                                                                Cancella Account
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
                        <div role="tabpanel" class="tab-pane" id="tab3">

                            <?php
                            for ($i = 0; $i < count($annunci); $i++) {
                                if ($annunci[$i]->getStato() != StatoAnnuncio::SEGNALATO) {
                                    $aId = $annunci[$i]->getId();
                                    ?>
                                    <div class="row" style="margin-right: 20%; height: auto; margin-top: 5%">

                                        <div class="card">

                                            <div class="row col-md-12 col-sm-12 col-xs-12 card-header"
                                                 style="margin-left: 0%">
                                                <div class="col-md-3 col-sm-3 media-left">
                                                    <a href="#">
                                                        <img src="<?php echo getUserImageBig($user, true); ?>"
                                                             width="100%;"/>
                                                    </a>
                                                </div>
                                                <div class="col-md-7 annuncioTitle" style="width: 100%;">

                                                    <div class="owner col-md-12 col-sm-12"
                                                         style="border-bottom: 1px solid #eee;">
                                                        <h1><?php echo getUserFullName($user, true); ?></h1>
                                                    </div>

                                                    <div class="offerta col-md-12 col-sm-12">
                                                        <h1><?php echo $annunci[$i]->getTitolo(); ?></h1>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-2 preferites">
                                                    <ul class="card-action">
                                                        <li class="dropdown">
                                                            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-cog" style="font-size: 200%;"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="cancellaAnnuncio?id=<?php echo $annunci[$i]->getId(); ?>">Cancella
                                                                        annuncio</a></li>
                                                                <li>
                                                                    <a href="modificaAnnuncio?id=<?php echo $annunci[$i]->getId(); ?>">Modifica
                                                                        annuncio</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="row col-md-12 col-sm-12 col-xs-12 card-body"
                                                 style="margin-left: 0%">
                                                <div class="media-body comment more">
                                                    <?php echo $annunci[$i]->getDescrizione(); ?>
                                                </div>

                                            </div>

                                            <div class="row col-md-12 col-sm-12 col-xs-12 media-categories"
                                                 style="margin-left: 2%; margin-bottom: 2%; margin-top: -2%;">
                                                <?php
                                                if (isset($AnnunciMicroRef[$aId]))
                                                    for ($z = 0; $z < count($AnnunciMicroRef[$aId]); $z++) {
                                                        $micro = $listaMicro[$AnnunciMicroRef[$aId][$z]];
                                                        echo randomColorLabel($micro->getNome(), $micro->getNome());
                                                    }
                                                ?>
                                                <span
                                                    class="label label-info"><?php echo $annunci[$i]->getLuogo(); ?></span>
                                                <span
                                                    class="label label-primary"><?php echo $annunci[$i]->getRetribuzione(); ?>
                                                    €</span>
                                            </div>

                                            <div class="media-comment" style="">
                                                <button class="btn btn-link<?php echo $annunci[$i]->getId(); ?>">
                                                    <i class="fa fa-comments-o"></i> <?php echo isset($listaCommenti[$aId]) ? count($listaCommenti[$aId]) : 0 ?>
                                                    commenti
                                                </button>
                                                <button type="button"
                                                        class="btn btn-warning<?php echo $annunci[$i]->getId(); ?>"><?php echo isset($listaCandidature[$aId]) ? count($listaCandidature[$aId]) : 0 ?>
                                                    candidature
                                                </button>
                                            </div>


                                            <div
                                                class="row col-md-12 col-sm-12 card contenitore<?php echo $annunci[$i]->getId(); ?>"
                                                style="margin-left: 0; display: none">
                                                <?php
                                                if (isset($listaCommenti[$aId]))
                                                    for ($z = 0; $z < count($listaCommenti[$aId]); $z++) {
                                                        $u = $listaUtenti[$listaCommenti[$aId][$z]->getIdUtente()];
                                                        ?>
                                                        <div class="row col-md-12 col-sm-12 comment-body"
                                                             style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                                                            <div class="col-md-1 col-sm-1 media-left"
                                                                 style="margin-top: 1%">
                                                                <a href="#">
                                                                    <img src="<?php echo getUserImageBig($u, true); ?>"
                                                                         width="100%;"/>
                                                                </a>
                                                            </div>
                                                            <div class="media-heading">
                                                                <h4 class="title">
                                                                    <?php
                                                                    echo getUserFullName($u, true);
                                                                    ?>
                                                                </h4>
                                                                <h5 class="timeing"><?php
                                                                    echo $listaCommenti[$aId][$z]->getData();
                                                                    ?>
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-5 col-sm-5 options"
                                                                 style="float: right; margin-top: -8%; margin-right: -23%">
                                                                <a href="segnalaCommento?id=<?php echo $listaCommenti[$aId][$z]->getId(); ?>">
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
                                            </div>

                                            <div class="row col-md-12 col-sm-12 card candidature<?php echo $aId; ?>"
                                                 style="margin-left: 0; display: none">

                                                <?php
                                                if (isset($listaCandidature[$aId]))
                                                    for ($z = 0; $z < count($listaCandidature[$aId]); $z++) {
                                                        $u = $listaUtenti[$listaCandidature[$aId][$z]->getIdUtente()];
                                                        ?>
                                                        <div class="row col-md-12 col-sm-12 candidature-body"
                                                             style="margin-left: 0">

                                                            <div class="media-left col-md-12 col-sm-12 candidato-body"
                                                                 style="margin-left: 0; border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%;">
                                                                <img class="col-md-2 col-sm-2"
                                                                     src="<?php echo getUserImageBig($u, true); ?>"
                                                                     style="margin-left: -5%">
                                                                <h4 class="title" style="margin-top: 3%">
                                                                    <?php
                                                                    echo getUserFullName($u, true);
                                                                    ?>
                                                                </h4>
                                                                <div class="media-content">
                                                                    <?php echo $listaCandidature[$aId][$z]->getCorpo(); ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            <?php
                            for ($i = 0; $i < count($annunci); $i++) {
                                if ($annunci[$i]->getStato() == StatoAnnuncio::SEGNALATO) {
                                    $aId = $annunci[$i]->getId();
                                    $u = $listaUtenti[$annunci[$i]->getIdUtente()];
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="media social-post">
                                                <div class="section">
                                                    <div class="section-body">
                                                        <div class="media-body">
                                                            <div class="media-heading">
                                                                <h4><b><?php echo $annunci[$i]->getTitolo(); ?></b></h4>
                                                            </div>

                                                            <div class="media-content">
                                                                <?php echo $annunci[$i]->getDescrizione(); ?>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-xs-12 simple-row"
                                                                 style="padding-left: 0px">
                                                                <?php
                                                                if (isset($AnnunciMicroRef[$aId]))
                                                                    for ($z = 0; $z < count($AnnunciMicroRef[$aId]); $z++) {
                                                                        $micro = $listaMicro[$AnnunciMicroRef[$aId][$z]];
                                                                        echo randomColorLabel($micro->getNome(), $micro->getNome()) . " ";
                                                                    }
                                                                ?>
                                                            </div>
                                                            <div class="media-comment" style="">
                                                                <button class="btn btn-link<?php echo $annunci[$i]->getId(); ?>">
                                                                    <i class="fa fa-comments-o"></i> <?php echo isset($listaCommenti[$aId]) ? count($listaCommenti[$aId]) : 0 ?>
                                                                    commenti
                                                                </button>
                                                                <button type="button"
                                                                        class="btn btn-warning<?php echo $annunci[$i]->getId(); ?>"><?php echo isset($listaCandidature[$aId]) ? count($listaCandidature[$aId]) : 0 ?>
                                                                    candidature
                                                                </button>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-xs-12 simple-row">
                                                                    <form action="<?php echo DOMINIO_SITO;?>/reclamaAnnuncio" method="post">
                                                                        <div class="form-footer">
                                                                            <div class="form-group">
                                                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                                                    <input type="text" name="idAnnuncio" hidden value="<?php echo$annunci[$i]->getId();?>">
                                                                                    <button type="submit" class="btn btn-danger pull-right">
                                                                                        Reclama
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>


                                                            <div
                                                                class="row col-md-12 col-sm-12 card contenitore<?php echo $annunci[$i]->getId(); ?>"
                                                                style="margin-left: 0; display: none">
                                                                <?php
                                                                if (isset($listaCommenti[$aId]))
                                                                    for ($z = 0; $z < count($listaCommenti[$aId]); $z++) {
                                                                        $u = $listaUtenti[$listaCommenti[$aId][$z]->getIdUtente()];
                                                                        ?>
                                                                        <div class="row col-md-12 col-sm-12 comment-body"
                                                                             style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                                                                            <div class="col-md-1 col-sm-1 media-left"
                                                                                 style="margin-top: 1%">
                                                                                <a href="#">
                                                                                    <img src="<?php echo getUserImageBig($u, true); ?>"
                                                                                         width="100%;"/>
                                                                                </a>
                                                                            </div>
                                                                            <div class="media-heading">
                                                                                <h4 class="title">
                                                                                    <?php
                                                                                    echo getUserFullName($u, true);
                                                                                    ?>
                                                                                </h4>
                                                                                <h5 class="timeing"><?php
                                                                                    echo $listaCommenti[$aId][$z]->getData();
                                                                                    ?>
                                                                                </h5>
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
                                                            </div>

                                                            <div class="row col-md-12 col-sm-12 card candidature<?php echo $aId; ?>"
                                                                 style="margin-left: 0; display: none">

                                                                <?php
                                                                if (isset($listaCandidature[$aId]))
                                                                    for ($z = 0; $z < count($listaCandidature[$aId]); $z++) {
                                                                        $u = $listaUtenti[$listaCandidature[$aId][$z]->getIdUtente()];
                                                                        ?>
                                                                        <div class="row col-md-12 col-sm-12 candidature-body"
                                                                             style="margin-left: 0">

                                                                            <div class="media-left col-md-12 col-sm-12 candidato-body"
                                                                                 style="margin-left: 0; border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%;">
                                                                                <img class="col-md-2 col-sm-2"
                                                                                     src="<?php echo getUserImageBig($u, true); ?>"
                                                                                     style="margin-left: -5%">
                                                                                <h4 class="title" style="margin-top: 3%">
                                                                                    <?php
                                                                                    echo getUserFullName($u, true);
                                                                                    ?>
                                                                                </h4>
                                                                                <div class="media-content">
                                                                                    <?php echo $listaCandidature[$aId][$z]->getCorpo(); ?>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    <?php } ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="myModal2-<?php echo $annunci[$i]->getId(); ?>"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">Attivare l'annuncio?</h4>
                                                    </div>
                                                    <form action="<?php echo DOMINIO_SITO;?>/attivaAnnuncioControl" method="post">
                                                        <div class="modal-footer">
                                                            <input type="text" name="idAnnuncio" hidden
                                                                   value="<?php echo $annunci[$i]->getId(); ?>">
                                                            <button type="button" class="btn btn-sm btn-default"
                                                                    data-dismiss="modal">
                                                                Chiudi
                                                            </button>
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                Attiva
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="myModal3-<?php echo $annunci[$i]->getId(); ?>"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">Disattivare l'annuncio?</h4>
                                                    </div>
                                                    <form action="<?php echo DOMINIO_SITO;?>/disattivaAnnuncioControl" method="post">
                                                        <div class="modal-footer">
                                                            <input type="text" name="idAnnuncio" hidden
                                                                   value="<?php echo $annunci[$i]->getId(); ?>">
                                                            <button type="button" class="btn btn-sm btn-default"
                                                                    data-dismiss="modal">
                                                                Chiudi
                                                            </button>
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                Disattiva
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="myModal4-<?php echo $annunci[$i]->getId(); ?>"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">Inviare all'amministratore?</h4>
                                                    </div>
                                                    <form action="<?php echo DOMINIO_SITO;?>/inviaAnnuncioAdmin" method="post">
                                                        <div class="modal-footer">
                                                            <input type="text" name="idAnnuncio" hidden
                                                                   value="<?php echo $annunci[$i]->getId(); ?>">
                                                            <button type="button" class="btn btn-sm btn-default"
                                                                    data-dismiss="modal">
                                                                Chiudi
                                                            </button>
                                                            <button type="submit" class="btn btn-sm btn-success">Invia
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }?>
                        </div>
                    </div>

                    <div class="modal fade" id="CancelAccountModal" tabindex="-1" role="dialog"
                         aria-labelledby="CancelAccountModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?php echo DOMINIO_SITO;?>/CancellaAccount" method="POST" class="form form-horizontal"
                                      id="tel-input">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Sei sicuro di voler eliminare il tuo Account?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Inserisci la password per cancellare il tuo Account.</p>
                                        <input type="password" class="form-control" name="inputPassword"
                                               placeholder="Password" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                            Chiudi
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-success">Cancella Account</button>
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

<?php include_once VIEW_DIR."footerStart.php";?>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\passwordCheckUtils.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\microCheckUtils.js"></script>


<script>
    /*toggle element and toggle self element*/
    $.fn.toggleWith = function (id) {
        $(id).toggle('fast');
        $(this).toggle('fast');
    };
</script>


<script type="text/javascript">

    $(document).ready(function(){
        <?php
        for ($i = 0; $i < count($annunci); $i++) {
            echo "annuncioButtons(" . $annunci[$i]->getId().");";
        }
        ?>

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
    });

    function annuncioButtons(id){
        $(".btn.btn-link"+id).click(function(){;
            $(".row.col-md-12.col-sm-12.card.contenitore"+id).toggle(250);
            $(".row.col-md-12.col-sm-12.card.candidature"+id).hide(250);
        });

        $(".btn.btn-warning"+id).click(function(){
            $(".row.col-md-12.col-sm-12.card.candidature"+id).toggle(250);
            $(".row.col-md-12.col-sm-12.card.contenitore"+id).hide(250);
        });
    }

    function caricaMicro(){
        var stringa = "micro";
        var index = $("#macro").val();
        $.post("<?php echo DOMINIO_SITO;?>/asyncMicroListByMacro",
            {nome:stringa,idMacro:index},
            function (data){
                var sel = $("#micro").html(data);
            });
    }

    function ricercaUtente(stringa){
        $.post("<?php echo DOMINIO_SITO;?>/asyncRicercaUtente",
            {nome: stringa},
            function (data) {
                var valore = $('.select2-search__field').val();
                $("#user-search").html(data);
                if($("#user-search").select2 && $("#user-search").is(":visible")) {
                    $("#user-search").select2("destroy");
                    $("#user-search").select2();
                    $("#user-search").select2("open");

                    search_select();
                    $('.select2-search__field').val(valore);
                }
            });
    }

    $(document).on('focus', '.select2', function() {
        search_select();
    });

    function search_select() {
        $('.select2-search__field').keydown(function (e) {
            setTimeout(function(){

                var stringa = $('.select2-search__field').val();
                ricercaUtente(stringa);
            },10); //very important, let pass some time to get the true value
        })
    }

    ricercaUtente("");


</script>

<?php include_once VIEW_DIR."footerEnd.php";?>


</body>
</html>