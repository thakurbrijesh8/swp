<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Factory_license_model extends CI_Model {

    // function get_all_factory_license_list() {
    //     $this->db->select('*');
    //     $this->db->where('is_delete !=', IS_DELETE);
    //     $this->db->from('factorylicence');
    //     $this->db->order_by('factorylicence_id', 'DESC');
    //     $resc = $this->db->get();
    //     return $resc->result_array();
    // }

    // function get_factory_license_by_id($factory_license_id) {
    //     $this->db->where('is_delete !=', IS_DELETE);
    //     $this->db->where('factorylicence_id', $factory_license_id);
    //     $this->db->from('factorylicence');
    //     $resc = $this->db->get();
    //     return $resc->row_array();
    // }

    // function insert_factory_license($factory_license_data) {
    //     $this->db->insert('factorylicence', $factory_license_data);
    //     return $this->db->insert_id();
    // }

    // function update_factory_license($factory_license_id, $factory_license_data) {
    //     $this->db->where('is_delete !=', IS_DELETE);
    //     $this->db->where('factorylicence_id', $factory_license_id);
    //     $this->db->update('factorylicence', $factory_license_data);
    // }

}

/*
 * EOF: ./application/models/Fb_model.php
 */