<?php

include($_SERVER["DOCUMENT_ROOT"]."/core/db/connect.php");

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://t101.tool.skgp.eu/ajax/getPdf.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array("source" => "https://$_SERVER[HTTP_HOST]/desktop/requests/ttn/include/print_ttn_content.php?id=".$_GET["id"], "landscape" => true, "use_print" => false, "margin"=>"0px 5px 0px 10px")),
    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    CURLOPT_USERPWD => ""
));

$response = curl_exec($curl);
file_put_contents($_SERVER["DOCUMENT_ROOT"].'/storage/print/ttn_list_'.$_GET["id"].".pdf", $response);

header('Location: /storage/print/ttn_list_'.$_GET["id"].'.pdf');