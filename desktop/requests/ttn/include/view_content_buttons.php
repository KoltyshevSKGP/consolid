<?php
echo '
<p class="card-text">
    <a href="index.php" style="width: 100%" class="btn btn-primary btn-sm waves-effect waves-float waves-light"><i data-feather="arrow-left"></i> До списку</a><br><br>
';

$buttons_isset=array(
    "edit" => false,
    "action_todo" => false,
    "action_decline" => false,
    "action_accept" => false,
);
switch ($request["_status"]) {
    case 1://створено
        if(
            ($request["company_doer"]==0 && $request["company"]!=$_SESSION["company_id"])
            ||
            ($request["company_doer"]!=0 && $request["company_doer"]==$_SESSION["company_id"])
        ) {
            $buttons_isset["action_todo"]=true;
            $buttons_isset["action_decline"]=true;
            echo '<a href="view.php?id='.$_GET["id"].'&action=todo" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Взяти на опрацювання <i data-feather="check"></i></a><br><br>';
            echo '<a href="view.php?id='.$_GET["id"].'&action=decline" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Відхилити <i data-feather="trash"></i></a><br><br>';
        }
        if(
            $request["company"]==$_SESSION["company_id"]
        ) {
            $buttons_isset["edit"]=true;
            $buttons_isset["action_decline"]=true;
            echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
            echo '<a href="view.php?id='.$_GET["id"].'&action=decline" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Скасувати <i data-feather="trash"></i></a><br><br>';
        }
        if($_SESSION["role"]==1) {
            if(!$buttons_isset["edit"]) echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
            if(!$buttons_isset["action_todo"]) echo '<a href="view.php?id='.$_GET["id"].'&action=todo" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Взяти на опрацювання <i data-feather="check"></i></a><br><br>';
            if(!$buttons_isset["action_decline"]) echo '<a href="view.php?id='.$_GET["id"].'&action=decline" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Скасувати <i data-feather="trash"></i></a><br><br>';
        }
        break;
    case 2://на опрацюванні
        if(
            ($request["company_doer"]==0 && $request["company"]!=$_SESSION["company_id"])
            ||
            ($request["company_doer"]!=0 && $request["company_doer"]==$_SESSION["company_id"])
        ) {
            $buttons_isset["action_accept"]=true;
            $buttons_isset["action_decline"]=true;
            echo '<a href="view.php?id='.$_GET["id"].'&action=accept" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Підтвердити <i data-feather="check"></i></a><br><br>';
            echo '<a href="view.php?id='.$_GET["id"].'&action=decline" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Відхилити <i data-feather="trash"></i></a><br><br>';
        }
        if(
            $request["company"]==$_SESSION["company_id"]
        ) {
            $buttons_isset["edit"]=true;
            echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
        }

        if($_SESSION["role"]==1) {
            if(!$buttons_isset["edit"]) echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
            if(!$buttons_isset["action_accept"]) echo '<a href="view.php?id='.$_GET["id"].'&action=accept" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Підтвердити <i data-feather="check"></i></a><br><br>';
            if(!$buttons_isset["action_decline"]) echo '<a href="view.php?id='.$_GET["id"].'&action=decline" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Скасувати <i data-feather="trash"></i></a><br><br>';
        }
        break;
    case 21://відхилено менеджером
        if(
            ($request["company_doer"]==0 && $request["company"]!=$_SESSION["company_id"] && ($_SESSION["role"]==1 || $_SESSION["role"]==2))
            ||
            ($request["company_doer"]!=0 && $request["company_doer"]==$_SESSION["company_id"] && ($_SESSION["role"]==1 || $_SESSION["role"]==2))
        ) {
            $buttons_isset["action_accept"]=true;
            $buttons_isset["action_decline"]=true;

            echo '<a href="view.php?id='.$_GET["id"].'&action=accept" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Підтвердити <i data-feather="check"></i></a><br><br>';
            echo '<a href="view.php?id='.$_GET["id"].'&action=decline" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Відхилити <i data-feather="trash"></i></a><br><br>';
        }

        if($_SESSION["role"]==1) {
            if(!$buttons_isset["edit"]) echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
            if(!$buttons_isset["action_accept"]) echo '<a href="view.php?id='.$_GET["id"].'&action=accept" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Підтвердити <i data-feather="check"></i></a><br><br>';
            if(!$buttons_isset["action_decline"]) echo '<a href="view.php?id='.$_GET["id"].'&action=decline" style="width: 100%" class="btn btn-danger btn-sm waves-effect waves-float waves-light">Скасувати <i data-feather="trash"></i></a><br><br>';
        }
        break;
    case 22://відхилено керівником
        if($_SESSION["role"]==1) {
            echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
            echo '<a href="view.php?id='.$_GET["id"].'&action=accept" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light">Підтвердити <i data-feather="check"></i></a><br><br>';
        }
        break;
    case 3://затверджено
        if(
            ($request["company_doer"]==0 && $request["company"]!=$_SESSION["company_id"] && ($_SESSION["role"]==1 || $_SESSION["role"]==2))
            ||
            ($request["company_doer"]!=0 && $request["company_doer"]==$_SESSION["company_id"] && ($_SESSION["role"]==1 || $_SESSION["role"]==2))
        ) {
            echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
            echo '<a href="#" style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light disabled">Створити рейс <i data-feather="check"></i></a><br><br>';
        }
        break;
}
echo '<a href="edit.php?id='.$_GET["id"].'" style="width: 100%" class="btn btn-warning btn-sm waves-effect waves-float waves-light">Редагувати <i data-feather="edit"></i></a><br><br>';
echo '<a href="print_ttn.php?id='.$_GET["id"].'" target="_blank" style="width: 100%" class=" btn btn-success btn-sm waves-effect waves-float waves-light">ТТН <i data-feather="printer"></i></a><br><br>';
echo '<a href="send_ttn.php?id='.$_GET["id"].'" style="width: 100%" class=" btn btn-success btn-sm waves-effect waves-float waves-light">Відправити ТТН <i data-feather="send"></i></a><br><br>';
?>
</p>
