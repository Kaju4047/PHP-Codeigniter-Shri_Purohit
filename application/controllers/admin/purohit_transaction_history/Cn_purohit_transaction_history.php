<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_purohit_transaction_history extends CI_Controller {

    public function purohit_transaction_history_list() {

    	$search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $purohit_id = !empty($this->input->get('purohit_id')) ? trim($this->input->get('purohit_id')) : '';
        $data['search_term']=$search_term;

    	//start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ?($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $table = "purohit_purohit_transaction_history";
        $select = "purohit_purohit_transaction_history.pk_id,fk_purohit_id,amount,transaction_id,remark,transaction_date,transaction_time,transaction_date,balance,purohit_purohit_transaction_history.status,transaction_type,purohit_purohit_transaction_history.created_date,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,rp.mobile_no,rp.email_id,rp.address,balance";
        $condition = array('purohit_purohit_transaction_history.status' => '1');	
        // $this->db->where('amount!=',0);
        $this->db->join('purohit_registered_purohit as rp','rp.pk_id = purohit_purohit_transaction_history.fk_purohit_id');
	    if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) LIKE '%$search_term%'");   
            $this->db->or_where("rp.mobile_no LIKE '%$search_term%'"); 
            $this->db->or_where("rp.email_id LIKE '%$search_term%'"); 
            $this->db->or_where("rp.address LIKE '%$search_term%'");
            $this->db->or_where("amount LIKE '%$search_term%'");
            $this->db->or_where("transaction_id LIKE '%$search_term%'");
            if(preg_match("/{$search_term}/i",'Fine')) {
            	$this->db->or_where("purohit_purohit_transaction_history.transaction_type",'1');   
            }if(preg_match("/{$search_term}/i",'Credited')){
                $this->db->or_where("purohit_purohit_transaction_history.transaction_type",'2');   
            } 
            $this->db->group_end();             
	    }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where("fk_purohit_id",$purohit_id);
            $this->db->where("transaction_type",2);
            $this->db->group_end(); 
        }
        $this->db->order_by("purohit_purohit_transaction_history.pk_id",'DESC');
        $transactionDetails = $this->Md_database->getData($table, $select, $condition, '','');
           // print_r($transactionDetails);die();
        $total_records=!empty($transactionDetails) ? count($transactionDetails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "purohit_purohit_transaction_history";
	        $select = "purohit_purohit_transaction_history.pk_id,fk_purohit_id,amount,transaction_id,remark,transaction_date,transaction_time,transaction_date,balance,purohit_purohit_transaction_history.status,transaction_type,purohit_purohit_transaction_history.created_date,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,rp.mobile_no,rp.email_id,rp.address,balance";
	        $condition = array('purohit_purohit_transaction_history.status'=> '1');	
	        // $this->db->where('amount!=',0);
	        $this->db->join('purohit_registered_purohit as rp','rp.pk_id = purohit_purohit_transaction_history.fk_purohit_id');
	        if (!empty($search_term)){
	            $this->db->group_start();
	            $this->db->where("concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) LIKE '%$search_term%'");   
	            $this->db->or_where("rp.mobile_no LIKE '%$search_term%'"); 
	            $this->db->or_where("rp.email_id LIKE '%$search_term%'"); 
	            $this->db->or_where("rp.address LIKE '%$search_term%'");
	            $this->db->or_where("amount LIKE '%$search_term%'");
            	$this->db->or_where("transaction_id LIKE '%$search_term%'");
	            if(preg_match("/{$search_term}/i",'Fine')) {
                	$this->db->or_where("purohit_purohit_transaction_history.transaction_type",'1');   
	            }if(preg_match("/{$search_term}/i",'Credited')){
	                $this->db->or_where("purohit_purohit_transaction_history.transaction_type",'2');   
	            } 
	            $this->db->group_end();             
	        }
            if (!empty($purohit_id)){
                $this->db->group_start();
                $this->db->where("fk_purohit_id",$purohit_id);
                $this->db->where("transaction_type",2);
                $this->db->group_end(); 
            }
            $this->db->order_by("purohit_purohit_transaction_history.pk_id",'DESC');
	        $transactionDetails = $this->Md_database->getData($table, $select, $condition, '','');
            $params["results"] = $transactionDetails;             
            $config['base_url'] = base_url() . 'admin/purohit-transaction-history-list';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Prev';
            $config['next_tag_open'] = '<li class="pg-next">';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="pg-prev">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
        }        
        $data['follow_links']=$params['links'];
        $data['transactionDetails']= $params["results"] ;
    
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        $this->load->view('admin/purohit_transaction_history/vw_purohit_transaction_history_list',$data);
    } 
    public function add_purohit_transaction_history_action(){
     	$purohit_id = !empty($this->input->post('purohit_id')) ?$this->input->post('purohit_id'):'';
     	$amount = !empty($this->input->post('amount')) ?$this->input->post('amount'):'';
     	$transaction_id = !empty($this->input->post('transaction_id')) ?$this->input->post('transaction_id'):'';
     	$remark = !empty($this->input->post('remark')) ?$this->input->post('remark'):'';
     	$time = !empty($this->input->post('time')) ?$this->input->post('time'):'';
     	$date = !empty($this->input->post('date')) ?date('Y-m-d',strtotime($this->input->post('date'))):'';
     	$balance = !empty($this->input->post('balance')) ?$this->input->post('balance'):'';

        $new_balance  =     $balance- $amount ;

     	$table = "purohit_purohit_transaction_history";
        $insert_data = array(
            'fk_purohit_id' => $purohit_id,
            'amount' => $amount,
            'transaction_id' => $transaction_id,
            'transaction_type' => '2',
            'remark' => $remark,          
            'transaction_time' => $time,          
            'transaction_date' => $date,          
            'balance' => $new_balance,          
            'status' => 1,
            'created_by' => $this->session->userdata['UID'],
            'created_date' => date('Y-m-d H:i:s'),
            'created_ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $insert_id = $this->Md_database->insertData($table,$insert_data);

        //Notification for purohit
        $this->db->select("pk_id,token,concat(first_name,' ',middle_name,' ',last_name) as purohit_name"); 
        $this->db->from('purohit_registered_purohit');
        $this->db->where('pk_id',$purohit_id);
        $query = $this->db->get();
        $tokenData= $query->result();
        $target = !empty($tokenData[0]->token)?$tokenData[0]->token:'';
        $purohit_name = !empty($tokenData[0]->purohit_name)?$tokenData[0]->purohit_name:'';
         $message = "Dear ".$purohit_name.", you have received a payment of ".$amount."/-.  Transaction ID: ".$transaction_id.". Please check Shri Purohit App for more details";
        $resultarray = array('message' => $message,'redirecttype' =>'payment','subject'=>'Purohit payment');
        // print_r($resultarray)   ;
        // die();                 
        $this->Md_database->sendPushNotification($resultarray,$target);

        $data = array( 
            'fk_purohit_id' => $purohit_id ,
            'redirecttype' => 'payment',
            'title' => 'Purohit payment',
            'message'=>$message,
        );
        $this->db->insert('purohit_notifications', $data);
        $this->session->set_flashdata('success', 'Transaction details has been inserted successfully.');
         redirect(base_url() . 'admin/purohit-transaction-history-list');
       
    }
    public function getPurohitBalance(){
        $purohit_id = !empty($this->input->post('purohit_id')) ?$this->input->post('purohit_id'):'';
        $this->db->select('pk_id,balance');
        $this->db->from('purohit_purohit_transaction_history');
        $this->db->where('fk_purohit_id',$purohit_id);
        $this->db->order_by('pk_id','DESC');

        $balance_array=$this->db->get()->result_array();

        $ArrayView = $balance_array[0];
    
           echo json_encode($ArrayView);
        exit();
    }

     public function add_purohit_transaction_history() {
        $table = "purohit_registered_purohit";
        $select = array("pk_id,concat(first_name,' ',middle_name,' ',last_name) as purohit_name,status");
        $condition = array(
            'status' => '1',
        );
        $purohit_list = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');


        $data['purohit_list'] = $purohit_list;

        

        // print_r($purohit_list);
        // die();
        
    
        $this->load->view('admin/purohit_transaction_history/vw_add_purohit_transaction_history',$data);
    }
  
}
