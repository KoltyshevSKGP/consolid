<?php
function checkDevice($device) {
    include ($_SERVER["DOCUMENT_ROOT"] ."/core/db/connect.php");
    $result=array(
        "error" => false,
        "error_level" => 0,
        "error_message" => "",
        "result" => array()
    );
    $device=SQLSelect("device", array("key"=>$device), "AND")["result"];
    if(!isset($device["id"])) {
        $result["error"]=true;
        $result["error_message"]="Device is not founded";
        return $result;
    }
    if($device["active"]==0) {
        $result["error"]=true;
        $result["error_message"]="Device '".$device["name"]."' is not active";
        return $result;
    }
    $session=SQLSelect("user_sessions", array("device"=>$device["id"], "status"=>1), "AND", array("user"=>0, "device"=>$device["id"],"module"=>__FUNCTION__))["result"];
    $result["result"]["device"]=$device;
    $result["result"]["session"]=$session;
    return $result;
}