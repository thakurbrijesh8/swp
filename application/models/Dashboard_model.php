<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function get_status_wise_count($module_name) {
        $this->db->from('view_get_status_wise_' . $module_name . '_count');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_ds_wise_count($session_user_id, $module_name) {
        $this->db->where('user_id', $session_user_id);
        $this->db->from('view_get_ds_wise_' . $module_name . '_count');
        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Dashboard_model.php
 */