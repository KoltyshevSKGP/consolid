<?php

$requestT=$DB->query("SELECT * FROM `ttn` WHERE `id`=".$_GET["id"]);
$request=$requestT->fetch_assoc();

$pageData=array();

$pageData["ttn_reason"]=array();
array_push($pageData["ttn_reason"],
    array("value"=>1,"text"=>"Запит на доставку"));
$request["ttn_reason_view"]="";
if(isset($pageData["ttn_reason"][$request["ttn_reason"]]))
    $request["ttn_reason_view"]=$pageData["ttn_reason"][$request["ttn_reason"]];

if($request["doc_date"]==0) {
    $request["doc_date"]="";
} else {
    $request["doc_date"]=date("d.m.Y",$request["doc_date"]);
}

$request["status_view"]="";
$statusT=$DB->query("SELECT * FROM `ttn_status` WHERE `id`=".$request["status"]);
$status=$statusT->fetch_assoc();
if(isset($status["id"])) $request["status_view"]=$status["name"];

$companyDoerT=$DB->query("SELECT * FROM `company` WHERE `id`=".$request["company_doer"]);
$companyDoer=$companyDoerT->fetch_assoc();
if(isset($companyDoer["id"])) {
    $companyDoer["link"]="<a href='/desktop/admin/company/public.php?id=".$companyDoer["id"]."'>".$companyDoer["name"]."</a>";
    $companyDoer["full_name_all"]=$companyDoer["full_name"];
    if($companyDoer["ipn"]!="") $companyDoer["full_name_all"].=", ІПН ".$companyDoer["ipn"];
    if($companyDoer["phone"]!="") $companyDoer["full_name_all"].=", тел.: ".$companyDoer["phone"];
    if($companyDoer["bank"]!="") $companyDoer["full_name_all"].=", п/р ".$companyDoer["bank_account"]." у банку ".$companyDoer["bank"];
    if($companyDoer["code"]!="") $companyDoer["full_name_all"].=", код за ЄДРПОУ ".$companyDoer["code"];
}
if(!isset($companyDoer["id"])) $companyDoer=array("link"=>"-");

$driverT=$DB->query("SELECT * FROM `user` WHERE `id`=".$request["driver"]);
$driver=$driverT->fetch_assoc();
if(isset($driver["id"])) {
    $driver["link"]="<a href='/desktop/admin/user/public.php?id=".$driver["id"]."'>".$driver["surname"]." ".$driver["name"]."</a>";
    $driver["short_name"]=$driver["surname"]." ".mb_substr($driver["name"],0,1).".";
}
if(!isset($driver["id"])) $driver=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$request["transport_view"]="";
$transportT=$DB->query("SELECT * FROM `transport` WHERE `id`=".$request["transport"]);
$transport=$transportT->fetch_assoc();
if(isset($transport["id"])) $request["transport_view"]=$transport["license_plate"];

$request["request_connected_view"]="";
$requestConnectedT=$DB->query("SELECT * FROM `request_transport` WHERE `id`=".$request["request_connected"]);
$requestConnected=$requestConnectedT->fetch_assoc();
if(isset($requestConnected["id"])) $request["request_connected_view"]="<a href='/desktop/request/to_send/view.php?id=".$requestConnected["id"]."'>"."ID".$requestConnected["id"]." від ".date("d.m.Y", $requestConnected["created"])."</a>";

$companySenderT=$DB->query("SELECT * FROM `company` WHERE `id`=".$requestConnected["company"]);
$companySender=$companySenderT->fetch_assoc();
if(isset($companySender["id"])) {
    $companySender["link"]="<a href='/desktop/admin/company/public.php?id=".$companySender["id"]."'>".$companySender["name"]."</a>";
    $companySender["full_name_all"]=$companySender["full_name"];
    if($companySender["ipn"]!="") $companySender["full_name_all"].=", ІПН ".$companySender["ipn"];
    if($companySender["phone"]!="") $companySender["full_name_all"].=", тел.: ".$companySender["phone"];
    if($companySender["bank"]!="") $companySender["full_name_all"].=", п/р ".$companySender["bank_account"]." у банку ".$companySender["bank"];
    if($companySender["code"]!="") $companySender["full_name_all"].=", код за ЄДРПОУ ".$companySender["code"];
}
if(!isset($companySender["id"])) $companySender=array("link"=>"-");

