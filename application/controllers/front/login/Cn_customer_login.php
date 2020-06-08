<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_customer_login extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
       

       $this->load->view('front/login/vw_customer_login');
    }


    	public function customer_login()
	{

		if (!empty($this->input->post())) {
            //Post Data
        $email=!empty($this->input->post('email'))? trim($this->input->post('email')):'';
		$password=!empty($this->input->post('password'))? $this->input->post('password'):'';
        $login_redirect=!empty($this->input->post('login_redirect'))? $this->input->post('login_redirect'):'';

          
        $this->form_validation->set_rules('email','Username','required|trim');
            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
               redirect($_SERVER['HTTP_REFERER']);
                exit();
            } else {


	$condition['customer_email_id'] = $email;
	$condition['status<>'] = '3';
	$useridcheck = $this->Md_database->getData('customer_registration', '*', $condition);
	// echo "<pre>";
	// 		print_r($useridcheck);die;
				if (empty($useridcheck)) {
			// print_r($useridcheck);die;
				$this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
				        This email id does not exists.
				    </div>');
				redirect($_SERVER['HTTP_REFERER']);
				// redirect($_SERVER['HTTP_REFERER']);

				}
     	
        $select='pk_id,customer_name,customer_mobile_no,customer_email_id,status,customer_password';
    	$condition = array('status<>' => '3','customer_email_id'=>$email,'customer_password'=>$password);
        $data = $this->Md_database->getData('customer_registration',$select, $condition, '', '');
// echo "<pre>";
// print_r($data);die();
        $pk_id=!empty($data[0]['pk_id'])? $data[0]['pk_id']:'';
        $name=!empty($data[0]['customer_name'])? $data[0]['customer_name']:'';
        $emailid=!empty($data[0]['customer_email_id'])? $data[0]['customer_email_id']:'';
        $mobile=!empty($data[0]['customer_mobile_no'])? $data[0]['customer_mobile_no']:'';
        $status=!empty($data[0]['status'])? $data[0]['status']:'';
        $email=!empty($data[0]['customer_password'])? base64_decode($data[0]['customer_password']):'';
		
			if (!empty($data)) {
			if (!empty($data) && $status=='1') {
                    
	/*Start:: set customer details in session*/
 			$this->session->set_userdata('CTMRPKID', $pk_id);
			$this->session->set_userdata('CTMRNAME', $name);
  			$this->session->set_userdata('CTMREMAIL', $emailid);
			$this->session->set_userdata('CTMRMOBILE', $mobile);
			$this->session->set_userdata('CTMRPWD', $password);
    /*End:: set customer details in session*/

                  if ($this->input->POST('remember') == "yes") {
		                setcookie('cok_Email', $email, time() + (86400 * 30));
		                setcookie('cok_Password', $this->input->post('password'), time() + (86400 * 30));
		                 
		            } else {
		                setcookie('cok_Email', $email, time() - (86400 * 30));
		                setcookie('cok_Password', $this->input->post('password'), time() - (86400 * 30));
		                 
		            }

                $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">You are logged in successfully.</div>');
                if (empty($login_redirect)) {
                  
				redirect(base_url('front-customer-profile'));
                }else{
                    
                redirect($login_redirect);
                }
                } else {
                 $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">Something went wrong, please contact to admin.</div>');
				redirect($_SERVER['HTTP_REFERER']);
                }

			}else {
                    //Email id or password not match:
                    /* @ Redirect */
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">Invalid username or password. Please enter correct login credentials.</div>');
				redirect($_SERVER['HTTP_REFERER']);
                }
        }/*form_validation if closed*/
        }/* $this->input->post() closed*/
     
        else {
          $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">Something went wrong, please contact to admin.</div>');
				redirect($_SERVER['HTTP_REFERER']);
        }
       redirect($_SERVER['HTTP_REFERER']);
		
	}

		 public function customer_logout()
    {
    	//session_destroy();
    	
        $this->session->unset_userdata('CTMRPKID');
    	$this->session->unset_userdata('CTMRNAME');
        $this->session->unset_userdata('CTMREMAIL');
        $this->session->unset_userdata('CTMRPWD');
        $this->session->unset_userdata('CTMRMOBILE');
       
		//print_r($this->session->userdata());die;

		$this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">
                                                You are logged out successfully.
                                            </div>');
    	redirect(base_url('front-customer-login'));
    }

}