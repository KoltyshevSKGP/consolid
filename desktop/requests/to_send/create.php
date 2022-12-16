<?php
$settingsPage=array(
    "main_title" => "Транспортна логістика",
    "title" => "Запити на доставку",
    "navigation_array" => array(
        "Головна" => "/",
        "Запити" => "/desktop/requests/to_send",
        "Створення запиту" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

include("include/create_processing.php");

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

include("include/create_content.php");

?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <form action="create.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Основна інформація</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $pageContent[0];?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <?php echo $pageContent[1];?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <?php echo $pageContent[2];?>
                    </div>
                </div>
                <button type="submit" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Створити</button><br><br>
            </form>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
include("include/create_js.php");