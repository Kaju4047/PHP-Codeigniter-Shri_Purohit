
<?php
session_start();
// ob_start();
require('config.php');
require('razorpay-php/Razorpay.php');

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders

// echo "<pre>";print_r($api);die();
        $paid_amt=!empty($_POST['tax_post'])? $_POST['tax_post']:'';
        $package_id=!empty($_POST['package_id_name'])? $_POST['package_id_name']:'';
        $pooja_id=!empty($_POST['pooja_id_name'])? $_POST['pooja_id_name']:'';
        $pooja_date = !empty($_POST['poojadate']) ? date('Y-m-d', strtotime($_POST['poojadate'])) :'';
        $pooja_time=!empty($_POST['poojatime'])? $_POST['poojatime']:'';
        $pooja_address=!empty($_POST['address'])? $_POST['address']:'';
        $area=!empty($_POST['event_location'])? $_POST['event_location']:'';
        $city=!empty($_POST['event_city'])? trim($_POST['event_city']):'';
        $exclusive_services=!empty($_POST['exservices'])? $_POST['exservices']:'';
        $customer_id=!empty($_POST['customer_id'])? $_POST['customer_id']:'';
        $customer_name=!empty($_POST['customer_name'])? $_POST['customer_name']:'';
        $customer_email_id=!empty($_POST['customer_email_id'])? $_POST['customer_email_id']:'';
        $customer_mob=!empty($_POST['customer_mob'])? $_POST['customer_mob']:'';
        
       

$orderData = [

    'amount'          => $paid_amt*100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
// echo "<pre>";print_r($orderData);die();
$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];
// print_r($_SESSION['razorpay_order_id']);die();
if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $paid_amt,
    "name"              => "Shri Purohit",
    "description"       => "Puja Booking",
    "image"             => "74NDff34_400x400.jpg",
    "prefill"           => [
    "name"              => "Daft Punk",
    "email"             => "customer@merchant.com",
    "contact"           => "9999999999",
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#0d2366"
    ],
    "order_id"          => $razorpayOrderId,

    
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}
    $data['package_id_name'] = $package_id;
    $data["pooja_id_name" ]  =     $pooja_id;
    $data["paid_amt"] =    $paid_amt;
   
    $data["exservices"]   =     $exclusive_services;
   
    $data["poojadate"]   =    $pooja_date;
    $data["poojatime"]   =     $pooja_time;
    $data["address"]   =     $pooja_address;
    $data["event_location" ]  =     $area;
    $data["event_city"]   =     $city;
    $data['customerid']   =     $customer_id;
    $data['customername']   =     $customer_name;
    $data['customeremail_id']   =     $customer_email_id;
    $data['customer_mob_no']   =     $customer_mob;
// echo "<pre>";print_r($data);die();

$json = json_encode($data);
require("checkout/{$checkout}.php");
