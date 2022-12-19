<?php
if(isset($_POST["id"])) {
    $dataToProceed=formCirclePostData($_POST, array("id"));

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
    $sql=SQLUpdate("ttn", array("id"=>$_POST["id"]), "AND",
        $dataToProceed);
    if($sql["error"]===true) {
        echo $sql["error_message"];
        die();

    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://t101.tool.skgp.eu/ajax/getPdf.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode(array("source" => "http://$_SERVER[HTTP_HOST]/desktop/requests/ttn/include/print_ttn_content.php?id=".$_POST["id"], "landscape" => true, "use_print" => false, "margin"=>"0px 5px 0px 10px")),
        CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        CURLOPT_USERPWD => ""
    ));

    $response = curl_exec($curl);
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/storage/print/ttn_list_'.$_POST["id"].".pdf", $response);

    SQLInsert("log_objects",
        array("type"=>2,"object_type"=>"ttn","object_id"=>$_POST["id"],"user"=>$_SESSION["id"],"timestamp"=>time()));
    header("Location: view.php?id=".$_POST["id"]);
    die();
}