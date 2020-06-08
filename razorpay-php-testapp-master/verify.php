<?php
ob_start();
require('config.php');
session_start();
require('razorpay-php/Razorpay.php');
require('mailfile/vendor/autoload.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// print_r($_POST);die();

$package_id=!empty($_POST['package_id_name'])? $_POST['package_id_name']:'';
//data base connection
$servername='localhost';
// $username='root';
// $password='';
// $dbname = "purohit_DB";
$username='shripurohit_SP';
$password='P4Lv%7MZ=MM=';
$dbname = "shripurohit_SP";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
   die('Could not Connect My Sql:' .mysql_error());
}

function getEmailInfo($email_title, $reserved_words) {
// gather information for database table
                $servername='localhost';
                // $username='root';
                // $password='';
                // $dbname = "purohit_DB";
                $username='shripurohit_SP';
                $password='P4Lv%7MZ=MM=';
                $dbname = "shripurohit_SP";
                $conn=mysqli_connect($servername,$username,$password,"$dbname");
                if(!$conn){
                   die('Could not Connect My Sql:' .mysql_error());
                }
              
                $email_sql = "SELECT `email_id`, `email_title`, `email_subject`, `email_content`, `email_added_date`, `email_updated_date` FROM `purohit_static_email_format` WHERE `email_title`='".$email_title."'";
               
                 $qry = mysqli_query($conn,$email_sql);

                $e_data = array();
                while($row=mysqli_fetch_object($qry))
                {
                    $e_data[] = $row;
                }
             
                $email_data=array();
                foreach($e_data as $key=>$val){
                     $email_data[$key] =$val->email_content; 
                     $email_subject[$key] =$val->email_subject; 
                     
                }
               
                $content = !empty($email_data[0]) ? $email_data[0] : "";
                $subject = !empty($email_subject[0]) ? $email_subject[0] : "";
                // echo "<pre>";  print_r($content);die();
        // replace reserved words if any
                foreach ($reserved_words as $k => $v) {
                    $content = str_replace($k, $v, $content);
                }
                return array("subject" => $subject, "content" => $content);
        }

         function sendPushNotification($messageData,$target){
        /*[start: push notification code]*/   
        //FCM API end-point
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        // $server_key ="AAAAU6qDs44:APA91bEzzPIkzVz95Dd23PF1n2twaz3_Hb1fik4H6qf7LCVh09MZruDBrnfxZckpkM0wkIyPnjzXyMitgwTIiwV3wU1srb_VDPp0KsYqjGI1G_WejxPCt9iYgr4sltq8pUCcDkCOVOZJ";//PASTE_YOUR_SERVER_KEY_HERE
        $server_key ="AAAAU6qDs44:APA91bFRp0T17GJnsc8AdehAn2Cxf-qxsHzMs7cc7T2ZTZshDZvDpzMovByyabWCfTn_KXZpq_8ykFYf7yk83ae0rWvMobJ-HETHABdicJO_utxyKOG33qV0z8AFm419J7z8IEJbGfr-";//PASTE_YOUR_SERVER_KEY_HERE

        $fields = array();
       // $data1=array('message' => 'Assigned delivery Boy to pickup courier','title'=>'Assigned delivery Boy to pickup','order_id'=>$order_id,'redirecttype'=>'pickup');
        $jdata=array('msg'=>json_encode($messageData));
        $fields['data'] = $jdata;
        //$target=$userData['0']['token'];
        if(is_array($target)){
        $fields['registration_ids'] = $target;
        }else{
        $fields['to'] = $target;
        }
        //header with content_type api key
        $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$server_key
        );
        //CURL request to route notification to FCM connection server (provided by Google)           
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        // print_r($result);die;
        if ($result === FALSE) {
        //die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        /*[End: push notification code]*/ 
    }
  function sendSMS($message, $mobile_no) {
        $message = urlencode($message);

        $url='http://103.233.76.120/api/mt/SendSMS?user=MPLUSSOFT&password=mplus@123456&senderid=MPSOFT%20&channel=Trans&DCS=0&flashsms=0&number='.$mobile_no.'&text='.$message.'&route=6';

        // $url='http://www.msg247.in/api/mt/SendSMS?user=daulatram&password=rohit@12&senderid=WEBSMS&channel=Trans&DCS=0&flashsms=0&number='.$mobile_no.'&text='.$message.'&route=6';
        
        // $url='http://www.msg247.in/api/mt/SendSMS?user='.SMS_USER_NAME.'&password='.SMS_PASSWORD.'&senderid='.SMS_SENDER_ID.'&channel=Trans&DCS=0&flashsms=0&number='.$mobile_no.'&text='.$message.'&route=6';


        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        $return_val = curl_close($ch);
        return $return_val;
    }

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        // print_r($success);die();
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{

    //post data
    // print_r($success);die();
  // echo "<pre>";  print_r($_POST);die();
        $paid_amt=!empty($_POST['paid_amt'])? $_POST['paid_amt']:'';
        $package_id=!empty($_POST['package_id_name'])? $_POST['package_id_name']:'';
        $pooja_id=!empty($_POST['pooja_id_name'])? $_POST['pooja_id_name']:'';
        $pooja_date = !empty($_POST['pooja_date']) ?$_POST['pooja_date'] :'';
        $pooja_time=!empty($_POST['pooja_time'])? $_POST['pooja_time']:'';
        $pooja_address=!empty($_POST['pooja_address'])? $_POST['pooja_address']:'';
        $area=!empty($_POST['area'])? $_POST['area']:'';
        $city=!empty($_POST['city'])? $_POST['city']:'';
        $exclusive_services=!empty($_POST['exservices'])? $_POST['exservices']:'';
  
        $fk_user_id = !empty($_POST['customerid'])?$_POST['customerid']:'';
        $customername = !empty($_POST['customername'])?$_POST['customername']:'';
        $customeremail_id = !empty($_POST['customeremail_id'])?$_POST['customeremail_id']:'';
        $customer_mobile = !empty($_POST['customer_mobile'])?$_POST['customer_mobile']:'';
        $pooja_order_date_plus1 = date("Y-m-d H:i:s", strtotime("+1 hours"));
        $created_date = date('Y-m-d H:i:s');
        $created_ip_address = $_SERVER['REMOTE_ADDR'];

// print_r($customeremail_id);die();
    $sql1 = "INSERT INTO purohit_customer_pooja_order (fk_user_id,total_pkg_price_exclusive,fk_pooja_id,fk_package_id,pooja_date,pooja_time,pooja_address,pooja_area,pooja_city,pooja_order_date_plus1,created_date,created_by,status)
     VALUES ('".$fk_user_id."','".$paid_amt."','".$pooja_id."','".$package_id."','".$pooja_date."','".$pooja_time."','".$pooja_address."','".$area."','".$city."','".$pooja_order_date_plus1."','".$created_date."','".$fk_user_id."','1')";

    $query = mysqli_query($conn, $sql1);

    $last_id = $conn->insert_id;
    $exclusive_services_list = explode(',',$exclusive_services);
       
    // print_r($services_count);die();
    //insert services
         if (!empty($exclusive_services_list)) {
           foreach ($exclusive_services_list as $services_id){
        
             
              $services_insert="INSERT INTO purohit_customer_package_services (fk_pooja_order_id,fk_user_id,fk_services_id,fk_package_id,service_type,status,created_date,created_by) VALUES ('".$last_id."','".$fk_user_id."','".$services_id."','".$package_id."','2','1','".$created_date."','".$fk_user_id."')";

              $services_insert_query = mysqli_query($conn, $services_insert);
            // print_r($services_insert);die();
         
         
            }
        }


   
        $sql = "SELECT `pk_id`, `token`, `first_name`, `middle_name`, `last_name`, `fk_state_id`, `fk_city_id`, `city_name`, `mobile_no`, `alternate_mobile_no`, `email_id`, `password`, `user_dob`, `address`, `location`, `upload_certificate_Image`, `upload_profile_Image`, `pathshala_gurukul_name`, `exp_years`, `qualification`, `bank_name`, `account_number`, `ifsc_code`, `account_holder_name`, `branch_name`, `status`, `purohit_latitude`, `purohit_longitude`, `created_date`, `created_by`, `created_ip_address`, `updated_date`, `updated_by`, `updated_ip_address` FROM `purohit_registered_purohit` WHERE`city_name`='".$city."'";
 
        $qry = mysqli_query($conn,$sql);

        $purohit_data = array();
        while($row=mysqli_fetch_object($qry))
        {
            $purohit_data[] = $row;
        }
        $purohit_data_list = json_decode(json_encode($purohit_data), true);
       // echo "<pre>"; print_r($purohit_data_list);die();

                if (!empty($purohit_data_list)) {
                    foreach ($purohit_data_list as $val) {
                        $purohit_id=!empty($val['pk_id'])?$val['pk_id']:'';
                        $first_name=!empty($val['first_name'])?ucwords($val['first_name']):'';

                        $middle_name=!empty($val['middle_name'])? ucwords($val['middle_name']):'';
                        $last_name=!empty($val['last_name'])?ucwords($val['last_name']):'';
                        $purohit_name=$first_name.' '.$middle_name.' '. $last_name;

                        if (!empty($val['token'])) {
                            /*Start::Request insert into purohit_request_record table and send push notification && sms to all purohit*/
                       

                             $purohit_req_insert = "INSERT INTO purohit_purohit_request_record (fk_customer_id,fk_purohit_id,fk_pooja_id,fk_pooja_order_id,fk_pkg_id,request,status,created_date,created_by)
                             VALUES ('".$fk_user_id."','".$purohit_id."','".$pooja_id."','".$last_id."','".$package_id."','1','1','".$created_date."','".$fk_user_id."')";

                             $purohit_req_insert_query = mysqli_query($conn, $purohit_req_insert);
                        // print_r($purohit_req_insert);die();


                            /*End::Request insert into purohit_request_record table */

                            $message = 'Dear ' .$purohit_name .', you have received new puja request from '.$customername.'.Please check Shri Purohit App for more details.';
                         
                            $subject = 'New Puja Request Received';
                            $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "order");
                            $target=!empty($val['token'])?$val['token']:'';
                            // print_r($purohit_req_insert);die();
                            $mobile_no=!empty($val['mobile_no'])?$val['mobile_no']:'';
                            // print_r($mobile_no);die();

                            $push_notification_insert = "INSERT INTO purohit_notifications (fk_purohit_id,fk_pooja_order_id,title,message,redirecttype,status,notification_datetime)
                             VALUES ('".$purohit_id."','".$last_id."','".$subject."','".$message."','order','1','".$created_date."')";

                             $push_notification_insert_query = mysqli_query($conn, $push_notification_insert);
                             // print_r($push_notification_insert);die();
                                /*[start: push notification code]*/   
                            sendPushNotification($resultarray,$target);
                            sendSMS($message, $mobile_no);
                              
          
   
                             /*End::Request insert into purohit_request_record table and send push notification && sms to all purohit*/
                        }

                    }/*foreach closed*/
                }

                 /*[start::A mail and message (SMS) to customer (mail to admin) after booking puja] */     

               $puja_data = "SELECT `pk_id`, `fk_language`, `fk_category`, `pooja_image`, `pooja_name`, `short_description`, `long_description`, `silent_feature`, `status`, `created_by`, `created_date`, `created_ip_address`, `updated_by`, `updated_date`, `updated_ip_address` FROM `purohit_pooja` WHERE `pk_id`='".$pooja_id."'";
               $puja_data_qry = mysqli_query($conn,$puja_data);

                   $pu_data = array();
                    while($row=mysqli_fetch_object($puja_data_qry))
                    {
                        $pu_data[] = $row;
                    }
                    $pu_data = json_decode(json_encode($pu_data), true);
                $pooja_name=!empty($pu_data[0]['pooja_name'])?$pu_data[0]['pooja_name']:'';
                   // echo "<pre>"; print_r($pooja_name);die();

                $booking_msg='Dear ' .ucwords($customername).', we have received your request for '.$pooja_name.' a for the date '.date('d-m-Y',strtotime($pooja_date)). ', time '.$pooja_time.', '.$pooja_address.', '.$city.'. We will reach you shortly. To view status of your request click on <a href="'.$base_url.'" target=_blank>'.$base_url.'</a>';

                 $msg='Dear ' .ucwords($customername).', we have received your request for '.$pooja_name.' a for the date '.date('d-m-Y',strtotime($pooja_date)).',time '.$pooja_time.', '.$pooja_address.', '.$city.'. We will reach you shortly. To view status of your request click on '.$base_url;
                 
                    sendSMS($msg, $customer_mobile);
                   //mail to customer when puja book  

                $recipeinets = $customeremail_id;
                // echo "<pre>"; print_r($recipeinets);die();
                $from = array(
                    "email" => SITE_TITLE,
                    "name"=>SITE_MAIL
                );
                $subject = 'Puja Booking';
                $reserved_words = array(
             
                    "||SITE_TITLE||" => SITE_TITLE,
                
                    "||MESSAGE||" => ucfirst($booking_msg),
                    "||SITE_URL||" => $base_url,
                    "||YEAR||" => date('Y'),
                );
           

                $email_data = getEmailInfo('puja_booking', $reserved_words);
               
       
                // $mail = new PHPMailer;

                // //Enable SMTP debugging. 
                // $mail->SMTPDebug = 4;                               
                // //Set PHPMailer to use SMTP.
                // $mail->isSMTP();            
                // //Set SMTP host name                          
                // $mail->Host = SMTP_SERVER_NAME;
                // //Set this to true if SMTP host requires authentication to send email
                // $mail->SMTPAuth = true;                          
                // //Provide username and password     
                // $mail->Username = SMTP_USERNAME;                 
                // $mail->Password = SMTP_PASSWORD;                           
                // //If SMTP requires TLS encryption then set it
                // $mail->SMTPSecure = "tls";                           
                // //Set TCP port to connect to 
                // $mail->Port = 587;                                   

                // $mail->From = SITE_MAIL;
                // $mail->FromName = SITE_TITLE;

                // $mail->addAddress($recipeinets, $customername);

                // $mail->isHTML(true);

                // $mail->Subject = "Puja Booking";
                // $mail->Body = $email_data['content'];
                // $mail->AltBody = "This is the plain text version of the email content";
                // if(!$mail->send()) 
                //     {
                //         echo "Mailer Error: " . $mail->ErrorInfo;
                //     } 
                //     else 
                //     {
                //         echo "Message has been sent successfully";
                //     }

                    //PHPMailer Object
                $mail = new PHPMailer;

                //From email address and name
                $mail->From =SITE_MAIL;
                $mail->FromName = SITE_TITLE;

                //To address and name
                $mail->addAddress($recipeinets, $customername);
                // $mail->addAddress("recepient1@example.com"); //Recipient name is optional

                //Address to which recipient will reply
                $mail->addReplyTo(SITE_MAIL, SITE_TITLE);

                //CC and BCC
                // $mail->addCC("cc@example.com");
                // $mail->addBCC("bcc@example.com");

                //Send HTML or Plain Text email
                $mail->isHTML(true);

                $mail->Subject = "Puja Booking";
                $mail->Body =$email_data['content'];
                $mail->AltBody = "This is the plain text version of the email content";

                if(!$mail->send()) 
                {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } 
                else 
                {
                    echo "Message has been sent successfully";
                }
            
                
                // org data for mail to admin
                $org_sql = "SELECT `om_pkey`, `om_CmpName`, `om_CmpType`, `om_CmpAddress`, `om_CmpCity`, `om_CmpState`, `om_CmpEmail`, `om_supportEmail`, `om_CmpMobile`, `om_CmpPhone`, `om_CmpWebsite`, `om_CmpFaxNo`, `om_CmpFBLink`, `om_CmpTwitterLink`, `om_CmpLinkedInLink`, `om_CmpGoogleLink`, `om_insta_link`, `om_youtube_link`, `om_LogoImage`, `om_mapUrl`, `om_created_by_id`, `om_clientIP`, `om_updated_date`, `om_status` FROM `purohit_static_organizationmaster` WHERE `om_pkey`=1";

                  $org_sql_qry = mysqli_query($conn,$org_sql);

                   $org_data = array();
                    while($row=mysqli_fetch_object($org_sql_qry))
                    {
                        $org_data[] = $row;
                    }
                    $orgdata = json_decode(json_encode($org_data), true);
               
                $orgemail = !empty($orgdata[0]['om_CmpEmail']) ? $orgdata[0]['om_CmpEmail'] : '';
                $om_CmpName = !empty($orgdata[0]['om_CmpName']) ? $orgdata[0]['om_CmpName'] : '';
                // print_r($orgemail);die();

                $recipeinets1 = $orgemail;

                $subject1 = 'New Puja Request Received';
                $admin_msg = 'A new user '.ucwords($customername).' booked '.$pooja_name.' for the date '.date('d-m-Y',strtotime($pooja_date)).', time '.$pooja_time.'from '.$pooja_address.', '.$city.'. Status of request: pending for acceptance.';
                $reserved_words = array(

                    "||SITE_TITLE||" => SITE_TITLE,
                
                    "||MESSAGE||" => ucfirst($admin_msg),
                    "||SITE_URL||" => $base_url,
                    "||YEAR||" => date('Y'),
                );
                $email_data = getEmailInfo('puja_booking_mail_admin', $reserved_words);
                // print_r($email_data);die();
                // $mail = new PHPMailer;

                // //Enable SMTP debugging. 
                // $mail->SMTPDebug = 4;                               
                // //Set PHPMailer to use SMTP.
                // $mail->isSMTP();            
                // //Set SMTP host name                          
                // $mail->Host = SMTP_SERVER_NAME;
                // //Set this to true if SMTP host requires authentication to send email
                // $mail->SMTPAuth = true;                          
                // //Provide username and password     
                // $mail->Username = SMTP_USERNAME;                 
                // $mail->Password = SMTP_PASSWORD;                           
                // //If SMTP requires TLS encryption then set it
                // $mail->SMTPSecure = "tls";                           
                // //Set TCP port to connect to 
                // $mail->Port = 587;                                   

                // $mail->From = $customeremail_id;
                // $mail->FromName = $customername;

                // $mail->addAddress($recipeinets1, $om_CmpName);

                // $mail->isHTML(true);

                // $mail->Subject = $subject1;
                // $mail->Body = $email_data['content'];
                // $mail->AltBody = "This is the plain text version of the email content";
                // if(!$mail->send()) 
                //     {
                //         echo "Mailer Error: " . $mail->ErrorInfo;
                //     } 
                //     else 
                //     {   
                //       // $_SESSION['msg'] = "<div class='success'>Puja created successfully</div>";
                //         // session_start();
                //         $success = "Your payment was successful";
                //         $success = base64_encode($success);
                //          // $_SESSION['msg']="Hello";
                    
                //         header("Location: http://localhost/shri-purohit/front-my-booking?success=$success");
                //     }
                $mail = new PHPMailer;

                //From email address and name
                $mail->From =$customeremail_id;
                $mail->FromName = $customername;

                //To address and name
                $mail->addAddress($recipeinets1, $om_CmpName);
                // $mail->addAddress("recepient1@example.com"); //Recipient name is optional

                //Address to which recipient will reply
                $mail->addReplyTo($customeremail_id, $customername);

                //CC and BCC
                // $mail->addCC("cc@example.com");
                // $mail->addBCC("bcc@example.com");

                //Send HTML or Plain Text email
                $mail->isHTML(true);

                $mail->Subject = $subject1;
                $mail->Body =$email_data['content'];
                $mail->AltBody = "This is the plain text version of the email content";

                if(!$mail->send()) 
                {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } 
                else 
                {
                      $success = "Your payment was successful";
                        $success = base64_encode($success);
                         // $_SESSION['msg']="Hello";
                    
                        header("Location: http://localhost/shri-purohit/front-my-booking?success=$success");
                }
              
                 /*[End::A mail and message (SMS) to customer (mail to admin)after booking puja] */ 
    //header("Location: ront-my-booking"); 




    // $html = "<p>Your payment was successful</p>
    //          <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
}
else
{
    // $html = "<p>Your payment failed</p>
    //          <p>{$error}</p>";package_id
}
     

// echo $html;

