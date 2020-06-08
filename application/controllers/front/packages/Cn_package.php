<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('razorpay-php-testapp-master/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
class Cn_package extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor

    }

    public function view_package($pooja_id) {
   /*Start:: get pooja packages*/
    $this->db->select('package.pk_id,pooja.pooja_name,package,description,fk_pooja,package_charges,pooja_image,language');
    $this->db->from('package');
    $this->db->join('pooja','pooja.pk_id=package.fk_pooja');
    $this->db->join('master_category mc','mc.pk_id=package.fk_category');
    $this->db->join('master_language ml','ml.pk_id=package.fk_language');
    $this->db->where('package.status','1');
    $this->db->where('pooja.status','1');
    $this->db->where('mc.status','1');
    $this->db->where('package.fk_pooja',$pooja_id);
     $pooja_packages_data=$this->db->get()->result_array();
     if (empty($pooja_packages_data)) {
          return redirect($_SERVER['HTTP_REFERER']);
     }

        $finalarray=array();
     if (!empty($pooja_packages_data)) {
        foreach ($pooja_packages_data as $key => $value) {

    $this->db->select('ps.services_charges,ac.service_name,service_type');
    $this->db->from('package_services as ps');
    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
    $this->db->where('fk_package',$value['pk_id']);
    $this->db->where('ps.status','1');
    $this->db->where('ac.status','1');
    $this->db->where('ps.service_type','1');
    $services_inclusive=$this->db->get()->result_array();

    $this->db->select('ps.services_charges,ac.service_name,service_type,fk_services');
    $this->db->from('package_services as ps');
    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
    $this->db->where('fk_package',$value['pk_id']);
    $this->db->where('ps.status','1');
    $this->db->where('ac.status','1');
    $this->db->where('ps.service_type','2');
    $services_exclusive=$this->db->get()->result_array();

    $this->db->select('state_tax,central_tax');
    $this->db->from('master_tax');
    $this->db->where('status','1');
    $this->db->limit('1');
    $this->db->order_by('pk_id','desc');
    $tax_data=$this->db->get()->result_array();
     $state_tax=!empty($tax_data[0]['state_tax']) ?$tax_data[0]['state_tax']:'0';
     $central_tax=!empty($tax_data[0]['central_tax']) ?$tax_data[0]['central_tax']:'0';
     $both_tax=$state_tax+$central_tax;
  

     $value['tax']=$both_tax;
     $value['inclusive']=$services_inclusive;
     $value['exclusive']=$services_exclusive;
     
     $finalarray[]=$value;

           
        }
     }
$data['package_list']=$finalarray;
/*End:: get pooja pooja packages*/

    /*Start::Get customer details*/
    $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';

    $this->db->select('customer_address,customer_city');
    $this->db->from('customer_registration');
    $this->db->where('status','1');
    $this->db->where('pk_id',$customerid);
    $data['customer_address_details'] = $this->db->get()->result_array();


    $this->db->select('pooja_address,pooja_city,pooja_area');
    $this->db->from('customer_pooja_order');
    $this->db->where('status','1');
    $this->db->where('fk_user_id',$customerid);
    $data['customer_pooja_address_details'] = $this->db->get()->result_array();

    $this->db->select('sum(rating) as sumofrating,count(pk_id) as countrating');
    $this->db->from('customer_rating as A');
    $this->db->where('fk_puja_id',$pooja_id);  
    $this->db->where('A.status',1);
    $rating_data= $this->db->get()->result_array();
/*Start::rating of pooja*/
        if (!empty($rating_data[0]['sumofrating'])) {

                $ratings = (!empty($rating_data[0]['sumofrating']) ? $rating_data[0]['sumofrating'] : '0') / ((!empty($rating_data[0]['countrating']) ? $rating_data[0]['countrating'] : '0'));
            }
    $data['pooja_total_rating']=!empty($ratings)?$ratings:'';
    $data['totalcount']=!empty($rating_data[0]['countrating'])?$rating_data[0]['countrating']:'';
/*End::rating of pooja*/

 
        // echo "<pre>"; print_r($data['customer_pooja_address_details']);die();
       $this->load->view('front/packages/vw_view_package',$data);
     }

    public function pooja_create_action(){

    // $this->form_validation->set_rules('poojadate', 'Pooja Date', 'trim|required');
    // $this->form_validation->set_rules('poojatime', 'Pooja Time', 'trim|required');
    // if ($this->form_validation->run() === FALSE) {
    //     $this->session->set_flashdata('error', validation_errors());
    //      redirect($_SERVER['HTTP_REFERER']);
    //     exit();
    // } else {
        // echo "<pre>"; print_r($_POST);die();
        $pooja_date = !empty($this->input->post('pooja_date')) ? date('Y-m-d', strtotime($this->input->post('pooja_date'))) :'';
        $exclusive_services=!empty($this->input->post('exclusive_val'))? $this->input->post('exclusive_val'):'';
        $pooja_time=!empty($this->input->post('pooja_time'))? $this->input->post('pooja_time'):'';
        $pooja_address=!empty($this->input->post('pooja_address'))? $this->input->post('pooja_address'):'';
        $area=!empty($this->input->post('area'))? $this->input->post('area'):'';
        $city=!empty($this->input->post('city'))? trim($this->input->post('city')):'';
        $package_id=!empty($this->input->post('package_id'))? $this->input->post('package_id'):'';
        $pooja_id=!empty($this->input->post('pooja_id'))? $this->input->post('pooja_id'):'';
        // $package_sum=!empty($this->input->post('package_sum'))? $this->input->post('package_sum'):'';
        $paid_amt=!empty($this->input->post('paid_amt'))? $this->input->post('paid_amt'):'';
        // $advancepay=!empty($this->input->post('advancepay'))? $this->input->post('advancepay'):'';
        // $remaining_amt=!empty($this->input->post('remaining_amt'))? $this->input->post('remaining_amt'):'';
       
        $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
        $customer_email_id=!empty($this->session->userdata('CTMREMAIL'))?$this->session->userdata('CTMREMAIL'):'';
        $customer_mobile_no=!empty($this->session->userdata('CTMRMOBILE'))?$this->session->userdata('CTMRMOBILE'):'';
        $customer_name=!empty($this->session->userdata('CTMRNAME'))?$this->session->userdata('CTMRNAME'):'';

        $puja_date_time = $pooja_date.''.$pooja_time;
        $this->db->select('package_charges, purohit_percentage');
        $this->db->from('purohit_package');
        $this->db->where('pk_id', $package_id);
        $query = $this->db->get()->row();
        
        $this->db->select('fine_for_purohit');
        $this->db->from('master_fine_for_purohit');
        $this->db->where('status','1');
        $this->db->limit('1');
        $this->db->order_by('pk_id','desc');
        $cancellation_charges_data = $this->db->get()->row();
                    
// echo "<pre>"; print_r($customer_email_id);die();
        $inserted_data = array(
            'fk_user_id'=>$customerid,
            'fk_pooja_id'=>$pooja_id,
            'fk_package_id'=>$package_id,
            // 'services_charges'=>$exclusive_sum,
            'total_pkg_price_exclusive'=>$paid_amt,
            'package_charges' => $query->package_charges,
            'purohit_percentage' => $query->purohit_percentage,
            'fine_for_purohit' => $cancellation_charges_data->fine_for_purohit,
            // 'advance_amount'=>$advancepay,
            // 'remaining_amount'=>$remaining_amt,
            'pooja_date' => date('Y-m-d', strtotime($pooja_date)),
            'pooja_time' => date('h:i A', strtotime($pooja_time)),
            'pooja_address'=>$pooja_address,
            'pooja_area'=>$area,
            'pooja_city'=>$city,
            // 'advance_payment_status'=>'1',
            'pooja_order_date_plus1'=>date("Y-m-d H:i:s", strtotime("+1 hours")),
            'status'=>'1',
            'created_date'=>date('Y-m-d H:i:s'),
            'created_by'=>$customerid,
            'created_ip_address'=>$_SERVER['REMOTE_ADDR'],
            'pooja_date_time' => date('Y-m-d H:i', strtotime($puja_date_time))
        );
        $ret = $this->Md_database->insertData('customer_pooja_order', $inserted_data,'','');
        $pooja_order_id = $this->db->insert_id();
            // print_r($inserted_data);die();
            if (!empty($customerid)) {
              if (!empty($exclusive_services)) {
                for ($i = 0; $i < count($exclusive_services); $i++) {
                    $table = "customer_package_services";
                    $insert_data = array(
                        'fk_pooja_order_id ' => $pooja_order_id,
                        'fk_user_id ' => $customerid,
                        'fk_package_id' => $package_id,
                        'fk_services_id' => $exclusive_services[$i],
                        'service_type' => '2',
                        'status' => '1',
                        'created_date'=>date('Y-m-d H:i:s'),
                        'created_by'=>$customerid,
                        'created_ip_address'=>$_SERVER['REMOTE_ADDR'],
                    );
                      $this->Md_database->insertData($table, $insert_data);
                      
                      
            $this->db->select('fk_services, services_charges, charges_to_show_purohit');
            $this->db->from('purohit_package_services');
            $this->db->where('fk_package', $package_id);
            $this->db->where('fk_services', $exclusive_services[$i]);
            $this->db->where('service_type', 2);
            $charges = $this->db->get()->row();
            
                if($charges->fk_services != 0)
                {
                    $data_charges = array(
                    'puja_order_id' => $pooja_order_id,
                    'pkg_id' => $package_id,
                    'service_id' => $charges->fk_services,
                    'services_charges' => $charges->services_charges,
                    'charges_to_show_purohit' => $charges->charges_to_show_purohit,
                    'created_by' => $this->session->userdata('UID'),
                    'created_on' => date('Y-m-d H:i:s'),
                    'created_ip_address' => $_SERVER['REMOTE_ADDR']
                    );    
                    
                    $this->db->insert('purohit_show_charges', $data_charges);    
                }
                
            
            
                }
                
            
                
            }
            
            
         /*Start::Send Request & push notification to purohit only send area wise those user have area*/

    $this->db->select('token,pk_id,location,mobile_no,first_name,middle_name,last_name');
    $this->db->from('registered_purohit');
    $this->db->where('city_name',$city);
    $this->db->where('status','1');
    $purohit_data=$this->db->get()->result_array();
        if (!empty($purohit_data)) {
                    foreach ($purohit_data as $val) {
                        $first_name=!empty($val['first_name'])?ucwords($val['first_name']):'';

                        $middle_name=!empty($val['middle_name'])? ucwords($val['middle_name']):'';
                        $last_name=!empty($val['last_name'])?ucwords($val['last_name']):'';
                        $purohit_name=$first_name.' '.$middle_name.' '. $last_name;

                        // print_r($userdata);die();
                        if (!empty($val['token'])) {
                        /*Start::Request insert into purohit_request_record table */
                            $table = "purohit_purohit_request_record";
                            $insert_data = array(
                                'fk_customer_id'=>$customerid,
                                'fk_purohit_id' => $val['pk_id'],
                                'fk_pooja_id' => $pooja_id,
                                'fk_pooja_order_id'=>$pooja_order_id,
                                'fk_pkg_id' => $package_id,
                                'request' => '1',
                                'status' => '1',
                                'created_date' => date('Y-m-d H:i:s'),
                                'created_by' =>$customerid,
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);

                        /*End::Request insert into purohit_request_record table */

                            $message = 'Dear ' .$purohit_name .', you have received new puja request from '.$customer_name.'.Please check Shri Purohit App for more details.';
                         
                            $subject = 'New Puja Request Received';
                            $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "order");
                            $target=!empty($val['token'])?$val['token']:'';
                            // print_r($target);die();
                            $mobile_no=!empty($val['mobile_no'])?$val['mobile_no']:'';

                            $this->Md_database->sendPushNotification($resultarray,$target);

                           
              
                            $this->Md_database->sendSMS($message, $mobile_no);

                            $table = "notifications";
                            $insert_data = array(
                                
                                'fk_purohit_id' => $val['pk_id'],
                                'fk_pooja_order_id' => $pooja_order_id,
                                'title'=>$subject,
                                'message' => $message,
                                'redirecttype' => 'order',
                                'status' => '1',
                                'notification_datetime' => date('Y-m-d H:i:s'),
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);



         /*End::Send Request & push notification to purohit only send area wise those user have area and location*/
                        }


                    }
                }
               /*[start::A mail and message (SMS) to customer (mail to admin) after booking puja] */     

                $this->db->select('pooja_name');
                $this->db->from('pooja');
                $this->db->where('status','1');
                $this->db->where('pk_id',$pooja_id);
                $pooja_data= $this->db->get()->result_array();
                $pooja_name=!empty($pooja_data[0]['pooja_name'])?$pooja_data[0]['pooja_name']:'';
                // print_r($pooja_id);die();

                $booking_msg='Dear ' .ucwords($customer_name).', we have received your request for '.$pooja_name.' a for the date '.date('d-m-Y',strtotime($pooja_date)). ', time '.$pooja_time.', '.$pooja_address.', '.$city.'. We will reach you shortly. To view status of your request click on <a href="'.base_url().'" target=_blank>'.base_url().'</a>';

                 $msg='Dear ' .ucwords($customer_name).', we have received your request for '.$pooja_name.' a for the date '.date('d-m-Y',strtotime($pooja_date)).',time '.$pooja_time.', '.$pooja_address.', '.$city.'. We will reach you shortly. To view status of your request click on '.base_url();
                        
                $recipeinets = $customer_email_id;
                $from = array(
                    "email" => SITE_TITLE,
                    "name"=>SITE_MAIL
                );
                $subject = 'Puja Booking';
                $reserved_words = array(
             
                    "||SITE_TITLE||" => SITE_TITLE,
                
                    "||MESSAGE||" => ucfirst($booking_msg),
                    "||SITE_URL||" => base_url(),
                    "||YEAR||" => date('Y'),
                );
                $email_data = $this->Md_database->getEmailInfo('puja_booking', $reserved_words);
                // print_r($email_data);die();
               
                $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);

                $this->Md_database->sendSMS($msg, $customer_mobile_no);
                // mail to admin
                $orgdata = $this->Md_database->getData('static_organizationmaster', '*');
                $orgemail = !empty($orgdata[0]['om_CmpEmail']) ? $orgdata[0]['om_CmpEmail'] : '';

                $recipeinets1 = $orgemail;
                $from1 = array(
                    "email" => $customer_email_id,
                    "name"=>$customer_name
                );
                $subject1 = 'New Puja Request Received';
                $admin_msg = 'A new user '.ucwords($customer_name).' booked '.$pooja_name.' for the date '.date('d-m-Y',strtotime($pooja_date)).', time '.$pooja_time.'from '.$pooja_address.', '.$city.'. Status of request: pending for acceptance.';
                $reserved_words = array(

                    "||SITE_TITLE||" => SITE_TITLE,
                
                    "||MESSAGE||" => ucfirst($admin_msg),
                    "||SITE_URL||" => base_url(),
                    "||YEAR||" => date('Y'),
                );
                $email_data = $this->Md_database->getEmailInfo('puja_booking_mail_admin', $reserved_words);
                // print_r($email_data);die();
               
                $ml = $this->Md_database->sendEmail($recipeinets1, $from1, $subject1, $email_data['content']);
                 /*[End::A mail and message (SMS) to customer (mail to admin)after booking puja] */ 
        }
        // $arr = array('msg' => 'Payment successfully credited');

         echo json_encode($ret);
        // if (!empty($ret)) {
        //     // $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        //       $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">
        //     Puja payment done successfully.
        // </div>');
        //     redirect(base_url('front-my-booking'));
        // } else {
        //     // $this->session->set_flashdata('error', "Pooja  $actionMsg failed, please try again.");
        //         $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
        //     Puja $actionMsg successfully.
        // </div>');
        //          redirect($_SERVER['HTTP_REFERER']);
        // }
    // }

    }

}