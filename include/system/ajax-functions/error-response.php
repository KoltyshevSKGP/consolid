<?php
$result["error"]=true;
$result["data"]=$result_data;
$result["view"]=$result_view;
echo json_encode($result);
mysqli_close($conn);
die();