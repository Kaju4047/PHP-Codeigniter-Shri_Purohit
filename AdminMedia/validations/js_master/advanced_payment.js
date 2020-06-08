$(function () 
{
$("#advance_payment").validate({
   
        onfocusout: false,
        // Specify the validation rules
        rules: {
            advanced_payment: {
                required : true,   
                number:true,
                min: 0,
                max:100       
            },
        },
        // Specify the validation error messages
        messages: {
            state: {
                advanced_payment: "* Please enter Advanced payment   .",
                number: " accept only number .",
                min: "Value must be greater than 0",
                max: "Value must be less than 100", 

                // remote: "* This country is already exists."
            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});