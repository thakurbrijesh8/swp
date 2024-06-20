<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    //    
//    function update_processing_days_single() {
//        $this->load->model('api_model');
//        $this->load->model('utility_model');
//        $module_id = 'wc_id';
//        $module_name = 'wc';
//        $status_array = array(VALUE_FIVE);
//        $temp_array = $this->api_model->get_records_for_update_processing_days($module_name, $status_array);
//        $update_batch = array();
//        foreach ($temp_array as $value) {
//            if ($value['submitted_datetime'] == '0000-00-00 00:00:00' || $value['submitted_datetime'] == '1999-01-01 00:00:00') {
//                
//            } else {
//                $update_array = array();
//                $update_array[$module_id] = $value[$module_id];
//                $update_array['processing_days'] = get_days_in_dates_single($value['status_datetime'], $value['submitted_datetime']);
//                $update_array['updated_by'] = 0;
//                $update_array['updated_time'] = date('Y-m-d H:i:s');
//                array_push($update_batch, $update_array);
//            }
//        }
//        if (!empty($update_batch)) {
//            $this->utility_model->update_data_batch($module_id, $module_name, $update_batch);
//        }
//    }
//    function send_test_mail() {
//        $this->load->library('email');
//        $config = array();
//        $config['protocol'] = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
//        $config['smtp_host'] = "ssl://smtp.googlemail.com"; // you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
//        $config['smtp_user'] = "noreply.dddgov@gmail.com"; // client email gmail id
//        $config['smtp_pass'] = "DamNic@1819"; // client password
//        $config['smtp_port'] = 465;
//        $config['smtp_crypto'] = 'ssl';
//        $config['smtp_timeout'] = "";
//        $config['mailtype'] = "html";
//        $config['charset'] = "iso-8859-1";
//        $config['newline'] = "\r\n";
//        $config['wordwrap'] = TRUE;
//        $config['validate'] = FALSE;
//        $this->load->library('email', $config); // intializing email library, whitch is defiend in system
//
//        $this->email->set_newline("\r\n");
//        //Load email library
//
//        $this->email->from('mafiyagaming20@gmail.com');
//        $this->email->to('vishal@nitsgroup.com');
//        $this->email->subject('Send Email Codeigniter');
//        $this->email->message('The email send using codeigniter library');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
//        //Send mail
//        if ($this->email->send()) {
//            echo "email_sent";
//        } else {
//            echo "email_not_sent";
//        }
//    }
    //    function calculate_days() {
//        echo '<pre>';
//        $startDate = "04-03-2022";
//        $endDate = date('d-m-Y');
//        $total_sunday = 0;
//        $startDate = new DateTime($startDate);
//        $endDate = new DateTime($endDate);
//        while ($startDate <= $endDate) {
//            $timestamp = strtotime($startDate->format('d-m-Y'));
//            $weekDay = date('l', $timestamp);
//            if ($weekDay == 'Sunday') {
//                $total_sunday = $total_sunday + 1;
//            }
//            $startDate->modify('+1 day');
//        }
//        print_r($total_sunday);
//    }
//
//    function calculate_days_new() {
//        echo '<pre>';
//        $temp_hdl = $this->utility_model->get_result_data('holidaylist');
//        $hdl_array = array();
//        $hdl_array['fdw_ess'] = array();
//        $hdl_array['fdw'] = array();
//        $hdl_array['sdw'] = array();
//        foreach ($temp_hdl as $hdl) {
//            $hdl_ts = strtotime($hdl['holiday_date']);
//            if (!isset($hdl_array['fdw_ess'][$hdl_ts]) && $hdl['fdw_ess'] == VALUE_ONE) {
//                $hdl_array['fdw_ess'][$hdl_ts] = $hdl_ts;
//            }
//            if (!isset($hdl_array['fdw'][$hdl_ts]) && $hdl['fdw'] == VALUE_ONE) {
//                $hdl_array['fdw'][$hdl_ts] = $hdl_ts;
//            }
//            if (!isset($hdl_array['sdw'][$hdl_ts]) && $hdl['sdw'] == VALUE_ONE) {
//                $hdl_array['sdw'][$hdl_ts] = $hdl_ts;
//            }
//        }
//        $total_holiday = 0;
//        $total_working_days = 0;
//        $startDate = new DateTime("04-03-2022 19:50:38");
//        $endDate = new DateTime(date('d-m-Y'));
//        while ($startDate <= $endDate) {
//            $timestamp = strtotime($startDate->format('d-m-Y'));
//            if (isset($hdl_array['fdw_ess'][$timestamp])) {
//                $total_holiday += 1;
//            } else {
//                $total_working_days += 1;
//            }
//            $startDate->modify('+1 day');
//        }
//        echo 'Start Date - 04-03-2022 19:50:38<br>';
//        echo 'End Date - ' . date('d-m-Y') . '<br>';
//        echo 'Total Holiday - ' . $total_holiday . '<br>';
//        echo 'Total Working Day - ' . $total_working_days;
//    }
//    function update_processing_days() {
//        $status_array = array(VALUE_TWO, VALUE_THREE, VALUE_FOUR, VALUE_SEVEN, VALUE_EIGHT, VALUE_NINE);
//        $this->load->model('api_model');
//        $this->load->model('utility_model');
//
//        $module_array = $this->config->item('query_module_array');
//        foreach ($module_array as $m_array) {
//            $this->_update_days($status_array, $m_array['tbl_text'], $m_array['key_id_text']);
//        }
//    }
//
//    function _update_days($status_array, $module_name, $module_id) {
//        $temp_array = $this->api_model->get_records_for_update_processing_days($module_name, $status_array);
//        $update_batch = array();
//        foreach ($temp_array as $value) {
//            if ($value['submitted_datetime'] == '0000-00-00 00:00:00' || $value['submitted_datetime'] == '1999-01-01 00:00:00') {
//                
//            } else {
//                $update_array = array();
//                $update_array[$module_id] = $value[$module_id];
//                $update_array['processing_days'] = get_days_in_dates($value['submitted_datetime']);
//                $update_array['updated_by'] = 0;
//                $update_array['updated_time'] = date('Y-m-d H:i:s');
//                array_push($update_batch, $update_array);
//            }
//        }
//        if (!empty($update_batch)) {
//            $this->utility_model->update_data_batch($module_id, $module_name, $update_batch);
//        }
//    }
//    function send_mail_for_pending_verification() {
////        $this->db->where('user_id', 44);
//        $this->db->where('is_verify_mobile', VALUE_ZERO);
//        $this->db->from('users');
//        $result_array = $this->db->get()->result_array();
////        echo '<pre>';
////        print_r($result_array);
////        return false;
//        $this->load->library('email_lib');
//        foreach ($result_array as $user_data) {
//            $link = base_url() . 'confirmation?q=' . $user_data['temp_access_token'];
//            echo $link . '<br>';
//            $registration_message = "Click following URL or Paste URL in browser's address bar to complete your Account Verification for https://swp.dddgov.in <br><br>" . $link;
//            $this->email_lib->send_email($user_data, 'Account Verification', $registration_message, VALUE_ONE);
//        }
//    }
//    
//    function update_processing_days_single() {
//        $this->load->model('api_model');
//        $this->load->model('utility_model');
//        $module_id = 'wc_id';
//        $module_name = 'wc';
//        $status_array = array(VALUE_FIVE);
//        $temp_array = $this->api_model->get_records_for_update_processing_days($module_name, $status_array);
//        $update_batch = array();
//        foreach ($temp_array as $value) {
//            if ($value['submitted_datetime'] == '0000-00-00 00:00:00' || $value['submitted_datetime'] == '1999-01-01 00:00:00') {
//                
//            } else {
//                $update_array = array();
//                $update_array[$module_id] = $value[$module_id];
//                $update_array['processing_days'] = get_days_in_dates_single($value['status_datetime'], $value['submitted_datetime']);
//                $update_array['updated_by'] = 0;
//                $update_array['updated_time'] = date('Y-m-d H:i:s');
//                array_push($update_batch, $update_array);
//            }
//        }
//        if (!empty($update_batch)) {
//            $this->utility_model->update_data_batch($module_id, $module_name, $update_batch);
//        }
//    }
//    function send_test_mail() {
//        $this->load->library('email');
//        $config = array();
//        $config['protocol'] = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
//        $config['smtp_host'] = "ssl://smtp.googlemail.com"; // you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
//        $config['smtp_user'] = "noreply.dddgov@gmail.com"; // client email gmail id
//        $config['smtp_pass'] = "DamNic@1819"; // client password
//        $config['smtp_port'] = 465;
//        $config['smtp_crypto'] = 'ssl';
//        $config['smtp_timeout'] = "";
//        $config['mailtype'] = "html";
//        $config['charset'] = "iso-8859-1";
//        $config['newline'] = "\r\n";
//        $config['wordwrap'] = TRUE;
//        $config['validate'] = FALSE;
//        $this->load->library('email', $config); // intializing email library, whitch is defiend in system
//
//        $this->email->set_newline("\r\n");
//        //Load email library
//
//        $this->email->from('mafiyagaming20@gmail.com');
//        $this->email->to('vishal@nitsgroup.com');
//        $this->email->subject('Send Email Codeigniter');
//        $this->email->message('The email send using codeigniter library');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
//        //Send mail
//        if ($this->email->send()) {
//            echo "email_sent";
//        } else {
//            echo "email_not_sent";
//        }
//    }
}

/*
 * EOF: ./application/controller/Api.php
 */