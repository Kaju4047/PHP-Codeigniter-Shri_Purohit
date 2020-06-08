var baseurl = document.getElementById('baseurl').value;
$(function () 
{
$("#add_citywise_language").validate({
        onfocusout: false,
        // Specify the validation rules
        rules: {
            city: {
                required : true,          
            },
            language: {
                required : true,
                maxlength:25,
                remote: {
                    url: baseurl+"admin/master/Cn_master/checkCitywiseLanguage",
                    type: "post",
                    data: {
                        city: function(){ return $("#city").val(); },
                        language: function(){ return $("#language").val(); },
                        pk_id: function(){ return $("#txtid").val(); },
                    }
                },
            },
        },
        // Specify the validation error messages
        messages: {
            city: {
                required: "* Please select city  .",
                // remote: "* This country is already exists."
            },
            language: {
                 required: "* Please select language   .",
                 maxlength: '* Please enter max 25 characters.',
                 remote: "* This language is already exists.",

            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});