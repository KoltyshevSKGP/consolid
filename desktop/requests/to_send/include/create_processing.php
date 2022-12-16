<?php
if(isset($_POST["number"])) {
    $dataToProceed=formCirclePostData($_POST);

    $validation=array(
        "number" => array(
            "required" => false,
            "is_numeric" => false,
        ),
        "company" => array(
            "required" => true,
            "is_numeric" => true,
        ),
        "contact_user" => array(
            "required" => true,
            "is_numeric" => true,
        ),
        "upload_location" => array(
            "required" => true,
            "is_numeric" => true,
        ),
        "company_receiver" => array(
            "required" => true,
            "is_numeric" => true,
        ),
        "contact_user_receiver" => array(
            "required" => false,
            "is_numeric" => true,
        ),
        "download_location" => array(
            "required" => true,
            "is_numeric" => true,
        ),
        "temp_from" => array(
            "required" => false,
            "is_numeric" => false,
            "default" => "empty_to_zero",
        ),
        "temp_to" => array(
            "required" => false,
            "is_numeric" => false,
            "default" => "empty_to_zero",
        ),
        "date_ready" => array(
            "reformat" => "date",
            "default" => "empty_to_zero",
        ),
        "date_upload_from" => array(
            "reformat" => "date",
            "default" => "empty_to_zero",
        ),
        "date_upload_to" => array(
            "reformat" => "date",
            "default" => "empty_to_zero",
        ),
        "date_download" => array(
            "reformat" => "date",
            "default" => "empty_to_zero",
        ),
        "cargo_amount" => array(
            "required" => false,
            "is_numeric" => false,
            "default" => "empty_to_zero",
        ),
        "cargo_weight" => array(
            "required" => false,
            "is_numeric" => false,
            "default" => "empty_to_zero",
        ),
        "car_height" => array(
            "required" => false,
            "is_numeric" => false,
            "default" => "empty_to_zero",
        ),
        "cargo_price" => array(
            "required" => false,
            "is_numeric" => false,
            "default" => "empty_to_zero",
        ),
    );
    $dataToProceed=formValidateData($dataToProceed, $validation);
    if($dataToProceed["error"]===true) {
        echo $dataToProceed["error_message"];
        die();
    }
    $dataToProceed=$dataToProceed["result"];

    $dataToProceed["updated"]=time();
    $dataToProceed["created"]=time();
    $result=SQLInsert("request_transport",
        $dataToProceed);
    if($result["error"]===true) {
        echo "<pre>";
        print_r($dataToProceed);
        echo "</pre>";
        echo $result["error_message"];
        die();
    }
    SQLInsert("log_objects",
        array("type"=>1,"object_type"=>"request_transport","object_id"=>$result["result"]["id"],"user"=>$_SESSION["id"],"timestamp"=>time()));

    //
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://t101.tool.skgp.eu/ajax/getPdf.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode(array("source" => "https://$_SERVER[HTTP_HOST]/desktop/requests/to_send/include/print_pallet_content.php?id=".$result["result"]["id"], "landscape" => false, "use_print" => false, "margin"=>"0px 5px 0px 10px")),
        CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        CURLOPT_USERPWD => ""
    ));

    $response = curl_exec($curl);
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/storage/print/pallet_list_'.$result["result"]["id"].'.pdf', $response);
    //

    header("Location: index.php");
    die();
}