<!DOCTYPE html>
<html>
<head>

    <title>Crowdmine | Macrocategorie</title>
    <?php include_once VIEW_DIR."headerStart.php";?>
    <style>
        .navbar-collapse.in
        {
            overflow-y: hidden;
        }
    </style>
</head>
<body>
<div class="app app-default">

    <?php include "asidePannelloBackend.php" ?>

    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
        <div class="dropdown-background">
            <div class="bg"></div>
        </div>
        <div class="dropdown-container">
            {{list}}
        </div>
    </script>

    <div class="app-container">
        <?php include_once VIEW_DIR."headerNavBar.php";?>
        <div class="app-head"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body app-heading">
                        <div class="app-title">
                            <div class="title"><span
                                        class="highlight">Macrocategorie</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Lista Macrocategorie
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="panel panel-default compact-panel">
                                    <div class="panel-body">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php

                                            $rowType = "simple-row";

                                            for($i=0;$i<count($macros);$i++) {
                                                    $macro = $macros[$i];
                                                    if($i==1)   $rowType = "overlined-row";
                                                ?>
                                                <div class="row" id="edit-macro<?php echo $macro->getId()?>">
                                                    <div class="col-lg-9 col-md-9 col-xs-12 <?php echo $rowType ?>">
                                                        <?php randomColorLabel($macro->getNome().$macro->getId(),$macro->getNome()) ?>

                                                    </div>

                                                    <div class="dropdown corner-dropdown">

                                                        <button class="btn btn-default dropdown-toggle"
                                                                type="button" id="dropdownMenu"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="true">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right"
                                                            aria-labelledby="dropdownMenu">
                                                            <li>
                                                                <a onclick="$('#macro-<?php echo $macro->getId()?>').submit()">Rimuovi</a>
                                                            </li>
                                                            <form  id="macro-<?php echo $macro->getId()?>" action="cancellaMacroControl" method="post">
                                                                <input type="hidden" value="<?php echo $macro->getId()?>" name="id-macro">
                                                                <input type="hidden" value="<?php echo $macro->getNome()?>" name="nome-macro">
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="row" id="add-macro">
                                                <div class="col-lg-9 col-md-9 col-xs-12 <?php echo $rowType ?>">
                                                    <a onclick="$('#add-macro').toggleWith('#macro-input')" >
                                                        <i class="fa fa-plus"></i>
                                                        Aggiungi macrocategoria
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- FORM INSERIMENTO !-->
                                            <div class="row">
                                                <form class="form form-horizontal" id="macro-input" style="display:none" action="InserisciNuovaMacroControl" method="post">
                                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs <?php echo $rowType ?>">

                                                    </div>
                                                    <div class="col-lg-5 col-md-6 col-xs-12 <?php echo $rowType ?>">
                                                        <div class="input-group">
															<span class="input-group-addon" id="basic-addon1">
																<i class="fa fa-tag" aria-hidden="true"></i>
															</span>
                                                            <input type="text" class="form-control" placeholder="Nuova Categoria" aria-describedby="basic-addon1" value="" name="nuova-macro-nome">
                                                        </div>
                                                        <div class="form-footer">
                                                            <div class="form-group">
                                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                                                    <button type="button" class="btn btn-default pull-right" onclick="$('#macro-input').toggleWith('#add-macro')">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="pull-left" style="padding:20px 0px">
                                        <span style="margin-top: 8px;display: block;">
                                            <?php
                                            echo $macroPageInfo;
                                            ?>
                                        </span>
                                        </div>
                                        <div class="pull-right" style="padding:20px 0px">
                                            <ul class="pagination">
                                                <?php showPaginationButtons(DOMINIO_SITO."/IndexMacrocategorie/",$page,$numPages); ?>
                                            </ul>
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

        <?php include_once VIEW_DIR."footerStart.php";?>

        <script>
            /*evidenzio altro nella barra laterale*/
            $("#categorie").toggleClass("active");
            $('[data-toggle="tooltip"]').tooltip();

            /*toggle element and toggle self element*/
            $.fn.toggleWith = function(id) {
                $(id).toggle('fast');
                $(this).toggle('fast');
            };
        </script>

</body>

<?php include_once VIEW_DIR."footerEnd.php";?>
</html>