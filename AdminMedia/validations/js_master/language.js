var baseurl = document.getElementById('baseurl').value;
$(function () 
{
$("#add_language").validate({
        onfocusout: false,
        // Specify the validation rules
        rules: {         
            language: {
                required : true,
                maxlength:25,
                accept: "[a-zA-Z]+" ,
                remote: {
                    url: baseurl+"admin/master/Cn_master/checkLanguage",
                    type: "post",
                    data: {
                        language: function(){ return $("#language").val(); },
                        pk_id: function(){ return $("#txtid").val(); },
                    }
                },
            },
        },
        // Specify the validation error messages
        messages: {
            language: {
                 required: "* Please enter language   .",
                 maxlength: '* Please enter max 25 characters.',
                 remote: "* This language is already exists.",
                 accept: 'Only accept letter',

            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});