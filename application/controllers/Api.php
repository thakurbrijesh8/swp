<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
    }

    function _bd_for_logs($crone_type) {
        $logs_data = array();
        $logs_data['crone_type'] = $crone_type;
        $logs_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $logs_data['start_datetime'] = date('Y-m-d H:i:s');
        $logs_data['logs_data'] = json_encode($_SERVER);
        return $logs_data;
    }

    function _insert_log($logs_data, $status, $message) {
        $logs_data['end_datetime'] = date('Y-m-d H:i:s');
        $logs_data['status'] = $status;
        $logs_data['message'] = $message;
        $this->utility_model->insert_data('logs_crone', $logs_data);
    }

    function update_processing_days() {
        $check_auth = check_crone_authentication();
        if (!$check_auth) {
            header("Location: " . base_url() . 'home');
            return false;
        }
        $logs_data = $this->_bd_for_logs(VALUE_ONE);
        $check_ip = check_crone_ip_authentication();
        if (!$check_ip) {
            $this->_insert_log($logs_data, VALUE_ONE, INVALID_IP_MESSAGE);
            header("Location: " . base_url() . 'home');
            return false;
        }
        try {
            $status_array = array(VALUE_TWO, VALUE_THREE, VALUE_FOUR, VALUE_SEVEN, VALUE_EIGHT, VALUE_NINE);
            $this->load->model('api_model');
            $this->load->model('utility_model');

            $temp_hdl = $this->utility_model->get_result_data('holidaylist');
            $hdl_array = array();
            $hdl_array['fdw_ess'] = array();
            $hdl_array['fdw'] = array();
            $hdl_array['sdw'] = array();
            foreach ($temp_hdl as $hdl) {
                $hdl_ts = strtotime($hdl['holiday_date']);
                if (!isset($hdl_array['fdw_ess'][$hdl_ts]) && $hdl['fdw_ess'] == VALUE_ONE) {
                    $hdl_array['fdw_ess'][$hdl_ts] = $hdl_ts;
                }
                if (!isset($hdl_array['fdw'][$hdl_ts]) && $hdl['fdw'] == VALUE_ONE) {
                    $hdl_array['fdw'][$hdl_ts] = $hdl_ts;
                }
                if (!isset($hdl_array['sdw'][$hdl_ts]) && $hdl['sdw'] == VALUE_ONE) {
                    $hdl_array['sdw'][$hdl_ts] = $hdl_ts;
                }
            }
            $module_array = $this->config->item('query_module_array');
            foreach ($module_array as $m_array) {
                $this->_update_days($hdl_array, $status_array, $m_array['tbl_text'], $m_array['key_id_text'], $m_array['working_days']);
            }
            $this->_insert_log($logs_data, VALUE_TWO, RECORDS_UPDATED_MESSAGE);
        } catch (\Exception $e) {
            $this->_insert_log($logs_data, VALUE_ONE, $e->getMessage());
            header("Location: " . base_url() . 'home');
        }
    }

    function _update_days($hdl_array, $status_array, $module_name, $module_id, $working_days) {
        $temp_array = $this->api_model->get_records_for_update_processing_days($module_name, $status_array);
        $update_batch = array();
        foreach ($temp_array as $value) {
            if ($value['submitted_datetime'] == '0000-00-00 00:00:00' || $value['submitted_datetime'] == '1999-01-01 00:00:00') {
                
            } else {
                $total_holiday = 0;
                $total_working_days = 0;
                $startDate = new DateTime($value['submitted_datetime']);

                $endDate = new DateTime(date('d-m-Y'));
                while ($startDate <= $endDate) {
                    $timestamp = strtotime($startDate->format('d-m-Y'));
                    if (isset($hdl_array[$working_days][$timestamp])) {
                        $total_holiday += 1;
                    } else {
                        $total_working_days += 1;
                    }
                    $startDate->modify('+1 day');
                }
                $update_array = array();
                $update_array[$module_id] = $value[$module_id];
                $update_array['processing_days'] = $total_working_days;
                array_push($update_batch, $update_array);
            }
        }
        if (!empty($update_batch)) {
            $this->utility_model->update_data_batch($module_id, $module_name, $update_batch);
        }
    }

    function send_mail_for_pending_verification() {
        $check_auth = check_crone_authentication();
        if (!$check_auth) {
            header("Location: " . base_url() . 'home/page_not_found');
            return false;
        }
        $logs_data = $this->_bd_for_logs(VALUE_ONE);
        $check_ip = check_crone_ip_authentication();
        if (!$check_ip) {
            $this->_insert_log($logs_data, VALUE_ONE, INVALID_IP_MESSAGE);
            header("Location: " . base_url() . 'home/page_not_found');
            return false;
        }
        try {
            $this->db->where('is_verify_mobile', VALUE_ZERO);
            $this->db->from('users');
            $result_array = $this->db->get()->result_array();
            $this->load->library('email_lib');
            foreach ($result_array as $user_data) {
                $link = base_url() . 'confirmation?q=' . $user_data['temp_access_token'];
                echo $link . '<br>';
                $registration_message = "Click following URL or Paste URL in browser's address bar to complete your Account Verification for https://swp.dddgov.in <br><br>" . $link;
                $this->email_lib->send_email($user_data, 'Account Verification', $registration_message, VALUE_ONE);
            }
            $this->_insert_log($logs_data, VALUE_TWO, MAIL_SENT_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            $this->_insert_log($logs_data, VALUE_ONE, $e->getMessage());
            header("Location: " . base_url() . 'home/page_not_found');
        }
    }
}

/*
 * EOF: ./application/controller/Api.php
 */