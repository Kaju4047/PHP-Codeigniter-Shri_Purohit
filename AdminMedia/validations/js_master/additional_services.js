var baseurl = document.getElementById('baseurl').value;
$(function () 
{
$("#add_additinal_service").validate({
        onfocusout: false,
        // Specify the validation rules
        rules: {
            service_name: {
                required : true,          
                remote: {
                    url: baseurl+"admin/master/Cn_master/checkServices",
                    type: "post",
                    data: {
                        service_name: function(){ return $("#service_name").val(); },
                        // charges: function(){ return $("#charges").val(); },
                        pk_id: function(){ return $("#txtid").val(); },
                    }
                },
            },
            charges: {
                required : true,
                maxlength:7,
                number:true,
            },
        },
        // Specify the validation error messages
        messages: {
            service_name: {
                required: "* Please enter Service Name  .",
                 remote: "* This service is already exists.",
                // remote: "* This country is already exists."
            },
            charges: {
                 required: "* Please enter charges   .",
                 maxlength: '* Please enter max 7 number.',
                 number: 'Only accept number',

            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});