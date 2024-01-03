<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shop_renewal_model extends CI_Model {

    function get_result_data_by_id_shop_renewal($id_text, $id, $table_name, $id_text2 = NULL, $id2 = NULL) {
        $this->db->where($id_text, $id);
        if ($id_text2 != NULL && $id2 != NULL) {
            $this->db->where($id_text2, $id2);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('status =' . VALUE_FIVE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Shop_renewal_model.php
 */