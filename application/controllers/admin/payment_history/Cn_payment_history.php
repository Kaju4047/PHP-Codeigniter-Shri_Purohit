<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_payment_history extends CI_Controller {

    public function payment_history() {
    	$table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $this->db->where('pooja_city!=','');
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;
        
        

        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
        $purohit_id = !empty($this->input->get('purohit_id')) ? trim($this->input->get('purohit_id')) : '';
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('fromdatefilter')) ? date("Y-m-d" ,strtotime($this->input->get('fromdatefilter')) ): '';
        $filter_todate = !empty($this->input->get('todatefilter')) ? date("Y-m-d" ,strtotime($this->input->get('todatefilter')) ): '';

        $data['search_term']=$search_term;
        $data['filter_city']=$filter_city;
        $data['fromdatefilter']=$filter_fromdate;
        $data['todatefilter']=$filter_todate;
       
        //start:: pagination::- 
        $params = array();
        $params['links'] = array();
        $params['results'] = array();
        $limit_per_page =10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) -1) : 0;
        
        $total_records = "";
        $table = "customer_pooja_order";
        $select="customer_pooja_order.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,completed_date_time,total_pkg_price_exclusive,customer_pooja_order.purohit_percentage";          
        $condition = array(
            'customer_pooja_order.status!=' => '3',
        );
        $this->db->distinct(); 
        $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
        $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
        $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');   
        $this->db->join('purohit_package','purohit_package.pk_id=customer_pooja_order.fk_package_id');  
        if (!empty($filter_city)) {
            $this->db->where('pooja_city',$filter_city);  
        }
        if (!empty($filter_fromdate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
        }
        if (!empty($filter_todate)) {
            $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
        }
        if (!empty($search_term)){
            $this->db->group_start();
            $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
            $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
            $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
            $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
            $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
            $this->db->or_where("customer_pooja_order.pooja_city LIKE '%$search_term%'");
            $this->db->group_end();             
        }
        if(!empty($cust_id)){
            $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
        }
        if (!empty($purohit_id)) {
            $this->db->group_start();
            $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
            $this->db->where('purohit_customer_pooja_order.pooja_status',2);  
            $this->db->group_end();
        }
        $paymentPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
        //echo "<pre>"; print_r($paymentPoojaDeatails); die();
        // foreach ($paymentPoojaDeatails as $key => $value) {
	       //  $purohit_percentage=$value['purohit_percentage'];
	       //  $total_amount = $value['total_pkg_price_exclusive'];

	       //  $value['purohit_amount'] = ($total_amount * $purohit_percentage)/100;
        //  $finalarray[]=$value;
        // }

        // $payment_historyList=$finalarray;


        $total_records=!empty($paymentPoojaDeatails) ? count($paymentPoojaDeatails) : '0';
        $data['totalcount']=!empty($total_records) ? $total_records : '0';
        if ($total_records > 0){
                $table = "customer_pooja_order";
                $select="customer_pooja_order.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,completed_date_time,total_pkg_price_exclusive,customer_pooja_order.purohit_percentage";          
                $condition = array(
                    'customer_pooja_order.status!=' => '3',
                );
                $this->db->distinct(); 
                $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
                $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
                $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit');   
                $this->db->join('purohit_package','purohit_package.pk_id=customer_pooja_order.fk_package_id');  
                if (!empty($filter_city)) {
                    $this->db->where('pooja_city',$filter_city);  
                }
                if (!empty($filter_fromdate)) {
                    $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
                }
                if (!empty($filter_todate)) {
                    $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
                }
                if (!empty($search_term)){
                    $this->db->group_start();
                    $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                    $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
                    $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
                    $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
                    $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                    $this->db->or_where("customer_pooja_order.pooja_city LIKE '%$search_term%'");
                    $this->db->group_end();             
                }
                if(!empty($cust_id)){
                    $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
                }
                if (!empty($purohit_id)) {
                    $this->db->group_start();
                    $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                    $this->db->where('purohit_customer_pooja_order.pooja_status',2);  
                    $this->db->group_end();
                }
                $paymentPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
          
                $sum='0';
                foreach($paymentPoojaDeatails as $key => $value) {
        	        $purohit_percentage=$value['purohit_percentage'];
        	        $total_amount = $value['total_pkg_price_exclusive'];
        	        $value['purohit_amount'] = ($total_amount * $purohit_percentage)/100;
                    $finalarray[]=$value;

                }

                $finalarray= array_slice($finalarray,$page * $limit_per_page,$limit_per_page);
                $payment_historyList=$finalarray;


                // $table = "customer_pooja_order";
                //     $select = "(total_pkg_price_exclusive) as grand_total,pk_id";
                //     $this->db->limit($limit_per_page,$page * $limit_per_page);
                //     $condition = array('customer_pooja_order.status!=' => '3',);
                //     $grand_total = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
                //     echo "<pre>";
                //     print_r($grand_total);
                    $sum= "0";
                    foreach($payment_historyList as $key => $v) {
                    $grand_total=$v['total_pkg_price_exclusive'];
                    // $total_amount = $value['total_pkg_price_exclusive'];
                    $sum = ($sum + $grand_total);
                }
                $data['grand_total']=$sum;
      // echo "<pre>";
      // print_r($data);
      // die();

            $params["results"] = $payment_historyList;             
            $config['base_url'] = base_url() . 'admin/payment-history';
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
        $data['payment_historyList']= $params["results"] ;
        //End:: pagination::- 
        // echo "<pre>";
        // print_r(  $data);
        // die();
        $data['totalcount']=$total_records;
        $this->load->view('admin/payment_history/vw_payment_history',$data);
    }

    /*[Start ::  function collection log report export excel :]*/
    public function payment_history_export_to_excel(){
        $this->load->library('Excel');
        $table = "customer_pooja_order";
        $select = "pooja_city";
        $this->db->distinct();
        $this->db->where('pooja_city!=','');
        $condition = array('status' => '1');
        $cityDetails = $this->Md_database->getData($table, $select, $condition, 'pooja_city DESC', '');
        $data['cityDetails']= $cityDetails;        

        $cust_id = !empty($this->input->get('cust_id')) ? trim($this->input->get('cust_id')) : '';
        $purohit_id = !empty($this->input->get('purohit_id')) ? trim($this->input->get('purohit_id')) : '';
        $search_term = !empty($this->input->get('search_term')) ? trim($this->input->get('search_term')) : '';
        $filter_city = !empty($this->input->get('filter_city')) ? trim($this->input->get('filter_city')) : '';
        $filter_fromdate = !empty($this->input->get('filter_fromdate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_fromdate')) ): '';
        $filter_todate = !empty($this->input->get('filter_todate')) ? date("Y-m-d" ,strtotime($this->input->get('filter_todate')) ): '';

        $data['search_term']=$search_term;
        $data['filter_city']=$filter_city;
        $data['fromdatefilter']=$filter_fromdate;
        $data['todatefilter']=$filter_todate;

         $table = "customer_pooja_order";
                $select="customer_pooja_order.pk_id as pooja_id,pooja.pooja_name,customer_registration.customer_name,customer_registration.customer_mobile_no,customer_pooja_order.pooja_date,customer_pooja_order.created_date,concat(purohit_registered_purohit.first_name,' ',purohit_registered_purohit.middle_name,' ',purohit_registered_purohit.last_name) as purohit_name,pooja_city,customer_pooja_order.pk_id,completed_date_time,total_pkg_price_exclusive,purohit_percentage";          
                $condition = array(
                    'customer_pooja_order.status!=' => '3',
                );
                $this->db->distinct(); 
                $this->db->join('purohit_customer_registration','purohit_customer_registration.pk_id=customer_pooja_order.fk_user_id');
                $this->db->join('pooja','pooja.pk_id=customer_pooja_order.fk_pooja_id');
                $this->db->join('purohit_registered_purohit','purohit_registered_purohit.pk_id=customer_pooja_order.fk_purohit','LEFT');   
                $this->db->join('purohit_package','purohit_package.pk_id=customer_pooja_order.fk_package_id');  
                if (!empty($filter_city)) {
                    $this->db->where('pooja_city',$filter_city);  
                }
                if (!empty($filter_fromdate)) {
                    $this->db->where('date(purohit_customer_pooja_order.pooja_date)>=',$filter_fromdate);  
                }
                if (!empty($filter_todate)) {
                    $this->db->where('date(purohit_customer_pooja_order.pooja_date)<=',$filter_todate);  
                }
                if (!empty($search_term)){
                    $this->db->group_start();
                    $this->db->where("pooja.pooja_name LIKE '%$search_term%'");             
                    $this->db->or_where("customer_registration.customer_name LIKE '%$search_term%'");       
                    $this->db->or_where("pooja.pk_id LIKE '%$search_term%'");       
                    $this->db->or_where("concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search_term%'");     
                    $this->db->or_where("customer_registration.customer_mobile_no LIKE '%$search_term%'");
                    $this->db->or_where("customer_pooja_order.pooja_city LIKE '%$search_term%'");
                    $this->db->group_end();             
                }
                if(!empty($cust_id)){
                    $this->db->where('customer_pooja_order.fk_user_id',$cust_id);
                }
                if (!empty($purohit_id)) {
                    $this->db->group_start();
                    $this->db->where('purohit_customer_pooja_order.fk_purohit',$purohit_id);  
                    $this->db->where('purohit_customer_pooja_order.pooja_status',2);  
                    $this->db->group_end();
                }
                $paymentPoojaDeatails = $this->Md_database->getData($table, $select, $condition, 'customer_pooja_order.pk_id DESC','');
          
                $sum='0';
                foreach($paymentPoojaDeatails as $key => $value) {
                    $purohit_percentage=$value['purohit_percentage'];
                    $total_amount = $value['total_pkg_price_exclusive'];
                    $value['purohit_amount'] = ($total_amount * $purohit_percentage)/100;
                    $finalarray[]=$value;

                }
                // $finalarray= array_slice($finalarray,$page * $limit_per_page,$limit_per_page);
                $payment_historyList=$finalarray;
                    $sum= "0";
                    foreach($payment_historyList as $key => $v) {
                    $grand_total=$v['total_pkg_price_exclusive'];
                    // $total_amount = $value['total_pkg_price_exclusive'];
                    $sum = ($sum + $grand_total);
                }
                $data['grand_total']=$sum;

      /*[:: Start Collection report excel sheet  Name::]*/
      $comm_title ="Payment History";
      $date_title ="all_time";
      $user_title ="all";
        /*[:: End Collection report excel sheet  Name::]*/

      if (!empty($payment_historyList)) {
            $finalsArray = $payment_historyList;
            $this->excel->getActiveSheet()->setTitle('RemarksReport');
            $date = date('d-m-Y g:i A'); // get current date time
            $cnt = count($finalsArray);
              
             $counter = 1; 
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'Grand Total');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter,  $sum);
              $this->excel->getActiveSheet()->mergeCells('B1:D1');
              // $this->excel->getActiveSheet()->mergeCells('A1:A2');
