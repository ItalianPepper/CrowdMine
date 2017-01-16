<!DOCTYPE html>
<html>
<head>

    <title>Crowdmine | Microcategorie</title>
    <?php include_once VIEW_DIR."headerStart.php";?>

    <!-- iCheck -->
    <link href="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>plugins/iCheck/all.css">

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
                                    class="highlight">Microcategorie</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Lista Microcategorie
                    </div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<div class="panel panel-default compact-panel">
												
												
									<div class="panel-body">
										<div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $rowType = "simple-row";

                                            for($i=0;$i<count($micros);$i++) {
                                                $micro = $micros[$i];
                                                if($i==1)   $rowType = "overlined-row";
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-9 col-md-9 col-xs-12 <?php echo $rowType ?>">
                                                        <span class="label label-default"><?php echo $micro->getMacroCategoria()->getNome() ?></span>

                                                        <?php randomColorLabel($micro->getMicroCategoria()->getNome(),$micro->getMicroCategoria()->getNome()) ?>
                                                    </div>
                                                    <div class="dropdown corner-dropdown">

                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                                            <li>
                                                                <a onclick="$('#macro-<?php echo $micro->getMicroCategoria()->getId()?>').submit()">Rimuovi</a>
                                                            </li>
                                                            <form  id="macro-<?php echo $micro->getMicroCategoria()->getId()?>" action="cancellaMicroControl" method="post">
                                                                <input type="hidden" value="<?php echo $micro->getMicroCategoria()->getId()?>" name="id-micro">
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </div> <?php }?>

											<div class="row" id="add-micro">
												<div class="col-lg-9 col-md-9 col-xs-12 overlined-row">
													<a onclick="$('#add-micro').toggleWith('#micro-input')" >
													<i class="fa fa-plus"></i>
														Aggiungi microcategoria
													</a>
												</div>
											</div>
											<!-- FORM INSERIMENTO !-->
											<div class="row">
												<form class="form form-horizontal" id="micro-input" action = "InserisciNuovaMicroControl" method = "post" style="display:none">
													<div class="col-lg-2 col-md-2 hidden-sm hidden-xs overlined-row">
													
													</div>
													<div class="col-lg-5 col-md-6 col-xs-12 overlined-row">
														<div class="input-group">
															<span class="input-group-addon" id="basic-addon1">
																<i class="fa fa-tag" aria-hidden="true"></i>
															</span>
															<select class="form-control select2" name="macro">
                                                                <?php
                                                                foreach ($macroList as $macro) {
                                                                    ?>
                                                                    <option value="<?php echo $macro->getId() ?>"><?php echo $macro->getNome() ?></option>
                                                                    <?php
                                                                } ?>
                                                                <option value="" disabled selected>Seleziona la Macrocategoria</option>
															</select>
														</div>
														<div class="input-group">
															<span class="input-group-addon" id="basic-addon1">
																<i class="fa fa-tag" aria-hidden="true"></i>
															</span>
                                                            <input type="text" class="form-control" placeholder="Crea una nuova Microcategoria" name="newMicro" required id="create-new-micro">
                                                        </div>
														<div class="form-footer">
															<div class="form-group">
																<div class="col-lg-12 col-md-12 col-xs-12">
																	<button type="submit" class="btn btn-primary pull-right">Save</button>
																	<button type="button" class="btn btn-default pull-right" onclick="$('#micro-input').toggleWith('#add-micro')">Cancel</button>
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
                                                            echo $microPageInfo;
                                                            ?>
                                                        </span>
                                        </div>
                                        <div class="pull-right" style="padding:20px 0px">
                                            <ul class="pagination">
                                                <?php showPaginationButtons(DOMINIO_SITO."/IndexMicrocategorie/",$page,$numPages); ?>
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
        <script src="<?php echo STYLE_DIR; ?>plugins/datepicker/bootstrap-datepicker.js"></script>

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