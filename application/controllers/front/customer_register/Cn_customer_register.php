<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_customer_register extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
       

       $this->load->view('front/customer_register/vw_customer_register');
    }
    public function registration_action() 
    {
        // echo "<pre>";
        // print_r($_POST);die;
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('mobileno', 'Mobile no', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url() . 'front-customer-register');
            exit();
        } else {
        	$customer_name=!empty($this->input->post('name'))? ucwords($this->input->post('name')):'';
        	$customer_mobileno=!empty($this->input->post('mobileno'))? $this->input->post('mobileno'):'';
        	$customer_email=!empty($this->input->post('email'))? strtolower($this->input->post('email')):'';
        	$password=!empty($this->input->post('password'))? $this->input->post('password'):'';
            $address=!empty($this->input->post('event_location'))? $this->input->post('event_location'):'';
            $city=!empty($this->input->post('event_city'))? $this->input->post('event_city'):'';
            $login_redirect=!empty($this->input->post('login_redirect'))? $this->input->post('login_redirect'):'';


        $this->db->where('status<>','3');
        $condition = array('customer_email_id'=>$customer_email);
       
        $email_idcheck = $this->Md_database->getData('customer_registration', '*', $condition);
        if (!empty($email_idcheck)) {
           $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">This email id is already exists.</div>');
      
             redirect(base_url() . 'front-customer-register');
        } 
        	  // $token = substr((uniqid(rand(), true)), 0, 6);

           //      $passwordnew = 'SP' . $token;
           //      $password = base64_encode($passwordnew);

                 $inserted_data = array(
                'customer_name' => $customer_name,
                'customer_mobile_no' => $customer_mobileno,
                'customer_email_id' => $customer_email,
 				'customer_password' => $password,
                'customer_address' => $address,
                'customer_city' => $city,
            	'status'=>'1',
    			'created_date'=>date('Y-m-d H:i:s'),
    			// 'created_by'=>$this->input->post('txtPkey'),
    			'created_ip_address'=>$_SERVER['REMOTE_ADDR'],
              
              

            );
        // echo "<pre>";
        // print_r($inserted_data);die;
            if(empty($this->input->post('txtPkey')))
            {
				$ret = $this->Md_database->insertData('customer_registration', $inserted_data);
		/* [start::send login credential to customer on registred email id mail] */
                 $recipeinets = $customer_email;
                        $from = array(
                            "email" => SITE_MAIL,
                            "name" => SITE_TITLE
                        );
                        $reserved_words = array(
                            "||USER_NAME||" =>  $customer_name,
                            "||SITE_TITLE||" => SITE_TITLE,
                            "||EMAIL_ID||" => $customer_email,
                            "||PASSWORD||" => $password,
                            "||SITE_URL||" => base_url(),
                            "||YEAR||" => date('Y'),
                        );


                        $email_data = $this->Md_database->getEmailInfo('customer_registration', $reserved_words);
                        $subject = SITE_TITLE . '-' . !empty($email_data['subject']) ? $email_data['subject'] : "";
                       
                       // print_r($email_data['content']);die;
                        $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
                     
                         
                        /* [end::send login credential to customer on registred email id mail] */


             if (!empty($ret)) {

  			$this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">Your registration process has been done successfully. Check your registered email id for login credentials.</div>');
             
                  
                redirect(base_url('front-customer-login'));
            
			
            } else {
            $this->session->set_userdata('msg', '<div class="alert alert-error ErrorsMsg">Registration failed, please try again.</div>');
			redirect(base_url() . 'front-customer-login');
                }
            }
     
           
        }
    }

    	public function check_email() {
/*Start::check emaild id already exists or not through remote method */
        
        $emailid=!empty($this->input->get('email'))? strtolower($this->input->get('email')):'';
        $this->db->where('status<>','3');
        $condition = array('customer_email_id'=>$emailid);
       
        $edi = $this->Md_database->getData('customer_registration', '*', $condition);
        if (!empty($edi)) {
            echo 'false';
        } else {
            echo 'true';
        }
        
    }
	/*End::check emaild id already exists or not through remote method*/

}