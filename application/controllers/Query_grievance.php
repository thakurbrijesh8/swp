<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Query_grievance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
        $this->load->model('query_grievance_model');
    }

    function index() {
        $this->load->view('query_grievance');
    }

    function submit_query_grievance() {
        $query_grievance_data = $this->_get_post_data_for_query_grievance();
        $validation_message = $this->_check_validation_for_query_grievance($query_grievance_data);
        if ($validation_message != '') {
            echo json_encode(get_error_array($validation_message));
            return false;
        }
        $this->db->trans_start();
        $query_grievance_data['status'] = VALUE_ONE;
        $query_grievance_data['created_time'] = date('Y-m-d H:i:s');
        $query_grievance_data['submitted_datetime'] = date('Y-m-d H:i:s');
        $query_grievance_id = $this->utility_model->insert_data('query_grievance', $query_grievance_data);
        $query_grievance_data['user_id'] = VALUE_ZERO;
        $query_grievance_data['created_by'] = VALUE_ZERO;
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $query_grievance_message = base_url() . 'Your Query/Grievance is submited successfully. Please note your Reference Number :' . $query_grievance_data['query_reference_number'] . 'Please track your Query/Grievance at' . base_url();
        $this->load->helper('sms_helper');
        send_SMS($this, $query_grievance_data['user_id'], $query_grievance_data['mobile_no'], 'Query/Grievance Submitted Successfully. ' . $query_grievance_message, VALUE_FOUR);
        $message = 'You have successfully submitted your Query/Grievance details.<br><br>We have sent you an email with query reference number on your email address <span style="color: red;">' . $query_grievance_data['email'] . '</span> ';
        $this->load->library('email_lib');
        $this->email_lib->send_email($query_grievance_data, 'Query/Grievance Submitted Successfully', $query_grievance_message, VALUE_FOUR);
        $success_array = get_success_array();
        $success_array['message'] = $message;
        echo json_encode($success_array);
    }

    function _get_post_data_for_query_grievance() {
        $query_grievance_data = array();
        $query_grievance_data['query_reference_number'] = uniqid();
        $query_grievance_data['district'] = get_from_post('district');
        $query_grievance_data['issue_category'] = get_from_post('issue_category');
        $query_grievance_data['department'] = get_from_post('department');
        $query_grievance_data['other_department'] = get_from_post('other_department');
        $query_grievance_data['full_name'] = get_from_post('full_name');
        $query_grievance_data['business_name'] = get_from_post('business_name');
        $query_grievance_data['industry_classification'] = get_from_post('industry_classification');
        $query_grievance_data['mobile_no'] = get_from_post('mobile_no');
        $query_grievance_data['email'] = get_from_post('email_id');
        $query_grievance_data['application_no'] = get_from_post('application_no');
        $query_grievance_data['query'] = get_from_post('query');
        return $query_grievance_data;
    }

    function _check_validation_for_query_grievance($query_grievance_data) {
        if (!$query_grievance_data['district']) {
            return QUERY_DISTRICT_MESSAGE;
        }
        if (!$query_grievance_data['issue_category']) {
            return ISSUE_CATEGORY_MESSAGE;
        }
        if (!$query_grievance_data['department']) {
            return QUERY_DEPARTMENT_MESSAGE;
        }
        if ($query_grievance_data['department'] == 10) {
            if (!$query_grievance_data['other_department']) {
                return QUERY_OTHER_DEPARTMENT_MESSAGE;
            }
        }
        if (!$query_grievance_data['full_name']) {
            return APPLICANT_FULL_NAME_MESSAGE;
        }
        // if (!$query_grievance_data['business_name']) {
        //     return BUSINESS_NAME_MESSAGE;
        // }
        if (!$query_grievance_data['industry_classification']) {
            return INDUSTRY_CLASSIFICATION_MESSAGE;
        }
        if (!$query_grievance_data['mobile_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$query_grievance_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$query_grievance_data['query']) {
            return QUERY_DETAIL_MESSAGE;
        }
        return '';
    }

    function get_query_grievance_average_fees_details() {
        if (!is_ajax()) {
            header("Location:" . base_url() . "login");
            return false;
        }
        $success_array = get_success_array();
        $success_array['service_name'] = '';
        try {
            if (!is_post()) {
                $success_array['average_fees'] = array();
                echo json_encode($success_array);
                return false;
            }
            $industry_type = get_from_post('industry_type');
            $industry_type_array = $this->config->item('industry_type_array');
            if (!isset($industry_type_array[$industry_type])) {
                $success_array['average_fees'] = array();
                echo json_encode($success_array);
                return false;
            }
            $it_data = $industry_type_array[$industry_type];
            $success_array['average_fees'] = $this->query_grievance_model->get_itwise_average_fees($industry_type);
            $success_array['service_name'] = $it_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['average_fees'] = array();
            echo json_encode($success_array);
        }
    }
}

/*
 * EOF: ./application/controller/Query_grievance.php
 */