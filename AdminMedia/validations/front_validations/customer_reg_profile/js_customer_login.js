

$.validator.addMethod("alphabetsnspace2", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
    });

$("#loginfrm").validate({
// Specify the validation rules
    rules: {
	email: {
	    required: true,
	    email: true,
	    alphabetsnspace2: true,
	},
	
	password: {
	    required: true,
	    minlength: 6,
	    maxlength: 20,
	},
	},
    // Specify the validation error messages
    messages: {
	email: {
	    required: "* Please enter email.",
	    email: "* Please enter valid email id.",
	     alphabetsnspace2: "* Please enter valid email id.",
	},
	
	
	password: {
	    required: "* Please enter password",
	    minlength: "* Password must contain minimum 6 and maximum 20 characters.",
	    maxlength: "* Password must contain minimum 6 and maximum 20 characters.",
	},
	},
    submitHandler: function (form) { // <- pass 'form' argument in
	$(".save").attr("disabled", true);
	form.submit(); // <- use 'form' argument here.
    }
});