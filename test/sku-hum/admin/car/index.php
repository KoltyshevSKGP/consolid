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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд автомобілів</h4> <a class="btn btn-success waves-effect waves-float waves-light" href="add.php">Створити <i data-feather='plus'></i></a>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Перегляд автомобільного парку компанії
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Номерний знак</th>
                            <th>Статус</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Peter Charls</td>
                            <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
                            <td>
                                <a href="view.php" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather='eye'></i></a>
                                <a href="edit.php" class="btn btn-warning btn-sm waves-effect waves-float waves-light"><i data-feather='edit'></i></a>
                                <a class="btn btn-danger btn-sm waves-effect waves-float waves-light"><i data-feather='archive'></i></a>
                            </td>
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
