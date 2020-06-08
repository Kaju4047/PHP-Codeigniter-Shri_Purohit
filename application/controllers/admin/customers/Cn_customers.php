<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_customers extends CI_Controller {

    /*public function customers_list() {
        $this->load->view('admin/customers/vw_customers_list');
    }

    public function view_customers() {
        $this->load->view('admin/customers/vw_view_customers');
    }*/
    public function __construct(){
		parent::__construct();
	}

    public function customers_list(){

    	$data = array();

        $city = !empty($this->input->get('city')) ? trim($this->input->get('city')) : '';
        $cust_id = !empty($this->input->get('cust_id')) ? $this->input->get('cust_id') : '';
        $fromdatefilter = !empty($this->input->get('fromdatefilter')) ? date("Y-m-d" ,strtotime($this->input->get('fromdatefilter')) ): '';
        $todatefilter = !empty($this->input->get('todatefilter')) ? date("Y-m-d" ,strtotime($this->input->get('todatefilter') )): '';

        $data['fromdatefilter']=$fromdatefilter;
        $data['todatefilter']=$todatefilter;
        $data['city']=$city;
   
        $table = "purohit_customer_registration";
        $select = "customer_city";
        $this->db->distinct();
        $this->db->where('customer_city!=','');
        $condition = array('status' => '1');
        $cityList = $this->Md_database->getData($table, $select, $condition, '', '');
        $data['cityList']= $cityList;


        $search_term = !empty($this->input->get('search_term')) ? $this->input->get('search_term') : '';
        $data['search_term']=$search_term;
        //Edit Data
        $data['title'] = 'Customer List';
        $data['edit'] = "";
        $edit_id = !empty($this->input->get('edit'))?$this->input->get('edit'):"";  
        if (!empty($edit_id)) {
            $table = "purohit_customer_registration";
            $select = "*";
            $condition = array(
                'pk_id' => $edit_id,
            );
            $customerDetails = $this->Md_database->getData($table, $select, $condition, '', '');
            if (empty($customerDetails)) {
                $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                             Sorry, something went wrong.
                        </div>');
                redirect(base_url() . 'admin/customers-list');
            }
            $data['edit'] = $customerDetails[0];
        }
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        $total_records = "";
        $registered_customers = array();
        $table = "purohit_customer_registration";
        $select="pk_id,customer_name,customer_mobile_no,customer_email_id,customer_city,customer_address,customer_pincode,created_date,status";

        $condition = array(
            'status !=' => '3'
        );
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("customer_mobile_no LIKE '%$search_term%'");
            $this->db->or_like('customer_name',$search_term);
            $this->db->or_like('customer_email_id',$search_term);
            $this->db->or_like('customer_city',$search_term);			             
            $this->db->group_end();
        }
        if (!empty($city)) {
            $this->db->where("customer_city LIKE '%$city%'");
        }
        if(!empty($fromdatefilter)){
            // print_r($fromdatefilter);die();
            $this->db->where('date(purohit_customer_registration.created_date)>=',date("Y-m-d",strtotime($fromdatefilter)));
        }
        if(!empty($todatefilter)){
            $this->db->where('date(purohit_customer_registration.created_date)<=',date("Y-m-d",strtotime($todatefilter)));
        } 
      
        $registered_customers = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');

          // echo "<pre>";
          //   print_r($registered_customers);
          //   die();

        $total_records=!empty($registered_customers) ? count($registered_customers) : '0';

        $data['totalcount']=!empty($total_records) ? $total_records : '0';
       
        if ($total_records > 0){
            $this->db->limit($limit_per_page,$page * $limit_per_page);
            $table ="purohit_customer_registration";
            $select="pk_id,customer_name,customer_mobile_no,customer_email_id,customer_city,customer_address,created_date,status";
                
            $condition = array(
                'status !=' => '3'
            );
            if (!empty($search_term)){
                $this->db->where("customer_mobile_no LIKE '%$search_term%'");
                $this->db->or_like('customer_name',$search_term);
                $this->db->or_like('customer_email_id',$search_term);
	            $this->db->or_like('customer_city',$search_term);

            }
             if (!empty($city)) {
                $this->db->where("customer_city LIKE '%$city%'");
            }
             if(!empty($fromdatefilter)){
                // print_r($fromdatefilter);die();
                $this->db->where('date(purohit_customer_registration.created_date)>=',date("Y-m-d",strtotime($fromdatefilter)));
            }
            if(!empty($todatefilter)){
                $this->db->where('date(purohit_customer_registration.created_date)<=',date("Y-m-d",strtotime($todatefilter)) );
            }
            $registered_customer = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');
          

            $params["results"] = $registered_customer;             
           
            $params["links"] =  pagination(base_url('admin/customers-list/'), $total_records, $limit_per_page);
        }        
        $data['follow_links']=$params['links'];
        $data['registeredCust']= $params["results"] ;
        //End:: pagination::- 
        $data['totalcount']=$total_records;      
        $this->load->view('admin/customers/vw_customers_list',$data);
    }    

    public function view_customers($id){
    	
    	$data=[];
    	$query=$this->db->get_where('purohit_customer_registration',array('pk_id' => $id,'status !='=>'3' ));
    	if($query->num_rows()>0)
    	{
    		$data['customer_result']=$query->row();
    	}  
          


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
        $this->db->where('customer_pooja_order.fk_user_id',$id);

        $upcomingPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $data['upcomingPoojaCount']=count($upcomingPoojaDeatails);

        //Total Count of Completed Puja 
       // $table = "customer_pooja_order";
       //  $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
       //  $condition = array(
       //      'customer_pooja_order.status !=' => '3',
       //  );
       //  $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
       //  $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
       //  $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
       //  $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 
       //  $this->db->where('customer_pooja_order.fk_user_id',$id);
        
       //  $completedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC', '');
         $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id";             
        // $select="*";             
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');
        $this->db->where('purohit_customer_pooja_order.pooja_status','2'); 
        $this->db->where('customer_pooja_order.fk_user_id',$id);

        $completedPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $data['completedPoojaCount']=count($completedPoojaDeatails);
        // print_r($data['completedPoojaCount']);
        // die();


        //Total count of cancelled Pooja
        $table = "customer_pooja_order";
        $select="pooja.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,customer_pooja_order.status,customer_pooja_order.cancelled_date_time";             
        // $select="*";             
        $condition = array();
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');  
        $this->db->where('customer_pooja_order.status!=','3'); 
        $this->db->group_start();
        $this->db->where('purohit_customer_pooja_order.pooja_status','3'); 
        $this->db->or_where('purohit_customer_pooja_order.pooja_status','4');  
        $this->db->group_end(); 
        $this->db->where('customer_pooja_order.fk_user_id',$id);
      
        $cancelledPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        $data['cancelledPoojaCount']=count($cancelledPoojaDeatails);

    	$this->load->view('admin/customers/vw_view_customers',$data);
    }

    public function registeredCustomerStatusChange($id, $status){
    	$table = "purohit_customer_registration";
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
    	redirect(base_url() . 'admin/customers-list');
    }

    public function deleteRegisteredCustomer($id){
    	$condition = array('pk_id' => $id);
    	$update_data['status'] = '3';

       	$table='purohit_customer_registration'; //tbl name
       	$ret = $this->Md_database->updateData($table, $update_data, $condition);
       	if (!empty($ret)) {
       		$this->session->set_flashdata('success', "Registered Customer details has been deleted successfully.");
       	// 	redirect($_SERVER['HTTP_REFERER']);  
       	return redirect(base_url('admin/customers-list'));
       	}
    }

    /*[Start ::  function collection log report export excel :]*/
  public function export_to_excel_customer(){
        $this->load->library('Excel');
        $city = !empty($this->input->get('city')) ? trim($this->input->get('city')) : '';
        $cust_id = !empty($this->input->get('cust_id')) ? $this->input->get('cust_id') : '';
        $fromdatefilter = !empty($this->input->get('fromdatefilter')) ? date("Y-m-d" ,strtotime($this->input->get('fromdatefilter')) ): '';
        $todatefilter = !empty($this->input->get('todatefilter')) ? date("Y-m-d" ,strtotime($this->input->get('todatefilter') )): '';

        $data['fromdatefilter']=$fromdatefilter;
        $data['todatefilter']=$todatefilter;
        $data['city']=$city;
   
        $table = "purohit_customer_registration";
        $select = "customer_city";
        $this->db->distinct();
        $this->db->where('customer_city!=','');
        $condition = array('status' => '1');
        $cityList = $this->Md_database->getData($table, $select, $condition, '', '');
        $data['cityList']= $cityList;


        $search_term = !empty($this->input->get('search_term')) ? $this->input->get('search_term') : '';
        $data['search_term']=$search_term;
        // print_r($search_term);
        // die();
        $table ="purohit_customer_registration";
        $select="pk_id,customer_name,customer_mobile_no,customer_email_id,customer_city,customer_address,created_date,status";
            
        $condition = array(
            'status !=' => '3'
        );
        if (!empty($search_term)){
            $this->db->where("customer_mobile_no LIKE '%$search_term%'");
            $this->db->or_like('customer_name',$search_term);
            $this->db->or_like('customer_email_id',$search_term);
            $this->db->or_like('customer_city',$search_term);

        }
         if (!empty($city)) {
            $this->db->where("customer_city LIKE '%$city%'");
        }
         if(!empty($fromdatefilter)){
            // print_r($fromdatefilter);die();
            $this->db->where('date(purohit_customer_registration.created_date)>=',date("Y-m-d",strtotime($fromdatefilter)));
        }
        if(!empty($todatefilter)){
            $this->db->where('date(purohit_customer_registration.created_date)<=',date("Y-m-d",strtotime($todatefilter)) );
        }
        $registered_customer = $this->Md_database->getData($table, $select, $condition, 'pk_id DESC', '');
        $data['registered_customer'] = $registered_customer;
        // echo "<pre>";
        // print_r($academyDetails);
        // die();
      /*[:: Start Collection report excel sheet  Name::]*/
      $comm_title ="Customers List";
      $date_title ="all_time";
      $user_title ="all";
        /*[:: End Collection report excel sheet  Name::]*/

      if (!empty($registered_customer)) {
            $finalsArray = $registered_customer;
            $this->excel->getActiveSheet()->setTitle('RemarksReport');
            $date = date('d-m-Y g:i A'); // get current date time
            $cnt = count($finalsArray);
              
            $counter = 1; 
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'From Date');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter,  $fromdatefilter);
              $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$counter, 'To Date');
              $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$counter, $todatefilter);
              $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$counter,'City');
              $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$counter, $city);
              $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$counter,'Search');
              $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$counter, $search_term);
  
            $counter = 2;
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'Sr.No.');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter, 'Registered On');
              $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$counter, 'Customer Name');
              $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$counter, 'Mobile No.');
              $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$counter, 'Email Id');
              $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$counter, 'City');
           
              // set auto size for columns
              $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

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
                      $customer_name = !empty($arrayUser['customer_name']) ? ucwords($arrayUser['customer_name']):'-';
                      $customer_mobile_no = !empty($arrayUser['customer_mobile_no']) ? $arrayUser['customer_mobile_no']:''; 
                      $customer_email_id = !empty($arrayUser['customer_email_id']) ? $arrayUser['customer_email_id']:'';
                      $customer_city = !empty($arrayUser['customer_city']) ? $arrayUser['customer_city']:'-';
                        
                      $this->excel->setActiveSheetIndex(0)
                          ->setCellValue('A' . $counter, (!empty($j) ? $j : ''))
                          ->setCellValue('B' . $counter, (!empty($created_date) ? $created_date : "-"))
                          ->setCellValue('C' . $counter, (!empty($customer_name) ? $customer_name : "-"))

                          ->setCellValue('D' . $counter, (!empty($customer_mobile_no) ? $customer_mobile_no : "-"))
                          ->setCellValue('E' . $counter, (!empty($customer_email_id) ? $customer_email_id : "-"))
                          ->setCellValue('F' . $counter, (!empty($customer_city) ? $customer_city : "-"));
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
            redirect(base_url() . 'admin/customers-list');
      }
  }
  /*[End ::  function collection log report export excel :]*/

}
