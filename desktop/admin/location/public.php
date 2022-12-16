<?php
$settingsPage=array(
    "main_title" => "Локації",
    "title" => "Перегляд локації",
    "navigation_array" => array(
        "Головна" => "/",
        "Перегляд локації" => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$locationT=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$_GET["id"]);
$location=$locationT->fetch_assoc();
if($location["maps_link"]!="") $location["maps_link"]="<a target='_blank' href='".$location["maps_link"]."'>Перейти</a>";

$companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$location["company"]);
$company=$companyT->fetch_assoc();
if(!isset($company["id"])) $company=array("name"=>"-");

$typeT=$DB->query("SELECT * FROM `company_location_type` WHERE `id`=".$location["type"]);
$type=$typeT->fetch_assoc();
if(!isset($type["id"])) $type=array("name"=>"-");

$userT=$DB->query("SELECT * FROM `user` WHERE `id`=".$location["contact_person"]);
$user=$userT->fetch_assoc();
if(!isset($user["id"])) $user=array("surname"=>"-", "name"=>"-", "phone"=>"-", "email"=>"-");

$location["updated"]=date("G:i d.m.Y", $location["updated"]);
$location["created"]=date("G:i d.m.Y", $location["created"]);
if($location["active"]==0) $location["active"]="Видалений";
if($location["active"]==1) $location["active"]="Активний";
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
                                <td><?php echo $location["name"]?></td>
                            </tr>
                            <tr>
                                <td>Тип</td>
                                <td><?php echo $type["name"]?></td>
                            </tr>
                            <tr>
                                <td>Компанія</td>
                                <td><?php echo $company["name"]?></td>
                            </tr>
                            <tr>
                                <td>Адреса</td>
                                <td><?php echo $location["address"]?></td>
                            </tr>
                            <tr>
                                <td>Навігаційний link</td>
                                <td><?php echo $location["maps_link"]?></td>
                            </tr>
                            <tr>
                                <td>Графік роботи</td>
                                <td><?php echo $location["schedule"]?></td>
                            </tr>
                            <tr>
                                <td>Контактна особа</td>
                                <td><?php echo $user["surname"]." ".$user["name"]?></td>
                            </tr>
                            <tr>
                                <td>Номер телефону</td>
                                <td><?php echo $user["phone"]?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $user["email"]?></td>
                            </tr>
                            <tr>
                                <td>Оновлено</td>
                                <td><?php echo $location["updated"]?></td>
                            </tr>
                            <tr>
                                <td>Створено</td>
                                <td><?php echo $location["created"]?></td>
                            </tr>
                            <tr>
                                <td>Активний</td>
                                <td><?php echo $location["active"]?></td>
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
