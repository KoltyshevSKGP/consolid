<?php

$settingsPage=array(
    "main_title" => "Адмін-палель",
    "title" => "SKU",
    "navigation_array" => array(
        "Головна" => "/",
        "SKU" => "/desktop/admin/product",
        "Додавання" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

$last_sku = $DB->query("SELECT id FROM `sku` ORDER BY id DESC LIMIT 0,1");
$last_sku_res = $last_sku->fetch_assoc();
//$result = $last_sku_res['id'] + 1;

if(isset($_POST["main_add"])) {
    $result=SQLInsert("sku",
        array(
            "name"=>$_POST["name"],
            "units_of_measurement"=>$_POST["units_of_measurement"],
            "expiration_date"=>$_POST["expiration_date"],
            "bar_code"=>$_POST["bar_code"],
            "weight"=>$_POST["weight"],
            "updated"=>time(),
            "created"=>time(),
        ));
    if($result["error"]===true) {
        echo $result["error_message"];
        die();
    }
    header("Location: /desktop/admin/product/view.php?id=".($last_sku_res['id'] + 1));
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
                    <div class="card-body">
                        <form action="create.php" method="post">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="carNumber">Назва*</label>
                                        <input type="text" name="name" class="form-control" placeholder="Введіть текст" value="" required>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <label class="form-label" for="carCapacity">Одиниця виміру*</label>
                                        <select class="select2 form-select" name="units_of_measurement">
                                            <option value="0">Оберіть</option>
                                            <?php
                                            $sku_units=$DB->query("SELECT * FROM `units_of_measurement` ");
                                            while ($result=$sku_units->fetch_assoc()) {
                                                echo "<option value='".$result["id"]."'>".$result["name"]."</option>";
                                            }
                                            ?>
                                        </select>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="barcode">Штрих-код*</label>
                                        <input type="text" name="bar_code" class="form-control" placeholder="Введіть текст" value="" required>
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="weight">Вага одиниці*</label>
                                        <input type="text" name="weight" class="form-control" placeholder="Введіть текст" value="" required>
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <label class="form-label" for="expiration_date">  Термін придатності*</label>
                                        <div class="input-group form-password-toggle mb-2">
                                            <input type="text" name="expiration_date" class="form-control" placeholder="Число" value="">
                                            <span class="input-group-text">Діб</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button name="main_add" type="submit" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Додати</button><br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <style>
        .wrapper_expiration {
            display: flex;
            align-items: center;
        }

        .main_button {
            background: #D9B414;
            color: #FFF;
            border-radius: 0 4px 4px 0;
            width: -webkit-fill-available;
        }

        .wrapper_expiration span{
            margin-left: -13px
        }
    </style>

<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
