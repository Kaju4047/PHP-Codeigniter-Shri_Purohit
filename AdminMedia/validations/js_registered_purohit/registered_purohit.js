



var baseurl = document.getElementById('baseurl').value;
$(function () 
{

jQuery.validator.addMethod(
        "validDOB",
        function(value, element) {              
            var from = value.split("-"); // DD MM YYYY
            // var from = value.split("/"); // DD/MM/YYYY
            var day = from[0];
            var month = from[1];
            var year = from[2];
            var age = 18;

            var mydate = new Date();
            mydate.setFullYear(year, month-1, day);

            var currdate = new Date();
            var setDate = new Date();

            setDate.setFullYear(mydate.getFullYear() + age, month-1, day);

            if ((currdate - setDate) > 0){
                return true;
            }else{
                return false;
            }
        },
        "Sorry, you must be 18 years of age to apply"
    );


    var images = ($("#profile_fileold").val() == "") ? true : false;
    var doc = ($("#doc_fileold").val() == "") ? true : false;
    jQuery.validator.addMethod("profile", function (val, element) 
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


    $.validator.addMethod("ifsc", function(value, element){
        var reg = /^[A-Za-z]{4}[0-9]{6,7}$/;
        if (this.optional(element)) {
          console.log(value);
          console.log(element);
          return true;
        }
        if (value.match(reg)) {
          return true;
        } else {
          return false;
        }
    }, "Please enter a valid IFSC CODE");

$("#add_registered_purohit").validate({
        onfocusout: false,
        // Specify the validation rules
        rules: {
            first_name: {
                required : true, 
                maxlength: 25 ,
                accept: "[a-zA-Z]+" ,        
            },
            middle_name: {
                maxlength: 25,
                accept: "[a-zA-Z]+" ,                  
            },
             last_name: {
                required : true, 
                maxlength: 25,
                accept: "[a-zA-Z]+" ,          
            },
            pooja_name: {
                required : true, 
                maxlength: 25          
            },
            mobile_no: {
                required : true,          
                minlength: 10,          
                maxlength: 13         
            },
            alter_mobile_no: {  
                minlength: 10,          
                maxlength: 13         
            },
            email_id: {
                required : true,
                email: true,          
            },
            dob: {
                required : true,
                validDOB : true          
            },
            address: {
                required : true,  
                 maxlength: 200          
            },
            state: {
                required : true,          
            },
            city: {
                required : true,          
            },
            area: {
                // required : true,   
                maxlength: 25      
            },
            gurukul_name: {
                required : true, 
                maxlength: 50 ,
                accept: "[a-zA-Z]+" ,          
            },
            experience: {
                required : true,     
                number :true,     
            },
            'language[]': {
                required : true,          
            },
            bank_name: {
                required : true,    
                maxlength: 50 ,
                accept: "[a-zA-Z]+" ,        
            },
            ifsc_code: {
                required : true, 
                ifsc: true         
            },
            branch_name: {
                required : true,
                maxlength: 50 ,
                accept: "[a-zA-Z]+" ,            
            },
            holder_name: {
                required : true, 
                maxlength: 50 ,
                accept: "[a-zA-Z]+" ,            
            },
            account_number: {
                required : true,
                number : true,
                minlength: 9,          
                maxlength: 18           
            },
            // certificate_image:{
            //     required: doc,
            //     // fileType: "JPG|PNG|JPEG",
            // },
            profile_image:{
                required: images,
                profile: "JPG|PNG|JPEG|jpg|png|jpeg", 
            },            
        },
        // Specify the validation error messages
        messages: {
            first_name: {
                required: "* Please enter First Name  .",
                maxlength: "First Name should be less than 25 character  .",
                accept: 'Only accept letter',
            }, 
            middle_name: {
                maxlength: "Middle Name should be less than 25 character  .",
                accept: 'Only accept letter',
            },
            last_name: {
                required: "* Please enter Last Name  .",
                maxlength: "Last Name should be less than 25 character  .",
                accept: 'Only accept letter',
            }, 
            mobile_no: {
                required: "* Please enter Mobile Number  .",
                minlength: "Mobile Number should be more than 10 character  .",
                maxlength: "Mobile Number should be less than 13 character  .",
            }, 
            alter_mobile_no: {
                minlength: "Alert Mobile Number should be more than 10 character  .",
                maxlength: "Alter Mobile Number should be less than 13 character  .",
            }, 
            email_id: {
                required: "* Please enter Email Id  .",
                email: "Enter valid Email"
            },
            dob: {
                required: "* Please enter dob.",
                // required: "* Select image .",
                // accept: "* image type JPG|PNG|JPEG.",
            },
            address: {
                required: "* Please enter address .",
                  maxlength: "Address should be less than 200 character  .",
            }, 
            state: {
                required: "* Please enter State .",
            }, 
            city: {
                required: "* Please enter City .",
            }, 
            area: {
                // required: "* Please enter Silent Feature  .",
                  maxlength: "Area should be less than 25 character  .",
            }, 
            gurukul_name: {
                required: "* Please enter Gurukul Name  .",
                maxlength: "* Gurukul Name should be less than 50 character  .",
                 accept: 'Only accept letter',
            }, 
            experience: {
                required: "* Please enter Experience  .",
                number: "* Accept only number  .",
            }, 
            'language[]': {
                required: "* Please select Language   .",
            }, 
            bank_name: {
                required: "* Please enter Bank Name  .",
                maxlength: "* Bank Name should be less than 50 character  .",
                accept: 'Only accept letter',

            }, 
            ifsc_code: {
                required: "* Please enter IFSC code .",
            }, 
            branch_name: {
                required: "* Please enter Branch Name  .",
                maxlength: "Branch Name should be less than 50 character  .",
                accept: 'Only accept letter',
            }, 
            holder_name: {
                required: "* Please enter Holder Name  .",
                maxlength: "Holder Name should be less than 50 character  .",
                 accept: 'Only accept letter',
            }, 
            account_number: {
                required: "* Please enter Account Number  .",
                number: "* Accept only Number  .",
                minlength: "Account Number should be more than 9 numbers  .",
                maxlength: "Account Number should be less than 18 numbers  .",
            }, 
            profile_image:{
                required: "* Select profile .",
            }                
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $("#submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});