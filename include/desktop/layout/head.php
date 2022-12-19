<?php
if(!isset($DB)) include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");

if(!isset($_SESSION["id"])){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("Location: http://$_SERVER[HTTP_HOST]/?redirect=".$actual_link);
    die();
}

if(count($settingsPage)==0) {
    $settingsPage=array(
        "main_title" => "Title"
    );
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title><?php echo $settingsPage["main_title"]?> | Consolid</title>
    <link href="http://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <?php
    include ("css/vendor.php");
    include ("css/theme.php");
    include ("css/page.php");
    include ("css/custom.php");
    ?>
</head>
<!-- END: Head-->