<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_chat extends CI_Controller {

    public function chat_list() {
    	$purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $limit = !empty($this->input->post('limit')) ? $this->input->post('limit') : '';
        $offset = !empty($this->input->post('offset')) ? $this->input->post('offset') : '0';
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   

          $this->db->select('cm.pk_id,cm.fk_from_id,cm.fk_to_id,cm.message,created_date,fk_pooja_order_id');
          $this->db->from('chat_message cm');
          $this->db->where('status','1');
          $this->db->where('deleted_by',null);
          $this->db->group_start();
        	$this->db->where('fk_from_id',$purohit_id);
          $this->db->or_where('fk_to_id',$purohit_id);
          $this->db->group_end();
       		// $this->db->group_by('fk_to_id');
          // $this->db->group_by('fk_pooja_order_id');
       		$this->db->order_by('pk_id desc');
          $this->db->limit('1');
        	$chat_list_data=$this->db->get()->result_array();
		
// print_r($this->db->last_query());die();
			   $finalarray=array();
   			if (!empty($chat_list_data)) {
   				foreach ($chat_list_data as $key => $value) {
   					$fk_from_id=!empty($value['fk_from_id'])?$value['fk_from_id']:'';
   					$fk_to_id=!empty($value['fk_to_id'])?$value['fk_to_id']:'';

   					if ($purohit_id == $fk_from_id) {
   				 
   						$customer_id=$fk_to_id;

                     } else if ($purohit_id == $fk_to_id) {
   						$customer_id=$fk_from_id;

                    }
              $this->db->select('customer_photo,customer_name');
              $this->db->from('customer_registration');
              $this->db->where('pk_id',$customer_id); 
              $this->db->where('status',1);
              $customer_data = $this->db->get()->result_array();
              $value['customer_photo']=!empty($customer_data[0]['customer_photo'])?$customer_data[0]['customer_photo']:'';
              $value['customer_name']=!empty($customer_data[0]['customer_name'])?$customer_data[0]['customer_name']:'';

   //            $query = $this->db->query("SELECT * FROM purohit_chat_message WHERE fk_from_id=$fk_from_id and fk_to_id=$fk_to_id or fk_from_id=$fk_to_id and fk_to_id=$fk_from_id and status='1'");

   //            $chat_query=$query->result_array();
			// if (!empty($chat_query)){
			// 	$value['fk_from_id'] = !empty($chat_query[0]['fk_from_id'])?$chat_query[0]['fk_from_id']:'';
			// 	$value['fk_to_id'] = !empty($chat_query[0]['fk_to_id'])?$chat_query[0]['fk_to_id']:'';
			// 	$value['message'] = !empty($chat_query[0]['message'])?$chat_query[0]['message']:'';
			// }
						

              $finalarray[]=$value;
                          
   					
   				}
   			}

			// print_r($finalarray);die();
			$output= array_slice($finalarray,$offset,$limit);
            if (!empty($output)) {

                $resultarray = array('error_code' => '1','purohit_chat_list'=>$output,'profile_image'=>base_url().'upload/customer_profile/','message' => 'Chat List.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Chat List are empty."
                );
            }

            echo json_encode($resultarray);
            exit();


    	}
	}

	    public function chat_list_details() {
	    $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
    	$fk_from_id = !empty($this->input->post('fk_from_id')) ? $this->input->post('fk_from_id') : '';
        $fk_to_id = !empty($this->input->post('fk_to_id')) ? $this->input->post('fk_to_id') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : '';
        $limit = !empty($this->input->post('limit')) ? $this->input->post('limit') : '';
        $offset = !empty($this->input->post('offset')) ? $this->input->post('offset') : '0';
 
//login id =fk_from_id
         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   

          if (!empty($fk_from_id) && !empty($fk_to_id)) {
			$arraymsg=array();
		/*update status of read and unread message*/
            $update_status=array('to_read_unread' => '1'); 
            $condition=array('fk_from_id' => $fk_from_id,'fk_to_id'=>$fk_to_id);
            $res="";
            $res=$this->Md_database->updateData('chat_message',$update_status,$condition);

			/*update status of read and unread message*/

            $query = $this->db->query("SELECT * FROM purohit_chat_message WHERE (fk_from_id=$fk_from_id and fk_to_id=$fk_to_id and status=1 and  deleted_by IS NULL) or (fk_from_id=$fk_to_id and fk_to_id=$fk_from_id and status=1 and  deleted_by IS NULL) ORDER BY created_date DESC  LIMIT $limit OFFSET $offset  ");

			
            $arraymsg_result = $query->result_array();
            $count_ch = count($arraymsg_result);
            
            for($i = 0; $i<$count_ch; $i++)
            {
                $arraymsg_result[$i]['created_date'] = date('d-m-Y', strtotime($arraymsg_result[$i]['created_date'])).', '.date('h:i A', strtotime($arraymsg_result[$i]['created_date']));
            }
            
            //echo "<pre>"; print_r($arraymsg_result); die();
            $arraymsg= array_reverse($arraymsg_result);

// print_r($this->db->last_query());die();
            $queryforcount = $this->db->query("SELECT * FROM purohit_chat_message WHERE (fk_from_id=$fk_from_id and fk_to_id=$fk_to_id and status=1 and  deleted_by IS NULL) or (fk_from_id=$fk_to_id and fk_to_id=$fk_from_id and status=1 and  deleted_by IS NULL) ORDER BY created_date DESC");
            $queryfor_count = $queryforcount->result_array();
            $totalcount = count($queryfor_count);

            /*Start:: get customer details*/

              $this->db->select('customer_photo,customer_name,customer_address,customer_city');
              $this->db->from('customer_registration');
              $this->db->where('pk_id',$fk_to_id); 
              $this->db->where('status',1);
              $customer_data = $this->db->get()->result_array();
         
            /*End:: get customer details*/
              $this->db->select('pooja_status');
              $this->db->from('customer_pooja_order');
              $this->db->where('fk_user_id',$fk_to_id); 
              $this->db->where('pk_id',$pooja_order_id); 
              $this->db->where('status',1);
              $pooja_status_data = $this->db->get()->result_array();



            $this->db->select('fk_pooja_order_id,request_rejected_by');
            $this->db->from('rejected_order_by_purohit');
            $this->db->where('status','1');
            $this->db->where('fk_pooja_order_id',$pooja_order_id);
            $this->db->where('request_rejected_by',$purohit_id);
            $check_reject_req=$this->db->get()->result_array();
            $customer_details_array=array();
                if (!empty($check_reject_req)) {
                  $customer_details['reject_status']='Rejected';         
                    }else{
                       $customer_details['reject_status']='';  
                    }
// print_r($pooja_status_data);die();
 			$customer_details['customer_photo']=!empty($customer_data[0]['customer_photo'])?$customer_data[0]['customer_photo']:'';
 			$customer_details['customer_name']=!empty($customer_data[0]['customer_name'])?$customer_data[0]['customer_name']:'';
 			$customer_details['customer_address']=!empty($customer_data[0]['customer_address'])?$customer_data[0]['customer_address']:'';
 			$customer_details['customer_city']=!empty($customer_data[0]['customer_city'])?$customer_data[0]['customer_city']:'';
      $customer_details['pooja_status']=!empty($pooja_status_data[0]['pooja_status'])?$pooja_status_data[0]['pooja_status']:'';
      $customer_details_array[]=$customer_details;
 

        	}

			
            if (!empty($arraymsg) || !empty($customer_details_array)) {

                $resultarray = array('error_code' => '1','total_count' => $totalcount,'customer_chat_details'=>$arraymsg,'customer_details'=>$customer_details_array,'profile_image'=>base_url().'upload/customer_profile/', 'message' => 'Chat List Details.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Chat List Details are empty."
                );
            }

            echo json_encode($resultarray);
            exit();


    	}
	}
      public function chat_insert_action() {
      $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
      $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : '';
      $to_id = !empty($this->input->post('customer_id')) ? $this->input->post('customer_id') : '';
      $txtmsg = !empty($this->input->post('txtmsg')) ? $this->input->post('txtmsg') : '';
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   
            $msg_arr = array(
              'fk_pooja_order_id'=>$pooja_order_id,
              'fk_from_id'=>$purohit_id,
              'fk_to_id'=>$to_id,
              'message'=>$txtmsg,
              'status'=>'1',
              'created_date'=>date('Y-m-d H:i:s'),
              'created_by'=>$purohit_id,
              'created_ip_address'=>$_SERVER['REMOTE_ADDR']
            );

            $data = $this->Md_database->insertData('chat_message', $msg_arr);
   

 
            if (!empty($data)) {

                $resultarray = array('error_code' => '1','message' => 'Chat inserted sucessfully.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Fail."
                );
            }

            echo json_encode($resultarray);
            exit();


      }
  }

      public function chat_clear() {
      $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
      $customer_id = !empty($this->input->post('customer_id')) ? $this->input->post('customer_id') : '';
      $puja_order_id = !empty($this->input->post('puja_order_id')) ? $this->input->post('puja_order_id') : '';
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
  
        
          $this->db->group_start();                          
          $this->db->where("(fk_from_id=$purohit_id AND fk_to_id=$customer_id)");
          $this->db->or_where("(fk_from_id=$customer_id AND fk_to_id=$purohit_id)");
          $this->db->group_end();
          $condition1 = array('fk_pooja_order_id' => $puja_order_id);
          $update_deleted_by['deleted_by']=$purohit_id;
          $ret=$this->Md_database->updateData('chat_message',$update_deleted_by,$condition1);

            if (!empty($ret)) {

                $resultarray = array('error_code' => '1','message' => 'Chat List Deleted Successfully.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Fail."
                );
            }

            echo json_encode($resultarray);
            exit();


      }
  }

}