<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cn_transaction_history extends CI_Controller {

    public function transaction_history_list() {

        $purohit_id = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $limit = !empty($this->input->post('limit')) ? $this->input->post('limit') : '';
        $offset = !empty($this->input->post('offset')) ? $this->input->post('offset') : '0';
        

         if (empty($purohit_id)) {
            $resultarray = array('error_code' => '3','message' => 'purohit id empty.');
            echo json_encode($resultarray);
            exit();
        }
        $condition = array('pk_id' => $purohit_id);
        $select = 'status';
        $checkuser = $this->Md_database->getData('registered_purohit', $select, $condition, '', '');


        if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '2') {
            $resultarray = array('error_code' => '10','message' => 'User is inactive. Please contact to ' . SITE_TITLE);
            echo json_encode($resultarray);
            exit();
        } else if (!empty($checkuser[0]['status']) && $checkuser[0]['status'] == '1') {

            $this->db->select('balance');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$purohit_id);
            $this->db->order_by('A.created_date desc');
            $this->db->limit(1);
            $balance_data=$this->db->get()->result_array();
            $balance=!empty($balance_data[0]['balance'])?$balance_data[0]['balance']:'0'; 

    

            $this->db->select('SUM(amount) as paid_amt');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.transaction_type','2');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$purohit_id);
            $paid_data=$this->db->get()->result_array();
            $paid_amt=!empty($paid_data[0]['paid_amt'])?$paid_data[0]['paid_amt']:'0'; 

            $this->db->select('SUM(amount) as other_earning_amt');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.transaction_type','3');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$purohit_id);
            $oher_earning_data=$this->db->get()->result_array();
            $other_earning_amt=!empty($oher_earning_data[0]['other_earning_amt'])?$oher_earning_data[0]['other_earning_amt']:'0';   
            //echo "<pre>"; print_r($other_earning_amt); die();

            $this->db->select('SUM(amount) as puja_earning_amt');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.transaction_type','4');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$purohit_id);
            $puja_earning_amt=$this->db->get()->result_array();
            $puja_earning=!empty($puja_earning_amt[0]['puja_earning_amt'])?$puja_earning_amt[0]['puja_earning_amt']:'0';
            
            $this->db->select('SUM(amount) as puja_fine_amt');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.transaction_type','1');
            $this->db->where('A.status','1');
            $this->db->where('A.fk_purohit_id',$purohit_id);
            $puja_fine_amt = $this->db->get()->result_array();
            $puja_fine = !empty($puja_fine_amt[0]['puja_fine_amt'])?$puja_fine_amt[0]['puja_fine_amt']:'0';
            
            //echo "<pre>"; print_r($puja_fine); die();
           
            $this->db->select('SUM(total_pkg_price_exclusive) as total_business');
            $this->db->from('customer_pooja_order as A');
            $this->db->where('A.status','1');
            $this->db->where('A.pooja_status','2');
            $this->db->where('A.fk_purohit',$purohit_id);
            $total_business_amt=$this->db->get()->result_array();
            
            $total_business=!empty($total_business_amt[0]['total_business'])?$total_business_amt[0]['total_business']:'0';
            
            $final_earning = $other_earning_amt + $puja_earning + $puja_fine;
            $admin_commision = $total_business - $final_earning;
            
            $value['total_business'] = !empty($total_business)?(string)number_format($total_business, 1):0;
            $value['total_comission'] = !empty($admin_commision)?(string)number_format($admin_commision, 1):0;
            // $value['total_incetive']=$incentive_sum;
            $value['total_earnig'] = !empty($final_earning)?(string)$final_earning:0;
            $value['total_recvied_amt'] = !empty($paid_amt)?(string)$paid_amt:0;
            $value['total_balance_amt'] = !empty($balance)?(string)$balance:0;

            $finalarray[]=$value;

          
            $output=$finalarray;

        $table = "purohit_purohit_transaction_history";
        $select = "purohit_purohit_transaction_history.pk_id,fk_purohit_id,amount,transaction_id,remark,transaction_date,transaction_time,transaction_date,balance,purohit_purohit_transaction_history.status,transaction_type,purohit_purohit_transaction_history.created_date,concat(rp.first_name,' ',rp.middle_name,' ',rp.last_name) as purohit_name,rp.mobile_no,rp.email_id,rp.address,balance,fk_pooja_order_id";
        $condition = array('purohit_purohit_transaction_history.status'=> '1'); 
        // $this->db->where('amount!=',0);
        $this->db->join('purohit_registered_purohit as rp','rp.pk_id = purohit_purohit_transaction_history.fk_purohit_id', 'LEFT');
        $this->db->where("fk_purohit_id",$purohit_id);
    
        $this->db->order_by("purohit_purohit_transaction_history.pk_id",'DESC');
        $transaction_list_arr = $this->Md_database->getData($table, $select, $condition, '','');
        $count = count($transaction_list_arr);
        $transaction_list = array();
        
        for($i = 0; $i < $count; $i++)
        {
            $transaction_list[$i]['pk_id'] = !empty($transaction_list_arr[$i]['pk_id'])?(string)$transaction_list_arr[$i]['pk_id']:"";
            $transaction_list[$i]['fk_purohit_id'] = !empty($transaction_list_arr[$i]['fk_purohit_id'])?(string)$transaction_list_arr[$i]['fk_purohit_id']:"";
            $transaction_list[$i]['amount'] = !empty($transaction_list_arr[$i]['amount'])?(string)$transaction_list_arr[$i]['amount']:0;
            $transaction_list[$i]['transaction_id'] = !empty($transaction_list_arr[$i]['transaction_id'])?(string)$transaction_list_arr[$i]['transaction_id']:"";
            $transaction_list[$i]['remark'] = !empty($transaction_list_arr[$i]['remark'])?(string)$transaction_list_arr[$i]['remark']:"";
            $transaction_list[$i]['transaction_date'] = !empty($transaction_list_arr[$i]['transaction_date'])?(string)$transaction_list_arr[$i]['transaction_date']:"";
            $transaction_list[$i]['transaction_time'] = !empty($transaction_list_arr[$i]['transaction_time'])?(string)$transaction_list_arr[$i]['transaction_time']:"";
            $transaction_list[$i]['balance'] = !empty($transaction_list_arr[$i]['balance'])?(string)$transaction_list_arr[$i]['balance']:"";
            $transaction_list[$i]['status'] = !empty($transaction_list_arr[$i]['status'])?(string)$transaction_list_arr[$i]['status']:"";
            $transaction_list[$i]['transaction_type'] = !empty($transaction_list_arr[$i]['transaction_type'])?(string)$transaction_list_arr[$i]['transaction_type']:"";
            $transaction_list[$i]['created_date'] = !empty($transaction_list_arr[$i]['created_date'])?(string)$transaction_list_arr[$i]['created_date']:"";
            $transaction_list[$i]['purohit_name'] = !empty($transaction_list_arr[$i]['purohit_name'])?(string)$transaction_list_arr[$i]['purohit_name']:"";
            $transaction_list[$i]['mobile_no'] = !empty($transaction_list_arr[$i]['mobile_no'])?(string)$transaction_list_arr[$i]['mobile_no']:"";
            $transaction_list[$i]['email_id'] = !empty($transaction_list_arr[$i]['email_id'])?(string)$transaction_list_arr[$i]['email_id']:"";
            $transaction_list[$i]['address'] = !empty($transaction_list_arr[$i]['address'])?(string)$transaction_list_arr[$i]['address']:"";
            $transaction_list[$i]['fk_pooja_order_id'] = !empty($transaction_list_arr[$i]['fk_pooja_order_id'])?(string)$transaction_list_arr[$i]['fk_pooja_order_id']:"";
            
        }
        

 // print_r($transaction_list);die();

            if (!empty($transaction_list)){

                $resultarray = array('error_code' => '1','ammount_data'=>$output,'purohit_transaction_history_list'=>$transaction_list, 'message' => 'Transaction history list.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'ammount_data'=>$output,
                    'message' => "Transaction history are empty."
                );
            }
            echo json_encode($resultarray);
            exit();
        }
    }
}
