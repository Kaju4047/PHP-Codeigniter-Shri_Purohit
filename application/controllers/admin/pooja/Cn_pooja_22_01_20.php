<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_pooja extends CI_Controller {

    public function poojaList() {
    	$data = array();
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $data['search_term']=$search_term;
       
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $table = "pooja";
        $select="pooja.pk_id,pooja_name,pooja.fk_language,fk_category,pooja.created_date,pooja.status,master_category.category,master_language.language";             
        $condition = array(
            'pooja.status !=' => '3',
        );
        $this->db->join('master_language','master_language.pk_id=pooja.fk_language');
        $this->db->join('master_category','master_category.pk_id=pooja.fk_category');

        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("master_language.language LIKE '%$search_term%'");           
            $this->db->or_where("master_category.category LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        $poojaDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

        $total_records=!empty($poojaDetails) ? count($poojaDetails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table = "pooja";
            $select="pooja.pk_id,pooja_name,pooja.fk_language,fk_category,pooja.created_date,pooja.status,master_category.category,master_language.language";             
            $condition = array(
                'pooja.status !=' => '3',
            );
            $this->db->join('master_language','master_language.pk_id=pooja.fk_language');
            $this->db->join('master_category','master_category.pk_id=pooja.fk_category');

            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("master_language.language LIKE '%$search_term%'");           
                $this->db->or_where("master_category.category LIKE '%$search_term%'");
                $this->db->group_end();         
            }
            $poojaDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

            $params["results"] = $poojaDetails;             
            $config['base_url'] = base_url() . 'admin/pooja-list';
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
        $data['poojaDetails']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        $this->load->view('admin/pooja/vw_pooja_list',$data);
    }

    public function addPooja() {
        $table = "master_language";
        $select = "language,pk_id";
        $condition = array(
            'status ' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $languageDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');        
        $data['languageDetails'] = $languageDetails;

        $table = "master_category";
        $select = "category,pk_id";
        $condition = array(
            'status' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $categoryDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');        
        $data['categoryDetails'] = $categoryDetails;

         //Edit Data
        $data['title'] = 'Pooja List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";
        if (!empty($edit_id)) {
            $table = "pooja";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $poojaEditDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($poojaEditDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/city');
            }
            $data['edit'] = $poojaEditDetails[0];
        }
        // print_r($data);
        // die();

        $this->load->view('admin/pooja/vw_add_pooja',$data);
    }

    public function viewPooja($id) { 
        $table = "pooja";
        $select="pooja.pk_id,pooja_name,pooja.fk_language,fk_category,pooja.created_date,pooja.status,master_category.category,master_language.language,short_description,long_description,silent_feature,pooja_image";             
        $condition = array(
            'pooja.status !=' => '3',
        );
        $this->db->where('pooja.pk_id',$id);
        $this->db->join('master_language','master_language.pk_id=pooja.fk_language');
        $this->db->join('master_category','master_category.pk_id=pooja.fk_category');
        $poojaDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');
        $data['poojaDetails'] = $poojaDetails[0];
        $this->load->view('admin/pooja/vw_view_pooja',$data);
    }

    public function addPoojaAction(){
        $language = !empty($this->input->post('language')) ? $this->input->post('language') : '';
        $category = !empty($this->input->post('category')) ? $this->input->post('category') : '';
        $pooja_name = !empty($this->input->post('pooja_name')) ? $this->input->post('pooja_name') : '';
        $short_description = !empty($this->input->post('short_description')) ? $this->input->post('short_description') : '';
        $long_description = !empty($this->input->post('long_description')) ? $this->input->post('long_description') : '';
        $silent_feature = !empty($this->input->post('silent_feature')) ? $this->input->post('silent_feature') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';

        $this->form_validation->set_rules('language', 'Language', 'required|trim');
        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('pooja_name', 'Pooja Name', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('short_description', 'Short Description', 'required|trim');
        $this->form_validation->set_rules('long_description', 'Long Description', 'required|trim');
        $this->form_validation->set_rules('silent_feature', 'Silent Feature', 'required|trim');        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
        $photoDoc = "";
        if (!empty($_FILES['pooja_image']['name'])) {
            $rename_name = uniqid(); //get file extension:
            $arr_file_info = pathinfo($_FILES['pooja_image']['name']);
            $file_extension = $arr_file_info['extension'];
            $newname = $rename_name . '.' . $file_extension;
            // print_r($newname);die();
            $old_name = $_FILES['pooja_image']['name'];
            // print_r($old_name);die();
            $path = "uploads/pooja/";

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $upload_type = "jpg|png|jpeg";

            $photoDoc = $this->Md_database->uploadFile($path, $upload_type, "pooja_image", "", $newname);
            if (!empty($this->input->post('fileold'))) {
               unlink(FCPATH . 'uploads/pooja/' . $this->input->post('fileold'));
            }
        }
        if (empty($txtid)) {
            $table = "pooja";
            $insert_data = array(
                'fk_language' => $language,
                'fk_category' => $category,
                'pooja_name' => $pooja_name,
                'pooja_image' => $photoDoc,
                'short_description' => $short_description,
                'long_description' => $long_description,
                'silent_feature' => $silent_feature,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $result = $this->Md_database->insertData($table, $insert_data);
            $this->session->set_flashdata('success', 'City has been inserted successfully.');
        }else{
            // update data code
            $table = "pooja";
            $update_data = array(
                'fk_language' => $language,
                'fk_category' => $category,
                'pooja_name' => $pooja_name,
                'pooja_image' => $photoDoc,
                'short_description' => $short_description,
                'long_description' => $long_description,
                'silent_feature' => $silent_feature,
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            // $updated_data['pooja_image']=$photoDoc;
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);      
            $this->session->set_flashdata('success', 'Pooja has been updated successfully.');
        }           
        redirect(base_url() . 'admin/pooja-list');
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

    public function poojaeStatusChange($id, $status) {
        $table = "pooja";
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
        redirect(base_url() . 'admin/pooja-list');
    }

    public function deletePooja($id){
        $condition = array('pk_id' => $id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('pooja', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Pooja details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);    
       }
    }  
}
