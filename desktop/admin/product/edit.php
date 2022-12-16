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


if(isset($_POST["main_button"])) {
    SQLUpdate("sku", array("id"=>$_POST["id"]), "AND",
        array(
            "name"=>$_POST["name"],
            "units_of_measurement"=>$_POST["units_of_measurement"],
            "expiration_date"=>$_POST["expiration_date"],
            "bar_code"=>$_POST["bar_code"],
            "weight"=>$_POST["weight"],
            "updated"=>time(),
            "created"=>time(),
        ));
    header("Location: index.php");
    die();
}




include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$product_sku =$DB->query("SELECT * FROM sku WHERE `id`=".$_GET["id"]);
$product_sku_res=$product_sku->fetch_assoc();

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
                                    <div class="mb-1">
                                        <label class="form-label" for="carNumber">Назва*</label>
                                        <input type="text" name="name" class="form-control" placeholder="Введіть текст" value="<?php echo $product_sku_res['name']?>" required>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <label class="form-label" for="carCapacity">Одиниця виміру*</label>
                                    <select class="select2 form-select" name="units_of_measurement">
                                        <option value="0" >Оберіть</option>
                                        <?php
                                        $sku_units=$DB->query("SELECT name FROM `units_of_measurement` ");
                                        while ($result=$sku_units->fetch_assoc()) {
                                            $selected="";

                                            if($result["id"]==$product_sku_res["units_of_measurement"]) $selected=" selected";
                                            echo "<option value='".$result["id"]."' $selected>".$result["name"]. "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="barcode">Штрих-код*</label>
                                        <input type="text" name="bar_code" class="form-control" placeholder="Введіть текст" value="<?php echo $product_sku_res['bar_code']?>" required>
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="weight">Вага одиниці*</label>
                                        <input type="text" name="weight" class="form-control" placeholder="Введіть текст" value="<?php echo $product_sku_res['weight']?>" required>
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1" style="">
                                        <label class="form-label" for="expiration_date">  Термін придатності*</label>
                                        <div class="input-group form-password-toggle mb-2">
                                            <input type="text" name="expiration_date" class="form-control" placeholder="Число" value="<?php echo $product_sku_res['expiration_date']?>">
                                            <span class="input-group-text">Діб</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" style="width: 100%" name="main_button" class="btn btn-success btn-sm waves-effect waves-float waves-light">Зберегти</button><br><br>
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
