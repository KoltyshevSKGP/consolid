<?php
$settingsPage = array(
    "main_title" => "Адмін-палель",
    "title" => "SKU",
    "navigation_array" => array(
        "Головна" => "/",
        "SKU" => "",
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$content = array();
$requestT = $DB->query("SELECT sku.bar_code, sku.name, sku.id FROM sku,company WHERE  sku.company_id = company.id");
while ($request = $requestT->fetch_assoc()) {
    $units_query = $DB->query("SELECT id,name FROM units_of_measurement");
    $units_of_measurement = $units_query->fetch_assoc();
    if(!isset($request["id"])) $request=array("units_of_measurement"=>"-");
    $request["units_of_measurement"]=$units_of_measurement["name"];
    array_push($content, $request);
}

?>
    <section id="basic-input">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Перегляд SKU</h4> <a
                                class="btn btn-success waves-effect waves-float waves-light" href="create.php">Створити
                            <i data-feather='plus'></i></a>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Перегляд найменувань компанії
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Код</th>
                                <th>Найменування</th>
                                <th>Пакування</th>
                                <th>Дії</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($content as $key => $val) {
                                echo '
                        <tr>
                            <td>' . ($key +1) . '</td>
                            <td>' . $val["bar_code"] . '</td>
                            <td>' . $val["name"] . '</td>
                              <td>' . $val["units_of_measurement"] . '</td>
              
                             <td>
                              <a href="view.php?id=' . $val["id"] . '" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather="eye"></i></a>
                              <a href="edit.php?id=' . $val["id"] . '" class="btn btn-warning btn-sm waves-effect waves-float waves-light "><i data-feather="edit"></i></a>

                              </td>
        
                        </tr>                            
                            ';
                            }
                            ?>
                            <?php  if(count($content)==0) echo "<tr><td colspan='5'>Відсутні дані</td></tr>";
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
