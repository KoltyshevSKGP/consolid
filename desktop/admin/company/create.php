<?php
$settingsPage=array(
    "main_title" => "Компанії",
    "title" => "Створення компанії",
    "navigation_array" => array(
        "Головна" => "/",
        "Компанії" => "/desktop/admin/company",
        "Створення компанії" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["name"])) {
    $sql=SQLInsert("company",
        array(
            "name"=>$_POST["name"],
            "company_type"=>$_POST["company_type"],
            "print_code"=>$_POST["print_code"],
            "email"=>$_POST["email"],
            "full_name"=>$_POST["full_name"],
            "ipn"=>$_POST["ipn"],
            "phone"=>$_POST["phone"],
            "code"=>$_POST["code"],
            "bank"=>$_POST["bank"],
            "bank_account"=>$_POST["bank_account"],
            "updated"=>time(),
            "created"=>time(),
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
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Назва</label>
                                    <input type="text" name="name" class="form-control" placeholder="ТОВ Назва" value="">
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
                                        echo "<option value='".$type["id"]."'>".$type["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="*@gmail.com" value="">
                                    <p><small class="text-muted">Введіть основну електронну адресу</small></p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Повна назва компанії</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="ТОВ Назва" value="">
                                    <p><small class="text-muted">Введіть юридичну назву компанії</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">ЄДРПОУ компанії</label>
                                    <input type="text" name="code" class="form-control" placeholder="00000000" value="">
                                    <p><small class="text-muted">Введіть реєстраційний номер компанії</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">ІПН компанії</label>
                                    <input type="text" name="ipn" class="form-control" placeholder="00000000" value="">
                                    <p><small class="text-muted">Введіть податковий номер компанії</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Банківський рахунок</label>
                                    <input type="text" name="bank_account" class="form-control" placeholder="UA0000" value="">
                                    <p><small class="text-muted">Введіть розрахунковий рахунок</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Банківська установа</label>
                                    <input type="text" name="bank" class="form-control" placeholder="ПАТ 'Приватбанк'" value="">
                                    <p><small class="text-muted">Введіть назву банківської установи</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Контактний номер</label>
                                    <input type="text" name="phone" class="form-control" placeholder="+380" value="">
                                    <p><small class="text-muted">Введіть контактний номер для документів</small></p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Логістичний код</label>
                                    <input type="text" name="print_code" class="form-control" placeholder="XXX" value="">
                                    <p><small class="text-muted">Код для ТТН (2-3 знаки)</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Рівень доступу</label>
                                <select class="select2 form-select" name="access">
                                    <option value="0">Глобальний доступ</option>
                                    <option value="1">Локальний доступ</option>
                                </select>
                                <p><small class="text-muted">Оберіть рівень доступу компанії в Consolid</small></p>
                            </div>
                            <hr>
                        </div>
                        <button type="submit" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Створити</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
