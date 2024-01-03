<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Boiler_manufacture_model extends CI_Model {

    function get_all_boiler_manufacture_list() {
        $this->db->select('*');
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where('status !=' . VALUE_ONE);
        $this->db->from('boilermanufacture');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_boiler_manufacture_by_id($boiler_manufacture_id) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where('boilermanufacture_id', $boiler_manufacture_id);
        $this->db->from('boilermanufacture');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function insert_boiler_manufacture($boiler_manufacture_data) {
        $this->db->insert('boilermanufacture', $boiler_manufacture_data);
        return $this->db->insert_id();
    }

    function update_boiler_manufacture($boiler_manufacture_id, $boiler_manufacture_data) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where('boilermanufacture_id', $boiler_manufacture_id);
        $this->db->update('boilermanufacture', $boiler_manufacture_data);
    }

}

/*
 * EOF: ./application/models/Fb_model.php
 */