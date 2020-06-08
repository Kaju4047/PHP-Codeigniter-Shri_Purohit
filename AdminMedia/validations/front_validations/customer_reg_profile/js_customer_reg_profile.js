var imgFlag = ($("#oldimg1").val() != "") ? false : true;
$("#customerfrm").validate({
// Specify the validation rules

// onfocusout: true,

 // ignore: [],
        rules: {
            name: {
                required: true,
                minlength:2,
                },  

           
            mobileno: {
               required: true,
                minlength: 10,
                maxlength: 13,
                number: true,
            },
            email: {
                required: true,
               email:true,
           

            },
   
        //  city: {
        //         required: true,
        //         minlength:2,
        //         },   
        // event_city: {
        //         required: true,
        //         minlength:2,
        //         },  
        pincode: {
                // required: true,
                minlength:6,
                maxlength:6,
                },
        uploadphoto:{
        // required:imgFlag,
        accept:"jpeg|jpg|png",
         }, 
          password: {
                required: true,
                minlength: 6,
                maxlength: 20,
            },
        cnfirm_password: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#password",
            },
   
        },
        // Specify the validation error messages
        messages: {
            name: {
                required: "* Please enter name.",
                minlength: "* Please enter valid name.",
            },   
            
          
            mobileno: {
                required: "* Please enter mobile no.",
               minlength: "* Mobile number must be 10 to 13 digits only.",
               maxlength: "* Mobile number must be 10 to 13 digits only.",
               
                number: "* Enter only number.",
            },
             email: {
                required: "* Please enter email id.",
               	email: "* Please enter valid email id.",
                 // remote: '* Email id already exists.',
            },
            location: {
                required: "* Please enter location.",
                minlength: "* Please enter valid location.",
            },    
            // city: {
            //     required: "* Please enter address.",
            //     minlength: "* Please enter address.",
            // }, 
            //   event_city: {
            //     required: "* Please enter city.",
            //     minlength: "* Please enter valid city.",
            // },
            pincode: {
                // required: "* Please enter pincode.",
                minlength: "* Please enter valid pincode.",
                minlength: "* Please enter valid pincode.",
            },
        uploadphoto:{
        // required:" * Upload profile.",
        accept:"* Upload JPEG, JPG and PNG file only.",
      }, 
           
            password: {
                required: "* Please enter password",
                minlength: "* Password must contain minimum 6 and maximum 20 characters.",
                 maxlength: "* Password must contain minimum 6 and maximum 20 characters.",
             },
            cnfirm_password: {
                required: "* Please enter confirm password.",
                minlength: "* Confirm password must contain minimum 6 and maximum 20 characters.",
                maxlength: "* Confirm password must contain minimum 6 and maximum 20 characters.",
                equalTo: "* Password and re-type password does not match."
             },
        },
        submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });