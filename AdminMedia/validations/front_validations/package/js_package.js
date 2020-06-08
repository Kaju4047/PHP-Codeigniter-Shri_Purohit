
$("#razorpay-form").validate({
// Specify the validation rules
onfocusout: true,
 ignore: [],
        rules: {
            poojadate: {
                required: true,
               
                },  

           
            poojatime: {
               required: true,
            },
    
         address: {
                required: true,
              
                }, 

       event_location: {
                required: true,
               
                },  
        selectbtn: {
                required: true,
            
                },
    
      
   
        },
        // Specify the validation error messages
        messages: {
            poojadate: {
                required: "* Please select date.",
                
            },   
            
          
            poojatime: {
                required: "* Please select time.",
           
            },
             address: {
                required: "* Please enter address.",
               
            },
            event_location: {
                required: "* Please enter area.",
             
            },    
          
            selectbtn: {
                required: "* Please select package.",
               
            },
 
        },
        submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });

google.maps.event.addDomListener(window, 'load', function () 
  {
    var input_txt1 = document.getElementById('area');
    var places1 = new google.maps.places.Autocomplete(input_txt1);
  });


/*Start::set package data and select at a time only one pkg */
     $('[name="selectbtn"]').click(function(){
      var $this = $(this);
      var select_val = $(this).attr("class");

   /*Start::Radio button select value set*/

      $('.selected').html('Select');
      $('.btncolor').css('background-color', '#e4e4e4');
      $('#selected_'+select_val).html('Selected');
      $('#btncolor_'+select_val).css('background-color', '#78ad39');

     /*End::Radio button select value set*/
     

      //Start::data set in order summery
      let $total_amount = parseFloat($(this).attr("data-price"));
      var $language_name = $(this).attr("data-language");
      var $pooja_name = $(this).attr("data-puja-name");
      var $city = $("#event_city").val();
      // var $pooja_location = $("#event_location").val();
      var pooja_id_val= $(this).attr("data-pooja_id");
      var package_id_val= $(this).attr("data-package_id");
      var package_name= $(this).attr("data-pkgname");
      var $tax  = $(this).attr("data-tax");

      //Start::by default package price prder summery
          
         $tax_included=($total_amount * ($tax)/100);
         $tax_included_amount=$tax_included+$total_amount;
          
          $("#pkgcharge").text('Rs.'+$total_amount);
          $("#languageset").text($language_name);
          $("#pooja_nameset").text($pooja_name);
          $("#poojacity_set").text($city);
          // $("#poojalocation_set").text($pooja_location);
          $('#package_id').val(package_id_val);
          $('#pooja_id').val(pooja_id_val);
          $("#pkgnameset").text(package_name);
          $("#taxset").text('Rs.'+$tax_included_amount);
          $("#submit-pay").val($tax_included_amount);
          //set values in hidden field for post
          $("#package_sum").val($total_amount);
          $("#tax_post").val($tax_included_amount);
            // alert($tax_included_amount);
          
           
             //End::by default package price order summery
            $(this).closest('.excls').find("input[type=checkbox]:checked").each(function() {
  
            var $price  = parseFloat($(this).attr("data-service"));
            

       
           
            $total_amount = $total_amount + $price;
            $tax_included=($total_amount * ($tax)/100);
            $tax_included_amount=$tax_included+$total_amount;
            $("#taxset").text('Rs.'+$tax_included_amount);
            $("#submit-pay").val($tax_included_amount);
            $("#pkgcharge").text('Rs.'+$total_amount);
             //set values in hidden field for post
            $("#package_sum").val($total_amount);
            $("#tax_post").val($tax_included_amount);
            // $("#exclusive_sum").val($price);
          
      });
 //End::data set in order summery
       $('[name="exservices[]"]').each(function () {

        var exclusive_val = $(this).attr("class");
     //compair and unchecked second package services or radio button
        if (select_val!=exclusive_val) {

      $(this). prop("checked", false);
       
    }
/*By default set package value when no services select*/
     calculate_amt(exclusive_val);
      });

})
/*End::set package data and select at a time only one pkg*/

