<!DOCTYPE html>
<html>
<head>
    <title>Flat Admin V.3 - Free flat-design bootstrap administrator templates</title>

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
        <nav class="navbar navbar-default" id="navbar">
            <div class="container-fluid">
                <div class="navbar-collapse collapse in">
                    <ul class="nav navbar-nav navbar-mobile">
                        <li>
                            <button type="button" class="sidebar-toggle">
                                <i class="fa fa-bars"></i>
                            </button>
                        </li>
                        <li class="logo">
                            <a class="navbar-brand" href="#"><span class="highlight">Moderatore</span> </a>
                        </li>
                        <li>
                            <button type="button" class="navbar-toggle">
                                <img class="profile-img" src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                            </button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-left">
                        <li class="navbar-search hidden-sm">
                            <input id="search" type="text" placeholder="Search..">
                            <button class="btn-search"><i class="fa fa-search"></i></button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown notification warning">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="icon"><i class="fa fa-comments" aria-hidden="true"></i></div>
                                <div class="title">Unread Messages</div>
                                <div class="count">99</div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li class="dropdown-header">Message</li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-warning pull-right">10</span>
                                            <div class="message">
                                                <img class="profile" src="https://placehold.it/100x100">
                                                <div class="content">
                                                    <div class="title">"Payment Confirmation.."</div>
                                                    <div class="description">Alan Anderson</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-warning pull-right">5</span>
                                            <div class="message">
                                                <img class="profile" src="https://placehold.it/100x100">
                                                <div class="content">
                                                    <div class="title">"Hello World"</div>
                                                    <div class="description">Marco Harmon</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-warning pull-right">2</span>
                                            <div class="message">
                                                <img class="profile" src="https://placehold.it/100x100">
                                                <div class="content">
                                                    <div class="title">"Order Confirmation.."</div>
                                                    <div class="description">Brenda Lawson</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
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
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="profile-img" src="<?php echo STYLE_DIR; ?>assets\images\profile.png">
                                <div class="title">Profile</div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="profile-info">
                                    <h4 class="username">Scott White</h4>
                                </div>
                                <ul class="action">
                                    <li>
                                        <a href="#">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">5</span>
                                            My Inbox
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
                    </ul>
                </div>
            </div>
        </nav>
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

    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
    <script src="<?php echo STYLE_DIR; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.js"></script>
	
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