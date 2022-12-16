<?php
session_set_cookie_params(28800,"/");
session_start();
if(isset($_GET["logout"]) && $_GET["logout"]!="") {
    unset($_SESSION['id']);
    header("Location: https://$_SERVER[HTTP_HOST]/");
    die();
}
if(isset($_SESSION["id"])){
    header("Location: https://$_SERVER[HTTP_HOST]/desktop/dashboard/");
    die();
}
?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>Login Page - Consolid</title>
    <link rel="apple-touch-icon" href="/source/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/source/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/source/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="/source/app-assets/css/pages/page-auth.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/source/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- Brand logo--><a class="brand-logo" href="#">
                        <h2 class="brand-text text-primary ms-1">Consolid App</h2>
                    </a>
                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="/source/app-assets/images/pages/login-v2-dark.svg" alt="Login V2" /></div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <h2 class="card-title fw-bold mb-1">Вітаємо в Consolid App! 👋</h2>
                            <p class="card-text mb-2">Будь-ласка введіть логін та пароль для входу в систему</p>
                            <form class="auth-login-form mt-2" action="/backend/processing/login-desktop.php" method="POST">
                                <input class="form-control" style="display: none" type="text" name="login-redirect" value="<?php echo $_GET["redirect"]?>" />
                                <div class="mb-1">
                                    <label class="form-label" for="login-email">Email</label>
                                    <input class="form-control" id="login-email" type="text" name="login-email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" />
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label><a class="disabled" href="#"><small>Forgot Password?</small></a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="login-password" type="password" name="login-password" placeholder="············" aria-describedby="login-password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                        <label class="form-check-label" for="remember-me"> Remember Me</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                            </form>
                            <p class="text-center mt-2"><span>Need an access?</span><a href="mailto:support@skgp.eu"><span>&nbsp;Mail to admin</span></a></p>
                            <div class="divider my-2">
                                <div class="divider-text">SK ERP V3.311</div>
                            </div>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="/source/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/source/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/source/app-assets/js/core/app-menu.js"></script>
<script src="/source/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="/source/app-assets/js/scripts/pages/page-auth-login.js"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
</script>
<script type="application/javascript">
    var loginError="<?php echo $_GET["error"]?>";
    if(loginError!="") alert(loginError);
    // switch (loginError) {
    //     case "":
    //         break;
    // }
</script>
</body>
<!-- END: Body-->

</html>