var baseurl = document.getElementById('baseurl').value;
$(function () 
{
$("#add_state").validate({
        onfocusout: false,
        // Specify the validation rules
        rules: {
            state: {
                required : true,
                maxlength:25,
                accept: "[a-zA-Z]+" ,
                remote: {
                    url: baseurl+"admin/master/Cn_master/checkstate",
                    type: "post",
                    data: {
                        state: function(){ return $("#state").val(); },
                        pk_id: function(){ return $("#txtid").val(); },
                    }
                },
            },
        },
        // Specify the validation error messages
        messages: {
            
            state: {
                 required: "* Please enter state   .",
                 maxlength: '* Please enter max 25 characters.',
                 remote: "* This state is already exists.",
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