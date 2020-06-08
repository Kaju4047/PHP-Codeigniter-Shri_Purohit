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
            $purohit_business_data=array();
            $this->db->select('total_pkg_price_exclusive,purohit_percentage');
            $this->db->from('customer_pooja_order as A');
            $this->db->join('purohit_package as B', 'B.pk_id=A.fk_package_id');
            $this->db->where('A.status','1');
            $this->db->where('A.pooja_status','2');
            $this->db->where('A.fk_purohit',$purohit_id);
            $purohit_business_data=$this->db->get()->result_array();
             
            $comission_sum=0;
            $incentive_sum=0;
            $finalarray=array();
            // print_r($purohit_id);die();
            if (!empty($purohit_business_data)) {
          
            foreach ($purohit_business_data as $key => $value) {
            $pkg_exclusive=!empty($value['total_pkg_price_exclusive'])?$value['total_pkg_price_exclusive']:'';
            $purohit_percet=!empty($value['purohit_percentage'])?$value['purohit_percentage']:'0';

            // total attend puja amount by purohit
            $this->db->select('SUM(total_pkg_price_exclusive) as total_business');
            $this->db->from('customer_pooja_order as A');
            $this->db->where('A.status','1');
            $this->db->where('A.pooja_status','2');
            $this->db->where('A.fk_purohit',$purohit_id);
            $total_business_amt=$this->db->get()->result_array();
            $total_business=!empty($total_business_amt[0]['total_business'])?$total_business_amt[0]['total_business']:'';

            // Incentive for purohit on per puja amount (total paid by user (pkg price+sevices+tax))
            // $this->db->select('incentive');
            // $this->db->from('master_incentives as A');
            // $this->db->where('A.status','1');
            // $this->db->order_by('A.pk_id','desc');
            // $this->db->limit('1');
            // $incentive_percent=$this->db->get()->result_array();
            // $incentive=!empty($incentive_percent[0]['incentive'])?$incentive_percent[0]['incentive']:'0';
            // $incetive_amt = $pkg_exclusive*$incentive/100;
            // $incentive_sum=$incentive_sum+$incetive_amt;
            //SUM of all comission on per puja
            $admin_commision=100-$purohit_percet;
            $comission = $pkg_exclusive*$admin_commision/100; 
            $comission_sum=$comission_sum+$comission;
            $earnig=$total_business-$comission_sum;

            //Recived amount to purohit (Total Credited amount by admin)
            $this->db->select('SUM(amount) as total_recevied');
            $this->db->from('purohit_purohit_transaction_history as A');
            $this->db->where('A.status','1');
            $this->db->where('A.transaction_type','2');
            $this->db->where('A.fk_purohit_id',$purohit_id);
            $this->db->order_by('A.created_date','desc');
            $recevied_amt=$this->db->get()->result_array();
            $total_recevied=!empty($recevied_amt[0]['total_recevied'])?$recevied_amt[0]['total_recevied']:'0';


            $value['total_business']=$total_business;
            $value['total_comission']=$comission_sum;
            // $value['total_incetive']=$incentive_sum;
            $value['total_earnig']=$earnig;
            $value['total_recvied_amt']=$total_recevied;
            $value['total_balance_amt']=$earnig-$total_recevied;

            $finalarray[]=$value;

            }
        }
            $output=$finalarray;
 
        $this->db->select('A.fk_pooja_order_id,A.pk_id,amount,transaction_id,remark,transaction_date,transaction_time,transaction_date,transaction_type,A.created_date');
        $this->db->from('purohit_purohit_transaction_history as A');  
        $this->db->where('amount!=',0);
        $this->db->where('fk_purohit_id',$purohit_id);
        $this->db->limit($limit,$offset);
        $this->db->order_by('created_date desc');
        $transaction_list=$this->db->get()->result_array();
            // print_r($transaction_list);die();

            if (!empty($output)){

                $resultarray = array('error_code' => '1','ammount_data'=>$output,'purohit_transaction_history_list'=>$transaction_list, 'message' => 'Transaction history list.');
            } else {
                $resultarray = array(
                    'error_code' => '2',
                    'message' => "Transaction history are empty."
                );
            }
            echo json_encode($resultarray);
            exit();
        }
    }
}
