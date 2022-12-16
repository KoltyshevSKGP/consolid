<?php
include ($_SERVER["DOCUMENT_ROOT"]."/core/db/connect.php");

$page_content=array(
    "scripts" => array(
        "basic"
    )
);

foreach ($page_content["scripts"] as $script) {
    include (''.$script.'.php');
}