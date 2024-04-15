<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility_lib {

    var $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('utility_model');
    }

    function login_log($user_id) {
        $logs_data = array();
        $logs_data['user_id'] = $user_id;
        $logs_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $logs_data['login_timestamp'] = time();
        $logs_data['logs_data'] = json_encode($this->_get_client_info());
        $logs_data['created_time'] = date('Y-m-d H:i:s');
        return $this->CI->logs_model->insert_log(TBL_LOGS_LOGIN_LOGOUT, $logs_data);
    }

    function logout_log($log_id) {
        $logs_data = array();
        $logs_data['logout_timestamp'] = time();
        $logs_data['updated_time'] = date('Y-m-d H:i:s');
        return $this->CI->logs_model->update_log(TBL_LOGS_LOGIN_LOGOUT, TBL_LOGS_LOGIN_LOGOUT_PRIMARY_KEY, $log_id, $logs_data);
    }

    function _get_client_info() {
        return array(
            'HTTP_USER_AGENT' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR']
        );
    }

    function get_department_data_by_district() {
        $temp_department_data = $this->CI->utility_model->get_result_data('department', 'department_name', 'ASC');
        $department_data = array();
        foreach ($temp_department_data as $dd) {
            if (!isset($department_data[$dd['district']])) {
                $department_data[$dd['district']] = array();
            }
            array_push($department_data[$dd['district']], $dd);
        }
        return $department_data;
    }

    function send_sms_and_email_for_app_submitted($user_id, $sms_email_type, $module_type, $module_id) {
        $ex_user_data = $this->CI->utility_model->get_by_id('user_id', $user_id, 'users');
        $prefix_module_array = $this->CI->config->item('prefix_module_array');
        $registration_message = 'Your Application Number : ' . generate_registration_number($prefix_module_array[$module_type], $module_id) . ' is Submitted Successfully !';
        $this->CI->load->helper('sms_helper');
        send_SMS($this, $user_id, $ex_user_data['mobile_number'], $registration_message, $sms_email_type);
        $this->CI->load->library('email_lib');
        $this->CI->email_lib->send_email($ex_user_data, 'Application Submitted', $registration_message, $sms_email_type, $module_type, $module_id);
    }

    function get_srap_ids() {
        $srap_data = $this->CI->utility_model->get_result_data('srap');
        $srap_ids = array();
        foreach ($srap_data as $srdata) {
            if (!isset($srap_ids[$srdata['serial_number']])) {
                $srap_ids[$srdata['serial_number']] = $srdata['serial_number'];
            }
        }
        return $srap_ids;
    }

    function check_post_id_validation($key_post_id, $post_id, $table_name) {
        if ($post_id == '' || $post_id == 0) {
            return "Please select any $table_name";
        }
        $is_valid = $this->check_post_data_of_entity($key_post_id, $post_id, $table_name);
        if (!$is_valid) {
            return "This $table_name does not exist.";
        }
        return '';
    }

    function check_post_data_of_entity($key_post_id, $post_id, $table_name) {
        $post_data = $this->CI->utility_model->is_valid_post_data($key_post_id, $post_id, $table_name);
        if (!empty($post_data)) {
            return TRUE;
        }
        return FALSE;
    }

    function app_edit_and_query_response($session_user_id, $app_module_type, $module_type, $module_id, &$m_data) {
        $query_module_array = $this->CI->config->item('query_module_array');
        if (!isset($query_module_array[$module_type])) {
            return INVALID_ACCESS_MESSAGE;
        }
        $qm_data = $query_module_array[$module_type];
        if (empty($qm_data)) {
            return INVALID_ACCESS_MESSAGE;
        }
        if ($app_module_type == VALUE_FIVE) {
            if ($module_type == VALUE_FIFTYTWO) {
                $ex_app_data = $this->CI->utility_model->get_incentive_details_by_id($module_id);
            } else {
                $ex_app_data = $this->CI->utility_model->get_by_id($qm_data['key_id_text'], $module_id, $qm_data['tbl_text'], 'user_id', $session_user_id);
            }
            if (empty($ex_app_data)) {
                return INVALID_ACCESS_MESSAGE;
            }
            if ($ex_app_data['status'] == VALUE_FIVE || $ex_app_data['status'] == VALUE_SIX) {
                return INVALID_ACCESS_MESSAGE;
            }
            if ($ex_app_data['query_status'] == VALUE_ONE) {
                $qrremarks = get_from_post('qr_remarks');
                if (!$qrremarks) {
                    return REMARKS_MESSAGE;
                }
                $ex_query = $this->CI->utility_model->get_by_id_multiple('module_type', $module_type, 'query', 'module_id', $module_id, 'query_type', VALUE_TWO, 'status', VALUE_ZERO);
                $u_data = array();
                $u_data['remarks'] = $qrremarks;
                $u_data['status'] = VALUE_ONE;
                if (empty($ex_query)) {
                    $u_data['module_type'] = $module_type;
                    $u_data['module_id'] = $module_id;
                    $u_data['query_type'] = VALUE_TWO;
                    $u_data['user_id'] = $session_user_id;
                    $u_data['created_by'] = $session_user_id;
                    $u_data['created_time'] = date('Y-m-d H:i:s');
                    $u_data['query_datetime'] = $u_data['created_time'];
                    $this->CI->utility_model->insert_data('query', $u_data);
                } else {
                    $u_data['updated_by'] = $session_user_id;
                    $u_data['updated_time'] = date('Y-m-d H:i:s');
                    $u_data['query_datetime'] = $u_data['updated_time'];
                    $this->CI->utility_model->update_data('query_id', $ex_query['query_id'], 'query', $u_data);

                    $this->CI->utility_model->update_data('query_id', $ex_query['query_id'], 'query_document', array('doc_name' => 'Document'));
                }
                $m_data['query_status'] = VALUE_TWO;

                $this->send_email_and_query_response($ex_app_data, $qm_data, $module_id, $module_type, $session_user_id);
            }
        } else {
            $m_data['status'] = $app_module_type;
            if ($app_module_type == VALUE_TWO) {
                $m_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
        }
        return '';
    }

    function send_email_for_query_response($temp_access_data, $module_id, $module_type, $session_user_id) {
        $ex_app_data = $this->CI->utility_model->get_by_id($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text']);
        if (empty($ex_app_data)) {
            return false;
        }
        $this->send_email_and_query_response($ex_app_data, $temp_access_data, $module_id, $module_type, $session_user_id);
    }

    function send_email_and_query_response($ex_app_data, $temp_access_data, $module_id, $module_type, $session_user_id) {
        $district_wise_email_array = $this->CI->config->item('district_wise_email_array');
        $temp_dwea = isset($district_wise_email_array[$module_type]) ? $district_wise_email_array[$module_type] : array();
        if (empty($temp_dwea)) {
            return false;
        }
        if ($module_type == VALUE_NINETEEN || $module_type == VALUE_TWENTYTHREE) {
            $district = isset($ex_app_data['area_of_agency']) ? $ex_app_data['area_of_agency'] : '';
        } else if ($module_type == VALUE_SIX || $module_type == VALUE_TWENTY) {
            $district = isset($ex_app_data['name_of_tourist_area']) ? $ex_app_data['name_of_tourist_area'] : '';
        } else {
            $district = isset($ex_app_data['district']) ? $ex_app_data['district'] : '';
        }
        if ($district != TALUKA_DAMAN && $district != TALUKA_DIU && $district != TALUKA_DNH) {
            return false;
        }
        $user_email = isset($temp_dwea[$district]) ? $temp_dwea[$district] : '';
        if ($user_email != '') {
            $taluka_array = $this->CI->config->item('taluka_array');
            $email_data = array();
            $email_data['email'] = $user_email;
            $email_data['user_id'] = $session_user_id;
            $prefix_module_array = $this->CI->config->item('prefix_module_array');
            $registration_message = '<b>Query Response Received</b>' .
                    '<br><br><b>District : </b>' . $taluka_array[$district] .
                    '<br><b>Department Name : </b>' . (isset($temp_access_data['department_name']) ? $temp_access_data['department_name'] : '') .
                    '<br><b>Service Name : </b>' . (isset($temp_access_data['title']) ? $temp_access_data['title'] : '') .
                    '<br><b>Application Number : </b>' . generate_registration_number($prefix_module_array[$module_type], $module_id);
            $this->CI->load->library('email_lib');
            $this->CI->email_lib->send_email($email_data, 'Query Response Received', $registration_message, VALUE_ELEVEN, $module_type, $module_id);
        }
    }

    function update_module_other_document_items($session_user_id, $module_type, $module_id) {
        $new_mod_items = $this->CI->input->post('new_mod_items');
        $exi_mod_items = $this->CI->input->post('exi_mod_items');
        if ($exi_mod_items != '') {
            if (!empty($exi_mod_items)) {
                foreach ($exi_mod_items as &$value) {
                    $value['updated_by'] = $session_user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->CI->utility_model->update_data_batch('module_other_documents_id', 'module_other_documents', $exi_mod_items);
            }
        }
        if ($new_mod_items != '') {
            if (!empty($new_mod_items)) {
                foreach ($new_mod_items as &$value) {
                    $value['module_type'] = $module_type;
                    $value['module_id'] = $module_id;
                    $value['user_id'] = $session_user_id;
                    $value['created_by'] = $session_user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->CI->utility_model->insert_data_batch('module_other_documents', $new_mod_items);
            }
        }
    }

    function generate_certificate($page_size, $folder_name, $certificate_data, $certificate_name) {
        error_reporting(E_ERROR);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $page_size]);
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($this->CI->load->view("$folder_name/certificate", $certificate_data, TRUE));
        $mpdf->Output($certificate_name . '_' . time() . '.pdf', 'I');
    }

    function gc_for_wm_registration($existing_wmregistration_data) {
        $data = array('wmregistration_data' => $existing_wmregistration_data);
        $this->generate_certificate('Legal', 'wmregistration', $data, 'WM_Registration_certificate');
    }

    function gc_for_hotelregi($existing_hotelregi_data) {
        $data = array('hotelregi_data' => $existing_hotelregi_data);
        $this->generate_certificate('Legal', 'hotelregi', $data, 'hotelregi_certificate_');
    }

    function gc_for_shop($existing_shop_data) {
        $data = array('shop_data' => $existing_shop_data);
        $this->generate_certificate('Legal', 'shop', $data, 'shop_certificate_');
    }

    function gc_for_clact($existing_establishment_data, $establishment_under_all_contractor) {
        $data = array('establishment_data' => $existing_establishment_data, 'establishment_under_all_contractor' => $establishment_under_all_contractor);
        $this->generate_certificate('Legal', 'clact', $data, 'clact_certificate_');
    }

    function gc_for_bocw($existing_bocw_data) {
        $data = array('bocw_data' => $existing_bocw_data);
        $this->generate_certificate('Legal', 'bocw', $data, 'bocw_certificate_');
    }

    function gc_for_migrantworkers($existing_migrantworkers_data) {
        $data = array('migrantworkers_data' => $existing_migrantworkers_data);
        $this->generate_certificate('Legal', 'migrantworkers', $data, 'migrantworkers_certificate_');
    }

    function gc_for_factorylicence($existing_factorylicence_data) {
        $data = array('factorylicence_data' => $existing_factorylicence_data);
        $this->generate_certificate('Legal', 'factorylicense', $data, 'factorylicense_certificate_');
    }

    function gc_for_buildingplan($existing_buildingplan_data) {
        $data = array('buildingplan_data' => $existing_buildingplan_data);
        $this->generate_certificate('Legal', 'buildingplan', $data, 'buildingplan_certificate_');
    }

    function gc_for_boileract($existing_boiler_data) {
        $data = array('boiler_data' => $existing_boiler_data);
        $this->generate_certificate('Legal', 'boileract', $data, 'boileract_certificate_');
    }

    function gc_for_boilermanufacture($existing_boilermanufacture_data) {
        $data = array('boiler_manufacture_data' => $existing_boilermanufacture_data);
        $this->generate_certificate('Legal', 'boilermanufacture', $data, 'boilermanufacture_certificate_');
    }

    function gc_for_singlereturn($existing_singlereturn_data) {
        $data = array('singlereturn_data' => $existing_singlereturn_data);
        $this->generate_certificate('Legal', 'singlereturn', $data, 'singlereturn_certificate_');
    }

    function gc_for_cinema($existing_cinema_data) {
        $data = array('cinema_data' => $existing_cinema_data);
        $this->generate_certificate('Legal', 'cinema', $data, 'cinema_certificate_');
    }

    function gc_for_hotel_renewal($existing_hotel_renewal_data) {
        $data = array('hotel_renewal_data' => $existing_hotel_renewal_data);
        $this->generate_certificate('Legal', 'hotel_renewal', $data, 'hotel_renewal_certificate_');
    }

    function gc_for_tourismevent($existing_tourismevent_data) {
        $data = array('tourismevent_data' => $existing_tourismevent_data);
        $this->generate_certificate('Legal', 'tourismevent', $data, 'tourismevent_certificate_');
    }

    function gc_for_travelagent($existing_travelagent_data) {
        $data = array('travelagent_data' => $existing_travelagent_data);
        $this->generate_certificate('Legal', 'travelagent', $data, 'travelagent_certificate_');
    }

    function gc_for_travelagent_renewal($existing_travelagent_renewal_data) {
        $data = array('travelagent_renewal_data' => $existing_travelagent_renewal_data);
        $this->generate_certificate('Legal', 'travelagent_renewal', $data, 'travelagent_renewal_certificate_');
    }

    function gc_for_wc($existing_wc_data) {
        $data = array('wc_data' => $existing_wc_data);
        $this->generate_certificate('A4', 'wc', $data, 'wc_certificate_');
    }

    function gc_for_repairer($existing_repairer_data) {
        $data = array('repairer_data' => $existing_repairer_data);
        $this->generate_certificate('Legal', 'wmrepairer', $data, 'wmrepairer_certificate_');
    }

    function gc_for_repairer_renewal($existing_repairer_renewal_data) {
        $data = array('repairer_renewal_data' => $existing_repairer_renewal_data);
        $this->generate_certificate('Legal', 'wmrepairer_renewal', $data, 'wmrepairer_renewal_certificate_');
    }

    function gc_for_na($existing_na_data) {
        $data = array('na_data' => $existing_na_data);
        $this->generate_certificate('Legal', 'na', $data, 'na_certificate_');
    }

    function gc_for_shop_renewal($shop_renewal_data, $shop_data, $ex_data) {
        $data = array('shop_renewal_data' => $shop_renewal_data, 'shop_data' => $shop_data, 'ex_data' => $ex_data);
        $this->generate_certificate('Legal', 'shop_renewal', $data, 'shop_renewal_certificate_');
    }

    function gc_for_appli_licence($existing_aplicence_data) {
        $data = array('aplicence_data' => $existing_aplicence_data);
        $this->generate_certificate('Legal', 'aplicence', $data, 'aplicence_certificate_');
    }

    function gc_for_migrantworkers_renewal($existing_migrantworkers_renewal_data) {
        $data = array('migrantworkers_renewal_data' => $existing_migrantworkers_renewal_data);
        $this->generate_certificate('Legal', 'migrantworkers_renewal', $data, 'migrantworkers_renewal_');
    }

    function gc_for_appli_licence_renewal($aplicence_renewal_data, $aplicence_data, $ex_data) {
        $data = array('aplicence_renewal_data' => $aplicence_renewal_data, 'aplicence_data' => $aplicence_data, 'ex_data' => $ex_data);
        $this->generate_certificate('Legal', 'aplicence_renewal', $data, 'aplicence_renewal_certificate_');
    }

    function gc_for_psfregistration($existing_psfregistration_data) {
        $data = array('psfregistration_data' => $existing_psfregistration_data);
        $this->generate_certificate('Legal', 'psfregistration', $data, 'psfregistration_certificate_');
    }

    function gc_for_property($existing_property_data) {
        $data = array('property_data' => $existing_property_data);
        $this->generate_certificate('Legal', 'property', $data, 'property_registration_certificate_');
    }

    function gc_for_filmshooting($existing_filmshooting_data) {
        $data = array('filmshooting_data' => $existing_filmshooting_data);
        $this->generate_certificate('Legal', 'filmshooting', $data, 'filmshooting_data_certificate_');
    }

    function gc_for_textile($existing_textile_data) {
        $data = array('textile_data' => $existing_textile_data);
        $this->generate_certificate('Legal', 'textile', $data, 'textile_certificate_');
    }

    function gc_for_msme($existing_msme_data) {
        $data = array('msme_data' => $existing_msme_data);
        $this->generate_certificate('Legal', 'msme', $data, 'msme_certificate_');
    }

    function gc_for_landallotment($existing_landallotment_data) {
        $data = array('landallotment_data' => $existing_landallotment_data);
        $this->generate_certificate('Legal', 'landallotment', $data, 'landallotment_certificate_');
    }

    function gc_for_construction($existing_construction_data) {
        $data = array('construction_data' => $existing_construction_data);
        $this->generate_certificate('Legal', 'construction', $data, 'construction_certificate_');
    }

    function gc_for_occupancycertificate($existing_occupancycertificate_data) {
        $data = array('occupancycertificate_data' => $existing_occupancycertificate_data);
        $this->generate_certificate('Legal', 'occupancycertificate', $data, 'occupancy_certificate_');
    }

    function gc_for_inspection($existing_inspection_data) {
        $data = array('inspection_data' => $existing_inspection_data);
        $this->generate_certificate('Legal', 'inspection', $data, 'inspection_certificate_');
    }

    function gc_for_site($existing_site_data) {
        $data = array('site_data' => $existing_site_data);
        $this->generate_certificate('Legal', 'site', $data, 'site_elevation_certificate_');
    }

    function gc_for_zone($existing_zone_data) {
        $data = array('zone_data' => $existing_zone_data);
        $this->generate_certificate('Legal', 'zone', $data, 'zone_information_certificate_');
    }

    function gc_for_dealer($existing_dealer_data) {
        $data = array('dealer_data' => $existing_dealer_data);
        $this->generate_certificate('Legal', 'wmdealer', $data, 'dealer_certificate_');
    }

    function gc_for_manufacturer($existing_manufacturer_data) {
        $data = array('manufacturer_data' => $existing_manufacturer_data);
        $this->generate_certificate('Legal', 'wmmanufacturer', $data, 'manufacturer_certificate_');
    }

    function gc_for_noc($existing_noc_data) {
        $data = array('noc_data' => $existing_noc_data);
        $this->generate_certificate('Legal', 'noc', $data, 'noc_certificate_');
    }

    function gc_for_transfer($existing_transfer_data) {
        $data = array('transfer_data' => $existing_transfer_data);
        $this->generate_certificate('Legal', 'transfer', $data, 'transfer_certificate_');
    }

    function gc_for_subletting($existing_subletting_data) {
        $data = array('subletting_data' => $existing_subletting_data);
        $this->generate_certificate('Legal', 'subletting', $data, 'subletting_certificate_');
    }

    function gc_for_dealer_renewal($existing_dealer_renewal_data) {
        $data = array('dealer_renewal_data' => $existing_dealer_renewal_data);
        $this->generate_certificate('Legal', 'wmdealer_renewal', $data, 'dealer_renewal_certificate_');
    }

    function gc_for_manufacturer_renewal($existing_manufacturer_renewal_data) {
        $data = array('manufacturer_renewal_data' => $existing_manufacturer_renewal_data);
        $this->generate_certificate('Legal', 'wmmanufacturer_renewal', $data, 'manufacturer_renewal_certificate_');
    }

    function gc_for_sublessee($existing_sublessee_data) {
        $data = array('sublessee_data' => $existing_sublessee_data);
        $this->generate_certificate('Legal', 'sublessee', $data, 'sub_lessee_certificate_');
    }

    function gc_for_seller($existing_seller_data) {
        $data = array('seller_data' => $existing_seller_data);
        $this->generate_certificate('Legal', 'seller', $data, 'seller_certificate_');
    }

    function gc_for_factorylicence_renewal($existing_factorylicence_renewal_data) {
        $data = array('factorylicence_renewal_data' => $existing_factorylicence_renewal_data);
        $this->generate_certificate('A4', 'factorylicence_renewal', $data, 'factorylicence_renewal_certificate_');
    }

    function gc_for_boiler_renewal($existing_boiler_renewal_data) {
        $data = array('boiler_renewal_data' => $existing_boiler_renewal_data);
        $this->generate_certificate('A4', 'boileract_renewal', $data, 'boileract_renewal_certificate_');
    }

    function gc_for_rii($existing_rii_data) {
        $data = array('rii_data' => $existing_rii_data);
        $this->generate_certificate('Legal', 'rii', $data, 'rii_certificate_');
    }

    function gc_for_vc($existing_vc_data) {
        $data = array('vc_data' => $existing_vc_data);
        $this->generate_certificate('Legal', 'vc', $data, 'vc_certificate_');
    }

    function gc_for_periodicalreturn($existing_periodicalreturn_data) {
        $data = array('periodicalreturn_data' => $existing_periodicalreturn_data);
        $this->generate_certificate('Legal', 'periodicalreturn', $data, 'periodicalreturn_certificate_');
    }

    function calculate_processing_days($module_type, $submitted_datetime) {
        $module_array = $this->CI->config->item('query_module_array');
        $working_days = 'fdw';
        if (isset($module_array[$module_type])) {
            $working_days = isset($module_array[$module_type]['working_days']) ? $module_array[$module_type]['working_days'] : $working_days;
        }
        $temp_hdl = $this->CI->utility_model->get_result_data_by_id($working_days, VALUE_ONE, 'holidaylist');
        $hdl_array = array();
        foreach ($temp_hdl as $hdl) {
            $hdl_ts = strtotime($hdl['holiday_date']);
            if (!isset($hdl_array[$hdl_ts])) {
                $hdl_array[$hdl_ts] = $hdl_ts;
            }
        }
        if ($submitted_datetime == '0000-00-00 00:00:00' || $submitted_datetime == '1999-01-01 00:00:00') {
            return VALUE_ZERO;
        }
        $total_holiday = 0;
        $total_working_days = 0;
        $startDate = new DateTime($submitted_datetime);

        $endDate = new DateTime(date('d-m-Y'));
        while ($startDate <= $endDate) {
            $timestamp = strtotime($startDate->format('d-m-Y'));
            if (isset($hdl_array[$timestamp])) {
                $total_holiday += 1;
            } else {
                $total_working_days += 1;
            }
            $startDate->modify('+1 day');
        }
        return $total_working_days;
    }
}

/**
 * EOF: ./application/libraries/Email_lib.php
 */