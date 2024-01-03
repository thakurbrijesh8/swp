<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Query_grievance_model extends CI_Model {

    function get_query_grievance_status_wise_count($module_name) {
        $this->db->from('view_get_status_wise_' . $module_name . '_count');
        $resc = $this->db->get();
        return $resc->result_array();
    }
    function get_query_grievance_min_time($module_name, $industry_classification) {
     	$this->db->where('industry_classification',$industry_classification);
        $this->db->from('view_get_status_wise_' . $module_name . '_count');
        $this->db->order_by('processing_days','ASC');
        $query = $this->db->get();
		return $query->row();
    }
    function get_query_grievance_max_time($module_name, $industry_classification) {
     	$this->db->where('industry_classification',$industry_classification);
        $this->db->from('view_get_status_wise_' . $module_name . '_count');
        $this->db->order_by('processing_days','DESC');
        $query = $this->db->get();
		return $query->row();
    }

}

/*
 * EOF: ./application/models/Dashboard_model.php
 */