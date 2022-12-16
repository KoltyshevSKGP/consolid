<?php
$pageData=array();

$pageData["ttn_reason"]=array();
array_push($pageData["ttn_reason"],
    array("value"=>1,"text"=>"Запит на доставку"));

$pageData["company_doer"]=array();
$companyT=$DB->query("SELECT * FROM `company` WHERE `company_type`=3");
while ($company=$companyT->fetch_assoc()) {
    array_push($pageData["company_doer"], array("value"=>$company["id"],"text"=>$company["name"]));
}

$pageData["driver"]=array();
$userT=$DB->query("SELECT * FROM `user` WHERE `role`=5");
while ($user=$userT->fetch_assoc()) {
//    if($_SESSION["role"]!=1 && $user["company"]!=$_SESSION["company_id"]) continue;
    array_push($pageData["driver"], array("value"=>$user["id"],"text"=>$user["surname"]." ".$user["name"]));
}
$pageData["request_connected"]=array();
$requestT=$DB->query("SELECT * FROM `request_transport` WHERE `type`=1 AND `status`=3 AND `company_doer`='".$_SESSION["company_id"]."'");
while ($request=$requestT->fetch_assoc()) {
    array_push($pageData["request_connected"], array("value"=>$request["id"],"text"=>"ID".$request["id"]." від ".date("d.m.Y", $request["created"])));
}

//transport
$pageData["transport"]=array();
$transportT=$DB->query("SELECT * FROM `transport` WHERE `is_active`=1 AND `company`='".$_SESSION["company_id"]."'");
while ($transport=$transportT->fetch_assoc()) {
    array_push($pageData["transport"], array("value"=>$transport["id"],"text"=>$transport["license_plate"]));
}

$pageContent=array();
$pageContent[0]=createFormRow(array(
    createFormBlock("col-xl-3 col-md-4 col-12", array(
        createFormItem("select2", array(
            "name" => "ttn_reason",
            "name_visual" => "Підстава для ТТН",
            "first_option" => "",
            "options" => $pageData["ttn_reason"],
            "label" => 'Оберіть підставу для формування ТТН',
        )),
    )),
    createFormBlock("col-xl-3 col-md-4 col-12", array(
        createFormItem("select2", array(
            "name" => "request_connected",
            "name_visual" => "Запит на доставку",
            "first_option" => "<option value='0'>Оберіть документ</option>",
            "options" => $pageData["request_connected"],
            "label" => 'Оберіть запит на доставку',
            "value" => $_GET["request_connected"]
        )),
    )),
    createFormBlock("col-xl-3 col-md-4 col-12", array(
        createFormItem("input", array(
            "name" => "doc_date",
            "name_visual" => "Дата ТТН",
            "input_type" => "text",
            "placeholder" => "дд.мм.рррр",
            "value" => date("d.m.Y", time()),
            "label" => "Введіть дату ТТН",
        )),
    )),
    createFormBlock("col-xl-3 col-md-4 col-12", array(
        createFormItem("select2", array(
            "name" => "company_doer",
            "name_visual" => "Перевізник",
            "first_option" => "<option value='0'>Оберіть компанію</option>",
            "options" => $pageData["company_doer"],
            "label" => 'Оберіть компанію перевізника',
        )),
    )),
    createFormItem("hr", array()),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "transport",
            "name_visual" => "Транспортний засіб",
            "first_option" => "<option value='0'>Оберіть транспорт</option>",
            "options" => $pageData["transport"],
            "label" => 'Оберіть транспортний засіб чи <a target="_blank" href="/desktop/admin/transport/create.php">створіть новий</a>',
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "transport_add",
            "name_visual" => "Причіп",
            "first_option" => "<option value='0'>Оберіть обладнання</option>",
            "options" => $pageData["transport_add"],
            "attr" => "disabled",
            "label" => 'Оберіть причіп чи <a target="_blank" href="#">створіть новий</a>',
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "driver",
            "name_visual" => "Водій",
            "first_option" => "<option value='0'>Оберіть користувача</option>",
            "options" => $pageData["driver"],
            "label" => 'Оберіть водія чи <a target="_blank" href="/desktop/admin/user/create.php">створіть нового</a>',
        )),
    )),
));