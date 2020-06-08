<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_notifications extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function view_notification(){
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
          $table="notifications";
          $updated_data = array(
              'read_status'=>'1', 
              // 'updatedBy' => $uid, 
              // 'updatedDate' => date('Y-m-d H:i:s'),
              // 'updated_ip_address' => $_SERVER['REMOTE_ADDR']
          );     
          $condition = array("status" => '1','fk_purohit_id'=>$uid);    
          $result = $this->Md_database->updateData($table, $updated_data,$condition);

          $table = "notifications";
          $orderby = 'pk_id DESC';
          $this->db->limit($limit, $offset);
          $condition = array('status' => '1','fk_purohit_id' =>$uid);
          $col = array('title','notification_datetime',"COALESCE(message,' ') as message",'redirecttype');
          $notification = $this->Md_database->getData($table, $col, $condition, $orderby, '');

          $resultarray = array('error_code' => '1','message'=>'Notification','get_notification'=> $notification);
          echo json_encode($resultarray);
          exit();   
      }else {
          $resultarray = array('error_code' => '2', 'message' => 'Uid or limit or offset is empty');
          echo json_encode($resultarray);
          exit();                     	
      } 
  }
  
  	function delete_notification(){
	     $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
	     if (!empty($uid)) {
	          $table = "registered_purohit";
	          $orderby = 'pk_id asc';
	          $condition = array('status' => '2', 'pk_id' => $uid);
	          $col = array('pk_id');
	          $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
	          if (!empty($checkUser)) {
	              $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
	              echo json_encode($resultarray);
	              exit();
	          }
	          $table="notifications";
	          $updated_data = array('status'=>'2', 
	          	  // 'updatedBy' => $uid, 
	             //  'updatedDate' => date('Y-m-d H:i:s'),
	             //  'updated_ip_address' => $_SERVER['REMOTE_ADDR']
	      		);     
	          $condition = array("status" => '1','fk_purohit_id'=>$uid);    
	          $result = $this->Md_database->updateData($table, $updated_data,$condition);                
	          $resultarray = array('error_code' => '1', 'uid'=>$uid ,'message' => 'Notifications  delete  successfully');             
	          echo json_encode($resultarray);
	          exit(); 
	     } else {
	          $resultarray = array('error_code' => '2', 'message' => 'Uid is empty');
	          echo json_encode($resultarray);
	          exit();                       
	    }
    }  

      public function check_read_unread(){
        $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
  
        if (!empty($uid)){
             $table = "registered_purohit";
            $orderby = 'pk_id asc';
            $condition = array('status' => '2', 'pk_id' => $uid);
            $col = array('pk_id');
            $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (!empty($checkUser)) {
                $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                echo json_encode($resultarray);
                exit();
            }            
            $table = "notifications";
            $orderby = 'pk_id desc';
            $condition = array('status' => '1','fk_purohit_id' => $uid);
            $col = array('pk_id,read_status');
            $read_status = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            $readStatus= !empty($read_status[0]['read_status'])?$read_status[0]['read_status']:''; 
            if (!empty($readStatus)) {       
                if ($readStatus == '1'){
                    $status='read';
                }elseif ($readStatus == '2'){
                    $status='unread';
                }  
           }  
            $resultarray = array('error_code' => '1','message'=>'read status','read_unread_status'=>!empty($readStatus)?$readStatus:'');
            echo json_encode($resultarray);  
            exit();       
        }else{
            $resultarray = array('error_code' => '2','message' => 'Uid is empty');
            echo json_encode($resultarray);
            exit();                       
        }  
    } 
}





