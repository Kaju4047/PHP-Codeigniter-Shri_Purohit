<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_pooja_history extends CI_Controller {

public function completed_list() {

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
   

            $this->db->select('COALESCE(C.pk_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(fk_user_id, "") as fk_customer_id,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(C.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('customer_pooja_order as C');
            $this->db->join('pooja as A', 'A.pk_id=C.fk_pooja_id');
            $this->db->join('customer_registration as B', 'B.pk_id=C.fk_user_id');
            $this->db->where('C.pooja_status','2');
            $this->db->where('C.status','1');
            $this->db->where('C.fk_purohit',$purohit_id);;
            $this->db->order_by('C.completed_date_time desc');
            $this->db->limit($limit, $offset);
            $pooja_completed_data=$this->db->get()->result_array();

            $this->db->select('COALESCE(C.pk_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(fk_user_id, "") as fk_customer_id,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(C.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('customer_pooja_order as C');
            $this->db->join('pooja as A', 'A.pk_id=C.fk_pooja_id');
            $this->db->join('customer_registration as B', 'B.pk_id=C.fk_user_id');
            $this->db->where('C.pooja_status','2');
            $this->db->where('C.status','1');
            $this->db->where('C.fk_purohit',$purohit_id);;
            $this->db->order_by('C.completed_date_time desc');
           
            $pooja_completed_data_count=$this->db->get()->result_array();


            if (!empty($pooja_completed_data)) {

                $resultarray = array('error_code' => '1','pooja_completed_list'=>$pooja_completed_data, 'completed_list_count'=>count($pooja_completed_data_count), 'message' => 'Completed List.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Completed list are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

    public function cancelled_list() {

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
   

            $this->db->select('COALESCE(C.pk_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(fk_user_id, "") as fk_customer_id,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(C.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('cancelled_order_by_purohit as pr');
            $this->db->join('customer_pooja_order as C', 'C.pk_id=pr.fk_pooja_order_id');
            $this->db->join('customer_registration as B', 'B.pk_id=C.fk_user_id');
            $this->db->join('pooja as A', 'A.pk_id=C.fk_pooja_id');
       
     
            $this->db->where('pr.request_cancelled_by',$purohit_id);
    
            $this->db->where('C.status','1');
            $this->db->order_by('pr.created_date DESC');
             $this->db->group_by('pr.fk_pooja_order_id');
            // $this->db->limit($limit, $offset);
            $pooja_cancelled_data1=$this->db->get()->result_array();
            $this->db->select('COALESCE(C.pk_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(fk_user_id, "") as fk_customer_id,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(C.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('customer_pooja_order as C');
            $this->db->join('customer_registration as B', 'B.pk_id=C.fk_user_id');
            $this->db->join('pooja as A', 'A.pk_id=C.fk_pooja_id');
            $this->db->where('C.fk_purohit',$purohit_id);
            $this->db->where('C.pooja_status','4');
            $this->db->where('C.status','1');
            $this->db->order_by('C.created_date DESC');

            // $this->db->limit($limit, $offset);
            $pooja_cancelled_data2=$this->db->get()->result_array();
            $pooja_cancelled_data=array_merge($pooja_cancelled_data1,$pooja_cancelled_data2);

            $output= array_slice($pooja_cancelled_data,$offset,$limit);
            
            if (!empty($output)) {

                $resultarray = array('error_code' => '1','pooja_cancelled_list'=>$output, 'cancelled_list_count'=>count($pooja_cancelled_data), 'message' => 'Cancelled List.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Cancelled list are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

    public function completed_list_view() {         

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
   

                $this->db->select('o.fk_user_id as customer_id,o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,o.reached_date_time,o.reached_otp,o.completed_date_time,o.completed_otp,o.purohit_percentage, pkg.package, o.package_charges');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                // $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                $this->db->where('pooja_status','2');
                $this->db->where('o.pk_id',$pooja_order_id);
                $completed_view_data=$this->db->get()->result_array();
                $count = count($completed_view_data);
                for($i = 0; $i<$count; $i++)
                {
                    $completed_view_data[$i]['description'] = strip_tags($completed_view_data[$i]['description']);
                }
                $address=!empty($completed_view_data[0]['pooja_area'])?$completed_view_data[0]['pooja_area']:'';
                $finalarray=array();

                if (!empty($completed_view_data)) {
                    foreach ($completed_view_data as $key => $value) {
                 $this->db->select('ac.service_name');
                $this->db->from('package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','1');
                $services_inclusive=$this->db->get()->result_array();

                 $services_exclusive=array();
                // $this->db->select('services_charges, charges_to_show_purohit,fk_services_id');
                // $this->db->from('customer_package_services as ps');
                // $this->db->join('package_services ac','ac.fk_services=ps.fk_services_id');
                // $this->db->where('fk_package',$value['pkg_id']);
                // $this->db->where('ps.fk_pooja_order_id',$value['pooja_order_id']);
                // $this->db->where('ps.status','1');
                // $this->db->where('ac.status','1');
                // $this->db->where('ac.service_type','2');
                // $services_exclusive_data=$this->db->get()->result_array();
                // if (!empty($services_exclusive_data)) {

                // foreach ($services_exclusive_data as $key => $row) {
                  
                // $this->db->select('A.service_name');
                // $this->db->from('master_additional_services as A');
                // $this->db->where('A.pk_id',$row['fk_services_id']);
                // $this->db->where('A.status','1');
                // $services_exclusive_name=$this->db->get()->result_array();
               
                // $row['service_name']=!empty($services_exclusive_name[0]['service_name'])?$services_exclusive_name[0]['service_name']:'';
                // $services_exclusive[]=$row;
                //   }
                // }

                // //$value['inclusive']=!empty($services_inclusive)?$services_inclusive:'';
                // $value['exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                
                $this->db->select('mas.service_name, psc.services_charges, psc.charges_to_show_purohit, psc.service_id as fk_services_id');
                $this->db->from('purohit_show_charges as psc');
                $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                $this->db->where('psc.puja_order_id', $pooja_order_id);
                $services_exclusive = $this->db->get()->result_array();
                $excl_msg = "";
                if(!empty($services_exclusive))
                {
                    $excl_msg = "not null";
                }
                else
                {
                    $excl_msg = "null";
                }

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
                $completed_pooja_view=$finalarray;




            if (!empty($completed_pooja_view)) {

                $resultarray = array('error_code' => '1','completed_pooja_view'=>$completed_pooja_view, 'exclusive' => $services_exclusive, 'excl_msg' => $excl_msg, 'profile_image'=>base_url().'upload/customer_profile/', 'message' => 'Completed pooja view details.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Completed pooja view details empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }

    public function cancelled_list_view() {         

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $pooja_order_id = !empty($this->input->post('pooja_order_id')) ? $this->input->post('pooja_order_id') : "";
    
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status,first_name,middle_name,last_name';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');

        $first_name=!empty($checkuser[0]['first_name'])?$checkuser[0]['first_name']:'';
        $middle_name=!empty($checkuser[0]['middle_name'])?$checkuser[0]['middle_name']:'';
        $last_name=!empty($checkuser[0]['last_name'])?$checkuser[0]['last_name']:'';
        
        $purohit_name=$first_name.' '.$middle_name.' '.$last_name;
     

        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   

                $this->db->select('o.fk_user_id as customer_id,o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.cancelled_by as cancelled_by_customer,o.cancelled_date_time as customer_cancelledtime,C.created_date,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,o.purohit_percentage,pooja_status, pkg.package, o.package_charges');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->join('cancelled_order_by_purohit as C', 'C.fk_pooja_order_id=o.pk_id','left');
              
                // $this->db->where('p.status','1');
                $this->db->where('o.status','1');
                $this->db->where('o.pk_id',$pooja_order_id);
                $cancelled_view_data = $this->db->get()->result_array();
                $count = count($cancelled_view_data);
                for($i = 0; $i<$count; $i++)
                {
                    $cancelled_view_data[$i]['description'] = strip_tags($cancelled_view_data[$i]['description']);
                }
                $address=!empty($cancelled_view_data[0]['pooja_area'])?$cancelled_view_data[0]['pooja_area']:'';
          
                // print_r($cancelled_view_data);die;

             

                $finalarray=array();

                if (!empty($cancelled_view_data)) {
                    foreach ($cancelled_view_data as $key => $value) {
                $this->db->select('ac.service_name');
                $this->db->from('package_services as ps');
                $this->db->join('master_additional_services ac','ac.pk_id=ps.fk_services');
                $this->db->where('fk_package',$value['pkg_id']);
                $this->db->where('ps.status','1');
                $this->db->where('ac.status','1');
                $this->db->where('ps.service_type','1');
                $services_inclusive=$this->db->get()->result_array();

         
                 $services_exclusive=array();
                // $this->db->select('services_charges, charges_to_show_purohit,fk_services_id');
                // $this->db->from('customer_package_services as ps');
                // $this->db->join('package_services ac','ac.fk_services=ps.fk_services_id');
                // $this->db->where('fk_package',$value['pkg_id']);
                // $this->db->where('ps.fk_pooja_order_id',$value['pooja_order_id']);
                // $this->db->where('ps.status','1');
                // $this->db->where('ac.status','1');
                // $this->db->where('ac.service_type','2');
                // $services_exclusive_data=$this->db->get()->result_array();
                // if (!empty($services_exclusive_data)) {

                // foreach ($services_exclusive_data as $key => $row) {
                  
                // $this->db->select('A.service_name');
                // $this->db->from('master_additional_services as A');
                // $this->db->where('A.pk_id',$row['fk_services_id']);
                // $this->db->where('A.status','1');
                // $services_exclusive_name=$this->db->get()->result_array();
               
                // $row['service_name']=!empty($services_exclusive_name[0]['service_name'])?$services_exclusive_name[0]['service_name']:'';
                // $services_exclusive[]=$row;
                //   }
                // }
                $pooja_status=!empty($value['pooja_status'])?$value['pooja_status']:'';
                $customer_name=!empty($value['customer_name'])? ucwords($value['customer_name']):'';
                $customer_cancelledtime=!empty($value['customer_cancelledtime'])? $value['customer_cancelledtime']:'';
                $purohit_cancelledtime=!empty($value['created_date'])? $value['created_date']:'';
// print_r($customer_name);die();
                if (!empty($pooja_status) && $pooja_status =='4') {
                   $value['cancelled_by']=$customer_name;
                   $value['cancelled_date_time']=$customer_cancelledtime;
                }else{
                    $value['cancelled_by']=$purohit_name;
                     $value['cancelled_date_time']=$purohit_cancelledtime;
                }

                //$value['inclusive']=!empty($services_inclusive)?$services_inclusive:'';
                //$value['exclusive']=!empty($services_exclusive)?$services_exclusive:'';
                
                $this->db->select('mas.service_name, psc.services_charges, psc.charges_to_show_purohit, psc.service_id as fk_services_id');
                $this->db->from('purohit_show_charges as psc');
                $this->db->join('purohit_master_additional_services as mas', 'mas.pk_id = psc.service_id', 'LEFT');
                $this->db->where('psc.puja_order_id', $pooja_order_id);
                $services_exclusive = $this->db->get()->result_array();
                $excl_msg = "";
                if(!empty($services_exclusive))
                {
                    $excl_msg = "not null";
                }
                else
                {
                    $excl_msg = "null";
                }

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
                $cancelled_pooja_view=$finalarray;
          


            if (!empty($cancelled_pooja_view)) {

                $resultarray = array('error_code' => '1','cancelled_pooja_view'=>$cancelled_pooja_view, 'exclusive' => $services_exclusive, 'excl_msg' => $excl_msg, 'profile_image'=>base_url().'upload/customer_profile/', 'message' => 'Cancelled pooja view details.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Cancelled pooja view details empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }


    public function puja_reminder_msg() {

 // echo 'Time zone is: '.date_default_timezone_get();die();
       
    $this->db->select('A.pk_id as puja_order_id,pooja_date,pooja_time,pooja_address,pooja_city,pooja_name,fk_purohit,fk_user_id');
    $this->db->from('customer_pooja_order as A');
    $this->db->join('pooja as B', 'B.pk_id=A.fk_pooja_id');
    $this->db->where('A.status', 1);
    $this->db->where('A.pooja_date', date('Y-m-d', strtotime('+3 day', time())));
    $this->db->where('A.pooja_status', '5');
    $this->db->where('A.fk_purohit!=', null);
    $this->db->where('A.reminder_msg_send', '2');
    $puja_data = $this->db->get()->result_array();

      // echo "<pre>";print_r($puja_data);die();
      // echo "<pre>";print_r($this->db->last_query());die();

/*[STart]:: Remainder message to user & Purohit 2 days before the puja event*/
     if (!empty($puja_data)) {
            foreach ($puja_data as $rows) {
            $pooja_order_id=!empty($rows['puja_order_id'])?$rows['puja_order_id']:'';
            $pooja_name=!empty($rows["pooja_name"])? ucwords($rows["pooja_name"]):'';
            $pooja_address=!empty($rows["pooja_address"])? ucwords($rows["pooja_address"]):'';
            $city=!empty($rows["pooja_city"])?$rows["pooja_city"]:'';
            $pooja_date=!empty($rows["pooja_date"])?$rows["pooja_date"]:'';
            $pooja_time=!empty($rows["pooja_time"])?$rows["pooja_time"]:'';

                 /*Start::Send push notification to purohit those have assign and accept puja*/

           
            //update reminder_msg_send = 1 when msg sent to customer
            $request_status_update['reminder_msg_send']='1';
            $res=$this->Md_database->updateData('customer_pooja_order',$request_status_update,array('pk_id'=>$pooja_order_id));

                $this->db->select('token,pk_id,location,mobile_no,first_name,middle_name,last_name');
                $this->db->from('registered_purohit');
                $this->db->where('pk_id',$rows['fk_purohit']);
                $this->db->where('status','1');
                $purohit_data=$this->db->get()->result_array();
                    if (!empty($purohit_data)) {
                    foreach ($purohit_data as $val) {
                        $mobile_no=!empty($val['mobile_no'])?$val['mobile_no']:'';
                        $first_name=!empty($val['first_name'])?ucwords($val['first_name']):'';
                        $middle_name=!empty($val['middle_name'])? ucwords($val['middle_name']):'';
                        $last_name=!empty($val['last_name'])?ucwords($val['last_name']):'';
                        $purohit_name=$first_name.' '.$middle_name.' '. $last_name;

                        // print_r($userdata);die();
                        if (!empty($val['token'])) {
                       
                        $message = 'It is a remainder message for the '.$pooja_name.' accepted by you and puja on '.date('d-m-Y',strtotime($pooja_date)). ', time '.$pooja_time.' at '.$pooja_address.', '.$city.'.';
                         
                            $subject = 'Puja Reminder';
                            $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "notificationlist");
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
                                'redirecttype' => 'notificationlist',
                                'status' => '1',
                                'notification_datetime' => date('Y-m-d H:i:s'),
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);

                        /*End::Send push notification to purohit those have assign and accept puja*/
                        }


                    }
                }
                    //text message send to customer
                    $this->db->select('customer_mobile_no');
                    $this->db->from('customer_registration');
                    $this->db->where('status','1');
                    $this->db->where('pk_id',$rows['fk_user_id']);
                    $customer_details = $this->db->get()->result_array();

                    if (!empty($customer_details)) {
                    foreach ($customer_details as $val) {
                        $cust_mobile_no=!empty($val['customer_mobile_no'])?$val['customer_mobile_no']:'';
               
                   

                         $cust_message = 'It is a remainder message for the '.$pooja_name.' booked by you is on '.date('d-m-Y',strtotime($pooja_date)). ', time '.$pooja_time.' at your '.$pooja_address.', '.$city.'.';
                        $this->Md_database->sendSMS($cust_message, $cust_mobile_no);
                         }
                    }
                /*[End]:: Remainder message to user & Purohit 2 days before the puja event*/

    

             }
    }

    }

    public function remind_msg_pujaday() {
        $before2hr=date('h:i A', strtotime('+2 hour', time()));
       // echo $before2hr; die();
        $pujadate=date('Y-m-d');
    
    // echo "<pre>";print_r($before2hr);
    $this->db->select('A.pk_id as puja_order_id,pooja_date,pooja_time,pooja_address,pooja_city,pooja_name,fk_purohit,fk_user_id');
    $this->db->from('customer_pooja_order as A');
    $this->db->join('pooja as B', 'B.pk_id=A.fk_pooja_id');
    $this->db->where('A.status', 1);
    $this->db->where('A.pooja_time', $before2hr);
    $this->db->where('A.pooja_date', $pujadate);
  
    $this->db->where('A.pooja_status', '5');
    $this->db->where('A.fk_purohit!=', null);
    $puja_data = $this->db->get()->result_array();
      // echo "<pre>";print_r($this->db->last_query());die();
     //echo "<pre>";print_r($puja_data);die();
// 

/*[STart]:: Remainder message to user on the day of puja event and 2hrs before the puja*/
     if (!empty($puja_data)) {
            foreach ($puja_data as $rows) {
            $pooja_order_id=!empty($rows['puja_order_id'])?$rows['puja_order_id']:'';
            $pooja_name=!empty($rows["pooja_name"])? ucwords($rows["pooja_name"]):'';
            $pooja_address=!empty($rows["pooja_address"])? ucwords($rows["pooja_address"]):'';
            $city=!empty($rows["pooja_city"])?$rows["pooja_city"]:'';
            $pooja_date=!empty($rows["pooja_date"])?$rows["pooja_date"]:'';
            $pooja_time=!empty($rows["pooja_time"])?$rows["pooja_time"]:'';

        
                    //text message send to customer
                    $this->db->select('customer_mobile_no');
                    $this->db->from('customer_registration');
                    $this->db->where('status','1');
                    $this->db->where('pk_id',$rows['fk_user_id']);
                    $customer_details = $this->db->get()->result_array();
                    //echo "<pre>"; print_r($customer_details); die();
                    if (!empty($customer_details)) {
                    foreach ($customer_details as $val) {
                        $cust_mobile_no=!empty($val['customer_mobile_no'])?$val['customer_mobile_no']:'';
               
                         $cust_message = 'It is a remainder message for the '.$pooja_name.' booked by you is today, time '.$pooja_time.' at your '.$pooja_address.', '.$city.'.';
                        $this->Md_database->sendSMS($cust_message, $cust_mobile_no);
                         }
                    }
                /*[End]:: Remainder message to user on the day of puja event and 2hrs before the puja*/


                $this->db->select('token,pk_id,location,mobile_no,first_name,middle_name,last_name');
                $this->db->from('registered_purohit');
                $this->db->where('pk_id',$rows['fk_purohit']);
                $this->db->where('status','1');
                $purohit_data=$this->db->get()->result_array();
                    if (!empty($purohit_data)) {
                    foreach ($purohit_data as $val) {
                        $mobile_no=!empty($val['mobile_no'])?$val['mobile_no']:'';
                        $first_name=!empty($val['first_name'])?ucwords($val['first_name']):'';
                        $middle_name=!empty($val['middle_name'])? ucwords($val['middle_name']):'';
                        $last_name=!empty($val['last_name'])?ucwords($val['last_name']):'';
                        $purohit_name=$first_name.' '.$middle_name.' '. $last_name;

                        // print_r($userdata);die();
                        if (!empty($val['token'])) {
                       
                        $message = 'It is a remainder message for the '.$pooja_name.' accepted by you is today, time '.$pooja_time.' at '.$pooja_address.', '.$city.'.';
                         
                            $subject = 'Puja Reminder';
                            $resultarray = array('message' => $message, 'title' => $subject, 'redirecttype' => "notificationlist");
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
                                'redirecttype' => 'notificationlist',
                                'status' => '1',
                                'notification_datetime' => date('Y-m-d H:i:s'),
                                
                            );
                            $this->Md_database->insertData($table, $insert_data);

                        /*End::Send push notification to purohit those have assign and accept puja*/
                        }


                    }
                }
            }
        }

    }
}