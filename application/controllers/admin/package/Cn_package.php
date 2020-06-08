<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_package extends CI_Controller {

    public function packageList() {
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
        $table = "package";
        $select="package.pk_id,package.fk_category,package.fk_pooja,package,package_charges,description,package.created_date,package.status,package.updated_date,master_category.category,pooja_name";
        $this->db->join('pooja','pooja.pk_id=package.fk_pooja');
        $this->db->join('master_category','master_category.pk_id=package.fk_category');
        $condition = array(
            'package.status !=' => '3',
        );
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("master_category.category LIKE '%$search_term%'");           
            $this->db->or_where("package.package LIKE '%$search_term%'");
            $this->db->or_where("package.package_charges LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        $packageDetails = $this->Md_database->getData($table, $select, $condition, 'package.pk_id ASC', '');

        $total_records=!empty($packageDetails) ? count($packageDetails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
    	    $table = "package";
	        $select="package.pk_id,package.fk_category,package.fk_pooja,package,package_charges,description,package.created_date,package.status,package.updated_date,master_category.category,pooja.pooja_name";
            $this->db->join('pooja','pooja.pk_id=package.fk_pooja');
            $this->db->join('master_category','master_category.pk_id=package.fk_category');
	        $condition = array(
	            'package.status !=' => '3',
	        );
            if (!empty($search_term)){
                $this->db->group_start();
                $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                $this->db->or_where("master_category.category LIKE '%$search_term%'");       
                $this->db->or_where("package.package LIKE '%$search_term%'");
                $this->db->or_where("package.package_charges LIKE '%$search_term%'");
                $this->db->group_end();             
            }
	        $packageDetails = $this->Md_database->getData($table, $select, $condition, 'package.pk_id ASC', '');

            $params["results"] = $packageDetails;             
            $config['base_url'] = base_url() . 'admin/package-list';
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
        $data['packageDetails']= $params["results"] ;
        //End:: pagination::- 
         $data['totalcount']=$total_records;
         // echo "<pre>";
         // print_r($data);
         // die();
          $this->load->view('admin/package/vw_package_list',$data);
    }

    public function addPackage(){
        $table = "master_language";
        $select = "language,pk_id";
        $condition = array(
            'status' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $languageDetails = $this->Md_database->getData($table, $select, $condition ,'pk_id ASC', '');        
        $data['languageDetails'] = $languageDetails;

        $table = "pooja";
        $select = "pooja_name,pk_id";
        $condition = array(
            'status' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $poojaDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');
        $data['poojaDetails'] = $poojaDetails;

        $table = "master_category";
        $select = "category,pk_id";
        $condition = array(
            'status' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $categoryDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', ''); 
        $data['categoryDetails'] = $categoryDetails;

        $table = "master_additional_services";
        $select = "service_name,pk_id";
        $condition = array(
            'status' => '1'
        );
        $this->db->order_by('pk_id', 'ASC');
        $serviceDetails = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');
        $data['serviceDetails'] = $serviceDetails;
        // echo "<pre>";
        // print_r($data['serviceDetails']);
        // die();
        //Edit Data
        $data['title'] = 'package List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";
        if (!empty($edit_id)) {
            $table = "package";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $poojaEditDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($poojaEditDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/package-list');
            }
            $data['edit'] = $poojaEditDetails[0];
            //Selected Services
            $exclusive=array();
            $inclusive=array();
            $table = "package_services";
            $select = "package_services.fk_services";
            $condition = array(
                'fk_package' => $edit_id,
                'service_type' => '1',
            );
            $inclusiveDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            $inclusiveColumn = array_column($inclusiveDetails,'fk_services');
            $data['inclusiveDetails']=$inclusiveColumn;

            $explodeColumn = array();
            $table = "package_services";
            $select = "package_services.pk_id,package_services.fk_services,charges_to_show_purohit";
            $condition = array(
                'fk_package' => $edit_id,
                'service_type' => '2',
            );
            $exclusiveDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            $explodeColumn = array_column($exclusiveDetails,'fk_services');
            $data['exclusiveDetails']=$explodeColumn;


            $table = "package_services";

            $select = "master_additional_services.service_name,package_services.pk_id,services_charges,fk_services,charges_to_show_purohit";
            $this->db->join('master_additional_services','master_additional_services.pk_id=package_services.fk_services');
            $condition = array(
                'package_services.status' => '1',
                'service_type' =>'2',
                'fk_package'=>$edit_id
            );     
             $data['more_service_list'] = $this->Md_database->getData($table, $select,$condition, '', '');

        }
        $this->load->view('admin/package/vw_add_package',$data);
    }

    public function getCategoryByLanguage(){
        $language_id= $this->input->post('Id');
        // print_r($language_id);die();
        
        $table = "master_category";
        $select = "*";
        $condition = array('status' => '1',
            'fk_language'=>$language_id,
        );     
        $language_name = $this->Md_database->getData($table, $select, $condition, '', ''); 
        $data=!empty($language_name)?$language_name:''; 
        echo json_encode($data);
        exit();
    }

     public function getPoojaByCategory(){
        $language_id= !empty($this->input->post('language'))?$this->input->post('language'):'';
        $category_id= !empty($this->input->post('category'))?$this->input->post('category'):'';
        // print_r($language_id);die();
        
        $table = "pooja";
        $select = "pk_id,pooja_name";
        $condition = array('status' => '1',
            'fk_category'=>$category_id,
            'fk_language'=>$language_id,
        );     
        $pooja_name = $this->Md_database->getData($table, $select, $condition, '', ''); 
        $data=!empty($pooja_name)?$pooja_name:''; 
        echo json_encode($data);
        exit();
    }
    public function getServices(){       
        $table = "master_additional_services";
        $select = "*";
        $condition = array('status' => '1',
        );     
        $service = $this->Md_database->getData($table, $select, $condition, '', ''); 
        $data=!empty($service)?$service:''; 
        echo json_encode($data);
        exit();

    }

    public function addPackageAction(){
        $language = !empty($this->input->post('language')) ? $this->input->post('language') : '';
        $category = !empty($this->input->post('category')) ? $this->input->post('category') : '';
        $pooja = !empty($this->input->post('pooja')) ? $this->input->post('pooja') : '';
        $package = !empty($this->input->post('package')) ? $this->input->post('package') : '';
        $package_charges = !empty($this->input->post('package_charges')) ? $this->input->post('package_charges') : '';
        $purohit_percentage = !empty($this->input->post('purohit_percentage')) ? $this->input->post('purohit_percentage') : '';
        $description = !empty($this->input->post('description')) ? $this->input->post('description') : '';
        $inclusive_services = !empty($this->input->post('inclusive_services')) ? $this->input->post('inclusive_services') : '';
        $exclusive_services = !empty($this->input->post('exclusive_services[]')) ? $this->input->post('exclusive_services[]') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';
        $adm_services = !empty($this->input->post('adm_services')) ? $this->input->post('adm_services') : '';

        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('pooja', 'Pooja', 'required|trim');
        $this->form_validation->set_rules('package', 'Package', 'required|trim');
        $this->form_validation->set_rules('package_charges', 'Package Charges', 'required|trim');
        $this->form_validation->set_rules('purohit_percentage', 'Purohit Percentage', 'required|trim');
        //$this->form_validation->set_rules('inclusive_services', 'Inclusive Service', 'required|trim');
        // $this->form_validation->set_rules('exclusive_services[]', 'Exclusive Service', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }      
         
        if (empty($txtid)) {
            $table = "package";
            $insert_data = array(
                'fk_language' => $language,
                'fk_category' => $category,
                'fk_pooja' => $pooja,
                'package' => $package,
                'package_charges' => $package_charges,
                'purohit_percentage'=>$purohit_percentage,
                'description' => $description,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            //echo "<pre>"; print_r($insert_data); die();
            $result = $this->Md_database->insertData($table, $insert_data);
            $insert_id =  $this->db->insert_id();

             //start::add more service for Exclusive Services
            if(!empty($adm_services)){
                    
    
                for ($i=0; $i <= $adm_services; $i++) { 
                    $service=!empty($this->input->post('services_'.$i))?$this->input->post('services_'.$i):'';
                    $package_charges=!empty($this->input->post('package_charges_'.$i))?$this->input->post('package_charges_'.$i):'';
                    $charges_to_show_purohit=!empty($this->input->post('charges_to_show_purohit_'.$i))?$this->input->post('charges_to_show_purohit_'.$i):'';
            
                    // if(!empty($service) && !empty($package_charges)){
                        // $ins_data=array();
                        $ins_data=array(
                            'fk_package' => $insert_id,
                            'fk_services' => $service,
                            'services_charges' => $package_charges,
                            'charges_to_show_purohit' => $charges_to_show_purohit,
                            'service_type' => '2',
                            'created_by' => $this->session->userdata['UID'],
                            'created_date' => date('Y-m-d H:i:s'),
                            'created_ip_address' => $_SERVER['REMOTE_ADDR'],
                            'status' => '1',
                        );
                        $result =  $this->Md_database->insertData('package_services',$ins_data);
                    // }
                }
            }
            //end::add more service
             // die();

            
                $table = "package_services";
                $insert_data = array(
                    'fk_package' => $insert_id,
                    'fk_services' => $inclusive_services,
                    'service_type' => '1',
                    'created_by' => $this->session->userdata['UID'],
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_ip_address' => $_SERVER['REMOTE_ADDR']
                );
                $result = $this->Md_database->insertData($table, $insert_data);

            
            $this->session->set_flashdata('success', 'Package has been inserted successfully.');
        }else{

            // update data code
            $table = "package";
            $update_data = array(
                'fk_language' => $language,
                'fk_category' => $category,
                'fk_pooja' => $pooja,
                'package' => $package,
                'package_charges' => $package_charges,
                'purohit_percentage'=>$purohit_percentage,
                'description' => $description,
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);

            // $table = "package_services";                          
            // $condition = array('fk_package' =>$txtid); 
            // $resultarray = $this->Md_database->deleteData($table, $condition);

            // foreach ($exclusive_services as $key => $value) {
            //     $table = "package_services";
            //     $insert_data = array(
            //         'fk_package' => $txtid,
            //         'fk_services' => $value,
            //         'service_type' => '2',
            //         'created_by' => $this->session->userdata['UID'],
            //         'created_date' => date('Y-m-d H:i:s'),
            //         'created_ip_address' => $_SERVER['REMOTE_ADDR']
            //     );
            //     $result = $this->Md_database->insertData($table, $insert_data);
            // }
             //start::add more service
            $this->Md_database->deleteData('package_services',array('fk_package' => $txtid));
            if(!empty($adm_services)){
                for ($i=0; $i <= $adm_services; $i++) { 
                    $service=!empty($this->input->post('services_'.$i))?$this->input->post('services_'.$i):'';
                    $package_charges=!empty($this->input->post('package_charges_'.$i))?$this->input->post('package_charges_'.$i):'';
                    $charges_to_show_purohit=!empty($this->input->post('charges_to_show_purohit_'.$i))?$this->input->post('charges_to_show_purohit_'.$i):'';
                // print_r($charges_to_show_purohit);
                // die();
                     // print_r($service);
                    if( !empty($package_charges)){
                     
                        $ins_data=array(
                            'fk_package' => $txtid,
                            'fk_services' => $service,
                            'services_charges' => $package_charges,
                            'charges_to_show_purohit' => $charges_to_show_purohit,
                            'service_type' => '2',
                            'created_by' => $this->session->userdata['UID'],
                            'created_date' => date('Y-m-d H:i:s'),
                            'created_ip_address' => $_SERVER['REMOTE_ADDR'],
                            'status' => '1',
                        );
                        // if ($i==3) {
                        //    echo "<pre>";
                        // print_r($ins_data);
                        // }
                        $result =  $this->Md_database->insertData('package_services',$ins_data);
                    }
                }
                       
            }
            // die();
            //end::add more service
                $table = "package_services";
                $insert_data = array(
                    'fk_package' => $txtid,
                    'fk_services' => $inclusive_services,
                    'service_type' => '1',
                    'created_by' => $this->session->userdata['UID'],
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_ip_address' => $_SERVER['REMOTE_ADDR']
                );
                $result = $this->Md_database->insertData($table, $insert_data);
            

            $this->session->set_flashdata('success', 'Package has been updated successfully.');
        }           
        redirect(base_url() . 'admin/package-list');
    }


    public function viewPackage($id) {
        $table = "package";
        $select="package.pk_id,package.fk_category,package.fk_pooja,package,package_charges,description,package.created_date,package.status,package.updated_date,master_category.category,pooja.pooja_name";
        $this->db->join('pooja','pooja.pk_id=package.fk_pooja');
        $this->db->join('master_category','master_category.pk_id=package.fk_category');
        $condition = array(
            'package.status !=' => '3',
        );
        $this->db->where('package.pk_id',$id);
        $packageDetails = $this->Md_database->getData($table, $select, $condition, 'package.pk_id DESC', '');
        $data['packageDetails']=$packageDetails[0];

        //Inclusive services
        // $table = "package_services";
        // $select = "GROUP_CONCAT(MS.service_name SEPARATOR ',') as service_name ,package_services.pk_id";
        // $condition = array(
        //     'package_services.status' => '1',
        //     'service_type' => '1',
        //     'fk_package' => $id
        // );
        // $this->db->join('master_additional_services as MS','MS.pk_id=package_services.fk_services');
        // $this->db->order_by('package_services.pk_id', 'ASC');
        // $inclusiveDetails = $this->Md_database->getData($table, $select, $condition, 'package_services.pk_id ASC', '');
        $this->db->select('fk_services as service_name');
        $this->db->from('package_services');
        $this->db->where('service_type', 1);
        $this->db->where('fk_package', $id);
        $inclusiveDetails = $this->db->get()->row();
        $data['inclusiveDetails']['service_name'] = $inclusiveDetails->service_name;

        //Exclusive services
        $table = "package_services";
        $select = "GROUP_CONCAT(MS.service_name SEPARATOR ',') as service_name ,package_services.pk_id";
        $condition = array(
            'package_services.status' => '1',
            'service_type' => '2', 
            'fk_package' => $id
        );
        $this->db->join('master_additional_services as MS','MS.pk_id=package_services.fk_services');
        $this->db->order_by('package_services.pk_id', 'ASC');
        $exclusiveDetails = $this->Md_database->getData($table, $select, $condition, 'package_services.pk_id ASC', '');
        $data['exclusiveDetails']=$exclusiveDetails[0];
       // echo "<pre>"; print_r($data); die();
        $this->load->view('admin/package/vw_view_package',$data);
    }
    public function deletePackage($id){
        $condition = array('pk_id' => $id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('package', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Package details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);    
       }
    }
    public function packageeStatusChange($id, $status) {
        $table = "package";
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
        redirect(base_url() . 'admin/package-list');
    }

}
