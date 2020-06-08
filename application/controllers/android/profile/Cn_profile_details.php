<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_profile_details extends CI_Controller {

    public function profile_details() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        
        $condition = array('pk_id' => $purohit_id);
        $select = 'status';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   

            $this->db->select('COALESCE(first_name, "") as first_name,COALESCE(middle_name, "") as middle_name,COALESCE(last_name, "") as last_name,COALESCE(mobile_no, "") as mobile_no,COALESCE(alternate_mobile_no, "") as alternate_mobile_no,COALESCE(email_id, "") as email_id,COALESCE(user_dob, "") as user_dob,COALESCE(address, "") as address,COALESCE(location, "") as location,COALESCE(s.state, "") as state, fk_state_id as state_id, COALESCE(city, "") as city, fk_city_id as city_id, COALESCE(upload_profile_Image, "") as upload_profile_Image,bank_name,ifsc_code,branch_name,account_holder_name,account_number');
            $this->db->from('registered_purohit');
            $this->db->join('master_state as s', 's.pk_id=registered_purohit.fk_state_id', 'left');
            $this->db->join('master_city as c', 'c.pk_id=registered_purohit.fk_city_id', 'left');
            $this->db->where('registered_purohit.status','1');
            $this->db->where('registered_purohit.pk_id',$purohit_id);

            $purohit_data = $this->db->get()->result_array();
            $purohit_data[0]['user_dob'] = date('d-m-Y', strtotime($purohit_data[0]['user_dob']));    

            if (!empty($purohit_id)) {

                $resultarray = array('error_code' => '1','purohit_data'=>$purohit_data,'profile_image' => base_url('upload/android/registartion/purohit_profile/'), 'message' => 'Profile Details.');
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


    public function qualification_details() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        
        $condition = array('pk_id' => $purohit_id);
        $select = 'status';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
             $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {
   
            $finalarray=array();
            $this->db->select('COALESCE(pathshala_gurukul_name, "") as pathshala_gurukul_name,COALESCE(exp_years, "") as exp_years,COALESCE(upload_certificate_Image, "") as upload_certificate_Image,COALESCE(qualification, "") as qualification,ifsc_code,account_holder_name,branch_name,account_number,branch_name');
            $this->db->from('registered_purohit');
            $this->db->where('registered_purohit.status','1');
            $this->db->where('registered_purohit.pk_id',$purohit_id);
            $purohit_qualification_data=$this->db->get()->result_array();
            if (!empty($purohit_qualification_data)) {
             foreach ($purohit_qualification_data as $key => $value) {
            $this->db->select('ml.language,rl.fk_language_id');
            $this->db->from('registered__purohit_language as rl');
            $this->db->join('master_language as ml', 'ml.pk_id=rl.fk_language_id', 'left');
            $this->db->where('rl.status','1');
            // $this->db->where('ml.status','1');
            $this->db->where('rl.fk_purohit_id',$purohit_id);
            $purohit_language=$this->db->get()->result_array();
            $value['language']=$purohit_language;
            $finalarray[]=$value;
            //echo "<pre>"; print_r($finalarray); die();
             }
            }

            if (!empty($purohit_id)) {

                $resultarray = array('error_code' => '1','purohit_qualification_data'=>$finalarray,'certificate_image' => base_url('upload/android/registartion/purohit_certificate/'),'message' =>'Qualification Details.');
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


}
  