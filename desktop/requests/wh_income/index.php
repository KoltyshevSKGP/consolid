<?php
$settingsPage=array(
    "main_title" => "Складська логістика",
    "title" => "Заявки на прийом",
    "navigation_array" => array(
        "Головна" => "/",
        "Запити" => "",
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$content=array();

?>
    <section id="basic-input">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Перегляд запитів</h4> <a class="btn btn-success waves-effect waves-float waves-light" href="create.php">Створити <i data-feather='plus'></i></a>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Перегляд складських запитів на прийом продукції
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Компанія</th>
                                <th>Локація</th>
                                <th>Статус</th>
                                <th>Дії</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($content as $request) {
                                echo '
                        <tr>
                            <td>'.$request["id"].'</td>
                            <td>'.$request["company"].'</td>
                            <td>'.$request["upload_location"].'</td>
                            <td>'.$request["status"].'</td>
                            <td>
                                <a href="view.php?id='.$request["id"].'" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather="eye"></i></a>
                                <a href="edit.php?id='.$request["id"].'" class="btn btn-warning btn-sm waves-effect waves-float waves-light"><i data-feather="edit"></i></a>
                            </td>
                        </tr>                            
                            ';
                            }
                            ?>
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
