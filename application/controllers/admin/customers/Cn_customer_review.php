<?php

if(!defined('BASEPATH')) exit('No direct script Access allowed');

class Cn_customer_review extends CI_Controller
{
     public function __construct()
     {
		parent::__construct();
	 }
	 
	 public function index()
	 {
	     $this->db->select('c.customer_name, cr.pk_id, cr.rating, cr.comment, cr.status');
	     $this->db->from('purohit_customer_rating as cr');
	     $this->db->join('purohit_customer_registration as c', 'c.pk_id = cr.fk_customer_id', 'LEFT');
	     $this->db->where('cr.status<>', 3);
	     $this->db->order_by('cr.pk_id', 'DESC');
	     
	     $data['review_list'] = $this->db->get()->result();
	     
	    // echo "<pre>"; print_r($data); die();
	     
	     $this->load->view('admin/customers/vw_customers_review_list', $data);
	 }
	 
	 public function status($id = NULL, $status = NULL)
	 {
	     $data = array(
	         'status' => $status,
	         'updated_date' => date('Y-m-d H:i:s')
	         );
	         
	   $result = $this->db->update('purohit_customer_rating', $data, array('pk_id' => $id));
	   
	   if($result)
	   {
	       $this->session->set_flashdata('success', 'Status Updated Successfully!');
	   }
	   else
	   {
	       $this->session->set_flashdata('error', 'Failed to Updated Status.');
	   }
	   
	   return redirect(base_url('admin/customer-reviews'));
	 }
	 
	 public function delete($id = NULL)
	 {
	     $data = array(
	         'status' => 3,
	         'updated_date' => date('Y-m-d H:i:s')
	         );
	         
	   $result = $this->db->update('purohit_customer_rating', $data, array('pk_id' => $id));
	   
	   if($result)
	   {
	       $this->session->set_flashdata('success', 'Record Deleted Successfully!');
	   }
	   else
	   {
	       $this->session->set_flashdata('error', 'Failed to Delete record.');
	   }
	   
	   return redirect(base_url('admin/customer-reviews'));
	 }
}

?>