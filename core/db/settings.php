<?php
header("Content-type: text/html; charset=utf8");
date_default_timezone_set('Europe/Kiev');

$servername = "http://142.93.35.175/";
$username = "root";
$password = "root";
$dbname = "consolid_app";

global $conn_settings;
$conn_settings = new mysqli($servername, $username, $password, $dbname);
if ($conn_settings->connect_error) {
    die("Connection failed: " . $conn_settings->connect_error);
}
if (!mysqli_set_charset($conn_settings, "utf8")) {
    exit();
}

global $wms_settings;
$wms_settings=array();

$sql = $conn_settings->query("SELECT * FROM `client-settings` WHERE `domain`='".$_SERVER["HTTP_HOST"]."'");
$wms_settings_row = $sql->fetch_assoc();
if(!isset($wms_settings_row["id"])) {
    echo "ERROR";
    die();
}
$wms_settings=$wms_settings_row;
$wms_settings["wms_db"]=$wms_settings["database"];

mysqli_close($conn_settings);
