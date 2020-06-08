<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_forgot_password extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
       

       $this->load->view('front/forgotpassword/vw_forgot_password');
    }

    public function forget_password_action() {
        //Post Data
        $fotgotemail = !empty($this->input->POST('email'))?$this->input->POST('email'):'';

        if (!empty($this->input->POST('email'))) {
            // SQL:: Get User Details
         $table = "customer_registration";
        $condition = array('customer_email_id' => $fotgotemail,'status' => '1');
        $user_details = $this->Md_database->getData($table, '*', $condition, '', '');

        $customer_name=!empty($user_details[0]['customer_name'])? ucfirst($user_details[0]['customer_name']):'';


          if (!empty($user_details)) {
                $token = substr((uniqid(rand(), true)), 0, 6);
                $password = 'SP' . $token;

                //SQL:: Update db
                $table = 'customer_registration';
                $data = array("customer_password" => $password);
                $condition = array("customer_email_id" => $fotgotemail);
                $this->Md_database->updateData($table, $data, $condition);

                /* [start::send forgot mail] */
                $recipeinets = $fotgotemail;
                $from = array(
                    "email" => SITE_MAIL,
                    "name" => SITE_TITLE
                );
                $reserved_words = array(
                    "||USER_NAME||" => $customer_name,
                    "||SITE_TITLE||" => SITE_TITLE,
                    "||EMAIL_ID||" => $fotgotemail,
                    "||PASSWORD||" => $password,
                    "||YEAR||" => date('Y'),
                    "||SITE_URL||" => base_url(),
                );
                $email_data = $this->Md_database->getEmailInfo('customer forgot password', $reserved_words);
                $subject = SITE_TITLE . '-' . !empty($email_data['subject']) ? $email_data['subject'] : "";
               // print_r($email_data);die;

                $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
              
                /* [end::send forgot mail] */
                //SQL:: update your password:-
                /* @ Redirect */
                if (!empty($ml)) {
                 

                    $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">
								    Your temporary password has been sent to your email successfully.
								</div>');
                      redirect(base_url() . 'front-customer-login');
                } else {
              $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                                                Your temporary password sending failed.
                                            </div>');

                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                //Email id or password not match:
                /* @ Redirect */
                
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                                                Please enter correct email.
                                            </div>');

                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            /* @ Redirect */
       
            $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                                                Please enter email id
                                            </div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}