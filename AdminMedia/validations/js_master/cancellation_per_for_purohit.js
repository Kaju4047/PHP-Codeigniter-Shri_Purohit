$(function () 
{
$("#add_cancellation_per_for_purohit").validate({

        onfocusout: false,
        // Specify the validation rules
        rules: {
            cancellation_per_for_purohit: {
                required : true,   
                number:true ,
                min: 0,
                max:100       
            },
        },
        // Specify the validation error messages
        messages: {
            cancellation_per_for_purohit:{
                required: "* Please enter Cancellation Charges.",
                number: " accept only number .",
                min: "Please enter a value greater than or equal to 0.",
                max: "Please enter a value less than or equal to 100.",
                //remote: "* This country is already exists."
            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});