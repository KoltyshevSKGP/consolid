<?php
$pageData=array();

$pageData["company"]=array();
$pageData["company_doer"]=array();
$pageData["company_receiver"]=array();
$companyT=$DB->query("SELECT * FROM `company` WHERE 1");
while ($company=$companyT->fetch_assoc()) {
    array_push($pageData["company_receiver"], array("value"=>$company["id"],"text"=>$company["name"]));
    if($_SESSION["role"]==1 || $_SESSION["company_id"]==$company["id"]) array_push($pageData["company"], array("value"=>$company["id"],"text"=>$company["name"]));
    if($company["company_type"]==3) array_push($pageData["company_doer"], array("value"=>$company["id"],"text"=>$company["name"]));
}

$pageData["contact_user"]=array();
$pageData["upload_location"]=array();
$pageData["request_connected"]=array();
$pageData["contact_user_receiver"]=array();
$pageData["download_location"]=array();

$pageData["package_type"]=array();
array_push($pageData["package_type"],
    array("value"=>1,"text"=>"Європалети"),
    array("value"=>2,"text"=>"Короби"));

$pageData["oversized"]=array();
array_push($pageData["oversized"],
    array("value"=>0,"text"=>"Ні"),
    array("value"=>1,"text"=>"Так"));

$pageData["heavy_pallet"]=array();
array_push($pageData["heavy_pallet"],
    array("value"=>0,"text"=>"Ні"),
    array("value"=>1,"text"=>"Так"));

$pageData["car_type"]=array();
array_push($pageData["car_type"],
    array("value"=>1,"text"=>"Тент"),
    array("value"=>2,"text"=>"Реф"),
    array("value"=>3,"text"=>"Целмет"));

$pageData["hydrobort"]=array();
array_push($pageData["hydrobort"],
    array("value"=>0,"text"=>"Ні"),
    array("value"=>1,"text"=>"Так"));

$pageData["payer"]=array();
array_push($pageData["payer"],
    array("value"=>1,"text"=>"Відправник"),
    array("value"=>2,"text"=>"Отримувач"));

$pageData["container_back"]=array();
array_push($pageData["container_back"],
    array("value"=>0,"text"=>"Ні"),
    array("value"=>1,"text"=>"Так"));

$pageData["documents_back"]=array();
array_push($pageData["documents_back"],
    array("value"=>0,"text"=>"Ні"),
    array("value"=>1,"text"=>"Так"));

