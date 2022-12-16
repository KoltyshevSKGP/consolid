<?php
$settingsPage=array(
    "main_title" => "Транспортна логістика",
    "title" => "ТТН",
    "navigation_array" => array(
        "Головна" => "/",
        "ТТН" => "/desktop/requests/ttn",
        "Перегляд №".$_GET["id"] => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

$requestT=$DB->query("SELECT * FROM `ttn` WHERE `id`=".$_GET["id"]);
$request=$requestT->fetch_assoc();

include("include/view_content.php");
include("include/view_processing.php");

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
                        <h4 class="card-title">Перегляд запиту</h4>
                    </div>
                    <div class="card-body">
                        <?php include("include/view_content_buttons.php")?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
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
                                <td>ID</td>
                                <td><?php echo $request["id"]?></td>
                            </tr>
                            <tr>
                                <td>Статус</td>
                                <td><?php echo $request["status_view"]?></td>
                            </tr>
                            <tr>
                                <td>Оновлено</td>
                                <td><?php echo $request["updated"]?></td>
                            </tr>
                            <tr>
                                <td>Створено</td>
                                <td><?php echo $request["created"]?></td>
                            </tr>
                            <tr>
                                <td>Активний</td>
                                <td><?php echo $request["active"]?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12">
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
                                <td>Виконавець</td>
                                <td><?php echo $companyDoer["link"]?></td>
                            </tr>
                            <tr>
                                <td>Замовник</td>
                                <td><?php echo $companySender["link"]?></td>
                            </tr>
                            <tr>
                                <td>Отримувач</td>
                                <td><?php echo $companyReceiver["link"]?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
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
                                <td>Точка завантаження</td>
                                <td><?php echo $uploadLocation["link"]?></td>
                            </tr>
                            <tr>
                                <td>Контактна особа</td>
                                <td><?php echo $contact["link"]?></td>
                            </tr>
                            <tr>
                                <td>Точка розвантаження</td>
                                <td><?php echo $downloadLocation["link"]?></td>
                            </tr>
                            <tr>
                                <td>Контактна особа</td>
                                <td><?php echo $contactR["link"]?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
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
                                <td>Транспортний засіб</td>
                                <td><?php echo $request["transport_view"]?></td>
                            </tr>
                            <tr>
                                <td>Причіп</td>
                                <td><?php //echo $request["transport_view"]?></td>
                            </tr>
                            <tr>
                                <td>Водій</td>
                                <td><?php echo $driver["link"]?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Подія</th>
                                <th>Користувач</th>
                                <th>Дата і час</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php //echo $request["object_log"];?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Послуга</th>
                                <th>Кількість</th>
                                <th>Ціна</th>
                                <th>Сума</th>
                            </tr>
                            </thead>
                            <tbody>
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
