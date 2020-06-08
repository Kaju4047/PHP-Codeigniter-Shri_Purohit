$(function () 
{
$("#add_fine_for_purohit").validate({

        onfocusout: false,
        // Specify the validation rules
        rules: {
            fine_for_purohit: {
                required : true,   
                number:true ,
                maxlength:12
                //min:0
            },
        },
        // Specify the validation error messages
        messages: {
            fine_for_purohit:{
                required: "* Please enter Fine For Purohit.",
                number: " accept only number .",
                maxlength: "Please enter a value less than or equal to 12 digit."
                //min: "Enter greater than 0",
            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});