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

        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
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
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";          
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
        $curr_date = date('Y-m-d');
        $this->db->where('purohit_customer_pooja_order.pooja_date>', $curr_date);
        if (!empty($filter_city)){
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)){
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
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
            $this->db->group_end();
        }
        $pendingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');

        $total_records=!empty($pendingPoojaDeatails) ? count($pendingPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
        // $select="*";             
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
        $this->db->where('purohit_customer_pooja_order.pooja_date>', $curr_date);
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
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
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
        // echo "<pre>";
        // print_r($data);
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

            $this->db->select("fk_pooja_order_id,request_cancelled_by,pk_id");
            $this->db->from('purohit_cancelled_order_by_purohit as co');
            $this->db->where('co.status','1');
            $this->db->where('co.fk_pooja_order_id',$pooja_order_id);
            $cancelledPoojaPurohitList = $this->db->get()->result_array();
            
            $this->db->select("request_rejected_by");
            $this->db->from('purohit_rejected_order_by_purohit as prop');
            $this->db->where('prop.status','1');
            $this->db->where('prop.fk_pooja_order_id',$pooja_order_id);
            $rejectedPoojaPurohitList = $this->db->get()->result_array();
            
           // echo "<pre>"; print_r($cancelledPoojaPurohitList); die();
            $this->db->select("concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name, pk_id");
            $this->db->from('registered_purohit');
            $this->db->where('registered_purohit.status','1');
            $this->db->order_by("first_name","ASC");
            if (!empty($cancelledPoojaPurohitList)) {
             $this->db->where('registered_purohit.pk_id<>',$cancelledPoojaPurohitList[0]['request_cancelled_by']);    
            }
            if(!empty($rejectedPoojaPurohitList))
            {
                $count = count($rejectedPoojaPurohitList);
                for($i=0; $i<$count; $i++)
                {
                    $this->db->where('registered_purohit.pk_id<>',$rejectedPoojaPurohitList[$i]['request_rejected_by']);
                }
            }
            $purohitList=$this->db->get()->result_array();  

            

            $data['purohitList'] = $purohitList;


            $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage ,p.pk_id as puja_id,o.total_pkg_price_exclusive');
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
                        // $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();


                        // $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // // $this->db->where('pss.fk_services',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();


                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                        $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?($total_amount/100)*$value['purohit_percentage']:'-';
                        $pendingView[]=$value;
                    }
                }
        $data['pendingView'] = $pendingView[0];
        
        $this->load->view('admin/pooja_booking/vw_view_pending_pooja_booking',$data);
    }
    public function admin_assign_purohit(){
        $purohit_id = !empty($this->input->post('assign_purohit')) ? $this->input->post('assign_purohit') : '';
        $remark = !empty($this->input->post('remark')) ? $this->input->post('remark') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : '';

        $table = "customer_pooja_order";
        $select="pk_id, fk_pooja_id, pooja_date";                       
        $condition = array(
            'customer_pooja_order.status!=' => '3',
            'customer_pooja_order.pk_id' => $pooja_order_id,
        );       
        $pojaDate = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        if (!empty($pojaDate) && $pojaDate[0]['pooja_date'] < date('Y-m-d')) {

            $data = array(
                    'pooja_status' => '3',
                    'cancelled_date_time' =>  date('Y-m-d H:i:s'),
                    );
            $this->db->where('pk_id', $pooja_order_id);
            $ret=$this->db->update('customer_pooja_order',$data);
            $this->session->set_flashdata('success', "Cancelled Pooja successfully.");
            // redirect($_SERVER['HTTP_REFERER']);
            redirect(base_url() . 'admin/pending-pooja-booking-list');     
        }else{
            $data = array(
                    'fk_purohit' => $purohit_id,
                    'admin_assign_purohit_remark' => $remark,
                    'admin_purohit_assign_status' => '1',
                    'pooja_order_status' => '1',
            );
            $this->db->where('pk_id', $pooja_order_id);
            $ret=$this->db->update('customer_pooja_order',$data);
            
            // $this->db->select('pps.fk_package, pps.fk_services, pps.services_charges, pps.charges_to_show_purohit');
            // $this->db->from('purohit_package_services as pps');
            // $this->db->join('purohit_package as pp', 'pp.pk_id = pps.fk_package', 'LEFT');
            // $this->db->where('pp.fk_pooja', $pojaDate[0]['fk_pooja_id']);
            // $this->db->where('pps.service_type', 2);
            // $charges = $this->db->get()->result_array();
            
            // $count = count($charges);
            
            // for($i = 0; $i<$count; $i++)
            // {
            //     $data_charges = array(
            //     'puja_order_id' => $pooja_order_id,
            //     'purohit_id' => $purohit_id,
            //     'pkg_id' => $charges[$i]['fk_package'],
            //     'service_id' => $charges[$i]['fk_services'],
            //     'services_charges' => $charges[$i]['services_charges'],
            //     'charges_to_show_purohit' => $charges[$i]['charges_to_show_purohit'],
            //     'created_by' => $this->session->userdata('UID'),
            //     'created_on' => date('Y-m-d H:i:s'),
            //     'created_ip_address' => $_SERVER['REMOTE_ADDR']
            //     );    
                
            //     $this->db->insert('purohit_show_charges', $data_charges);
            // }
            
            

            //Notification for purohit
            $this->db->select("pk_id,token"); 
            $this->db->from('purohit_registered_purohit');
            $this->db->where('pk_id',$purohit_id);
            $query = $this->db->get();
            $tokenData= $query->result();
            $target = !empty($tokenData[0]->token)?$tokenData[0]->token:'';
     
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
                // redirect($_SERVER['HTTP_REFERER']);
                 redirect(base_url() . 'admin/pending-pooja-booking-list');

            }  
        }
       $this->load->view('admin/pooja_booking/vw_view_pending_pooja_booking',$data);
    }

    public function todays_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
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
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        $this->db->where('purohit_customer_pooja_order.pooja_date',date('Y-m-d')); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','2'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','3'); 
        $this->db->where('purohit_customer_pooja_order.pooja_status!=','4'); 
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
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);   
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
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            $this->db->where('purohit_customer_pooja_order.pooja_date',date('Y-m-d')); 
            $this->db->where('purohit_customer_pooja_order.pooja_status!=','2');  
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
            if(!empty($cust_id)){
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
            $this->db->select("concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name, pk_id");
            $this->db->from('registered_purohit');
            $this->db->where('registered_purohit.status','1');
            $this->db->order_by("first_name","ASC");
            $purohitList=$this->db->get()->result_array();            
            $data['purohitList'] = $purohitList;

        
            $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,p.pk_id as puja_id,o.total_pkg_price_exclusive');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                 $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                // $this->db->where('date(o.pooja_date)>',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array(); 
                // echo "<pre>";
                // print_r($order_view_data);
                // die();  
                $pendingView=array();
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();

                        //  $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // // $this->db->where('pss.fk_services',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();

                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                         $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?$value['total_amount']*$value['purohit_percentage']/100:'-';
                 

                        $todaysView[]=$value;
                    }
                }
        $data['todaysView'] = $todaysView[0];
        // echo "<pre>";
        // print_r($todaysView[0]['purohit_charges']);
        // print_r($todaysView[0]['purohit_percentage']);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_todays_pooja_booking',$data);
    }

    public function upcoming_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;
    
        $cust_id = !empty($this->input->get('cust_id')) ? $this->input->get('cust_id') : '';
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
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        $this->db->where('date(purohit_customer_pooja_order.pooja_date)>',date('Y-m-d'));  
        $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 
 
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
            // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
        //      print_r($cust_id);
        // die();
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        $this->db->order_by('customer_pooja_order.pooja_date_time', 'DESC');
        $upcomingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // print_r($upcomingPoojaDeatails);
        // die();

        $total_records=!empty($upcomingPoojaDeatails) ? count($upcomingPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            // $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_package_id');
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>',date('Y-m-d')); 
            $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 

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
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
            
            $this->db->order_by('customer_pooja_order.pooja_date_time', 'ASC');
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
        $this->db->select("concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name, pk_id");
            $this->db->from('registered_purohit');
            $this->db->where('registered_purohit.status','1');
            $this->db->order_by("first_name","ASC");
            $purohitList=$this->db->get()->result_array();            
            $data['purohitList'] = $purohitList;

        
            $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,,p.pk_id as puja_id,o.total_pkg_price_exclusive');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                 $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                // $this->db->where('date(o.pooja_date)>',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array(); 
                // echo "<pre>";
                // print_r($order_view_data);
                // die();  
                $pendingView=array();
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                        // $this->db->select('ac.service_name');
                        // $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();

                        // $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();
                        //echo "<pre>"; print_r($services_exclusive); die();
                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                        $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?( $value['total_amount']/100)*$value['purohit_percentage']:'-';
                        $upcomingView[]=$value;
                    }
                }
        $data['upcomingView'] = $upcomingView[0];
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

    public function completed_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $cust_id = !empty($this->input->get('cust_id')) ? $this->input->get('cust_id') : '';
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
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
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
            // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 

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
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
        $this->db->select("concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name, pk_id");
            $this->db->from('registered_purohit');
            $this->db->where('registered_purohit.status','1');
            $this->db->order_by("first_name","ASC");
            $purohitList=$this->db->get()->result_array();            
            $data['purohitList'] = $purohitList;

        
            $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,p.pk_id as puja_id,cr.rating,cr.comment,o.total_pkg_price_exclusive');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('purohit_customer_rating as cr','cr.fk_pooja_order_id=o.pk_id','LEFT');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                 $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                // $this->db->where('date(o.pooja_date)>',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array(); 
                // echo "<pre>";
                // print_r($order_view_data);
                // die();  
                $pendingView=array();
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                        // $this->db->select('ac.service_name');
                        // $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();

    

                        // $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // // $this->db->where('pss.fk_services',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();

                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                        $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?($value['total_amount']/100)*$value['purohit_percentage']:'-';
                        $completedView[]=$value;
                    }
                }
        $data['completedView'] = $completedView[0];

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

    public function cancelled_pooja_booking_list() {
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;
        
        $cust_id = !empty($this->input->get('cust_id')) ? $this->input->get('cust_id') : '';
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
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status,customer_pooja_order.cancelled_date_time,pooja_time";             
        // $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status,customer_pooja_order.cancelled_date_time,pooja_time";             
        // $select="*";             
        $condition = array();

      if (empty($purohit_id)){
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');  
            $this->db->where('customer_pooja_order.status!=','3'); 
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
            $this->db->or_where('purohit_customer_pooja_order.pooja_status','4');  
            $this->db->group_end();
        } else{
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_cancelled_order_by_purohit as cop','purohit_customer_pooja_order.pk_id=cop.fk_pooja_order_id');  
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=cop.request_cancelled_by');  
            // $this->db->join('purohit_cancelled_order_by_purohit as copp','purohit_registered_purohit.pk_id=copp.request_cancelled_by');  
            // $this->db->join('purohit_cancelled_order_by_purohit as copo','customer_pooja_order.pk_id=copo.fk_pooja_order_id');  
            $this->db->where('customer_pooja_order.status!=','3'); 
             $this->db->where('cop.request_cancelled_by',$purohit_id) ; 
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
        //     print_r($cust_id);
        // die();
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // echo "<pre>";
        // print_r($cancelledPoojaDeatails);
        // die();

        $total_records=!empty($cancelledPoojaDeatails) ? count($cancelledPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
           $table = "customer_pooja_order";
        $condition = array();
   
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status,customer_pooja_order.cancelled_date_time,pooja_time";             
      if (empty($purohit_id)){
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');  
            $this->db->where('customer_pooja_order.status!=','3'); 
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
            $this->db->or_where('purohit_customer_pooja_order.pooja_status','4');  
            $this->db->group_end();
        } else{
                            
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_cancelled_order_by_purohit as cop','purohit_customer_pooja_order.pk_id=cop.fk_pooja_order_id');  
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=cop.request_cancelled_by');  
            // $this->db->join('purohit_cancelled_order_by_purohit as copp','purohit_registered_purohit.pk_id=copp.request_cancelled_by');  
            // $this->db->join('purohit_cancelled_order_by_purohit as copo','customer_pooja_order.pk_id=copo.fk_pooja_order_id');  
            $this->db->where('customer_pooja_order.status!=','3'); 
             $this->db->where('cop.request_cancelled_by',$purohit_id) ; 
        }
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)){
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        // if (!empty($purohit_id)) {
        //     $this->db->group_start();
        //     $this->db->where('copp.request_cancelled_by',$purohit_id);  
        //     // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
        //     $this->db->group_end();
        // }
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
        //     print_r($cust_id);
        // die();
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');


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
        // echo "<pre>";
        // print_r($data['cancelledPoojaDeatails']);
        // die();

        $this->load->view('admin/pooja_booking/vw_cancelled_pooja_booking_list',$data);
    }
  
    // public function cancelled_pooja_booking_list() {
    //     $table = "customer_pooja_order";      
    //     $purohit_id = !empty($this->input->get('purohit_id')) ? trim($this->input->get('purohit_id')) : '';
       
    //     $table = "purohit_customer_pooja_order";
    //     $select="purohit_customer_pooja_order.pk_id";             
            
    //     $condition = array();
    //     $this->db->join('purohit_cancelled_order_by_purohit as cop','purohit_customer_pooja_order.pk_id=cop.fk_pooja_order_id');  
    //     $this->db->where('cop.request_cancelled_by',$purohit_id) ;  
    //     $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
    //     $data['completedView']=$cancelledPoojaDeatails;
    //     // print_r($cancelledPoojaDeatails);
    //     // die();
    //     $this->load->view('admin/pooja_booking/vw_cancelled_pooja_booking_list',$data);
    // } 
    public function view_cancelled_pooja_booking($pooja_order_id){
        $this->db->select("concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name, pk_id");
            $this->db->from('registered_purohit');
            $this->db->where('registered_purohit.status','1');
            $this->db->order_by("first_name","ASC");
            $purohitList=$this->db->get()->result_array();            
            $data['purohitList'] = $purohitList;

                $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,p.pk_id as puja_id,o.total_pkg_price_exclusive,o.cancelled_date_time,pooja_status,o.cancellation_charges,copp.cancellation_charges as purohi_cancellation_charges');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                $this->db->join('registered_purohit as C','C.pk_id=o.fk_purohit','LEFT');

                $this->db->join('purohit_cancelled_order_by_purohit as copp','C.pk_id=copp.request_cancelled_by','LEFT');  
                $this->db->join('purohit_cancelled_order_by_purohit as copo','o.pk_id=copo.fk_pooja_order_id','LEFT'); 


                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array(); 
                $pendingView=array();
                // echo "<pre>";
                // print_r($order_view_data);
                // die();  
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                        // $this->db->select('ac.service_name');
                        // $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();



                        // $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // // $this->db->where('pss.fk_services',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();

                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                        $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?($total_amount/100)*$value['purohit_percentage']:'-';
                        $cancelledView[]=$value;
                    }
                }
        $data['cancelledView'] = $cancelledView[0];

        // echo "<pre>";
        // print_r($cancelledView[0]);
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

    public function rejected_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;
        
        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
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

        $table = "purohit_rejected_order_by_purohit";
        $select="p.pk_id as pooja_id,p.pooja_name,cr.customer_name,cr.customer_mobile_no,po.pooja_date,po.created_date,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,pooja_city,po.pk_id,pooja_time";                        
        $this->db->join('purohit_customer_pooja_order as po','purohit_rejected_order_by_purohit.fk_pooja_order_id=po.pk_id');
        $this->db->join('pooja as p','po.fk_pooja_id=p.pk_id');
        $this->db->join('purohit_registered_purohit as rp','purohit_rejected_order_by_purohit.request_rejected_by=rp.pk_id');
        $this->db->join('customer_registration as cr','cr.pk_id=po.fk_user_id');
        $condition = array();

        $this->db->where('po.status!=','3'); 
        $this->db->group_by('purohit_rejected_order_by_purohit.fk_pooja_order_id');  

         if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_po.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_po.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("p.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("cr.customer_name LIKE '%$search_term%'");
            $this->db->or_where("p.pk_id LIKE '%$search_term%'"); 
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
            $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
            $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();       
        }
        if(!empty($cust_id)){
            $this->db->where('po.fk_user_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('po.fk_purohit',$purohit_id);  
            // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
            $this->db->group_end();
        }
       
        $rejectedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'purohit_rejected_order_by_purohit.pk_id DESC','');
        // echo "<pre>";
        // print_r($rejectedPoojaDeatails);
        // die();

        $total_records=!empty($rejectedPoojaDeatails) ? count($rejectedPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
    

        $table = "purohit_rejected_order_by_purohit";
        $select="p.pk_id as pooja_id,p.pooja_name,cr.customer_name,cr.customer_mobile_no,po.pooja_date,po.created_date,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,pooja_city,po.pk_id,pooja_time";                        
        $this->db->join('purohit_customer_pooja_order as po','purohit_rejected_order_by_purohit.fk_pooja_order_id=po.pk_id');
        $this->db->join('pooja as p','po.fk_pooja_id=p.pk_id');
        $this->db->join('purohit_registered_purohit as rp','purohit_rejected_order_by_purohit.request_rejected_by=rp.pk_id');
        $this->db->join('customer_registration as cr','cr.pk_id=po.fk_user_id');
        $condition = array();

        // $this->db->group_by('purohit_rejected_order_by_purohit.fk_pooja_order_id'); 
        $this->db->where('po.status!=','3'); 

        $this->db->group_by('purohit_rejected_order_by_purohit.fk_pooja_order_id');  
        if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_po.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_po.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("p.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("cr.customer_name LIKE '%$search_term%'");
            $this->db->or_where("p.pk_id LIKE '%$search_term%'"); 
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
            $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
            $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();       
        }
        if(!empty($cust_id)){
            $this->db->where('po.fk_user_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('po.fk_purohit',$purohit_id);  
            // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
            $this->db->group_end();
        }
       
        $rejectedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'purohit_rejected_order_by_purohit.pk_id DESC','');

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
        $this->load->view('admin/pooja_booking/vw_rejected_pooja_booking_list',$data);
    }

    public function view_rejected_pooja_booking($pooja_order_id) {
                $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,o.cancelled_date_time,p.pk_id as puja_id,o.total_pkg_price_exclusive');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                 $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit','LEFT');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                // $this->db->where('date(o.pooja_date)>',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array(); 
                // echo "<pre>";
                // print_r($order_view_data);
                // die();  
                $pendingView=array();
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {

                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();

                        //  $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // // $this->db->where('pss.fk_services',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();

                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                        $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?($total_amount/100)*$value['purohit_percentage']:'-';
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
        $data['rejectedView'] = $rejectedView[0];

        // echo "<pre>";
        // print_r($data);
        // die();
        $this->load->view('admin/pooja_booking/vw_view_rejected_pooja_booking',$data);
    }
    public function delete_rejected_pooja_booking($pk_id){
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Rejected order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }
    
    public function refund_pooja_booking_list() {
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;
        
        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
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
        $table = "purohit_refund_request";         
        $select="purohit_refund_request.pk_id,purohit_refund_request.fk_pooja_order_id,p.pooja_name,cr.customer_name,cr.customer_mobile_no,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,o.cancellation_charges,o.cancellation_type,purohit_refund_request.refund_status,o.created_date,o.total_pkg_price_exclusive,o.pooja_date,pooja_time";

        $this->db->join('purohit_customer_pooja_order as o','o.pk_id=purohit_refund_request.fk_pooja_order_id');
        $this->db->join('purohit_pooja as p','p.pk_id=o.fk_pooja_id');
        $this->db->join('purohit_registered_purohit as rp','rp.pk_id=o.fk_purohit','LEFT');
        $this->db->join('purohit_customer_registration as cr','cr.pk_id=purohit_refund_request.fk_customer_id');
        $this->db->join('purohit_package as pkg','pkg.pk_id=o.fk_package_id');
       
        $condition=array('purohit_refund_request.status' => '1');
        if (!empty($filter_city)) {
            $this->db->where('o.pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(o.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(o.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("p.pooja_name LIKE '%$search_term%'");                   
            $this->db->or_where("p.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("cr.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) LIKE '%$search_term%'");     
            $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        if(!empty($cust_id)){
             $this->db->where('purohit_refund_request.fk_customer_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('o.fk_purohit',$purohit_id);  
            // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
            $this->db->group_end();
        }
        $refundedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'purohit_refund_request.pk_id DESC','');
        // echo "<pre>";
        // print_r($refundedPoojaDeatails);
        // die();
        // $refundedPoojaDeatails[0]['refund_amount']='0';
        if (!empty($refundedPoojaDeatails[0]['cancellation_charges'])) {
            $refundedPoojaDeatails[0]['refund_amount'] =$refundedPoojaDeatails[0]['total_pkg_price_exclusive']-$refundedPoojaDeatails[0]['cancellation_charges'];
        }elseif (!empty($refundedPoojaDeatails[0]['total_pkg_price_exclusive']) ){
             $refundedPoojaDeatails[0]['refund_amount'] =$refundedPoojaDeatails[0]['total_pkg_price_exclusive'];
        }

        $total_records=!empty($refundedPoojaDeatails) ? count($refundedPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "purohit_refund_request";         
            $select="purohit_refund_request.pk_id,purohit_refund_request.fk_pooja_order_id,p.pooja_name,cr.customer_name,cr.customer_mobile_no,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,o.cancellation_charges,o.cancellation_type,purohit_refund_request.refund_status,o.created_date,o.total_pkg_price_exclusive,o.pooja_date,pooja_time";
            //pkg.package_charges,SUM(pkgser.services_charges) as services_charges
            // $this->db->where('cancellation_type','1')
            $this->db->join('purohit_customer_pooja_order as o','o.pk_id=purohit_refund_request.fk_pooja_order_id');
            $this->db->join('purohit_pooja as p','p.pk_id=o.fk_pooja_id');
            $this->db->join('purohit_registered_purohit as rp','rp.pk_id=o.fk_purohit','LEFT');
            $this->db->join('purohit_customer_registration as cr','cr.pk_id=purohit_refund_request.fk_customer_id');
            $this->db->join('purohit_package as pkg','pkg.pk_id=o.fk_package_id');
            $condition=array('purohit_refund_request.status' => '1');
            if (!empty($filter_city)) {
                $this->db->where('o.pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)) {
                $this->db->where('date(o.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(o.pooja_date)<=',$filter_todate);  
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("p.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("cr.customer_name LIKE '%$search_term%'");       
                $this->db->or_where("p.pk_id LIKE '%$search_term%'");              
                $this->db->or_where("concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) LIKE '%$search_term%'");     
                $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();             
            }
            if(!empty($cust_id)){
                $this->db->where('purohit_refund_request.fk_customer_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('o.fk_purohit',$purohit_id);  
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
                $this->db->group_end();
            }
            $refundedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'purohit_refund_request.pk_id DESC','');
            // $refundedPoojaDeatails[0]['refund_amount']="0";
            if (!empty($refundedPoojaDeatails[0]['cancellation_charges'])) {
                $refundedPoojaDeatails[0]['refund_amount'] =$refundedPoojaDeatails[0]['total_pkg_price_exclusive']-$refundedPoojaDeatails[0]['cancellation_charges'];
            }elseif (!empty($refundedPoojaDeatails[0]['total_pkg_price_exclusive']) ){
                 $refundedPoojaDeatails[0]['refund_amount'] =$refundedPoojaDeatails[0]['total_pkg_price_exclusive'];
            }

            $params["results"] = $refundedPoojaDeatails;             
            $config['base_url'] = base_url() . 'admin/refund-pooja-booking-list';
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
        $data['refundedPoojaDeatails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // echo "<pre>";
        // print_r($data['refundedPoojaDeatails']);
        // die();
        $this->load->view('admin/pooja_booking/vw_refund_pooja_booking_list',$data);
    }
    
    public function view_refund_pooja_booking($pooja_order_id){
        $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage,concat(C.first_name," ",C.middle_name," ",C.last_name) as purohit_name,C.mobile_no,C.address,B.customer_photo,C.upload_profile_image,o.cancelled_date_time,rr.bank_name,rr.branch_name,rr.ifsc_code,rr.acc_holder_name,rr.account_number,rr.refund_status,rr.refund_date, rr.refund_time,rr.pk_id,p.pk_id as puja_id,o.total_pkg_price_exclusive,o.cancellation_charges,o.cancellation_charges,copp.cancellation_charges as purohi_cancellation_charges');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit','LEFT');
                $this->db->join('purohit_refund_request as rr','rr.fk_pooja_order_id=o.pk_id');

                $this->db->join('purohit_cancelled_order_by_purohit as copp','C.pk_id=copp.request_cancelled_by','LEFT');  
                $this->db->join('purohit_cancelled_order_by_purohit as copo','o.pk_id=copo.fk_pooja_order_id','LEFT'); 

                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                // $this->db->where('date(o.pooja_date)>',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array(); 
                // echo "<pre>";
                // print_r($order_view_data);
                // die();  
                $pendingView=array();
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                        // $this->db->select('ac.service_name');
                        // $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();

                        // $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // // $this->db->where('pss.fk_services',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();
                        
                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                        $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?($total_amount/100)*$value['purohit_percentage']:'-';


                        $value['customer_charges']=$value['total_pkg_price_exclusive']-$value['cancellation_charges'];
                    
                        $refundView[]=$value;
                    }
                }
                // echo "<pre>";
                // print_r($refundView[0]);
                // die();
                $data['refundView']=!empty($refundView)?$refundView[0]:'';
        $this->load->view('admin/pooja_booking/vw_view_refund_pooja_booking',$data);
    }
    public function add_refund($id){
        $transaction_id = !empty($this->input->post('transaction_id')) ? $this->input->post('transaction_id') : '';
        $date = !empty($this->input->post('date')) ? date('Y-m-d',strtotime($this->input->post('date'))) : '';
        $time = !empty($this->input->post('time')) ? $this->input->post('time') : '';
        $remark = !empty($this->input->post('remark')) ? $this->input->post('remark') : '';

        $table = "purohit_refund_request";
        $update_data = array(
            'transaction_id' => $transaction_id,
            'refund_date' => date('Y-m-d ', strtotime($date)),
            'refund_time' => date('H:i:s', strtotime($time)),
            'remark' => $remark,
            'refund_status' => 'Refund',
            'status' => '1',
        );
        
        $condition = array(
                'pk_id' => $id,
        );
    
        $update_id = $this->Md_database->updateData($table, $update_data, $condition); 

        $this->db->select('o.pk_id,customer_name,customer_mobile_no,cancellation_charges,total_pkg_price_exclusive,pooja_name');
        $this->db->from('purohit_refund_request as rr');
        $this->db->join('purohit_customer_pooja_order o','o.pk_id=rr.fk_pooja_order_id');     
        $this->db->join('purohit_customer_registration cr','cr.pk_id=o.fk_user_id');     
        $this->db->join('pooja p','p.pk_id=o.fk_pooja_id');
        $this->db->where('rr.pk_id', $id);
        $orederData=$this->db->get()->result_array();
        echo "<pre>"; print_r($orederData); die();
        $cancel_charges = !empty($orederData[0]['cancellation_charges'])?$orederData[0]['cancellation_charges']:0;
        $amount = $orederData[0]['total_pkg_price_exclusive'] - $cancel_charges;
        
        $message = 'Dear '.$orederData[0]['customer_name'].', your refund is successful for the amount of '.$amount.'/- for the Puja id: SP'.$orederData[0]['pk_id'].' which is cancelled by you. Transaction id: '.$transaction_id;
        
        $this->Md_database->sendSMS($message, $orederData[0]['customer_mobile_no']);
        

        $this->session->set_flashdata('success', 'Refunded details insert successfully.');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function missed_pooja_booking_list(){
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $this->db->where('pooja_city!=','');
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
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
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,pooja_city,customer_pooja_order.pk_id,pooja_time";          
        $condition = array(
            'customer_pooja_order.status!=' => '3'
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->group_start();
        $this->db->where('purohit_customer_pooja_order.fk_purohit',NULL); 
        $this->db->or_where('purohit_customer_pooja_order.puja_completed_by',NULL); 
        $this->db->group_end();
        $curr_date_time = date('Y-m-d H:i');
        $curr_date_time = $curr_date_time.':'.'00';
        $this->db->where('purohit_customer_pooja_order.pooja_date_time<', $curr_date_time); 

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
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
            $this->db->group_end();
        }
        $missedList = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        // echo "<pre>";
        // print_r($missedList);
        // die();
        $total_records=!empty($missedList) ? count($missedList) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,pooja_city,customer_pooja_order.pk_id,pooja_time";          
            $condition = array(
                'customer_pooja_order.status!=' => '3'
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->group_start();
        $this->db->where('purohit_customer_pooja_order.fk_purohit',NULL); 
        $this->db->or_where('purohit_customer_pooja_order.puja_completed_by',NULL); 
        $this->db->group_end();
        $curr_date_time = date('Y-m-d H:i');
        $curr_date_time = $curr_date_time.':'.'00';
        $this->db->where('purohit_customer_pooja_order.pooja_date_time<', $curr_date_time); 

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
            if(!empty($cust_id)){
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                $this->db->group_end();
            }
            $missedList = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');

            $params["results"] = $missedList;             
            $config['base_url'] = base_url() . 'admin/missed-pooja-booking-list';
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
        $data['missedList']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // echo "<pre>";
        // print_r($data['pendingPoojaDeatails']);
        // die();

         $this->load->view('admin/pooja_booking/vw_missed_pooja_booking_list',$data);
    }
    
    public function view_missed_pooja_booking($pooja_order_id){
        // $this->db->select("concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name, pk_id");
        //     $this->db->from('registered_purohit');
        //     $this->db->where('registered_purohit.status','1');
        //     $this->db->order_by("first_name","ASC");
        //     $purohitList=$this->db->get()->result_array();            
        //     $data['purohitList'] = $purohitList;

                 $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,B.customer_address,o.total_pkg_price_exclusive,p.short_description,o.fk_purohit,pkg.package,pkg.package_charges,o.purohit_percentage,B.customer_photo,p.pk_id as puja_id,o.total_pkg_price_exclusive,o.cancelled_date_time');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B','B.pk_id=o.fk_user_id');
                 // $this->db->join('registered_purohit as C', 'C.pk_id=o.fk_purohit','LEFT');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array(); 
                // echo "<pre>";
                // print_r($order_view_data);
                // die();  
                $pendingView=array();
                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                        // $this->db->select('ac.service_name');
                        // $this->db->select('GROUP_CONCAT(ac.service_name SEPARATOR ",") as inclusive_services');
                        $this->db->select('ac.service_name as inclusive_services');
                        $this->db->from('package_services as ps');
                        $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                        $this->db->where('fk_package',$value['pkg_id']);
                        $this->db->where('ps.status','1');
                        $this->db->where('ac.status','1');
                        $this->db->where('ps.service_type','1');
                        $services_inclusive=$this->db->get()->result_array();



                        // $this->db->select('ac.service_name as exclusive_services,charges_to_show_purohit,fk_package_id,services_charges');
                        // $this->db->distinct();
                        // $this->db->from('customer_package_services as ps');
                        // $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services_id');
                        // $this->db->join('purohit_package_services pss','pss.fk_package=ps.fk_package_id and  pss.fk_services=ps.fk_services_id');
                        // $this->db->where('pss.service_type','2');
                        // $this->db->where('pss.fk_package',$value['pkg_id']);
                        // // $this->db->where('pss.fk_services',$value['pkg_id']);
                        // $this->db->where('fk_package_id',$value['pkg_id']);
                        // $this->db->where('fk_pooja_order_id',$value['pooja_order_id']);
                        // $this->db->where('ps.status','1');
                        // $this->db->where('ac.status','1');
                        // $this->db->where('ps.service_type','2');
                        // $services_exclusive=$this->db->get()->result_array();
                        
                        $this->db->select('mas.service_name as exclusive_services, psc.charges_to_show_purohit, psc.pkg_id as fk_package_id, psc.services_charges');
                        $this->db->from('purohit_show_charges as psc');
                        $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                        $this->db->where('psc.puja_order_id', $pooja_order_id);
                        $services_exclusive = $this->db->get()->result_array();

                        $sum_charges='0';
                        foreach ($services_exclusive as $key => $val) {
                            $sum_charges = $sum_charges+$val['services_charges'];
                        }
                        $value['inclusive_services']=!empty($services_inclusive)?$services_inclusive:'';
                        $value['services_exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                        $value['sum_charges']=!empty($sum_charges)?$sum_charges:'';
                        $total_amount=!empty($sum_charges)?$sum_charges+$value['package_charges']:'0';
                        $value['total_amount']=$value['total_pkg_price_exclusive'];
                        $value['purohit_charges']=!empty($value['purohit_percentage'])?($total_amount/100)*$value['purohit_percentage']:'-';
                        $missedView[]=$value;
                    }
                }
        $data['missedView'] = $missedView[0];


         $this->load->view('admin/pooja_booking/vw_view_missed_pooja_booking',$data);
    }
     public function delete_missed_pooja_booking($pk_id) {
        $condition = array('pk_id' => $pk_id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Cancelled order details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }

    /*[Start ::  function collection log report export excel :]*/
    public function pooja_booking_export_to_excel($id){
        //$id 1-pending, 2-todays , 3-Upcomming , 4-completed , 5- refund ,6- rejected ,7- cancelled ,8-missed

        $this->load->library('Excel');
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $this->db->where('pooja_city!=','');
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;

        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
        $purohit_id = !empty($this->input->get('purohit_id')) ? trim($this->input->get('purohit_id')) : '';
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

        $data['search_term']=$search_term;
        $data['filter_city']=$filter_city;
        $data['filter_fromdate']=$filter_fromdate;
        $data['filter_todate']=$filter_todate;
        if ($id == 1) {

            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
            // $select="*";             
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
            if(!empty($cust_id)){
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                $this->db->group_end();
            }
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        }elseif ($id==2) {
            //Todays
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            $this->db->where('purohit_customer_pooja_order.pooja_date',date('Y-m-d')); 
            $this->db->where('purohit_customer_pooja_order.pooja_status!=','2');  
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
            if(!empty($cust_id)){
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
                $this->db->group_end();
            }
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');
        
        }elseif ($id == 3) {
            //Upcomming
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            // $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_package_id');
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>',date('Y-m-d')); 
            $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 

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
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');
        }elseif ($id == 4) {
            //Completed
             $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,pooja_time";             
            $condition = array(
                'customer_pooja_order.status !=' => '3',
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
            $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 

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
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');

        }elseif ($id==5) {
            //Refunded
            $table = "purohit_refund_request";         
            $select="purohit_refund_request.pk_id,purohit_refund_request.fk_pooja_order_id,p.pooja_name,cr.customer_name,cr.customer_mobile_no,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,o.cancellation_charges,o.cancellation_type,purohit_refund_request.refund_status,o.created_date,o.total_pkg_price_exclusive,o.pooja_date,pooja_time";
            //pkg.package_charges,SUM(pkgser.services_charges) as services_charges
            // $this->db->where('cancellation_type','1')
            $this->db->join('purohit_customer_pooja_order as o','o.pk_id=purohit_refund_request.fk_pooja_order_id');
            $this->db->join('purohit_pooja as p','p.pk_id=o.fk_pooja_id');
            $this->db->join('purohit_registered_purohit as rp','rp.pk_id=o.fk_purohit','LEFT');
            $this->db->join('purohit_customer_registration as cr','cr.pk_id=purohit_refund_request.fk_customer_id');
            $this->db->join('purohit_package as pkg','pkg.pk_id=o.fk_package_id');
            $condition=array('purohit_refund_request.status' => '1');
            if (!empty($filter_city)) {
                $this->db->where('o.pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)) {
                $this->db->where('date(o.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(o.pooja_date)<=',$filter_todate);  
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("p.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("cr.customer_name LIKE '%$search_term%'");       
                $this->db->or_where("p.pk_id LIKE '%$search_term%'");              
                $this->db->or_where("concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) LIKE '%$search_term%'");     
                $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();             
            }
            if(!empty($cust_id)){
                $this->db->where('purohit_refund_request.fk_customer_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('o.fk_purohit',$purohit_id);  
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
                $this->db->group_end();
            }
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'purohit_refund_request.pk_id DESC','');
            // $refundedPoojaDeatails[0]['refund_amount']="0";
            if (!empty($PoojaDeatails[0]['cancellation_charges'])) {
                $PoojaDeatails[0]['refund_amount'] =$PoojaDeatails[0]['total_pkg_price_exclusive']-$PoojaDeatails[0]['cancellation_charges'];
            }elseif (!empty($PoojaDeatails[0]['total_pkg_price_exclusive']) ){
                 $PoojaDeatails[0]['refund_amount'] =$PoojaDeatails[0]['total_pkg_price_exclusive'];
            }
        }elseif ($id == 6) {
            //Rejected
            $table = "purohit_rejected_order_by_purohit";
            $select="p.pk_id as pooja_id,p.pooja_name,cr.customer_name,cr.customer_mobile_no,po.pooja_date,po.created_date,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,pooja_city,po.pk_id,pooja_time";                        
            $this->db->join('purohit_customer_pooja_order as po','purohit_rejected_order_by_purohit.fk_pooja_order_id=po.pk_id');
            $this->db->join('pooja as p','po.fk_pooja_id=p.pk_id');
            $this->db->join('purohit_registered_purohit as rp','purohit_rejected_order_by_purohit.request_rejected_by=rp.pk_id');
            $this->db->join('customer_registration as cr','cr.pk_id=po.fk_user_id');
            $condition = array();

            // $this->db->group_by('purohit_rejected_order_by_purohit.fk_pooja_order_id'); 
            $this->db->where('po.status!=','3'); 

            $this->db->group_by('purohit_rejected_order_by_purohit.fk_pooja_order_id');  
            if (!empty($filter_city)) {
                    $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)) {
                $this->db->where('date(purohit_po.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(purohit_customer_po.pooja_date)<=',$filter_todate);  
            }
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("p.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("cr.customer_name LIKE '%$search_term%'");
                $this->db->or_where("p.pk_id LIKE '%$search_term%'"); 
                $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");
                $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
                $this->db->or_where("cr.customer_mobile_no LIKE '%$search_term%'");
                $this->db->group_end();       
            }
            if(!empty($cust_id)){
                $this->db->where('po.fk_user_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('po.fk_purohit',$purohit_id);  
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
                $this->db->group_end();
            }
           
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'purohit_rejected_order_by_purohit.pk_id DESC','');


        }elseif ($id == 7) {
            //Cancelled
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status,customer_pooja_order.cancelled_date_time,pooja_time";             
            // $select="*";             
            $condition = array();
       
          if (empty($purohit_id)){
                $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
                $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
                $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');  
                $this->db->where('customer_pooja_order.status!=','3'); 
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
                $this->db->or_where('purohit_customer_pooja_order.pooja_status','4');  
                $this->db->group_end();
            } else{
                $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
                $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
                $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');  
                $this->db->join('purohit_cancelled_order_by_purohit as copp','purohit_registered_purohit.pk_id=copp.request_cancelled_by');  
                $this->db->join('purohit_cancelled_order_by_purohit as copo','customer_pooja_order.pk_id=copo.fk_pooja_order_id');  
                $this->db->where('customer_pooja_order.status!=','3'); 
            }
            if (!empty($filter_city)) {
                $this->db->where('pooja_city',$filter_city);  
            }
            if (!empty($filter_fromdate)){
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
            }
            if (!empty($filter_todate)) {
                $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('copp.request_cancelled_by',$purohit_id);  
                // $this->db->or_where('purohit_customer_pooja_order.request_accepted_by',$purohit_id);  
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
            //     print_r($cust_id);
            // die();
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        }elseif ($id == 8){
            //Missed
            $table = "customer_pooja_order";
            $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,pooja_city,customer_pooja_order.pk_id,pooja_time";          
            $condition = array(
                'customer_pooja_order.status!=' => '3'
            );
            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->where('purohit_customer_pooja_order.fk_purohit',NULL); 
            $this->db->where('purohit_customer_pooja_order.pooja_date<',date('Y-m-d')); 

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
            if(!empty($cust_id)){
                $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
            }
            if (!empty($purohit_id)) {
                $this->db->group_start();
                $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                $this->db->group_end();
            }
            $PoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        }

      /*[:: Start Collection report excel sheet  Name::]*/
      //$id 1-pending, 2-todays , 3-Upcomming , 4-completed , 5- refund ,6- rejected ,7- cancelled ,8-missed
      if ($id==1) {
           $comm_title ="Pending Pooja Booking";
      }elseif ($id==2) { 
           $comm_title ="Todays Pooja Booking";
      }elseif ($id==3) {
           $comm_title ="Upcomming Pooja Booking";
      }elseif ($id== 4) {         
           $comm_title ="Completed Pooja Booking";
      }elseif ($id==5) {         
           $comm_title ="Refunded Pooja Booking";
      }elseif ($id==6) {
           $comm_title ="Rejected Pooja Booking";
      }elseif ($id==7) {         
           $comm_title ="Cancelled Pooja Booking";
      }elseif ($id == 8) {
           $comm_title ="Missed Pooja Booking";
      }
      $date_title ="all_time";
      $user_title ="all";
        /*[:: End Collection report excel sheet  Name::]*/

      if (!empty($PoojaDeatails)) {
            $finalsArray = $PoojaDeatails;
            $this->excel->getActiveSheet()->setTitle('RemarksReport');
            $date = date('d-m-Y g:i A'); // get current date time
            $cnt = count($finalsArray);
              
 
            $counter = 1; 
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'City');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter,  $filter_city);
              $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$counter, 'From Date');
              $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$counter,  $filter_fromdate);
              $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$counter, 'To Date');
              $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$counter,  $filter_todate);
  
            $counter = 2;
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'Sr.No.');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter, 'Puja Id');
              $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$counter, 'Puja Name');
              $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$counter, 'Puja Ordered Date & Time');
              $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$counter, 'Customer Name');
              $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$counter, 'Customer Mobile Number');
              $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$counter, 'Purohit Name');
              $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$counter, 'Puja City');
              $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$counter, 'Puja Scheduled On');
           
              // set auto size for columns
              $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

              $from = "A1"; // or any value
              $to = "N1"; // or any value $from = "A1"; // or any value
              $this->excel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
              $from = "A2"; // or any value
              $to = "N2"; // or any value
              $this->excel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
 
              $date = date('d-m-Y g:i A');
              $cnt = count($finalsArray);
            $counter = 3;

              if (!empty($finalsArray)){
                  $j = 1;
                  foreach ($finalsArray as $arrayUser) {
                      $created_date = !empty($arrayUser['created_date']) ?date('d-m-Y',strtotime( $arrayUser['created_date'])) :'';
                      $pooja_id = !empty($arrayUser['pk_id']) ? $arrayUser['pk_id']:'-';
                      $pooja_name = !empty($arrayUser['pooja_name']) ? $arrayUser['pooja_name']:''; 
                      $customer_name = !empty($arrayUser['customer_name']) ? $arrayUser['customer_name']:'';
                      $customer_mobile_no = !empty($arrayUser['customer_mobile_no']) ? $arrayUser['customer_mobile_no']:'';
                      $purohit_name = !empty($arrayUser['purohit_name']) ? $arrayUser['purohit_name']:'';
                      $pooja_city = !empty($arrayUser['pooja_city']) ? $arrayUser['pooja_city']:'';
                      $pooja_date = !empty($arrayUser['pooja_date']) ?date('d-m-Y',strtotime( $arrayUser['pooja_date'])) :'';
                      $created_date = !empty($arrayUser['created_date']) ?date('d-m-Y',strtotime( $arrayUser['created_date'])) :'';
                      $pooja_time = !empty($arrayUser['pooja_time']) ? $arrayUser['pooja_time'] :'';
            
                        
                      $this->excel->setActiveSheetIndex(0)
                          ->setCellValue('A' . $counter, (!empty($j) ? $j : ''))
                          ->setCellValue('B' . $counter, (!empty($pooja_id) ? "SP". $pooja_id : "-"))
                          ->setCellValue('C' . $counter, (!empty($pooja_name) ? $pooja_name : "-"))

                          ->setCellValue('D' . $counter, (!empty($created_date) ? $created_date."    ". $pooja_time : "-") )
                          ->setCellValue('E' . $counter, (!empty($customer_name) ? $customer_name : "-"))
                          ->setCellValue('F' . $counter, (!empty($customer_mobile_no) ? $customer_mobile_no : "-"))
                          ->setCellValue('G' . $counter, (!empty($purohit_name) ? $purohit_name : "-"))
                          ->setCellValue('H' . $counter, (!empty($pooja_city) ? $pooja_city : "-"))
                          ->setCellValue('I' . $counter, (!empty($pooja_date) ? $pooja_date : "-"));

                      $counter++;
                      $j++;
                  }
                  $this->excel->setActiveSheetIndex(0);                   
              }
                  // Download code for excel
              header('Content-Encoding: UTF-8');
              header('Content-type: text/csv; charset=UTF-8');
              header('Content-Type: application/vnd.ms-excel charset=UTF-8');
              header('Content-Disposition: attachment;filename='.$comm_title.'.xls');
              header('Cache-Control: max-age=0');
              // If you're serving to IE 9, then the following may be needed
              header('Cache-Control: max-age=1');
              //If you're serving to IE over SSL, then the following may be needed
              header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
              header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
              header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
              header('Pragma: public'); // HTTP/1.0
              ob_start();
              $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
              ob_end_clean();
              $objWriter->save('php://output');
              exit;
      }else{
            redirect(base_url() . 'admin/payment-history');
      }
    }
    /*[End ::  function collection log report export excel :]*/
    
   
}
