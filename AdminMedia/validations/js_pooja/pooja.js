var baseurl = document.getElementById('baseurl').value;
$(function () 
{

    var images = ($("#fileold").val() == "") ? true : false;
    jQuery.validator.addMethod("fileType", function (val, element) 
    {
        if (val == "") {
            return true;
        }

        var type = element.files[0].type;
        //  alert(type)
//        if (type == 'application/zip' || type =='application/x-zip-compressed')// checks the file more than 1 MB
        if (type.indexOf('jpeg') != -1 || type.indexOf('jpg') != -1 || type.indexOf('png') != -1)// checks the file more than 1 MB
        {
            return true;
        } else {
            return false;
        }
    }, "* Please select jpg, jpeg and png file type only.");

$("#add_pooja").validate({
        onfocusout: false,
        // Specify the validation rules
        ignore: [],
        rules: {
            language: {
                required : true,          
            },
            category: {
                required : true,          
            },
            pooja_name: {
                required : true, 
                accept: "[a-zA-Z]+" ,         
            },
            short_description: {
                required : true, 
                minlength: 10,  
                //maxlength: 1000,  
                // max:500, 

            },
            long_description: {
                required : true,          
            },
            silent_feature: {
                required : true, 
                minlength: 1,  
                maxlength: 1200,         
            },
            pooja_image: {
                required: images,
                accept: "JPG|PNG|JPEG",
            },
        },
        // Specify the validation error messages
        messages: {
            language: {
                required: "* Please select language  .",
            }, 
            category: {
                required: "* Please select category  .",
            },
            pooja_name: {
                required: "* Please enter Pooja Name  .",
                accept: 'Only accept letter',
            }, 
            short_description: {
                required: "* Please enter Short Description  .",
                minlength: "* Short Description should be greater than 10 characters.",
                //maxlength: "* Short Description should be less than 1000 characters.",
            }, 
            long_description: {
                required: "* Please enter Long Description .",
            }, 
            silent_feature: {
                required: "* Please enter Salient Feature  .",
                minlength: "* Salient Feature should be greater than 1 characters.",
                maxlength: "* Salient Feature should be less than 1200 characters.",
                // max: "* Silent Feature should be less than 500 characters.",
            },
            pooja_image: {
                required: "* Select image .",
                accept: "* image type JPG|PNG|JPEG.",
            },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});