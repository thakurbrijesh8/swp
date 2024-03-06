<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_status extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
        $this->load->model('payment_model');
    }

    function payment_failed() {
        if (!is_post()) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $enc_data = $this->input->post('encData');
        $mid = $this->input->post('merchIdVal');
        $bank_code = $this->input->post('Bank_Code');
        if (!$enc_data || !$mid || ($mid != PG_MID)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $iv = $this->payment_lib->generate_iv();
        $decrypted_string = $this->payment_lib->decrypt(PG_KEY, $enc_data, $iv);
        if (!$decrypted_string) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $return_data = explode('|', $decrypted_string);
        if (empty($return_data)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $status = isset($return_data[2]) ? $return_data[2] : '';
        if ($status != 'FAIL' && $status != 'PENDING') {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $tod = isset($return_data[0]) ? $return_data[0] : '';
        if (!$tod) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $temp_od = explode('-', $tod);
        if (empty($temp_od)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        if (count($temp_od) != VALUE_TWO || (!isset($temp_od[0]) || !isset($temp_od[1]))) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $reference_key = $temp_od[1];
        $this->db->trans_start();
        $module_data = $this->utility_model->get_by_id('reference_number', $reference_key, 'fees_payment');
        if (empty($module_data)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        if ($module_data['op_status'] != VALUE_ONE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $module_type = $module_data['module_type'];
        $module_id = $module_data['module_id'];
        $district = $module_data['district'];
        $fp = array();
        $fp['reference_id'] = isset($return_data[12]) ? $return_data[12] : '';
        $fp['op_status'] = ($status == 'FAIL' || $status == 'ABORT' || $status == 'REFUND' || $status == 'EXPIRED') ? VALUE_THREE : ($status == 'PENDING' ? VALUE_FOUR : ($status == 'BOOKED' ? VALUE_FIVE : ($status == 'INPROGRESS' ? VALUE_SIX : VALUE_THREE)));
        $fp['op_og_status'] = $fp['op_status'];
        $fp['op_return'] = $enc_data;
        $fp['op_message'] = isset($return_data[7]) ? $return_data[7] : '';
        $fp['op_og_message'] = $fp['op_message'];
        $fp['op_end_datetime'] = date('Y-m-d H:i:s');
        $fp['op_bank_code'] = isset($return_data[8]) ? $return_data[8] : '';
        $fp['op_bank_reference_number'] = isset($return_data[9]) ? $return_data[9] : '';
        $fp['op_transaction_datetime'] = isset($return_data[10]) ? $return_data[10] : '';
        $fp['op_mid'] = $mid;
        $this->utility_model->update_data('fees_payment_id', $module_data['fees_payment_id'], 'fees_payment', $fp);

        $ex_udata = $this->payment_model->get_username_for_pg($module_data['user_id']);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $redirect_data = array();
        $redirect_data['reference_key'] = $reference_key;
        $redirect_data['module_type'] = get_encrypt_id($module_type);
        $redirect_data['module_id'] = get_encrypt_id($module_id);
        $redirect_data['district'] = get_encrypt_id($district);
        $redirect_data['module_status'] = get_encrypt_id(VALUE_THREE);
        $redirect_data['redirect_url'] = 'd=' . $redirect_data['district'] . '&mt=' . $redirect_data['module_type'] . '&ms=' . $redirect_data['module_status'] . '&mi=' . $redirect_data['module_id'];
        $redirect_data['pg_status'] = $fp['op_status'];
        if ($fp['op_status'] == VALUE_THREE) {
            $redirect_data['pg_title'] = 'Your Transaction has Failed !';
            $redirect_data['pg_class'] = 'text-danger';
            $redirect_data['pg_icon'] = 'times-circle-o';
            $redirect_data['pg_message'] = 'If your funds were debited, it will be refunded in 5-7 business days.';
        }
        if ($fp['op_status'] == VALUE_FOUR || $fp['op_status'] == VALUE_FIVE || $fp['op_status'] == VALUE_SIX) {
            $redirect_data['pg_title'] = 'Your Transaction is Pending for Authorization !';
            $redirect_data['pg_class'] = 'text-warning';
            $redirect_data['pg_icon'] = 'clock-o';
            $redirect_data['pg_message'] = 'Response Pending From Bank !<br>Please wait a 30 Minute !';
        }
        $this->load->view('payment/redirect', $redirect_data);
        if (!empty($ex_udata)) {
            $session_data = array();
            $session_data['temp_id_for_eodbsws'] = $ex_udata['user_id'];
            $session_data['name'] = ucwords($ex_udata['applicant_name']);
            $session_data['temp_logged'] = encrypt($ex_udata['logs_login_details_id']);
            $this->session->set_userdata($session_data);
        }
    }

    function payment_success() {
        if (!is_post()) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $enc_data = $this->input->post('encData');
        $mid = $this->input->post('merchIdVal');
        $bank_code = $this->input->post('Bank_Code');
        if (!$enc_data || !$bank_code || !$mid || ($mid != PG_MID)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $iv = $this->payment_lib->generate_iv();
        $decrypted_string = $this->payment_lib->decrypt(PG_KEY, $enc_data, $iv);
        if (!$decrypted_string) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $return_data = explode('|', $decrypted_string);
        if (empty($return_data)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $status = isset($return_data[2]) ? $return_data[2] : '';
        if ($status != 'SUCCESS') {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $tod = isset($return_data[0]) ? $return_data[0] : '';
        if (!$tod) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $temp_od = explode('-', $tod);
        if (empty($temp_od)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        if (count($temp_od) != VALUE_TWO || (!isset($temp_od[0]) || !isset($temp_od[1]))) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $reference_key = $temp_od[1];
        $this->db->trans_start();
        $module_data = $this->utility_model->get_by_id('reference_number', $reference_key, 'fees_payment');
        if (empty($module_data)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $module_type = $module_data['module_type'];
        $module_id = $module_data['module_id'];
        $district = $module_data['district'];
        if ($module_data['op_status'] != VALUE_ONE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $fp = array();
        $fp['reference_id'] = isset($return_data[12]) ? $return_data[12] : '';
        $fp['op_status'] = VALUE_TWO;
        $fp['op_og_status'] = $fp['op_status'];
        $fp['op_return'] = $enc_data;
        $fp['op_message'] = isset($return_data[7]) ? $return_data[7] : '';
        $fp['op_og_message'] = $fp['op_message'];
        $fp['op_end_datetime'] = date('Y-m-d H:i:s');
        $fp['op_bank_code'] = isset($return_data[8]) ? $return_data[8] : '';
        $fp['op_bank_reference_number'] = isset($return_data[9]) ? $return_data[9] : '';
        $fp['op_transaction_datetime'] = isset($return_data[10]) ? $return_data[10] : '';
        $fp['op_mid'] = $mid;
        $this->utility_model->update_data('fees_payment_id', $module_data['fees_payment_id'], 'fees_payment', $fp);

        $qm_array = $this->config->item('query_module_array');
        if (isset($qm_array[$module_type])) {
            $temp_access_data = $qm_array[$module_type];
            if (!empty($temp_access_data)) {
                $ms_array = array();
                $ms_array['status'] = VALUE_FOUR;
                $this->utility_model->update_data($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text'], $ms_array, 'last_op_reference_number', $reference_key);
            }
        }

        $ex_udata = $this->payment_model->get_username_for_pg($module_data['user_id']);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $redirect_data = array();
        $redirect_data['reference_key'] = $reference_key;
        $redirect_data['module_type'] = get_encrypt_id($module_type);
        $redirect_data['module_id'] = get_encrypt_id($module_id);
        $redirect_data['district'] = get_encrypt_id($district);
        $redirect_data['module_status'] = get_encrypt_id(VALUE_FOUR);
        $redirect_data['redirect_url'] = 'd=' . $redirect_data['district'] . '&mt=' . $redirect_data['module_type'] . '&ms=' . $redirect_data['module_status'] . '&mi=' . $redirect_data['module_id'];
        $redirect_data['pg_status'] = $fp['op_status'];
        $redirect_data['pg_title'] = 'Your Transaction is Successfully Completed !';
        $redirect_data['pg_class'] = 'text-success';
        $redirect_data['pg_icon'] = 'check-circle-o';
        $redirect_data['pg_message'] = 'Transaction Reference Number is : <b>' . $fp['reference_id'] . '<b>';
        $this->load->view('payment/redirect', $redirect_data);

        if (!empty($ex_udata)) {
            $session_data = array();
            $session_data['temp_id_for_eodbsws'] = $ex_udata['user_id'];
            $session_data['name'] = ucwords($ex_udata['applicant_name']);
            $session_data['temp_logged'] = encrypt($ex_udata['logs_login_details_id']);
            $this->session->set_userdata($session_data);
        }
    }

    function check_payment_dv() {
        $m_type = get_from_post('m_type');
        if ($m_type != VALUE_ONE) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        $session_user_id = $session_user_id ? $session_user_id : VALUE_ZERO;
        if ($m_type == VALUE_ONE) {
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
        }
        $fees_payment_id = get_from_post('fees_payment_id');
        if (!$fees_payment_id || $fees_payment_id == NULL) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_start();
        $check_payment_fp = $this->utility_model->get_by_id('fees_payment_id', $fees_payment_id, 'fees_payment');
        if (empty($check_payment_fp)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        if ($check_payment_fp['op_order_number'] == '') {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $module_type_array = $this->config->item('query_module_array');
        if (!isset($module_type_array[$check_payment_fp['module_type']])) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $temp_access_data = $module_type_array[$check_payment_fp['module_type']];
        if (empty($temp_access_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $module_data = $this->utility_model->get_by_id($temp_access_data['key_id_text'], $check_payment_fp['module_id'], $temp_access_data['tbl_text']);
        if (empty($module_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }

        $dv_data = array();
        $update_fp = false;
        $fp_update = array();
        $md_update = array();
        $this->payment_lib->cp_dv($dv_data, $update_fp, $fp_update, $md_update, $session_user_id, VALUE_TWO, $fees_payment_id, $check_payment_fp, $module_data, $temp_access_data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return false;
        }
        $success_array = get_success_array();
        $dv_data['entered_by'] = get_from_session('name');
        $success_array['dv_data'] = $dv_data;
        $success_array['message'] = PG_PS_UPDATED_TA_MESSAGE;
        $success_array['module_type'] = $check_payment_fp['module_type'];
        $success_array['module_id'] = $check_payment_fp['module_id'];
        if ($update_fp) {
            $success_array['is_updated_fp'] = $update_fp;
            $success_array['updated_op_status'] = isset($fp_update['op_status']) ? $fp_update['op_status'] : '';
            $success_array['updated_status'] = isset($md_update['status']) ? $md_update['status'] : '';
            if ($success_array['updated_op_status'] == VALUE_TWO || $success_array['updated_op_status'] == VALUE_THREE) {
                $success_array['message'] = PG_PS_UPDATED_MESSAGE;
            }
        }
        echo json_encode($success_array);
    }
}
