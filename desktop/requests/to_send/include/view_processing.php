<?php
$email=array(
    "subject" => "Обробка запиту на доставку №".$_GET["id"],
    "content" => "Ваш запит на доставку №".$_GET["id"]." змінив статус на: ",
    "content_finish" => "<br>Переглянути запит: <a href='https://$_SERVER[HTTP_HOST]/desktop/requests/to_send/view.php?id=".$_GET["id"]."'>consolid.io</a>"
);
if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "todo":
            switch ($request["status"]) {
                case 1:
                    $DB->query("UPDATE `request_transport` SET `status`=2 WHERE `id`=".$_GET["id"]);
                    $email["content"].="Взято на опрацювання".$email["content_finish"];
                    if(isset($contact["email"]) && $contact["email"]!="" && $contact["email"]!="-")
                        sendEmailNotification($contact["email"], $contact["surname"]." ".$contact["name"], $email["content"], $email["subject"]);
                    break;
            }
            break;
        case "accept":
            switch ($request["status"]) {
                case 2:
                    $DB->query("UPDATE `request_transport` SET `status`=3 WHERE `id`=".$_GET["id"]);
                    $email["content"].="Взято у виконання".$email["content_finish"];
                    if(isset($contact["email"]) && $contact["email"]!="" && $contact["email"]!="-")
                        sendEmailNotification($contact["email"], $contact["surname"]." ".$contact["name"], $email["content"], $email["subject"]);
                    break;
            }
            break;
        case "decline":
            switch ($request["status"]) {
                case 1:
                case 2:
                    $DB->query("UPDATE `request_transport` SET `status`=21 WHERE `id`=".$_GET["id"]);
                    break;
                case 21:
                    $DB->query("UPDATE `request_transport` SET `status`=22 WHERE `id`=".$_GET["id"]);
                    $email["content"].="Відхилено".$email["content_finish"];
                    if(isset($contact["email"]) && $contact["email"]!="" && $contact["email"]!="-")
                        sendEmailNotification($contact["email"], $contact["surname"]." ".$contact["name"], $email["content"], $email["subject"]);
                    break;
            }
            break;
    }
    header("Location: view.php?id=".$_GET["id"]);
}