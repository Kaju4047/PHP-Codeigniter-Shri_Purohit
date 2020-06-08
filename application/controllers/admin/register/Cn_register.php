<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_register extends CI_Controller {

    public function register() {
        $this->load->view('admin/register/vw_register');
    }
    public function view_registered() {
        $this->load->view('admin/register/vw_view_registered');
    }


}


