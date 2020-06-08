<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_enquiry_support_requests extends CI_Controller {

    /*public function enquiry_support_requests() {
        $this->load->view('admin/enquiry_support_requests/vw_enquiry_support_requests');
    }*/
    public function enquiry_support_requests() {

    	$data = array();
        $search_term = !empty($this->input->get('search_term'))?$this->input->get('search_term'):'';
        $serach_by_type = !empty($this->input->get('serach_by_type'))?$this->input->get('serach_by_type'):'all';
        $data['search_term']=$search_term;
      
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
            
        $this->db->select('id, username, user_type, mobile_no, subject, status, created_date');
        $this->db->from('purohit_contactus');
        $this->db->where('user_type', 'User');
        
        if (!empty($search_term)) {
            $this->db->where("id LIKE '%$search_term%'");             
            $this->db->or_where("user_type LIKE '%$search_term%'");             
            $this->db->or_where("first_name LIKE '%$search_term%'");             
            $this->db->or_where("last_name LIKE '%$search_term%'");             
            $this->db->or_where("subject LIKE '%$search_term%'");
        }
        
        $this->db->order_by('id', 'DESC');
        
        $user_data = $this->db->get()->result_array();
        
        
        $this->db->select('pc.id, CONCAT(prp.first_name, " ", prp.last_name) as username, pc.user_type, prp.mobile_no, pc.subject, pc.status, pc.created_date');
        $this->db->from('purohit_contactus as pc');
        $this->db->join('purohit_registered_purohit as prp', 'pc.fk_purohit_id = prp.pk_id', 'LEFT');
        $this->db->where('pc.user_type', 'Purohit');
        
        if (!empty($search_term)) {
            $this->db->or_where("prp.last_name LIKE '%$search_term%'");             
            $this->db->or_where("prp.first_name LIKE '%$search_term%'");             
            $this->db->or_where("prp.mobile_no LIKE '%$search_term%'");             
        }
        
        $this->db->order_by('pc.id', 'DESC');
        
        $purohit_data = $this->db->get()->result_array();
            if($serach_by_type == 'all')
            {            	
            	$enquiryDetails = array_merge($user_data, $purohit_data);
            	array_multisort(array_column($enquiryDetails, 'created_date'), SORT_DESC, $enquiryDetails);
            }
            else
            {            	
                if($serach_by_type == 'User')
                {
                    $enquiryDetails = $user_data;    
                }
                else
                {
                    $enquiryDetails = $purohit_data;
                }
            	
            }
        
        $total_records=!empty($enquiryDetails) ? count($enquiryDetails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
            
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            
        $this->db->select('id, username, user_type, mobile_no, subject, status, created_date');
        $this->db->from('purohit_contactus');
        $this->db->where('user_type', 'User');
        
        if (!empty($search_term)) {
            $this->db->where("id LIKE '%$search_term%'");             
            $this->db->or_where("user_type LIKE '%$search_term%'");             
            $this->db->or_where("first_name LIKE '%$search_term%'");             
            $this->db->or_where("last_name LIKE '%$search_term%'");             
            $this->db->or_where("subject LIKE '%$search_term%'");
        }
        
        $this->db->order_by('id', 'DESC');
        
        $user_data = $this->db->get()->result_array();
        
        
        $this->db->select('pc.id, CONCAT(prp.first_name, " ", prp.last_name) as username, pc.user_type, prp.mobile_no, pc.subject, pc.status, pc.created_date');
        $this->db->from('purohit_contactus as pc');
        $this->db->join('purohit_registered_purohit as prp', 'pc.fk_purohit_id = prp.pk_id', 'LEFT');
        $this->db->where('pc.user_type', 'Purohit');
        
        if (!empty($search_term)) {
            $this->db->or_where("prp.last_name LIKE '%$search_term%'");             
            $this->db->or_where("prp.first_name LIKE '%$search_term%'");             
            $this->db->or_where("prp.mobile_no LIKE '%$search_term%'");             
        }
        
        $this->db->order_by('pc.id', 'DESC');
        
        $purohit_data = $this->db->get()->result_array();
            if($serach_by_type == 'all')
            {            	
            	$enquiryDetails = array_merge($user_data, $purohit_data);
            	array_multisort(array_column($enquiryDetails, 'created_date'), SORT_DESC, $enquiryDetails);
            }
            else
            {            	
                if($serach_by_type == 'User')
                {
                    $enquiryDetails = $user_data;    
                }
                else
                {
                    $enquiryDetails = $purohit_data;
                }
            	
            }
            
            $params["results"] = $enquiryDetails;             
            $config['base_url'] = base_url() . 'admin/enquiry-support-requests';
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
        $data['enquiryDetails']= $params["results"] ;
        $data['totalcount']=$total_records;
        //End:: pagination::- 
        // echo "<pre>";
        // print_r($enquiryDetails);
        // die();
        
        $this->load->view('admin/enquiry_support_requests/vw_enquiry_support_requests',$data);
    }

    public function delete_enquiry_support_requests($id='')
    {
    	$table="purohit_contactus";  
        $update_deleted_by['deleted_by']=$this->session->userdata('UID');   
        $condition=array("id"=>$id);        
        $deleteData= $this->Md_database->updateData($table,$update_deleted_by,$condition);
        if($deleteData){
            $this->session->set_flashdata('success', 'Record has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Something went wrong, please try again.');
        }
        redirect(base_url('admin/enquiry-support-requests'));
    }

    public function get_enquiry_support_data()
    {
    	$id=$this->input->post('id');
    	$condition=array(
    		'id'=>$id
    	);
    	$select="id,purohit_contactus.created_date,user_type,purohit_contactus.first_name,purohit_contactus.last_name,purohit_registered_purohit.mobile_no,purohit_contactus.subject,purohit_contactus.status,purohit_registered_purohit.mobile_no as purohit_mob,purohit_registered_purohit.first_name as purohit_fname,purohit_registered_purohit.last_name as purohit_lname,purohit_registered_purohit.middle_name as purohit_mname,emailid,message";
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id = purohit_contactus.fk_purohit_id','LEFT');
    	$results=$this->Md_database->getData('purohit_contactus',$select,$condition,'','');
    	echo json_encode($results);    	
    }

    public function update_status_enquiry()
    {
    	$response=array("check"=>"error","messsage"=>"failed to update status");
    	$id=!empty($this->input->post('id'))?$this->input->post('id'):'';
    	$status=!empty($this->input->post('status'))?$this->input->post('status'):'';
    	$update_data=array(
    		'status' => $status,
    		'updated_date'=>date('Y-m-d H:i:s'),
    		'updated_by'=>$this->session->userdata('UID'),
    		'updated_ip_address'=>$_SERVER['REMOTE_ADDR']
    		 );
    	$condition=array('id'=>$id);    	
    	$result=$this->Md_database->updateData('purohit_contactus',$update_data,$condition);
    	if($result)
    	{
    		$response=array("check"=>"success","messsage"=>"status updated successfully");
    	}
    	echo json_encode($response);

    }
    

      /*[Start ::  function collection log report export excel :]*/
    public function export_to_excel_enquiry(){
        $this->load->library('Excel');
        $search_term = !empty($this->input->get('search_term')) ? $this->input->get('search_term') : '';
        $data['search_term']=$search_term;

         $table = "purohit_contactus";
         $select="id,purohit_contactus.created_date,user_type,purohit_contactus.first_name,purohit_contactus.last_name,purohit_registered_purohit.mobile_no,purohit_contactus.subject,purohit_contactus.status,purohit_registered_purohit.mobile_no as purohit_mob,purohit_registered_purohit.first_name as purohit_fname,purohit_registered_purohit.last_name as purohit_lname,purohit_registered_purohit.middle_name as purohit_mname";
        $serach_by_type=!empty($this->input->get('serach_by_type'))?$this->input->get('serach_by_type'):'all';
        $condition = array('purohit_contactus.user_type' => $serach_by_type);
        $this->db->where("deleted_by",Null);  
        $data['hidden']='<input type="hidden" name="set_select" id="set_select" value="'.$serach_by_type.'">';
        // $condition = array(
        //     'purohit_contactus.status !=' => '3',
        // );
        if (!empty($search_term)){
            // $this->db->where("purohit_contactus.username LIKE '%$search_term%'");             
            $this->db->where("purohit_contactus.id LIKE '%$search_term%'");             
            $this->db->or_where("purohit_contactus.user_type LIKE '%$search_term%'");             
            $this->db->or_where("purohit_contactus.first_name LIKE '%$search_term%'");             
            $this->db->or_where("purohit_contactus.last_name LIKE '%$search_term%'");             
            $this->db->or_where("purohit_registered_purohit.mobile_no LIKE '%$search_term%'");             
            $this->db->or_where("purohit_contactus.subject LIKE '%$search_term%'"); 
            $this->db->or_where("purohit_registered_purohit.last_name LIKE '%$search_term%'");             
            $this->db->or_where("purohit_registered_purohit.first_name LIKE '%$search_term%'");             
        }
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id = purohit_contactus.fk_purohit_id','LEFT');
        if($serach_by_type=='all')
        {
            $enquiryDetails = $this->Md_database->getData($table, $select, '', 'id DESC', '');
        }
        else
        {
            $enquiryDetails = $this->Md_database->getData($table, $select, $condition, 'id DESC', '');
        }      
        $data['enquiryDetails'] = $enquiryDetails;
        // echo "<pre>";
        // print_r($academyDetails);
        // die();
      /*[:: Start Collection report excel sheet  Name::]*/
      $comm_title ="Enquiry / Support Requests";
      $date_title ="all_time";
      $user_title ="all";
        /*[:: End Collection report excel sheet  Name::]*/

      if (!empty($enquiryDetails)) {
            $finalsArray = $enquiryDetails;
            $this->excel->getActiveSheet()->setTitle('RemarksReport');
            $date = date('d-m-Y g:i A'); // get current date time
            $cnt = count($finalsArray);
              
            $counter = 1; 
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'Filter by');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter,  $serach_by_type);
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'Search');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter,  $serach_by_type);
  
            $counter = 2;
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'Sr.No.');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter, 'Enquiry Id');
              $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$counter, 'Date & Time');
              $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$counter, 'User Type');
              $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$counter, 'Mobile No.');
              $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$counter, 'Subject');
              $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$counter, 'Status');
           
              // set auto size for columns
              $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

              $from = "A1"; // or any value
              $to = "N1"; // or any value
              $this->excel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
              $from1 = "A2"; // or any value
              $to1 = "N2"; // or any value
              $this->excel->getActiveSheet()->getStyle("$from1:$to1")->getFont()->setBold(true);

              $date = date('d-m-Y g:i A');
              $cnt = count($finalsArray);
            $counter = 3;

              if (!empty($finalsArray)) {
                  $j = 1;
                  foreach ($finalsArray as $arrayUser) {
                      $created_date = !empty($arrayUser['created_date']) ?date('d-m-Y',strtotime( $arrayUser['created_date'])) :'';
                      $user_type = !empty($arrayUser['user_type']) ? $arrayUser['user_type']:'-';
                       if($arrayUser['user_type']=="Purohit"){
                          $fname=!empty($arrayUser['purohit_fname'])?ucfirst($arrayUser['purohit_fname']):'';
                          $lname=!empty($arrayUser['purohit_lname'])?ucfirst($arrayUser['purohit_lname']):'';
                          $name=$fname." ".$lname;
                          // echo "<td>".$name."</td>";
                        }
                        elseif($arrayUser['user_type']=="User"){
                          $fname=!empty($arrayUser['first_name'])?ucfirst($arrayUser['first_name']):'';
                          $lname=!empty($arrayUser['last_name'])?ucfirst($arrayUser['last_name']):'';
                          $name=$fname." ".$lname;
                          // echo "<td>".$name."</td>";
                        }
                      $mobile_no = !empty($arrayUser['mobile_no']) ? $arrayUser['mobile_no']:''; 
                      $subject = !empty($arrayUser['subject']) ? $arrayUser['subject']:'';
                      $status = !empty($arrayUser['status']) ? $arrayUser['status']:'';
            
                        
                      $this->excel->setActiveSheetIndex(0)
                          ->setCellValue('A' . $counter, (!empty($j) ? $j : ''))
                          ->setCellValue('B' . $counter, (!empty($created_date) ? $created_date : "-"))
                          ->setCellValue('C' . $counter, (!empty($user_type) ? $user_type : "-"))

                          ->setCellValue('D' . $counter, (!empty($name) ? $name : "-"))
                          ->setCellValue('E' . $counter, (!empty($mobile_no) ? $mobile_no : "-"))
                          ->setCellValue('F' . $counter, (!empty($subject) ? $subject : "-"))
                          ->setCellValue('G' . $counter, (!empty($status) ? $status : "-"));
                      $counter++;
                      $j++;
                  }
                  $this->excel->setActiveSheetIndex(0);                   
              }
                  // Download code for excel
              header('Content-Encoding: UTF-8');
              header('Content-type: text/csv; charset=UTF-8');
              header('Content-Type: application/vnd.ms-excel charset=UTF-8');
              header('Content-Disposition: attachment;filename='.$comm_title.'.xls');
              header('Cache-Control: max-age=0');
              // If you're serving to IE 9, then the following may be needed
              header('Cache-Control: max-age=1');
              //If you're serving to IE over SSL, then the following may be needed
              header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
              header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
              header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
              header('Pragma: public'); // HTTP/1.0
              ob_start();
              $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
              ob_end_clean();
              $objWriter->save('php://output');
              exit;
      }else{
            redirect(base_url() . 'admin/enquiry-support-requests');
      }
    }
    /*[End ::  function collection log report export excel :]*/

}
