<?php
$settingsPage=array(
    "main_title" => "Профіль користувача",
    "title" => "Робота із профілем користувача"
);

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$userT=$conn->query("SELECT * FROM `user` WHERE `id`=".$_GET["id"]);
$user=$userT->fetch_assoc();
?>
<section id="basic-input">
    <div class="row" id="table-bordered">
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд профіля</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <a href="edit.php" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather='edit'></i></a><br><br>
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
                            <td>Прізвище</td>
                            <td><?php echo $user["surname"]?></td>
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
