$(document).ready(function() {
      var i=0;
     $(".services").each(function(){
      $(this).attr("name","services_"+i);
      $(this).attr("id","services_"+i);
      i++;
     });

     var i=0;
     $(".package_charges").each(function(){
        $(this).attr("name","package_charges_"+i);
        $(this).attr("id","package_charges_"+i);
        i++;
     });

      var i=0;
     $(".charges_to_show_purohit").each(function(){
        $(this).attr("name","charges_to_show_purohit_"+i);
        $(this).attr("id","charges_to_show_purohit_"+i);
        i++;
     });
});

$("#add-more").click(function(){
    var adm_services=$("#adm_services").val();
      adm_services=parseInt(adm_services)+1;
     $("#adm_services").val(adm_services);
     
   var base_url = $("#baseurl").val();
     // alert(base_url);
     $.ajax({
            type: "POST",
            data: {},
            url: base_url + "admin/package/Cn_package/getServices",
            dataType: 'json',
 
            success: function (data){
                var i = 1; 
                var html="";
                  html+='<div><div class="vehicle-comp">';
                    html+='<div class="row">';
                  html+='</div>';
                  html+='<div class="row" style="padding: 6px 15px;">';
                    html+='<div class="col-md-3 col-3 form-group">';
                      html+='<label>Additional Services<span class="text-danger">*</span></label>';
                      html+='<select class="form-control services" style="color: #555;">';
                      html+='<option value="">Select Service</option>';
                      $(data).each(function(index, value){ //loop through your elements
                        // alert(value.pk_id);
                        html += '<option value="'+value.pk_id+'">'+value.service_name+'</option>';
                      });
                     html+='</select>';
                    html+='</div>';
                    html+='<div class="col-md-3 form-group charges"  >';
                      html+='<label>Services Charges</label>  ';
                      html+='<div class="input-group">';
                        html+='<input type="text" class="form-control package_charges" value="" autocomplete="off">';
                        html+='<span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>';
                        // html+='<div class="col-md-12"  >';
                        //   // html+='<button type="button" style="padding-right: 15px; padding-left: 15px;" class="btn btn-danger btn-sm  pull-right remove_service" >Delete</button>';
                        // html+='</div>';
                      html+='</div>';     
                      // html+=' <div for="charges_to_show_purohit_0" generated="true" class="error"></div>';     
                    html+='</div>';
                    html+='<div class="col-md-3 form-group charges"  >';
                      html+='<label>Charges to show to purohit</label>  ';
                      html+='<div class="input-group">';
                        html+='<input type="text" class="form-control charges_to_show_purohit" value="" autocomplete="off">';
                        html+='<span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>';
                        html+='</div>';
                        html+='<div class="error_'+i+'" style="color:red"></div>';
                        html+='</div>';
                        html+='<div class="col-md-3">';
                          html+='<button type="button" style="padding-right: 15px; padding-left: 15px;" class="btn btn-danger btn-sm remove_service filter-btn">Delete</button>';
                        html+='</div>';
                  html+='</div>';


               $("#addmore_div").append(html);

                 var i=0;
               $(".services").each(function(){
                  $(this).attr("name","services_"+i);
                  $(this).attr("id","services_"+i);
                  i++;
               });

                 var i=0;
               $(".package_charges").each(function(){
                  $(this).attr("name","package_charges_"+i);
                  $(this).attr("id","package_charges_"+i);
                  i++;
               });

               var i=0;
               $(".charges_to_show_purohit").each(function(){
                  $(this).attr("name","charges_to_show_purohit_"+i);
                  $(this).attr("id","charges_to_show_purohit_"+i);
                  i++;
               });
            }
        });

   });





