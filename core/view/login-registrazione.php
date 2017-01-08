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
        <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/vendor.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/flat-admin.css">
        <link rel="shortcut icon" href="<?php echo STYLE_DIR; ?>img/icon_crowdmine.png" type="image/x-icon" />
        <!-- iCheck -->
        <link href="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>plugins/iCheck/all.css">


        <!-- Theme -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/blue-sky.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/blue.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/red.css">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets/css/theme/yellow.css">

        <style>
            .image-container{
                width: 100%;
                display: inline-block;
            }

            .image-box{
                width: 120px;
                height: 120px;
                text-align: center;
                margin: auto;
                display: block;
                padding: 10px;
                position: relative;
            }

            .image-spin{
                position: absolute;
                width: 56%;
                top: 20%;
                left: 24%;
                bottom: 0;
                right: 0;
            }
        </style>

    </head>
    <body>
        <nav class="navbar navbar-default" id="navbar" style="border-left-width: 0px; border-right-width: 0px;">
            <div class="container-fluid" style="padding-right: 0px; padding-left: 0px;">
                <div class="navbar-collapse collapse in">
                    <form class="nav navbar-nav navbar-right" method="post" action="effettuaLogin" onsubmit="return Modulo()" id="modulo">
                        <div class="col-md-12 col-xs-12" style=" padding-top: 3%">
                            <div class="form-group col-md-5 col-xs-5">
                                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                            </div>
                            <div class="form-group col-md-5 col-xs-5">

                                <input style="margin-bottom: 0px;" type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
                                <a href="#" class="text-center ">Hai dimenticato la password?</a>
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
                <form method="post" action="javascript:submitForm()" id="modulo" name="modulo">
                    <h1 class="text-black text-center">Iscriviti</h1>
                    <h4 class="text-black text-center">Il mondo del lavoro &egrave a portata di click!</h4>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nome" placeholder="Nome*" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cognome" placeholder="Cognome*" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="telefono" placeholder="Telefono*" required>
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
                                <div class = "image-container">
                                    <div class="image-box">
                                        <img class="image-spin" src="<?php echo STYLE_DIR; ?>/img/spin.gif" id="spin" style="display: none">
                                        <img src="<?php echo STYLE_DIR; ?>img/userStandard.png" id="previewImage"  class="img-circle" alt="User Image" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="immagine" id="imageInput" id="exampleInputFile">
                                </div>

                            </div>
                        </div>       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <div class="input-group date">
                                    <input type="date" class="form-control pull-right" name="datanascita" id="datepicker" placeholder="Data di nascita*" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar" onclick="document.getElementById('datepicker').focus()"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <select class="form-control select2" name="citta" id="listacitta" style="width: 100%;" required>

                                    </select>
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="name@exemple.com*" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="simple-text">Descrizione:</label>
                                <textarea style="resize: none" class="form-control" name="descrizione" rows="3" placeholder="Inserisci una tua descrizione..."></textarea>
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
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox">
                                <input type="checkbox" name="accetto" id="checkbox1">
                                <label for="checkbox1">
                                    Autorizzo il trattamento dei dati personali
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-flat">Registrati</button>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/vendor.js"></script>
        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/app.js"></script>
        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>/scripts/caricacitta.js"></script>

        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>/assets/js/ImageUploader.js"></script>

        <!-- iCheck -->
        <script src="<?php echo STYLE_DIR; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.js"></script>        
        <script>

            var uploader = new ImageUploader({
                inputElement : $('#imageInput')[0],
                uploadUrl : <?php echo '"'.DOMINIO_SITO.'/effettuaRegistrazione"';?>,
                onProgress : null,
                onStart : function() {
                   $('#submit').attr('disabled','disabled');
                },
                onProcessingEnd : function() {
                    $('#submit').removeAttr('disabled');
                },
                onComplete : function(event,xhr){
                    window.location.href = <?php echo '"'.DOMINIO_SITO.'/auth";';?>
                },
                maxWidth: 150,
                quality: 0.90,
                debug : true
            });

            function submitForm(){

                var fd = new FormData();

                var fields = [  "nome","cognome",
                                "telefono","datanascita",
                                "email","password",
                                "passwordretyped","partitaIva",
                                "tipologia","accetto"];

                fields.forEach(function(item){
                    fd.append(item,$('input[name="'+item+'"]').val());
                });

                fd.append("descrizione",$('textarea[name="descrizione"]').html());

                if($('select[name="citta"]').prop("selectedIndex")>0)
                fd.append("citta",$('select[name="citta"]').val());

                if($('imput[name="accetto"]').is(':checked'))
                fd.append("accetto",$('select[name="accetto"]').html());

                uploader.tryUpload(fd);
            }
        </script>
        <script>

            function Modulo() {
                // Variabili associate ai campi del modulo
                var email = document.modulo.inputEmail.value;
                var password = document.modulo.inputPassword.value;
                var email_reg_exp = /^[_a-zA-Z0-9+-]+(\.[_a-zA-Z0-9+-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$/;

                if (!email_reg_exp.test(email) || (email == "") || (email == "undefined")) {
                    toastr["error"]("Inserire un indirizzo email corretto.");
                    document.modulo.inputEmail.select();
                    return false;
                } else if ((password == "") || (password == "undefined") || ((password.length) < 8)) {
                    toastr["error"]("Inserire una password valida.");
                    document.modulo.inputPassword.focus();
                    return false;
                } else {
                    document.modulo.submit();
                    return true;
                }
            }
        </script>


        <?php
        if (isset($_SESSION['toast-type']) && isset($_SESSION['toast-message'])) {
            ?>
            <script>
                toastr["<?php echo $_SESSION['toast-type'] ?>"]("<?php echo $_SESSION['toast-message'] ?>");
            </script>
            <?php
            unset($_SESSION['toast-type']);
            unset($_SESSION['toast-message']);
        }
        ?>
    </body>
</html>

