<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_business_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['business_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $success_array['business_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'business');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['business_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['business_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_business_data_by_id() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $business_id = get_from_post('business_id');
            if (!$business_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $business_data = $this->utility_model->get_by_id('business_id', $business_id, 'business');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($business_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['business_data'] = $business_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_zed() {
        $zed_data = array();
        $zed_data['udyam_number'] = get_from_post('udyam_number_for_zed');
        $zed_data['certificate_number'] = get_from_post('certificate_number_for_zed');
        $zed_data['captcha_code'] = get_from_post('captcha_code_for_zed');
        $zed_data['captcha_code_varification'] = get_from_post('captcha_code_varification_for_zed');
        return $zed_data;
    }

    function _check_validation_for_zed($zed_data) {
        if (!$zed_data['udyam_number']) {
            return UDYAM_NUMBER_MESSAGE;
        }
        if (!$zed_data['certificate_number']) {
            return ISO_CERTIFICATE_NO_MESSAGE;
        }
        if (!$zed_data['captcha_code'] || !$zed_data['captcha_code_varification']) {
            return CAPTCHA_VALIDATION_MESSAGE;
        }
        if ($zed_data['captcha_code'] != $zed_data['captcha_code_varification']) {
            return CAPTCHA_VERIFICATION_VALIDATION_MESSAGE;
        }
        return '';
    }

    function fetch_details_from_zed() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $zed_data = $this->_get_post_data_for_zed();
            $validation_message = $this->_check_validation_for_zed($zed_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            unset($zed_data['captcha_code']);
            unset($zed_data['captcha_code_varification']);
            $ex_data = $this->utility_model->get_by_id('user_id', $session_user_id, 'business', 'udyam_number', $zed_data['udyam_number'], 'certificate_number', $zed_data['certificate_number']);
            if (!empty($ex_data)) {
                echo json_encode(get_error_array(DETAILS_ALREADY_EXISTS_MESSAGE));
                return false;
            }
            $return_data = $this->_update_zed_data(VALUE_ONE, $session_user_id, $zed_data);
            if (!$return_data) {
                return false;
            }
            $api_data = $return_data['api_data'];
            $business_data = $return_data['business_data'];
            $business_data['created_by'] = $session_user_id;
            $business_data['created_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->insert_data('business', $business_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $api_data['zed_message'];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _insert_zed_log($api_data) {
        $api_data['end_datetime'] = date('Y-m-d H:i:s');
        return $this->utility_model->insert_data('zed_api', $api_data);
    }

    function _update_zed_data($m_type, $session_user_id, $zed_data) {
        $api_data = array();
        $api_data['user_id'] = $session_user_id;
        $api_data['udyam_number'] = $zed_data['udyam_number'];
        $api_data['certificate_number'] = $zed_data['certificate_number'];
        $api_data['start_datetime'] = date('Y-m-d H:i:s');
        $ch = curl_init(ZED_URL . '&udyamNumber=' . $zed_data['udyam_number'] . '&certificationNumber=' . $zed_data['certificate_number']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50000);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $api_data['zed_status'] = VALUE_FIVE;
            $error_msg = curl_error($ch);
            $this->_insert_zed_log($api_data);
            echo json_encode(get_error_array($error_msg));
            return false;
        }
        $zed_status_array = $this->config->item('zed_status_array');
        if (!$response || $response == null) {
            $api_data['zed_status'] = VALUE_SIX;
            $api_data['zed_message'] = $zed_status_array[$api_data['zed_status']];
            $this->_insert_zed_log($api_data);
            echo json_encode(get_error_array($api_data['zed_message']));
            return false;
        }
        if (!is_json($response)) {
            $api_data['zed_status'] = VALUE_SEVEN;
            $api_data['zed_message'] = $zed_status_array[$api_data['zed_status']];
            $this->_insert_zed_log($api_data);
            echo json_encode(get_error_array($zed_status_array[VALUE_SIX]));
            return false;
        }
        $res_data = json_decode($response, true);
        if (empty($res_data)) {
            $api_data['zed_status'] = VALUE_EIGHT;
            $api_data['zed_message'] = $zed_status_array[$api_data['zed_status']];
            $this->_insert_zed_log($api_data);
            echo json_encode(get_error_array($zed_status_array[VALUE_SIX]));
            return false;
        }
        $zed_sc_array = $this->config->item('zed_status_code_array');
        if (!isset($zed_sc_array[$res_data['StatusCode']])) {
            $api_data['zed_status'] = VALUE_NINE;
            $api_data['zed_message'] = $zed_status_array[$api_data['zed_status']];
            $this->_insert_zed_log($api_data);
            echo json_encode(get_error_array($zed_status_array[VALUE_SIX]));
            return false;
        }
        $api_data['zed_status'] = $zed_sc_array[$res_data['StatusCode']];
        $api_data['zed_message'] = $zed_status_array[$api_data['zed_status']];
        $api_data['zed_response'] = $response;
        $zed_api_id = $this->_insert_zed_log($api_data);
        if ($api_data['zed_status'] != VALUE_ONE) {
            $success_array = get_success_array();
            $success_array['message'] = $api_data['zed_message'];
            echo json_encode($success_array);
            return false;
        }
        $business_data = array();
        if ($m_type == VALUE_ONE) {
            $business_data['user_id'] = $session_user_id;
            $business_data['udyam_number'] = $zed_data['udyam_number'];
            $business_data['certificate_number'] = $zed_data['certificate_number'];
        }
        $business_data['zed_api_id'] = $zed_api_id;
        $business_data['unit_name'] = isset($res_data['PlantDetails']['UnitName']) ? $res_data['PlantDetails']['UnitName'] : '';
        $business_data['unit_address'] = isset($res_data['PlantDetails']['PAddress']) ? $res_data['PlantDetails']['PAddress'] : '';
        $business_data['unit_pin'] = isset($res_data['PlantDetails']['PPin']) ? $res_data['PlantDetails']['PPin'] : '';
        $business_data['state_name'] = isset($res_data['PlantDetails']['state_name']) ? $res_data['PlantDetails']['state_name'] : '';
        $business_data['district_name'] = isset($res_data['PlantDetails']['DISTRICT_NAME']) ? $res_data['PlantDetails']['DISTRICT_NAME'] : '';
        $business_data['district_code'] = isset($res_data['PlantDetails']['LG_DT_Code']) ? $res_data['PlantDetails']['LG_DT_Code'] : '';
        $business_data['certification_date'] = isset($res_data['CertificationDetails']['CertificationDate']) ? $res_data['CertificationDetails']['CertificationDate'] : '';
        $business_data['expiry_date'] = isset($res_data['CertificationDetails']['ExpiryDate']) ? $res_data['CertificationDetails']['ExpiryDate'] : '';
        $business_data['is_bronze_certified'] = isset($res_data['CertificationDetails']['BronzeCertified']) ? $res_data['CertificationDetails']['BronzeCertified'] : '';
        $business_data['is_silver_certified'] = isset($res_data['CertificationDetails']['SilverCertified']) ? $res_data['CertificationDetails']['SilverCertified'] : '';
        $business_data['is_gold_certified'] = isset($res_data['CertificationDetails']['GoldCertified']) ? $res_data['CertificationDetails']['GoldCertified'] : '';
        $business_data['certification_fees'] = isset($res_data['CertificationDetails']['CertificationFee']) ? $res_data['CertificationDetails']['CertificationFee'] : '';
        $business_data['subsidy_amount'] = isset($res_data['CertificationDetails']['SubsidyAmount']) ? $res_data['CertificationDetails']['SubsidyAmount'] : '';
        $business_data['amount_paid'] = isset($res_data['CertificationDetails']['AmountPaid']) ? $res_data['CertificationDetails']['AmountPaid'] : '';
        return array('api_data' => $api_data, 'business_data' => $business_data);
    }

    function re_fetch_details_from_zed() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $business_id = get_from_post('business_id');
            if (!$business_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $zed_data = $this->utility_model->get_by_id('business_id', $business_id, 'business');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($zed_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $return_data = $this->_update_zed_data(VALUE_TWO, $session_user_id, $zed_data);
            if (!$return_data) {
                return false;
            }
            $api_data = $return_data['api_data'];
            $business_data = $return_data['business_data'];
            $business_data['updated_by'] = $session_user_id;
            $business_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('business_id', $business_id, 'business', $business_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $business_data['business_id'] = $business_id;
            $business_data['udyam_number'] = $zed_data['udyam_number'];
            $business_data['certificate_number'] = $zed_data['certificate_number'];
            $success_array = get_success_array();
            $success_array['message'] = $api_data['zed_message'];
            $success_array['business_data'] = $business_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Business.php
 */
