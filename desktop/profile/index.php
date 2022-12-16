<?php
$settingsPage=array(
    "main_title" => "Профіль користувача",
    "title" => "Робота із профілем користувача",
    "navigation_array" => array(
        "Головна" => "/",
        "Профіль" => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$userT=$DB->query("SELECT * FROM `user` WHERE `id`=".$_SESSION["id"]);
$user=$userT->fetch_assoc();
$companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$user["company"]);
$company=$companyT->fetch_assoc();
if(!isset($company["id"])) $company=array("name"=>"-");
$positionT=$DB->query("SELECT * FROM `user_position` WHERE `id`=".$user["position"]);
$position=$positionT->fetch_assoc();
if(!isset($position["id"])) $position=array("name"=>"-");
?>
<section id="basic-input">
    <div class="row" id="table-bordered">
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд профіля</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <a href="edit.php" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather='edit'></i></a><br><br>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-12">
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
                            <td>Прізвище</td>
                            <td><?php echo $user["surname"]?></td>
                        </tr>
                        <tr>
                            <td>Ім'я</td>
                            <td><?php echo $user["name"]?></td>
                        </tr>
                        <tr>
                            <td>Компанія</td>
                            <td><?php echo $company["name"]?></td>
                        </tr>
                        <tr>
                            <td>Посада</td>
                            <td><?php echo $position["name"]?></td>
                        </tr>
                        <tr>
                            <td>Номер телефону</td>
                            <td><?php echo $user["phone"]?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $user["email"]?></td>
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
