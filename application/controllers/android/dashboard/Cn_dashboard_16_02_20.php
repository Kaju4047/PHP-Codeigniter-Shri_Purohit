<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_dashboard extends CI_Controller {

    public function request_list() {

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
   

            $this->db->select('COALESCE(fk_pooja_order_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(fk_customer_id, "") as fk_customer_id,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(C.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('purohit_purohit_request_record as pr');
            $this->db->join('pooja as A', 'A.pk_id=pr.fk_pooja_id');
            $this->db->join('customer_registration as B', 'B.pk_id=pr.fk_customer_id');
            $this->db->join('customer_pooja_order as C', 'C.pk_id=pr.fk_pooja_order_id');
            $this->db->where('C.status','1');
            // $this->db->where('C.pooja_order_status','2');
            $this->db->where('C.fk_purohit',null);
            $this->db->where('C.pooja_status','5');
    
            $this->db->group_start();
            $this->db->where('C.pooja_status!=','3');
            $this->db->or_where('C.pooja_status!=','4');
             $this->db->group_end();
          
            $this->db->where('pr.fk_purohit_id',$purohit_id);
            $this->db->order_by('pr.pk_id desc');
            $purohit_request_data=$this->db->get()->result_array();
            // print_r($purohit_request_data);die();
            $finalarray=array();
            if ($purohit_request_data) {
                foreach ($purohit_request_data as $key => $value) {
            $this->db->select('fk_pooja_order_id,request_rejected_by');
            $this->db->from('rejected_order_by_purohit');
            $this->db->where('status','1');
            $this->db->where('fk_pooja_order_id',$value['fk_pooja_order_id']);
            $this->db->where('request_rejected_by',$purohit_id);
            $check_reject_req=$this->db->get()->result_array();

            $this->db->select('fk_pooja_order_id,request_cancelled_by');
            $this->db->from('cancelled_order_by_purohit');
            $this->db->where('status','1');
            $this->db->where('fk_pooja_order_id',$value['fk_pooja_order_id']);
            $this->db->where('request_cancelled_by',$purohit_id);
            $check_cancelled_req=$this->db->get()->result_array();

// print_r($check_cancelled_req);die();
                if (empty($check_reject_req) && empty($check_cancelled_req)) {
                                $finalarray[]=$value;

                    }
                }
            }
            $purohit_request_list=$finalarray;

            $output= array_slice($purohit_request_list,$offset,$limit);

            if (!empty($output)) {

                $resultarray = array('error_code' => '1','purohit_request_list'=>$output, 'request_list_count'=>count($output),'message' => 'Request List.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "User record are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

        public function today_list() {

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
   

            $this->db->select('COALESCE(fk_pooja_order_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(fk_customer_id, "") as fk_customer_id,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(C.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('purohit_purohit_request_record as pr');
            $this->db->join('pooja as A', 'A.pk_id=pr.fk_pooja_id');
            $this->db->join('customer_registration as B', 'B.pk_id=pr.fk_customer_id');
            $this->db->join('customer_pooja_order as C', 'C.pk_id=pr.fk_pooja_order_id');
            $this->db->where('C.status','1');
            $this->db->where('C.pooja_order_status','1');
            $this->db->group_start();
            $this->db->where('C.pooja_status!=','3');
            $this->db->or_where('C.pooja_status!=','4');
             $this->db->group_end();
            $this->db->group_start();
            $this->db->where('C.pooja_status','5');
            $this->db->or_where('C.pooja_status','1');
            $this->db->group_end();
            $this->db->where('date(C.pooja_date)=',date('Y-m-d'));
            $this->db->where('C.fk_purohit',$purohit_id);
            $this->db->order_by('C.updated_date desc');
            $this->db->group_by('pr.fk_pooja_order_id');
            // $this->db->limit($limit, $offset);

            $purohit_today_data=$this->db->get()->result_array();

// print_r($purohit_today_data);die();
           $finalarray=array();
            if ($purohit_today_data) {
                foreach ($purohit_today_data as $key => $value) {
            $this->db->select('fk_pooja_order_id,request_rejected_by');
            $this->db->from('rejected_order_by_purohit');
            $this->db->where('status','1');
            $this->db->where('fk_pooja_order_id',$value['fk_pooja_order_id']);
            $this->db->where('request_rejected_by',$purohit_id);
            $check_reject_req=$this->db->get()->result_array();

            $this->db->select('fk_pooja_order_id,request_cancelled_by');
            $this->db->from('cancelled_order_by_purohit');
            $this->db->where('status','1');
            $this->db->where('fk_pooja_order_id',$value['fk_pooja_order_id']);
            $this->db->where('request_cancelled_by',$purohit_id);
            $check_cancelled_req=$this->db->get()->result_array();

// print_r($check_cancelled_req);die();
                if (empty($check_reject_req) && empty($check_cancelled_req)) {
                                $finalarray[]=$value;

                    }
                }
            }
            $purohit_today_list=$finalarray;

            $output= array_slice($purohit_today_list,$offset,$limit);

// print_r($output);die();
            if (!empty($output)) {

                $resultarray = array('error_code' => '1','purohit_today_list'=>$output, 'today_list_count'=>count($output), 'message' => 'Today List.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Today List are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }
      public function upcoming_list() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $limit = !empty($this->input->post('limit')) ? $this->input->post('limit') : '';
        $offset = !empty($this->input->post('offset')) ? $this->input->post('offset') : '';
        

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
   

            $this->db->select('COALESCE(fk_pooja_order_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(fk_customer_id, "") as fk_customer_id,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(C.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('purohit_purohit_request_record as pr');
            $this->db->join('pooja as A', 'A.pk_id=pr.fk_pooja_id');
            $this->db->join('customer_registration as B', 'B.pk_id=pr.fk_customer_id');
            $this->db->join('customer_pooja_order as C', 'C.pk_id=pr.fk_pooja_order_id');
            $this->db->where('C.status','1');
            $this->db->where('C.pooja_status','5');
            $this->db->group_start();
            $this->db->where('C.pooja_status!=','3');
            $this->db->or_where('C.pooja_status!=','4');
            $this->db->group_end();
            $this->db->where('C.pooja_order_status','1');
            $this->db->where('date(C.pooja_date)>',date('Y-m-d'));
            $this->db->where('C.fk_purohit',$purohit_id);
            $this->db->order_by('C.updated_date desc');
            $this->db->group_by('pr.fk_pooja_order_id');
            $this->db->limit($limit, $offset);

            $purohit_upcoming_data=$this->db->get()->result_array();


            if (!empty($purohit_upcoming_data)) {

                $resultarray = array('error_code' => '1','purohit_upcoming_list'=>$purohit_upcoming_data, 'upcoming_list_count'=>count($purohit_upcoming_data), 'message' => 'Upcoming List.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Upcoming List are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

       public function request_list_view() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
    
        

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
   

                $this->db->select('o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,pkg.purohit_percentage');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                // $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                $address=!empty($order_view_data[0]['pooja_area'])?$order_view_data[0]['pooja_area']:'';
                $finalarray=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                $this->db->select('ac.service_name');
                $this->db->from('package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','1');
                $services_inclusive=$this->db->get()->result_array();

                $services_exclusive=array();
                $this->db->select('charges_to_show_purohit,fk_services_id');
                $this->db->from('customer_package_services as ps');
                $this->db->join('package_services ac','ac.fk_services=ps.fk_services_id');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.fk_pooja_order_id',$value['pooja_order_id']);
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
               
                $row['service_name']=!empty($services_exclusive_name[0]['service_name'])?$services_exclusive_name[0]['service_name']:'';
                $services_exclusive[]=$row;
                  }
                }

                $value['inclusive']=!empty($services_inclusive)?$services_inclusive:'';
                $value['exclusive']=!empty($services_exclusive)?$services_exclusive:'';

                           $string = str_replace(" ", "+", urlencode($address));
       
                    $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyD19o3ef65KJnJ9qCKaph5XuR-hSW6sfXM";
                    // $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyB_xszHIFJdaN9ALAfGx9savLRf4HFnOoc";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $details_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $response = json_decode(curl_exec($ch), true);
                    // print_r($response);die();

                $geometry = !empty($response['results'][0]['geometry'])?$response['results'][0]['geometry']:'';

                $longitude = !empty($geometry['location']['lat'])?$geometry['location']['lat']:'';
                $latitude = !empty($geometry['location']['lng'])?$geometry['location']['lng']:'';
                $value['lat']=$longitude;
                $value['lng']=$latitude;

                 $finalarray[]=$value;

                    }
                }
                $pooja_order_view=$finalarray;
          


            if (!empty($pooja_order_view)) {

                $resultarray = array('error_code' => '1','Pooja_order_view'=>$pooja_order_view,'profile_image'=>base_url().'upload/customer_profile/', 'message' => 'Pooja details.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Pooja details are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }
        public function request_accept_reject() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
        $accept_reject = !empty($this->input->post('accept_reject')) ? $this->input->post('accept_reject') : "";
        // 1 For accept and 2 reject
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status,first_name,middle_name,last_name';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');
        $first_name=!empty($checkuser[0]['first_name'])?ucfirst($checkuser[0]['first_name']):'';
        $middle_name=!empty($checkuser[0]['middle_name'])?ucfirst($checkuser[0]['middle_name']):'';
        $last_name=!empty($checkuser[0]['last_name'])? ucfirst($checkuser[0]['last_name']):'';
        $purohit_name=$first_name.' '.$middle_name.' '.$last_name;

        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   
            $request_status_update=array();
        
            if (!empty($accept_reject) && $accept_reject =='1') {
               
            $request_status_update['pooja_order_status']='1';
            $request_status_update['updated_date']=date('Y-m-d H:i:s');
            $request_status_update['fk_purohit']=$purohit_id;
            $res=$this->Md_database->updateData('customer_pooja_order',$request_status_update,array('pk_id'=>$pooja_order_id));
            
            $msg='accepted';
            } else if (!empty($accept_reject) && $accept_reject=='2') {
            $reject_status_insert['fk_pooja_order_id']=$pooja_order_id;
            $reject_status_insert['request_rejected_by']=$purohit_id;
            $reject_status_insert['created_date']=date('Y-m-d H:i:s');
            $reject_status_insert['created_by']=$purohit_id;
            $reject_status_insert['status']='1';
            $msg='rejected';
            $res=$this->Md_database->insertData('rejected_order_by_purohit',$reject_status_insert);  
            }

              /*[start]:: send message  and mail to customer when order accept or reject*/

                $this->db->select('fk_user_id,pooja_name,pooja_date,pooja_time,pooja_address,pooja_city');
                $this->db->from('customer_pooja_order as A');
                $this->db->join('pooja as B', 'B.pk_id=A.fk_pooja_id');
                $this->db->where('A.pk_id',$pooja_order_id); 
                $this->db->where('A.status',1); 
                $order_data = $this->db->get()->result_array();
                $customer_id=!empty($order_data[0]['fk_user_id'])?$order_data[0]['fk_user_id']:'';
                $pooja_name=!empty($order_data[0]['pooja_name'])?$order_data[0]['pooja_name']:'';
                $pooja_date=!empty($order_data[0]['pooja_date'])?$order_data[0]['pooja_date']:'';
                $pooja_time=!empty($order_data[0]['pooja_time'])?$order_data[0]['pooja_time']:'';

                $this->db->select('customer_name,customer_mobile_no,customer_email_id');
                $this->db->from('customer_registration');
                $this->db->where('pk_id',$customer_id); 
                $this->db->where('status',1); 
                $customer_data = $this->db->get()->result_array();
                $customer_name=!empty($customer_data[0]['customer_name'])? ucwords($customer_data[0]['customer_name']):'';
                $customer_mobile_no=!empty($customer_data[0]['customer_mobile_no'])?$customer_data[0]['customer_mobile_no']:'';
                $customer_email_id=!empty($customer_data[0]['customer_email_id'])? strtolower($customer_data[0]['customer_email_id']):'';

            if (!empty($accept_reject) && $accept_reject =='1') {
               
                
            $message = 'Dear '.ucwords($customer_name).', your request for '.$pooja_name.' on '.date('d-m-Y',strtotime($pooja_date)). ',time '.$pooja_time.' is accepted by the Purohit ' .$purohit_name .'. To view status of your request click on <a href="'.base_url().'" target=_blank>'.base_url().'</a>. For More details you can chat with our Purohit on our website.';
                $subject = 'Puja Request Accepted';
             $txtmessage = 'Dear '.ucwords($customer_name).', your request for '.$pooja_name.' on '.date('d-m-Y',strtotime($pooja_date)). ',time '.$pooja_time.' is accepted by the Purohit ' .$purohit_name .'. To view status of your request click on '.base_url().' For More details you can chat with our Purohit on our website.';
         

            }else if (!empty($accept_reject) && $accept_reject=='2') {
    
            $message = 'Dear '.ucwords($customer_name).', your request for '.$pooja_name.' on '.date('d-m-Y',strtotime($pooja_date)). ', time '.$pooja_time.' is rejected by the Purohit ' .$purohit_name .'. To view status of your request click on <a href="'.base_url().'" target=_blank>'.base_url().'</a>. For More details you can chat with our Purohit on our website.';

            $txtmessage = 'Dear '.ucwords($customer_name).', your request for '.$pooja_name.' on '.date('d-m-Y',strtotime($pooja_date)). ', time '.$pooja_time.' is rejected by the Purohit ' .$purohit_name .'. To view status of your request click on '.base_url().' For More details you can chat with our Purohit on our website.';
            $subject = 'Puja Request Rejected';
                }

                    $recipeinets = $customer_email_id;
                    $from = array(
                        "email" => SITE_MAIL,
                        "name" => SITE_TITLE
                    );
                    $reserved_words = array(
                        // "||USER_NAME||" => ucwords($customer_name),
                        "||SITE_TITLE||" => SITE_TITLE,
                        // "||DATE||" => date('d-m-Y h:i:s A'),
                    
                        "||MESSGAE||" => $message,
                        "||SUBJECT||" => $subject,
                        "||YEAR||" => date('Y'),
                    );
                    $email_data = $this->Md_database->getEmailInfo('purohit_accept_reject', $reserved_words);
                    
                // print_r($email_data);die();
                    $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
              
                $this->Md_database->sendSMS($txtmessage, $customer_mobile_no);
                /*[End]:: send message  and mail to customer when order accept or reject*/

              // mail to admin
                $orgdata = $this->Md_database->getData('static_organizationmaster', '*');
                $orgemail = !empty($orgdata[0]['om_CmpEmail']) ? $orgdata[0]['om_CmpEmail'] : '';

                $recipeinets1 = $orgemail;
                $from1 = array(
                    "email" => $customer_email_id,
                    "name"=>ucwords($customer_name)
                );
                $subject1 = 'Puja Request Accepted';
                $admin_msg = 'The request for '.$pooja_name.' booked by '.ucwords($customer_name).' for date '.date('d-m-Y',strtotime($pooja_date)). ', time '.$pooja_time.' is accepted by Purohit ' .$purohit_name;
                $reserved_words = array(

                    "||SITE_TITLE||" => SITE_TITLE,
                
                    "||MESSAGE||" => ucfirst($admin_msg),
                    "||SITE_URL||" => base_url(),
                    "||YEAR||" => date('Y'),
                );
                $email_data = $this->Md_database->getEmailInfo('puja_accept_admin', $reserved_words);
                // print_r($email_data);die();
               
                $ml = $this->Md_database->sendEmail($recipeinets1, $from1, $subject1, $email_data['content']);


            if (!empty($res)) {

                $resultarray = array('error_code' => '1', 'message' => "Request ".$msg.' successfully.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => 'Fail.'
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

       public function upcoming_list_view() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
    
        

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
   

                $this->db->select('B.pk_id as fk_customer_id,o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,purohit_percentage');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                $this->db->where('date(o.pooja_date)>',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                $address=!empty($order_view_data[0]['pooja_area'])?$order_view_data[0]['pooja_area']:'';
                $finalarray=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                $this->db->select('ac.service_name');
                $this->db->from('package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','1');
                $services_inclusive=$this->db->get()->result_array();

                $services_exclusive=array();
                $this->db->select('charges_to_show_purohit,fk_services_id');
                $this->db->from('customer_package_services as ps');
                $this->db->join('package_services ac','ac.fk_services=ps.fk_services_id');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.fk_pooja_order_id',$value['pooja_order_id']);
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
               
                $row['service_name']=!empty($services_exclusive_name[0]['service_name'])?$services_exclusive_name[0]['service_name']:'';
                $services_exclusive[]=$row;
                  }
                }

                $value['inclusive']=!empty($services_inclusive)?$services_inclusive:'';
                $value['exclusive']=!empty($services_exclusive)?$services_exclusive:'';


                    $string = str_replace(" ", "+", urlencode($address));
       
                    $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyD19o3ef65KJnJ9qCKaph5XuR-hSW6sfXM";
                    // $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyB_xszHIFJdaN9ALAfGx9savLRf4HFnOoc";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $details_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $response = json_decode(curl_exec($ch), true);
                    // print_r($response);die();

                $geometry = !empty($response['results'][0]['geometry'])?$response['results'][0]['geometry']:'';

                $longitude = !empty($geometry['location']['lat'])?$geometry['location']['lat']:'';
                $latitude = !empty($geometry['location']['lng'])?$geometry['location']['lng']:'';
                $value['lat']=$longitude;
                $value['lng']=$latitude;

                 $finalarray[]=$value;

                    }
                }
                $pooja_upcoming_order_view=$finalarray;
          


            if (!empty($pooja_upcoming_order_view)) {

                $resultarray = array('error_code' => '1','Pooja_upcoming_order_view'=>$pooja_upcoming_order_view,'profile_image'=>base_url().'upload/customer_profile/', 'message' => 'Pooja details.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Pooja details are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

        public function upcoming_list_view_cancel() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
        $cancell_status = !empty($this->input->post('cancell_status')) ? $this->input->post('cancell_status') : "";
        // 4 for cancelled
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status,city_name,first_name,middle_name,last_name,token';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');
        $city=!empty($checkuser[0]['city_name'])?ucfirst($checkuser[0]['city_name']):'';
        $first_name=!empty($checkuser[0]['first_name'])?ucfirst($checkuser[0]['first_name']):'';
        $middle_name=!empty($checkuser[0]['middle_name'])?ucfirst($checkuser[0]['middle_name']):'';
        $last_name=!empty($checkuser[0]['last_name'])? ucfirst($checkuser[0]['last_name']):'';
        $token=!empty($checkuser[0]['token'])? $checkuser[0]['token']:'';
        $purohit_name=$first_name.' '.$middle_name.' '.$last_name;


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   
            $request_status_update=array();
        
        if (!empty($cancell_status) && $cancell_status=='4') {
      


                /*[start]:: send message  and mail to customer when order cancelled by purohit*/

                $this->db->select('fk_user_id,fk_pooja_id,fk_package_id,pooja_date,pooja_time,total_pkg_price_exclusive,pooja_name');
                $this->db->from('customer_pooja_order as A');
                $this->db->join('pooja as p','p.pk_id=A.fk_pooja_id');
                $this->db->where('A.pk_id',$pooja_order_id); 
                $this->db->where('A.status',1); 
                $order_data = $this->db->get()->result_array();
                $customer_id=!empty($order_data[0]['fk_user_id'])?$order_data[0]['fk_user_id']:'';
                $pooja_id=!empty($order_data[0]['fk_pooja_id'])?$order_data[0]['fk_pooja_id']:'';
                $package_id=!empty($order_data[0]['fk_package_id'])?$order_data[0]['fk_package_id']:'';
                $pooja_name=!empty($order_data[0]['pooja_name'])? ucwords($order_data[0]['pooja_name']):'';

                $date_of_puja=!empty($order_data[0]["pooja_date"])?$order_data[0]["pooja_date"]:'';
                $time_of_puja=!empty($order_data[0]["pooja_time"])?$order_data[0]["pooja_time"]:'';
          

                $puja_data_before48=date('Y-m-d', strtotime($date_of_puja . " -48 hours"));
                $puja_time_before48=date('H:i A', strtotime($time_of_puja . " -48 hours"));
                $data_time_for_cancellation=$puja_data_before48.' '.$puja_time_before48;
                $current_time = date('Y-m-d H:i A');
                $fine_for_cancel=0;
                // echo "<pre>";print_r($puja_data_before48);die();
                if(date($current_time) > date($data_time_for_cancellation)){

                    $this->db->select('fine_for_purohit');
                    $this->db->from('master_fine_for_purohit');
                    $this->db->where('status','1');
                    $this->db->limit('1');
                    $this->db->order_by('pk_id','desc');
                    $cancellation_charges_data=$this->db->get()->result_array();
                  

                     $fine_for_cancel=!empty($cancellation_charges_data[0]['fine_for_purohit']) ?$cancellation_charges_data[0]['fine_for_purohit']:'';

                     //Fine deduction notification for Purohit on canceling the puja within 48hrs
                    $message = 'Dear '.$purohit_name.', amount '.$fine_for_cancel.'/- deducted from your balance amount  as the '.$pooja_name.' (Puja id: SP'.$pooja_order_id.') is cancelled by you within 48hrs of Puja.';
                    $subject = 'Cancellation Fine';
                    $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "notification");
                    $target=$token;

                    $this->Md_database->sendPushNotification($resultarray,$target);

                      $table = "notifications";
                            $insert_data = array(
                                
                                'fk_purohit_id' => $purohit_id,
                                'fk_pooja_order_id' => $pooja_order_id,
                                'title'=>$subject,
                                'message' => $message,
                                'redirecttype' => 'notification',
                                'status' => '1',
                                'notification_datetime' => date('Y-m-d H:i:s'),
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);

                     
                  }

                $this->db->select('customer_name,customer_mobile_no,customer_email_id');
                $this->db->from('customer_registration');
                $this->db->where('pk_id',$customer_id); 
                $this->db->where('status',1); 
                $customer_data = $this->db->get()->result_array();
                $customer_name=!empty($customer_data[0]['customer_name'])? ucwords($customer_data[0]['customer_name']):'';
                $customer_mobile_no=!empty($customer_data[0]['customer_mobile_no'])?$customer_data[0]['customer_mobile_no']:'';
                $customer_email_id=!empty($customer_data[0]['customer_email_id'])? strtolower($customer_data[0]['customer_email_id']):'';

          
               
                $message = 'Purohit ' .$purohit_name .' has cancelled puja request, '.'SP'.$pooja_order_id;
                $subject = 'Purohit '.$purohit_name.' '.'has cancelled puja';
        

                    $recipeinets = $customer_email_id;
                    $from = array(
                        "email" => SITE_MAIL,
                        "name" => SITE_TITLE
                    );
                    $reserved_words = array(
                        "||USER_NAME||" => $customer_name,
                        "||SITE_TITLE||" => SITE_TITLE,
                        "||DATE||" => date('d-m-Y h:i:s A'),
                    
                        "||MESSGAE||" => $message,
                        "||SUBJECT||" => $subject,
                        "||YEAR||" => date('Y'),
                    );
                    $email_data = $this->Md_database->getEmailInfo('purohit_cancel_order', $reserved_words);
                    
                // print_r($email_data);die();
                    $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
              
                    $this->Md_database->sendSMS($message, $customer_mobile_no);
                /*[End]:: send message  and mail to customer when order cancelled by purohit*/
                    $msg='cancelled';
            
                    $request_status_insert['fk_pooja_order_id']=$pooja_order_id;
                    $request_status_insert['created_date']=date('Y-m-d H:i:s');
                    $request_status_insert['request_cancelled_by']=$purohit_id;
                    $request_status_insert['created_by']=$purohit_id;
                    $request_status_insert['cancellation_charges']=$fine_for_cancel;
                    $res=$this->Md_database->insertData('cancelled_order_by_purohit',$request_status_insert); 

                    $table = "purohit_purohit_transaction_history";
                            $insert_data = array(
                                
                                'fk_purohit_id' => $purohit_id,
                                'fk_pooja_order_id' => $pooja_order_id,
                                'transaction_type'=>'1',
                                'amount' => $fine_for_cancel,
                                'status' => '1',);
                    $this->Md_database->insertData($table, $insert_data);
                                 /*Start::Send Request & push notification to purohit only send area wise those user have area*/
                     
                    $this->db->select('token,pk_id,location,mobile_no,first_name,middle_name,last_name');
                    $this->db->from('registered_purohit');
                    $this->db->where('city_name',$city);
                    $this->db->where('pk_id!=',$purohit_id);
                    $this->db->where('status','1');
                    $purohit_data=$this->db->get()->result_array();

                    // print_r($purohit_data);die();
                        if (!empty($purohit_data)) {
                    foreach ($purohit_data as $val) {
                        $first_name=!empty($val['first_name'])?ucwords($val['first_name']):'';

                        $middle_name=!empty($val['middle_name'])? ucwords($val['middle_name']):'';
                        $last_name=!empty($val['last_name'])?ucwords($val['last_name']):'';
                        $purohit_name=$first_name.' '.$middle_name.' '. $last_name;

                

                        // print_r($userdata);die();
                        if (!empty($val['token'])) {
                        /*Start::Request insert into purohit_request_record table */  
                       
                        $cond = array('fk_pooja_order_id' => $pooja_order_id,'fk_purohit_id'=>$val['pk_id']);
                        $ret = $this->Md_database->deleteData('purohit_purohit_request_record', $cond);

                            $table = "purohit_purohit_request_record";
                            $insert_data = array(
                                'fk_customer_id'=>$customer_id,
                                'fk_purohit_id' => $val['pk_id'],
                                'fk_pooja_id' => $pooja_id,
                                'fk_pooja_order_id'=>$pooja_order_id,
                                'fk_pkg_id' => $package_id,
                                'request' => '1',
                                'status' => '1',
                                'created_date' => date('Y-m-d H:i:s'),
                                'created_by' =>$customer_id,
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);

                        /*End::Request insert into purohit_request_record table */

                         
                            $message = 'Dear ' .$purohit_name .', you have received new puja request from '.$customer_name.'.Please check Shri Purohit App for more details.';
                            $subject = 'Puja request';
                            $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "order");
                            $target=!empty($val['token'])?$val['token']:'';
                            // print_r($target);die();
                            $mobile_no=!empty($val['mobile_no'])?$val['mobile_no']:'';

                            $this->Md_database->sendPushNotification($resultarray,$target);

                           
              
                            $this->Md_database->sendSMS($message, $mobile_no);

                            $table = "notifications";
                            $insert_data = array(
                                
                                'fk_purohit_id' => $val['pk_id'],
                                'fk_pooja_order_id' => $pooja_order_id,
                                'title'=>$subject,
                                'message' => $message,
                                'redirecttype' => 'order',
                                'status' => '1',
                                'notification_datetime' => date('Y-m-d H:i:s'),
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);



                        }
                    }
                }
                 //update fk_purohit empty && pooja_order_status  when cancelled order by purohit
           
                    $update_data['pooja_order_status']='2';
                    $update_data['pooja_order_date_plus1']=date("Y-m-d H:i:s", strtotime("+1 hours"));
                    $update_data['fk_purohit']=null;
                    $cond = array('pk_id' => $pooja_order_id);
                    $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $cond);
                 /*End::Send Request &  push notification to purohit only send area wise those user have area and location*/

            }
          


            if (!empty($res)) {

                $resultarray = array('error_code' => '1', 'message' => "Request ".$msg.' successfully.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => 'Fail.'
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

        public function today_list_view() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
    
        

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
   

                $this->db->select('B.pk_id as fk_customer_id,o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,o.reached_date_time,o.reached_otp,o.completed_date_time,o.completed_otp,o.reached_otp_verified,pkg.purohit_percentage');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                // $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                $this->db->where('date(o.pooja_date)=',date('Y-m-d'));
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data=$this->db->get()->result_array();
                $address=!empty($order_view_data[0]['pooja_area'])?$order_view_data[0]['pooja_area']:'';

                $finalarray=array();

                if (!empty($order_view_data)) {
                    foreach ($order_view_data as $key => $value) {
                $this->db->select('ac.service_name');
                $this->db->from('package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','1');
                $services_inclusive=$this->db->get()->result_array();

                $services_exclusive=array();
                $this->db->select('charges_to_show_purohit,fk_services_id');
                $this->db->from('customer_package_services as ps');
                $this->db->join('package_services ac','ac.fk_services=ps.fk_services_id');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.fk_pooja_order_id',$value['pooja_order_id']);
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
               
                $row['service_name']=!empty($services_exclusive_name[0]['service_name'])?$services_exclusive_name[0]['service_name']:'';
                $services_exclusive[]=$row;
                  }
                }

                $value['inclusive']=!empty($services_inclusive)?$services_inclusive:'';
                $value['exclusive']=!empty($services_exclusive)?$services_exclusive:'';

                    $string = str_replace(" ", "+", urlencode($address));
       
                    $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyD19o3ef65KJnJ9qCKaph5XuR-hSW6sfXM";
                    // $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$string."&key=AIzaSyB_xszHIFJdaN9ALAfGx9savLRf4HFnOoc";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $details_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $response = json_decode(curl_exec($ch), true);
                    // print_r($response);die();

                $geometry = !empty($response['results'][0]['geometry'])?$response['results'][0]['geometry']:'';

                $longitude = !empty($geometry['location']['lat'])?$geometry['location']['lat']:'';
                $latitude = !empty($geometry['location']['lng'])?$geometry['location']['lng']:'';
                $value['lat']=$longitude;
                $value['lng']=$latitude;

                 $finalarray[]=$value;

                    }
                }
                $pooja_today_order_view=$finalarray;
          


            if (!empty($pooja_today_order_view)) {

                $resultarray = array('error_code' => '1','Pooja_today_order_view'=>$pooja_today_order_view,'profile_image'=>base_url().'upload/customer_profile/', 'message' => 'Pooja details.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Pooja details are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }
        public function today_list_view_cancel() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
        $cancell_status = !empty($this->input->post('cancell_status')) ? $this->input->post('cancell_status') : "";
        // 4 for cancelled
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status,city_name,first_name,middle_name,last_name,token';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');
        $city=!empty($checkuser[0]['city_name'])?ucfirst($checkuser[0]['city_name']):'';
        $first_name=!empty($checkuser[0]['first_name'])?ucfirst($checkuser[0]['first_name']):'';
        $middle_name=!empty($checkuser[0]['middle_name'])?ucfirst($checkuser[0]['middle_name']):'';
        $last_name=!empty($checkuser[0]['last_name'])? ucfirst($checkuser[0]['last_name']):'';
        $token=!empty($checkuser[0]['token'])? $checkuser[0]['token']:'';
        $purohit_name=$first_name.' '.$middle_name.' '.$last_name;


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   
            $request_status_update=array();
        
   
            if (!empty($cancell_status) && $cancell_status =='4') {

                /*[start]:: send message  and mail to customer when order cancelled by purohit*/
                    /*START::Fine for purohit*/
                $this->db->select('fk_user_id,fk_pooja_id,fk_package_id,pooja_date,pooja_time,total_pkg_price_exclusive,pooja_name');
                $this->db->from('customer_pooja_order as A');
                $this->db->join('pooja as p','p.pk_id=A.fk_pooja_id');
                $this->db->where('A.pk_id',$pooja_order_id); 
                $this->db->where('A.status',1); 
                $order_data = $this->db->get()->result_array();
                $customer_id=!empty($order_data[0]['fk_user_id'])?$order_data[0]['fk_user_id']:'';
                $pooja_id=!empty($order_data[0]['fk_pooja_id'])?$order_data[0]['fk_pooja_id']:'';
                $package_id=!empty($order_data[0]['fk_package_id'])?$order_data[0]['fk_package_id']:'';
                $pooja_name=!empty($order_data[0]['pooja_name'])? ucwords($order_data[0]['pooja_name']):'';
                $date_of_puja=!empty($order_data[0]["pooja_date"])?$order_data[0]["pooja_date"]:'';
                $time_of_puja=!empty($order_data[0]["pooja_time"])?$order_data[0]["pooja_time"]:'';
                $puja_pkg_ammount=!empty($order_data[0]["total_pkg_price_exclusive"])?$order_data[0]["total_pkg_price_exclusive"]:'';

                $puja_data_before48=date('Y-m-d', strtotime($date_of_puja . " -48 hours"));
                $puja_time_before48=date('H:i A', strtotime($time_of_puja . " -48 hours"));
                $data_time_for_cancellation=$puja_data_before48.' '.$puja_time_before48;
                $current_time = date('Y-m-d H:i A');
                $fine_for_cancel=0;
                // echo "<pre>";print_r($puja_data_before48);die();
                if(date($current_time) > date($data_time_for_cancellation)){

                    $this->db->select('fine_for_purohit');
                    $this->db->from('master_fine_for_purohit');
                    $this->db->where('status','1');
                    $this->db->limit('1');
                    $this->db->order_by('pk_id','desc');
                    $cancellation_charges_data=$this->db->get()->result_array();
                  

                     $fine_for_cancel=!empty($cancellation_charges_data[0]['fine_for_purohit']) ?$cancellation_charges_data[0]['fine_for_purohit']:'';

                            //Fine deduction notification for Purohit on canceling the puja within 48hrs
                    $message = 'Dear '.$purohit_name.', amount '.$fine_for_cancel.'/- deducted from your balance amount  as the '.$pooja_name.' (Puja id: SP'.$pooja_order_id.') is cancelled by you within 48hrs of Puja.';
                    $subject = 'Cancellation Fine';
                    $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "notification");
                    $target=$token;

                    $this->Md_database->sendPushNotification($resultarray,$target);

                      $table = "notifications";
                            $insert_data = array(
                                
                                'fk_purohit_id' => $purohit_id,
                                'fk_pooja_order_id' => $pooja_order_id,
                                'title'=>$subject,
                                'message' => $message,
                                'redirecttype' => 'notification',
                                'status' => '1',
                                'notification_datetime' => date('Y-m-d H:i:s'),
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);
                     
                  }
                  /*End::Fine for purohit*/

                $this->db->select('customer_name,customer_mobile_no,customer_email_id');
                $this->db->from('customer_registration');
                $this->db->where('pk_id',$customer_id); 
                $this->db->where('status',1); 
                $customer_data = $this->db->get()->result_array();
                $customer_name=!empty($customer_data[0]['customer_name'])? ucwords($customer_data[0]['customer_name']):'';
                $customer_mobile_no=!empty($customer_data[0]['customer_mobile_no'])?$customer_data[0]['customer_mobile_no']:'';
                $customer_email_id=!empty($customer_data[0]['customer_email_id'])? strtolower($customer_data[0]['customer_email_id']):'';

                $msg='cancelled';
         
                    $request_status_insert['fk_pooja_order_id']=$pooja_order_id;
                    $request_status_insert['created_date']=date('Y-m-d H:i:s');
                    $request_status_insert['request_cancelled_by']=$purohit_id;
                    $request_status_insert['created_by']=$purohit_id;
                    $request_status_insert['cancellation_charges']=$fine_for_cancel;
                    $res=$this->Md_database->insertData('cancelled_order_by_purohit',$request_status_insert);

                      $table = "purohit_purohit_transaction_history";
                            $insert_data = array(
                                
                                'fk_purohit_id' => $purohit_id,
                                'fk_pooja_order_id' => $pooja_order_id,
                                'transaction_type'=>'1',
                                'amount' => $fine_for_cancel,
                                'status' => '1',);
                    $this->Md_database->insertData($table, $insert_data);
            

 /*Start::Send Request & push notification to purohit only send area wise those user have area*/
                     
                    $this->db->select('token,pk_id,location,mobile_no,first_name,middle_name,last_name');
                    $this->db->from('registered_purohit');
                    $this->db->where('city_name',$city);
                    $this->db->where('pk_id!=',$purohit_id);
                    $this->db->where('status','1');
                    $purohit_data=$this->db->get()->result_array();

                    // print_r($purohit_data);die();
                        if (!empty($purohit_data)) {
                    foreach ($purohit_data as $val) {
                        $first_name=!empty($val['first_name'])?ucwords($val['first_name']):'';

                        $middle_name=!empty($val['middle_name'])? ucwords($val['middle_name']):'';
                        $last_name=!empty($val['last_name'])?ucwords($val['last_name']):'';
                        $rest_purohit_name=$first_name.' '.$middle_name.' '. $last_name;

                

                        // print_r($userdata);die();
                        if (!empty($val['token'])) {
                        /*Start::Request insert into purohit_request_record table */  
                       
                        $cond = array('fk_pooja_order_id' => $pooja_order_id,'fk_purohit_id'=>$val['pk_id']);
                        $ret = $this->Md_database->deleteData('purohit_purohit_request_record', $cond);

                            $table = "purohit_purohit_request_record";
                            $insert_data = array(
                                'fk_customer_id'=>$customer_id,
                                'fk_purohit_id' => $val['pk_id'],
                                'fk_pooja_id' => $pooja_id,
                                'fk_pooja_order_id'=>$pooja_order_id,
                                'fk_pkg_id' => $package_id,
                                'request' => '1',
                                'status' => '1',
                                'created_date' => date('Y-m-d H:i:s'),
                                'created_by' =>$customer_id,
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);

                        /*End::Request insert into purohit_request_record table */

                            $message = 'Dear ' .$rest_purohit_name .', you have received new puja request from '.$customer_name.'.Please check Shri Purohit App for more details.';
                            $subject = 'Puja request';
                            $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "order");
                            $target=!empty($val['token'])?$val['token']:'';
                            // print_r($target);die();
                            $mobile_no=!empty($val['mobile_no'])?$val['mobile_no']:'';

                            $this->Md_database->sendPushNotification($resultarray,$target);

                           
              
                            $this->Md_database->sendSMS($message, $mobile_no);

                            $table = "notifications";
                            $insert_data = array(
                                
                                'fk_purohit_id' => $val['pk_id'],
                                'fk_pooja_order_id' => $pooja_order_id,
                                'title'=>$subject,
                                'message' => $message,
                                'redirecttype' => 'order',
                                'status' => '1',
                                'notification_datetime' => date('Y-m-d H:i:s'),
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);



                        }
                    }
                }
                      //update fk_purohit empty && pooja_order_status  when cancelled order by purohit
           
                    $update_data['pooja_order_status']='2';
                    $update_data['fk_purohit']=null;
                    $update_data['pooja_order_date_plus1']=date("Y-m-d H:i:s", strtotime("+1 hours"));
                    $cond = array('pk_id' => $pooja_order_id);
                    $ret = $this->Md_database->updateData('customer_pooja_order', $update_data, $cond);
                 /*End::Send Request &  push notification to purohit only send area wise those user have area and location*/

            
          
               
                $cus_message = 'Purohit ' .$purohit_name .' has cancelled puja request, '.'SP'.$pooja_order_id;
                $subject = 'Purohit '.$purohit_name.' '.'has cancelled puja';
            

                    $recipeinets = $customer_email_id;
                    $from = array(
                        "email" => SITE_MAIL,
                        "name" => SITE_TITLE
                    );
                    $reserved_words = array(
                        "||USER_NAME||" => $customer_name,
                        "||SITE_TITLE||" => SITE_TITLE,
                        "||DATE||" => date('d-m-Y h:i:s A'),
                    
                        "||MESSGAE||" => $cus_message,
                        "||SUBJECT||" => $subject,
                        "||YEAR||" => date('Y'),
                    );
                    $email_data = $this->Md_database->getEmailInfo('purohit_cancel_order', $reserved_words);
                    
                // print_r($email_data);die();
                    $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
              
                $this->Md_database->sendSMS($cus_message, $customer_mobile_no);
                /*[End]:: send message  and mail to customer when order cancelled by purohit*/
            }

            if (!empty($res)) {

                $resultarray = array('error_code' => '1', 'message' => "Request ".$msg.' successfully.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => 'Fail.'
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

      public function reached_location_otp() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
      
        

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

              /*Start::get customer mobile number*/
                $this->db->select('fk_user_id');
                $this->db->from('customer_pooja_order'); 
                $this->db->where('pk_id',$pooja_order_id);
                $this->db->where('status','1');
                $fk_user_id=$this->db->get()->result_array();
                $customer_id=!empty($fk_user_id[0]['fk_user_id'])?$fk_user_id[0]['fk_user_id']:'';

                $this->db->select('customer_mobile_no');
                $this->db->from('customer_registration'); 
                $this->db->where('pk_id',$customer_id);
                $this->db->where('status','1');
                $customer_mobile_no=$this->db->get()->result_array();
                $mobile_no=!empty($customer_mobile_no[0]['customer_mobile_no'])?$customer_mobile_no[0]['customer_mobile_no']:'';
         /*End::get customer mobile number*/
   
            $otp_status_update=array();
            $otp = rand(1000, 9999);
        
            $message = 'Hi, ' . $otp.' is your OTP to confirm the Purohit arrival at your Puja location. Please provide the OTP to purohit';
            $this->Md_database->sendSMS($message, $mobile_no);

            $otp_status_update['reached_otp']=$otp;
            
            $res=$this->Md_database->updateData('customer_pooja_order',$otp_status_update,array('pk_id'=>$pooja_order_id));  
          

            if (!empty($res)) {

                $resultarray = array('error_code' => '1','otp'=>$otp, 'message' => "Otp sent successfully.");
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => 'Fail.'
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }
    public function check_reached_otp() {
    $otp = !empty($this->input->post('otp'))?$this->input->post('otp'):'';
 

        $this->db->select('reached_otp');
        $this->db->from('customer_pooja_order'); 
        $this->db->where('reached_otp',$otp);
        $this->db->where('status',1);
        $otp_verfied=$this->db->get()->result_array();
        $db_getotp=!empty($otp_verfied[0]['reached_otp'])?$otp_verfied[0]['reached_otp']:'';

        if ($otp != $db_getotp) {

            $resultarray = array('error_code' => '0','message' =>'Please enter correct otp');
        }else{
            $inserted_data['reached_otp_verified'] = '1';
            $inserted_data['reached_date_time']=date('Y-m-d H:i:s');
            $inserted_data['pooja_status']='1';
            $cond = array('reached_otp' => $db_getotp);
            $ret = $this->Md_database->updateData('customer_pooja_order', $inserted_data, $cond);
            $resultarray = array('error_code' => '1','message' =>'OTP verified successfully');
        }
        echo json_encode($resultarray);
                    exit();
        
    }


      public function pooja_completed_otp() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
      
        

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

              /*Start::get customer mobile number*/
                $this->db->select('fk_user_id');
                $this->db->from('customer_pooja_order'); 
                $this->db->where('pk_id',$pooja_order_id);
                $this->db->where('status','1');
                $fk_user_id=$this->db->get()->result_array();
                $customer_id=!empty($fk_user_id[0]['fk_user_id'])?$fk_user_id[0]['fk_user_id']:'';

                $this->db->select('customer_mobile_no');
                $this->db->from('customer_registration'); 
                $this->db->where('pk_id',$customer_id);
                $this->db->where('status','1');
                $customer_mobile_no=$this->db->get()->result_array();
                $mobile_no=!empty($customer_mobile_no[0]['customer_mobile_no'])?$customer_mobile_no[0]['customer_mobile_no']:'';
         /*End::get customer mobile number*/
   
            $otp_status_update=array();
            $otp = rand(1000, 9999);
            
            $message = 'Hi, ' . $otp.' is your OTP to confirm completion of the puja. Please provide the OTP to purohit.';
            $this->Md_database->sendSMS($message, $mobile_no);

            $otp_status_update['completed_otp']=$otp;
            
            $res=$this->Md_database->updateData('customer_pooja_order',$otp_status_update,array('pk_id'=>$pooja_order_id));  
          

            if (!empty($res)) {

                $resultarray = array('error_code' => '1','otp'=>$otp, 'message' => "Otp sent successfully.");
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => 'Fail.'
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }
    public function check_pooja_completed_otp() {
    $otp = !empty($this->input->post('otp'))?$this->input->post('otp'):'';
    $purohit_id = !empty($this->input->post('purohit_id'))?$this->input->post('purohit_id'):'';
    

        $this->db->select('completed_otp,fk_user_id');
        $this->db->from('customer_pooja_order'); 
        $this->db->where('completed_otp',$otp);
        $this->db->where('status','1');
        $otp_verfied=$this->db->get()->result_array();
        $db_getotp=!empty($otp_verfied[0]['completed_otp'])?$otp_verfied[0]['completed_otp']:'';
        $customer_id=!empty($otp_verfied[0]['fk_user_id'])?$otp_verfied[0]['fk_user_id']:'';

        if ($otp != $db_getotp) {

            $resultarray = array('error_code' => '0','message' =>'Please enter correct otp');
        }else{
            $inserted_data['puja_completed_by'] = $purohit_id;
            $inserted_data['completed_otp_verified'] = '1';
            $inserted_data['completed_date_time']=date('Y-m-d H:i:s');
            $inserted_data['pooja_status']='2';
            $cond = array('completed_otp' => $db_getotp);
            $ret = $this->Md_database->updateData('customer_pooja_order', $inserted_data, $cond);
            $resultarray = array('error_code' => '1','message' =>'OTP verified successfully');
             /*Start::get customer mobile number TO send Thank you message*/

                $this->db->select('customer_mobile_no');
                $this->db->from('customer_registration'); 
                $this->db->where('pk_id',$customer_id);
                $this->db->where('status','1');
                $customer_mobile_no=$this->db->get()->result_array();
                $mobile_no=!empty($customer_mobile_no[0]['customer_mobile_no'])?$customer_mobile_no[0]['customer_mobile_no']:'';
         /*End::get customer mobile number TO send Thank you message*/

        $message = 'Thank you for choosing Shripurohit. Hope you had a good Puja experience with our Purohit. To rate the Purohit click on '.base_url();
            $this->Md_database->sendSMS($message, $mobile_no);
        }
        echo json_encode($resultarray);
                    exit();
        
    }


}
  