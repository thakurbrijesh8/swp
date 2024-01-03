<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Migrantworkers_model extends CI_Model {

    function get_migrantworkers_under_all_contractor($user_id, $mw_id) {
        $this->db->select('*, DATE_FORMAT(mc_date_of_commencement, "%d-%m-%Y") as mc_date_of_commencement, DATE_FORMAT(mc_date_of_termination, "%d-%m-%Y") as mc_date_of_termination');
        $this->db->where('mw_id', $mw_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('migrantcontractors');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function delete_multiple_contractor($mw_id, $ids, $is_delete_data) {
        $this->db->where_not_in('mc_id', $ids);
        $this->db->where('mw_id', $mw_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->update('migrantcontractors', $is_delete_data);
    }

}

/*
* EOF: ./application/models/Contractor_model.php
*/