/*[start]:: remove service*/
    $(document).on("click", ".remove_service", function(){
      
        if (confirm('Do you really want to delete this service?')) {

              $(this).parent().parent().parent().parent().remove();

              var adm_services = $("#adm_services").val();

              adm_services = parseInt(adm_services)-1;
              $("#adm_services").val(adm_services);

            //start :: assign name and id to all textbox
             var i=0;
             $(".services").each(function(){
                $(this).attr("name","services_"+i);
                $(this).attr("id","services_"+i);
                i++;
             });

               var i=0;
             $(".package_charges").each(function(){
                $(this).attr("name","package_charges_"+i);
                $(this).attr("id","package_charges_"+i);
                i++;
             });

             var i=0;
             $(".charges_to_show_purohit").each(function(){
                $(this).attr("name","charges_to_show_purohit_"+i);
                $(this).attr("id","charges_to_show_purohit_"+i);
                i++;
             });

             //[end]:: assign name and id to all textbox
        }
    });
    /*[end]:: remove more vehicle*/
//start::validation on add vehicle field
$('#add_package').on('submit', function(event) {
  
        var i=0;
        $(".services").each(function(){
          $("#services_"+i).rules("add", 
          { 
              required: true,
              messages: {
               required: "* Enter service.",
              }
          });
          i++;
        });

        var i=0;
        $(".package_charges").each(function(){
          $("#package_charges_"+i).rules("add", 
          { 
              required: true,
              messages: {
               required: "* Enter charges.",
              }
          });
          i++;
        });

        var i=0;
        $(".charges_to_show_purohit").each(function(){
          $("#charges_to_show_purohit_"+i).rules("add", 
          { 
              required: true,
              messages: {
               required: "* Enter charges to show to purohit.",
              }
          });
          i++;
        });
   
//         var i = 0;
        
//         $('.charges_to_show_purohit').each(function() {
//         $("#charges_to_show_purohit_"+i).rules('add', {
//             required: {
//             depends: function(element) {
//                 return $("#package_charges_"+i).val() < $("#charges_to_show_purohit_"+i).val();
//                 }
//             }
//         });
// });
        
        
        
        var i=0;
         $(".charges_to_show_purohit").each(function(){    
          var puro = $("#charges_to_show_purohit_"+i).val();
          var ser = $("#package_charges_"+i).val();
            // alert(puro);
            // alert(ser);
          
          if(parseFloat(puro) > parseFloat(ser))
          {
              $("#charges_to_show_purohit_"+i).val("");
              $(".error_"+i).html("* Charges to show to purohit should be less than Services charges");
          }
          else
          {
              $(".error_"+i).html("");
          }
          
          i++;
         });

     });
//end::validation on add vehicle field


var baseurl = document.getElementById('baseurl').value;
$(function () 
{
$("#add_package").validate({
        onfocusout: false,
        // Specify the validation rules
        ignore: [],
        rules: {
            language: {
                required : true,          
            },category: {
                required : true,          
            },
            pooja: {
                required : true,          
            },
            package: {
                required : true,          
            },
            category: {
                required : true,          
            },
            package_charges: {
                required : true,          
                number : true,          
                maxlength:7,
            }, 
            purohit_percentage: {
                required : true,          
                number : true,  
                min:0,        
                max:100,
            },
            description: {
                required : true,                    
                 required: function ()
                        {
                            CKEDITOR.instances.editor.updateElement();
                        }
            },
            services_0: {
                required : true,                    
            }
            // 'inclusive_services[]': {
            //     required : true,                    
            // },
        },
        // Specify the validation error messages
        messages: {
            language: {
                required: "* Please select language  .",
            },category: {
                required: "* Please select category  .",
            },
            pooja: {
                required: "* Please select pooja  .",
            },
            package: {
                required: "* Please enter package  .",
            },
            package_charges: {
                required: "* Please enter package charges  .",
                number: "accept only number",
                maxlength: '* Please enter max 7 characters.',
            },
            description: {
                required: "* Please enter description  ."
            },
            services_0: {
                required: "* Please enter exclusive services  .",
            }, 
            purohit_percentage: {
                required: "* Enter purohit % charges .",
                number: "accept only number",
                min: "should be greater than or equal to 0",        
                max: "should be less than or equal to 100",
            } 
            // 'inclusive_services[]': {
            //     required: "* Please enter inclusive services  .",
            // }, 
            // 'exclusive_services[]': {
            //     required: "* Please enter exclusive services  .",
            // },
        },
        submitHandler: function (form)
        { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
});



