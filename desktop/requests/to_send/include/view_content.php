<?php

//$requestT=$DB->query("SELECT * FROM `request_transport` WHERE `id`=".$_GET["id"]);
//$request=$requestT->fetch_assoc();

$pageData=array();
$pageData["package_type"]=array(
    1=>"Європалети",
    2=>"Короби"
);

$pageData["oversized"]=array(0=>"Ні",1=>"Так");

$pageData["heavy_pallet"]=array(0=>"Ні",
    1=>"Так");

$pageData["car_type"]=array(1=>"Тент",2=>"Реф",3=>"Целмет");

$pageData["hydrobort"]=array(0=>"Ні",1=>"Так");

$pageData["payer"]=array(1=>"Відправник",2=>"Отримувач");

$pageData["container_back"]=array(0=>"Ні",1=>"Так");

$pageData["documents_back"]=array(0=>"Ні",1=>"Так");

if($request["date_ready"]==0) {
    $request["date_ready"]="";
} else {
    $request["date_ready"]=date("d.m.Y",$request["date_ready"]);
}
if($request["date_download"]==0) {
    $request["date_download"]="";
} else {
    $request["date_download"]=date("d.m.Y",$request["date_download"]);
}
if($request["date_upload_from"]==0) {
    $request["date_upload_from"]="";
} else {
    $request["date_upload_from"]=date("d.m.Y",$request["date_upload_from"]);
}
if($request["date_upload_to"]==0) {
    $request["date_upload_to"]="";
} else {
    $request["date_upload_to"]=date("d.m.Y",$request["date_upload_to"]);
}

if($request["temp_from"]==0) {
    $request["temp_from"]="";
}
if($request["temp_to"]==0) {
    $request["temp_to"]="";
}

$request["status_view"]="";
$statusT=$DB->query("SELECT * FROM `request_transport_status` WHERE `id`=".$request["status"]);
$status=$statusT->fetch_assoc();
if(isset($status["id"])) $request["status_view"]=$status["name"];

$companyDoerT=$DB->query("SELECT * FROM `company` WHERE `id`=".$request["company_doer"]);
$companyDoer=$companyDoerT->fetch_assoc();
if(isset($companyDoer["id"])) $companyDoer["link"]="<a href='/desktop/admin/company/public.php?id=".$companyDoer["id"]."'>".$companyDoer["name"]."</a>";
if(!isset($companyDoer["id"])) $companyDoer=array("link"=>"-");

$companySenderT=$DB->query("SELECT * FROM `company` WHERE `id`=".$request["company"]);
$companySender=$companySenderT->fetch_assoc();
if(isset($companySender["id"])) $companySender["link"]="<a href='/desktop/admin/company/public.php?id=".$companySender["id"]."'>".$companySender["name"]."</a>";
if(!isset($companySender["id"])) $companySender=array("link"=>"-");

$companyReceiverT=$DB->query("SELECT * FROM `company` WHERE `id`=".$request["company_receiver"]);
$companyReceiver=$companyReceiverT->fetch_assoc();
if(isset($companyReceiver["id"])) $companyReceiver["link"]="<a href='/desktop/admin/company/public.php?id=".$companyReceiver["id"]."'>".$companyReceiver["name"]."</a>";
if(!isset($companyReceiver["id"])) $companyReceiver=array("link"=>"-");

