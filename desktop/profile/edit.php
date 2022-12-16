<?php
$settingsPage=array(
    "main_title" => "Профіль користувача",
    "title" => "Редагування профілю",
    "navigation_array" => array(
        "Головна" => "/",
        "Профіль" => "/desktop/profile",
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
            "password"=>$_POST["password"],
        ));
    header("Location: index.php");
    die();
}

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");

$userT=$DB->query("SELECT * FROM `user` WHERE `id`=".$_SESSION["id"]);
$user=$userT->fetch_assoc();


?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Редагування профілю</h4>
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
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Пароль</label>
                                    <input type="password" name="password" class="form-control" placeholder="***" value="<?php echo $user["password"]?>">
                                    <p><small class="text-muted">Введіть пароль доступу до системи</small></p>
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
