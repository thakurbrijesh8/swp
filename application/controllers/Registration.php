<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        check_authenticated_rediraction();
        $this->load->view('registration');
    }

    function new_registration() {
        try {
            $user_data = $this->_get_post_data_for_registration();
            $validation_message = $this->_check_validation_for_registration($user_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->load->model('utility_model');
            $this->db->trans_start();
            $exi_mob_data = $this->utility_model->get_by_id('mobile_number', $user_data['mobile_number'], 'users');
            if (!empty($exi_mob_data)) {
                echo json_encode(get_error_array(EXISTS_MOBILE_NUMBER_MESSAGE));
                return false;
            }
            $exi_email_data = $this->utility_model->get_by_id('email', $user_data['email'], 'users');
            if (!empty($exi_email_data)) {
                echo json_encode(get_error_array(EXISTS_EMAIL_MESSAGE));
                return false;
            }
            $user_data['pin'] = encrypt(substr($user_data['mobile_number'], 0, 6));
            $user_data['is_active'] = IS_ACTIVE_NO;
            $user_data['created_by'] = 0;
            $user_data['created_time'] = date('Y-m-d H:i:s');
            $user_data['temp_access_token'] = generate_token(50);
            $user_data['user_id'] = $this->utility_model->insert_data('users', $user_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $link = base_url() . 'confirmation?q=' . $user_data['temp_access_token'];
            $registration_message = "Click following URL or Paste URL in browser's address bar to complete your Account Verification for <b>SWP</b> <br><br>" . $link;
            $this->load->helper('sms_helper');
            send_SMS($this, $user_data['user_id'], $user_data['mobile_number'], 'Confirm Your Account. ' . $link, VALUE_ONE);
            $message = 'You have successfully submitted your registration details.<br><br>We have sent you an email verification link on your email address <span style="color: red;">' . $user_data['email'] . '</span><br><br>Kindly verify your email address using verification link.<br><br> <span style="color: red;">Note :</span> If Mail is Not Received Your Inbox. Please Check the Spam.';
            $this->load->library('email_lib');
            $this->email_lib->send_email($user_data, 'Account Verification', $registration_message, VALUE_ONE);
            $success_array = get_success_array();
            $success_array['message'] = $message;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_registration() {
        $user_data = array();
        $user_data['applicant_name'] = get_from_post('applicant_name_for_registration');
        $user_data['applicant_address'] = get_from_post('applicant_address_for_registration');
        $user_data['mobile_number'] = get_from_post('mobile_number_for_registration');
        $user_data['email'] = get_from_post('email_for_registration');
        return $user_data;
    }

    function _check_validation_for_registration($user_data) {
        if (!$user_data['applicant_name']) {
            return NAME_MESSAGE;
        }
        if (!$user_data['applicant_address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$user_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$user_data['email']) {
            return EMAIL_MESSAGE;
        }
        return '';
    }

    function change_pin() {
        try {
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $current_pin = get_from_post('current_pin_for_change_pin');
            $new_pin = get_from_post('new_pin_for_change_pin');
            $retype_pin = get_from_post('retype_new_pin_for_change_pin');
            if ($current_pin == '') {
                echo json_encode(get_error_array(CURRENT_PIN_VALIDATION_MESSAGE));
                return false;
            }
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
            $this->load->model('utility_model');
            $this->db->trans_start();
            $session_user_data = $this->utility_model->get_by_id('user_id', $session_user_id, 'users');
            if (empty($session_user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (decrypt($session_user_data['pin']) != $current_pin) {
                echo json_encode(get_error_array(CURRENT_PIN_IS_INVALID_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['pin'] = encrypt($new_pin);
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('user_id', $session_user_id, 'users', $update_data);

            $this->logs_model->insert_log(TBL_LOGS_CHANGE_PASSWORD, array('user_id' => $session_user_id, 'old_pin' => $session_user_data['pin'], 'new_pin' => $update_data['pin'], 'created_time' => date('Y-m-d H:i:s')));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = PIN_CHANGED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controllers/Registration.php
 */
