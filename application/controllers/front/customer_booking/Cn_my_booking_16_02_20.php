<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_my_booking extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
       

       $this->load->view('front/customer_booking/my_booking');
    }
    
    public function get_booking_listing()
    {
        /*Start::get listing of job with scroll pagenation*/
        $offset = !empty($this->input->post('offset')) ? $this->input->post('offset') : '0';
        // print_r($offset);die();
        $limit=5;
        $data=array();
        $html="";
        $data['html']=array();
        
       $cust_session_id=$this->session->userdata('CTMRPKID');

   		$this->db->select('pcr.pk_id as c_id, pcr.customer_name, pp.pooja_name, pcpo.fk_pooja_id,pcpo.pk_id as order_id, pcpo.fk_package_id, pcpo.pooja_date, pcpo.pooja_time, pcpo.pooja_address,pooja_status, pcpo.pooja_area,pcpo.pooja_order_status,pcpo.created_date,fk_purohit,admin_purohit_assign_status');
   		$this->db->from('purohit_customer_registration as pcr');
   		$this->db->join('purohit_customer_pooja_order as pcpo', 'pcpo.fk_user_id = pcr.pk_id');
   		$this->db->join('purohit_pooja as pp', 'pp.pk_id = pcpo.fk_pooja_id');
   		$this->db->where('pcr.status', 1);
   		$this->db->where('pcpo.status', 1);
   		$this->db->where('pcr.pk_id', $cust_session_id);
   		$this->db->order_by('pcpo.pk_id', 'DESC');
   		$this->db->limit($limit,$offset);
   		$posted_job_list_data = $this->db->get()->result_array();

      // print_r($posted_job_list_data);die();
           $finalarray=array();
        if(!empty($posted_job_list_data))
        {
          foreach ($posted_job_list_data as $key => $value) 
          {
         
            $purohit_id=!empty($value['fk_purohit'])?$value['fk_purohit']:'';
             
           


              $this->db->select('first_name,middle_name,last_name,mobile_no,upload_profile_Image');
              $this->db->from('registered_purohit');
              $this->db->where('pk_id',$purohit_id); 
              $this->db->where('status',1);
              $purohit_data = $this->db->get()->result_array();
              $first_name=!empty($purohit_data[0]['first_name'])?$purohit_data[0]['first_name']:'';
              $middle_name=!empty($purohit_data[0]['middle_name'])?$purohit_data[0]['middle_name']:'';
              $last_name=!empty($purohit_data[0]['last_name'])?$purohit_data[0]['last_name']:'';
              $value['purohit_name']=$first_name.' '.$middle_name.' '.$last_name;
              $value['mobile_no']=!empty($purohit_data[0]['mobile_no'])?$purohit_data[0]['mobile_no']:'';
              $value['upload_profile_Image']=!empty($purohit_data[0]['upload_profile_Image'])?$purohit_data[0]['upload_profile_Image']:'';
      
            $this->db->select('fk_pooja_order_id,request_cancelled_by');
            $this->db->from('cancelled_order_by_purohit');
            $this->db->where('status','1');
            $this->db->where('fk_pooja_order_id',$value['order_id']);
            $check_cancelled_req_by_purohit=$this->db->get()->result_array();

                if (!empty($check_cancelled_req_by_purohit)) {
                  $value['cancelled_by_purohit']='Cancelled by purohit searching new purohit';         
                  

                    }else{
                       $value['cancelled_by_purohit']='';  
                    }
            

              $finalarray[]=$value;
          }
        }
        $pooja_listing=$finalarray;
   // echo "<pre>";		print_r($pooja_listing);die();
        $i=1;

      	if(!empty($pooja_listing))
      	{
       		foreach ($pooja_listing as $key => $value) 
       		{
		        
          $html.='<div class="box-shadow mb-3">';
          $html.='<div class="puja-box">';
          $html.='<div class="row border-bottm">';
          $html.='<div class="col-md-8 col-sm-6 col-6">';
          $html.='<div class="order-cont mb-1">';
          $html.='<h5>Puja Id :</h5>';
          $html.='<span class="view-cnt">SP'.$value['order_id'].'</span>';
          $html.='</div>';
          $html.='</div>';
          $html.='<div class="col-md-4 col-sm-6 col-6">';
          $html.='<div class="order-cont mb-1 float-right">';
              if($value['fk_purohit']=='' && $value['cancelled_by_purohit']=='' && $value['pooja_status']!='3' && $value['pooja_status']!='4' && $value['pooja_status']!='2')
                    { $setText="Pending";} 
             
                elseif(!empty($value['fk_purohit']) && $value['pooja_status']!='3' && $value['pooja_status']!='4' && $value['pooja_status']!='2')
                    { $setText="Confirmed";}
                elseif($value['pooja_status']=='2')
                    { $setText="Completed";}
                elseif(!empty($value['cancelled_by_purohit']))
                    { $setText="Cancelled by purohit searching new purohit";}
                elseif($value['pooja_status']=='3' || $value['pooja_status']=='4')
                    { $setText="Cancelled";}
               
            


          $html.='<span class="view-cnt">'.$setText.'</span>';
          $html.='</div>';
          $html.='</div>';
          $html.='<div class="col-md-12">';
          $html.='<div class="order-cont mb-1">';
          $html.='<h5><i class="fa fa-calendar"></i></h5>';
          $html.='<span class="view-cnt">'.date('j M Y', strtotime($value['created_date'])).'</span>';
          $html.='</div>';
          $html.='</div>';
          $html.='</div>';
          $html.='<hr class="hr-sm">';
          $html.='<div class="row">';
          $html.='<div class="col-md-8 col-6">';
          $html.='<div class="order-cont mb-1">';
          $html.='<h5>Puja Name :</h5>';
          $html.='<span class="view-cnt">'.$value['pooja_name'].'</span>';
          $html.='</div>';
          $html.='</div>';
          $html.='<div class="col-md-4 col-6">';
          $html.='<div class="order-cont mb-1 float-right ml-2">';
          $html.='<h5><i class="fa fa-clock-o"></i></h5>';
          $html.='<span class="view-cnt">'.date('g:i A',strtotime($value['pooja_time'])).'</span>';
          $html.='</div>';
          $html.='<div class="order-cont mb-1 float-right">';
          $html.='<h5><i class="fa fa-calendar"></i></h5>';
          $html.='<span class="view-cnt">'.date('j M Y', strtotime($value['pooja_date'])).'</span>';
          $html.='</div>';

          $html.='</div>';
          $html.='<div class="col-md-8 col-12 ">';
          $html.='<div class="order-cont">';
          $html.='<h5><i class="fa fa-map-marker"></i></h5>';
          $html.='<span class="view-cnt">'.$value['pooja_area'].'</span>';
          $html.='</div>';
          $html.='</div>';
          $html.='</div>';
          $html.='</div>';
            $profile_pic= !empty($value['upload_profile_Image']) ? base_url().'upload/android/registartion/purohit_profile/'.$value['upload_profile_Image']:base_url().'AdminMedia/images/photo.png';
          $html.='<div class="order-box">';
          $html.='<div class="row">';
          if(!empty($value['fk_purohit'])){
          $html.='<div class="col-md-8 col-8">';
          $html.=' <div class="purohit-box">';
          $html.='<div class="order-cont">';
          $html.='<img src="'.$profile_pic.'">';
          $html.='<div>';
          $html.='<h5>'.$value['purohit_name'].'</h5>';

          $html.='<span>('.$value['mobile_no'].')</span>';
          $html.='</div>';
          $html.='</div>';
          $html.='</div>';
          $html.='</div>';
            }
          $html.='<div class="col-md-12 col-12">';
          $html.='<div class="order-cont sm-float-left order-bttn">';
          $html.='<a href="'.base_url().'front-order-view/'.$value['order_id'].'"><button class="btn btn-order">View Order</button></a>';
          $html.='</div>';
          $html.='</div>';
          $html.='</div>';
          $html.='</div>';
        
           $html.=' </div>';
       			$i++;	
       		}/*closed foreach*/
       	}/*closed if*/
       	elseif($offset=="0")
       	{

       		$html.='<h5>No match found.</h5>';
       	}

       	$offset = (!empty($posted_job_list_data)) ? $offset + count($posted_job_list_data) : $offset;

       	$data['offset'] = $offset;
       	$data['html']=$html;
	    
       	echo json_encode($data);
       	/*End::company posted jobs listing*/
    }/*End::get listing of job with scroll pagenation (closing-getjoblisting)*/

