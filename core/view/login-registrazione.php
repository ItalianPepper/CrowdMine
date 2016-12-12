<?php
/**
 * 
 * @author Andrea Buonaguro
 * @version 1.0
 * @since 17/11/16
 */
?>
<html>
    <head>
        <title>CrowdMine | Registrazione</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/vendor.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/flat-admin.css">
        <link rel="shortcut icon" href="<?php echo STYLE_DIR; ?>img/icon_crowdmine.png" type="image/x-icon" />


        <!-- Theme -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/blue-sky.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/blue.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/red.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/yellow.css">

    </head>
    <body>
        <nav class="navbar navbar-default" id="navbar">
            <div class="container-fluid">
                <div class="navbar-collapse collapse in">
                    <form class="nav navbar-nav navbar-right" method="post" action="effettuaLogin" id="formAuth">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group col-md-5 col-xs-5">
                                <label class="sr-only" for="inputEmail">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                            <div class="form-group col-md-5 col-xs-5">
                                <label class="sr-only" for="inputPassword">Password</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                <a href="#" class="text-center ">Hai dimenticato la password? Clicca qui!</a>
                            </div>
                            <button type="submit" class="btn btn-success col-md-2 col-xs-2">Sign in</button>
                        </div>
                    </form>            
                    <ul class="nav navbar-nav navbar-mobile">
                        <img class="navbar img-responsive" src="<?php echo STYLE_DIR; ?>img/logo_crowdmine.png"/>                        
                    </ul>
                    <ul class="nav navbar-nav navbar-left">
                        <img class="navbar" style="height:70%" src="<?php echo STYLE_DIR; ?>img/logo_crowdmine.png"/>
                    </ul>
                </div>             
            </div>
        </nav>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-1"></div>
            <div class="card col-md-10">
                <h4 class="text-black text-center">CrowdMine &egrave un sito nato da lavoratori per i lavoratori,ti permette di interagire facilmente con aziende ed imprenditori.
                    Cosa aspetti? Moltissimi annunci sono qui per te, fai presto!</h4>
                <div class="col-md-9 col-md-offset-1" style="height:105%">
                    <img class="img-responsive" style="height:80%" src="<?php echo STYLE_DIR; ?>img/connecting-people.jpg"/>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-md-1"></div>
            <div class="card col-md-10">            
                <form method="post" action="effettuaRegistrazione" id="modulo" name="modulo">
                    <h1 class="text-black text-center">Iscriviti</h1>
                    <h4 class="text-black text-center">Il mondo del lavoro &egrave a portata di click!</h4>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nome" placeholder="Nome*">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cognome" placeholder="Cognome*">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="telefono" placeholder="Telefono*">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="partitaIva" placeholder="Partita IVA">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-1">                        
                            <div class="user-panel">
                                <label class="pull-left" for="exampleInputFile">Immagine personale</label>
                                <div class="pull-left image" style="margin-bottom: 2%; margin-right: 5%">
                                    <img src="<?php echo STYLE_DIR; ?>img/user-standard.png" id="immagine"  class="img-circle" alt="User Image">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="immagine" onchange="cambiaImmagine(this)" id="exampleInputFile">
                                </div>
                            </div>
                        </div>       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <div class="input-group date">
                                    <input type="text" class="form-control pull-right" name="datanascita" id="datepicker" placeholder="Data di nascita*">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar" onclick="document.getElementById('datepicker').focus()"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <select class="form-control select2" name="citta" id="listacitta" style="width: 100%;">

                                    </select><div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email*">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-5 col-md-offset-1">
                            <label class="simple-text">Sei una società o un' utente ?</label>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="tipologia" value="Cliente" class="flat-red"> Società
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="tipologia" value="Offerente" class="flat-red"> Utente
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password*">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                            </div><div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="passwordretyped" placeholder="Conferma password*">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="simple-text">Descrizione:</label>
                                <textarea style="resize: none" class="form-control" name="descrizione" rows="3" placeholder="Inserisci una tua descrizione..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" class="flat-red" name="accetto" id="accetto" style="position: absolute; opacity: 0;"> Autorizzo il trattamento dei dati personali
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit"  name="submit" class="btn btn-primary btn-block btn-flat">Registrati</button>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>

        <script type="text/javascript" src="../assets/js/vendor.js"></script>
        <script type="text/javascript" src="../assets/js/app.js"></script>

    </body>
</html>

