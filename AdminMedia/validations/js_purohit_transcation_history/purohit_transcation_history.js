$(function () 
{
    jQuery.validator.addMethod("amount", function(value, element) {
    var bugfrom = $("#balance").val();
    if(value !="" && bugfrom!=""){
     var bugto = parseInt(value);
        
          bugfrom=parseInt(bugfrom);

        // alert(bugfrom);

      return (bugfrom > bugto);
    }else{
         return false;
    }
    }, "Amount must be less than from balance.");
    
    
    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9\\-]+$/i.test(value);
    }, "* Transaction id accept only letter and Number.");

$("#add_purohit_transction_history").validate({
        onfocusout: false,
        // Specify the validation rules
        ignore: [],
        rules: {
            purohit_id: {
                required : true,          
            },
            transaction_id: {
                required : true, 
                alphanumeric: true,
                minlength: 10,  
                maxlength: 13,           
            },
            time: {
                required : true, 
                // accept: "[a-zA-Z]+" ,         
            },  
            date: {
                required : true, 
                // accept: "[a-zA-Z]+" ,         
            },
            amount:{
                required : true,
                number:true, 
                min:1,
                maxlength: 15,  
                amount:true         
            },
            remark:  {
                 maxlength:300,
            },
     
        },
        // Specify the validation error messages
        messages: {
            purohit_id: {
                required: "* Please select Purohit  .",
            }, 
            transaction_id: {
                required: "* Please enter Transaction id .",
                alphanumeric: "* Transaction id accept only letter and Number.",
                minlength: "* Transaction id should be greater than 10 characters.",
                maxlength: "* Transaction id should be less than 13 characters.",
            },
            time: {
                required: "* Please enter Time .",
            },   
            date: {
                required: "* Please enter Date .",
            }, 
            amount: {
                required: "* Please enter Amount  .",
                number:"* Accept only number",
                min: "*Amount should be greater than 0 .",
                maxlength: "*should be less than 15 digit.",
                // amount:'Only accept letter',
            }, 
             remark: {
                maxlength: "*should be less than 500 characters.",
                // accept: 'Only accept letter',
            },   

        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});