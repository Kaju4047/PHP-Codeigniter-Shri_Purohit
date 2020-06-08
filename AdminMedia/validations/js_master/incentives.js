$(function () 
{
$("#add_incentives").validate({

        onfocusout: false,
        // Specify the validation rules
        rules: {
            incentive: {
                required : true,   
                number:true,
                min: 0,
                max:100
                  
            },
        },
        // Specify the validation error messages
        messages: {
            incentive: {
                required: "* Please enter Incentive   .",
                number: " accept only number .",
                min: "Please enter a value greater than or equal to 0.",
                max: "Please enter a value less than or equal to 100.",

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