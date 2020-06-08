<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body onload="myFunction()">
<form name='razorpayform' action="verify.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature">
    <input type="hidden" name="paid_amt"  id="paid_amt">
    <input type="hidden" name="package_id_name"  id="package_id_name">
    <input type="hidden" name="pooja_id_name"  id="pooja_id_name">
    <input type="hidden" name="pooja_date"  id="pooja_date">
    <input type="hidden" name="pooja_time"  id="pooja_time">
    <input type="hidden" name="pooja_address"  id="pooja_address">
    <input type="hidden" name="area"  id="area">
    <input type="hidden" name="city"  id="city">
    <input type="hidden" name="exservices"  id="exservices">
    <input type="hidden" name="customerid"  id="customerid">
    <input type="hidden" name="customername"  id="customername">
    <input type="hidden" name="customeremail_id"  id="customeremail_id">
    <input type="hidden" name="customer_mobile"  id="customer_mobile">
 
</form>


<!-- <button id="rzp-button1">Pay with Razorpay</button> -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
// Checkout details as a json
var options = <?php echo $json?>;
// alert(JSON.stringify(options));
// console.log(options);

//set package details in hidden for insert in table
document.getElementById('paid_amt').value = options.paid_amt;
document.getElementById('package_id_name').value = options.package_id_name;
document.getElementById('pooja_id_name').value = options.pooja_id_name;
document.getElementById('pooja_date').value = options.poojadate;
document.getElementById('pooja_time').value = options.poojatime;
document.getElementById('pooja_address').value = options.address;
document.getElementById('area').value = options.event_location;
document.getElementById('city').value = options.event_city;
document.getElementById('exservices').value = options.exservices;
document.getElementById('customerid').value = options.customerid;
document.getElementById('customername').value = options.customername;
document.getElementById('customeremail_id').value = options.customeremail_id;
document.getElementById('customer_mobile').value = options.customer_mob_no;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
// alert('JJJJ');

    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
   

    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);
// alert(JSON.stringify(rzp));

// document.getElementById('rzp-button1').onclick = function(e){
//     rzp.open();
//     e.preventDefault();
// }



function myFunction()
{
    rzp.open();
}
</script>

</body>
</html>