$this->excel->getActiveSheet()->getStyle('B1:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('B1:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//  $this->excel->getActiveSheet()->getStyle("A2:B2")->getFont()->setBold(true);
            $counter = 2; 
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'City');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter,  $filter_city);
              $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$counter, 'From Date');
              $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$counter,  $filter_fromdate);
              $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$counter, 'To Date');
              $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$counter,  $filter_todate);
  
            $counter = 3;
              $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$counter, 'Sr.No.');
              $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$counter, 'Puja Id');
              $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$counter, 'Puja Date');
              $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$counter, 'Customer Name');
              $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$counter, 'Customer Mobile No..');
              $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$counter, 'Purohit Names');
              $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$counter, 'Puja Name');
              $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$counter, 'Puja Completed On');
              $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$counter, 'Purohit Amount (Rs.)');
              $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$counter, 'Total Amount (Rs.)');
           
              // set auto size for columns
              $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
              $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

              $from = "A1"; // or any value
              $to = "N1"; // or any value $from = "A1"; // or any value
              $this->excel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
              $from = "A2"; // or any value
              $to = "N2"; // or any value
              $this->excel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
              $from1 = "A3"; // or any value
              $to1 = "N3"; // or any value
              $this->excel->getActiveSheet()->getStyle("$from1:$to1")->getFont()->setBold(true);

              $date = date('d-m-Y g:i A');
              $cnt = count($finalsArray);
            $counter = 4;

              if (!empty($finalsArray)){
                  $j = 1;
                  foreach ($finalsArray as $arrayUser) {
                      $pooja_date = !empty($arrayUser['pooja_date']) ?date('d-m-Y',strtotime( $arrayUser['pooja_date'])) :'';
                      $pooja_id = !empty($arrayUser['pooja_id']) ? $arrayUser['pooja_id']:'-';
                      $customer_name = !empty($arrayUser['customer_name']) ? $arrayUser['customer_name']:''; 
                      $customer_mobile_no = !empty($arrayUser['customer_mobile_no']) ? $arrayUser['customer_mobile_no']:'';
                      $purohit_name = !empty($arrayUser['purohit_name']) ? $arrayUser['purohit_name']:'';
                      $pooja_name = !empty($arrayUser['pooja_name']) ? $arrayUser['pooja_name']:'';
                      $completed_date_time = !empty($arrayUser['completed_date_time']) ?date('d-m-Y',strtotime( $arrayUser['completed_date_time'])) :'';
                      $purohit_amount = !empty($arrayUser['purohit_amount']) ? $arrayUser['purohit_amount']:'';
                      $total_pkg_price_exclusive = !empty($arrayUser['total_pkg_price_exclusive']) ? $arrayUser['total_pkg_price_exclusive']:'';
            
                        
                      $this->excel->setActiveSheetIndex(0)
                          ->setCellValue('A' . $counter, (!empty($j) ? $j : ''))
                          ->setCellValue('B' . $counter, (!empty($pooja_date) ? $pooja_date : "-"))
                          ->setCellValue('C' . $counter, (!empty($customer_name) ? $customer_name : "-"))

                          ->setCellValue('D' . $counter, (!empty($customer_mobile_no) ? $customer_mobile_no : "-"))
                          ->setCellValue('E' . $counter, (!empty($purohit_name) ? $purohit_name : "-"))
                          ->setCellValue('F' . $counter, (!empty($pooja_name) ? $pooja_name : "-"))
                          ->setCellValue('G' . $counter, (!empty($completed_date_time) ? $completed_date_time : "-"))
                          ->setCellValue('G' . $counter, (!empty($purohit_amount) ? $purohit_amount : "-"))
                          ->setCellValue('G' . $counter, (!empty($total_pkg_price_exclusive) ? $total_pkg_price_exclusive : "-"));
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
            redirect(base_url() . 'admin/payment-history');
      }
    }
    /*[End ::  function collection log report export excel :]*/

}
