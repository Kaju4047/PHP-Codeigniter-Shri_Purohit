var baseurl = document.getElementById('baseurl').value;
$(function () 
{
$("#add_category").validate({
        onfocusout: false,
        // Specify the validation rules
        rules: {
            language: {
                required : true,          
            },
            category: {
                required : true,
                maxlength:25,
                accept: "[a-zA-Z]+" ,
                remote: {
                    url: baseurl+"admin/master/Cn_master/checkCategory",
                    type: "post",
                    data: {
                        language: function(){ return $("#language").val(); },
                        category: function(){ return $("#category").val(); },
                        pk_id: function(){ return $("#txtid").val(); },
                    }
                },
            },
        },
        // Specify the validation error messages
        messages: {
            language: {
                required: "* Please select language  .",
                // remote: "* This country is already exists."
            },
            category: {
                 required: "* Please enter category   .",
                 maxlength: '* Please enter max 25 characters.',
                 remote: "* This category is already exists.",
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