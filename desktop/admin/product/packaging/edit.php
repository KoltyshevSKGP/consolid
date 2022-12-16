<?php

$settingsPage=array(
    "main_title" => "Адмін-палель",
    "title" => "SKU",
    "navigation_array" => array(
        "Головна" => "/",
        "SKU" => "/desktop/admin/product",
        "Редагування" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["add_packaging"])) {
    SQLUpdate("sku_packaging", array("id"=>$_POST["id"]), "AND",
        array(
            "type" => $_POST["type"],
            "bar_code"=>$_POST["bar_code"],
            "weight"=>$_POST["weight"],
            "updated_at"=>time(),
            "created_at"=>time(),
        ));
    header("Location: /desktop/admin/product/");
    die();
}



include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
$product_sku_packaging=$DB->query("SELECT * FROM sku_packaging WHERE id=".$_GET["id"]);
$product_sku_res=$product_sku_packaging->fetch_assoc();
?>



    <section id="basic-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="edit.php" method="post">
                            <input type="text" name="id" style="display: none" class="form-control" placeholder="" value="<?php echo $product_sku_res["id"]?>">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <label class="form-label" for="carCapacity">Тип пакування*</label>
                                    <select class="select2 form-select" name="type">
                                        <option value="0">Оберіть</option>
                                        <?php
                                        $sku_packaging_name=$DB->query("SELECT name,id FROM `units_of_measurement` WHERE 1");
                                        while ($result=$sku_packaging_name->fetch_assoc()) {
                                            $selected="";
                                            if($result["id"]==$product_sku_res["type"]) $selected=" selected";
                                            echo "<option value='".$result["id"]."' $selected>".$result["name"]."</option>";
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="units_number_in_package">К-сть одиниць в упаковці*</label>
                                        <input type="text" name="units_number_in_package" class="form-control" placeholder="Введіть текст" value="<?php echo $product_sku_res["units_number_in_package"]?>" required>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="barcode">Штрих-код*</label>
                                        <input type="text" name="bar_code" class="form-control" placeholder="Введіть текст" value="<?php echo $product_sku_res["bar_code"]?>" required>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="weight">Вага*</label>
                                        <input type="text" name="weight" class="form-control" placeholder="Введіть текст" value="<?php echo $product_sku_res["weight"]?>" required>
                                    </div>
                                </div>


                            </div>
                            <button type="submit" name="add_packaging" style="width: 100%" class="btn main_button">Зберегти</button><br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <style>
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