$pageContent=array();
$pageContent[0]=createFormRow(array(
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "company_doer",
            "name_visual" => "Перевізник",
            "first_option" => "<option value='0'>Оберіть компанію</option>",
            "options" => $pageData["company_doer"],
            "label" => 'Оберіть компанію перевізника, кому адресований запит',
            "value" => 1
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("input", array(
            "name" => "number",
            "name_visual" => "Номер документу",
            "input_type" => "text",
            "placeholder" => "№0001",
            "value" => "",
            "label" => "Введіть внутрішній номер документу",
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "company",
            "name_visual" => "Вантажовідправник",
            "first_option" => "<option value='0'>Оберіть компанію</option>",
            "options" => $pageData["company"],
            "label" => 'Оберіть компанію вантажовідправника чи <a target="_blank" href="/desktop/admin/company/create.php">створіть нову</a>',
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "contact_user",
            "name_visual" => "Контактна особа",
            "first_option" => "<option value='0'>Оберіть користувача</option>",
            "options" => $pageData["contact_user"],
            "label" => 'Оберіть контактну особу чи <a target="_blank" href="/desktop/admin/user/create.php">створіть нову</a>',
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "upload_location",
            "name_visual" => "Місце завантаження",
            "first_option" => "<option value='0'>Оберіть локацію</option>",
            "options" => $pageData["upload_location"],
            "label" => 'Оберіть місце завантаження чи <a target="_blank" href="/desktop/admin/location/create.php">створіть нову</a>',
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "request_connected",
            "name_visual" => "Зв'язаний документ",
            "first_option" => "<option value='0'>Оберіть документ</option>",
            "options" => $pageData["request_connected"],
            "attr" => "disabled",
            "label" => 'Оберіть складський документ чи <a target="_blank" href="/desktop/requests/wh_income/create.php">створіть новий</a>',
        )),
    )),
    createFormItem("hr", array()),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "company_receiver",
            "name_visual" => "Вантажоотримувач",
            "first_option" => "<option value='0'>Оберіть компанію</option>",
            "options" => $pageData["company_receiver"],
            "label" => 'Оберіть компанію вантажоотримувача чи <a target="_blank" href="/desktop/admin/company/create.php">створіть нову</a>',
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "contact_user_receiver",
            "name_visual" => "Контактна особа",
            "first_option" => "<option value='0'>Оберіть користувача</option>",
            "options" => $pageData["contact_user_receiver"],
            "label" => 'Оберіть контактну особу чи <a target="_blank" href="/desktop/admin/user/create.php">створіть нову</a>',
        )),
    )),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "download_location",
            "name_visual" => "Місце розвантаження",
            "first_option" => "<option value='0'>Оберіть локацію</option>",
            "options" => $pageData["download_location"],
            "label" => 'Оберіть місце завантаження чи <a target="_blank" href="/desktop/admin/location/create.php">створіть нову</a>',
        )),
    )),
));
$pageContent[1]=createFormRow(array(
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("input", array(
            "name" => "cargo_type",
            "name_visual" => "Тип вантажу",
            "input_type" => "text",
            "placeholder" => "Продукти харчування",
            "value" => "",
            "label" => "",
        )),
        createFormItem("select2", array(
            "name" => "packing_type",
            "name_visual" => "Тип пакування вантажу",
            "first_option" => "<option value='0'>Оберіть тип</option>",
            "options" => $pageData["package_type"],
            "label" => '',
        )),
        createFormItem("input2", array(
            "name" => "cargo_amount",
            "name_visual" => "К-сть вантажу",
            "input_type" => "text",
            "placeholder" => "000",
            "value" => "",
            "value_type" => "ПАЛ/М3",
            "label" => "",
        )),
    ), '<h5>Вантаж</h5>'),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("input2", array(
            "name" => "cargo_weight",
            "name_visual" => "Вага брутто",
            "input_type" => "text",
            "placeholder" => "000",
            "value" => "",
            "value_type" => "КГ",
            "label" => "",
        )),
        createFormItem("select2", array(
            "name" => "oversized",
            "name_visual" => "Великогабаритний",
            "first_option" => "",
            "options" => $pageData["oversized"],
            "label" => '',
        )),
        createFormItem("select2", array(
            "name" => "heavy_pallet",
            "name_visual" => "Навантажені палети",
            "first_option" => "",
            "options" => $pageData["heavy_pallet"],
            "label" => 'Наявність палет з вагою брутто більше 650кг',
        )),
    ), '<h5>&nbsp;</h5>'),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("select2", array(
            "name" => "car_type",
            "name_visual" => "Тип автомобіля",
            "first_option" => '<option value="0">Оберіть тип</option>',
            "options" => $pageData["car_type"],
            "label" => '',
        )),
        createFormItem("input2", array(
            "name" => "car_height",
            "name_visual" => "Висота кузову",
            "input_type" => "text",
            "placeholder" => "000",
            "value" => "",
            "value_type" => "СМ",
            "label" => "",
        )),
        createFormItem("input2_twice", array(
            "name1" => "temp_from",
            "name_visual1" => "Температурний режим",
            "input_type1" => "text",
            "placeholder1" => "від",
            "value1" => "",
            "value_type1" => "С",
            "name2" => "temp_to",
            "name_visual2" => "&nbsp;",
            "input_type2" => "text",
            "placeholder2" => "до",
            "value2" => "",
            "value_type2" => "С",
        )),
        createFormItem("select2", array(
            "name" => "hydrobort",
            "name_visual" => "Наявність гідроборту",
            "first_option" => '',
            "options" => $pageData["hydrobort"],
            "label" => 'Оберіть вимогу до наявності гідроборту',
        )),
    ), '<h5>Транспорт</h5>'),
));
$pageContent[2]=createFormRow(array(
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("input", array(
            "name" => "date_ready",
            "name_visual" => "Дата готовності",
            "input_type" => "text",
            "placeholder" => "дд.мм.рррр",
            "value" => date("d.m.Y", time()+24*3600),
            "label" => "Введіть дату готовності вантажу",
        )),
        createFormItem("input_twice", array(
            "name1" => "date_upload_from",
            "name_visual1" => "Дата відвантаження",
            "input_type1" => "text",
            "placeholder1" => "дд.мм.рррр",
            "value1" => date("d.m.Y", time()+24*3600),
            "name2" => "date_upload_to",
            "name_visual2" => "&nbsp;",
            "input_type2" => "text",
            "placeholder2" => "дд.мм.рррр",
            "value2" => date("d.m.Y", time()+24*3600),
        )),
        createFormItem("input_twice", array(
            "name1" => "time_upload_from",
            "name_visual1" => "Години відвантаження",
            "input_type1" => "text",
            "placeholder1" => "00:00",
            "value1" => "",
            "name2" => "time_upload_to",
            "name_visual2" => "&nbsp;",
            "input_type2" => "text",
            "placeholder2" => "00:00",
            "value2" => "",
        )),
        createFormItem("input_twice", array(
            "name1" => "break_upload_from",
            "name_visual1" => "Обід (при наявності)",
            "input_type1" => "text",
            "placeholder1" => "00:00",
            "value1" => "",
            "name2" => "break_upload_to",
            "name_visual2" => "&nbsp;",
            "input_type2" => "text",
            "placeholder2" => "00:00",
            "value2" => "",
        )),

    ), '<h5>Завантаження</h5>'),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("input", array(
            "name" => "date_download",
            "name_visual" => "Дата розвантаження",
            "input_type" => "text",
            "placeholder" => "дд.мм.рррр",
            "value" => date("d.m.Y", time()+2*24*3600),
            "label" => "Введіть дату готовності вантажу",
        )),
        createFormItem("input_twice", array(
            "name1" => "time_download_from",
            "name_visual1" => "Години розвантаження",
            "input_type1" => "text",
            "placeholder1" => "00:00",
            "value1" => "",
            "name2" => "time_download_to",
            "name_visual2" => "&nbsp;",
            "input_type2" => "text",
            "placeholder2" => "00:00",
            "value2" => "",
        )),
        createFormItem("input_twice", array(
            "name1" => "break_download_from",
            "name_visual1" => "Обід (при наявності)",
            "input_type1" => "text",
            "placeholder1" => "00:00",
            "value1" => "",
            "name2" => "break_download_to",
            "name_visual2" => "&nbsp;",
            "input_type2" => "text",
            "placeholder2" => "00:00",
            "value2" => "",
        )),

    ), '<h5>Розвантаження</h5>'),
    createFormBlock("col-xl-4 col-md-6 col-12", array(
        createFormItem("input2", array(
            "name" => "cargo_price",
            "name_visual" => "Оціночна вартість вантажу",
            "input_type" => "text",
            "placeholder" => "000.00",
            "value" => "",
            "value_type" => "ГРН з ПДВ",
            "label" => "",
        )),
        createFormItem("select2", array(
            "name" => "payer",
            "name_visual" => "Платник",
            "first_option" => '',
            "options" => $pageData["payer"],
            "label" => 'Оберіть платника за послуги доставки',
        )),
        createFormItem("select2", array(
            "name" => "container_back",
            "name_visual" => "Повернення піддонів",
            "first_option" => '',
            "options" => $pageData["container_back"],
            "label" => 'Оберіть вимогу до повернення піддонів',
        )),
        createFormItem("select2", array(
            "name" => "documents_back",
            "name_visual" => "Повернення документів",
            "first_option" => '',
            "options" => $pageData["documents_back"],
            "label" => 'Оберіть вимогу до повернення документів',
        )),
        createFormItem("input", array(
            "name" => "documents_back_details",
            "name_visual" => "Деталі по документації",
            "input_type" => "text",
            "placeholder" => "ТТН та Видаткова накладна",
            "value" => "",
            "label" => "Введіть тип документів на повернення",
            "style" => "display: none;",
        )),
        createFormItem("input", array(
            "name" => "comment",
            "name_visual" => "Коментар по умовах",
            "input_type" => "text",
            "placeholder" => "",
            "value" => "",
            "label" => "Введіть коментар по умовах доставки",
        )),
    ), '<h5>Умови доставки</h5>'),
));
