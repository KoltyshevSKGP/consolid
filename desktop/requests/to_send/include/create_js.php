<script type="application/javascript">
    jQuery("select[name='company']").change(function () {
        getCompanyLocation(jQuery("select[name='company']").val(), "upload_location");
        getCompanyPeople(jQuery("select[name='company']").val(), "contact_user");
    });
    jQuery("select[name='company_receiver']").change(function () {
        getCompanyLocation(jQuery("select[name='company_receiver']").val(), "download_location");
        getCompanyPeople(jQuery("select[name='company_receiver']").val(), "contact_user_receiver");
    });
    function getCompanyLocation(company, selectName) {
        $.post( "/backend/ajax/desktop/requests/to_send/get_company_locations.php",
            {
                company: company
            }).done(function(data) {
            var tempArray=JSON.parse(data);
            if(tempArray["error"]===true) {
                alert(tempArray["error_code"]);
                return false;
            }
            if(tempArray.view.selectors=="") return false;
            jQuery("select[name='"+selectName+"']").html(tempArray.view.selectors);
        });
    }
    function getCompanyPeople(company, selectName) {
        $.post( "/backend/ajax/desktop/requests/to_send/get_company_people.php",
            {
                company: company
            }).done(function(data) {
            var tempArray=JSON.parse(data);
            if(tempArray["error"]===true) {
                alert(tempArray["error_code"]);
                return false;
            }
            if(tempArray.view.selectors=="") return false;
            jQuery("select[name='"+selectName+"']").html(tempArray.view.selectors);
        });
    }
    jQuery("select[name='documents_back']").change(function () {
        if(jQuery(this).val()=="1") {
            jQuery("input[name='documents_back_details']").parent().css("display", "block");
        }
        if(jQuery(this).val()=="0") {
            jQuery("input[name='documents_back_details']").parent().css("display", "none");
        }
    });
</script>