$contactT=$DB->query("SELECT * FROM `user` WHERE `id`=".$request["contact_user"]);
$contact=$contactT->fetch_assoc();
if(isset($contact["id"])) $contact["link"]="<a href='/desktop/admin/user/public.php?id=".$contact["id"]."'>".$contact["surname"]." ".$contact["name"]."</a>";
if(!isset($contact["id"])) $contact=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$contactRT=$DB->query("SELECT * FROM `user` WHERE `id`=".$request["contact_user_receiver"]);
$contactR=$contactRT->fetch_assoc();
if(isset($contactR["id"])) $contactR["link"]="<a href='/desktop/admin/user/public.php?id=".$contactR["id"]."'>".$contactR["surname"]." ".$contactR["name"]."</a>";
if(!isset($contactR["id"])) $contactR=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$uploadLocationR=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$request["upload_location"]);
$uploadLocation=$uploadLocationR->fetch_assoc();
if(isset($uploadLocation["id"])) $uploadLocation["link"]="<a href='/desktop/admin/location/public.php?id=".$uploadLocation["id"]."'>".$uploadLocation["name"]." - ".$uploadLocation["address"]."</a>";
if(!isset($uploadLocation["id"])) $uploadLocation=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$downloadLocationR=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$request["download_location"]);
$downloadLocation=$downloadLocationR->fetch_assoc();
if(isset($downloadLocation["id"])) $downloadLocation["link"]="<a href='/desktop/admin/location/public.php?id=".$downloadLocation["id"]."'>".$downloadLocation["name"]." - ".$downloadLocation["address"]."</a>";
if(!isset($downloadLocation["id"])) $downloadLocation=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$request["updated"]=date("G:i d.m.Y", $request["updated"]);
$request["created"]=date("G:i d.m.Y", $request["created"]);
if($request["active"]==0) $request["active"]="Видалений";
if($request["active"]==1) $request["active"]="Активний";

$request["object_log"]="";
$objectLogsT=$DB->query("SELECT * FROM `log_objects` WHERE `object_type`='request_transport' AND `object_id`='".$request["id"]."' ORDER BY `id` DESC LIMIT 0,6");
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

$request["request_data1"]="";
$request["request_data_array1"]=array(
    "Тип вантажу" => $request["cargo_type"],
    "Тип пакування вантажу" => $pageData["package_type"][$request["packing_type"]],
    "К-сть вантажу" => $request["cargo_amount"],
    "Вага брутто" => $request["cargo_weight"],
    "Великогабаритний" => $pageData["oversized"][$request["oversized"]],
    "Навантажені палети" => $pageData["heavy_pallet"][$request["heavy_pallet"]],
//    "" => $request[""],
);
$request["request_data2"]="";
$request["request_data_array2"]=array(
    "Тип автомобіля" => $pageData["car_type"][$request["car_type"]],
    "Висота кузову" => $request["car_height"],
    "Темп.режим від" => $request["temp_from"],
    "Темп.режим до" => $request["temp_to"],
    "Наявність гідроборту" => $pageData["hydrobort"][$request["hydrobort"]],
);
$request["request_data3"]="";
$request["request_data_array3"]=array(
    "Дата готовності" => $request["date_ready"],
    "Дата відвантаження від" => $request["date_upload_from"],
    "Дата відвантаження до" => $request["date_upload_to"],
    "Години відвантаження" => $request["time_upload_from"]."-".$request["time_upload_to"],
    "Дата розвантаження" => $request["date_download"],
    "Години розвантаження" => $request["time_download_from"]."-".$request["time_download_to"],
);
$request["request_data4"]="";
$request["request_data_array4"]=array(
    "Оціночна вартість вантажу" => $request["cargo_price"],
    "Платник" => $pageData["payer"][$request["payer"]],
    "Повернення піддонів" => $pageData["container_back"][$request["container_back"]],
    "Повернення документів" => $pageData["documents_back"][$request["documents_back"]],
    "Деталі по документації" => $request["documents_back_details"],
    "Коментар по умовах" => $request["comment"],
);

foreach ($request["request_data_array1"] as $key => $value) {
    $request["request_data1"].="
    <tr><td>".$key."</td><td>".$value."</td></tr>
    ";
}
foreach ($request["request_data_array2"] as $key => $value) {
    $request["request_data2"].="
    <tr><td>".$key."</td><td>".$value."</td></tr>
    ";
}
foreach ($request["request_data_array3"] as $key => $value) {
    $request["request_data3"].="
    <tr><td>".$key."</td><td>".$value."</td></tr>
    ";
}
foreach ($request["request_data_array4"] as $key => $value) {
    $request["request_data4"].="
    <tr><td>".$key."</td><td>".$value."</td></tr>
    ";
}