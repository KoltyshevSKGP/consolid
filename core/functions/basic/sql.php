<?php
function SQLInsert($table, $data, $auth=array("module"=>"unset", "user"=>0, "device"=>0), $debug=false) {
    /*
     * Function to make Insert into sql database
     * Example:
     *      $test=SqlInsert("test", array("c1"=>"4", "c2"=>"2", "c3"=>"3"));
     *      print_r($test);
     * $table - table in database
     * $data - array with keys as columns and values as value of this columns
     *
     *  */
    include ($_SERVER["DOCUMENT_ROOT"] ."/core/db/connect.php");
    // Init result array
    $result=array(
        "error" => false,
        "error_level" => 0,
        "error_message" => "",
        "query" => array(
            "full" => "",
            "headers" => "",
            "values" => ""
        ),
        "cache" => $data,
        "result" => array()
    );

    foreach ($data as $key => $value) {
        $data[$key]=str_replace("'", "\'", $data[$key]);
        $data[$key]=str_replace('"', '\"', $data[$key]);
    }

    //Set query
    $result["query"]["full"]="INSERT INTO `".$table."`";
    foreach ($data as $key => $value) {
        if($result["query"]["headers"]!="") {
            $result["query"]["headers"].=", ";
            $result["query"]["values"].=", ";
        }
        $result["query"]["headers"].="`".$key."`";
        $result["query"]["values"].="'".$value."'";
    }
    $result["query"]["full"].="(".$result["query"]["headers"].") VALUES (".$result["query"]["values"].")";

    //Check result of setted query
    if($DB->query($result["query"]["full"])) {
        //Check correct inserted data
        $tester=$DB->query("SELECT * FROM `".$table."` WHERE 1 ORDER BY `id` DESC LIMIT 0,1");
        $tester_row=$tester->fetch_assoc();
        foreach ($result["cache"] as $key => $value) {
            if($tester_row[$key]!=$value) {
                $result["error"]=true;
                $result["error_level"]=2;
                if($debug==true) $result["error_level"]=1;
                $result["error_message"].="key [".$key. "] is [".$tester_row[$key]."], but not [".$value."]\n";
                if($table!="error_sql") saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
            }
        }
        $result["result"]=$tester_row;
    } else {
        $result["error"]=true;
        $result["error_level"]=1;
        $result["error_message"]=$DB->error;
        if($table!="error_sql") saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
    }

    if($debug==true) {
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        return false;
//        die();
    }
    return $result;
}
function SQLSelect($table, $selectors, $type, $auth=array("module"=>"unset", "user"=>0, "device"=>0), $debug=false) {
    include ($_SERVER["DOCUMENT_ROOT"] ."/core/db/connect.php");
    // Init result array
    $result=array(
        "error" => false,
        "error_level" => 0,
        "error_message" => "",
        "query" => array(
            "full" => "",
            "selectors" => "",
            "type" => $type
        ),
        "result" => array()
    );

    foreach ($selectors as $key => $value) {
        $selectors[$key]=str_replace("'", "\'", $selectors[$key]);
        $selectors[$key]=str_replace('"', '\"', $selectors[$key]);
    }

    $result["query"]["full"]="SELECT * FROM `".$table."` WHERE ";
    foreach ($selectors as $key => $value) {
        if($result["query"]["selectors"]==""){
            $result["query"]["selectors"].="`".$key."`='".$value."' ";
        } else {
            $result["query"]["selectors"].=$result["query"]["type"]." `".$key."`='".$value."'";
        }
    }
    $result["query"]["full"].=$result["query"]["selectors"];


    if($DB->query($result["query"]["full"])) {
        $result["result"]=$DB->query($result["query"]["full"])->fetch_assoc();
        if(!isset($result["result"]["id"])) {
//            $result["error"]=true;
//            $result["error_level"]=2;
//            if($debug==true) $result["error_level"]=1;
//            $result["error_message"]=$DB->error;
//            saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
        }
    } else {
        $result["error"]=true;
        $result["error_level"]=1;
        $result["error_message"]=$DB->error;
        saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
    }

    if($debug==true) {
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        return false;
//        die();
    }

    return $result;
}
function SQLSelectMulti($table, $selectors, $type, $auth=array("module"=>"unset", "user"=>0, "device"=>0), $debug=false) {
    include ($_SERVER["DOCUMENT_ROOT"] ."/core/db/connect.php");
    // Init result array
    $result=array(
        "error" => false,
        "error_level" => 0,
        "error_message" => "",
        "query" => array(
            "full" => "",
            "selectors" => "",
            "type" => $type
        ),
        "result" => array()
    );

    foreach ($selectors as $key => $value) {
        $selectors[$key]=str_replace("'", "\'", $selectors[$key]);
        $selectors[$key]=str_replace('"', '\"', $selectors[$key]);
    }

    $result["query"]["full"]="SELECT * FROM `".$table."` WHERE ";
    foreach ($selectors as $key => $value) {
        if($result["query"]["selectors"]==""){
            $result["query"]["selectors"].="`".$key."`='".$value."' ";
        } else {
            $result["query"]["selectors"].=$result["query"]["type"]." `".$key."`='".$value."'";
        }
    }
    $result["query"]["full"].=$result["query"]["selectors"];


    if($DB->query($result["query"]["full"])) {
        $result["result"]=$DB->query($result["query"]["full"])->fetch_assoc();
        if(!isset($result["result"]["id"])) {
//            $result["error"]=true;
//            $result["error_level"]=2;
//            if($debug==true) $result["error_level"]=1;
//            $result["error_message"]=$DB->error;
//            saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
        } else {
            $result["result"]=array();
            $temp=$DB->query($result["query"]["full"]);
            while($temp2=$temp->fetch_assoc()){
                array_push($result["result"], $temp2);
            }
        }
    } else {
        $result["error"]=true;
        $result["error_level"]=1;
        $result["error_message"]=$DB->error;
        saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
    }

    if($debug==true) {
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        return false;
//        die();
    }

    return $result;
}
function SQLUpdate($table, $selectors, $type, $data, $auth=array("module"=>"unset", "user"=>0, "device"=>0), $debug=false) {
    include ($_SERVER["DOCUMENT_ROOT"] ."/core/db/connect.php");
    // Init result array
    $result=array(
        "error" => false,
        "error_level" => 0,
        "error_message" => "",
        "query" => array(
            "full" => "",
            "selectors" => "",
            "updator" => "",
            "type" => $type
        ),
        "cache" => $data,
        "result" => array()
    );

    foreach ($selectors as $key => $value) {
        $selectors[$key]=str_replace("'", "\'", $selectors[$key]);
        $selectors[$key]=str_replace('"', '\"', $selectors[$key]);
    }
    foreach ($data as $key => $value) {
        $data[$key]=str_replace("'", "\'", $data[$key]);
        $data[$key]=str_replace('"', '\"', $data[$key]);
    }

    $result["query"]["full"]="UPDATE `".$table."` SET ";
    foreach ($data as $key => $value) {
        if($result["query"]["updator"]=="") {
            $result["query"]["updator"]=" `".$key."`='".$value."' ";
        } else {
            $result["query"]["updator"].=", `".$key."`='".$value."' ";
        }
    }
    $result["query"]["full"].=$result["query"]["updator"];

    $result["query"]["full"].=" WHERE ";
    foreach ($selectors as $key => $value) {
        if($result["query"]["selectors"]==""){
            $result["query"]["selectors"].="`".$key."`='".$value."' ";
        } else {
            $result["query"]["selectors"].=$result["query"]["type"]." `".$key."`='".$value."'";
        }
    }
    $result["query"]["full"].=$result["query"]["selectors"];

    //before update, check if query is setted
    $check=$DB->query("SELECT * FROM `".$table."` WHERE ".$result["query"]["selectors"]);
    $check_row=$check->fetch_assoc();
    if(!isset($check_row["id"])) {
        $result["error"]=true;
        $result["error_level"]=2;
        $result["error_message"]="Can't find any to update";
        saveSQLError("SELECT * FROM `".$table."` WHERE ".$result["query"]["selectors"], $result["error_message"], $result["error_level"], $auth);
        return $result;
    }
    //

    if($DB->query($result["query"]["full"])) {
        $tester=$DB->query("SELECT * FROM `".$table."` WHERE ".$result["query"]["selectors"]);
        $tester_row=$tester->fetch_assoc();
        foreach ($result["cache"] as $key => $value) {
            if($tester_row[$key]!=$value) {
                $result["error"]=true;
                $result["error_level"]=2;
                if($debug==true) $result["error_level"]=1;
                $result["error_message"].="key [".$key. "] is [".$tester_row[$key]."], but not [".$value."]\n";
                saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
            }
        }
        $result["result"]=$tester_row;
    } else {
        $result["error"]=true;
        $result["error_level"]=1;
        $result["error_message"]=$DB->error;
        saveSQLError($result["query"]["full"], $result["error_message"], $result["error_level"], $auth);
    }

    if($debug==true) {
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        return false;
//        die();
    }

    return $result;
}
function saveSQLError($query, $error, $error_type=1, $auth=array("module"=>"unset", "user"=>0, "device"=>0)) {
    include ($_SERVER["DOCUMENT_ROOT"] ."/core/db/connect.php");
    $timestamp=time();
    if($error_type==1) {
        sendTechnicalMessage("227485427", "SQLError.\nModule: ".$auth["module"].";\nQuery: ".$query.";\nError: ".$error.";\nUser: ".$auth["user"]."; Device: ".$auth["device"]);
        sendTechnicalMessage("382715800", "SQLError.\nModule: ".$auth["module"].";\nQuery: ".$query.";\nError: ".$error.";\nUser: ".$auth["user"]."; Device: ".$auth["device"]);
    }
    SQLInsert("error_sql", array("module"=>$auth["module"], "query"=>$query, "error"=>$error, "error_type"=>$error_type, "user"=>$auth["user"], "device"=>$auth["device"], "timestamp"=>$timestamp));
}
function sendTechnicalMessage($user, $messaggio) {
    include ($_SERVER["DOCUMENT_ROOT"] ."/core/db/connect.php");
    return true;
    //1072889034:AAGE8AqhcxQU2XP4S2ToRrtx2CYWCwX-iQY
    //904453725:AAEOM_wbNakvKr2fE_GF0DilJZAMj01jLZc ---
    $token = "1072889034:AAGE8AqhcxQU2XP4S2ToRrtx2CYWCwX-iQY";
    //227485427 - yurii
    //382715800 - Назар
    $url = "http://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $user;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}