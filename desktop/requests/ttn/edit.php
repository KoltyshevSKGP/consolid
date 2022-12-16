<?php
$settingsPage=array(
    "main_title" => "Транспортна логістика",
    "title" => "ТТН",
    "navigation_array" => array(
        "Головна" => "/",
        "ТТН" => "/desktop/requests/ttn",
        "ТТН ID".$_GET["id"] => "/desktop/requests/ttn/view.php?id=".$_GET["id"],
        "Редагування" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

include("include/edit_processing.php");

include("include/edit_content.php");

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <form action="edit.php" method="post">
                <input type="text" name="id" style="display: none" class="form-control" placeholder="" value="<?php echo $request["id"]?>">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Основна інформація</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $pageContent[0];?>
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
