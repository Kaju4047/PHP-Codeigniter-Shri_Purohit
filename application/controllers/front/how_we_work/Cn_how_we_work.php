<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_how_we_work extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
       

       $this->load->view('front/how_we_work/vw_how_we_work');
    }

    public function how_we_work_details() {
    $data['how_we_work_details'] = $this->Md_database->getData('static_cms','cms_text',array('cms_pkey'=>'13'),'','');

    $cms=$this->Md_database->getData('static_cms','cms_meta_title,cms_meta_desc,cms_meta_keyword',array('cms_pkey'=>'13'),'');
    $data['title'] = !empty($cms[0])?$cms[0]['cms_meta_title']:'';
    $data['description'] = !empty($cms[0])?$cms[0]['cms_meta_desc']:'';
    $data['keywords'] = !empty($cms[0])?$cms[0]['cms_meta_keyword']:'';

       $this->load->view('front/how_we_work/vw_how_we_work_details',$data);
    }
}