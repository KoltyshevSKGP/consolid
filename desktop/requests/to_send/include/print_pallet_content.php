<html>
<body>

<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");

$requestT=$DB->query("SELECT * FROM `request_transport` WHERE `id`=".$_GET["id"]);
$request=$requestT->fetch_assoc();

if($request["temp_from"]==0 && $request["temp_to"]==0) {
    $request["temp"]="Відсутні";
} else {
    $request["temp"]="Наявні [від ".$request["temp_from"]."С до ".$request["temp_to"]."С]";
}

$companySenderT=$DB->query("SELECT * FROM `company` WHERE `id`=".$request["company"]);
$companySender=$companySenderT->fetch_assoc();
if(!isset($companySender["id"])) $companySender=array("link"=>"-");
$companyReceiverT=$DB->query("SELECT * FROM `company` WHERE `id`=".$request["company_receiver"]);
$companyReceiver=$companyReceiverT->fetch_assoc();
if(isset($companyReceiver["id"])) $companyReceiver["link"]="<a href='/desktop/admin/company/view.php?id=".$companyReceiver["id"]."'>".$companyReceiver["name"]."</a>";
if(!isset($companyReceiver["id"])) $companyReceiver=array("link"=>"-");

$contactT=$DB->query("SELECT * FROM `user` WHERE `id`=".$request["contact_user"]);
$contact=$contactT->fetch_assoc();
$contact["full"]=$contact["surname"]." ".$contact["name"]." (".$contact["phone"].")";

$contactRT=$DB->query("SELECT * FROM `user` WHERE `id`=".$request["contact_user_receiver"]);
$contactR=$contactRT->fetch_assoc();
$contactR["full"]=$contactR["surname"]." ".$contactR["name"]." (".$contactR["phone"].")";

$uploadLocationR=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$request["upload_location"]);
$uploadLocation=$uploadLocationR->fetch_assoc();
if(isset($uploadLocation["id"])) $uploadLocation["link"]="<a href='/desktop/admin/location/view.php?id=".$uploadLocation["id"]."'>".$uploadLocation["name"]." - ".$uploadLocation["address"]."</a>";
if(!isset($uploadLocation["id"])) $uploadLocation=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$downloadLocationR=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$request["download_location"]);
$downloadLocation=$downloadLocationR->fetch_assoc();
if(isset($downloadLocation["id"])) $downloadLocation["link"]="<a href='/desktop/admin/location/view.php?id=".$downloadLocation["id"]."'>".$downloadLocation["name"]." - ".$downloadLocation["address"]."</a>";
if(!isset($downloadLocation["id"])) $downloadLocation=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

if($request["cargo_amount"]==0) $request["cargo_amount"]=1;
for($i=0;$i<$request["cargo_amount"];$i++) {
    echo '
<table style="border: black 3px solid; width: 93%; margin: 3%; padding: 0px;height: 285px;">
    <tr style="text-align: center;">
        <td><img src="/storage/ub1.png" style="width: 40%;"></td>
        <td>
        Дата створення замовлення: '.date("d.m.Y/G:i", $request["created"]).'<br><br>
        Вимоги до температурного режиму: <br>'.$request["temp"].'<br><br>
        </td>
    </tr>
    <tr style="text-align: center; font-size: 25px"><td>Палета:'.($i+1).'/'.$request["cargo_amount"].'</td></tr>
    <tr style="text-align: center;">
        <td>
        <br><br>
        Пункт завантаження:<br>
        '.$companySender["name"].'<br>
        '.$uploadLocation["address"].'<br>
        '.$contact["full"].'
        </td>
        <td>
         <br><br>
       Пункт розвантаження:<br>
        '.$companyReceiver["name"].'<br>
        '.$downloadLocation["address"].'<br>
        '.$contactR["full"].'
        </td>
    </tr>
</table>
';
    if(($i+1)!=$request["cargo_amount"]) echo "<hr>";
}
?>
</body>
</html>