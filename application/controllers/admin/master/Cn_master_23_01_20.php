<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_master extends CI_Controller {
    /**********************************Master City*********************************/
    public function city() {
        $data = array();
        $search_term = !empty($this->input->get('search_term')) ? $this->input->get('search_term') : '';
        $data['search_term']=$search_term;
        //Edit Data
        $data['title'] = 'City List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";
        if (!empty($edit_id)) {
            $table = "master_city";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $cityDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($cityDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/city');
            }
            $data['edit'] = $cityDetails[0];
        }
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $table = "master_city";
        $select="pk_id,state,city,created_date,status,updated_date";
            
        $condition = array(
            'master_city.status !=' => '3',
        );
        if (!empty($search_term)) {
            $this->db->where("master_city.city LIKE '%$search_term%'");             
        }
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

        $total_records=!empty($cityDetails) ? count($cityDetails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "master_city";
            $select="pk_id,state,city,created_date,status,updated_date";
                
            $condition = array(
                'master_city.status !=' => '3',
            );
            if (!empty($search_term)){
                $this->db->where("master_city.city LIKE '%$search_term%'");             
            }
            $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

            $params["results"] = $cityDetails;             
            $config['base_url'] = base_url() . 'admin/city';
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
        $data['cityDetails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;

        $this->load->view('admin/master/vw_city',$data);
    }

    public function addCity(){
        $state = !empty($this->input->post('state')) ? $this->input->post('state') : '';
        $city = !empty($this->input->post('city')) ? $this->input->post('city') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';

        $this->form_validation->set_rules('state', 'State', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('city', 'City', 'required|trim|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
        if (empty($txtid)) {
            $table = "master_city";
            $insert_data = array(
                'state' => $state,
                'city' => $city,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $result = $this->Md_database->insertData($table, $insert_data);
            $this->session->set_flashdata('success', 'City has been inserted successfully.');
        }else{
            // update data code
            $table = "master_city";
            $update_data = array(
                'state' => $state,
                'city' => $city,
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']
               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);      
            $this->session->set_flashdata('success', 'City has been updated successfully.');
        }           
        redirect(base_url() . 'admin/city');
    }

    public function checkCity(){
        $city='';$state='';$pk_id='';
        $city= $this->input->post('city');
        $state= $this->input->post('state');
        $pk_id= $this->input->post('pk_id');

        if(!empty($pk_id)){
            $this->db->where('pk_id!=', $pk_id);
            $this->db->where('state', $state);
            $this->db->where('city', $city);
          
            $this->db->where('status!=', 3);
            $query = $this->db->get('master_city');
            $res=$query->result_array();
            
            if(!empty($res)){
                echo json_encode(FALSE);
            }else { 
                echo json_encode(TRUE);
            }
        }else{
            $this->db->where('state', $state);
            $this->db->where('city', $city);
            $this->db->where('status!=', 3);
            $query = $this->db->get('master_city');
            $res=$query->result_array();
            if(!empty($res)){
                echo json_encode(FALSE);
            }else{ 
                echo json_encode(TRUE);
            }
        }
    }

    public function cityStatusChange($id, $status) {
        $table = "master_city";
        $insert_data = array(
            'status' => $status,
            'updated_by' => $this->session->userdata['UID'],
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_ip_address' => $_SERVER['REMOTE_ADDR']
            );
        $condition = array("pk_id" => $id);
        $ret = $this->Md_database->updateData($table, $insert_data, $condition);
       
        $actionMsg = 'Inactive';
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Status has been updated successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', "Status $actionMsg failed, please try again.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        redirect(base_url() . 'admin/city');
    }

    public function deleteCity($id){
        $table="master_city";     
        $condition=array("pk_id"=>$id);        
        $deleteData= $this->Md_database->deleteData($table,$condition);
        if($deleteData){
            $this->session->set_flashdata('success', 'City data deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Something went wrong, please try again.');
        }
        redirect(base_url('admin/city'));
    }

    /********************************Master Language***********************************/
    public function language() {
        $data = array();
        $search_term = !empty($this->input->get('search_term')) ? $this->input->get('search_term') : '';
        $data['search_term']=$search_term;
        //Edit Data
        $data['title'] = 'Language List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";
        if (!empty($edit_id)) {
            $table = "master_language";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $languageDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($languageDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/language');
            }
            $data['edit'] = $languageDetails[0];
        }
        $language = !empty($this->input->get('language')) ? $this->input->get('language') : '';
        $data['language']=$language;

            // print_r($data['language']);
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $table = "master_language";
        $select="pk_id,language,created_date,status,updated_date";
            
        $condition = array(
            'master_language.status !=' => '3',
        );
        if (!empty($search_term)) {
            $this->db->where("language LIKE '%$search_term%'");             
        }
        $languageDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

        $total_records=!empty($languageDetails) ? count($languageDetails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "master_language";
            $select="pk_id,language,created_date,status,updated_date";
            $condition = array(
                'master_language.status !=' => '3',
            );
            if (!empty($search_term)) {
                $this->db->where("master_language.language LIKE '%$search_term%'");             
            }
            $languageDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');
            $params["results"] = $languageDetails;             
            $config['base_url'] = base_url() . 'admin/language';
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
        $data['languageDetails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
         // echo "<pre>";
         // print_r($languageDetails);
         // die();
        $this->load->view('admin/master/vw_language',$data);
    }

    public function addLanguage(){
        $language = !empty($this->input->post('language')) ? $this->input->post('language') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';

        $this->form_validation->set_rules('language', 'Language', 'required|trim|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
        if (empty($txtid)) {
            $table = "master_language";
            $insert_data = array(
                'language' => $language,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $result = $this->Md_database->insertData($table, $insert_data);
            $this->session->set_flashdata('success', 'Language has been inserted successfully.');
        }else{
            // update data code
            $table = "master_language";
            $update_data = array(
                'language' => $language,
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);      
            $this->session->set_flashdata('success', 'Language has been updated successfully.');
        }
            
        redirect(base_url() . 'admin/language');

    }
    public function checkLanguage(){
        $language='';$pk_id='';
        $language= $this->input->post('language');
        $pk_id= $this->input->post('pk_id');

        if(!empty($pk_id)){
            $this->db->where('pk_id!=', $pk_id);
            $this->db->where('language', $language);
          
            $this->db->where('status!=', 3);
            $query = $this->db->get('master_language');
            $res=$query->result_array();
            
            if(!empty($res)){
                echo json_encode(FALSE);
            }else { 
                echo json_encode(TRUE);
            }
        }else{
            $this->db->where('language', $language);
            $this->db->where('status!=', 3);
            $query = $this->db->get('master_language');
            $res=$query->result_array();
            if(!empty($res)){
                echo json_encode(FALSE);
            }else{ 
                echo json_encode(TRUE);
            }
        }
    }

    public function languageStatusChange($id, $status) {
        $table = "master_language";
        $language_data = array(
            'status' => $status,
            'updated_by' => $this->session->userdata['UID'],
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_ip_address' => $_SERVER['REMOTE_ADDR']
            );
        $condition = array("pk_id" => $id);
        $ret = $this->Md_database->updateData($table, $language_data, $condition);
       
        $actionMsg = 'Inactive';
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Status has been updated successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', "Status $actionMsg failed, please try again.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        redirect(base_url() . 'admin/language');
    }

    public function deleteLanguage($id){
        $condition = array('pk_id' => $id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('master_language', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Language details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);    
       }
    }

    /*******************************City wise Language*************************************/

     public function citywiseLanguage() {
        $data = array();
        $table = "master_city";
        $select = "city,pk_id";
        $condition = array(
            'status' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');
        $data['cityDetails'] = $cityDetails;
        // print_r($cityDetails);
        // die();

        $table = "master_language";
        $select = "language,pk_id";
        $condition = array(
            'status' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $languageDetails = $this->Md_database->getData($table, $select, $condition ,'pk_id ASC', '');        
        $data['languageDetails'] = $languageDetails;


        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_language = !empty($this->input->get('filter_language')) ? trim($this->input->get('filter_language')) : '';
        $data['filter_city']=$filter_city;    
        $data['filter_language']=$filter_language;    
        //Edit Data
        $data['title'] = 'City wise Language List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";
        if (!empty($edit_id)) {
            $table = "master_citywise_language";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $cityDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($cityDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/citywise-language');
            }
            $data['edit'] = $cityDetails[0];
        }

        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $table = "master_citywise_language";
        $select="master_citywise_language.pk_id,master_city.city,master_citywise_language.created_date,master_citywise_language.status,master_citywise_language.updated_date,master_language.language,fk_language,fk_city";
        $this->db->join('master_city','master_city.pk_id = master_citywise_language.fk_city');   
        $this->db->join('master_language','master_language.pk_id = master_citywise_language.fk_language');    
        $condition = array(
            'master_citywise_language.status !=' => '3',
        );
        if(!empty($filter_city)){  
            $this->db->where("master_city.city LIKE '%$filter_city%'");             
        }
        if(!empty($filter_language)){  
            $this->db->where("master_language.language LIKE '%$filter_language%'");       
        }
        $citywiseLanguage = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

        $total_records=!empty($citywiseLanguage) ? count($citywiseLanguage) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "master_citywise_language";
            $select="master_citywise_language.pk_id,master_city.city,master_citywise_language.created_date,master_citywise_language.status,master_citywise_language.updated_date ,master_language.language,fk_language,fk_city";
            $this->db->join('master_city','master_city.pk_id = master_citywise_language.fk_city');   
            $this->db->join('master_language','master_language.pk_id = master_citywise_language.fk_language');   
            $condition = array(
                'master_citywise_language.status !=' => '3',
            );
            if(!empty($filter_city)){  
                $this->db->where("master_city.city LIKE '%$filter_city%'");             
            }
            if(!empty($filter_language)){  
                $this->db->where("master_language.language LIKE '%$filter_language%'");       
            }

            $citywiseLanguage = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

            $params["results"] = $citywiseLanguage;             
            $config['base_url'] = base_url() . 'admin/citywise-language';
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
        $data['citywiseLanguage']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // print_r($data['citywiseLanguage']);
        // die();
        $this->load->view('admin/master/vw_city_language',$data);
    }

    public function addCitywiseLanguage(){
        $city = !empty($this->input->post('city')) ? $this->input->post('city') : '';
        $language = !empty($this->input->post('language')) ? $this->input->post('language') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';

        $this->form_validation->set_rules('city', 'City', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('language', 'Language', 'required|trim|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
        if (empty($txtid)) {
            $table = "master_citywise_language";
            $insert_data = array(
                'fk_city' => $city,
                'fk_language' => $language,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $result = $this->Md_database->insertData($table, $insert_data);
            $this->session->set_flashdata('success', 'City has been inserted successfully.');
        }else{
            // update data code
            $table = "master_citywise_language";
            $update_data = array(
                'fk_city' => $city,
                'fk_language' => $language,
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);      
            $this->session->set_flashdata('success', 'Citywise Language has been updated successfully.');
        }           
        redirect(base_url() . 'admin/citywise-language');
    }
    public function checkCitywiseLanguage(){
        $language='';$pk_id=''; $city= '';
        $language= $this->input->post('language');
        $city= $this->input->post('city');
        $pk_id= $this->input->post('pk_id');

        if(!empty($pk_id)){
            $this->db->where('pk_id!=', $pk_id);
            $this->db->where('fk_language', $language);
            $this->db->where('fk_city', $city);
          
            $this->db->where('status!=', 3);
            $query = $this->db->get('master_citywise_language');
            $res=$query->result_array();
            
            if(!empty($res)){
                echo json_encode(FALSE);
            }else { 
                echo json_encode(TRUE);
            }
        }else{
            $this->db->where('fk_language', $language);
            $this->db->where('status!=', 3);
            $this->db->where('fk_city', $city);

            $query = $this->db->get('master_citywise_language');
            $res=$query->result_array();
            if(!empty($res)){
                echo json_encode(FALSE);
            }else{ 
                echo json_encode(TRUE);
            }
        }
    } 

    public function citywiseLanguageStatusChange($id, $status) {
        $table = "master_citywise_language";
        $insert_data = array(
            'status' => $status,
            'updated_by' => $this->session->userdata['UID'],
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_ip_address' => $_SERVER['REMOTE_ADDR']
            );
        $condition = array("pk_id" => $id);
        $ret = $this->Md_database->updateData($table, $insert_data, $condition);
       
        $actionMsg = 'Inactive';
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Status has been updated successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', "Status $actionMsg failed, please try again.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        redirect(base_url() . 'admin/citywise-language');
    }

    public function deleteCitywiseLanguage($id){
        $condition = array('pk_id' => $id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('master_citywise_language', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Language details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);    
       }
    }

    /***************************Master Category *********************************/
    public function category() {
        $data = array();
        $table = "master_language";
        $select = "language,pk_id";
        $condition = array(
            'status ' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $languageDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');        
        $data['languageDetails'] = $languageDetails;


        $search_term = !empty($this->input->get('search_term')) ? $this->input->get('search_term') : '';
        $data['search_term']=$search_term;    
        //Edit Data
        $data['title'] = 'Category List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";
        if (!empty($edit_id)) {
            $table = "master_category";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $cityDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($cityDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/category');
            }
            $data['edit'] = $cityDetails[0];
        }
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $table = "master_category";
        $select="master_category.pk_id,master_category.created_date,master_category.status,master_category.updated_date,master_language.language,fk_language,category";   
        $this->db->join('master_language','master_language.pk_id = master_category.fk_language');    
        $condition = array(
            'master_category.status !=' => '3',
        );
        if(!empty($search_term)){  
            $this->db->group_start();
            $this->db->where("master_category.category LIKE '%$search_term%'");
            $this->db->or_where("master_language.language LIKE '%$search_term%'");
            $this->db->group_end();       
        }
        $category = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

        $total_records=!empty($category) ? count($category) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "master_category";
        $select="master_category.pk_id,master_category.created_date,master_category.status,master_category.updated_date,master_language.language,fk_language,category";   
        $this->db->join('master_language','master_language.pk_id = master_category.fk_language');    
        $condition = array(
            'master_category.status !=' => '3',
        );
        if(!empty($search_term)){  
            $this->db->group_start();
            $this->db->where("master_category.category LIKE '%$search_term%'");
            $this->db->or_where("master_language.language LIKE '%$search_term%'");
            $this->db->group_end();      
        }
        $category = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

            $params["results"] = $category;             
            $config['base_url'] = base_url() . 'admin/category';
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
        $data['category']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;

        $this->load->view('admin/master/vw_category',$data);
    }

     public function addCategory(){
        $category = !empty($this->input->post('category')) ? $this->input->post('category') : '';
        $language = !empty($this->input->post('language')) ? $this->input->post('language') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';

        $this->form_validation->set_rules('category', 'Category', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('language', 'Language', 'required|trim|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
        if (empty($txtid)) {
            $table = "master_category";
            $insert_data = array(
                'category' => $category,
                'fk_language' => $language,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $result = $this->Md_database->insertData($table, $insert_data);
            $this->session->set_flashdata('success', 'Category has been inserted successfully.');
        }else{
            // update data code
            $table = "master_category";
            $update_data = array(
                'category' => $category,
                'fk_language' => $language,
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);      
            $this->session->set_flashdata('success', 'Category has been updated successfully.');
        }           
        redirect(base_url() . 'admin/category');
    }
    public function checkCategory(){
        $language='';$pk_id=''; $category= '';
        $language= $this->input->post('language');
        $category= $this->input->post('category');
        $pk_id= $this->input->post('pk_id');

        if(!empty($pk_id)){
            $this->db->where('pk_id!=', $pk_id);
            $this->db->where('fk_language', $language);
            $this->db->where('category', $category);
          
            $this->db->where('status!=', 3);
            $query = $this->db->get('master_category');
            $res=$query->result_array();
            
            if(!empty($res)){
                echo json_encode(FALSE);
            }else { 
                echo json_encode(TRUE);
            }
        }else{
            $this->db->where('fk_language', $language);
            $this->db->where('status!=', 3);
            $this->db->where('category', $category);

            $query = $this->db->get('master_category');
            $res=$query->result_array();
            if(!empty($res)){
                echo json_encode(FALSE);
            }else{ 
                echo json_encode(TRUE);
            }
        }
    } 

    public function categoryStatusChange($id, $status) {
        $table = "master_category";
        $insert_data = array(
            'status' => $status,
            'updated_by' => $this->session->userdata['UID'],
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_ip_address' => $_SERVER['REMOTE_ADDR']
            );
        $condition = array("pk_id" => $id);
        $ret = $this->Md_database->updateData($table, $insert_data, $condition);
       
        $actionMsg = 'Inactive';
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Status has been updated successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', "Status $actionMsg failed, please try again.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        redirect(base_url() . 'admin/category');
    }

    public function deleteCategory($id){
        $condition = array('pk_id' => $id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('master_category', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Category details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);    
       }
    }


    public function advance_payment() {
        $this->load->view('admin/master/vw_advance_payment');
    }

    public function incentives() {
        $this->load->view('admin/master/vw_incentives');
    }

    public function cancellation_charges() {
        $this->load->view('admin/master/vw_cancellation_charges');
    }

    public function tax() {
        $this->load->view('admin/master/vw_tax');
    }
    /*****************************Additional Service*********************************/
    public function additional_services() {

        $search_term = !empty($this->input->get('search_term')) ? $this->input->get('search_term') : '';
        $data['search_term']=$search_term;    
        //Edit Data
        $data['title'] = 'Additional Service List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";
        if (!empty($edit_id)) {
            $table = "master_additional_services";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $cityDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($cityDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/category');
            }
            $data['edit'] = $cityDetails[0];
        }
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
         $table = "master_additional_services";
        $select="pk_id,status,service_name,charges,created_date";      
        $condition = array(
            'status !=' => '3',
        );
        if(!empty($search_term)){  
            $this->db->where("service_name LIKE '%$search_term%'");      
        }
        $additionalServices = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

        $total_records=!empty($additionalServices) ? count($additionalServices) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "master_additional_services";
            $select="pk_id,status,service_name,charges,created_date";      
            $condition = array(
                'status !=' => '3',
            );
            if(!empty($search_term)){  
                $this->db->where("service_name LIKE '%$search_term%'");      
            }
            $additionalServices = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

            $params["results"] = $additionalServices;             
            $config['base_url'] = base_url() . 'admin/additional-services';
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
        $data['additionalServices']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        $this->load->view('admin/master/vw_additional_services',$data);
    }

     public function addAdditionalServices(){
        $service_name = !empty($this->input->post('service_name')) ? $this->input->post('service_name') : '';
        $charges = !empty($this->input->post('charges')) ? $this->input->post('charges') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';

        $this->form_validation->set_rules('service_name', 'Service Name', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('charges', 'Charges', 'required|trim|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
        if (empty($txtid)) {
            $table = "master_additional_services";
            $insert_data = array(
                'service_name' => $service_name,
                'charges' => $charges,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $result = $this->Md_database->insertData($table, $insert_data);
            $this->session->set_flashdata('success', 'Additional Service has been inserted successfully.');
        }else{
            // update data code
            $table = "master_additional_services";
            $update_data = array(
                'service_name' => $service_name,
                'charges' => $charges,
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);      
            $this->session->set_flashdata('success', 'Additional Service has been updated successfully.');
        }           
        redirect(base_url() . 'admin/additional-services');
    }
    public function checkServices(){
        $service_name='';$pk_id=''; $charges= '';
        $service_name= $this->input->post('service_name');
        // $charges= $this->input->post('charges');
        $pk_id= $this->input->post('pk_id');

        if(!empty($pk_id)){
            $this->db->where('pk_id!=', $pk_id);
            $this->db->where('service_name', $service_name);        
            $this->db->where('status!=', 3);
            $query = $this->db->get('master_additional_services');
            $res=$query->result_array();
            
            if(!empty($res)){
                echo json_encode(FALSE);
            }else { 
                echo json_encode(TRUE);
            }
        }else{
            $this->db->where('service_name', $service_name);
            $this->db->where('status!=', 3);

            $query = $this->db->get('master_additional_services');
            $res=$query->result_array();
            if(!empty($res)){
                echo json_encode(FALSE);
            }else{ 
                echo json_encode(TRUE);
            }
        }
    } 

    public function additionalServiceStatusChange($id, $status) {
        $table = "master_additional_services";
        $insert_data = array(
            'status' => $status,
            'updated_by' => $this->session->userdata['UID'],
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_ip_address' => $_SERVER['REMOTE_ADDR']
            );
        $condition = array("pk_id" => $id);
        $ret = $this->Md_database->updateData($table, $insert_data, $condition);
       
        $actionMsg = 'Inactive';
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Status has been updated successfully.");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', "Status $actionMsg failed, please try again.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        redirect(base_url() . 'admin/category');
    }

    public function deleteAdditionalService ($id){
        $condition = array('pk_id' => $id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('master_additional_services', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Services details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);    
       }
    }

    

}


