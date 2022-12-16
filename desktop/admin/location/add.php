<?php
$settingsPage=array(
    "main_title" => "Локації",
    "title" => "Локації компанії",
    "navigation_array" => array(
        "Головна" => "/",
        "Локації компанії" => "/desktop/admin/location",
        "Створення локації" => ""
    )
);

include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/head.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/menu.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-start.php");
?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Створення локації</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="name">Назва локації</label>
                                <input type="text" id="name" class="form-control" placeholder="Склад Львів-1">
                                <p><small class="text-muted">Робоча назва локації</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="address">Адреса локації</label>
                                <input type="text" id="address" class="form-control" placeholder="м...">
                                <p><small class="text-muted">Місто/смт/село, вулиця, номер будинку</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="maps_link">Посилання на мапу</label>
                                <input type="text" id="maps_link" class="form-control" placeholder="https://maps.google.com/">
                                <p><small class="text-muted">Посилання на мапу з локацією</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label class="form-label" for="type">Тип локації</label>
                            <select class="select2 form-select" id="type">
                                <option value="1">Складський об'єкт</option>
                                <option value="2">Приватний будинок</option>
                            </select>
                            <p><small class="text-muted">Тип локації компанії</small></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="contact_person">Контактна особа</label>
                                <input type="text" id="contact_person" class="form-control" placeholder="ПІБ">
                                <p><small class="text-muted">ПІБ контактної особи</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="contact_phone">Контактний номер</label>
                                <input type="text" id="contact_phone" class="form-control" placeholder="+380">
                                <p><small class="text-muted">Контактний номер телефону на локації</small></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="schedule">Графік роботи</label>
                                <input type="text" id="schedule" class="form-control" placeholder="Пн-Пт 09-18">
                                <p><small class="text-muted">Графік роботи локації</small></p>
                            </div>
                        </div>
                    </div>
                    <a style="width: 100%" class="btn btn-success btn-sm waves-effect waves-float waves-light" id="submitForm">Створити</a><br><br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/content-finish.php");
include($_SERVER["DOCUMENT_ROOT"] . "/include/desktop/layout/footer.php");
?>
<script type="application/javascript">
    jQuery("#submitForm").click(function () {
        var parseData={
            name:jQuery("#name").val(),
            address:jQuery("#address").val(),
            maps_link:jQuery("#maps_link").val(),
            type:jQuery("#type").val(),
            contact_person:jQuery("#contact_person").val(),
            contact_phone:jQuery("#contact_phone").val(),
            schedule:jQuery("#schedule").val(),
        };
        // if(parseData.name=="")
        $.ajax({
            type: "POST",
            url: "/backend/ajax/desktop/admin/location/add.php",
            data: parseData,
            success:function(response){
                console.log(response);
                if (response.status != 200) return false;
                var resultArray = JSON.parse(response);
                console.log(resultArray);
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
        // $.post( "/backend/ajax/desktop/admin/location/add.php", {
        //     test:1,
        // }).complete(function(data) {
        //     console.log(data.responseText);
        //     if (data.status != 200) return false;
        //     var resultArray = JSON.parse(data.responseText);
        //     console.log(resultArray);
        // });
    });
</script>