public function order_view($order_id) 
{
      	 /*Start:: pooja order details*/
	 
   
   $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
    
    $this->db->select("o.fk_purohit,o.fk_user_id,o.pk_id as order_id,pkg.pk_id as pkg_id,o.created_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,first_name,middle_name,last_name,mobile_no,upload_profile_Image,city_name,address,pooja_status,admin_purohit_assign_status,p.pk_id as puja_id,A.pk_id as purohit_id,puja_completed_by,cancellation_charges");
    $this->db->from('customer_pooja_order as o');
    $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
    $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
    $this->db->join('purohit_registered_purohit as A','A.pk_id=o.fk_purohit','left');
   	$this->db->where('p.status','1');
    $this->db->where('o.status','1');
    $this->db->where('o.pk_id',$order_id);
    $order_view_data=$this->db->get()->result_array();

  // echo "<pre>";print_r($order_view_data);die();
  
	   $finalarray=array();

  // echo "<pre>";print_r($order_view_data);die();
    if (!empty($order_view_data)) {
    	foreach ($order_view_data as $key => $value) {


          if (!empty($value['fk_purohit'])) {

               $assign_purohit_id=!empty($value['fk_purohit'])?$value['fk_purohit']:'';
              
               $order_id=!empty($value['order_id'])?$value['order_id']:'';

              $this->db->select('first_name,middle_name,last_name,mobile_no,upload_profile_Image,city_name,address,purohit_latitude,purohit_longitude');
              $this->db->from('registered_purohit');
              $this->db->where('pk_id',$assign_purohit_id); 
              $this->db->where('status',1);
              $assign_purohit_data = $this->db->get()->result_array();


              $first_name=!empty($assign_purohit_data[0]['first_name'])?$assign_purohit_data[0]['first_name']:'';
              $middle_name=!empty($assign_purohit_data[0]['middle_name'])?$assign_purohit_data[0]['middle_name']:'';
              $last_name=!empty($assign_purohit_data[0]['last_name'])?$assign_purohit_data[0]['last_name']:'';
              $value['assign_purohit_name']=$first_name.' '.$middle_name.' '.$last_name;
              $value['assign_mobile_no']=!empty($assign_purohit_data[0]['mobile_no'])?$assign_purohit_data[0]['mobile_no']:'';
              $value['assign_upload_profile_Image']=!empty($assign_purohit_data[0]['upload_profile_Image'])?$assign_purohit_data[0]['upload_profile_Image']:'';
              $value['assign_city_name']=!empty($assign_purohit_data[0]['city_name'])?$assign_purohit_data[0]['city_name']:'';
              $value['assign_address']=!empty($assign_purohit_data[0]['address'])?$assign_purohit_data[0]['address']:'';
              $value['purohit_latitude']=!empty($assign_purohit_data[0]['purohit_latitude'])?$assign_purohit_data[0]['purohit_latitude']:'';
              $value['purohit_longitude']=!empty($assign_purohit_data[0]['purohit_longitude'])?$assign_purohit_data[0]['purohit_longitude']:'';
              }

            $this->db->select('fk_pooja_order_id,request_cancelled_by');
            $this->db->from('cancelled_order_by_purohit');
            $this->db->where('status','1');
            $this->db->where('fk_pooja_order_id',$value['order_id']);
            $check_cancelled_req_by_purohit=$this->db->get()->result_array();

                if (!empty($check_cancelled_req_by_purohit)) {
                  $value['cancelled_by_purohit']='Cancelled by purohit searching new purohit';         
                  

                    }else{
                       $value['cancelled_by_purohit']='';  
                    }
    
            

    $services_exclusive=array();

  	$this->db->select('ac.service_name');
    $this->db->from('package_services as ps');
    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
    $this->db->where('fk_package',$value['pkg_id']);
    $this->db->where('ps.status','1');
    $this->db->where('ac.status','1');
    $this->db->where('ps.service_type','1');
    $services_inclusive=$this->db->get()->result_array();

    $this->db->select('services_charges,fk_services_id');
    $this->db->from('customer_package_services as ps');
    $this->db->join('package_services ac','ac.fk_services=ps.fk_services_id');
    $this->db->where('fk_package',$value['pkg_id']);
    $this->db->where('ps.fk_pooja_order_id',$value['order_id']);
    $this->db->where('ps.status','1');
    $this->db->where('ac.status','1');
    $this->db->where('ac.service_type','2');
    $services_exclusive_data=$this->db->get()->result_array();
    if (!empty($services_exclusive_data)) {

    foreach ($services_exclusive_data as $key => $row) {
      
    $this->db->select('A.service_name');
    $this->db->from('master_additional_services as A');
    $this->db->where('A.pk_id',$row['fk_services_id']);
    $this->db->where('A.status','1');
    $services_exclusive_name=$this->db->get()->result_array();

    $row['servicename']=!empty($services_exclusive_name[0]['service_name'])?$services_exclusive_name[0]['service_name']:'';
    $services_exclusive[]=$row;
      }
    }



 // echo "<pre>";print_r($finalarray2);die();

    $value['inclusive']=$services_inclusive;
    $value['exclusive']=$services_exclusive;

     $finalarray[]=$value;

    	}
    }
    $data['pooja_order_view']=$finalarray;
    
    /*Start::customer pooja rating show*/

    $this->db->select('rating,comment');
    $this->db->from('customer_rating');
    $this->db->where('fk_customer_id',$customerid);
    $this->db->where('fk_pooja_order_id',$order_id);
    $this->db->where('status','1');
    $data['customer_rating_data']=$this->db->get()->result_array();
  /*End::customer pooja rating show*/

    $this->db->select('bank_name,account_number,ifsc_code,acc_holder_name,branch_name,refund_status');
    $this->db->from('refund_request');
    $this->db->where('fk_customer_id',$customerid);
    $this->db->where('fk_pooja_order_id',$order_id);
    $this->db->where('status','1');
    $data['customer_refund_data']=$this->db->get()->result_array();
      /*Close:: pooja order details*/  
        // echo "<pre>";print_r($data['pooja_order_view']);die();

       $this->load->view('front/customer_booking/vw_order_view',$data);
    }

       public function pooja_update_action(){
        // echo "<pre>"; print_r($_POST);die();

    $this->form_validation->set_rules('poojadate', 'Pooja Date', 'trim|required');
    $this->form_validation->set_rules('address', 'Pooja address', 'trim|required');
    $this->form_validation->set_rules('area', 'area', 'trim|required');
  
    // $this->form_validation->set_rules('poojatime', 'Pooja Time', 'trim|required');
    if ($this->form_validation->run() === FALSE) {
         $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
            Please enter all details.
        </div>');
         redirect($_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $pooja_date = !empty($this->input->post('poojadate')) ? date('Y-m-d', strtotime($this->input->post('poojadate'))) :'';
   
        $pooja_time=!empty($this->input->post('poojatime'))? $this->input->post('poojatime'):'';
        $pooja_address=!empty($this->input->post('address'))? $this->input->post('address'):'';
        $area=!empty($this->input->post('area'))? $this->input->post('area'):'';
        $pooja_order_id=!empty($this->input->post('pooja_order_id'))? $this->input->post('pooja_order_id'):'';
    
       
        $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
    if (empty($customerid)) {

    $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
            Please Login.
        </div>');
    redirect(base_url('front-customer-login'));
  

    }

        $update_data = array(
            'fk_user_id'=>$customerid,
            'pooja_date'=>$pooja_date,
            'pooja_time'=>$pooja_time,
            'pooja_address'=>$pooja_address,
            'pooja_area'=>$area,
            'status'=>'1',
            'updated_date'=>date('Y-m-d H:i:s'),
            'updated_by'=>$customerid,
            'updated_ip_address'=>$_SERVER['REMOTE_ADDR'],
        );

            // print_r($inserted_data);die();

        
      $condition=array('pk_id'=>$pooja_order_id);
         $ret = $this->Md_database->updateData('customer_pooja_order', $update_data,$condition,'');
        

        if (!empty($ret)) {
            // $this->session->set_flashdata('success', "Pooja $actionMsg successfully.");
              $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">
            Puja updated successfully.
        </div>');
           redirect($_SERVER['HTTP_REFERER']);
        } else {
            // $this->session->set_flashdata('error', "Pooja  $actionMsg failed, please try again.");
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
            Pooja $actionMsg successfully.
        </div>');
                 redirect($_SERVER['HTTP_REFERER']);
        }
    }

    }
public function chat_msg_action(){

    $userId = $this->session->userdata('CTMRPKID');
    $customer_name = !empty($this->session->userdata('CTMRNAME'))?$this->session->userdata('CTMRNAME'):'';

    $from_id_set = $userId;
    $to_id_set = !empty($this->input->post('to_id_set'))? $this->input->post('to_id_set'):'';
    $order_id_set = !empty($this->input->post('order_id_set'))? $this->input->post('order_id_set'):'';
    $txtmsg = !empty($this->input->post('txtmsg'))? $this->input->post('txtmsg'):'';

    $msg_arr = array(
      'fk_pooja_order_id'=>$order_id_set,
      'fk_from_id'=>$from_id_set,
      'fk_to_id'=>$to_id_set,
      'message'=>$txtmsg,
      'status'=>'1',
      'created_date'=>date('Y-m-d H:i:s'),
      'created_by'=>$from_id_set,
      'created_ip_address'=>$_SERVER['REMOTE_ADDR']
    );

    $data = $this->Md_database->insertData('chat_message', $msg_arr);

      $this->db->select('token,pk_id');
      $this->db->from('registered_purohit');
      $this->db->where('status', 1);
      $this->db->where('pk_id', $to_id_set);
      $purohit_data = $this->db->get()->result_array();
      $target=!empty($purohit_data[0]['token'])?$purohit_data[0]['token']:'';
      $purohit_id=!empty($purohit_data[0]['pk_id'])?$purohit_data[0]['pk_id']:'';

      if (!empty($purohit_id)) {
             
              $message='You have received a new message from '.$customer_name;
              $subject='you have new message';
              $resultarray = array('message' => $message,'title'=>$subject,'redirecttype' =>'chat_insert','customer_id'=>$userId,'pooja_order_id'=>$order_id_set);                    
              $this->Md_database->sendPushNotification($resultarray,$target);

              $data = array( 
                  'fk_pooja_order_id'=>$order_id_set,
                  'fk_purohit_id' => $purohit_id ,
                  'redirecttype' => 'chat_insert',
                  'title' => $subject,
                  'message'=>$message,
              );
              $this->db->insert('notifications', $data);
      }

    $response = array('last_id' => $data, 't_user' => $userId,'usr_name' => $this->session->userdata('CTMRNAME'), 'chat' => array(array('from' => $userId, 'message' => $txtmsg,'created_date'=>date('Y-m-d H:i:s'))));

    echo json_encode($response);
  }

  public function get_chat()
    {

      $param = array();
      $wh = array();

        $param['user_id'] = $this->input->post('user_id');
        $param['order_id'] = $this->input->post('order_id');
        $param['login_id'] = $this->session->userdata('CTMRPKID');

        if($this->input->post('first_id') != 0) {
          $wh['pk_id <'] = $this->input->post('first_id');
        }

        $chats = $this->get_chat_list($wh,$param);

        $last_id = (isset($chats[0]['id'])) ? $chats[0]['id'] : 0;
        array_multisort(array_column($chats, "id"), SORT_ASC, $chats);
        $first_id = (isset($chats[0]['id'])) ? $chats[0]['id'] : 0;

        $response = array('last_id' => $last_id, 'first_id' => $first_id, 'chat' => $chats,'usr_name' => $this->session->userdata('CTMRNAME'), 't_user' => $this->session->userdata('CTMRPKID'));
        echo json_encode($response);
    }

    public function new_messages(){

      $userId = $this->session->userdata('CTMRPKID');

      $param = array(); $wh = array();

      $param['user_id'] = $this->input->post('user_id');
      $param['order_id'] = $this->input->post('order_id');
        $param['login_id'] = $this->session->userdata('CTMRPKID');

        if($this->input->post('last_id') != 0) {
          $wh['pk_id >'] = $this->input->post('last_id');
        }

      $chat = $this->get_chat_list($wh,$param);
      $last_id = (isset($chat[0]['id'])) ? $chat[0]['id'] : 0;

      $response = array('last_id' => $last_id, 't_user' => $userId,'usr_name' => $this->session->userdata('CTMRNAME'), 'chat' => $chat);

      echo json_encode($response);
    }
/*Start::get chat data from chat_message table*/
  public function get_chat_list($wh = array(),$param = array()){

    $this->db->select('cm.pk_id as id,cm.fk_from_id as from,cm.fk_to_id as to,cm.message,created_date')
      ->from('chat_message cm');

      if(count($wh) > 0) {
        $this->db->where($wh);
      }
      $this->db->where('fk_pooja_order_id',$param['order_id']);
      $this->db->group_start()
        
        ->where('fk_from_id',$param['user_id'])
        ->or_where('fk_to_id',$param['user_id'])
        ->group_end();
      $this->db->group_start()

        ->where('fk_to_id',$param['login_id'])
        ->or_where('fk_from_id',$param['login_id'])
      ->group_end();

      $this->db->order_by('pk_id','DESC')
        ->limit(10);

    $chat = $this->db->get();
    $data = $chat->result_array();
    
    return $data;
  }
 /*Close::get chat data from chat_message table*/   

 public function rating_action()
    {
        // echo "<pre>";
        // print_r($_POST);die();
      $comment=!empty($this->input->post('txtcomment'))?$this->input->post('txtcomment'):'';
      $fk_prurohit_id=!empty($this->input->post('puja_completed_by'))?$this->input->post('puja_completed_by'):'';
      $puja_id=!empty($this->input->post('puja_id'))?$this->input->post('puja_id'):'';
      $rating=!empty($this->input->post('rating'))?$this->input->post('rating'):'';
      $pooja_order_id=!empty($this->input->post('pooja_order_id'))?$this->input->post('pooja_order_id'):'';
      $customerid = $this->session->userdata('CTMRPKID');
         $inserted_data = array(
                'fk_puja_id' =>$puja_id ,
                'fk_prurohit_id' =>$fk_prurohit_id ,
                'comment' =>$comment ,
                'fk_customer_id'=> $customerid,
                'fk_pooja_order_id'=> $pooja_order_id,
                'rating'=> $rating,
                'created_by' => $customerid,
                'created_date'=> date('Y-m-d H:i:s'),
                'rating'=>$rating,

               
               );

       $ret = $this->Md_database->insertData('customer_rating', $inserted_data,'','','');
          if (!empty($ret)) {
       
         $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">
            Rating done successfully.
        </div>');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
              
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
             Rating failed, please try again.
        </div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
    }
     public function customer_cancel_pooja_order()
    {
        // echo "<pre>";
        // print_r($_POST);die();
     // echo date('Y-m-d h:i', strtotime("-48 hours"));
      $puja_order_id=!empty($this->input->post('puja_order_id'))?$this->input->post('puja_order_id'):'';
      $puja_pkg_ammount=!empty($this->input->post('puja_pkg_ammount'))?$this->input->post('puja_pkg_ammount'):'';
      $customerid = !empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
      $customer_email_id=!empty($this->session->userdata('CTMREMAIL'))?$this->session->userdata('CTMREMAIL'):'';
      $customer_mobile_no=!empty($this->session->userdata('CTMRMOBILE'))?$this->session->userdata('CTMRMOBILE'):'';
      $customer_name=!empty($this->session->userdata('CTMRNAME'))?$this->session->userdata('CTMRNAME'):'';

      $this->db->select('fk_purohit,admin_purohit_assign_status,pooja_date,pooja_time,pooja_address,pooja_city,pooja_name');
      $this->db->from('customer_pooja_order as A');
      $this->db->join('pooja as B', 'B.pk_id=A.fk_pooja_id');
      $this->db->where('A.status', 1);
      $this->db->where('A.fk_user_id', $customerid);
      $this->db->where('A.pk_id', $puja_order_id);
      $accept_assign_purohit = $this->db->get()->result_array();

    $pooja_name=!empty($accept_assign_purohit[0]["pooja_name"])? ucwords($accept_assign_purohit[0]["pooja_name"]):'';
    $pooja_address=!empty($accept_assign_purohit[0]["pooja_address"])? ucwords($accept_assign_purohit[0]["pooja_address"]):'';
    $city=!empty($accept_assign_purohit[0]["pooja_city"])?$accept_assign_purohit[0]["pooja_city"]:'';
    $date_of_puja=!empty($accept_assign_purohit[0]["pooja_date"])?$accept_assign_purohit[0]["pooja_date"]:'';
    $time_of_puja=!empty($accept_assign_purohit[0]["pooja_time"])?$accept_assign_purohit[0]["pooja_time"]:'';
    $purohit_id=!empty($accept_assign_purohit[0]["fk_purohit"])?$accept_assign_purohit[0]["fk_purohit"]:'';

    $puja_data_before48=date('Y-m-d', strtotime($date_of_puja . " -48 hours"));
    $puja_time_before48=date('H:i A', strtotime($time_of_puja . " -48 hours"));
    $data_time_for_cancellation=$puja_data_before48.' '.$puja_time_before48;
    $current_time = date('Y-m-d H:i A');
    $fine_for_cancel=0;
// echo "<pre>";print_r($data_time_for_cancellation);die();
if(date($current_time) > date($data_time_for_cancellation)){
    $this->db->select('cancellation_charges');
    $this->db->from('master_cancellation_charges');
    $this->db->where('status','1');
    $this->db->limit('1');
    $this->db->order_by('pk_id','desc');
    $cancellation_charges_data=$this->db->get()->result_array();
    // print_r($this->db->last_query());die();
  

     $cancellation_percent=!empty($cancellation_charges_data[0]['cancellation_charges']) ?$cancellation_charges_data[0]['cancellation_charges']:'';
     $fine_for_cancel=$puja_pkg_ammount*($cancellation_percent/100);
  }
  // print_r($fine_for_cancel);die();

         $update_data = array(
                'cancelled_by' => $customerid,
                'cancelled_date_time'=> date('Y-m-d H:i:s'),
                'pooja_status'=>'4',
                'cancellation_charges'=>$fine_for_cancel,
                'cancellation_type'=>'1',
                );
      $condition=array('pk_id'=>$puja_order_id);
      $ret = $this->Md_database->updateData('customer_pooja_order', $update_data,$condition);

      
      $this->db->select('token,pk_id');
      $this->db->from('registered_purohit');
      $this->db->where('status', 1);
      $this->db->where('pk_id', $purohit_id);
      $purohit_data = $this->db->get()->result_array();
      $target=!empty($purohit_data[0]['token'])?$purohit_data[0]['token']:'';
   
      

      if (!empty($purohit_id)) {
             
              $message='The '.$pooja_name.' event for the date '.date('d-m-Y',strtotime($date_of_puja)). ', time '.$time_of_puja.', '.$pooja_address.', '.$city.' is canceled by user ' .ucwords($customer_name);
              $subject='Puja Cancelled by User';
              $resultarray = array('message' => $message,'title'=>$subject,'redirecttype' =>'cancelled');                    
              $this->Md_database->sendPushNotification($resultarray,$target);

              $data = array( 
                  'fk_pooja_order_id'=>$puja_order_id,
                  'fk_purohit_id' => $purohit_id ,
                  'redirecttype' => 'cancelled',
                  'title' => $subject,
                  'message'=>$message,
              );
              $this->db->insert('notifications', $data);
      }




      /*End::Start msg & mail send to admin*/
      $this->db->select('om_CmpMobile,om_CmpEmail');
      $this->db->from('static_organizationmaster');
      $org_data = $this->db->get()->result_array();
      $admin_mob_number=!empty($org_data[0]['om_CmpMobile'])?$org_data[0]['om_CmpMobile']:'';
      $orgemail=!empty($org_data[0]['om_CmpEmail'])?$org_data[0]['om_CmpEmail']:'';
      $message = 'Customer cancelled order'.$puja_order_id;
      $this->Md_database->sendSMS($message, $admin_mob_number);

                $recipeinets = $orgemail;
                $from = array(
                    "email" => $customer_email_id,
                    "name"=>ucwords($customer_name)
                );
                $subject = 'Puja Cancelled by User';
             
                $admin_msg = 'The '.$pooja_name.' event for the date '.date('d-m-Y',strtotime($date_of_puja)). ', time '.$time_of_puja.', '.$pooja_address.', '.$city.' is cancelled by user '.ucwords($customer_name).'.';
                $reserved_words = array(

                    "||SITE_TITLE||" => SITE_TITLE,
                
                    "||MESSAGE||" => ucfirst($admin_msg),
                    "||SITE_URL||" => base_url(),
                    "||YEAR||" => date('Y'),
                );
                $email_data = $this->Md_database->getEmailInfo('puja_booking_mail_admin', $reserved_words);
                // print_r($email_data);die();
               
                $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
      /*End::Text msg send to admin*/

          if (!empty($ret)) {
       
         $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">
            Puja order cancelled successfully.
        </div>');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
              
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
             Puja order cancelled failed, please try again.
        </div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
    }

        public function customer_refund_request()
    {
        
      $puja_order_id=!empty($this->input->post('pooja_order_id'))?$this->input->post('pooja_order_id'):'';
      $bank_name=!empty($this->input->post('bank_name'))?$this->input->post('bank_name'):'';
      $holdername=!empty($this->input->post('holdername'))?$this->input->post('holdername'):'';
      $account_number=!empty($this->input->post('account_number'))?$this->input->post('account_number'):'';
      $ifsc_code=!empty($this->input->post('ifsc_code'))?$this->input->post('ifsc_code'):'';
      $banch_name=!empty($this->input->post('banch_name'))?$this->input->post('banch_name'):'';
      $customerid = !empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
         $insert_data = array(
                'fk_pooja_order_id' => $puja_order_id,
                'fk_customer_id' => $customerid,
                'bank_name' => $bank_name,
                'account_number' => $account_number,
                'ifsc_code' => $ifsc_code,
                'acc_holder_name' => $holdername,
                'branch_name' => $banch_name,
                'created_by' => $customerid,
                'created_at'=> date('Y-m-d H:i:s'),
                'status'=>'1',
                );
      
       $ret = $this->Md_database->insertData('refund_request', $insert_data);


          if (!empty($ret)) {
       
         $this->session->set_userdata('msg', '<div class="alert alert-success ErrorsMsg">
            Refund request sent successfully.
        </div>');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
              
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
             Refund request sent failed, please try again.
        </div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
    }

    public function purohit_lat_long(){
        $purohit_id= !empty($this->input->get('purohit_id')) ? $this->input->get('purohit_id') : '';
        $this->db->select('purohit_latitude,purohit_longitude');
        $this->db->from('registered_purohit');
        $this->db->where('pk_id',$purohit_id); 
        $this->db->where('status',1);
        $purohit_data = $this->db->get()->result_array();
// print_r($purohit_data);die();
        echo json_encode($purohit_data);
        exit();
    }

}