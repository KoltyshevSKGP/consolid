<?php
$settingsPage=array(
    "main_title" => "Користувачі",
    "title" => "Редагування користувача ID".$_GET["id"],
    "navigation_array" => array(
        "Головна" => "/",
        "Користувачі" => "/desktop/admin/user",
        "Користувач ID".$_GET["id"] => "/desktop/admin/user/view.php?id=".$_GET["id"],
        "Редагування" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["surname"])) {
    SQLUpdate("user", array("id"=>$_POST["id"]), "AND",
        array(
            "surname"=>$_POST["surname"],
            "name"=>$_POST["name"],
            "phone"=>$_POST["phone"],
            "email"=>$_POST["email"],
            "company"=>$_POST["company"],
            "position"=>$_POST["position"],
            "role"=>$_POST["role"],
            "updated"=>time(),
        ));
    header("Location: view.php?id=".$_POST["id"]);
    die();
}

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$userT=$DB->query("SELECT * FROM `user` WHERE `id`=".$_GET["id"]);
$user=$userT->fetch_assoc();


?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Редагування користувача</h4>
                </div>
                <div class="card-body">
                    <form action="edit.php" method="post">
                        <input type="text" name="id" style="display: none" class="form-control" placeholder="" value="<?php echo $user["id"]?>">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Прізвище</label>
                                    <input type="text" name="surname" class="form-control" placeholder="" value="<?php echo $user["surname"]?>">
                                    <p><small class="text-muted">Введіть прізвище</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Ім'я</label>
                                    <input type="text" name="name" class="form-control" placeholder="" value="<?php echo $user["name"]?>">
                                    <p><small class="text-muted">Введіть ім'я</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Номер телефону</label>
                                    <input type="phone" name="phone" class="form-control" placeholder="+380..." value="<?php echo $user["phone"]?>">
                                    <p><small class="text-muted">Введіть контактний номер телефону</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="*@gmail.com" value="<?php echo $user["email"]?>">
                                    <p><small class="text-muted">Введіть контактну електронну адресу</small></p>
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
                                        if($company["id"]==$user["company"]) $selected=" selected";
                                        echo "<option value='".$company["id"]."' $selected>".$company["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Посада</label>
                                <select class="select2 form-select" name="position">
                                    <option value="0">Оберіть посаду</option>
                                    <?php
                                    $user_positionT=$DB->query("SELECT * FROM `user_position` WHERE 1");
                                    while ($user_position=$user_positionT->fetch_assoc()) {
                                        $selected="";
                                        if($user_position["id"]==$user["position"]) $selected=" selected";
                                        echo "<option value='".$user_position["id"]."' $selected>".$user_position["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="role">Роль</label>
                                <select class="select2 form-select" name="role">
                                    <option value="0">Оберіть роль</option>
                                    <?php
                                    $user_roleT=$DB->query("SELECT * FROM `user_role` WHERE 1");
                                    while ($user_role=$user_roleT->fetch_assoc()) {
                                        if($_SESSION["role"]!=1 && $user_role["id"]==1) continue;
                                        if(($_SESSION["role"]!=1 && $_SESSION["role"]!=2) && $user_role["id"]==2) continue;
                                        $selected="";
                                        if($user_role["id"]==$user["role"]) $selected=" selected";
                                        echo "<option value='".$user_role["id"]."' $selected>".$user_role["name"]."</option>";
                                    }
                                    ?>
                                </select>
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
