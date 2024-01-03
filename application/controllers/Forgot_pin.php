<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_pin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
    }

    public function index() {
        $this->load->view('forgot_pin');
    }

    function check_forgot_pin() {
        try {
            $mobile_number = get_from_post('mobile_number_for_fp');
            if (!$mobile_number) {
                echo json_encode(get_error_array(MOBILE_NUMBER_MESSAGE));
                return false;
            }
            if (!preg_match('/^[0-9]{10}+$/', $mobile_number)) {
                echo json_encode(get_error_array(INVALID_MOBILE_NUMBER_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $exi_mob_data = $this->utility_model->get_by_id('mobile_number', $mobile_number, 'users');
            if (empty($exi_mob_data)) {
                echo json_encode(get_error_array(MOBILE_NOT_EXIST_MESSAGE));
                return false;
            }
            if ($exi_mob_data['is_active'] != IS_ACTIVE) {
                echo json_encode(get_error_array(ACCOUNT_NOT_ACTIVE_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['updated_by'] = 0;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $update_data['temp_access_token'] = generate_token(50);
            $this->utility_model->update_data('user_id', $exi_mob_data['user_id'], 'users', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $rp_message = base_url() . 'reset_pin?rp=' . $update_data['temp_access_token'];
            $this->load->helper('sms_helper');
            send_SMS($this, $exi_mob_data['user_id'], $exi_mob_data['mobile_number'], 'Reset Pin Link ' . $rp_message, VALUE_THREE);
            $message = 'We have sent you an email for Reset Pin link on your email address <span style="color: red;">' . $exi_mob_data['email'] . '</span><br><br>Please check your email.<br><br> <span style="color: red;">Note :</span> If Mail is Not Received Your Inbox. Please Check the Spam.';
            $this->load->library('email_lib');
            $this->email_lib->send_email($exi_mob_data, 'Reset Pin Link', $rp_message, VALUE_THREE);
            $success_array = get_success_array();
            $success_array['message'] = $message;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function change_new_pin() {
        try {
            $temp_access_token = get_from_post('temp_access_token');
            $this->db->trans_start();
            $user_data = $this->utility_model->get_by_id('temp_access_token', $temp_access_token, 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($user_data['is_active'] != IS_ACTIVE) {
                echo json_encode(get_error_array(ACCOUNT_NOT_ACTIVE_MESSAGE));
                return false;
            }
            $new_pin = get_from_post('new_pin_for_np');
            $retype_pin = get_from_post('retype_new_pin_for_np');
            if ($new_pin == '') {
                echo json_encode(get_error_array(NEW_PIN_VALIDATION_MESSAGE));
                return false;
            }
            if ($retype_pin == '') {
                echo json_encode(get_error_array(RETYPE_NEW_PIN_VALIDATION_MESSAGE));
                return false;
            }
            if ($new_pin != $retype_pin) {
                echo json_encode(get_error_array(NOT_MATCH_PIN_VALIDATION_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['temp_access_token'] = '';
            $update_data['pin'] = encrypt($new_pin);
            $update_data['updated_by'] = 0;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('user_id', $user_data['user_id'], 'users', $update_data);
            $this->logs_model->insert_log(TBL_LOGS_CHANGE_PASSWORD, array('user_id' => $user_data['user_id'], 'old_pin' => $user_data['pin'], 'new_pin' => $update_data['pin'], 'created_time' => date('Y-m-d H:i:s')));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Forgot_pin.php
 */