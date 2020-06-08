<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_pooja_booking extends CI_Controller {

    public function pending_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $this->db->where('pooja_city!=','');
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

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
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');  
        // $this->db->join('purohit_rejected_order_by_purohit','purohit_rejected_order_by_purohit.fk_pooja_order_id!=customer_pooja_order.pk_id','LEFT');  
        // $this->db->where('purohit_customer_pooja_order.pooja_order_status','2'); 
        // $this->db->where('purohit_customer_pooja_order.admin_purohit_assign_status','2');  
        $this->db->where('date(purohit_customer_pooja_order.pooja_date)<>',date('Y-m-d')); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','2'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','3'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','4'); 
        // $this->db->where('purohit_customer_pooja_order.!=','2'); 
         // $this->db->or_where('purohit_customer_pooja_order.pooja_status!=','2'); 
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
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
        $pendingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // echo "<pre>";
        // print_r($pendingPoojaDeatails);
        // die();

        $total_records=!empty($pendingPoojaDeatails) ? count($pendingPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');  
        // $this->db->join('purohit_rejected_order_by_purohit','purohit_rejected_order_by_purohit.fk_pooja_order_id!=customer_pooja_order.pk_id','LEFT');  
        // $this->db->where('purohit_customer_pooja_order.pooja_order_status','2'); 
        // $this->db->where('purohit_customer_pooja_order.admin_purohit_assign_status','2');  
        $this->db->where('date(purohit_customer_pooja_order.pooja_date)<>',date('Y-m-d')); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','2'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','3'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','4'); 
        // $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 
         // $this->db->or_where('purohit_customer_pooja_order.pooja_status!=','2'); 
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
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
        $pendingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // echo "<pre>";
        //     print_r($pendingPoojaDeatails);
        //     die();

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
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // print_r($data['pendingPoojaDeatails']);
        // die();

        $this->load->view('admin/pooja_booking/vw_pending_pooja_booking_list',$data);
    }
    public function delete_pending_booking($pk_id) {
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Pending order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }

    public function view_pending_pooja_booking($pooja_order_id) {
            $this->db->select("concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name, pk_id");
            $this->db->from('registered_purohit');
            $this->db->where('registered_purohit.status','1');
            $this->db->order_by("first_name","ASC");
            $purohitList=$this->db->get()->result_array();            
            $data['purohitList'] = $purohitList;
            // echo "<pre>";
            // print_r($purohitList);
            // die();
        
            $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,o.advance_amount,o.remaining_amount,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                // $this->db->where('date(o.pooja_date)>',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();   
                $pendingView=array();
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                // $this->db->select('ac.service_name');
                $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                $this->db->from('package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','1');
                $services_inclusive=$this->db->get()->result_array();

                // $this->db->select('ac.service_name');
                $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as exclusive_services');
                $this->db->from('customer_package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                $this->db->where('fk_package_id',$value['pkg_id']);
                $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','2');
                $services_exclusive=$this->db->get()->result_array();

                $value['inclusive_services']=!empty($services_inclusive[0]['inclusive_services'])?$services_inclusive[0]['inclusive_services']:'';
                $value['services_exclusive']=!empty($services_exclusive[0]['exclusive_services'])?$services_exclusive[0]['exclusive_services']:'';
                $pendingView[]=$value;
                    }
                }
        $data['pendingView'] = $pendingView;
        // echo "<pre>";
        // print_r($data['pendingView']);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_pending_pooja_booking',$data);
    }
    public function admin_assign_purohit(){
        $purohit_id = !empty($this->input->post('assign_purohit')) ? $this->input->post('assign_purohit') : '';
        $remark = !empty($this->input->post('remark')) ? $this->input->post('remark') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : '';
        $data = array(
                'fk_purohit' => $purohit_id,
                'admin_assign_purohit_remark' => $remark,
                'admin_purohit_assign_status' => '1'
                );
        $this->db->where('pk_id', $pooja_order_id);
        $ret=$this->db->update('customer_pooja_order',$data);
        // /Notification for purohit
        $this->db->select("pk_id,token"); 
        $this->db->from('purohit_registered_purohit');
        $this->db->where('pk_id',$purohit_id);
        $query = $this->db->get();
        $tokenData= $query->result();
        $target = !empty($tokenData[0]->token)?$tokenData[0]->token:'';
        // print_r($target);
        // die();

        $resultarray = array('message' => 'Admin assigned you for pooja '.$pooja_order_id,'redirecttype' =>'assigned_purohit','subject'=>'Admin assigned purohit');                    
        $this->Md_database->sendPushNotification($resultarray,$target);

        $data = array( 
            'fk_pooja_order_id'=>$pooja_order_id,
            'fk_purohit_id' => $purohit_id ,
            'redirecttype' => 'assigned_purohit',
            'title' => 'Admin assigned purohit',
            'message'=>'Admin assigned you pooja '.$pooja_order_id,
        );
        $this->db->insert('purohit_notifications', $data);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Assigned purohit successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }  
       
       
    }

    public function todays_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

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
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        // $this->db->join('purohit_rejected_order_by_purohit','purohit_rejected_order_by_purohit.fk_pooja_order_id!=customer_pooja_order.pk_id','LEFT');
        $this->db->where('purohit_customer_pooja_order.pooja_date',date('Y-m-d')); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','2'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','3'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','4'); 
        // $this->db->where('purohit_customer_pooja_order.pooja_order_status','1'); 
        // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1');  
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        $todaysPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // print_r($pendingPoojaDeatails);
        // die();

        $total_records=!empty($todaysPoojaDeatails) ? count($todaysPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');
            // $this->db->join('purohit_rejected_order_by_purohit','purohit_rejected_order_by_purohit.fk_pooja_order_id!=customer_pooja_order.pk_id','LEFT');
            $this->db->where('purohit_customer_pooja_order.pooja_date',date('Y-m-d')); 
            $this->db->where('purohit_customer_pooja_order.pooja_status!=','2');  
             // $this->db->where('purohit_customer_pooja_order.pooja_order_status','1'); 
             // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1'); 
            if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");
                $this->db->or_where("pooja.pk_id LIKE '%$search_term%'"); 
                $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();       
            }
            $todaysPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');

            $params["results"] = $todaysPoojaDeatails;             
            $config['base_url'] = base_url() . 'admin/todays-pooja-booking-list';
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
        $data['todaysPoojaDeatails']= $params["results"] ;
        //End:: pagination::-  
        $data['totalcount']=$total_records;
        // print_r($data['pendingPoojaDeatails']);
        // die();

        $this->load->view('admin/pooja_booking/vw_todays_pooja_booking_list',$data);
    }
    public function delete_todays_pooja_booking($pk_id) {
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Today order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }

    public function view_todays_pooja_booking($pooja_order_id) {
        
             $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,o.advance_amount,o.remaining_amount,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1'); 
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                // print_r($order_view_data);
                // die();
                $todaysView=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                // $this->db->select('ac.service_name');
                $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                $this->db->from('package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','1');
                $services_inclusive=$this->db->get()->result_array();

                // $this->db->select('ac.service_name');
                $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as exclusive_services');
                $this->db->from('customer_package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                // $this->db->where('fk_package_id',$value['pkg_id']);
                $this->db->where('ps.fk_pooja_order_id',$pooja_order_id);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                // $this->db->where('ps.service_type','2');
                $services_exclusive=$this->db->get()->result_array();
                // print_r($services_exclusive);
                // die();

                $value['inclusive_services']=!empty($services_inclusive[0]['inclusive_services'])?$services_inclusive[0]['inclusive_services']:'';
                $value['services_exclusive']=!empty($services_exclusive[0]['exclusive_services'])?$services_exclusive[0]['exclusive_services']:'';

                $todaysView[]=$value;
                    }
                }
        $data['todaysView'] = $todaysView;
        // echo "<pre>";
        // print_r($data['todaysView']);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_todays_pooja_booking',$data);
    }

    // public function upcoming_pooja_booking_list() {
    //     $this->load->view('admin/pooja_booking/vw_upcoming_pooja_booking_list');
    // }
    public function upcoming_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $purohit_id = !empty($this->input->get('purohit_id')) ? $this->input->get('purohit_id') : '';
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

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
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        $this->db->where('date(purohit_customer_pooja_order.pooja_date)>',date('Y-m-d'));  
        $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 
        // $this->db->where('purohit_customer_pooja_order.pooja_order_status','1'); 
        // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1');  
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
            $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
            $this->db->group_end();
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        $upcomingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // print_r($upcomingPoojaDeatails);
        // die();

        $total_records=!empty($upcomingPoojaDeatails) ? count($upcomingPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            // $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_package_id');
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>',date('Y-m-d')); 
            $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 
             // $this->db->where('purohit_customer_pooja_order.pooja_order_status','1'); 
             // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1'); 
            if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
                $this->db->group_end();
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");
                $this->db->or_where("pooja.pk_id LIKE '%$search_term%'"); 
                $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();       
            }
            $upcomingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');

            $params["results"] = $upcomingPoojaDeatails;             
            $config['base_url'] = base_url() . 'admin/upcoming-pooja-booking-list';
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
        $data['upcomingPoojaDeatails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // print_r($data['upcomingPoojaDeatails']);
        // die();
        $this->load->view('admin/pooja_booking/vw_upcoming_pooja_booking_list',$data);
    }

    // public function view_upcoming_pooja_booking() {
    //     $this->load->view('admin/pooja_booking/vw_view_upcoming_pooja_booking');
    // }
     public function view_upcoming_pooja_booking($pooja_order_id) {
        
             $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,o.advance_amount,o.remaining_amount,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1'); 
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                // print_r($order_view_data);
                // die();
                $upcomingView=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                    $this->db->from('package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                    $this->db->where('fk_package',$value['pkg_id']);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    $this->db->where('ps.service_type','1');
                    $services_inclusive=$this->db->get()->result_array();

                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as exclusive_services');
                    $this->db->from('customer_package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                    // $this->db->where('fk_package_id',$value['pkg_id']);
                    $this->db->where('ps.fk_pooja_order_id',$pooja_order_id);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    // $this->db->where('ps.service_type','2');
                    $services_exclusive=$this->db->get()->result_array();
                    // print_r($services_exclusive);
                    // die();

                    $value['inclusive_services']=!empty($services_inclusive[0]['inclusive_services'])?$services_inclusive[0]['inclusive_services']:'';
                    $value['services_exclusive']=!empty($services_exclusive[0]['exclusive_services'])?$services_exclusive[0]['exclusive_services']:'';

                    $upcomingView[]=$value;
                    }
                }
        $data['upcomingView'] = $upcomingView;
        // echo "<pre>";
        // print_r($data['upcomingView']);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_upcoming_pooja_booking',$data);
    }
     public function delete_upcoming_pooja_booking_list($pk_id) {
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Upcoming order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }

    // public function completed_pooja_booking_list() {
    //     $this->load->view('admin/pooja_booking/vw_completed_pooja_booking_list');
    // }
     public function completed_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $purohit_id = !empty($this->input->get('purohit_id')) ? $this->input->get('purohit_id'): '';
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

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
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        // $this->db->where('date(purohit_customer_pooja_order.pooja_date)<',date('Y-m-d')); 
        $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 
        // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1');  
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
            $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
            $this->db->group_end();
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        $completedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // print_r($completedPoojaDeatails);
        // die();

        $total_records=!empty($completedPoojaDeatails) ? count($completedPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            // $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_package_id');
            // $this->db->where('purohit_customer_pooja_order.pooja_date',date('Y-m-d')); 
            $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 
             // $this->db->where('purohit_customer_pooja_order.pooja_order_status','1'); 
             // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1'); 
            if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
                $this->db->group_end();
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");
                $this->db->or_where("pooja.pk_id LIKE '%$search_term%'"); 
                $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();       
            }
            if(!empty($cust_id)){
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            $completedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');

            $params["results"] = $completedPoojaDeatails;             
            $config['base_url'] = base_url() . 'admin/completed-pooja-booking-list';
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
        $data['completedPoojaDeatails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // print_r($data['pendingPoojaDeatails']);
        // die();

        $this->load->view('admin/pooja_booking/vw_completed_pooja_booking_list',$data);
    }

    public function view_completed_pooja_booking($pooja_order_id) {
             $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,o.advance_amount,o.remaining_amount,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1'); 
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                // print_r($order_view_data);
                // die();
                $upcomingView=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                    $this->db->from('package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                    $this->db->where('fk_package',$value['pkg_id']);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    $this->db->where('ps.service_type','1');
                    $services_inclusive=$this->db->get()->result_array();

                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as exclusive_services');
                    $this->db->from('customer_package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                    // $this->db->where('fk_package_id',$value['pkg_id']);
                    $this->db->where('ps.fk_pooja_order_id',$pooja_order_id);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    // $this->db->where('ps.service_type','2');
                    $services_exclusive=$this->db->get()->result_array();
                    // print_r($services_exclusive);
                    // die();

                    $value['inclusive_services']=!empty($services_inclusive[0]['inclusive_services'])?$services_inclusive[0]['inclusive_services']:'';
                    $value['services_exclusive']=!empty($services_exclusive[0]['exclusive_services'])?$services_exclusive[0]['exclusive_services']:'';

                    $completedView[]=$value;
                    }
                }
        $data['completedView'] = $completedView;

        // echo "<pre>";
        // print_r($completedView);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_completed_pooja_booking',$data);
    }

    public function delete_completed_pooja_booking($pk_id) {
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Completed order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }

    // public function cancelled_pooja_booking_list() {
    //     $this->load->view('admin/pooja_booking/vw_cancelled_pooja_booking_list');
    // }
     public function cancelled_pooja_booking_list() {
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $purohit_id = !empty($this->input->get('purohit_id')) ? trim($this->input->get('purohit_id')) : '';
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

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
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status,customer_pooja_order.cancelled_date_time";             
        // $select="*";             
        $condition = array();
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        $this->db->where('customer_pooja_order.status!=','3'); 
        $this->db->group_start();
        $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
        $this->db->or_where('purohit_customer_pooja_order.pooja_status','4');  
        $this->db->group_end(); 
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
            $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
            $this->db->group_end();
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // print_r($filter_fromdate);
        // die();

        $total_records=!empty($cancelledPoojaDeatails) ? count($cancelledPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
            $condition = array();
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            // $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_package_id');
            $this->db->where('customer_pooja_order.status!=','3'); 
            $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
            $this->db->or_where('purohit_customer_pooja_order.pooja_status','4'); 
             // $this->db->where('purohit_customer_pooja_order.pooja_order_status','1'); 
             // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1'); 
            if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
                $this->db->group_end();
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");
                $this->db->or_where("pooja.pk_id LIKE '%$search_term%'"); 
                $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();       
            }
            if(!empty($cust_id)){
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');
        //        print_r($cancelledPoojaDeatails);
        // die();

            $params["results"] = $cancelledPoojaDeatails;             
            $config['base_url'] = base_url() . 'admin/cancelled-pooja-booking-list';
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
        $data['cancelledPoojaDeatails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // print_r($data['cancelledPoojaDeatails']);
        // die();

        $this->load->view('admin/pooja_booking/vw_cancelled_pooja_booking_list',$data);
    }
  
     public function view_cancelled_pooja_booking($pooja_order_id) {
             $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,o.advance_amount,o.remaining_amount,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,o.cancelled_date_time');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1'); 
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                // print_r($order_view_data);
                // die();
                $upcomingView=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                    $this->db->from('package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                    $this->db->where('fk_package',$value['pkg_id']);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    $this->db->where('ps.service_type','1');
                    $services_inclusive=$this->db->get()->result_array();

                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as exclusive_services');
                    $this->db->from('customer_package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                    // $this->db->where('fk_package_id',$value['pkg_id']);
                    $this->db->where('ps.fk_pooja_order_id',$pooja_order_id);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    // $this->db->where('ps.service_type','2');
                    $services_exclusive=$this->db->get()->result_array();
                    // print_r($services_exclusive);
                    // die();

                    $value['inclusive_services']=!empty($services_inclusive[0]['inclusive_services'])?$services_inclusive[0]['inclusive_services']:'';
                    $value['services_exclusive']=!empty($services_exclusive[0]['exclusive_services'])?$services_exclusive[0]['exclusive_services']:'';

                    $cancelledView[]=$value;
                    }
                }
        $data['cancelledView'] = $cancelledView;

        // echo "<pre>";
        // print_r($cancelledView);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_cancelled_pooja_booking',$data);
    }
     public function delete_cancelled_pooja_booking($pk_id) {
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Cancelled order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }

    public function rejected_pooja_booking_list() {
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

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
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status";             
        // $select="*";             
        $condition = array();
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        $this->db->join('purohit_rejected_order_by_purohit','purohit_rejected_order_by_purohit.fk_pooja_order_id=customer_pooja_order.pk_id');  
        $this->db->where('customer_pooja_order.status!=','3'); 
        $this->db->group_start();
        $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
        $this->db->or_where('purohit_customer_pooja_order.pooja_status','4');  
        $this->db->group_by('purohit_rejected_order_by_purohit.fk_pooja_order_id'); 
        $this->db->group_end(); 
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        $rejectedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // echo "<pre>";
        // print_r($rejectedPoojaDeatails);
        // die();

        $total_records=!empty($rejectedPoojaDeatails) ? count($rejectedPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
            $condition = array();
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            $this->db->join('purohit_rejected_order_by_purohit','purohit_rejected_order_by_purohit.fk_pooja_order_id=customer_pooja_order.pk_id');  
            // $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_package_id');
            $this->db->where('customer_pooja_order.status!=','3'); 
            $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
            $this->db->or_where('purohit_customer_pooja_order.pooja_status','4');
            $this->db->group_by('purohit_rejected_order_by_purohit.fk_pooja_order_id');  
             // $this->db->where('purohit_customer_pooja_order.pooja_order_status','1'); 
             // $this->db->where_or('purohit_customer_pooja_order.admin_purohit_assign_status','1');
            if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");
                $this->db->or_where("pooja.pk_id LIKE '%$search_term%'"); 
                $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();       
            }
            $rejectedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');
        //        print_r($cancelledPoojaDeatails);
        // die();

            $params["results"] = $rejectedPoojaDeatails;             
            $config['base_url'] = base_url() . 'admin/reject-pooja-booking-list';
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
        $data['rejectedPoojaDeatails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // print_r($data['cancelledPoojaDeatails']);
        // die();

        $this->load->view('admin/pooja_booking/vw_rejected_pooja_booking_list',$data);
    }


    public function view_rejected_pooja_booking($pooja_order_id) {
             $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,o.advance_amount,o.remaining_amount,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,o.updated_date');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1'); 
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                // print_r($order_view_data);
                // die();
                $rejectedView=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                    $this->db->from('package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                    $this->db->where('fk_package',$value['pkg_id']);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    $this->db->where('ps.service_type','1');
                    $services_inclusive=$this->db->get()->result_array();

                    // $this->db->select('ac.service_name');
                    $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as exclusive_services');
                    $this->db->from('customer_package_services as ps');
                    $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                    // $this->db->where('fk_package_id',$value['pkg_id']);
                    $this->db->where('ps.fk_pooja_order_id',$pooja_order_id);
                    $this->db->where('ps.status','1');
                    $this->db->where('ac.status','1');
                    // $this->db->where('ps.service_type','2');
                    $services_exclusive=$this->db->get()->result_array();
                    // print_r($services_exclusive);
                    // die();

                    $value['inclusive_services']=!empty($services_inclusive[0]['inclusive_services'])?$services_inclusive[0]['inclusive_services']:'';
                    $value['services_exclusive']=!empty($services_exclusive[0]['exclusive_services'])?$services_exclusive[0]['exclusive_services']:'';

                    $rejectedView[]=$value;
                    }
                }
                $this->db->select('mobile_no,registered_purohit.pk_id,concat(purohit_registered_purohit.first_name," ",purohit_registered_purohit.middle_name," ",purohit_registered_purohit.last_name) as purohit_name,purohit_rejected_order_by_purohit.created_date');
                $this->db->from('purohit_rejected_order_by_purohit');
                $this->db->join('customer_pooja_order','customer_pooja_order.pk_id=purohit_rejected_order_by_purohit.fk_pooja_order_id');
                $this->db->join('registered_purohit', 'registered_purohit.pk_id=purohit_rejected_order_by_purohit.request_rejected_by');
                // $this->db->where('p.status','1');
                $this->db->where('customer_pooja_order.status','1'); 
                $this->db->where('purohit_rejected_order_by_purohit.fk_pooja_order_id',$pooja_order_id);
                $rejectedPoojaPurohit=$this->db->get()->result_array();
        $data['rejectedPoojaPurohit'] = $rejectedPoojaPurohit;
        $data['rejectedView'] = $rejectedView;

        // echo "<pre>";

        // print_r($data);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_rejected_pooja_booking',$data);
    }
     public function delete_rejected_pooja_booking($pk_id) {
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Rejected order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }
    
    public function refund_pooja_booking_list() {
        $this->load->view('admin/pooja_booking/vw_refund_pooja_booking_list');
    }
    
    public function view_refund_pooja_booking() {
        $this->load->view('admin/pooja_booking/vw_view_refund_pooja_booking');
    }

}
