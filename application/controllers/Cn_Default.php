<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_Default extends CI_Controller {

    function __construct() {
        parent::__construct(); //It calls the Parent constructor
    }

    public function index() {
        // redirect(base_url() . 'admin/login');
        // exit();
    $data['home_about_us'] = $this->Md_database->getData('static_cms','cms_text',array('cms_pkey'=>'4'),'','');

    $cms=$this->Md_database->getData('static_cms','cms_meta_title,cms_meta_desc,cms_meta_keyword',array('cms_pkey'=>'4'),'');
    $data['title'] = !empty($cms[0])?$cms[0]['cms_meta_title']:'';
    $data['description'] = !empty($cms[0])?$cms[0]['cms_meta_desc']:'';
    $data['keywords'] = !empty($cms[0])?$cms[0]['cms_meta_keyword']:'';


    /*Start:: get city*/
    $this->db->select('pk_id,state');
    $this->db->from('master_state');
    $this->db->where('status','1');
    $this->db->order_by('state','asc');
    $statelist=$this->db->get()->result_array();

    $finalarrayview=array();

    if(!empty($statelist)){
    foreach($statelist as $row){

        $this->db->select('city,pk_id');
        $this->db->from('master_city');
        $this->db->where('state',$row['pk_id']); 
        $this->db->where('status',1);
        $this->db->order_by('state','asc'); 
        $citydata = $this->db->get()->result_array();

        $row['cityarray'] = $citydata;
        $finalarrayview[]=$row;
        }
     }
    $data['citylist']=$finalarrayview;
    
    $this->db->select('cr.pk_id, cr.comment, c.customer_name, c.customer_photo');
    $this->db->from('purohit_customer_rating as cr');
    $this->db->join('purohit_customer_registration as c', 'cr.fk_customer_id = c.pk_id');
    $this->db->where('cr.status', 1);
    $this->db->order_by('cr.pk_id', 'DESC');
    //$this->db->
    
    $data['customer_rating'] = $this->db->get()->result();
    
    //echo "<pre>"; print_r($data); die();
    
    $this->load->view('front/index/index',$data);
    }

     public function get_language() {
         /*Start:: get city wise language*/
    $city_id= !empty($this->input->post('city_id')) ? $this->input->post('city_id') : '';
    $this->db->select('language,ml.pk_id');
    $this->db->from('master_citywise_language as cl');
    $this->db->join('master_language as ml','ml.pk_id=cl.fk_language','left');
    $this->db->where('cl.status','1');
    $this->db->where('fk_city',$city_id);
    $this->db->order_by('cl.pk_id','desc');
    $languagelist=$this->db->get()->result_array();

     echo json_encode($languagelist);
    /*End:: get city wise language*/
// echo "<pre>";print_r($languagelist);die();
    }

    public function sessionExpire() {
        $this->session->set_flashdata('error', 'Sorry..! Session Expired Please Login.');
        redirect(base_url() . 'admin/login');
    }






}
