<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_registered_purohit extends CI_Controller {
    public function registered_purohit_list() {
    	$data = array();
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $data['search_term']=$search_term;
        //Edit Data
        $data['title'] = 'Purohit List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";  
        if (!empty($edit_id)) {
            $table = "master_state";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $cityDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($cityDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/state');
            }
            $data['edit'] = $cityDetails[0];
        }
        
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ?($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $table = "registered_purohit";
        $select="registered_purohit.pk_id,first_name,middle_name,last_name,mobile_no,email_id,address,registered_purohit.created_date,registered_purohit.status,avg(cr.rating) as rating";
        $this->db->join('purohit_customer_rating as cr','cr.fk_prurohit_id=registered_purohit.pk_id','LEFT'); 
        $this->db->group_by("registered_purohit.pk_id");
        $condition = array(
            'registered_purohit.status !=' => '3'
        );

        if (!empty($search_term)){
            $this->db->group_start();             
            $this->db->where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");   
            $this->db->or_where("mobile_no LIKE '%$search_term%'"); 
            $this->db->or_where("email_id LIKE '%$search_term%'"); 
            $this->db->or_where("address LIKE '%$search_term%'"); 
            $this->db->group_end();            
        }
        $registered_purohit = $this->Md_database->getData($table, $select, $condition, 'registered_purohit.pk_id DESC', '');
        // echo "<pre>";
        // print_r($registered_purohit);
        // die();

        $total_records=!empty($registered_purohit) ? count($registered_purohit) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table ="registered_purohit";
            $select="registered_purohit.pk_id,first_name,middle_name,last_name,mobile_no,email_id,address,registered_purohit.created_date,registered_purohit.status,avg(cr.rating) as rating";
            $this->db->join('purohit_customer_rating as cr','cr.fk_prurohit_id=registered_purohit.pk_id','LEFT');               
            $condition = array(
                'registered_purohit.status !=' => '3'
            );
            $this->db->group_by("registered_purohit.pk_id");
            if (!empty($search_term)){
                $this->db->group_start();            
                 $this->db->where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");  
                $this->db->or_where("mobile_no LIKE '%$search_term%'"); 
                $this->db->or_where("email_id LIKE '%$search_term%'"); 
                $this->db->or_where("address LIKE '%$search_term%'"); 
                $this->db->group_end();            
            }
            $registered_purohit = $this->Md_database->getData($table, $select, $condition, 'registered_purohit.pk_id DESC','');

            $params["results"] = $registered_purohit;             
            $config['base_url'] = base_url() . 'admin/registered-purohit-list';
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
        $data['registeredPurohit']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;
        // echo "<pre>";
        // print_r($data['registeredPurohit']);
        // die();
        $this->load->view('admin/registered_purohit/vw_registered_purohit_list',$data);
    }

    public function addRegisteredPurohit(){
    	$data = array();

        $this->db->where('status','1');
        $query=$this->db->get('master_state');
        $stateList=  $query->result();
        //   echo "<pre>";
        // print_r($stateList);

        // die();

    	$data['stateList']=$stateList;
        $this->db->where('status','1');
        $query=$this->db->get('master_language');
        $languageList=  $query->result();

        $data['languageList']=$languageList;
     
        //Edit Data
        $data['edit'] = "";
        $edit_id = !empty($this->uri->segment(4))?$this->uri->segment(4):"";  
        if (!empty($edit_id)) {
            $purohitDetails= array();
            $table = "registered_purohit";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $purohitDetails = $this->Md_database->getData($table, $select, $condition, '', '');
        //     echo "<pre>";
        // print_r($purohitDetails);

        // die();
            if (empty($purohitDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/add-registered-purohit');
            }
            $data['edit'] = $purohitDetails[0];
            $state_id=!empty($data['edit']['fk_state_id']) ? $data['edit']['fk_state_id']: '' ;
            $data['city']=$this->Md_database->getData('master_city','pk_id,city',array('state' => $state_id));
        //Selected Language
            $exclusive=array();
            $inclusive=array();
            $table = "purohit_registered__purohit_language";
            $select = "language,fk_language_id,fk_purohit_id";
            $condition = array(
                'fk_purohit_id' => $edit_id,
                'purohit_registered__purohit_language.status' => '1',
            );
            $this->db->join('purohit_master_language','purohit_master_language.pk_id=purohit_registered__purohit_language.fk_language_id');
            $languageDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            $languageColumn = array_column($languageDetails,'fk_language_id');
            $data['languageDetails']=$languageColumn;
        }

            // echo "<pre>";
            // print_r($data['edit']);
            // die();
        
        
        $this->load->view('admin/registered_purohit/vw_add_registered_purohit',$data);
    }
     public function getCityById(){
        $state_id= $this->input->post('Id');
        
        $table = "master_city";
        $select = "*";
        $condition = array('status' => '1',
            'state'=>$state_id,
        );     
        $city_name = $this->Md_database->getData($table, $select, $condition, '', ''); 
        $data=!empty($city_name)?$city_name:''; 
        echo json_encode($data);
        exit();
    }

    public function addRegisteredPurohitAction() {
        $first_name = !empty($this->input->post('first_name')) ? $this->input->post('first_name') : '';
        $middle_name = !empty($this->input->post('middle_name')) ? $this->input->post('middle_name') : '';
        $last_name = !empty($this->input->post('last_name')) ? $this->input->post('last_name') : '';
        $mobile_no = !empty($this->input->post('mobile_no')) ? $this->input->post('mobile_no') : '';
        $alter_mobile_no = !empty($this->input->post('alter_mobile_no')) ? $this->input->post('alter_mobile_no') : '';
        $email_id = !empty($this->input->post('email_id')) ? $this->input->post('email_id') : '';
        $dob = !empty($this->input->post('dob')) ? date('Y-m-d',strtotime($this->input->post('dob'))) : '';
        $address = !empty($this->input->post('address')) ? $this->input->post('address') : '';
        $state = !empty($this->input->post('state')) ? $this->input->post('state') : '';
        $city = !empty($this->input->post('city')) ? $this->input->post('city') : '';
        $area = !empty($this->input->post('area')) ? $this->input->post('area') : '';
        $gurukul_name = !empty($this->input->post('gurukul_name')) ? $this->input->post('gurukul_name') : '';
        $experience = !empty($this->input->post('experience')) ? $this->input->post('experience') : '';
        $language = !empty($this->input->post('language[]')) ? $this->input->post('language[]') : '';
        $bank_name = !empty($this->input->post('bank_name')) ? $this->input->post('bank_name') : '';
        $ifsc_code = !empty($this->input->post('ifsc_code')) ? $this->input->post('ifsc_code') : '';
        $branch_name = !empty($this->input->post('branch_name')) ? $this->input->post('branch_name') : '';
        $holder_name = !empty($this->input->post('holder_name')) ? $this->input->post('holder_name') : '';
        $account_number = !empty($this->input->post('account_number')) ? $this->input->post('account_number') : '';
        $txtid = !empty($this->input->post('txtid')) ? $this->input->post('txtid') : '';
        $reg_purohit_full_name=$first_name.' '.$middle_name.' '.$last_name;

   // print_r($state);
   // print_r($city);
   // die();
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|max_length[25]');
        $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|max_length[25]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|max_length[25]');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|trim|max_length[13]|min_length[10]|numeric|is_unique[purohit_registered_purohit.mobile_no]',
        array('is_unique' => 'The mobile number you have entered already exists with another account. Please try with another number.'));
        $this->form_validation->set_rules('alter_mobile_no', 'Alter Mobile No', 'trim|max_length[13]|min_length[10]|numeric');
        $this->form_validation->set_rules('email_id', 'Email Id', 'required|trim|valid_email|is_unique[purohit_registered_purohit.email_id]',
        array('is_unique' => 'The email id you have entered already exists with another account. Please try with another email id.'));
        $this->form_validation->set_rules('dob', 'DOB', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('state', 'State', 'required|trim');
        $this->form_validation->set_rules('city', 'City', 'required|trim');
        $this->form_validation->set_rules('area', 'Area', 'trim|max_length[25]');
        $this->form_validation->set_rules('gurukul_name', 'Gurukul Name', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('experience', 'Experience', 'required|trim');
        $this->form_validation->set_rules('language[]', 'Language', 'required|trim');
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required|trim|max_length[11]');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('holder_name', 'Bank Holder Name', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('account_number', 'Account Number', 'required|trim|max_length[18]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
        

         
        $certificate_image = "";
        if (!empty($_FILES['certificate_image']['name'])) {
            $rename_name = uniqid(); //get file extension:
            $arr_file_info = pathinfo($_FILES['certificate_image']['name']);
            $file_extension = $arr_file_info['extension'];
            $newname = $rename_name . '.' . $file_extension;
            // print_r($newname);die();
            $old_name = $_FILES['certificate_image']['name'];
            // print_r($old_name);die();
            $path = "upload/android/registartion/purohit_certificate/";
            // $path = "uploads/registered_purohit/certificate_image/";

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $upload_type = "jpg|png|jpeg|pdf|doc|zip|docx|";

            $certificate_image = $this->Md_database->uploadFile($path, $upload_type, "certificate_image", "", $newname);
            if (!empty($this->input->post('certificate_image_fileold'))) {
               // unlink(FCPATH . 'uploads/registered_purohit/certificate_image/' . $this->input->post('certificate_image_fileold'));
               // unlink(FCPATH . 'android/registartion/purohit_certificate/' . $this->input->post('certificate_image_fileold'));
            }
        }
        $profile_image = "";
        if (!empty($_FILES['profile_image']['name'])) {
            $rename_name = uniqid(); //get file extension:
            $arr_file_info = pathinfo($_FILES['profile_image']['name']);
            $file_extension = $arr_file_info['extension'];
            $newname = $rename_name . '.' . $file_extension;
            // print_r($newname);die();
            $old_name = $_FILES['profile_image']['name'];
            // print_r($old_name);die();
            // $path = "uploads/registered_purohit/profile_image/";
            $path = "upload/android/registartion/purohit_profile";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $upload_type = "jpg|png|jpeg";

            $profile_image = $this->Md_database->uploadFile($path, $upload_type, "profile_image", "", $newname);
            if (!empty($this->input->post('profile_image_fileold'))) {
               // unlink(FCPATH . 'uploads/registered_purohit/profile_image/' . $this->input->post('certificate_image_fileold'));
               // unlink(FCPATH . 'upload/android/registartion/purohit_profile/' . $this->input->post('certificate_image_fileold'));
            }
        }
         $city_name = $this->Md_database->getData('master_city','city',array('pk_id'=>$city), '', ''); 
        if (empty($txtid)) {
            $randnumber = substr((uniqid(rand(), true)), 0, 6);
            $password = 'SP' . $randnumber;
            // print_r($password);die();
            $table = "registered_purohit";
            $insert_data = array(
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'mobile_no' => $mobile_no,
                'alternate_mobile_no' => $alter_mobile_no,
                'email_id' => $email_id,
                'user_dob' => $dob,
                'address' => $address,
                'fk_state_id' => $state,
                'fk_city_id' => $city,
                'city_name' => $city_name[0]['city'],
                'location' => $area,
                'upload_certificate_image' => $certificate_image,
                'upload_profile_image' => $profile_image,
                'pathshala_gurukul_name' => $gurukul_name,
                'exp_years' => $experience,
                'password' => base64_encode($password),
                'bank_name' => $bank_name,
                'ifsc_code' => $ifsc_code,
                'branch_name' => $branch_name,
                'account_holder_name' => $holder_name,
                'account_number' => $account_number,
                'status' => 1,
                'created_by' => $this->session->userdata['UID'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $insert_id = $this->Md_database->insertData($table, $insert_data);

             foreach ($language as $key => $value){
                $table = "purohit_registered__purohit_language";
                $insert_data = array(
                    'fk_purohit_id' => $insert_id,
                    'fk_language_id' => $value,
                    'created_by' => $this->session->userdata['UID'],
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_ip_address' => $_SERVER['REMOTE_ADDR']
                );
                $result = $this->Md_database->insertData($table, $insert_data);
            }

            //Send Email for create password
            $recipeinets = $email_id;
            $from = array(
                "email" => SITE_MAIL,
                "name" => SITE_TITLE
            );
            $reserved_words = array(
                "||USER_NAME||" => $reg_purohit_full_name,
                "||SITE_TITLE||" => SITE_TITLE,
                "||EMAIL_ID||" => strtolower($email_id),
                "||PASSWORD||" => $password,
                "||CONTACT_US||" => SITE_MAIL,
                "||YEAR||" => date('Y'),
            );
            $email_data = $this->Md_database->getEmailInfo('user_reg_mail', $reserved_words);
            $subject = SITE_TITLE . '-' . $email_data['subject'];
            // print_r($email_data);die();

            $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);

            $this->session->set_flashdata('success', 'State has been inserted successfully.');
        }else{
            // update data code
            $table = "registered_purohit";
            $update_data = array(
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'mobile_no' => $mobile_no,
                'alternate_mobile_no' => $alter_mobile_no,
                'email_id' => $email_id,
                'user_dob' => $dob,
                'address' => $address,
                'fk_state_id' => $state,
                'fk_city_id' => $city,
                'city_name' => $city_name[0]['city'],
                'location' => $area,
                'pathshala_gurukul_name' => $gurukul_name,
                'exp_years' => $experience,
                'bank_name' => $bank_name,
                'ifsc_code' => $ifsc_code,
                'branch_name' => $branch_name,
                'account_holder_name' => $holder_name,
                'account_number' => $account_number,
                'status' => '1',
                'updated_by' => $this->session->userdata['UID'],
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']               
            );
            $condition = array(
                'pk_id' => $txtid,
            );
            // $insertData['certificate'] = $photoDoc3; 
            if (!empty($certificate_image)) {
                $update_data['upload_certificate_image']=$certificate_image;
            }
            if (!empty($profile_image)) {
                $update_data['upload_profile_image']=$profile_image;
            }
            $update_id = $this->Md_database->updateData($table, $update_data, $condition);  
             $this->Md_database->deleteData('purohit_registered__purohit_language',array('fk_purohit_id' => $txtid));
             foreach ($language as $key => $value){
                $table = "purohit_registered__purohit_language";
                $insert_data = array(
                    'fk_purohit_id' => $txtid,
                    'fk_language_id' => $value,
                    'created_by' => $this->session->userdata['UID'],
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_ip_address' => $_SERVER['REMOTE_ADDR']
                );
                $result = $this->Md_database->insertData($table, $insert_data);
            }

            $this->session->set_flashdata('success', 'State has been updated successfully.');
        }      
        redirect(base_url() . 'admin/registered-purohit-list');
    }

    public function viewRegisteredPurohit($pk_id){
    	$this->db->where('registered_purohit.status','1');
    	$this->db->where('registered_purohit.pk_id',$pk_id);
	    $this->db->order_by('registered_purohit.pk_id', 'DESC');  //actual field name of id
        // $this->db->join('master_city','registered_purohit.fk_city_id = master_city.pk_id');
	    $query=$this->db->get('registered_purohit');

	    $purohitData=  $query->result();
	    $data['purohitData'] =$purohitData[0];

        //Total Count of Upcoming Puja 
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";                         
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');  
        $this->db->where('date(purohit_customer_pooja_order.pooja_date)>',date('Y-m-d'));  
        $this->db->where('purohit_customer_pooja_order.pooja_status','5'); 
        $this->db->where('registered_purohit.pk_id',$pk_id);

        $upcomingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $data['upcomingPoojaCount']=count($upcomingPoojaDeatails);

        //Total Count of Completed Puja 
       $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
        $condition = array(
            'customer_pooja_order.status !=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
        $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 
         $this->db->where('registered_purohit.pk_id',$pk_id);
        
        $completedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');
        $data['completedPoojaCount']=count($completedPoojaDeatails);


        //Total count of cancelled Pooja
        // print_r($pk_id);
        // die();
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status,customer_pooja_order.cancelled_date_time";                         
        $condition = array();

            $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
            $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
            $this->db->join('purohit_cancelled_order_by_purohit as cop','purohit_customer_pooja_order.pk_id=cop.fk_pooja_order_id');  
            $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=cop.request_cancelled_by');   
            $this->db->where('customer_pooja_order.status!=','3'); 
             $this->db->where('cop.request_cancelled_by',$pk_id) ; 
  
        $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC',''); 

         $data['cancelledPoojaCount']=count($cancelledPoojaDeatails);
        // print_r($cancelledPoojaDeatails);
        // die();
        //Total count of paid amount of purohit
        $table = "purohit_purohit_transaction_history";
        $select = "SUM(amount) as paid_amount";
        $condition = array('purohit_purohit_transaction_history.status'=> '1'); 
        $this->db->where('amount!=',0);
        $this->db->join('purohit_registered_purohit as rp','rp.pk_id = purohit_purohit_transaction_history.fk_purohit_id');
        $this->db->group_start();
        $this->db->where("fk_purohit_id",$pk_id);
        $this->db->where("transaction_type",2);
        $this->db->group_end(); 
        $paidAmountSum = $this->Md_database->getData($table, $select, $condition, '','');
        $data['paid_amount']=$paidAmountSum[0]['paid_amount'];


        // //Total Business  
        // $this->db->select('total_pkg_price_exclusive,purohit_percentage');
        // $this->db->from('customer_pooja_order as A');
        // $this->db->join('purohit_package as B', 'B.pk_id=A.fk_package_id');
        // $this->db->where('A.status','1');
        // $this->db->where('A.pooja_status','2');
        // $this->db->where('A.fk_purohit',$pk_id);
        // $purohit_business_data=$this->db->get()->result_array();

        //  // echo "<pre>";
        //  // print_r($purohit_business_data);
        //  // die();

        // $comission_sum=0;
        // $incentive_sum=0;
        // $value=0;
        // $finalarray=array();
        // if (!empty($purohit_business_data)) {
        //     foreach ($purohit_business_data as $key => $value) {
        //         $pkg_exclusive=!empty($value['total_pkg_price_exclusive'])?$value['total_pkg_price_exclusive']:'';
        //         $purohit_percet=!empty($value['purohit_percentage'])?$value['purohit_percentage']:'';

        //         // total attend puja amount by purohit
        //         $this->db->select('SUM(total_pkg_price_exclusive) as total_business');
        //         $this->db->from('customer_pooja_order as A');
        //         $this->db->where('A.status','1');
        //         $this->db->where('A.pooja_status','2');
        //         $this->db->where('A.fk_purohit',$pk_id);
        //         $total_business_amt=$this->db->get()->result_array();
        //         $total_business=!empty($total_business_amt[0]['total_business'])?$total_business_amt[0]['total_business']:'';

        //         // Incentive for purohit on per puja amount (total paid by user (pkg price+sevices+tax))
        //         $this->db->select('incentive');
        //         $this->db->from('master_incentives as A');
        //         $this->db->where('A.status','1');
        //         $this->db->order_by('A.pk_id','desc');
        //         $this->db->limit('1');
        //         $incentive_percent=$this->db->get()->result_array();
        //         $incentive=!empty($incentive_percent[0]['incentive'])?$incentive_percent[0]['incentive']:'0';
        //         $incetive_amt = $pkg_exclusive*$incentive/100;
        //         $incentive_sum=$incentive_sum+$incetive_amt;
        //         //SUM of all comission on per puja
        //         $admin_commision=100-$purohit_percet;
        //         $comission = $pkg_exclusive*$admin_commision/100;
        //         // $comission = $pkg_exclusive*$purohit_percet/100;
        //         $comission_sum=$comission_sum+$comission;
        //         $earnig=$total_business-$comission_sum;

        //         //Recived amount to purohit (Total Credited amount by admin)
        //         $this->db->select('SUM(amount) as total_recevied');
        //         $this->db->from('purohit_purohit_transaction_history as A');
        //         $this->db->where('A.status','1');
        //         $this->db->where('A.transaction_type','2');
        //         $this->db->where('A.fk_purohit_id',$pk_id);
        //         $this->db->order_by('A.created_date','desc');
        //         $recevied_amt=$this->db->get()->result_array();
        //         $total_recevied=!empty($recevied_amt[0]['total_recevied'])?$recevied_amt[0]['total_recevied']:'0';

        //         $value['total_business']=$total_business;
        //         $value['total_comission']=$comission_sum;
        //         $value['total_incetive']=$incentive_sum;
        //         $value['total_earnig']=$earnig;
        //         $value['total_recvied_amt']=$total_recevied;
        //         $value['total_balance_amt']=$earnig-$total_recevied;
        //     }
        // }
        // $finalarray[]=$value;
        // $data['bussiness']=$finalarray[0];


           $this->db->select('balance');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$pk_id);
            // $this->db->group_start();
            // $this->db->where('A.transaction_type','4');
            // $this->db->or_where('A.transaction_type','3');
            // $this->db->group_end();
            $this->db->order_by('A.created_date desc');
            $this->db->limit(1);
            $balance_data=$this->db->get()->result_array();
            $balance=!empty($balance_data[0]['balance'])?$balance_data[0]['balance']:'0'; 


            $this->db->select('SUM(amount) as paid_amt');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.transaction_type','2');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$pk_id);
            $paid_data=$this->db->get()->result_array();
            $paid_amt=!empty($paid_data[0]['paid_amt'])?$paid_data[0]['paid_amt']:'0'; 

            $this->db->select('SUM(amount) as other_earning_amt');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.transaction_type','3');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$pk_id);
            $oher_earning_data=$this->db->get()->result_array();
            $other_earning_amt=!empty($oher_earning_data[0]['other_earning_amt'])?$oher_earning_data[0]['other_earning_amt']:'0';   


            $this->db->select('SUM(amount) as puja_earning_amt');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.transaction_type','4');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$pk_id);
            $puja_earning_amt=$this->db->get()->result_array();
            $puja_earning=!empty($puja_earning_amt[0]['puja_earning_amt'])?$puja_earning_amt[0]['puja_earning_amt']:'0';

            $this->db->select('SUM(total_pkg_price_exclusive) as total_business');
            $this->db->from('customer_pooja_order as A');
            $this->db->where('A.status','1');
            $this->db->where('A.pooja_status','2');
            $this->db->where('A.fk_purohit',$pk_id);
            $total_business_amt=$this->db->get()->result_array();
            $total_business=!empty($total_business_amt[0]['total_business'])?$total_business_amt[0]['total_business']:'0';
            $admin_commision=$total_business-$puja_earning;
            $final_earning=$other_earning_amt+$puja_earning;

            $value['total_business']=$total_business;
            $value['total_comission']=$admin_commision;
            // $value['total_incetive']=$incentive_sum;
            $value['total_earnig']=$final_earning;
            $value['total_recvied_amt']=$paid_amt;
            $value['total_balance_amt']=$balance;

            $finalarray[]=$value;

          
            $data['bussiness']=$finalarray[0];
        //   echo "<pre>";
        //   print_r($data);
        //   die();
        $this->load->view('admin/registered_purohit/vw_view_registered_purohit',$data);
    }

    public function registeredPurohitStatusChange($id, $status) {
        $table = "registered_purohit";
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
        redirect(base_url() . 'admin/registered-purohit-list');
    }

    public function deleteRegisteredPurohit($id){
         $condition = array('pk_id' => $id);
        $update_data['status'] = '3';
       
        $ret = $this->Md_database->updateData('registered_purohit', $update_data, $condition);
        if (!empty($ret)) {
            $this->session->set_flashdata('success', "Registered Purohit details has been deleted successfully.");
            redirect($_SERVER['HTTP_REFERER']);    
       }
    }

}
