<?php 


class Md_Common extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function check_email($email = NULL)
    {
        $query = $this->db->get_where('purohit_registered_purohit', array('email_id' => $email, 'status<>' => 3));
        return $query->num_rows();
    }
    
    public function check_mobile($mobile = NULL)
    {
        $query = $this->db->get_where('purohit_registered_purohit', array('mobile_no' => $mobile, 'status<>' => 3));
        return $query->num_rows();
    }
}

?>