<?php
include_once MODEL_DIR . "/Annuncio.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";
include_once MODEL_DIR . "/Utente.php";
$idUtente="1";
if (isset($_SESSION["lista"])){
    $annunci = unserialize($_SESSION["lista"]);
    $listaCandidature = unserialize($_SESSION["listaCandidature"]);
    $listaCommenti = unserialize($_SESSION["listaCommenti"]);
    $listaUtentiCandidati = unserialize($_SESSION["listaUtentiCandidati"]);
    unset($_SESSION["lista"]);
    unset($_SESSION["listaCandidature"]);
    unset($_SESSION["listaCommenti"]);
    unset($_SESSION["listaUtentiCandidati"]);
} else {
    header("Location: " . DOMINIO_SITO . "/annunciProprietari");
}
include_once VIEW_DIR . 'header.php';
?>
    <?php
    echo "<script>";
    for ($i = 0; $i < count($annunci); $i++) {
        $id = $annunci[$i]->getId();

        echo "$(document).ready(function(){";
        echo "$(\".btn.btn-link$id\").click(function(){";
        echo "$(\".row.col-md-12.col-sm-12.card.contenitore$id\").toggle(250);";
        echo "$(\".row.col-md-12.col-sm-12.card.candidature$id\").hide(250);";
        echo "});";
        echo "});";

        echo "$(document).ready(function(){";
        echo "$(\".btn.btn-warning$id\").click(function(){";
        echo "$(\".row.col-md-12.col-sm-12.card.candidature$id\").toggle(250);";
        echo "$(\".row.col-md-12.col-sm-12.card.contenitore$id\").hide(250);";
        echo "});";
        echo "});";
    }
    echo "</script>";
    ?>



        <?php
        for ($i = 0; $i < count($annunci); $i++) {

        ?>
            <div class="row" style="margin-right: 20%; height: auto; margin-top: 5%">

                <div class="card">

                    <div class="row col-md-12 col-sm-12 col-xs-12 card-header" style="margin-left: 0%">
                        <div class="col-md-3 col-sm-3 media-left">
                            <a href="#">
                                <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                            </a>
                        </div>
                        <div class="col-md-7 annuncioTitle" style="width: 100%;">

                            <div class="owner col-md-12 col-sm-12" style="border-bottom: 1px solid #eee;">
                                <h1><?php echo "Nome del proprietario" ?></h1>
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
                                        <li><a href="cancellaAnnuncio?id=<?php echo $annunci[$i]->getId(); ?>" >Cancella annuncio</a></li>
                                        <li><a href="modificaAnnuncio?id=<?php echo $annunci[$i]->getId(); ?>" >Modifica annuncio</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row col-md-12 col-sm-12 col-xs-12 card-body" style="margin-left: 0%">
                        <div class="media-body comment more">
                            <?php echo $annunci[$i]->getDescrizione(); ?>
                        </div>

                    </div>

                    <div class="row col-md-12 col-sm-12 col-xs-12 media-categories"
                         style="margin-left: 2%; margin-bottom: 2%; margin-top: -2%;">
                        <span class="label label-warning">Informatica</span>
                        <span class="label label-default">Web Developer</span>
                        <span class="label label-info"><?php echo $annunci[$i]->getLuogo();?></span>
                        <span class="label label-primary"><?php echo $annunci[$i]->getRetribuzione();?>€</span>
                    </div>

                    <div class="media-comment" style="">
                        <button class="btn btn-link<?php echo $annunci[$i]->getId();?>">
                            <i class="fa fa-comments-o"></i> <?php echo count($listaCommenti[$i])?> commenti
                        </button>
                        <button type="button" class="btn btn-warning<?php echo $annunci[$i]->getId();?>"><?php echo count($listaCandidature[$i])?> candidature</button>
                    </div>


                    <div class="row col-md-12 col-sm-12 card contenitore<?php echo $annunci[$i]->getId();?>" style="margin-left: 0; display: none">
                        <?php
                        for($z=0;$z<count($listaCommenti[$i]); $z++){
                        ?>
                        <div class="row col-md-12 col-sm-12 comment-body"
                             style="border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%">
                            <div class="col-md-1 col-sm-1 media-left" style="margin-top: 1%">
                                <a href="#">
                                    <img src="<?php echo STYLE_DIR; ?>img\logojet.jpg" width="100%;"/>
                                </a>
                            </div>
                            <div class="media-heading">
                                <h4 class="title">Scott White</h4>
                                <h5 class="timeing"><?php
                                    echo $listaCommenti[$i][$z]->getData();
                                    ?></h5>
                            </div>
                            <div class="col-md-5 col-sm-5 options"
                                 style="float: right; margin-top: -8%; margin-right: -23%">
                                <a href="segnalaCommento?id=<?php echo $listaCommenti[$i][$z]->getId(); ?>">
                                    <button style="background-color: Transparent;background-repeat:no-repeat; border: none;cursor:pointer; overflow: hidden; outline:none;">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="media-content">
                                <?php
                                echo $listaCommenti[$i][$z]->getCorpo();
                                ?>
                            </div>

                        </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="row col-md-12 col-sm-12 card candidature<?php echo $annunci[$i]->getId();?>" style="margin-left: 0; display: none">

                        <?php
                                for($z=0;$z<count($listaCandidature[$i]); $z++){
                            ?>
                        <div class="row col-md-12 col-sm-12 candidature-body" style="margin-left: 0">

                            <div class="media-left col-md-12 col-sm-12 candidato-body"
                                 style="margin-left: 0; border-bottom: solid 1px #eee; margin-top: 2%; margin-bottom: 1%;">
                                <img class="col-md-2 col-sm-2" src="<?php echo STYLE_DIR; ?>img\logojet.jpg"
                                     style="margin-left: -5%">
                                <h4 class="title" style="margin-top: 3%"><?php echo $listaUtentiCandidati[$i][$z]->getNome(); ?></h4>
                                <div class="col-md-5 col-sm-5 options"
                                     style="float: right; margin-top: -8%; margin-right: -23%">
                                    <form method="POST" action="paginaAlfredo">
                                        <input name="idAnnuncio" style="display: none" value="<?php echo $annunci[$i]->getId(); ?>">
                                        <input name="idUtenteCandidato" style="display: none" value="<?php echo $listaUtentiCandidati[$i][$z]->getId(); ?>">
                                        <input name="idUtenteProprietario" style="display: none" value="<?php echo $idUtente; ?>">
                                        <button type="submit" style="background-color: Transparent;background-repeat:no-repeat; border: none;cursor:pointer; overflow: hidden; outline:none;">
                                        <i class="fa fa-mail-reply-all"></i>
                                        </button>
                                    </form
                                    <a href="rimuoviCandidatura?id=<?php echo $listaCandidature[$i][$z]->getId();?>">
                                    <button style="background-color: Transparent;background-repeat:no-repeat; border: none;cursor:pointer; overflow: hidden; outline:none;">
                                        <i class="fa fa-close"></i>
                                    </button>
                                    </a>
                                </div>
                                <div class="media-content">
                                    <?php echo $listaCandidature[$i][$z]->getCorpo(); ?>
                                </div>

                            </div>

                        </div>
                        <?php } ?>

                    </div


                </div>
            </div>
</div>
<?php
        }
?>
</div>

        <script>
            $(document).ready(function() {
                var showChar = 500;
                var ellipsestext = "...";
                var moretext = "altro";
                var lesstext = "..meno";
                $('.more').each(function() {
                    var content = $(this).html();

                    if(content.length > showChar) {

                        var c = content.substr(0, showChar);
                        var h = content.substr(showChar-1, content.length - showChar);

                        var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';

                        $(this).html(html);
                    }

                });

                $(".morelink").click(function(){
                    if($(this).hasClass("less")) {
                        $(this).removeClass("less");
                        $(this).html(moretext);
                    } else {
                        $(this).addClass("less");
                        $(this).html(lesstext);
                    }
                    $(this).parent().prev().toggle();
                    $(this).prev().toggle();
                    return false;
                });
            });
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
