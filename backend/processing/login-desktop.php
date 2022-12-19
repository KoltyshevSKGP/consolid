<?php
session_set_cookie_params(28800,"/");
session_start();
include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
$income_data=array(
    "email" => "",
    "password" => "",
    "login-redirect" => ""
);

if(!isset($_POST["login-email"]) || !isset($_POST["login-password"])
    || $_POST["login-email"]=="" || $_POST["login-password"]=="") {

    header("Location: http://$_SERVER[HTTP_HOST]/?error=lost_data");
    die();
}
$income_data["email"]=$_POST["login-email"];
$income_data["password"]=$_POST["login-password"];
$income_data["login-redirect"]=$_POST["login-redirect"];

$userT=$DB->query("SELECT * FROM `user` WHERE `email`='".$income_data["email"]."'");
$user=$userT->fetch_assoc();
if(!isset($user["id"])) {
    header("Location: http://$_SERVER[HTTP_HOST]/?error=user_not_found");
    die();
}
if($user["active"]==0) {
    header("Location: http://$_SERVER[HTTP_HOST]/?error=user_not_active");
    die();
}
if($user["password"]!=$income_data["password"]) {
    header("Location: http://$_SERVER[HTTP_HOST]/?error=password_error");
    die();
}
$_SESSION["id"]=$user["id"];
$_SESSION["name"]=$user["name"];
$_SESSION["surname"]=$user["surname"];
$_SESSION["email"]=$user["username"];
$companyT=$DB->query("SELECT * FROM `company` WHERE `id`='".$user["company"]."'");
$company=$companyT->fetch_assoc();
$userPositionT=$DB->query("SELECT * FROM `user_position` WHERE `id`='".$user["position"]."'");
$userPosition=$userPositionT->fetch_assoc();

$_SESSION["position"]=$userPosition["name"];
$_SESSION["company"]=$company["name"];
$_SESSION["company_id"]=$company["id"];
$_SESSION["role"]=$user["role"];
//$_SESSION["starturl"]=$user_profile["starturl"];
if($income_data["login-redirect"]!="") {
    header("Location: ".$income_data["login-redirect"]);
    die();
}
header("Location: http://$_SERVER[HTTP_HOST]/desktop/dashboard/");