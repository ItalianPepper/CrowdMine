<aside class="app-sidebar" style="min-height: 900px;"id="sidebar">
    <div class="sidebar-header">
        <a class="sidebar-brand" href="#">
            <span class="highlight"><?php echo $fullname; ?></span>
        </a>
        <button type="button" class="sidebar-toggle">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="sidebar-menu">
        <ul class="sidebar-nav">

            <li id="inserisciAnnuncio">
                <a href="inserisciAnnuncio">
                    <div class="icon">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <div class="title">Aggiungi Annuncio</div>
                </a>
            </li>

            <li class="">
                <a href="ProfiloPersonale#tab3">
                    <div class="icon">
                        <i class="fa fa-server" aria-hidden="true"></i>
                    </div>
                    <div class="title">I miei annunci</div>
                </a>
            </li>

            <li id="annunciPreferiti">
                <a href="annunciPreferiti">
                    <div class="icon">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="title">Preferiti</div>
                </a>
            </li>

            <li id="ricercaAnnuncio" class="">
                <a href="ricercaAnnuncio">
                    <div class="icon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                    <div class="title">Ricerca</div>
                </a>
            </li>

            <li class="">
                <a href="">
                    <div class="icon">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </div>
                    <div class="title">Statistiche</div>
                </a>
            </li>

            <li class="">
                <a href="">
                    <div class="icon">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </div>
                    <div class="title">Impostazioni</div>
                </a>
            </li>


        </ul>
    </div>
    <div class="sidebar-footer">
        <ul class="menu">
            <li>
                <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                </a>
            </li>
            <li><a href="#"><span class="flag-icon flag-icon-th flag-icon-squared"></span></a></li>
        </ul>
    </div>
</aside>

<script type="text/ng-template" id="sidebar-dropdown.tpl.html">
    <div class="dropdown-background">
        <div class="bg"></div>
    </div>
    <div class="dropdown-container">
        {{list}}
    </div>
</script>