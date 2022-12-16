<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022<a class="ms-25" href="https://skgp.eu" target="_blank">SK Group EU</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<?php
include ("js/vendor.php");
include ("js/page-vendor.php");
include("js/theme.php");
include("js/page.php");
?>
<script>

    // A $( document ).ready() block.
    //$( document ).ready(function() {
    //    <?php //if(isset($_GET["device"]) && strlen($_GET["device"])==32):?>
    //    localStorage.setItem('deviceKey', '<?php //echo $_GET["device"];?>//');
    //    window.location.replace(location.origin+location.pathname);
    //    //
    //    <?php //endif; ?>
    <!--    --><?php //if(!isset($_GET["device"]) || strlen($_GET["device"])!=32):?>
    //    if(!localStorage.getItem('deviceKey')) {
    //        alert("!");
    //    }
    //    <?php //endif; ?>
    //});
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>