<?php
$settingsPage=array(
    "main_title" => "Транспортна логістика",
    "title" => "Запити на доставку",
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
$requestT=$DB->query("SELECT * FROM `request_transport` WHERE `type`=1 AND `active`=1");
while ($request=$requestT->fetch_assoc()) {
    if($_SESSION["role"]!=1) {
        if($request["company"]!=$_SESSION["company_id"] && $request["company_receiver"]!=$_SESSION["company_id"] && $request["company_doer"]!=$_SESSION["company_id"]) continue;
    }
    $statusT=$DB->query("SELECT * FROM `request_transport_status` WHERE `id`=".$request["status"]);
    $status=$statusT->fetch_assoc();
    if(!isset($status["id"])) $status=array("name"=>"-");
    $request["status"]=$status["name"];

    $companyT=$DB->query("SELECT * FROM `company` WHERE `id`=".$request["company"]);
    $company=$companyT->fetch_assoc();
    if(!isset($company["id"])) $company=array("name"=>"-");
    $request["company"]=$company["name"];

    $locationT=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$request["upload_location"]);
    $location=$locationT->fetch_assoc();
    if(!isset($location["id"])) $location=array("name"=>"-", "address"=>"");
    $request["upload_location"]=$location["name"]." ".$location["address"];

    array_push($content, $request);
}
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
                            Перегляд запитів на транспортування
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
