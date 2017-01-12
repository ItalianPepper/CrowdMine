<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."ViewUtils.php";?>
    <?php include_once VIEW_DIR."headerStart.php";?>
    <style>
        .navbar-collapse.in {
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
                        <div class="row" style="padding: 15px" id="feedback-list-reported">
                            <div class="card-body __loading">
                                <div class="loader-container text-center">
                                    <div class="icon">
                                        <div class="sk-wave">
                                            <div class="sk-rect sk-rect1"></div>
                                            <div class="sk-rect sk-rect2"></div>
                                            <div class="sk-rect sk-rect3"></div>
                                            <div class="sk-rect sk-rect4"></div>
                                            <div class="sk-rect sk-rect5"></div>
                                        </div>
                                    </div>
                                    <div class="title">Caricamento</div>
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
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackBackEnd.js"></script>
    <script type="text/javascript"
            src="<?php echo STYLE_DIR; ?>assets\js\valutazioneFeedback.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackSort.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\feedbackList.js"></script>
    <script type="text/javascript" src="<?php echo STYLE_DIR; ?>plugins\toastr\toastr.js"></script>
    <script>
        $(document).ready(
            function () {
                <?php
                if(isset($user)){
                if($user->getRuolo() == Permissions::MODERATORE)
                {
                ?>
                retriveModeratorFeedback();
                <?php
                }
                else  if($user->getRuolo() == Permissions::AMMINISTRATORE)
                {
                ?>
                retriveAdminFeedback();
                <?php
                }
                }
                ?>
            }
        )
    </script>

    <script>
        /*evidenzio segnalazioni nella barra laterale*/
        $("#segnalazioni").toggleClass("active");
    </script>

</body>
</html>