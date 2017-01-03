<?php
include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR . "Messaggio.php";
include_once MANAGER_DIR . "MessaggioManager.php";

//RECUPERA L'UTENTE CONNESSO
$utente_connesso = new Utente(2, 'Alfredo', 'Fiorillo', "38093", "Sal", "aprile", "alfred.fiorillo@gmail.com", "password", "stato", "amministratore", "immagine");
        
$manager_msg = new MessaggioManager();
$num_messaggi_non_letti = $manager_msg->numberMessaggiNotVisualized($utente_connesso->getId());
?>

<li class="dropdown notification">
    <a href="" class="dropdown-toggle" data-toggle="dropdown">
        <div class="icon"><i class="fa fa-book" aria-hidden="true"></i></div>
        <div class="title">I miei annunci</div>
        <div class="count">0</div>
    </a>
    <div class="dropdown-menu">
        <ul>
            <li class="dropdown-header">I miei annunci</li>
            <li class="dropdown-empty">No New Ordered</li>
            <li class="dropdown-footer">
                <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
</li>
<li class="dropdown notification warning">
    <a href="http://localhost/CrowdMine/messaging" class="dropdown-toggle" data-toggle="dropdown">
        <div class="icon"><i class="fa fa-comments" aria-hidden="true"></i></div>
        <div class="title">Messaggi</div>
        
        <?php
            if ($num_messaggi_non_letti>0){
                echo '<div class="count">';
                //echo $num_messaggi_non_letti;
                echo '</div>';
            }

        ?>
       
    </a>
</li>

<li class="dropdown notification danger">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
        <div class="title">System Notifications</div>
        <div class="count">10</div>
    </a>
    <div class="dropdown-menu">
        <ul>
            <li class="dropdown-header">Notification</li>
            <li>
                <a href="#">
                    <span class="badge badge-danger pull-right">8</span>
                    <div class="message">
                        <div class="content">
                            <div class="title">New Order</div>
                            <div class="description">$400 total</div>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="badge badge-danger pull-right">14</span>
                    Inbox
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="badge badge-danger pull-right">5</span>
                    Issues Report
                </a>
            </li>
            <li class="dropdown-footer">
                <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
</li>


<!-- MEMU PROFILO -->
<li class="dropdown profile">
    <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
        <img class="profile-img" src="<?php echo STYLE_DIR ?>./assets/images/profile.png">
        <div class="title">Profilo</div>
    </a>
    <div class="dropdown-menu">
        <div class="profile-info">
            <h4 class="username">Alfredo Fiorillo</h4>
        </div>
        <ul class="action">
            <li>
                <a href="#">
                    Profilo
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="badge badge-danger pull-right">5</span>
                    I miei preferiti
                </a>
            </li>
            <li>
                <a href="#">
                    Setting
                </a>
            </li>
            <li>
                <a href="#">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</li>

