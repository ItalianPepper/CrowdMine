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
                                    class="highlight">Feedback Segnalati</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Lista Feedback Segnalati
                    </div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<div class="media social-post">
									<div class="media-left">
										<a href="#">
											<img src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
										</a>
									</div>
									<div class="section">
										<div class="section-body">
											<div class="media-body">
												<div class="media-heading">
													<h4 class="title">Scott White</h4>
												</div>
												<div class="rating-content" onclick="return false;">
													<div class="rating">
														<input type="radio" id="star5" name="rating0"
															   value="5"/><label
															class="full" for="star5"
															title="Awesome - 5 stars"></label>
														<input type="radio" id="star4half" name="rating0"
															   value="4.5"/><label
															class="half" for="star4half"
															title="Pretty good - 4.5 stars"></label>
														<input type="radio" id="star4" name="rating0"
															   value="4"/><label
															class="full" for="star4"
															title="Pretty good - 4 stars"></label>
														<input type="radio" id="star3half" name="rating0"
															   value="3.5" /><label
															class="half" for="star3half"
															title="Meh - 3.5 stars"></label>
														<input type="radio" id="star3" name="rating0"
															   value="3"/><label
															class="full" for="star3"
															title="Meh - 3 stars"></label>
														<input type="radio" id="star2half" name="rating0"
															   value="2.5"/><label
															class="half" for="star2half"
															title="Kinda bad - 2.5 stars"></label>
														<input type="radio" id="star2" name="rating0"
															   value="2"/><label
															class="full" for="star2"
															title="Kinda bad - 2 stars"></label>
														<input type="radio" id="star1half" name="rating0"
															   value="1.5"/><label
															class="half" for="star1half"
															title="Meh - 1.5 stars"></label>
														<input type="radio" id="star1" name="rating0"
															   value="1"/><label
															class="full" for="star1"
															title="Sucks big time - 1 star"></label>
														<input type="radio" id="starhalf" name="rating0"
															   value="0.5" checked/><label
															class="half" for="starhalf"
															title="Sucks big time - 0.5 stars"></label>
													</div>
												</div>
												<div class="media-content">
													Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
													ligula
													eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
													parturient
													montes, nascetur ridiculus mus. Donec quam felis, ultricies nec,
													pellentesque
													eu, pretium quis, sem. Nulla consequat massa quis enim. Donec.
												</div>
												<div class="media-action">
													<button class="btn btn-link"><i class="fa fa-check"></i> Conferma</button>
													<button class="btn btn-link"><i class="fa fa-close"></i> Elimina</button>
													<button class="btn btn-link"><i class="fa fa-check-circle"></i> invia all'amministratore</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<div class="media social-post">
									<div class="media-left">
										<a href="#">
											<img src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
										</a>
									</div>
									<div class="section">
										<div class="section-body">
											<div class="media-body">
												<div class="media-heading">
													<h4 class="title">Scott White</h4>
												</div>
												<div class="rating-content" onclick="return false;">
													<div class="rating">
														<input type="radio" id="star5" name="rating1"
															   value="5"/><label
															class="full" for="star5"
															title="Awesome - 5 stars"></label>
														<input type="radio" id="star4half" name="rating1"
															   value="4.5"/><label
															class="half" for="star4half"
															title="Pretty good - 4.5 stars"></label>
														<input type="radio" id="star4" name="rating1"
															   value="4"/><label
															class="full" for="star4"
															title="Pretty good - 4 stars"></label>
														<input type="radio" id="star3half" name="rating1"
															   value="3.5" /><label
															class="half" for="star3half"
															title="Meh - 3.5 stars"></label>
														<input type="radio" id="star3" name="rating1"
															   value="3"/><label
															class="full" for="star3"
															title="Meh - 3 stars"></label>
														<input type="radio" id="star2half" name="rating1"
															   value="2.5"/><label
															class="half" for="star2half"
															title="Kinda bad - 2.5 stars"></label>
														<input type="radio" id="star2" name="rating1"
															   value="2"/><label
															class="full" for="star2"
															title="Kinda bad - 2 stars"></label>
														<input type="radio" id="star1half" name="rating1"
															   value="1.5"/><label
															class="half" for="star1half"
															title="Meh - 1.5 stars"></label>
														<input type="radio" id="star1" name="rating1"
															   value="1"/><label
															class="full" for="star1"
															title="Sucks big time - 1 star"></label>
														<input type="radio" id="starhalf" name="rating1"
															   value="0.5" checked/><label
															class="half" for="starhalf"
															title="Sucks big time - 0.5 stars"></label>
													</div>
												</div>
												<div class="media-content">
													Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
													ligula
													eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
													parturient
													montes, nascetur ridiculus mus. Donec quam felis, ultricies nec,
													pellentesque
													eu, pretium quis, sem. Nulla consequat massa quis enim. Donec.
												</div>
												<div class="media-action">
													<button class="btn btn-link"><i class="fa fa-check"></i> Conferma</button>
													<button class="btn btn-link"><i class="fa fa-close"></i> Elimina</button>
													<button class="btn btn-link"><i class="fa fa-check-circle"></i> invia all'amministratore</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<div class="media social-post">
									<div class="media-left">
										<a href="#">
											<img src="<?php echo STYLE_DIR; ?>assets\images\profile.png"/>
										</a>
									</div>
									<div class="section">
										<div class="section-body">
											<div class="media-body">
												<div class="media-heading">
													<h4 class="title">Scott White</h4>
												</div>
												<div class="rating-content" onclick="return false;">
													<div class="rating">
														<input type="radio" id="star5" name="rating2"
															   value="5"/><label
															class="full" for="star5"
															title="Awesome - 5 stars"></label>
														<input type="radio" id="star4half" name="rating2"
															   value="4.5"/><label
															class="half" for="star4half"
															title="Pretty good - 4.5 stars"></label>
														<input type="radio" id="star4" name="rating2"
															   value="4"/><label
															class="full" for="star4"
															title="Pretty good - 4 stars"></label>
														<input type="radio" id="star3half" name="rating2"
															   value="3.5" /><label
															class="half" for="star3half"
															title="Meh - 3.5 stars"></label>
														<input type="radio" id="star3" name="rating2"
															   value="3"/><label
															class="full" for="star3"
															title="Meh - 3 stars"></label>
														<input type="radio" id="star2half" name="rating2"
															   value="2.5"/><label
															class="half" for="star2half"
															title="Kinda bad - 2.5 stars"></label>
														<input type="radio" id="star2" name="rating2"
															   value="2"/><label
															class="full" for="star2"
															title="Kinda bad - 2 stars"></label>
														<input type="radio" id="star1half" name="rating2"
															   value="1.5"/><label
															class="half" for="star1half"
															title="Meh - 1.5 stars"></label>
														<input type="radio" id="star1" name="rating2"
															   value="1"/><label
															class="full" for="star1"
															title="Sucks big time - 1 star"></label>
														<input type="radio" id="starhalf" name="rating2"
															   value="0.5" checked/><label
															class="half" for="starhalf"
															title="Sucks big time - 0.5 stars"></label>
													</div>
												</div>
												<div class="media-content">
													Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
													ligula
													eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
													parturient
													montes, nascetur ridiculus mus. Donec quam felis, ultricies nec,
													pellentesque
													eu, pretium quis, sem. Nulla consequat massa quis enim. Donec.
												</div>
												<div class="media-action">
													<button class="btn btn-link"><i class="fa fa-check"></i> Conferma</button>
													<button class="btn btn-link"><i class="fa fa-close"></i> Elimina</button>
													<button class="btn btn-link"><i class="fa fa-check-circle"></i> invia all'amministratore</button>
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
        </div>
    </div>

    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>

	<script>
		/*evidenzio segnalazioni nella barra laterale*/
		$("#segnalazioni").toggleClass("active");
	</script>

</body>
</html>