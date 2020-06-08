<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_customer_profile extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
    	/*Start::Get customer details*/
    $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
    if (empty($customerid)) {
    	redirect(base_url('front-customer-login'));
    }
       $this->db->select('pk_id,customer_name,customer_mobile_no,customer_email_id,status,customer_address,customer_city,customer_photo,customer_pincode');
       $this->db->from('customer_registration');
       $this->db->where('status','1');
       $this->db->where('pk_id',$customerid);
 		$data['customer_details'] = $this->db->get()->result_array();
 		/*End::Get customer details*/
 	
       $this->load->view('front/customer_profile/customer_profile',$data);
    }

public function customer_profile_action() {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
   		   $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('mobileno', 'Mobile', 'trim|required');
        // $this->form_validation->set_rules('event_location', 'Location', 'trim|required');
        // $this->form_validation->set_rules('event_city', 'City', 'trim|required');
    

        $name=!empty($this->input->post('name'))? ucwords($this->input->post('name')):'';
        $email=!empty($this->input->post('email'))? strtolower($this->input->post('email')):'';
        $mobileno=!empty($this->input->post('mobileno'))?$this->input->post('mobileno'):'';
        $location=!empty($this->input->post('event_location'))? ucwords($this->input->post('event_location')):'';
        $city=!empty($this->input->post('event_city'))? ucfirst($this->input->post('event_city')):'';
        $pincode=!empty($this->input->post('pincode'))?$this->input->post('pincode'):'';
        $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
// echo "<pre>";print_r($customerid);die();

       if ($this->form_validation->run() === FALSE) {
            
            $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">Field required.</div>');
            redirect($_SERVER['HTTP_REFERER']);
            exit();
        } else {
             $photoDoc = "";
         	if (!empty($_FILES['uploadphoto']['name'])) {
                $rename_name = uniqid(); //get file extension:
                $arr_file_info = pathinfo($_FILES['uploadphoto']['name']);
                $file_extension = $arr_file_info['extension'];
                $newname = $rename_name . '.' . $file_extension;
     			$old_name = $_FILES['uploadphoto']['name'];
             	$path = "upload/customer_profile/";

                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $upload_type = "jpg|png|jpeg";

                $photoDoc = $this->Md_database->uploadFile($path, $upload_type, "uploadphoto", "", $newname);

                  if (!empty($this->input->post('oldimg1'))) {
                    unlink(FCPATH . 'upload/customer_profile/' . $this->input->post('oldimg1'));
                }
            }
            $photoDoc = !empty($photoDoc) ? $photoDoc : $this->input->post('oldimg1');

            $update_data = array(
                'customer_name' => $name,
				        'customer_email_id' => $email,
                'customer_mobile_no' => $mobileno,
                'customer_city' => $city,
                'customer_address' => $location,
                'customer_pincode' => $pincode,
                'customer_photo' => $photoDoc,
    			     'updated_date'=>date('Y-m-d H:i:s'),
                'updated_by' => $customerid,
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']
            );

            $condition = array("pk_id" => $customerid);
            $ret = $this->Md_database->updateData('customer_registration', $update_data, $condition);

            if (!empty($ret)) {
            $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">Candidate profile details updated successfully. </div>');
              redirect(base_url() . 'front-customer-profile#');
             // redirect($_SERVER['HTTP_REFERER']);
            } else {
             $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">"Candidate profile details updated failed, please try again.</div>');
                   
             redirect($_SERVER['HTTP_REFERER']);
            }


        }
       
    }
    
}