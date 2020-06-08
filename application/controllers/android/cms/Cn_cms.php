<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_cms extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function cms_data(){
        $cms_pkey = !empty($this->input->post('cms_pkey')) ? $this->input->post('cms_pkey') : '';
        if (!empty($cms_pkey)){
            $table = "purohit_static_cms";
            $orderby = 'cms_pkey asc';
            $condition = array('cms_pkey' =>$cms_pkey);
            $col = array('cms_title','cms_meta_desc','cms_text');
            $cms_data = $this->Md_database->getData($table, $col, $condition, $orderby, '');  

            $resultarray = array('error_code' => '1','message'=>'data get succesfully','cms_title' => $cms_data[0]['cms_title'], 'cms_text' =>  strip_tags($cms_data[0]['cms_text']));
            echo json_encode($resultarray);
                    exit();  
        }else {
            $resultarray = array('error_code' => '2', 'message' => 'cms_pkey is empty');
            echo json_encode($resultarray);
            exit();                         
        }  
    }    
}





