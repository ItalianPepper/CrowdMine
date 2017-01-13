
<script>
    $(document).ready(function () {
        new NotifyPanel("<?php echo DOMINIO_SITO.'/' ?>");
        new MessagesUpdate("<?php echo DOMINIO_SITO.'/' ?>");
    });
</script>

<?php
if (isset($_SESSION['toast-type']) && isset($_SESSION['toast-message'])) {
    ?>
    <script>
        $(document).ready(function () {
            "use strict";
            $("#feedback-tab").click();
            $("#feedback-collapse-panel").click();
        });
        toastr["<?php echo $_SESSION['toast-type'] ?>"]("<?php echo $_SESSION['toast-message'] ?>");
    </script>
    <?php
    unset($_SESSION['toast-type']);
    unset($_SESSION['toast-message']);
}
?>

<footer class="main-footer cm-">
    <!-- To the right -->
    <div class="container-fluid col-md-12" style="background: rgba(16, 14, 23, 0.87)" >


        <div class="col-md-6">
            <br>
            <img class="img-responsive" style="height: 55%; max-width: 100%" src="<?php echo STYLE_DIR ?>/img/Logo_Crowdmine_3.png" />
            <span style="color: white"><strong> CrowdMine &copy; 2016 <a href="#"></a>.</strong> All rights reserved.</span>
            <br>
            <br>
        </div>
    </div>

</footer>

