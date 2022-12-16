<?php
function formCirclePostData($data, $ignore=array()) {
    $result=array();
    foreach ($data as $key => $value) {
        if(in_array($key, $ignore)) continue;
        $result[$key]=$value;
    }
    return $result;
}

function formValidateData($data, $validation) {
    $result=array(
        "error" => false,
        "error_message" => "",
        "result" => array()
    );
    foreach ($data as $key => $value) {
        if(!isset($validation[$key])) {
            $result["result"][$key]=$value;
            continue;
        }
        if($validation[$key]["required"]===true &&
            (($value=="" && $validation[$key]["is_numeric"]===false)
                || ($value=="0" && $validation[$key]["is_numeric"]===true))) {
            $result["error"]=true;
            $result["error_message"]="Field ".$key." is required [".$value."]";
            return $result;
        }

        if($validation[$key]["is_numeric"]===true && !is_numeric($value)) {
            $result["error"]=true;
            $result["error_message"]="Field ".$key." is numeric, but you send ".$value;
            return $result;
        }

        switch ($validation[$key]["default"]) {
            case "empty_to_zero":
                if($value=="") $value=0;
                break;
        }

        switch ($validation[$key]["reformat"]) {
            case "date":
                $value=str_replace("/",".",$value);
                if($value!="") $value=strtotime($value);
                break;
        }

        $result["result"][$key]=$value;
    }
    return $result;
}