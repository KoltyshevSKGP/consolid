<?php
$settingsPage=array(
    "main_title" => "Автопарк",
    "title" => "Перегляд автопарку",
    "navigation_array" => array(
        "Головна" => "/",
        "Автопарк" => "/desktop/admin/company",
        "Перегляд автопарку" => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$transportT=$DB->query("SELECT * FROM `transport` WHERE `id`=".$_GET["id"]);
$transport=$transportT->fetch_assoc();

$transport_brand = $DB->query("SELECT id,name FROM `transport_brand` WHERE `id`=".$transport['brand']);
$transport_brand_res = $transport_brand->fetch_assoc();

$transport_model = $DB->query("SELECT id,name FROM `transport_model` WHERE `brand_id`=".$transport_brand_res['id']);
$transport_model_res = $transport_model->fetch_assoc();

$transport_kind =$DB->query("SELECT * FROM transport, transport_kind WHERE transport.type = transport_kind.id");
$transport_kind_res = $transport_kind->fetch_assoc();



$company_name =$DB->query("SELECT name FROM company WHERE `id`=".$transport['company']);
$company_name_res = $company_name->fetch_assoc();

$equipment_name =$DB->query("SELECT name FROM equipment WHERE `id`=".$transport['equipment']);
$equipment_name_res = $equipment_name->fetch_assoc();


$driver_info =$DB->query("SELECT name FROM transport, driver WHERE transport.driver = driver.id");
$driver_info_res = $driver_info->fetch_assoc();





$trailer =$DB->query("SELECT * FROM trailer WHERE `id`=".$transport['trailer']);
$trailer_res = $trailer->fetch_assoc();


$trailer_type =$DB->query("SELECT name FROM trailer_type WHERE `id`=".$trailer_res['trailer_type']);
$trailer_type_res = $trailer_type->fetch_assoc();



?>
    <section id="basic-input">
        <div class="row trailer" id="table-bordered">
            <div class="col-md-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Перегляд локації</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <a href="index.php" style="width: 100%" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather='arrow-left'></i> До списку</a><br><br>
                            <a href="edit.php?id=<?php echo $_GET["id"]?>" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather='edit'></i></a><br><br>
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
                                <td>Марка</td>
                                <td><?php echo $transport_brand_res['name']?></td>
                            </tr>
                            <tr>
                                <td>Модель</td>
                                <td><?php echo $transport_model_res['name']?></td>
                            </tr>
                            <tr>
                                <td>ДНЗ</td>
                                <td><?php echo $transport['license_plate']?></td>
                            </tr>
                            <tr>
                                <td>Довжина</td>
                                <td><?php echo $transport['length']?>М</td>
                            </tr>
                            <tr>
                                <td>Ширина</td>
                                <td><?php echo $transport['width']?>М</td>
                            </tr>
                            <tr>
                                <td>Висота</td>
                                <td><?php echo $transport['height']?>М</td>
                            </tr>
                            <tr>
                                <td>Об'єм</td>
                                <td><?php echo $transport['volume']?>М <sup>3</sup> </td>
                            </tr>
                            <tr>
                                <td>Вага</td>
                                <td><?php echo $transport['weight']?>КГ</td>
                            </tr>
                            <tr>
                                <td>Вид авто</td>
                                <td><?php echo $transport_kind_res['name']?></td>
                            </tr>
                            <tr>
                                <td>Тип причіпа</td>
                                <td><?php echo $trailer_type_res['name']?></td>
                            </tr>
                            <tr>
                                <td>Витрати пустого</td>
                                <td><?php echo $transport['spending_empty']?>л / 100км</td>
                            </tr>
                            <tr>
                                <td>Витрати повного</td>
                                <td><?php echo $transport['spending_full']?>л / 100км</td>
                            </tr>
                            <tr>
                                <td>Рік</td>
                                <td><?php echo $transport['year_of_manufacture']?></td>
                            </tr>
                            <tr>
                                <td>Компанія</td>
                                <td><?php echo $company_name_res['name']?></td>
                            </tr>

                            <tr>
                                <td>Обладнання</td>
                                <td><?php echo $equipment_name_res['name']?></td>
                            </tr>

                            <tr>
                                <td>Водій</td>
                                <td><?php echo $driver_info_res['name']?></td>
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
