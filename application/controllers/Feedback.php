<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
    }

    function index() {
        $this->load->view('feedback');
    }

    function submit_cfr() {
        try {
            if (!is_post()) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $cfr_data = $this->_get_post_data_for_cfr();
            $validation_message = $this->_check_validation_for_cfr($cfr_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->db->trans_start();
            $cfr_data['created_time'] = date('Y-m-d H:i:s');
            $this->utility_model->insert_data('cfr', $cfr_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = CFR_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_cfr() {
        $cfr_data = array();
        $cfr_data['full_name'] = get_from_post('full_name_for_cfr');
        $cfr_data['landline_number'] = get_from_post('landline_number_for_cfr');
        $cfr_data['mobile_number'] = get_from_post('mobile_number_for_cfr');
        $cfr_data['email'] = get_from_post('email_for_cfr');
        $cfr_data['feedback'] = get_from_post('feedback_for_cfr');
        $cfr_data['logs_data'] = json_encode(array(
            'HTTP_USER_AGENT' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR']
        ));
        return $cfr_data;
    }

    function _check_validation_for_cfr($cfr_data) {
        if (!$cfr_data['full_name']) {
            return APPLICANT_FULL_NAME_MESSAGE;
        }
        if (!$cfr_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$cfr_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$cfr_data['feedback']) {
            return CFR_MESSAGE;
        }
        return '';
    }

}

/*
 * EOF: ./application/controller/Feedback.php
 */