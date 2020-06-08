<?php
/*
 * @auther Kuldip Gadhiya
 * @email kuldip.g@mplussoft.com
  */
if(! function_exists("pagination")) {
    function pagination($base_url = '', $total_records, $limit_per_page = 10) {
        if(empty($base_url)) {
            return '';
        }

        /*$params = $_SERVER["QUERY_STRING"];

        if(!empty($params)) {
            $base_url = $base_url ."?". $params;
        }*/
        $ci = get_instance();
        $ci->load->library("pagination");

        $config['base_url'] = $base_url;
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
        $ci->pagination->initialize($config);
        return $ci->pagination->create_links();
    }
}