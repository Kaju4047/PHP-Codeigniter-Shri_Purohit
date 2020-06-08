<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_reject_list extends CI_Controller {

    public function reject_list() {

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
   

            $this->db->select('COALESCE(fk_pooja_order_id, "") as fk_pooja_order_id,COALESCE(customer_name, "") as customer_name,COALESCE(pooja_area, "") as pooja_area,COALESCE(pooja_name, "") as pooja_name,COALESCE(pooja_date, "") as pooja_date,COALESCE(pooja_time, "") as pooja_time,COALESCE(o.created_date, "") as order_date,COALESCE(total_pkg_price_exclusive, "") as total_pkg_price_exclusive,COALESCE(pooja_city, "") as pooja_city');
            $this->db->from('customer_pooja_order as o');
            $this->db->join('customer_registration as cr','cr.pk_id=o.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=o.fk_pooja_id');
            $this->db->join('purohit_rejected_order_by_purohit as R','R.fk_pooja_order_id=o.pk_id');  
            $this->db->join('purohit_registered_purohit as rp','rp.pk_id=R.request_rejected_by');  
            $this->db->where('o.status','1');
            $this->db->where('R.request_rejected_by',$purohit_id);
            $this->db->order_by('R.created_date desc');
            $this->db->limit($limit, $offset);
            $purohit_rejected_data=$this->db->get()->result_array();
// print_r($purohit_rejected_data);die();
            if (!empty($purohit_rejected_data)) {

                $resultarray = array('error_code' => '1','puja_rejected_list'=>$purohit_rejected_data, 'rejected_list_count'=>count($purohit_rejected_data), 'message' => 'Puja rejected list.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Puja record are empty."
                );
            }

            echo json_encode($resultarray);
            exit();
        }
    }
        public function reject_list_view() {

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
   

                $this->db->select('o.fk_user_id as customer_id,o.pk_id as pooja_order_id,pkg.pk_id as pkg_id,o.created_date as order_date,o.pooja_address,o.pooja_area,p.pooja_name,o.pooja_time,o.pooja_date,o.total_pkg_price_exclusive,pkg.description,o.pooja_order_status,o.pooja_city,B.customer_name,B.customer_mobile_no,B.customer_photo,R.created_date as rejected_date,o.purohit_percentage, pkg.package, o.package_charges');
                $this->db->from('customer_pooja_order as o');
                $this->db->join('pooja as p','p.pk_id=o.fk_pooja_id');
                $this->db->join('package as pkg','pkg.pk_id=o.fk_package_id');
                $this->db->join('customer_registration as B', 'B.pk_id=o.fk_user_id');
                $this->db->join('purohit_rejected_order_by_purohit as R','R.fk_pooja_order_id=o.pk_id'); 
                $this->db->where('o.status','1');
                $this->db->where('o.pk_id',$pooja_order_id);
                $order_view_data = $this->db->get()->result_array();
                $count = count($order_view_data);
                for($i = 0; $i<$count; $i++)
                {
                    $order_view_data[$i]['description'] = strip_tags($order_view_data[$i]['description']);
                }
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
                $pooja_order_view=$finalarray;
          


            if (!empty($pooja_order_view)) {

                $resultarray = array('error_code' => '1','Pooja_order_view'=>$pooja_order_view, 'exclusive' => $services_exclusive, 'excl_msg' => $excl_msg, 'profile_image'=>base_url().'upload/customer_profile/', 'message' => 'Pooja details.');
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
}