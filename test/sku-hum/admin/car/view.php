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
    <div class="row" id="table-bordered">
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд автомобіля</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <a href="index.php" style="width: 100%" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather='arrow-left'></i> До списку</a><br><br>
                        <a href="edit.php" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather='edit'></i></a><br><br>
                        <a href="index.php" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Деактивувати <i data-feather='archive'></i></a>
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
                            <td>Номерний знак</td>
                            <td>Peter Charls</td>
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
