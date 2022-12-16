<?php
$settingsPage=array(
    "main_title" => "Автопарк",
    "title" => "Реєстрація профілю тз",
    "navigation_array" => array(
        "Головна" => "/",
        "Автопарк" => "/desktop/admin/transport",
        "Реєстрація профілю тз" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["add_transport"])) {
    $sql=SQLInsert("transport",
        array(
            "brand" => $_POST["brand"],
            "license_plate" => $_POST["license_plate"],
            "type" => $_POST["type"],
            "length" => $_POST["length"],
            "width" => $_POST["width"],
            "height" => $_POST["height"],
            "volume" => $_POST["volume"],
            "weight" =>$_POST["weight"],
            "adr" => $_POST["adr"],
            "spending_empty" => $_POST["spending_empty"],
            "spending_full" => $_POST["spending_full"],
            "download_method" => $_POST["download_method"],
            "year_of_manufacture" => $_POST["year_of_manufacture"],
            "company" => $_POST["company"],
            "equipment" => $_POST["equipment" ],
            "driver" => $_POST["driver" ],
            "updated_at"=>time(),
            "created_at"=>time(),
        ));
    if($sql["error"]===true) {
        echo $sql["error_message"];
        die();
    }
    header("Location: index.php");
    die();
}



include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Створення компанії</h4>
                </div>
                <div class="card-body">
                    <form action="create.php" method="post">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Марка авто*</label>
                                <select class="select2 form-select" name="brand">
                                    <option value="0">Оберіть</option>
                                    <?php
                                    $transport_brand=$DB->query("SELECT id,name FROM `transport_brand`");
                                    while ($transport_brand_res=$transport_brand->fetch_assoc()) {
                                        echo "<option value='".$transport_brand_res["id"]."'>".$transport_brand_res["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">ДНЗ*</label>
                                    <input type="text" name="license_plate" class="form-control" placeholder="ВС 0000 ВС" value="">
                                </div>
                            </div>


                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Тип*</label>
                                <select class="select2 form-select" name="type">
                                    <option value="0">Оберіть</option>
                                    <?php
                                    $transport_type=$DB->query("SELECT id,name FROM `transport_type`");
                                    while ($transport_type_res=$transport_type->fetch_assoc()) {
                                        echo "<option value='".$transport_type_res["id"]."'>".$transport_type_res["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form_group row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <label class="form-label" for="length"> Довжина</label>
                                        <div class="input-group form-password-toggle mb-2">
                                            <input type="text" name="length" class="form-control"
                                                   placeholder="0.00">
                                            <span class="input-group-text">М</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <label class="form-label" for="length"> Ширина</label>
                                        <div class="input-group form-password-toggle mb-2">
                                            <input type="text" name="width" class="form-control"
                                                   placeholder="0.00">
                                            <span class="input-group-text">М</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <label class="form-label" for="length"> Висота</label>
                                        <div class="input-group form-password-toggle mb-2">
                                            <input type="text" name="height" class="form-control"
                                                   placeholder="0.00">
                                            <span class="input-group-text">М</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <label class="form-label" for="length"> Об'єм</label>
                                        <div class="input-group form-password-toggle mb-2">
                                            <input type="text" name="volume" class="form-control"
                                                   placeholder="0.00">
                                            <span class="input-group-text">М <sup>   3</sup></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <label class="form-label" for="length"> Вага</label>
                                        <div class="input-group form-password-toggle mb-2">
                                            <input type="text" name="weight" class="form-control"
                                                   placeholder="0.00">
                                            <span class="input-group-text">КГ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <span class="form-label input--group-title">ADR</span>
                                        <select class="select2 form-select" name="adr">
                                            <option value="0">Обрати</option>
                                            <?php
                                            $adr=$DB->query("SELECT id,name FROM `adr`");
                                            while ($adr_res=$adr->fetch_assoc()) {
                                                echo "<option value='".$adr_res["id"]."'>".$adr_res["name"]."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1" style="">
                                    <label class="form-label" for="length"> Витрати пустого</label>
                                    <div class="input-group form-password-toggle mb-2">
                                        <input type="text" name="spending_empty" class="form-control"
                                               placeholder="0.00">
                                        <span class="input-group-text">Л/100 КМ</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1" style="">
                                    <label class="form-label" for="length"> Витрати завантаженого</label>
                                    <div class="input-group form-password-toggle mb-2">
                                        <input type="text" name="spending_full" class="form-control"
                                               placeholder="0.00">
                                        <span class="input-group-text">Л/100 КМ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Спосіб завантаження</label>
                                <select class="select2 form-select" name="download_method">
                                    <option value="0">Оберіть</option>
                                    <?php
                                    $transport_download=$DB->query("SELECT id,name FROM `download_method`");
                                    while ($transport_download_res=$transport_download->fetch_assoc()) {
                                        echo "<option value='".$transport_download_res["id"]."'>".$transport_download_res["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>



                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Рік виготовлення</label>
                                    <input type="text" name="year_of_manufacture" class="form-control" placeholder="2022" value="">
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Компанія</label>
                                <select class="select2 form-select" name="company">
                                    <option value="0">Оберіть</option>
                                    <?php
                                    $transport_company=$DB->query("SELECT id,name FROM `company`");
                                    while ($transport_company_res=$transport_company->fetch_assoc()) {
                                        echo "<option value='".$transport_company_res["id"]."'>".$transport_company_res["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Водій за замовчуванням</label>
                                <select class="select2 form-select" name="driver">
                                    <option value="0">Оберіть</option>
                                    <?php
                                    $driver=$DB->query("SELECT * FROM `user` WHERE `role`=5");
                                    while ($driver_res=$driver->fetch_assoc()) {
                                        echo "<option value='".$driver_res["id"]."'>".$driver_res["surname"]." ".$driver_res["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Обладнання за замовчуванням</label>
                                <select class="select2 form-select" name="equipment">
                                    <option value="0">Оберіть</option>
                                    <?php
                                    $equipment=$DB->query("SELECT id,name FROM `equipment`");
                                    while ($equipment_res=$equipment->fetch_assoc()) {
                                        echo "<option value='".$equipment_res["id"]."'>".$equipment_res["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>





                        </div>
                        <button type="submit" name="add_transport" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Зареєструвати</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
