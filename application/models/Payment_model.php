<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model {

    function get_username_for_pg($user_id) {
        $this->db->select('lld.logs_login_details_id, u.user_id, u.applicant_name');
        $this->db->where('lld.user_id', $user_id);
        $this->db->where('lld.logout_timestamp', 0);
        $this->db->where('u.is_active', IS_ACTIVE);
        $this->db->where('u.is_delete !=' . IS_DELETE);
        $this->db->from('logs_login_details AS lld');
        $this->db->join('users AS u', 'u.user_id = lld.user_id');
        $this->db->order_by('lld.logs_login_details_id', 'DESC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_payment_history($user_id, $module_type = 0, $module_id = 0) {
        $this->db->select('fees_payment_id, op_order_number, reference_id, district, module_type, module_id, total_fees, op_status, '
                . 'op_start_datetime, reference_number, op_transaction_datetime, op_bank_code, op_bank_reference_number, op_message');
        $this->db->where('user_id', $user_id);
        if ($module_type != 0) {
            $this->db->where('module_type', $module_type);
        }
        if ($module_id != 0) {
            $this->db->where('module_id', $module_id);
        }
        $this->db->from('fees_payment');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->order_by('fees_payment_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_pending_dv_data($session_user_id) {
        $this->db->where('is_auto_dv_done', VALUE_ZERO);
        $this->db->where_in('op_status', array(VALUE_ONE, VALUE_FOUR, VALUE_FIVE, VALUE_SIX));
        $this->db->where('user_id', $session_user_id);
        $this->db->from('fees_payment');
        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Payment_model.php
 */