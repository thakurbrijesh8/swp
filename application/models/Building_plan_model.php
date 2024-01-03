<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Building_plan_model extends CI_Model {

    function get_all_building_plan_list() {
        $this->db->select('*');
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->from('buildingplan');
        $this->db->order_by('buildingplan_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_building_plan_by_id($building_plan_id) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where('buildingplan_id', $building_plan_id);
        $this->db->from('buildingplan');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function insert_building_plan($building_plan_data) {
        $this->db->insert('buildingplan', $building_plan_data);
        return $this->db->insert_id();
    }

    function update_building_plan($building_plan_id, $building_plan_data) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where('buildingplan_id', $building_plan_id);
        $this->db->update('buildingplan', $building_plan_data);
    }

}

/*
 * EOF: ./application/models/Fb_model.php
 */