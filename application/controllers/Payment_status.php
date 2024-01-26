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
        $fp['op_status'] = $status == 'FAIL' ? VALUE_THREE : ($status == 'PENDING' ? VALUE_FOUR : VALUE_THREE);
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
            $redirect_data['pg_title'] = 'Your Transaction is Failed !';
            $redirect_data['pg_class'] = 'text-danger';
            $redirect_data['pg_icon'] = 'times-circle-o';
            $redirect_data['pg_message'] = 'If your funds were debited, they will be refunded in 5-7 business days.';
        }
        if ($fp['op_status'] == VALUE_FOUR) {
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
        $redirect_data['pg_message'] = 'Transaction Reference Number is : ' . $fp['reference_id'];
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
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        $fees_payment_id = get_from_post('fees_payment_id');
        if ($session_user_id == NULL || !$session_user_id || !$fees_payment_id || $fees_payment_id == NULL) {
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

        $update_fp = false;
        $dv_data = array();
        $dv_data['dv_type'] = VALUE_TWO;
        $dv_data['fees_payment_id'] = $fees_payment_id;
        $dv_data['dv_start_datetime'] = date('Y-m-d H:i:s');
        $dv_data['created_by'] = $session_user_id;
        $dv_data['created_time'] = $dv_data['dv_start_datetime'];
        $dv_data['dv_status'] = VALUE_ONE;

        $dv_request_params = "|" . PG_MID . "|" . $check_payment_fp['op_order_number'] . "|" . $check_payment_fp['total_fees'];
        $query_request = http_build_query(array('queryRequest' => $dv_request_params, "aggregatorId" => PG_AGG_ID, "merchantId" => PG_MID));

        $ch = curl_init(PG_DV_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_request);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $dv_data['dv_status'] = VALUE_THREE;
            $dv_data['dv_message'] = curl_error($ch);
        }
        if ($dv_data['dv_status'] == VALUE_ONE) {
            $dv_data['dv_status'] = VALUE_THREE;
            $dv_data['dv_message'] = RES_NOT_REC_MESSAGE;
            if ($response) {
                $return_data = explode('|', $response);
                if (!empty($return_data)) {
                    $status = isset($return_data[2]) ? $return_data[2] : '';
                    if ($status == 'FAIL' || $status == 'ABORT' || $status == 'PENDING' || $status == 'BOOKED' || $status == 'INPROGRESS' || $status == 'SUCCESS' || $status == 'REFUND' || $status == 'No Records Found' || $status == 'EXPIRED') {
                        $dv_data['dv_status'] = VALUE_TWO;
                        $dv_data['dv_return'] = $response;
                        $dv_data['dv_reference_id'] = isset($return_data[1]) ? $return_data[1] : '';
                        $dv_data['dv_pg_status'] = ($status == 'FAIL' || $status == 'ABORT' || $status == 'REFUND' || $status == 'No Records Found' || $status == 'EXPIRED') ? VALUE_THREE : ($status == 'PENDING' ? VALUE_FOUR : ($status == 'BOOKED' ? VALUE_FIVE : ($status == 'INPROGRESS' ? VALUE_SIX : ($status == 'SUCCESS' ? VALUE_TWO : VALUE_THREE))));
                        $dv_data['dv_order_number'] = isset($return_data[6]) ? $return_data[6] : '';
                        $dv_data['dv_amount'] = isset($return_data[7]) ? $return_data[7] : '';
                        $dv_data['dv_message'] = isset($return_data[8]) ? $return_data[8] : '';
                        $dv_data['dv_bank_code'] = isset($return_data[9]) ? $return_data[9] : '';
                        $dv_data['dv_bank_ref_number'] = isset($return_data[10]) ? $return_data[10] : '';
                        $update_fp = true;
                    }
                }
            }
        }
        $dv_data['dv_end_datetime'] = date('Y-m-d H:i:s');
        $fp_dv_id = $this->utility_model->insert_data('fees_payment_dv', $dv_data);
        $fp_update = array();
        if ($update_fp) {
            $update_fp = false;
            $this->_update_fp_data_status($fp_update, $fp_dv_id, $dv_data, $check_payment_fp, $update_fp, $fees_payment_id);
        }
        $md_update = array();
        if ($update_fp) {
            $this->_update_module_data_status($md_update, $module_data, $fp_update, $temp_access_data, $check_payment_fp);
        }

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
            $success_array['updated_op_message'] = isset($fp_update['op_message']) ? $fp_update['op_message'] : '';
            $success_array['updated_status'] = isset($md_update['status']) ? $md_update['status'] : '';
            if ($success_array['updated_op_status'] == VALUE_TWO || $success_array['updated_op_status'] == VALUE_THREE) {
                $success_array['message'] = PG_PS_UPDATED_MESSAGE;
            }
        }
        echo json_encode($success_array);
    }

    function _update_fp_data_status(&$fp_update, $fp_dv_id, $dv_data, $check_payment_fp, & $update_fp, $fees_payment_id) {
        $fp_update = array();
        $fp_update['fees_payment_dv_id'] = $fp_dv_id;
        if ($dv_data['dv_pg_status'] == VALUE_TWO || $dv_data['dv_pg_status'] == VALUE_THREE || $dv_data['dv_pg_status'] == VALUE_FOUR || $dv_data['dv_pg_status'] == VALUE_FIVE || $dv_data['dv_pg_status'] == VALUE_SIX) {
            if ($check_payment_fp['is_auto_dv_done'] == VALUE_ZERO) {
                $fp_update['is_auto_dv_done'] = VALUE_ONE;
            }
            if ($check_payment_fp['op_status'] != $dv_data['dv_pg_status']) {
                $fp_update['op_status'] = $dv_data['dv_pg_status'];
                $fp_update['op_message'] = $dv_data['dv_message'];
                $update_fp = true;
            }
        }
        $this->utility_model->update_data('fees_payment_id', $fees_payment_id, 'fees_payment', $fp_update);
    }

    function _update_module_data_status(&$md_update, $module_data, $fp_update, $temp_access_data, $check_payment_fp) {
        if ($module_data['status'] == VALUE_THREE && $fp_update['op_status'] == VALUE_TWO) {
            $md_update = array();
            $md_update['status'] = VALUE_FOUR;
            if ($module_data['user_payment_type'] != VALUE_THREE) {
                $md_update['user_payment_type'] = VALUE_THREE;
            }
            $this->utility_model->update_data($temp_access_data['key_id_text'], $check_payment_fp['module_id'], $temp_access_data['tbl_text'], $md_update);
        }
    }
}
