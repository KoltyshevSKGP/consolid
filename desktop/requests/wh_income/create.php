<?php
$settingsPage=array(
    "main_title" => "Складська логістика",
    "title" => "Заявки на прийом",
    "navigation_array" => array(
        "Головна" => "/",
        "Запити" => "/desktop/requests/wh_income",
        "Створення запиту" => ""
    ),
    "timestamp" => time()
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["name"])) {
    SQLInsert("request_transport",
        array(
            "number"=>$_POST["number"],
            "company"=>$_POST["company"],
            "contact_user"=>$_POST["contact_user"],
            "upload_location"=>$_POST["upload_location"],
            "company_receiver"=>$_POST["company_receiver"],
            "download_location"=>$_POST["download_location"],
            "contact_user_receiver"=>$_POST["contact_user_receiver"],
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
?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <form action="create.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Основна інформація</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Номер документу</label>
                                    <input type="text" name="number" class="form-control" placeholder="№0001" value="">
                                    <p><small class="text-muted">Введіть внутрішній номер документу</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Контрагент</label>
                                <select class="select2 form-select" name="company">
                                    <option value="0">Оберіть компанію</option>
                                    <?php
                                    $companyT=$DB->query("SELECT * FROM `company` WHERE 1");
                                    while ($company=$companyT->fetch_assoc()) {
                                        echo "<option value='".$company["id"]."'>".$company["name"]."</option>";
                                    }
                                    ?>
                                </select>
                                <p><small class="text-muted">Оберіть компанію вантажовідправника чи <a target="_blank" href="/desktop/admin/company/create.php">створіть нову</a></small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Контактна особа</label>
                                <select class="select2 form-select" name="contact_user">
                                    <option value="0">Оберіть особу</option>
                                    <?php
                                    $userT=$DB->query("SELECT * FROM `user` WHERE 1");
                                    while ($user=$userT->fetch_assoc()) {
                                        echo "<option value='".$user["id"]."'>".$user["surname"]." ".$user["name"]."</option>";
                                    }
                                    ?>
                                </select>
                                <p><small class="text-muted">Оберіть контактну особу чи <a target="_blank" href="/desktop/admin/user/create.php">створіть нову</a></small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Компанія-отримувач</label>
                                <select class="select2 form-select" name="company_receiver">
                                    <option value="0">Оберіть компанію</option>
                                    <?php
                                    $companyT=$DB->query("SELECT * FROM `company` WHERE 1");
                                    while ($company=$companyT->fetch_assoc()) {
                                        echo "<option value='".$company["id"]."'>".$company["name"]."</option>";
                                    }
                                    ?>
                                </select>
                                <p><small class="text-muted">Оберіть компанію вантажовідправника чи <a target="_blank" href="/desktop/admin/company/create.php">створіть нову</a></small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Точка розвантаження</label>
                                <select class="select2 form-select" name="download_location">
                                    <option value="0">Оберіть локацію</option>
                                    <?php
                                    $locationT=$DB->query("SELECT * FROM `company_location` WHERE 1");
                                    while ($location=$locationT->fetch_assoc()) {
                                        echo "<option value='".$location["id"]."'>".$location["name"]." - ".$location["address"]."</option>";
                                    }
                                    ?>
                                </select>
                                <p><small class="text-muted">Оберіть точку завантаження чи <a target="_blank" href="/desktop/admin/location/create.php">створіть нову</a></small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Особливості пакування</label>
                                <select class="select2 form-select" name="packing_needs">
                                    <option value="0">Відсутні</option>
                                    <option value="1">-</option>
                                </select>
                                <p><small class="text-muted">Оберіть особливості пакування вантажу</small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Наявність пломби</label>
                                <select class="select2 form-select" name="seal">
                                    <option value="0">Відсутня</option>
                                    <option value="1">Наявна</option>
                                </select>
                                <p><small class="text-muted">Оберіть наявність плобми на вантаж</small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12" style="display: none">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Номер пломби</label>
                                    <input type="text" name="seal_number" class="form-control" placeholder="0000" value="">
                                    <p><small class="text-muted">Введіть номер пломби</small></p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Доставка</label>
                                <select class="select2 form-select" name="delivery_type">
                                    <option value="0">Власна доставка</option>
                                    <option value="1">Замовити транспорт</option>
                                </select>
                                <p><small class="text-muted">Оберіть спосіб доставки вантажу на склад</small></p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Дата доставки</label>
                                    <input type="text" name="delivery_date" class="form-control" placeholder="дд.мм.рррр" value="<?php echo date("d.m.Y", ($settingsPage["timestamp"]+24*3600))?>">
                                    <p><small class="text-muted">Введіть дату прибуття товару</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Час доставки</label>
                                    <input type="text" name="delivery_time" class="form-control" placeholder="00:00" value="">
                                    <p><small class="text-muted">Введіть час прибуття товару</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">ДНЗ транспорту</label>
                                    <input type="text" name="delivery_car_number" class="form-control" placeholder="ВС0000АА" value="">
                                    <p><small class="text-muted">Введіть державний номерний знак автомобіля</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12" style="display: none;">
                                <label class="form-label" for="carCapacity">Заявка на доставку</label>
                                <select class="select2 form-select" name="request_connected">
                                    <option value="0">Оберіть документ</option>
                                </select>
                                <p><small class="text-muted">Оберіть транспорту заявку чи <a target="_blank" href="/desktop/requests/to_send/create.php">створіть нову</a></small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-5 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-xl-9 col-12">
                                        <label class="form-label" for="carCapacity">SKU</label>
                                        <select class="select2 form-select" name="sku">
                                            <option value="0">Оберіть товар</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-12">
                                        <a style="width: 100%;margin-top: 26px;" class="btn btn-success btn-sm waves-effect waves-float waves-light"><i data-feather='plus'></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Кількість</label>
                                    <input type="text" name="sku_number" class="form-control" placeholder="000.00" value="">
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Дата виготовлення</label>
                                    <input type="text" name="sku_number" class="form-control" placeholder="дд.мм.рррр" value="">
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Партія</label>
                                    <input type="text" name="sku_number" class="form-control" placeholder="ххх" value="">
                                </div>
                            </div>
                            <div class="col-xl-1 col-md-2 col-12">
                                <a style="width: 100%;margin-top: 26px;" class="btn btn-success btn-sm waves-effect waves-float waves-light"><i data-feather='arrow-down'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Кількість</th>
                                <th>Дата виготовлення</th>
                                <th>Партія</th>
                                <th>Дії</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light disabled">Створити</button><br><br>
            </form>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
?>
<script type="application/javascript">
    jQuery("select[name='delivery_type']").change(function () {
        if(jQuery(this).val()=="1") {
            jQuery("input[name='delivery_date']").parent().parent().css("display", "none");
            jQuery("input[name='delivery_time']").parent().parent().css("display", "none");
            jQuery("input[name='delivery_car_number']").parent().parent().css("display", "none");

            jQuery("select[name='request_connected']").parent().parent().css("display", "block");
        }
        if(jQuery(this).val()=="0") {
            jQuery("input[name='delivery_date']").parent().parent().css("display", "block");
            jQuery("input[name='delivery_time']").parent().parent().css("display", "block");
            jQuery("input[name='delivery_car_number']").parent().parent().css("display", "block");

            jQuery("select[name='request_connected']").parent().parent().css("display", "none");
        }
    });

    jQuery("select[name='seal']").change(function () {
        if(jQuery(this).val()=="1") {
            jQuery("input[name='seal_number']").parent().parent().css("display", "block");
        }
        if(jQuery(this).val()=="0") {
            jQuery("input[name='seal_number']").parent().parent().css("display", "none");
        }
    });
</script>
