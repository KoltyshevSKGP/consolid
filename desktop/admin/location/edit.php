<?php
$settingsPage=array(
    "main_title" => "Локації",
    "title" => "Редагування локації ID".$_GET["id"],
    "navigation_array" => array(
        "Головна" => "/",
        "Локації" => "/desktop/admin/location",
        "Локація ID".$_GET["id"] => "/desktop/admin/location/view.php?id=".$_GET["id"],
        "Редагування" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["name"])) {
    SQLUpdate("company_location", array("id"=>$_POST["id"]), "AND",
        array(
            "name"=>$_POST["name"],
            "company"=>$_POST["company"],
            "type"=>$_POST["type"],
            "contact_person"=>$_POST["contact_person"],
            "address"=>$_POST["address"],
            "maps_link"=>$_POST["maps_link"],
            "schedule"=>$_POST["schedule"],
            "updated"=>time(),
        ));
    header("Location: index.php");
    die();
}

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$locationT=$DB->query("SELECT * FROM `company_location` WHERE `id`=".$_GET["id"]);
$location=$locationT->fetch_assoc();


?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Редагування локації</h4>
                </div>
                <div class="card-body">
                    <form action="edit.php" method="post">
                        <input type="text" name="id" style="display: none" class="form-control" placeholder="" value="<?php echo $location["id"]?>">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Назва</label>
                                    <input type="text" name="name" class="form-control" placeholder="Склад Львів" value="<?php echo $location["name"]?>">
                                    <p><small class="text-muted">Введіть умовну назву локації</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Компанія</label>
                                <select class="select2 form-select" name="company">
                                    <option value="0">Оберіть компанію</option>
                                    <?php
                                    $companyT=$DB->query("SELECT * FROM `company` WHERE 1");
                                    while ($company=$companyT->fetch_assoc()) {
                                        $selected="";
                                        if($company["id"]==$location["company"]) $selected=" selected";
                                        echo "<option value='".$company["id"]."' $selected>".$company["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Тип</label>
                                <select class="select2 form-select" name="type">
                                    <option value="0">Оберіть тип</option>
                                    <?php
                                    $typeT=$DB->query("SELECT * FROM `company_location_type` WHERE 1");
                                    while ($type=$typeT->fetch_assoc()) {
                                        $selected="";
                                        if($type["id"]==$location["type"]) $selected=" selected";
                                        echo "<option value='".$type["id"]."' $selected>".$type["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Контактна особа</label>
                                <select class="select2 form-select" name="contact_person">
                                    <option value="0">Оберіть особу</option>
                                    <?php
                                    $userT=$DB->query("SELECT * FROM `user` WHERE 1");
                                    while ($user=$userT->fetch_assoc()) {
                                        $selected="";
                                        if($user["id"]==$location["contact_person"]) $selected=" selected";
                                        echo "<option value='".$user["id"]."' $selected>".$user["surname"]." ".$user["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Адреса</label>
                                    <input type="text" name="address" class="form-control" placeholder="Україна, м.Львів..." value="<?php echo $location["address"]?>">
                                    <p><small class="text-muted">Введіть адресу локації</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Посилання Maps</label>
                                    <input type="text" name="maps_link" class="form-control" placeholder="https://" value="<?php echo $location["maps_link"]?>">
                                    <p><small class="text-muted">Введіть посилання на точні координати локації</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Графік роботи</label>
                                    <input type="text" name="schedule" class="form-control" placeholder="Пн-Пт 09:00-18:00" value="<?php echo $location["schedule"]?>">
                                    <p><small class="text-muted">Введіть графік роботи локації</small></p>
                                </div>
                            </div>
                        </div>
                        <button type="submit" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Зберегти</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
