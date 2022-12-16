<?php
$page_content=array(
//    "custom_directory" => $_SERVER["DOCUMENT_ROOT"].'/custom/'.$wms_settings["code_directory"],
    "scripts" => array(
        "sql","auth","html","form","email","basic"
    )
);
foreach ($page_content["scripts"] as $script) {
//    if(!file_exists($page_content["custom_directory"].'/core/wms_functions/'.$script.'.php')) {
//        include ('wms_functions/'.$script.'.php');
//    } else {
//        include ($page_content["custom_directory"].'/core/wms_functions/'.$script.'.php');
//    }
    include ('basic/'.$script.'.php');
}