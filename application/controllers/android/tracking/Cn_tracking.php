<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_tracking extends CI_Controller {

    public function purohit_lat_long() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $latitude = !empty($this->input->post('lat')) ? $this->input->post('lat') : '';
        $longitude = !empty($this->input->post('long')) ? $this->input->post('long') : '';
        

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
   
            $lat_long_update['purohit_latitude']=$latitude;
            $lat_long_update['purohit_longitude']=$longitude;
            $res=$this->Md_database->updateData('registered_purohit',$lat_long_update,array('pk_id'=>$purohit_id));
 

            if (!empty($res)) {

                $resultarray = array('error_code' => '1', 'message' => 'Purohit lat long updated successfully.');
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