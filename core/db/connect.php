<?php
header("Content-type: text/html; charset=utf8");
date_default_timezone_set('Europe/Kiev');

$servername = "142.93.35.175";
$username = "admin";
$password = "e2f22ed749990bffe7e68bb30e1fbcd47506bbcf8c09095b";
$dbname = "consolid_app";

global $DB;
$DB = new mysqli($servername, $username, $password, $dbname);
if ($DB->connect_error) {
    die("Connection failed: " . $DB->connect_error);
}
if (!mysqli_set_charset($DB, "utf8")) {
    exit();
}

session_set_cookie_params(28800,"/");
session_start();

//include("settings.php");
//
//global $conn;
//$conn = new mysqli($servername, $username, $password, $wms_settings["wms_db"]);
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//if (!mysqli_set_charset($conn, "utf8")) {
//    exit();
//} else {
//}
