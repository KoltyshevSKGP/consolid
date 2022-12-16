<?php
include ($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");
//sendEmailNotification($contact["email"], $contact["surname"]." ".$contact["name"], $email["content"], $email["subject"]);

//sendEmailNotification("ys@skgp.eu", "Yurii", "test", "temp");
//$cell=new Cell();

sendEmailNotification("ys@skgp.eu", "Yurii", "1", "1", array(
    array($_SERVER["DOCUMENT_ROOT"].'/storage/print/ttn_list_1.pdf', "ConsolidTTN1.pdf"),
    array($_SERVER["DOCUMENT_ROOT"].'/storage/print/pallet_list_3.pdf', "ConsolidPalletList3.pdf")
));
