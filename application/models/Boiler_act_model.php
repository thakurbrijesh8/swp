<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Boiler_act_model extends CI_Model {

    function get_all_boiler_act_list() {
        $this->db->select('*');
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->from('boileract');
        $this->db->order_by('boiler_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_boiler_act_by_id($boiler_act_id) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where('boiler_id', $boiler_act_id);
        $this->db->from('boileract');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function insert_boiler_act($boiler_act_data) {
        $this->db->insert('boileract', $boiler_act_data);
        return $this->db->insert_id();
    }

    function update_boiler_act($boiler_act_id, $boiler_act_data) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where('boiler_id', $boiler_act_id);
        $this->db->update('boileract', $boiler_act_data);
    }

}

/*
 * EOF: ./application/models/Fb_model.php
 */