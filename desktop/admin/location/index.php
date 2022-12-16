<?php
$settingsPage=array(
    "main_title" => "Локації",
    "title" => "Список локацій",
    "navigation_array" => array(
        "Головна" => "/",
        "Локації" => "",
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$content=array();
$locationT=$DB->query("SELECT * FROM `company_location` WHERE 1");
while ($location=$locationT->fetch_assoc()) {
    $companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$location["company"]);
    $company=$companyT->fetch_assoc();
    if(!isset($company["id"])) $company=array("name"=>"-");
    $location["company_id"]=$location["company"];
    $location["company"]=$company["name"];

    $typeT=$DB->query("SELECT * FROM `company_location_type` WHERE `id`=".$location["type"]);
    $type=$typeT->fetch_assoc();
    if(!isset($type["id"])) $type=array("name"=>"-");
    $location["type"]=$type["name"];

    array_push($content, $location);
}
?>
<section id="basic-input">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд локацій</h4> <a class="btn btn-success waves-effect waves-float waves-light" href="create.php">Створити <i data-feather='plus'></i></a>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Перегляд локацій (склади, офіси) компаній. Локації використовуються для заявок
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Назва</th>
                            <th>Тип</th>
                            <th>Компанія</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($content as $location) {
                            $edit="";
                            if($_SESSION["role"]!=1 && $_SESSION["company_id"]!=$location["company_id"]) $edit="disabled";
                            echo '
                        <tr>
                            <td>'.$location["id"].'</td>
                            <td>'.$location["name"].'</td>
                            <td>'.$location["type"].'</td>
                            <td>'.$location["company"].'</td>
                            <td>
                                <a href="view.php?id='.$location["id"].'" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather="eye"></i></a>
                                <a href="edit.php?id='.$location["id"].'" class="btn btn-warning btn-sm waves-effect waves-float waves-light '.$edit.'"><i data-feather="edit"></i></a>
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
