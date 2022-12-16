<?php

$income_data=array();
if(count($_POST)!=0) {
    foreach ($_POST as $key => $value) {
        $value=str_replace("WMSSTART", "", $value);
        $value=str_replace("WMSFIN", "", $value);
        $income_data[$key]=$value;
    }
}
$inside_data=array(
    "timestamp" => time(),
    "system_data" => array(
        "module" => basename(__FILE__, '.php'),
        "user"=>$income_data["globals"]["user"],
        "device"=>$income_data["globals"]["device"],
        "message" => ""
    )
);
$inside_data["system_data"]["message"]=$inside_data["system_data"]["module"]." U".$inside_data["system_data"]["user"]." D".$inside_data["system_data"]["device"];

$result=array(
    "error" => false,
    "error_code" => "",
    "error_message" => "",
    "data" => array(),
    "view" => array(),
);
$result_data=array();
$result_view=array();
