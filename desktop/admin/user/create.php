<?php
$settingsPage=array(
    "main_title" => "Користувачі",
    "title" => "Створення користувача",
    "navigation_array" => array(
        "Головна" => "/",
        "Користувачі" => "/desktop/admin/user",
        "Створення користувача" => ""
    )
);

include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

if(isset($_POST["surname"])) {
    if(!isset($_POST["password"]) || $_POST["password"]=="") $_POST["password"]="evFCVsdv1";
    $result=SQLInsert("user",
        array(
            "surname"=>$_POST["surname"],
            "name"=>$_POST["name"],
            "phone"=>$_POST["phone"],
            "email"=>$_POST["email"],
            "company"=>$_POST["company"],
            "position"=>$_POST["position"],
            "role"=>$_POST["role"],
            "password" => $_POST["password"],
            "updated"=>time(),
            "created"=>time(),
        ));
    if($result["error"]===true) {
        echo $result["error_message"];
        die();
    }
    if($_POST["email"]!="") sendEmailNotification($_POST["email"], $_POST["surname"]." ".$_POST["name"], "Для вас створено користувача в системі <a href='http://$_SERVER[HTTP_HOST]'>Consolid.io</a><hr>Логін: ".$_POST["email"]."<br>Пароль: ".$_POST["password"]."<hr>Змініть пароль при першому вході в систему", "Створення користувача");
    header("Location: index.php");
    die();
}

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Створення користувача</h4>
                </div>
                <div class="card-body">
                    <form action="create.php" method="post">
                        <input type="password" name="password" class="form-control" placeholder="" value="" style="display: none;">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carNumber">Прізвище</label>
                                    <input type="text" name="surname" class="form-control" placeholder="" value="">
                                    <p><small class="text-muted">Введіть прізвище</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Ім'я</label>
                                    <input type="text" name="name" class="form-control" placeholder="" value="">
                                    <p><small class="text-muted">Введіть ім'я</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Номер телефону</label>
                                    <input type="phone" name="phone" class="form-control" placeholder="+380..." value="">
                                    <p><small class="text-muted">Введіть контактний номер телефону</small></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="carModel">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="*@gmail.com" value="">
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
                                        echo "<option value='".$company["id"]."'>".$company["name"]."</option>";
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
                                        echo "<option value='".$user_position["id"]."'>".$user_position["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <label class="form-label" for="carCapacity">Роль</label>
                                <select class="select2 form-select" name="role">
                                    <option value="0">Оберіть роль</option>
                                    <?php
                                    $user_roleT=$DB->query("SELECT * FROM `user_role` WHERE 1");
                                    while ($user_role=$user_roleT->fetch_assoc()) {
                                        if($_SESSION["role"]!=1 && $user_role["id"]==1) continue;
                                        if(($_SESSION["role"]!=1 && $_SESSION["role"]!=2) && $user_role["id"]==2) continue;
                                        echo "<option value='".$user_role["id"]."'>".$user_role["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Створити</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
?>
<script type="application/javascript">
    jQuery(document).ready(function(){
        var chars="123456789ABCDEFGHJKLMNPQRSTUVWXYZ";
        var charslen=chars.length;
        var string="";
        var min=0;
        var max=charslen;
        for(var i=0; i<16; i++){
            string=string+chars[Math.floor(Math.random() * (+max - +min)) + +min];
        }
        jQuery("input[name='password']").val(string);
    });

</script>
