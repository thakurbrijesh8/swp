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

    function get_pan_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['pan_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $success_array['pan_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'pan');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['pan_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['pan_data'] = array();
            echo json_encode($success_array);
        }
    }

    function _get_post_data_for_pan() {
        $pan_data = array();
        $pan_data['pan_number'] = get_from_post('pan_number_for_pan');
        $pan_data['name'] = get_from_post('name_for_pan');
        $pan_data['father_name'] = get_from_post('father_name_for_pan');
        $pan_data['dob'] = get_from_post('dob_for_pan');
        $pan_data['captcha_code'] = get_from_post('captcha_code_for_pan');
        $pan_data['captcha_code_varification'] = get_from_post('captcha_code_varification_for_pan');
        return $pan_data;
    }

    function _check_validation_for_pan($pan_data) {
        if (!$pan_data['pan_number']) {
            return PAN_NO_MESSAGE;
        }
        if (!$pan_data['captcha_code'] || !$pan_data['captcha_code_varification']) {
            return CAPTCHA_VALIDATION_MESSAGE;
        }
        if ($pan_data['captcha_code'] != $pan_data['captcha_code_varification']) {
            return CAPTCHA_VERIFICATION_VALIDATION_MESSAGE;
        }
        return '';
    }

    // Test Code
//    function test_pan_with_pfx_file() {
//        if (!file_exists(PAN_PFX_FILE_PATH)) {
//            die('PFX file does not exist.');
//        }
//
//        $pfxData = file_get_contents(PAN_PFX_FILE_PATH);
//        if ($pfxData === false) {
//            die('Could not read PFX file.');
//        }
//
//        echo OPENSSL_VERSION_TEXT . '<br>';
//
//        // Step 1: Extract the private key and certificate from the .pfx file
//        $certs = [];
//        if (!openssl_pkcs12_read($pfxData, $certs, PAN_PFX_PASSWORD)) {
//            $error = openssl_error_string();
//            die('Failed to read PFX file: ' . $error);
//        }
//
//        // Step 2: Get the private key
//        $privateKey = openssl_pkey_get_private($certs['pkey']);
//        if (!$privateKey) {
//            die('Unable to extract private key from PFX. Ensure the PFX contains a private key.');
//        }
//        $t_a = array();
//        array_push($t_a, array('pan' => 'AAAAL6704B', 'name' => 'SAMUDRA INDUSTRIES LIMITED.', 'fathername' => '',
//            'dob' => '15/08/1993'));
//        $inputData = json_encode($t_a); // The data to sign
//        echo '<pre>';
//        print_r($t_a) . '<br>';
//        $signature = '';
//        // Step 3: Create a signature
//        if (openssl_sign($inputData, $signature, $privateKey, OPENSSL_ALGO_SHA256) === false) {
//            die('Unable to sign data. Error: ' . openssl_error_string());
//        }
//
//        // Step 4: Encode signature in base64 for easy transmission
//        $encodedSignature = base64_encode($signature);
//
//        // Step 5: Create the request with the signature
//        $request = [
//            "data" => $inputData,
//            "signature" => $encodedSignature,
//            "certificate" => base64_encode($certs['cert']) // Optionally include the certificate
//        ];
//
//        // Step 6: Send the request (for demonstration, we will just print it)
////        echo json_encode($request);
//        
//        print_r($request);
//
//        // Free the private key from memory
//        openssl_free_key($privateKey);
//    }

    function _get_signature_for_pan_data($input_data) {
        if (!file_exists(PAN_PFX_FILE_PATH)) {
            return array('success' => false, 'message' => PFX_NOT_MESSAGE);
        }
        $pfxData = file_get_contents(PAN_PFX_FILE_PATH);
        if ($pfxData === false) {
            return array('success' => false, 'message' => NOT_READ_PFX_MESSAGE);
        }
        $certs = [];
        if (!openssl_pkcs12_read($pfxData, $certs, PAN_PFX_PASSWORD)) {
            return array('success' => false, 'message' => NOT_READ_PFX_MESSAGE . '<br>' . openssl_error_string());
        }
        $privateKey = openssl_pkey_get_private($certs['pkey']);
        if (!$privateKey) {
            return array('success' => false, 'message' => PFX_NOT_PK_MESSAGE);
        }
        $signature = '';
        if (openssl_sign($input_data, $signature, $privateKey, OPENSSL_ALGO_SHA256) === false) {
            return array('success' => false, 'message' => UNABLE_SIGN_MESSAGE . '<br>' . openssl_error_string());
        }
//        if (!$signature) {
//            return array('success' => false, 'message' => UNABLE_SIGN_MESSAGE);
//        }
        return array('success' => true, 'pan_data' => $input_data, 'signature' => base64_encode($signature));
    }

    function _insert_pan_log($api_data) {
        $api_data['response_time'] = date('Y-m-d H:i:s');
        return $this->utility_model->insert_data('pan_api', $api_data);
    }

    function _update_pan_data($session_user_id, $pan_sign, $pan_api_rc_array, $is_test = VALUE_ZERO) {
        $api_data = array();
        $api_data['user_id'] = $session_user_id;
        $api_data['h_records_counts'] = count($pan_sign['pan_data']);
        $api_data['h_request_time'] = date('Y-m-d\TH:i:s');
        $api_data['h_transaction_id'] = PAN_USER_ID . ':' . time() . generate_token(5);
        $api_data['h_version'] = PAN_API_VERSION;
        $api_data['p_pan_data'] = json_encode($pan_sign['pan_data']);
        $api_data['p_signature'] = $pan_sign['signature'];
        $ch = curl_init(PAN_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50000);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $headers = array(
            'User_ID: ' . PAN_USER_ID,
            'Records_count: ' . $api_data['h_records_counts'],
            'Request_time: ' . $api_data['h_request_time'],
            'Transaction_ID: ' . $api_data['h_transaction_id'],
            'Version: ' . $api_data['h_version']
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($is_test == VALUE_ONE) {
//        $f = fopen('request.txt', 'w');
//        curl_setopt($ch, CURLOPT_VERBOSE, true);
//        curl_setopt($ch, CURLOPT_STDERR, $f);
        }

        $post_data = array('inputData' => json_decode($pan_sign['pan_data'], true), 'signature' => $pan_sign['signature']);
        if ($is_test == VALUE_ONE) {
            echo '<pre>';
            echo 'Headers : <br>';
            print_r($headers);
            echo '<br>Post Data in Array : <br>';
            print_r($post_data);
            echo '<br>Post Data in JSON : ' . json_encode($post_data) . '<br><br>';
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(json_encode($post_data)));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            $api_data['api_status'] = VALUE_TWO;
            $api_data['api_message'] = $error_msg;
            $this->_insert_pan_log($api_data);
            return array('success' => false, 'message' => $error_msg);
        }
        $pan_api_s_array = $this->config->item('pan_api_status_array');
        if (!$response || $response == null) {
            $api_data['api_status'] = VALUE_THREE;
            $api_data['api_message'] = $pan_api_s_array[$api_data['api_status']];
            $this->_insert_pan_log($api_data);
            return array('success' => false, 'message' => $api_data['api_message']);
        }
        if (!is_json($response)) {
            $api_data['api_status'] = VALUE_FOUR;
            $api_data['api_message'] = $pan_api_s_array[$api_data['api_status']];
            $this->_insert_pan_log($api_data);
            return array('success' => false, 'message' => $api_data['api_message']);
        }
        $res_data = json_decode($response, true);
        if (empty($res_data)) {
            $api_data['api_status'] = VALUE_FIVE;
            $api_data['api_message'] = $pan_api_s_array[$api_data['api_status']];
            $this->_insert_pan_log($api_data);
            return array('success' => false, 'message' => $api_data['api_message']);
        }
        if (!isset($pan_api_rc_array[$res_data['response_Code']])) {
            $api_data['api_status'] = VALUE_SIX;
            $api_data['api_message'] = $pan_api_s_array[$api_data['api_status']];
            $this->_insert_pan_log($api_data);
            return array('success' => false, 'message' => $api_data['api_message']);
        }
        if ($api_data['response_code'] != VALUE_ONE) {
            $api_data['api_status'] = VALUE_SEVEN;
            $api_data['api_message'] = $pan_api_rc_array[$res_data['response_Code']];
            $this->_insert_pan_log($api_data);
            return array('success' => false, 'message' => $api_data['api_message']);
        }
        if (empty($response['outputData']) || !$response['outputData']) {
            $api_data['api_status'] = VALUE_EIGHT;
            $api_data['api_message'] = $pan_api_s_array[$api_data['api_status']];
            $this->_insert_pan_log($api_data);
            return array('success' => false, 'message' => $api_data['api_message']);
        }
        $api_data['api_status'] = VALUE_ONE;
        $api_data['response_code'] = $res_data['response_Code'];
        $api_data['response_data'] = json_encode($response['outputData']);
        $pan_api_id = $this->_insert_pan_log($api_data);
        if ($api_data['response_code'] != VALUE_ONE) {
            return array('success' => false, 'message' => $pan_api_rc_array[$api_data['response_code']]);
        }
        $api_data['response_data'] = json_decode($api_data['response_data'], true);

        $pan_api_rd = array();
        foreach ($api_data['response_data'] as $rd) {
            array_push($pan_api_rd, array(
                'pan_api_id' => $pan_api_id,
                'pan_number' => $rd['pan'],
                'pan_status' => $rd['pan_status'],
                'name' => $rd['name'],
                'father_name' => $rd['fathername'],
                'dob' => $rd['dob'],
                'seeding_status' => $rd['seeding_status']
            ));
        }
        if (!empty($pan_api_rd)) {
            $this->utility_model->insert_data_batch('pan_api_rd', $pan_api_rd);
        }
        return array('success' => true, 'pan_api_id' => $pan_api_id, 'api_data' => $api_data);
    }

    function test_fetch_details_from_pan() {
        try {
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $pan_data = array();
            $pan_data['pan_number'] = 'AAAAL6704B';
            $pan_data['name'] = 'SAMUDRA INDUSTRIES LIMITED.';
            $pan_data['father_name'] = '';
            $pan_data['dob'] = '15/08/1993';

            $ex_data = $this->utility_model->get_by_id('user_id', $session_user_id, 'pan', 'pan_number', $pan_data['pan_number']);
            if (!empty($ex_data)) {
                echo json_encode(get_error_array(DETAILS_ALREADY_EXISTS_MESSAGE));
                return false;
            }
            $m_pan_data = array();
            array_push($m_pan_data, array(
                'pan' => $pan_data['pan_number'],
                'name' => $pan_data['name'],
                'fathername' => $pan_data['father_name'],
                'dob' => $pan_data['dob'],
            ));
            $pan_sign = $this->_get_signature_for_pan_data(json_encode($m_pan_data));
            if ($pan_sign['success'] == false) {
                echo json_encode(get_error_array($pan_sign['message']));
                return false;
            }
            $pan_api_rc_array = $this->config->item('pan_api_response_code_array');
            $return_data = $this->_update_pan_data($session_user_id, $pan_sign, $pan_api_rc_array, VALUE_ONE);
            if ($return_data['success'] == false) {
                echo json_encode(get_error_array($return_data['message']));
                return false;
            }
            $new_pan_data = isset($return_data['api_data']['response_data'][0]) ? $return_data['api_data']['response_data'][0] : [];
            if (empty($new_pan_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $pan_status_array = $this->config->item('pan_status_array');
            if (!isset($pan_status_array[$new_pan_data['pan_status']])) {
                echo json_encode(get_error_array(PAN_INVALID_STATUS_MESSAGE));
                return false;
            }
            $pan_status_message = $pan_status_array[$new_pan_data['pan_status']];
            if ($new_pan_data['pan_status'] == 'F' || $new_pan_data['pan_status'] == 'X' ||
                    $new_pan_data['pan_status'] == 'D' || $new_pan_data['pan_status'] == 'N') {
                echo json_encode(get_error_array($pan_status_message));
                return false;
            }
            if ($new_pan_data['name'] == 'N') {
                echo json_encode(get_error_array(PAN_NAME_NM_MESSAGE));
                return false;
            }
            if ($new_pan_data['dob'] == 'N') {
                echo json_encode(get_error_array(PAN_DOB_NM_MESSAGE));
                return false;
            }
            if ($new_pan_data['seeding_status'] == 'R') {
                echo json_encode(get_error_array(PAN_INOPERATIVE_MESSAGE));
                return false;
            }
            $i_pan_data = array();
            $i_pan_data['user_id'] = $session_user_id;
            $i_pan_data['pan_api_id'] = $return_data['pan_api_id'];
            $i_pan_data['pan_number'] = $pan_data['pan'];
            $i_pan_data['name'] = $pan_data['name'];
            $i_pan_data['father_name'] = $pan_data['father_name'];
            $i_pan_data['dob'] = convert_to_mysql_date_format($pan_data['dob']);
            $i_pan_data['created_by'] = $session_user_id;
            $i_pan_data['created_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->insert_data('pan', $i_pan_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = PAN_VF_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function fetch_details_from_pan() {
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
            $pan_data = $this->_get_post_data_for_pan();
            $validation_message = $this->_check_validation_for_pan($pan_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            unset($pan_data['captcha_code']);
            unset($pan_data['captcha_code_varification']);
            $ex_data = $this->utility_model->get_by_id('user_id', $session_user_id, 'pan', 'pan_number', $pan_data['pan_number']);
            if (!empty($ex_data)) {
                echo json_encode(get_error_array(DETAILS_ALREADY_EXISTS_MESSAGE));
                return false;
            }
            $m_pan_data = array();
            array_push($m_pan_data, array(
                'pan' => $pan_data['pan_number'],
                'name' => $pan_data['name'],
                'fathername' => $pan_data['father_name'],
                'dob' => str_replace('-', '/', $pan_data['dob']),
            ));
            $pan_sign = $this->_get_signature_for_pan_data(json_encode($m_pan_data));
            if ($pan_sign['success'] == false) {
                echo json_encode(get_error_array($pan_sign['message']));
                return false;
            }
            $pan_api_rc_array = $this->config->item('pan_api_response_code_array');
            $return_data = $this->_update_pan_data($session_user_id, $pan_sign, $pan_api_rc_array);
            if ($return_data['success'] == false) {
                echo json_encode(get_error_array($return_data['message']));
                return false;
            }
            $new_pan_data = isset($return_data['api_data']['response_data'][0]) ? $return_data['api_data']['response_data'][0] : [];
            if (empty($new_pan_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $pan_status_array = $this->config->item('pan_status_array');
            if (!isset($pan_status_array[$new_pan_data['pan_status']])) {
                echo json_encode(get_error_array(PAN_INVALID_STATUS_MESSAGE));
                return false;
            }
            $pan_status_message = $pan_status_array[$new_pan_data['pan_status']];
            if ($new_pan_data['pan_status'] == 'F' || $new_pan_data['pan_status'] == 'X' ||
                    $new_pan_data['pan_status'] == 'D' || $new_pan_data['pan_status'] == 'N') {
                echo json_encode(get_error_array($pan_status_message));
                return false;
            }
            if ($new_pan_data['name'] == 'N') {
                echo json_encode(get_error_array(PAN_NAME_NM_MESSAGE));
                return false;
            }
            if ($new_pan_data['dob'] == 'N') {
                echo json_encode(get_error_array(PAN_DOB_NM_MESSAGE));
                return false;
            }
            if ($new_pan_data['seeding_status'] == 'R') {
                echo json_encode(get_error_array(PAN_INOPERATIVE_MESSAGE));
                return false;
            }
            $i_pan_data = array();
            $i_pan_data['user_id'] = $session_user_id;
            $i_pan_data['pan_api_id'] = $return_data['pan_api_id'];
            $i_pan_data['pan_number'] = $pan_data['pan'];
            $i_pan_data['name'] = $pan_data['name'];
            $i_pan_data['father_name'] = $pan_data['father_name'];
            $i_pan_data['dob'] = convert_to_mysql_date_format($pan_data['dob']);
            $i_pan_data['created_by'] = $session_user_id;
            $i_pan_data['created_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->insert_data('pan', $i_pan_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = PAN_VF_MESSAGE;
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
