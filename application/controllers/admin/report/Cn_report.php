<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_report extends CI_Controller {

    public function pooja_booking_report() {
        $this->load->view('admin/report/vw_report_pooja_booking');
    }
    
    public function report_customers() {
        $this->load->view('admin/report/vw_report_customers');
    }
    
    public function report_payment_history() {
        $this->load->view('admin/report/vw_report_payment_history');
    }
    
    public function report_enquiry() {
        $this->load->view('admin/report/vw_report_enquiry');
    }
    
    public function report_transaction_history() {
        $this->load->view('admin/report/vw_report_transaction_history');
    }
}

