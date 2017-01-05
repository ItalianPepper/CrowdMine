<?php
    if(isset($_SESSION['loggedin']) && isset($_SESSION['lista'])){
        $listaNotifiche = json_decode($_SESSION['lista']);
    }else{
        $listaNotifiche = null;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>
    <style>
        .row {
            height: 100%;
        }
    </style>
</head>
<body>
<div class="app app-default">
    <div class="app-container no-sidebar">
        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">Notifiche</div>
                    <div class="card">
                        <ul id="lista-notifiche-all" class="list-group list-group-flush">
                            <?php
                                if($listaNotifiche == null){
                                    echo "<li>Non ci sono notifiche</li>";
                                }
                                else{
                                    foreach($listaNotifiche as $n) {
                                        $notifica = json_decode($n);
                                        if (!$notifica['letto'])
                                            $html = '<li class="list-group-item" id="$notifica[\'idNotify\']" style="background-color: #3399FF">
                                                        <a href="#$notifica[\'href\']">
                                                            <p id="corpo">$notifica[\'text\']</p>
                                                        </a>
                                                    </li>';
                                        else{
                                            $html = '<li class="list-group-item" id="$notifica[\'idNotify\']">
                                                        <a href="#$notifica[\'href\']">
                                                            <p id="corpo">$notifica[\'text\']</p>
                                                        </a>
                                                    </li>';
                                        }
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
</body>
</html>