<?php
if(isset($_POST["ttn_reason"])) {
    $dataToProceed=formCirclePostData($_POST);

    $validation=array(
        "ttn_reason" => array(
            "required" => false,
            "is_numeric" => true,
        ),
        "request_connected" => array(
            "required" => true,
            "is_numeric" => true,
        ),
        "doc_date" => array(
            "reformat" => "date",
            "default" => "empty_to_zero",
        ),
        "company_doer" => array(
            "required" => false,
            "is_numeric" => true,
        ),
        "transport" => array(
            "required" => true,
            "is_numeric" => true,
        ),
        "transport_add" => array(
            "required" => false,
            "is_numeric" => true,
        ),
        "driver" => array(
            "required" => false,
            "is_numeric" => true,
        ),
    );
    $dataToProceed=formValidateData($dataToProceed, $validation);
    if($dataToProceed["error"]===true) {
        echo $dataToProceed["error_message"];
        die();
    }
    $dataToProceed=$dataToProceed["result"];

    $dataToProceed["updated_at"]=time();
    $dataToProceed["created_at"]=time();
    $result=SQLInsert("ttn",
        $dataToProceed);
    if($result["error"]===true) {
        echo "<pre>";
        print_r($dataToProceed);
        echo "</pre>";
        echo $result["error_message"];
        die();
    }


    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://t101.tool.skgp.eu/ajax/getPdf.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode(array("source" => "http://$_SERVER[HTTP_HOST]/desktop/requests/ttn/include/print_ttn_content.php?id=".$result["result"]["id"], "landscape" => true, "use_print" => false, "margin"=>"0px 5px 0px 10px")),
        CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        CURLOPT_USERPWD => ""
    ));

    $response = curl_exec($curl);
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/storage/print/ttn_list_'.$result["result"]["id"].".pdf", $response);


    SQLInsert("log_objects",
        array("type"=>1,"object_type"=>"ttn","object_id"=>$result["result"]["id"],"user"=>$_SESSION["id"],"timestamp"=>time()));
    header("Location: view.php?id=".$result["result"]["id"]);
    die();
}