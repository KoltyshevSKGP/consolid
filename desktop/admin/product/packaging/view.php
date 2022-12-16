<?php
$settingsPage=array(
    "main_title" => "SKU",
    "title" => "Перегляд пакування",
    "navigation_array" => array(
        "Головна" => "/",
        "SKU" => "/desktop/admin/product/",
        'Перегляд пакувань' => "/desktop/admin/product/packaging/view.php?id=".$_GET["id"],
        "Перегляд пакування" => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
$content = array();
$packagingT=$DB->query("SELECT * FROM sku_packaging WHERE `id`=".$_GET["id"]);
$packaging=$packagingT->fetch_assoc();
$type_packaging = $DB->query("SELECT * FROM units_of_measurement WHERE `id`=1");
$type_packaging_res=$type_packaging->fetch_assoc();
?>
    <section id="basic-input">
        <div class="row" id="table-bordered">
            <div class="col-md-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Перегляд пакування</h4>

                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <a href="/desktop/admin/product/view.php?id=<?php echo $_GET["sku_id"]?>" style="width: 100%" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather='arrow-left'></i> До списку</a><br><br>
                            <a href="edit.php?id=<?php echo $_GET["id"]?>" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light <?php if($_SESSION["role"]!=1 && $_SESSION["company_id"]==$company["id"]) echo "disabled";?>">Редагувати <i data-feather='edit'></i></a><br><br>
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
                                <td>Тип пакування</td>
                                <td><?php echo $type_packaging_res["name"]?></td>
                            </tr>
                            <tr>
                                <td>К-сть одиниць в упаковці</td>
                                <td><?php echo $packaging["units_number_in_package"]?></td>
                            </tr>
                            <tr>
                                <td>Штрих код</td>
                                <td><?php echo $packaging["bar_code"]?></td>
                            </tr>
                            <tr>
                                <td>Вага</td>
                                <td><?php echo $packaging["weight"]?></td>
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
