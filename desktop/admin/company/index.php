<?php
$settingsPage=array(
    "main_title" => "Компанії",
    "title" => "Список компаній",
    "navigation_array" => array(
        "Головна" => "/",
        "Компанії" => "",
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$content=array();
$companyT=$DB->query("SELECT * FROM `company` WHERE 1");
while ($company=$companyT->fetch_assoc()) {
    $typeT=$DB->query("SELECT * FROM `company_type` WHERE `id`=".$company["company_type"]);
    $type=$typeT->fetch_assoc();
    if(!isset($type["id"])) $type=array("name"=>"-");
    $company["company_type"]=$type["name"];

    array_push($content, $company);
}
?>
<section id="basic-input">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд компаній</h4> <a class="btn btn-success waves-effect waves-float waves-light" href="create.php">Створити <i data-feather='plus'></i></a>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Перегляд компаній в системі
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Назва</th>
                            <th>Тип</th>
                            <th>ІПН</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($content as $company) {
                            $edit="";
                            if($_SESSION["role"]!=1) $edit="disabled";
                            echo '
                        <tr>
                            <td>'.$company["id"].'</td>
                            <td>'.$company["name"].'</td>
                            <td>'.$company["company_type"].'</td>
                            <td>'.$company["code"].'</td>
                            <td>
                                <a href="view.php?id='.$company["id"].'" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather="eye"></i></a>
                                <a href="edit.php?id='.$company["id"].'" class="btn btn-warning btn-sm waves-effect waves-float waves-light '.$edit.'"><i data-feather="edit"></i></a>
                            </td>
                        </tr>                            
                            ';
                        }
                        if(count($content)==0) echo "<tr><td colspan='5'>Відсутні дані</td></tr>";
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
