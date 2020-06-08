$(function () 
{
$("#add_tax").validate({

        onfocusout: false,
        // Specify the validation rules
        rules: {
            central_tax: {
                required : true,   
                number:true ,   
                min: 0,
                max:100   
            },
            state_tax: {
                required : true,   
                number:true ,   
                min: 0,
                max:100   
            },
        },
        // Specify the validation error messages
        messages: {
            central_tax: {
                required: "* Please enter Central tax   .",
                number: " accept only number .",
                 min: "Please enter a value greater than or equal to 0.",
                max: "Please enter a value less than or equal to 100.",
            },
            state_tax: {
                required: "* Please enter State tax   .",
                number: " accept only number .",
                 min: "Please enter a value greater than or equal to 0.",
                max: "Please enter a value less than or equal to 100.",
            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});