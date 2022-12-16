<?php
$settingsPage=array(
    "main_title" => "Компанії",
    "title" => "Редагування компанії ID".$_GET["id"],
    "navigation_array" => array(
        "Головна" => "/",
        "Компанії" => "/desktop/admin/company",
        "Компанія ID".$_GET["id"] => "/desktop/admin/company/view.php?id=".$_GET["id"],
        "Редагування" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["name"])) {
    SQLUpdate("company", array("id"=>$_POST["id"]), "AND",
        array(
            "name"=>$_POST["name"],
            "print_code"=>$_POST["print_code"],
            "company_type"=>$_POST["company_type"],
            "contact_person"=>$_POST["contact_person"],
            "accouting_person"=>$_POST["accouting_person"],
            "email"=>$_POST["email"],
            "full_name"=>$_POST["full_name"],
            "code"=>$_POST["code"],
            "ipn"=>$_POST["ipn"],
            "bank_account"=>$_POST["bank_account"],
            "bank"=>$_POST["bank"],
            "phone"=>$_POST["phone"],
            "updated"=>time(),
        ));
    header("Location: index.php");
    die();
}

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$_GET["id"]);
$company=$companyT->fetch_assoc();

?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Редагування локації</h4>
                </div>
                <div class="card-body">
                    <form action="edit.php" method="post">
                        <input type="text" name="id" style="display: none" class="form-control" placeholder="" value="<?php echo $company["id"]?>">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Назва</label>
                                    <input type="text" name="name" class="form-control" placeholder="ТОВ Назва" value="<?php echo $company["name"]?>">
                                    <p><small class="text-muted">Введіть назву компанії</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Тип компанії</label>
                                <select class="select2 form-select" name="company_type">
                                    <option value="0">Оберіть тип</option>
                                    <?php
                                    $typeT=$DB->query("SELECT * FROM `company_type` WHERE 1");
                                    while ($type=$typeT->fetch_assoc()) {
                                        $selected="";
                                        if($type["id"]==$company["company_type"]) $selected=" selected";
                                        echo "<option value='".$type["id"]."' $selected>".$type["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Контактна особа</label>
                                <select class="select2 form-select" name="contact_person">
                                    <option value="0">Оберіть особу</option>
                                    <?php
                                    $userT=$DB->query("SELECT * FROM `user` WHERE `company`='".$company["id"]."' AND `active`=1");
                                    while ($user=$userT->fetch_assoc()) {
                                        $selected="";
                                        if($user["id"]==$company["contact_person"]) $selected=" selected";
                                        echo "<option value='".$user["id"]."' $selected>".$user["surname"]." ".$user["name"]."</option>";
                                    }
                                    ?>
                                </select>
                                <p><small class="text-muted">Основна контактна особа компанії</small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Бухгалтерія</label>
                                <select class="select2 form-select" name="accouting_person">
                                    <option value="0">Оберіть особу</option>
                                    <?php
                                    $userT=$DB->query("SELECT * FROM `user` WHERE `company`='".$company["id"]."' AND `active`=1");
                                    while ($user=$userT->fetch_assoc()) {
                                        $selected="";
                                        if($user["id"]==$company["accouting_person"]) $selected=" selected";
                                        echo "<option value='".$user["id"]."' $selected>".$user["surname"]." ".$user["name"]."</option>";
                                    }
                                    ?>
                                </select>
                                <p><small class="text-muted">Оберіть контактну особу для обміну документів</small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="*@gmail.com" value="<?php echo $company["email"]?>">
                                    <p><small class="text-muted">Введіть основну електронну адресу</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="main_office">Головний офіс</label>
                                <select class="select2 form-select" name="main_office">
                                    <option value="0">Оберіть офіс</option>
                                    <?php
                                    $locationT=$DB->query("SELECT * FROM `company_location` WHERE `company`='".$company["id"]."' AND `active`=1 AND `type`=2");
                                    while ($location=$locationT->fetch_assoc()) {
                                        $selected="";
                                        if($user["id"]==$company["main_office"]) $selected=" selected";
                                        echo "<option value='".$location["id"]."' $selected>".$location["name"]." - ".$location["address"]."</option>";
                                    }
                                    ?>
                                </select>
                                <p><small class="text-muted">Оберіть головний офіс компанії</small></p>
                            </div>
                            <hr>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Повна назва компанії</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="ТОВ Назва" value="<?php echo $company["full_name"]?>">
                                    <p><small class="text-muted">Введіть юридичну назву компанії</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">ЄДРПОУ компанії</label>
                                    <input type="text" name="code" class="form-control" placeholder="00000000" value="<?php echo $company["code"]?>">
                                    <p><small class="text-muted">Введіть реєстраційний номер компанії</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">ІПН компанії</label>
                                    <input type="text" name="ipn" class="form-control" placeholder="00000000" value="<?php echo $company["ipn"]?>">
                                    <p><small class="text-muted">Введіть податковий номер компанії</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Банківський рахунок</label>
                                    <input type="text" name="bank_account" class="form-control" placeholder="UA0000" value="<?php echo $company["bank_account"]?>">
                                    <p><small class="text-muted">Введіть розрахунковий рахунок</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Банківська установа</label>
                                    <input type="text" name="bank" class="form-control" placeholder="ПАТ 'Приватбанк'" value="<?php echo $company["bank"]?>">
                                    <p><small class="text-muted">Введіть назву банківської установи</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Контактний номер</label>
                                    <input type="text" name="phone" class="form-control" placeholder="+380" value="<?php echo $company["phone"]?>">
                                    <p><small class="text-muted">Введіть контактний номер для документів</small></p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Логістичний код</label>
                                    <input type="text" name="print_code" class="form-control" placeholder="XXX" value="<?php echo $company["print_code"]?>">
                                    <p><small class="text-muted">Код для ТТН (2-3 знаки)</small></p>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <button type="submit" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Зберегти</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
