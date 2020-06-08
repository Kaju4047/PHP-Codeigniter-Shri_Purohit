

$("#filterFrm").validate({
// Specify the validation rules
    rules: {
	cityid: {
	    required: true,
	},
	
	language: {
	    required: true,
	 
	},
	},
    // Specify the validation error messages
    messages: {
	cityid: {
	    required: "* Please select city.",
	  
	},
	
	language: {
	    required: "* Please select language.",

	},
	},
    submitHandler: function (form) { // <- pass 'form' argument in
	$(".save").attr("disabled", true);
	form.submit(); // <- use 'form' argument here.
    }
});


	
/*Start::get category services through ajax*/
setSelectedTestPlan();

function setSelectedTestPlan(e1)
	{
        $(e1).closest('ul').find('li.active').removeClass('active');
		$(e1).closest('li').addClass('active');
  			var cat_id=$(e1).data('id');
			
			var city=$("#get_cityid").val();
			var language=$("#get_languageid").val();
			var base_url = $("#base_url").val();
			if (cat_id == undefined) {
				var catid=$("#get_catid").val();
			}else{
				var catid=cat_id;

			}
			
            $.ajax({
                type: "get",
                data: {catid:catid,city:city,language:language},
                url: base_url + "front-get-cat-puja-list",
                dataType: 'json',
                success: function (data)
                {

				if (data.length > 0) {
			    var productTableHTML = '';
			    $.each(data, function (key,value) {
			    	// alert(JSON.stringify(value.pk_id));
			    	var curenturl=$(location).attr('href');
			    	var encoded_url = btoa(curenturl);
			    	var view_url = 'front-services-view/'+value.pk_id+'/description?redirect='+encoded_url;
			    	//var view_url = 'front-services-view/'+value.pk_id;
			    	// alert(view_url);
			    	var image_url=base_url + 'upload/admin/pooja/'+ value.pooja_image;
			    	// alert(image_url);
			      	productTableHTML +='<div class="col-lg-3 col-sm-4 col-12">';
			      	productTableHTML +='<a href="'+view_url+'">';
                	productTableHTML +='<div class="hs_shop_prodt_main_box">';
                    productTableHTML +='<div class="hs_shop_prodt_img_wrapper">';
                    productTableHTML +='<img src="'+image_url+'" alt="shop_product">';
                    productTableHTML +='</div>';
					productTableHTML +='<div class="hs_shop_prodt_img_cont_wrapper">';
                    productTableHTML +='<h6>'+value.pooja_name+'</h6>';
                    productTableHTML +='</div>';
                	productTableHTML +='</div>';
                	productTableHTML +='</a>';     
			    	productTableHTML += ' </div>';
			    	});
			    	// alert(productTableHTML);
			    $("#products_list").html(productTableHTML);
			  }

                }

            });       
      
};
/*End::get category services through ajax*/