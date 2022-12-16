<?php
$settingsPage=array(
    "main_title" => "Компанії",
    "title" => "Перегляд компанії",
    "navigation_array" => array(
        "Головна" => "/",
        "Перегляд компанії" => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$_GET["id"]);
$company=$companyT->fetch_assoc();

if($company["contact_person"]!=0) {
    $contactT=$DB->query("SELECT * FROM `user` WHERE `id`=".$company["contact_person"]);
    $contact=$contactT->fetch_assoc();
}
if(isset($contact["id"])) $contact["link"]="<a href=''></a>";
if(!isset($contact["id"])) $contact=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

if($company["accouting_person"]!=0) {
    $accountingT=$DB->query("SELECT * FROM `user` WHERE `id`=".$company["accouting_person"]);
    $accounting=$accountingT->fetch_assoc();
}
if(isset($accounting["id"])) $accounting["link"]="<a href=''></a>";
if(!isset($accounting["id"])) $accounting=array("id"=>"0", "surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

if($company["company_type"]!=0) {
    $typeT=$DB->query("SELECT * FROM `company_type` WHERE `id`=".$company["company_type"]);
    $type=$typeT->fetch_assoc();
}
if(!isset($type["id"])) $type=array("name"=>"-");

if($company["main_office"]!=0) {
    $locationT=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$company["main_office"]);
    $location=$locationT->fetch_assoc();
}
if(isset($location["id"])) $location["link"]="<a href='/desktop/admin/location/view.php?id=".$location["id"]."'>".$location["name"]." - ".$location["address"]."</a>";
if(!isset($location["id"])) $location=array("link"=>"-", "name"=>"-", "address"=>"-");

$company["updated"]=date("G:i d.m.Y", $company["updated"]);
$company["created"]=date("G:i d.m.Y", $company["created"]);
if($company["active"]==0) $company["active"]="Видалений";
if($company["active"]==1) $company["active"]="Активний";
?>
    <section id="basic-input">
        <div class="row" id="table-bordered">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Поле</th>
                                <th>Значення</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Назва</td>
                                <td><?php echo $company["name"]?></td>
                            </tr>
                            <tr>
                                <td>Тип</td>
                                <td><?php echo $type["name"]?></td>
                            </tr>
                            <tr>
                                <td>Податковий код</td>
                                <td><?php echo $company["code"]?></td>
                            </tr>
                            <tr>
                                <td>Головний офіс</td>
                                <td><?php echo $location["link"]?></td>
                            </tr>
                            <tr>
                                <td>Контактна особа</td>
                                <td><?php echo $contact["surname"]." ".$contact["name"]?></td>
                            </tr>
                            <tr>
                                <td>Номер телефону</td>
                                <td><?php echo $contact["phone"]?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $company["email"]?></td>
                            </tr>
                            <tr>
                                <td>Оновлено</td>
                                <td><?php echo $company["updated"]?></td>
                            </tr>
                            <tr>
                                <td>Створено</td>
                                <td><?php echo $company["created"]?></td>
                            </tr>
                            <tr>
                                <td>Активний</td>
                                <td><?php echo $company["active"]?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
