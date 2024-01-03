<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Confirmation extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $temp_access_token = $this->input->get('q');
        if (!$temp_access_token) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $success_data = array();
        $this->db->trans_start();
        $this->load->model('utility_model');
        $user_data = $this->utility_model->get_by_id('temp_access_token', $temp_access_token, 'users');
        if (empty($user_data) || $user_data['is_active'] == IS_ACTIVE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $this->load->model('utility_model');
        if ($user_data['is_verify_email'] != IS_VERIFY) {
            $OTP_data = array();
            $OTP_data['otp'] = mt_rand(100000, 999999);
            $OTP_data['created_time'] = date('Y-m-d H:i:s');
            $existing_opt_data = $this->utility_model->get_OTP_data_by_mobile_number_and_type($user_data['mobile_number'], VALUE_ONE);
            if (empty($existing_opt_data)) {
                $OTP_data['otp_type'] = VALUE_ONE;
                $OTP_data['mobile_number'] = $user_data['mobile_number'];
                $this->utility_model->insert_data('otp', $OTP_data);
            } else {
                $this->utility_model->update_OTP($user_data['mobile_number'], VALUE_ONE, $OTP_data);
            }
            $this->utility_model->update_data('user_id', $user_data['user_id'], 'users', array('is_verify_email' => IS_VERIFY, 'verify_email_datetime' => date('Y-m-d H:i:s'), 'updated_by' => $user_data['user_id'], 'updated_time' => date('Y-m-d H:i:s')));
            $success_data['email_verify_message'] = TRUE;

            $this->load->helper('sms_helper');
            send_SMS($this, $user_data['user_id'], $user_data['mobile_number'], " " . $OTP_data['otp'] . ' is your verification code.', VALUE_ONE);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $message = 'An OTP has been sent on your Registered Mobile Number <b>+91-' . generate_secure_mobile_number($user_data['mobile_number']) . '</b>. Enter OTP below.';
        $success_data['temp_access_token'] = $temp_access_token;
        $success_data['message'] = $message;
        $this->load->view('otp', $success_data);
    }

    function check_otp_verification() {
        try{
            if (!is_post()) {
                echo json_encode(array('success' => FALSE, 'message' => 'Invalid Access !'));
                return false;
            }
            $otp_verification_data = $this->_get_post_data_for_otp_verification();
            $validation_message = $this->_check_validation_for_otp_verification($otp_verification_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->db->trans_start();
            $this->load->model('utility_model');
            $user_data = $this->utility_model->get_by_id('temp_access_token', $otp_verification_data['temp_access_token'], 'users');
            if (empty($user_data) || $user_data['is_active'] == IS_ACTIVE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }

            //TODO: Temp OTP
            if ($otp_verification_data['otp'] != 111111) {
                echo json_encode(get_error_array(INCORRECT_OTP_MESSAGE));
                return;
            }

    //        $this->load->model('utility_model');
    //        $existing_opt_data = $this->utility_model->get_OTP_data_by_mobile_number_and_type($user_data['mobile_number'], VALUE_ONE);
    //        if (empty($existing_opt_data)) {
    //            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //            return;
    //        }
    //        if ($otp_verification_data['otp'] != $existing_opt_data['otp']) {
    //            echo json_encode(get_error_array(INCORRECT_OTP_MESSAGE));
    //            return;
    //        }

            $this->utility_model->update_data('user_id', $user_data['user_id'], 'users', array('is_verify_mobile' => IS_VERIFY, 'verify_mobile_datetime' => date('Y-m-d H:i:s'), 'temp_access_token' => '', 'updated_by' => $user_data['user_id'], 'is_active' => IS_ACTIVE, 'updated_time' => date('Y-m-d H:i:s')));
            $this->utility_model->update_OTP($user_data['mobile_number'], VALUE_ONE, array('is_expired' => IS_DELETE));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $this->load->helper('sms_helper');
            $sms = 'Your Login Credentials is Mobile Number : ' . $user_data['mobile_number'] . ' and Your PIN is : ' . decrypt($user_data['pin']);
            send_SMS($this, $user_data['user_id'], $user_data['mobile_number'], $sms, VALUE_TWO);
            $this->load->library('email_lib');
            $this->email_lib->send_email($user_data, 'Login Credentials', $sms, VALUE_TWO);

            $success_array = get_success_array();
            $success_array['message'] = VERIFICATION_SUCCESS_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $this->load->view('error_page', array('error_message' => $e->getMessage()));
            return;
        }
    }

    function _get_post_data_for_otp_verification() {
        $otp_verification_data = array();
        $otp_verification_data['temp_access_token'] = get_from_post('temp_access_token');
        $otp_verification_data['otp'] = get_from_post('temp_otp');
        return $otp_verification_data;
    }

    function _check_validation_for_otp_verification($otp_verification_data) {
        if (!$otp_verification_data['temp_access_token']) {
            return INVALID_ACCESS_MESSAGE;
        }
        if (!$otp_verification_data['otp']) {
            return OTP_MESSAGE;
        }
        return '';
    }

    function resend_otp_for_registration() {
        try{
            $temp_access_token = get_from_post('temp_access_token');
            $mobile_number = get_from_post('mobile_number');
            if (!$temp_access_token) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $this->load->model('utility_model');
            $user_data = $this->utility_model->get_by_id('temp_access_token', $temp_access_token, 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $otp = '';
            $existing_opt_data = $this->utility_model->get_OTP_data_by_mobile_number_and_type($mobile_number, VALUE_ONE);
            if (empty($existing_opt_data)) {
                $OTP_data = array();
                $OTP_data['otp'] = mt_rand(100000, 999999);
                $OTP_data['created_time'] = date('Y-m-d H:i:s');
                $OTP_data['otp_type'] = VALUE_ONE;
                $OTP_data['mobile_number'] = $mobile_number;
                $this->utility_model->insert_data('otp', $OTP_data);
                $otp = $OTP_data['otp'];
            } else {
                $otp = $existing_opt_data['otp'];
            }
            $this->load->helper('sms_helper');
            send_SMS($this, $user_data['user_id'], $mobile_number, $otp . ' is your verification code.', VALUE_ONE);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = OTP_SEND_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $this->load->view('error_page', array('error_message' => $e->getMessage()));
            return;
        }
    }

    function resend_otp_by_temp_access_token() {
        try{
            $temp_access_token = get_from_post('temp_access_token');
            if (!$temp_access_token) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $this->load->model('utility_model');
            $user_data = $this->utility_model->get_by_id('temp_access_token', $temp_access_token, 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $otp = '';
            $existing_opt_data = $this->utility_model->get_OTP_data_by_mobile_number_and_type($user_data['mobile_number'], VALUE_ONE);
            if (empty($existing_opt_data)) {
                $OTP_data = array();
                $OTP_data['otp'] = mt_rand(100000, 999999);
                $OTP_data['created_time'] = date('Y-m-d H:i:s');
                $OTP_data['otp_type'] = VALUE_ONE;
                $OTP_data['mobile_number'] = $user_data['mobile_number'];
                $this->utility_model->insert_data('otp', $OTP_data);
                $otp = $OTP_data['otp'];
            } else {
                $otp = $existing_opt_data['otp'];
            }

            $this->load->helper('sms_helper');
            send_SMS($this, $user_data['user_id'], $user_data['mobile_number'], $otp . ' is your verification code.', VALUE_ONE);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = OTP_RESEND_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $this->load->view('error_page', array('error_message' => $e->getMessage()));
            return;
        }
    }

    function reset_pin() {
        $temp_access_token = $this->input->get('rp');
        if (!$temp_access_token) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $success_data = array();
        $this->db->trans_start();
        $this->load->model('utility_model');
        $user_data = $this->utility_model->get_by_id('temp_access_token', $temp_access_token, 'users');
        if (empty($user_data)) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        if ($user_data['is_active'] != IS_ACTIVE) {
            echo json_encode(get_error_array(ACCOUNT_NOT_ACTIVE_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        $success_data['temp_access_token'] = $temp_access_token;
        $this->load->view('reset_pin', $success_data);
    }

}

/*
 * EOF: ./application/controllers/Confirmation.php
 */