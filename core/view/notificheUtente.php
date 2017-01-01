<?php
    if(isset($_SESSION['loggedin']) && isset($_SESSION['lista'])){
        $listaNotifiche = $_SESSION['lista'];
    }else{
        $listaNotifiche = null;
    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>CrowdMine</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\rating.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\Annuncio\annuncioUtenteLoggato.css>

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">

    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/vendor.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets/js/app.js"></script>

    <!--include header e footer-->
    <script>
        $(function(){
            $("#header").load("header");
            $("#footer").load("footer");
        })
    </script>

    <style>
        ul{
            margin: 1%;
            list-style-type: none;
        }
        .left5 {
            margin-left: 5%;
            margin-right: 5%;}
    </style>


</head>
<body>
<div id="header"></div>

<div class="app app-default">
    <div class="row left5">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">Notifiche</div>
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <?php
                                if($listaNotifiche == null){
                                    echo "<li>Non ci sono notifiche</li>";
                                }
                                else{
                                    foreach($listaNotifiche as $notifica){
                                        $html = '<li class="list-group-item" id="$notifica[\'id\']">
                                                    <a href="#$notifica[\'link\']">
                                                        <p id="titolo">$notifica[\'titolo\']</p>
                                                        <p id="corpo">$notifica[\'corpo\']</p>
                                                    </a>
                                                    </li>';
                                        echo html;
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer"></div>

</body>
</html>