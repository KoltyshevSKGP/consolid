<?php
$settingsPage=array(
    "main_title" => "SKU",
    "title" => "Перегляд SKU",
    "navigation_array" => array(
        "Головна" => "/",
        "SKU" => "/desktop/admin/product/",
        "Перегляд SKU" => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
$content = array();
$skuT=$DB->query("SELECT *, units_of_measurement.name AS units_of_measurement_title, sku.name AS sku_title FROM sku,units_of_measurement WHERE sku.id=".$_GET["id"]);
$sku=$skuT->fetch_assoc();
$packagingT=$DB->query("SELECT  *, sku_packaging.id  AS sku_packaging_id FROM sku_packaging,units_of_measurement WHERE units_of_measurement.id = sku_packaging.type  AND `sku_id`=".$_GET["id"]);

while ($packaging=$packagingT->fetch_assoc()) {
    array_push($content, $packaging);
}
?>
    <section id="basic-input">
        <div class="row" id="table-bordered">

            <div class="col-md-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Перегляд SKU</h4>

                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <a href="index.php" style="width: 100%" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather='arrow-left'></i> До списку</a><br><br>
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
                                <td>Одиниця виміру</td>
                                <td><?php echo $sku["units_of_measurement_title"]?></td>
                            </tr>
                            <tr>
                                <td>Код</td>
                                <td><?php echo $sku["bar_code"]?></td>
                            </tr>
                            <tr>
                                <td>Найменування</td>
                                <td><?php echo $sku["sku_title"]?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Перегляд пакування</h4>
                        <a class="btn btn-success waves-effect waves-float waves-light" href="packaging/create.php?sku_id=<?php echo($_GET["id"])?>">Створити
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Перегляд пакування компанії
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Тип пакування</th>
                                <th>К-сть одиниць в упаковці</th>
                                <th>Штрих код</th>
                                <th>Вага</th>
                                <th>Дії</th>
                            </tr>
                            </thead>
                            <tbody>
<?php
foreach ($content as $index => $val) {
    echo '
                        <tr>
                            <td>'.($index+1).'</td>
                            <td>'.$val["name"].'</td>
                            <td>'.$val["units_number_in_package"].'</td>
                            <td>'.$val["bar_code"].'</td>
                                <td>'.$val["weight"].'</td>
                            <td>
                                  <a href="packaging/view.php?id='.$val["sku_packaging_id"].'&sku_id='.$_GET["id"].'" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                    <a href="packaging/edit.php?id='.$val["sku_packaging_id"].'&sku_id='.$_GET["id"].'" class="btn btn-warning btn-sm waves-effect waves-float waves-light "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>

                            </td>
                        </tr>                            
                            ';
}
if(count($content)==0) echo "<tr><td colspan='5'>Відсутні дані</td></tr>";
?>



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
