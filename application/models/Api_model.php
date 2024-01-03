<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_model extends CI_Model {

    function get_records_for_update_processing_days($table_name, $status_array) {
        $this->db->where('is_delete != ' . IS_DELETE);
        $this->db->where_in('status', $status_array);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Api_model.php
 */