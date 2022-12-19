<?php

include($_SERVER["DOCUMENT_ROOT"]."/core/db/connect.php");

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://t101.tool.skgp.eu/ajax/getPdf.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array("source" => "http://$_SERVER[HTTP_HOST]/test/execution/pallet/index.html", "landscape" => true, "use_print" => false, "margin"=>"0px 5px 0px 10px")),
    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    CURLOPT_USERPWD => ""
));

$response = curl_exec($curl);
file_put_contents($_SERVER["DOCUMENT_ROOT"].'/test/execution/pallet/test.pdf', $response);

header('Location: /test/execution/pallet/test.pdf');