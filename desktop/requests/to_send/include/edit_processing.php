<?php
if(isset($_POST["number"])) {
    $dataToProceed=formCirclePostData($_POST, array("id"));

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
            "required" => true,
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
            "default" => "empty_to_zero",
        ),
        "cargo_weight" => array(
            "default" => "empty_to_zero",
        ),
        "car_height" => array(
            "default" => "empty_to_zero",
        ),
        "cargo_price" => array(
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
    $sql=SQLUpdate("request_transport", array("id"=>$_POST["id"]), "AND",
        $dataToProceed);
    if($sql["error"]===true) {
        echo $sql["error_message"];
        die();

    }
    SQLInsert("log_objects",
        array("type"=>2,"object_type"=>"request_transport","object_id"=>$_POST["id"],"user"=>$_SESSION["id"],"timestamp"=>time()));

    //
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://t101.tool.skgp.eu/ajax/getPdf.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode(array("source" => "http://$_SERVER[HTTP_HOST]/desktop/requests/to_send/include/print_pallet_content.php?id=".$_POST["id"], "landscape" => false, "use_print" => false, "margin"=>"0px 5px 0px 10px")),
        CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        CURLOPT_USERPWD => ""
    ));

    $response = curl_exec($curl);
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/storage/print/pallet_list_'.$_POST["id"].'.pdf', $response);
    //

    header("Location: view.php?id=".$_POST["id"]);
    die();
}