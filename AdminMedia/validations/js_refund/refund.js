$(function () 
{
$("#add_refund").validate({
        onfocusout: false,
        rules: {
             transaction_id: {
                required : true, 
                minlength: 10,  
                maxlength: 13,           
            },
            date: {
                required : true,
 
            },
            time: {
                required : true,
            },
            remark: {
                // required : true,
                maxlength:500,

            },
        },
        // Specify the validation error messages
        messages: {
           transaction_id: {
                required: "* Please enter transaction id .",
                minlength: "* Short Description should be greater than 10 characters.",
                maxlength: "* Short Description should be less than 13 characters.",
            },
            date: {
                 required: "* Please enter date   .",
            },
            time: {
                 required: "* Please enter time   .",

            },
            remark: {
                 // required: "* Please enter charges   .",
                 maxlength: '* Please enter max 500 characters.',
            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});