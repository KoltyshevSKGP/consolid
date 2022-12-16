<?php
$settingsPage=array(
    "main_title" => "Транспорт",
    "title" => "Список транспортних засобів",
    "navigation_array" => array(
        "Головна" => "/",
        "Автопарк" => "",
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$content=array();
$transportT=$DB->query("SELECT * FROM `transport`");
$transport_type =$DB->query("SELECT * FROM transport, transport_type WHERE transport.type = transport_type.id");
$transport_brand =$DB->query("SELECT * FROM transport, transport_brand WHERE transport.brand = transport_brand.id");
$download_method =$DB->query("SELECT * FROM transport,download_method WHERE transport.download_method = download_method.id");
while ($transport=$transportT->fetch_assoc()) {
    $transport_type_res = $transport_type->fetch_assoc();
    $transport_brand_res =  $transport_brand->fetch_assoc();
    $download_method_res =  $download_method->fetch_assoc();
    if($transport['type'] == $transport_type_res['id']) {
        $transport['transport_type'] = $transport_type_res['name'];
    }
    if($transport['brand'] == $transport_brand_res['id']) {
        $transport['transport_brand'] = $transport_brand_res['name'];
    }

    if($transport['download_method'] == $download_method_res['id']) {
        $transport['download_method_name'] = $download_method_res['name'];
    }
    array_push($content, $transport);
}
?>
<section id="basic-input">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перегляд автопарку</h4> <a class="btn btn-success waves-effect waves-float waves-light" href="create.php">Створити <i data-feather='plus'></i></a>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Перегляд автопарку в системі
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>МОДЕЛЬ АВТО</th>
                            <th>ДНЗ</th>
                            <th>ТИП ЗАВАНТАЖЕННЯ</th>
                            <th>ТИП КУЗОВА</th>
                            <th>ДІЇ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($content as $index => $transport) {
                            $edit="";
                            if($_SESSION["role"]!=1) $edit="disabled";
                            echo '
                        <tr>
                             <td>'.($index + 1).'</td>
                           <td>'.$transport['transport_brand']." ".$transport['year_of_manufacture'].'</td>
                            <td>'. $transport['license_plate'] .'</td>
                           <td>'. $transport['download_method_name'] .'</td>
                               <td>'. $transport['transport_type'] .'</td>
                            <td>
                                <a href="view.php?id='.$transport["id"].'" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather="eye"></i></a>
                                <a href="edit.php?id='.$transport["id"].'" class="btn btn-warning btn-sm waves-effect waves-float waves-light '.$edit.'"><i data-feather="edit"></i></a>
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
