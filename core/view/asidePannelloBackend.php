<aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header">
        <a class="sidebar-brand" href="#"><span class="highlight">
                <?php
                    switch($user->getRuolo()) {
                        case RuoloUtente::MODERATORE:
                            echo "Moderatore";
                        break;
                        case RuoloUtente::AMMINISTRATORE:
                            echo "Admin";
                        break;
                    }
                ?>
                </span></a>
        <button type="button" class="sidebar-toggle">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="sidebar-menu">
        <ul class="sidebar-nav">
            <li class="dropdown " id="segnalazioni">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="icon">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </div>
                    <div class="title">Gestione Segnalazioni</div>
                </a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="visualizzaUtentiSegnalati">Utenti</a></li>
                        <li><a href="visualizzaAnnunciSegnalati">Annunci</a></li>
                        <li><a href="visualizzaFeedbackSegnalati">Feedback</a></li>
                        <li><a href="visualizzaCommentiSegnalati">Commenti</a></li>
                    </ul>
                </div>
            </li>
            <li class="dropdown " id="categorie">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="icon">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </div>
                    <div class="title">Gestione Categorie</div>
                </a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="<?php echo DOMINIO_SITO;?>/IndexMacrocategorie">Macrocategorie</a></li>
                        <li><a href="<?php echo DOMINIO_SITO;?>/visualizzaIndexMicrocategorie">Microcategorie</a></li>
                    </ul>
                </div>
            </li>
            <li class="dropdown " id="altro">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="icon">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </div>
                    <div class="title">Altro</div>
                </a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="visualizzaUtentiBannati">Lista Utenti Bannati</a></li>
                        <li><a href="visualizzaIndexStatistiche">Statistiche</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>