/*Start::Exclusive services charges add */
     $('[name="exservices[]"]').click(function(){
        var exclusive_cls = $(this).attr("class");
//trigger for uncheced the selected service when we checked other pakage and set default package charges
        $('#'+exclusive_cls+'_radio'). trigger('click');
        calculate_amt(exclusive_cls);
    });


     function calculate_amt(exclusive_cls){
        var pack_amt =$('#'+exclusive_cls).val();
       
        var total=pack_amt
          $('.'+exclusive_cls).each(function () {

        var dataservice = $(this).attr("data-service");
        dataservice=(dataservice!=undefined)?dataservice:0;
        var slect = $(this).prop("checked");
    
        if(slect==true){
 
        total=parseFloat(total)+parseFloat(dataservice);
    
        }
      
      });
          
          $('#'+exclusive_cls+'_amt').html('Rs.'+total);
     }


      

  $('body').on('click', '.buy_now', function(e){
    // $('.buy_now"]').click(function(){

   var base_url= $('#base_url').val();
   var package_id= $('#package_id').val();
   var pooja_id= $('#pooja_id').val();
   var paid_amt= $('#submit-pay').val();
   var pooja_date= $('#poojadate').val();
   var pooja_time= $('#timepicker').val();
   var pooja_address= $('#address').val();
   var area=$("#event_location").val();
   var city=$("#event_city").val();
  var selectbt =$('input[name="selectbtn"]:checked').val();

  // alert(area);
  var exclusive_val = []
  $("input[name='exservices[]']:checked").each(function ()
  {
      exclusive_val.push(parseInt($(this).val()));
  });
  
 //live - rzp_live_D817itL0AJbeLA
 //test - rzp_test_feVlR1RWnSrLLc
  var options = {
      "key": "rzp_test_feVlR1RWnSrLLc",
      "amount": (paid_amt*100), // 2000 paise = INR 20
      "name": "Shri Purohit",
      "description": "Payment",
      "image": base_url +"AdminMedia/images/74NDff34_400x400.jpg",
      "handler": function (response){
        $.ajax({
          url: base_url + 'pooja-create-action',
          type: 'post',
          dataType: 'json',
          data: {
            razorpay_payment_id: response.razorpay_payment_id , package_id : package_id,pooja_id : pooja_id,paid_amt:paid_amt,pooja_date:pooja_date,pooja_time:pooja_time
          ,pooja_address:pooja_address,area:area,city:city,exclusive_val:exclusive_val},
          success: function (data) {


            var success_msg = 'Payment done successfully';
         
             // alert(success_msg);
            window.location.href = base_url + 'front-my-booking?successmsg='+ success_msg;
          }
        });

      },

      "theme": {
        "color": "#528FF0"
      }
    };

//input field validations
    $('.txt-error').remove();
    if(pooja_date !== '' && pooja_address !=='' && pooja_time !=='' && area !=='' && selectbt=='on'){

    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
    }else{

// alert(area);
          var $date = "<span class='txt-error'>Please select date</span>";
          var $address = "<span class='txt-error'>Please enter address</span>";
          var $time = "<span class='txt-error'>Please select time</span>";
          var $area_location = "<span class='txt-error'>Please enter area</span>";
          var selectbttxt = "<span class='txt-error'>Please select package</span>";
         if(pooja_date=='' ) {
          $("#date_error").html($date);
          }
          if(pooja_address==''){
          $("#address_error").html($address);
          }
          if(pooja_time==''){
          $("#time_error").html($time);
          }
          if(area ==''){

          $("#area_error").html($area_location);
          }
          if(selectbt==undefined){

          $("#package_error").html(selectbttxt);
          }

    }
  

    });