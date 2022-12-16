<?php
$settingsPage=array(
    "main_title" => "Довідники. Автомобілі",
    "title" => "Автомобілі компанії"
);

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
                    <h4 class="card-title">Створення автомобіля</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="carNumber">Номерний знак</label>
                                <input type="text" id="carNumber" class="form-control" placeholder="ВС...">
                                <p><small class="text-muted">Державний номерний знак автомобіля</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="carModel">Марка та модель автомобіля</label>
                                <input type="text" id="carModel" class="form-control" placeholder="">
                                <p><small class="text-muted">Назва марки та моделі автомобіля</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label class="form-label" for="carType">Тип автомобіля</label>
                            <select class="select2 form-select" id="carType">
                                <option value="AK">Приватний автомобіль</option>
                                <option value="AK">Мікроавтобус</option>
                                <option value="AK">Вантажівка</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label class="form-label" for="carCapacity">Об'єм</label>
                            <select class="select2 form-select" id="carCapacity">
                                <option value="AK">2 тони</option>
                                <option value="AK">5 тон</option>
                                <option value="AK">10 тон</option>
                                <option value="AK">20 тон</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="carNumber">Номерний знак причіпа</label>
                                <input type="text" id="carNumber" class="form-control" placeholder="ВС...">
                                <p><small class="text-muted">Державний номерний знак причіпа</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="carModel">Марка та модель причіпа</label>
                                <input type="text" id="carModel" class="form-control" placeholder="">
                                <p><small class="text-muted">Назва марки та моделі причіпа</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label class="form-label" for="carType">Тип причіпа</label>
                            <select class="select2 form-select" id="carType">
                                <option value="AK">Тент</option>
                                <option value="AK">Реф</option>
                                <option value="AK">Целмет</option>
                                <option value="AK">Інше</option>
                            </select>
                        </div>
                    </div>
                    <a href="index.php" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Створити</a><br><br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
