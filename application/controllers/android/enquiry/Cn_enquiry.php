<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_enquiry extends CI_Controller {
        function send_enquiry(){
            $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
            $subject = !empty($this->input->post('subject')) ? $this->input->post('subject') : '';
            $message = !empty($this->input->post('message')) ? $this->input->post('message') : '';
            if (!empty($uid) || !empty($subject) || !empty($message) ){
                $table = "registered_purohit";
                $orderby = 'pk_id asc';
                $condition = array('status' => '2', 'pk_id' => $uid);
                $col = array('pk_id');
                $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
                if (!empty($checkUser)){
                    $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                    echo json_encode($resultarray);
                    exit();
                }
                $insert_data = array(
                    'subject' => $subject,
                    'message' => $message,
                    'fk_purohit_id' => $uid,
                    'user_type' => 'Purohit',
                    'status'=>1,
                    'created_date'=>date('Y-m-d H:i:s'),
                    'created_ip_address' => $_SERVER['REMOTE_ADDR'],
                );                       
                $ret = $this->Md_database->insertData('contactus', $insert_data);                 
                $resultarray = array('error_code' => '1','message'=>'Enquiry sent Successfully');
                echo json_encode($resultarray);
                exit();   
            }else {
                $resultarray = array('error_code' => '2', 'message' => 'Uid or subject or message is empty');
                echo json_encode($resultarray);
                exit();                       
            } 
        }
        
        function enquiry_list(){
            $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
            $limit = !empty($this->input->post('limit')) ? $this->input->post('limit') : '';
            $offset = !empty($this->input->post('offset')) ? $this->input->post('offset') : '';
            if (!empty($uid) || !empty($limit) || !empty($offset)){
                $table = "registered_purohit";
                $orderby = 'pk_id asc';
                $condition = array('status' => '2', 'pk_id' => $uid);
                $col = array('pk_id');
                $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
                if (!empty($checkUser)){
                    $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                    echo json_encode($resultarray);
                    exit();
                }
                $table = "contactus";
                $orderby = 'id DESC';
                $this->db->limit($limit, $offset);
                $condition = array('fk_purohit_id' => $uid);
                $col = array('id','subject','message','status','created_date');
                $enquiryDetails = $this->Md_database->getData($table, $col, $condition, $orderby, '');
                  
                $resultarray = array('error_code' => '1','message'=>'Enquiry List','enquiry_list'=> $enquiryDetails);
                echo json_encode($resultarray);
                exit();   
            }else {
                $resultarray = array('error_code' => '2', 'message' => 'Uid or limit or offset is empty');
                echo json_encode($resultarray);
                exit();                       
            } 
        }

        public function incentive_list(){
            $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
            $limit = !empty($this->input->post('limit')) ? $this->input->post('limit') : '';
            $offset = !empty($this->input->post('offset')) ? $this->input->post('offset') : '';
            if (!empty($uid) || !empty($limit) || !empty($offset)){
                $table = "registered_purohit";
                $orderby = 'pk_id asc';
                $condition = array('status' => '2', 'pk_id' => $uid);
                $col = array('pk_id');
                $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
                if (!empty($checkUser)){
                    $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                    echo json_encode($resultarray);
                    exit();
                }

                $table = "purohit_customer_pooja_order";
                $orderby = 'pk_id DESC';
                $this->db->limit($limit,$offset);
                $condition = array('status' =>'1');
                $col = array('pk_id','created_date','incentive_amount');
                $incentiveList = $this->Md_database->getData($table, $col, $condition, $orderby,'');
                  
                $resultarray = array('error_code' => '1','message'=>'Incentive List','incentiveList'=> $incentiveList);
                echo json_encode($resultarray);
                exit();   
            }else{
                $resultarray = array('error_code' => '2', 'message' => 'Uid or limit or offset is empty');
                echo json_encode($resultarray);
                exit();                       
            } 
        }
}
  