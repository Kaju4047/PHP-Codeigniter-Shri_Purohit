<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_dashboard extends CI_Controller {

	public function index(){

        $table = "registered_purohit";
        $select="registered_purohit.pk_id";
        $this->db->join('purohit_customer_rating as cr','cr.fk_prurohit_id=registered_purohit.pk_id','LEFT'); 
        $this->db->group_by("registered_purohit.pk_id");
        $condition = array(
            'registered_purohit.status !=' => '3'
        );
        $totalPurohitData = $this->Md_database->getData($table, $select, $condition, 'registered_purohit.pk_id DESC', '');     
        $data['totalPurohitCount'] = count($totalPurohitData);

       
        $table = "purohit_customer_registration";
        $select="pk_id";

        $condition = array(
            'status !=' => '3'
        );
        $totalCustomerData = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');
        $data['totalCustomerCount'] = count($totalCustomerData);

        
        $table = "customer_pooja_order";
        $select="pooja.pk_id";                         
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');   
        $this->db->where('purohit_customer_pooja_order.pooja_order_status','2'); 
        $this->db->where('purohit_customer_pooja_order.admin_purohit_assign_status','2'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','3'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','4'); 
        $curr_date_time = date('Y-m-d H:i');
        $curr_date_time = $curr_date_time.':'.'00';
        $this->db->where('purohit_customer_pooja_order.pooja_date_time>=', $curr_date_time);
        $pendingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $data['totalPendingCount'] = count($pendingPoojaDeatails);

        
         $table = "pooja";
        $select="pooja.pk_id,pooja_name,pooja.fk_language,fk_category,pooja.created_date,pooja.status,master_category.category,master_language.language";             
        $condition = array(
            'pooja.status !=' => '3',
        );
        $this->db->join('master_language','master_language.pk_id=pooja.fk_language');
        $this->db->join('master_category','master_category.pk_id=pooja.fk_category');
        $poojaDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');
        $data['totalPoojaCount'] = count($poojaDetails);

        
        $table = "customer_pooja_order";
        $select="pooja.pk_id";           
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        $this->db->where('date(purohit_customer_pooja_order.pooja_date)>',date('Y-m-d'));  
        $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 

        $upcomingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $data['totalUpcomingCount'] = count($upcomingPoojaDeatails);

        
         $table = "customer_pooja_order";
            $select="pooja.pk_id";             
            $condition = array();
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');
            $this->db->where('customer_pooja_order.status!=','3'); 
            $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
            $this->db->or_where('purohit_customer_pooja_order.pooja_status','4'); 
            $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');
        $data['totalCancelledCount'] = count($cancelledPoojaDeatails);

        
        $table = "customer_pooja_order";
        $select="pooja.pk_id";             
        
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        
        $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 
        
        $completedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $data['totalCompletedCount'] = count($completedPoojaDeatails);

        $select="pk_id,round(sum(total_pkg_price_exclusive),2) as grand_total";                      
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        
        $curr_date = date('Y-m-d');
        $query_today = $this->db->get_where('purohit_customer_pooja_order', array('pooja_date' => $curr_date, 'fk_purohit!=' => NULL, 'pooja_order_status' => '1', 'admin_purohit_assign_status' => '1', 'pooja_status' => '5', 'status' => '1'));
        
        $data['todayPujaCount'] = $query_today->num_rows();
                    
        $grandTotal = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        
        $data['grandTotal'] = $grandTotal[0]['grand_total'];
    
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate'))): '';

        $data['search_term']=$search_term;
        $data['filter_city']=$filter_city;
        $data['filter_fromdate']=$filter_fromdate;
        $data['filter_todate']=$filter_todate;
       
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
        // $dateWithOneHr = date('Y-m-d H:i:s', strtotime('-1 hour'));
        // $dateWithOneHr = DATE_FORMAT(purohit_customer_pooja_order.created_date,"%Y-%m-%d");
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,purohit_master_language.language,purohit_master_category.category";                         
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
  
        $this->db->where ("(purohit_customer_pooja_order.pooja_order_date_plus1 <= now())");
        $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 
        $this->db->where('purohit_customer_pooja_order.admin_purohit_assign_status','2'); 
        $this->db->where('purohit_customer_pooja_order.pooja_order_status','2'); 
    
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)){
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->or_where("customer_pooja_order.pooja_city LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');      
        $this->db->join('purohit_master_language','purohit_master_language.pk_id=pooja.fk_language');
        $this->db->join('purohit_master_category','purohit_master_category.pk_id=pooja.fk_category');      
        $pendingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $total_records=!empty($pendingPoojaDeatails) ? count($pendingPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
             $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,purohit_master_language.language,purohit_master_category.category";                         
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
  
        $this->db->where ("(purohit_customer_pooja_order.pooja_order_date_plus1 <= now())");
        $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 
        $this->db->where('purohit_customer_pooja_order.admin_purohit_assign_status','2'); 
        $this->db->where('purohit_customer_pooja_order.pooja_order_status','2'); 
    
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)){
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->or_where("customer_pooja_order.pooja_city LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');      
        $this->db->join('purohit_master_language','purohit_master_language.pk_id=pooja.fk_language');
        $this->db->join('purohit_master_category','purohit_master_category.pk_id=pooja.fk_category');      
        $pendingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        
            $params["results"] = $pendingPoojaDeatails;             
            $config['base_url'] = base_url() . 'admin/pending-pooja-booking-list';
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
        $data['pendingPoojaDeatails']= $params["results"] ;
        
        $data['totalcount']=$total_records;
        
        //echo "<pre>"; print_r($data); die();
        
        $this->load->view('admin/dashboard/vw_dashboard',$data);
    }
}