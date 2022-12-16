<?php

include($_SERVER["DOCUMENT_ROOT"]."/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");

$requestT=$DB->query("SELECT * FROM `ttn` WHERE `id`=".$_GET["id"]);
$request=$requestT->fetch_assoc();

$requestConnectedT=$DB->query("SELECT * FROM `request_transport` WHERE `id`=".$request["request_connected"]);
$requestConnected=$requestConnectedT->fetch_assoc();

$contactT=$DB->query("SELECT * FROM `user` WHERE `id`=".$requestConnected["contact_user"]);
$contact=$contactT->fetch_assoc();

$email=array(
    "subject" => "Обробка запиту на доставку №".$requestConnected["id"],
    "content" => "Ваш запит на доставку №".$requestConnected["id"]." отримав сформовану ТТН та палетні листи<br>Переглянути запит: <a href='https://$_SERVER[HTTP_HOST]/desktop/requests/to_send/view.php?id=".$_GET["id"]."'>consolid.io</a>"
);


if(isset($contact["email"]) && $contact["email"]!="" && $contact["email"]!="-")
    sendEmailNotification($contact["email"], $contact["surname"]." ".$contact["name"], $email["content"], $email["subject"], array(
        $_SERVER["DOCUMENT_ROOT"].'/storage/print/ttn_list_'.$request["id"].'.pdf' => "ConsolidTTN".$request["id"].".pdf",
        $_SERVER["DOCUMENT_ROOT"].'/storage/print/pallet_list_'.$requestConnected["id"].'.pdf' => "ConsolidPalletList".$requestConnected["id"].".pdf"
    ));


header("Location: view.php?id=".$_GET["id"]);