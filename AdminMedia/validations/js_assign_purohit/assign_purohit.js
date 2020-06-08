
$(function () 
{
$("#assign_purohit_form").validate({

        onfocusout: false,
        // Specify the validation rules
        ignore: [],
        rules: {
            assign_purohit: {
                required : true,          
            },           
        },
        // Specify the validation error messages
        messages: {
            assign_purohit: {
                required: "* Please select purohit  .",
            },           
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});