$companyReceiverT=$DB->query("SELECT * FROM `company` WHERE `id`=".$requestConnected["company_receiver"]);
$companyReceiver=$companyReceiverT->fetch_assoc();
if(isset($companyReceiver["id"])) {
    $companyReceiver["link"]="<a href='/desktop/admin/company/public.php?id=".$companyReceiver["id"]."'>".$companyReceiver["name"]."</a>";
    $companyReceiver["full_name_all"]=$companyReceiver["full_name"];
    if($companyReceiver["ipn"]!="") $companyReceiver["full_name_all"].=", ІПН ".$companyReceiver["ipn"];
    if($companyReceiver["phone"]!="") $companyReceiver["full_name_all"].=", тел.: ".$companyReceiver["phone"];
    if($companyReceiver["bank"]!="") $companyReceiver["full_name_all"].=", п/р ".$companyReceiver["bank_account"]." у банку ".$companyReceiver["bank"];
    if($companyReceiver["code"]!="") $companyReceiver["full_name_all"].=", код за ЄДРПОУ ".$companyReceiver["code"];
}
if(!isset($companyReceiver["id"])) $companyReceiver=array("link"=>"-");

$companyPayer=array();
if($requestConnected["payer"]==1) $companyPayer=$companySender;
if($requestConnected["payer"]==2) $companyPayer=$companyReceiver;

$uploadLocationR=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$requestConnected["upload_location"]);
$uploadLocation=$uploadLocationR->fetch_assoc();
if(isset($uploadLocation["id"])) $uploadLocation["link"]="<a href='/desktop/admin/location/public.php?id=".$uploadLocation["id"]."'>".$uploadLocation["name"]." - ".$uploadLocation["address"]."</a>";
if(!isset($uploadLocation["id"])) $uploadLocation=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$downloadLocationR=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$requestConnected["download_location"]);
$downloadLocation=$downloadLocationR->fetch_assoc();
if(isset($downloadLocation["id"])) $downloadLocation["link"]="<a href='/desktop/admin/location/public.php?id=".$downloadLocation["id"]."'>".$downloadLocation["name"]." - ".$downloadLocation["address"]."</a>";
if(!isset($downloadLocation["id"])) $downloadLocation=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$contactT=$DB->query("SELECT * FROM `user` WHERE `id`=".$requestConnected["contact_user"]);
$contact=$contactT->fetch_assoc();
if(isset($contact["id"])) $contact["link"]="<a href='/desktop/admin/user/public.php?id=".$contact["id"]."'>".$contact["surname"]." ".$contact["name"]."</a>";
if(!isset($contact["id"])) $contact=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$contactRT=$DB->query("SELECT * FROM `user` WHERE `id`=".$requestConnected["contact_user_receiver"]);
$contactR=$contactRT->fetch_assoc();
if(isset($contactR["id"])) $contactR["link"]="<a href='/desktop/admin/user/public.php?id=".$contactR["id"]."'>".$contactR["surname"]." ".$contactR["name"]."</a>";
if(!isset($contactR["id"])) $contactR=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");


$request["updated"]=date("G:i d.m.Y", $request["updated_at"]);
$request["created"]=date("G:i d.m.Y", $request["updated_at"]);
if($request["is_active"]==0) $request["active"]="Видалений";
if($request["is_active"]==1) $request["active"]="Активний";

$request["object_log"]="";
$objectLogsT=$DB->query("SELECT * FROM `log_objects` WHERE `object_type`='ttn' AND `object_id`='".$request["id"]."' ORDER BY `id` DESC LIMIT 0,6");
while($objectLogs=$objectLogsT->fetch_assoc()) {
    $userT=$DB->query("SELECT * FROM `user` WHERE `id`=".$objectLogs["user"]);
    $user=$userT->fetch_assoc();
    $companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$user["company"]);
    $company=$companyT->fetch_assoc();
    $objectLogs["timestamp"]=date("G:i:s d.m.Y",$objectLogs["timestamp"]);
    switch ($objectLogs["type"]) {
        case 1:
            $objectLogs["type"]="Створення";
            break;
        case 2:
            $objectLogs["type"]="Редагування";
            break;
    }
    $request["object_log"].="
    <tr><td>".$objectLogs["type"]."</td><td>".$user["surname"]." ".$user["name"]." [".$company["name"]."]</td>
    <td>".$objectLogs["timestamp"]."</td></tr>
    ";
}