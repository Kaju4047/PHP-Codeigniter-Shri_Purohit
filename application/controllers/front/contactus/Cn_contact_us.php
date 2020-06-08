<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_contact_us extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
        $data['orgdata'] = $this->Md_database->getData('static_organizationmaster', '*');
    

       $this->load->view('front/contactus/vw_contact_us',$data);
    }

     public function contact_send_email(){
         
        $fname = !empty($this->input->post('fname'))?$this->input->post('fname'):'';
        $lname = !empty($this->input->post('lname'))?$this->input->post('lname'):'';
        $email = !empty($this->input->post('email'))?$this->input->post('email'):'';
        $message = !empty($this->input->post('message'))?$this->input->post('message'):'';
        $subject = !empty($this->input->post('subject')) ? $this->input->post('subject') : '';
        $mob = !empty($this->input->post('mob'))?$this->input->post('mob'):'';
        
        $this->form_validation->set_rules('fname', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('mob', 'Mobile Number', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) {
           
        } else {
                $name=$fname.' '.$lname;

                $orgdata = $this->Md_database->getData('static_organizationmaster', '*');
                $orgemail = !empty($orgdata[0]['om_CmpEmail']) ? $orgdata[0]['om_CmpEmail'] : '';
            
                                    $insert_data = array(
                                    'first_name' => $fname,
                                    'last_name' => $lname,
                                    'username' => $name,
                                    'emailid' => $email,
                                    'subject' => $subject,
                                    'message' => $message,
                                    'mobile_no' => $mob,
                                    'user_type' => 'User',
                                    'status'=>1,
                                    'created_date'=>date('Y-m-d H:i:s'),
                                    'created_ip_address' => $_SERVER['REMOTE_ADDR'],
                                );
                                        
                                $ret = $this->Md_database->insertData('contactus', $insert_data);


               
                /*[start::send forgot mail] */
                $recipeinets = $orgemail;
                $from = array(
                    "email" => $email,
                    "name"=>$name
                );
                $subject = 'Contact Us';
                $reserved_words = array(
                    "||USER_NAME||" => ucwords($name),
                    "||SUBJECT||" => ucfirst($subject),

                    "||SITE_TITLE||" => SITE_TITLE,
                    "||EMAIL_ID||" => strtolower($email),
                    "||MESSAGE||" => ucfirst($message),
                    "||SITE_URL||" => base_url(),
                    "||YEAR||" => date('Y'),
                );
                $email_data = $this->Md_database->getEmailInfo('contact_us', $reserved_words);
                
               
                $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
                
                $message = 'Your enquiry has been sent successfully. We will contact to you soon.';
                $this->Md_database->sendSMS($message, $mob);
            
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Your enquiry has been sent successfully. We will contact to you soon.</div>');
       
        redirect(base_url().'front-contact-us');
            
 
       }

    }
}