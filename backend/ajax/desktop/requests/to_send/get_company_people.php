<?php
include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"]."/include/system/ajax-functions/header.php");
/*
 * Income Data Validate
 */
/*
 * Inside Data init
 */
/*
 * Result init
 */
$result_data["selectors"]=array();
$result_view["selectors"]="";
/*
 * Processing
 */
$userT = $DB->query("SELECT * FROM `user` 
        WHERE `company`='".$income_data['company']."' AND `active`=1");
while($user = $userT->fetch_assoc()) {
    array_push($result_data["selectors"], $user);
}
/*
 * Result creating
 */
$result_view["selectors"]="<option value='0'>Оберіть користувача</option>";
foreach ($result_data["selectors"] as $selector) {
    $result_view["selectors"].="<option value='".$selector["id"]."'>".$selector["surname"]." ".$selector["name"]."</option>";
}
include ($_SERVER["DOCUMENT_ROOT"]."/include/system/ajax-functions/response.php");