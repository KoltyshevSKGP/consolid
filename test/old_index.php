<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
include($_SERVER["DOCUMENT_ROOT"] . "/test/pages/blank-page.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");

die();
include($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");
if(!isset($_GET["device"]) || strlen($_GET["device"])!=32) {
    $settingsPage=array(
        "main_title" => "Device Error",
        "message" => "Device Key in not defined",
        "message_long" => "Please, enter device key in GET-parameter",
        "link" => "/",
    );
    include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/pages/error-page.php");
} else {
    $checkDevice=checkDevice($_GET["device"]);
    if($checkDevice["error"]==true) {
        $settingsPage=array(
            "main_title" => "Device Error",
            "message" => $checkDevice["error_message"],
            "message_long" => "Please, enter valid device key in GET-parameter. Ask your admin",
            "link" => "/",
        );
        include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/pages/error-page.php");
        die();
    }
    if(isset($checkDevice["result"]["session"]["id"])) {
        include($_SERVER["DOCUMENT_ROOT"] . "/test/pages/blank-page.php");
    } else {
        include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/test/pages/blank-page.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");



        //        include ($_SERVER["DOCUMENT_ROOT"] ."/include/desktop/pages/login.php");
    }
}