<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bocw_model extends CI_Model {

    // function get_all_bocw_list() {
    //     $this->db->select('*');
    //     $this->db->where('is_delete !=', IS_DELETE);
    //     $this->db->from('bocw');
    //     $this->db->order_by('bocw_id', 'DESC');
    //     $resc = $this->db->get();
    //     return $resc->result_array();
    // }

    // function get_bocw_by_id($bocw_id) {
    //     $this->db->where('is_delete !=', IS_DELETE);
    //     $this->db->where('bocw_id', $bocw_id);
    //     $this->db->from('bocw');
    //     $resc = $this->db->get();
    //     return $resc->row_array();
    // }

    // function insert_bocw($bocw_data) {
    //     $this->db->insert('bocw', $bocw_data);
    //     return $this->db->insert_id();
    // }

    // function update_bocw($bocw_id, $bocw_data) {
    //     $this->db->where('is_delete !=', IS_DELETE);
    //     $this->db->where('bocw_id', $bocw_id);
    //     $this->db->update('bocw', $bocw_data);
    // }

}

/*
 * EOF: ./application/models/BOCW_model.php
 */