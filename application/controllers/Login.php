<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
    }

    public function index() {
        $this->_destroy_session();
        $this->load->view('login');
    }

    function check_login() {
        try {
            if (!is_post()) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $user_data = $this->_get_post_data();
            $validation_message = $this->_check_validation($user_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->db->trans_start();
            $new_user_data = $this->utility_model->get_by_id('mobile_number', $user_data['mobile_number'], 'users');
            if (empty($new_user_data)) {
                echo json_encode(get_error_array(MOBILE_NUMBER_OR_PIN_MESSAGE));
                return;
            }
            if (decrypt($new_user_data['pin']) != $user_data['pin']) {
                echo json_encode(get_error_array(MOBILE_NUMBER_OR_PIN_MESSAGE));
                return;
            }
            if ($new_user_data['is_active'] != IS_ACTIVE) {
                echo json_encode(get_error_array(ACCOUNT_NOT_ACTIVE_MESSAGE));
                return;
            }
            if ($new_user_data['is_delete'] == IS_DELETE) {
                echo json_encode(get_error_array(ACCOUNT_DELETE_MESSAGE));
                return;
            }
            $log_id = $this->utility_lib->login_log($new_user_data['user_id']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $session_data = array();
            $session_data['temp_id_for_eodbsws'] = $new_user_data['user_id'];
            $session_data['name'] = ucwords($new_user_data['applicant_name']);
            $session_data['temp_logged'] = encrypt($log_id);
            $this->session->set_userdata($session_data);
            echo json_encode(get_success_array());
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data() {
        $user_data = array();
        $user_data['mobile_number'] = get_from_post('mobile_number_for_login');
        $user_data['pin'] = get_from_post('pin_for_login');
        return $user_data;
    }

    function _check_validation($user_data) {
        if (!$user_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!preg_match('/^[0-9]{10}+$/', $user_data['mobile_number'])) {
            return INVALID_MOBILE_NUMBER_MESSAGE;
        }
        if (!$user_data['pin']) {
            return PIN_MESSAGE;
        }
        return '';
    }

    function logout() {
        $this->_destroy_session();
        header("Location:" . base_url() . "main");
    }

    /**
     * This function is used to destroy the session.
     */
    function _destroy_session() {
        $temp_user_id = get_from_session('temp_id_for_eodbsws');
        if ($temp_user_id != NULL) {
            $temp_logged_id = decrypt(get_from_session('temp_logged'));
            if ($temp_logged_id) {
                $this->utility_lib->logout_log($temp_logged_id);
            }
        }
        $this->session->sess_destroy();
    }

}

/*
 * EOF: ./application/controller/Login.php
 */