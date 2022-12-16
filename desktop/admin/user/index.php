<?php
$settingsPage=array(
    "main_title" => "Користувачі",
    "title" => "Список користувачів",
    "navigation_array" => array(
        "Головна" => "/",
        "Користувачі" => "",
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$content=array();
$userT=$DB->query("SELECT * FROM `user` WHERE 1");
while ($user=$userT->fetch_assoc()) {
    $companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$user["company"]);
    $company=$companyT->fetch_assoc();
    if(!isset($company["id"])) $company=array("name"=>"-");
    $user["company"]=$company["name"];

    $positionT=$DB->query("SELECT * FROM `user_position` WHERE `id`=".$user["position"]);
    $position=$positionT->fetch_assoc();
    if(!isset($position["id"])) $position=array("name"=>"-");
    $user["position"]=$position["name"];

    array_push($content, $user);
}
?>
<section id="basic-input">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд користувачів</h4> <a class="btn btn-success waves-effect waves-float waves-light" href="create.php">Створити <i data-feather='plus'></i></a>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Перегляд користувачів системи
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Прізвище та ім'я</th>
                            <th>Номер телефону</th>
                            <th>Компанія</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($content as $user) {
                            $edit="";
                            if($user["role"]==1 && $_SESSION["role"]!=1) $edit="disabled";
                            if($_SESSION["role"]>2) $edit="disabled";
                            echo '
                        <tr>
                            <td>'.$user["id"].'</td>
                            <td>'.$user["surname"].' '.$user["name"].'</td>
                            <td>'.$user["phone"].'</td>
                            <td>'.$user["company"].'</td>
                            <td>
                                <a href="view.php?id='.$user["id"].'" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather="eye"></i></a>
                                <a href="edit.php?id='.$user["id"].'" class="btn btn-warning btn-sm waves-effect waves-float waves-light '.$edit.'"><i data-feather="edit"></i></a>
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
