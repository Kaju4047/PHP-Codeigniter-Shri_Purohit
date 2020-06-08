<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_setting extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
    $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
    if (empty($customerid)) {
    	redirect(base_url('front-customer-login'));
    }
       $this->db->select('pk_id,customer_name,customer_mobile_no,customer_email_id,status,customer_address,customer_city,customer_photo,customer_pincode');
       $this->db->from('customer_registration');
       $this->db->where('status','1');
       $this->db->where('pk_id',$customerid);
 		$data['customer_details'] = $this->db->get()->result_array();

       $this->load->view('front/setting/vw_setting',$data);
    }

        public function front_setting_action() {
    
        if (!empty($this->input->post())) {

// print_r($this->session->userdata('CTMRPWD'));die();
            $this->form_validation->set_rules('txtOldPass', 'old password', 'trim|required');
            $this->form_validation->set_rules('txtNewPass', 'new password', 'trim|required');
            $this->form_validation->set_rules('txtNewConfrmPass', 'confirm password', 'trim|required');
            /* [start::check old password is valid or not] */
            if (!empty($this->input->post('txtOldPass'))) {
                if ($this->input->post('txtOldPass') != $this->session->userdata('CTMRPWD')) {
                    $this->session->set_flashdata('error', 'Old password is wrong');
                    redirect($_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
            /* [end::check old password is valid or not] */
            /* [start::check old password and new is valid or not] */
            if (!empty($this->input->post('txtOldPass')) && !empty($this->input->post('txtNewPass'))) {
                if ($this->input->post('txtOldPass') == $this->input->post('txtNewPass')) {
                    $this->session->set_flashdata('error', 'Old and new password cannot not be same.');
                    redirect($_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
            /* [end::check old password and new is valid or not] */
            /* [start::check conform password and new is valid or not] */
            if (!empty($this->input->post('txtNewConfrmPass')) && !empty($this->input->post('txtNewPass'))) {
                if ($this->input->post('txtNewConfrmPass') != $this->input->post('txtNewPass')) {
                    $this->session->set_flashdata('error', 'New and confirm password must be same');
                    redirect($_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
            /* [end::check conform password and new is valid or not] */

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
                exit();
            } else {


                $update_data = array('customer_password' => $this->input->post('txtNewConfrmPass'));
                $upCondn = array('pk_id' => $this->session->userdata('CTMRPKID'));
                $ret = $this->Md_database->updateData('customer_registration', $update_data, $upCondn); //update status
            }
        }

        if (!empty($ret)) {
//unset user session data
        $this->session->unset_userdata('CTMRPKID');
    	$this->session->unset_userdata('CTMRNAME');
        $this->session->unset_userdata('CTMREMAIL');
        $this->session->unset_userdata('CTMRPWD');
        $this->session->unset_userdata('CTMRMOBILE');

    	$this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">Your password changed successfully. Please Login with new password.  </div>');
                                          
            redirect(base_url() . 'front-my-setting');
        } else {
        
         $this->session->set_userdata('msg', '<div class="alert alert-error ErrorsMsg">Password change failed, please try again.</div>');
            redirect(base_url() . 'front-my-setting');
        }
    }
    
}