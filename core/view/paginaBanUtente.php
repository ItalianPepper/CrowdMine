<!DOCTYPE html>
<html lang="en">
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

        <!-- iCheck -->
        <link href="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>plugins/iCheck/all.css">

        <style>
            .form-box input {
                width: 100%;
            }

            .form-box {
                max-width: 400px;
                margin-top: 30px;
                margin-left: auto;
                margin-right: auto;
            }

            .form-box .form-line {
                width: 100%;
                position: relative;
                text-align: center;
                font-size: 0.9em;
                z-index: 2;
                margin-top: 20px;
                margin-bottom: 20px;
                color: #8d9293;
            }

            .form-box .form-line:after {
                content: '';
                position: absolute;
                width: 50%;
                bottom: 50%;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: 1;
                border-bottom: 1px solid #dfe6e8;
            }

            .form-box .form-line .title {
                background-color: #FFF;
                position: relative;
                z-index: 2;
                width: 64px;
                margin: 0 auto;
            }

            .form-box-head {
                padding: 5px;
                margin-bottom: -5px;
            }

            .form-box.alert-box .card {
                color: #d73727;
                border-color: #f3b1ab;
                background-color: #fdc3bd;
                border-radius: 3px;
                border-width: 1px;
                border-style: solid;
            }

            .form-box.alert-box .form-line .title {
                color: #d73727;
                background-color: #fdc3bd;
            }

            .form-box.alert-box .form-line:after {
                content: '';
                position: absolute;
                width: 50%;
                bottom: 50%;
                left: 50%;
                transform: translate(-50%, 0);
                z-index: 1;
                border-bottom: 1px solid #f3b1ab;
            }

            .form-box.alert-box textarea {
                background: white;
            }


        </style>

    </head>

    <body>
        <div class="app app-default">
            <div class="row">
                <div class="form-box">
                    <div class="card text-center">
                        <div class="form-box-head">
                            <h2><i class="fa fa-warning"></i> Account Bloccato</h2>
                        </div>
                        <div class="card-body">
                            <div align="center" style="text-align:center">
                                <p><strong>Il tuo account è stato bloccato in seguito a una segnalazione.</strong></p>

                                <?php if ($user->getStato() == StatoUtente::BANNATO) { ?>
                                    <p>Puoi inviarci un messaggio di reclamo:</p>
                                    <form action="<?php echo DOMINIO_SITO . '/ricorso'; ?>" method="POST">
                                        <div class="input-group">
                                            <textarea name="text" rows="3" class="form-control"></textarea>
                                        </div>

                                        <div class="text-center">
                                            <input type="submit" class="btn btn-success btn-submit" value="Effettua ricorso">
                                        </div>
                                    </form>

                                    <div class="form-line">
                                        <div class="title">Oppure</div>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Hai gia effettuato ricorso!</strong> il tuo messaggio è stato inviato ai
                                        moderatori</a>
                                    </div>
                                <?php } ?>
                                <div class="form-footer">
                                    <a class="btn btn-primary" href="<?php echo DOMINIO_SITO . '/logout'; ?>">
                                        <div class="info">
                                            <div class="title">Logout</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/vendor.js"></script>
        <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/app.js"></script>
        <script src="<?php echo STYLE_DIR; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.js"></script>
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