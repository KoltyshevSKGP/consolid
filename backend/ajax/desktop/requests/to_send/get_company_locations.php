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
$locationT = $DB->query("SELECT * FROM `company_location` 
        WHERE `company`='".$income_data['company']."' AND `active`=1");
while($location = $locationT->fetch_assoc()) {
    array_push($result_data["selectors"], $location);
}
/*
 * Result creating
 */
$result_view["selectors"]="<option value='0'>Оберіть локацію</option>";
foreach ($result_data["selectors"] as $selector) {
    $result_view["selectors"].="<option value='".$selector["id"]."'>".$selector["name"]." - ".$selector["address"]."</option>";
}
include ($_SERVER["DOCUMENT_ROOT"]."/include/system/ajax-functions/response.php");