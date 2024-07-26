<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ips extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_ips_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['ips_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $success_array['ips_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'ips');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['ips_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['ips_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_ips_data_by_id() {
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
            $ips_id = get_from_post('ips_id');
            if (!$ips_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ips_data = $this->utility_model->get_by_id('ips_id', $ips_id, 'ips');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($ips_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['ips_data'] = $ips_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_ips() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ips_id = get_from_post('ips_id_for_ips');
            $ips_data = $this->_get_post_data_for_ips();
            $validation_message = $this->_check_validation_for_ips($ips_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            if (is_array($ips_data['entrepreneur_category'])) {
                if (in_array(VALUE_THREE, $ips_data['entrepreneur_category'])) {
                    $ips_data['birth_date'] = $ips_data['birth_date'] != '' ? convert_to_mysql_date_format($ips_data['birth_date']) : '';
                }
            } else {
                if ($ips_data['entrepreneur_category'] == VALUE_THREE) {
                    $ips_data['birth_date'] = $ips_data['birth_date'] != '' ? convert_to_mysql_date_format($ips_data['birth_date']) : '';
                }
            }
            if (is_array($ips_data['entrepreneur_category'])) {
                $ips_data['entrepreneur_category'] = implode(',', $ips_data['entrepreneur_category']);
            }
            if (is_array($ips_data['unit_type'])) {
                $ips_data['unit_type'] = implode(',', $ips_data['unit_type']);
            }
            if (is_array($ips_data['thrust_sectors'])) {
                $ips_data['thrust_sectors'] = implode(',', $ips_data['thrust_sectors']);
            }
            $ips_data['commencement_date'] = $ips_data['commencement_date'] != '' ? convert_to_mysql_date_format($ips_data['commencement_date']) : '';
            $this->db->trans_start();
            if (!$ips_id || $ips_id == NULL) {
                $ips_data['user_id'] = $user_id;
                $ips_data['created_by'] = $user_id;
                $ips_data['created_time'] = date('Y-m-d H:i:s');
                $ips_id = $this->utility_model->insert_data('ips', $ips_data);
            } else {
                $ips_data['updated_by'] = $user_id;
                $ips_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('ips_id', $ips_id, 'ips', $ips_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_SUBMITTED_MESSAGE;
            $success_array['ips_id'] = $ips_id;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_ips() {
        $ips_data = array();
        $ips_data['district'] = get_from_post('district_for_ips');
        $ips_data['owner_name'] = get_from_post('owner_name_for_ips');
        $ips_data['owner_category'] = get_from_post('owner_category_for_ips');
        $ips_data['email'] = get_from_post('email_for_ips');
        $ips_data['mobile_no'] = get_from_post('mobile_no_for_ips');
        $ips_data['aadhar_no'] = get_from_post('aadhar_no_for_ips');
        $ips_data['pan_no'] = strtoupper(get_from_post('pan_no_for_ips'));
        $ips_data['caste_category'] = get_from_post('caste_category_for_ips');
        $ips_data['ap_name'] = get_from_post('ap_name_for_ips');
        $ips_data['ap_designation'] = get_from_post('ap_designation_for_ips');
        $ips_data['ap_email'] = get_from_post('ap_email_for_ips');
        $ips_data['ap_mobile'] = get_from_post('ap_mobile_for_ips');
        $ips_data['udyam_registration'] = get_from_post('udyam_registration_for_ips');
        $ips_data['regi_details'] = get_from_post('regi_details_for_ips');
        $ips_data['ur_cin_no'] = get_from_post('ur_cin_no_for_ips');
        $ips_data['ur_tin_no'] = get_from_post('ur_tin_no_for_ips');
        $ips_data['ur_pan_no'] = strtoupper(get_from_post('ur_pan_no_for_ips'));
        $ips_data['ur_gst_no'] = get_from_post('ur_gst_no_for_ips');
        $ips_data['ur_other_reg_no'] = get_from_post('ur_other_reg_no_for_ips');
        $ips_data['manu_name'] = get_from_post('manu_name_for_ips');
        $ips_data['main_plant_address'] = get_from_post('main_plant_address_for_ips');
        $ips_data['office_address'] = get_from_post('office_address_for_ips');
        $ips_data['latitude'] = get_from_post('latitude_for_ips');
        $ips_data['longitude'] = get_from_post('longitude_for_ips');
        $ips_data['constitution'] = get_from_post('constitution_for_ips');
        if ($ips_data['constitution'] == VALUE_FIVE) {
            $ips_data['other_constitution'] = get_from_post('other_constitution_for_ips');
        }
        $ips_data['unit_category'] = get_from_post('unit_category_for_ips');
        if ($ips_data['unit_category'] == VALUE_ONE) {
            $ips_data['msme_category'] = get_from_post('msme_category_for_ips');
        }
        $ips_data['entrepreneur_category'] = $this->input->post('entrepreneur_category_for_ips');
        if (is_array($ips_data['entrepreneur_category'])) {
            if (in_array(VALUE_THREE, $ips_data['entrepreneur_category'])) {
                $ips_data['birth_date'] = get_from_post('birth_date_for_ips');
            }
        } else {
            if ($ips_data['entrepreneur_category'] == VALUE_THREE) {
                $ips_data['birth_date'] = get_from_post('birth_date_for_ips');
            }
        }
        $ips_data['unit_type'] = $this->input->post('unit_type_for_ips');
        if (is_array($ips_data['unit_type'])) {
            if (in_array(VALUE_FIVE, $ips_data['unit_type'])) {
                $ips_data['manufacuring_unit'] = get_from_post('manufacuring_unit_for_ips');
                $ips_data['diversification_unit'] = get_from_post('diversification_unit_for_ips');
            }
            if (in_array(VALUE_SIX, $ips_data['unit_type'])) {
                $ips_data['service_unit'] = get_from_post('service_unit_for_ips');
                $ips_data['diversification_service'] = get_from_post('diversification_service_for_ips');
            }
        } else {
            if ($ips_data['unit_type'] == VALUE_FIVE) {
                $ips_data['manufacuring_unit'] = get_from_post('manufacuring_unit_for_ips');
                $ips_data['diversification_unit'] = get_from_post('diversification_unit_for_ips');
            }
            if ($ips_data['unit_type'] == VALUE_SIX) {
                $ips_data['service_unit'] = get_from_post('service_unit_for_ips');
                $ips_data['diversification_service'] = get_from_post('diversification_service_for_ips');
            }
        }
        $ips_data['sector_category'] = get_from_post('sector_category_for_ips');
        $ips_data['thrust_sectors'] = $this->input->post('thrust_sectors_for_ips');
        $ips_data['commencement_date'] = get_from_post('commencement_date_for_ips');
        $ips_data['gfc_investment'] = get_from_post('gfc_investment_for_ips');
        return $ips_data;
    }

    function _check_validation_for_ips($ips_data) {
        if (!$ips_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$ips_data['owner_name']) {
            return OWNER_NAME_MESSAGE;
        }
        if (!$ips_data['owner_category']) {
            return ONE_OPTION_MESSAGE;
        }
        if (!$ips_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$ips_data['mobile_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$ips_data['pan_no']) {
            return PAN_NO_MESSAGE;
        }
        if (!$ips_data['caste_category']) {
            return ONE_OPTION_MESSAGE;
        }
        if (!$ips_data['ap_name']) {
            return AP_NAME_MESSAGE;
        }
        if (!$ips_data['ap_designation']) {
            return AP_DESIGNATION_MESSAGE;
        }
        if (!$ips_data['ap_email']) {
            return EMAIL_MESSAGE;
        }
        if (!$ips_data['ap_mobile']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$ips_data['udyam_registration']) {
            return FACTORY_REGISTRATION_NUMBER_MESSAGE;
        }
        if (!$ips_data['ur_pan_no']) {
            return PAN_NO_MESSAGE;
        }
        if (!$ips_data['manu_name']) {
            return MANUFACTURER_NAME_MESSAGE;
        }
        if (!$ips_data['main_plant_address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$ips_data['office_address']) {
            return OFFICE_ADDRESS_MESSAGE;
        }
        if (!$ips_data['office_address']) {
            return OFFICE_ADDRESS_MESSAGE;
        }
        if (!$ips_data['constitution']) {
            return CONSTITUTION_MESSAGE;
        }
        if ($ips_data['constitution'] == VALUE_FIVE) {
            if (!$ips_data['other_constitution']) {
                return DETAILS_MESSAGE;
            }
        }
        if (!$ips_data['unit_category']) {
            return ONE_OPTION_MESSAGE;
        }
        if ($ips_data['unit_category'] == VALUE_ONE) {
            if (!$ips_data['msme_category']) {
                return ONE_OPTION_MESSAGE;
            }
        }
        if (is_array($ips_data['entrepreneur_category'])) {
            if (in_array(VALUE_THREE, $ips_data['entrepreneur_category'])) {
                if (!$ips_data['birth_date']) {
                    return DATE_MESSAGE;
                }
            }
        } else {
            if ($ips_data['entrepreneur_category'] == VALUE_THREE) {
                if (!$ips_data['birth_date']) {
                    return DATE_MESSAGE;
                }
            }
        }
        if (!$ips_data['unit_type']) {
            return ONE_OPTION_MESSAGE;
        }
        if (is_array($ips_data['unit_type'])) {
            if (in_array(VALUE_FIVE, $ips_data['unit_type'])) {
                if (!$ips_data['manufacuring_unit'] || !$ips_data['diversification_unit']) {
                    return DETAILS_MESSAGE;
                }
            }
            if (in_array(VALUE_SIX, $ips_data['unit_type'])) {
                if (!$ips_data['service_unit'] || !$ips_data['diversification_service']) {
                    return DETAILS_MESSAGE;
                }
            }
        } else {
            if ($ips_data['unit_type'] == VALUE_FIVE) {
                if (!$ips_data['manufacuring_unit'] || !$ips_data['diversification_unit']) {
                    return DETAILS_MESSAGE;
                }
            }
            if ($ips_data['unit_type'] == VALUE_SIX) {
                if (!$ips_data['service_unit'] || !$ips_data['diversification_service']) {
                    return DETAILS_MESSAGE;
                }
            }
        }
        if (!$ips_data['sector_category']) {
            return ONE_OPTION_MESSAGE;
        }
        if (!$ips_data['commencement_date']) {
            return DATE_MESSAGE;
        }
        if (!$ips_data['gfc_investment']) {
            return INVESTMENT_MESSAGE;
        }
        return '';
    }

    function upload_ips_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ips_id = get_from_post('ips_id_for_ips');
            $file_no = get_from_post('file_number_for_ips');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ips_document_array = $this->config->item('ips_document_array');
            if (!isset($ips_document_array[$file_no])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $field_name = $ips_document_array[$file_no];
            if ($_FILES['document_file']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $evidence_size = $_FILES['document_file']['size'];
            if ($evidence_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $this->db->trans_start();
            if ($_FILES['document_file']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'ips';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['document_file']['name']);
                $filename = "ips_doc_" . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['document_file']['tmp_name'], $final_path)) {
                    echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $ips_data[$field_name] = $filename;
            }
            if (!$ips_id) {
                $ips_data['user_id'] = $session_user_id;
                $ips_data['created_by'] = $session_user_id;
                $ips_data['created_time'] = date('Y-m-d H:i:s');
                $ips_id = $this->utility_model->insert_data('ips', $ips_data);
            } else {
                $ips_data['updated_by'] = $session_user_id;
                $ips_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('ips_id', $ips_id, 'ips', $ips_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['ips_data'] = array('file_name' => $filename, 'ips_id' => $ips_id);
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function remove_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id_for_ips');
            $file_no = get_from_post('file_number_for_ips');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ips_document_array = $this->config->item('ips_document_array');
            if (!isset($ips_document_array[$file_no])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $field_name = $ips_document_array[$file_no];
            $this->db->trans_start();
            $ex_ips_data = $this->utility_model->get_by_id('ips_id', $ips_id, 'ips');
            if (empty($ex_ips_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'ips' . DIRECTORY_SEPARATOR . $ex_ips_data[$field_name];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('ips_id', $ips_id, 'ips', array($field_name => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_incentives_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id');
            $success_array = get_success_array();
            $success_array['incentives_data'] = array();
            if ($session_user_id == NULL || !$session_user_id || $ips_id == NULL || !$ips_id) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $success_array['incentives_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'ips_incentive', 'ips_id', $ips_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['incentives_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['incentives_data'] = array();
            echo json_encode($success_array);
        }
    }

    function submit_incentives() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id');
            $module_type = get_from_post('module_type');
            $ips_incentive_id = get_from_post('ips_incentive_id_for_incentives');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $ips_id == NULL || !$ips_id ||
                    ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_FIVE) ||
                    $ips_incentive_id == NULL || !$ips_incentive_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_inc = $this->utility_model->get_by_id('ips_incentive_id', $ips_incentive_id, 'ips_incentive', 'ips_id', $ips_id);
            if (empty($ex_inc)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $exi_od_items = $this->input->post('exi_od_items');

            $incentives_data = array();
            $is_validation = $this->utility_lib->app_edit_and_query_response($session_user_id, $module_type, VALUE_FIFTYTWO, $ips_incentive_id, $incentives_data);
            if ($is_validation != '') {
                echo json_encode(get_error_array($is_validation));
                return false;
            }
            $this->db->trans_start();
            $incentives_data['updated_by'] = $session_user_id;
            $incentives_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ips_incentive_id', $ips_incentive_id, 'ips_incentive', $incentives_data);

            $this->_update_od_items($session_user_id, $exi_od_items);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($session_user_id, VALUE_SIX, VALUE_FIFTYTWO, $ips_incentive_id);
            }
            $success_array = get_success_array();
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _update_od_items($session_user_id, $exi_od_items) {
        if ($exi_od_items != '') {
            if (!empty($exi_od_items)) {
                foreach ($exi_od_items as &$edrdi) {
                    $edrdi['updated_by'] = $session_user_id;
                    $edrdi['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('ips_incentive_od_id', 'ips_incentive_od', $exi_od_items);
            }
        }
    }

    function get_incentive_data_by_id() {
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
            $ips_incentive_id = get_from_post('ips_incentive_id');
            if (!$ips_incentive_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $incentive_data = $this->utility_model->get_incentive_details_by_id($ips_incentive_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($incentive_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $is_edit = get_from_post('is_edit');
            if ($is_edit == VALUE_ZERO) {
                if ($incentive_data['status'] != VALUE_ZERO && $incentive_data['status'] != VALUE_ONE) {
                    if ($incentive_data['status'] == VALUE_FIVE || $incentive_data['status'] == VALUE_SIX || $incentive_data['query_status'] != VALUE_ONE) {
                        echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                        return false;
                    }
                }
            }
            $inc_doc_details = generate_array_for_id_object($this->utility_model->get_result_data_by_id('ips_incentive_id', $ips_incentive_id, 'ips_incentive_doc', 'ips_id', $incentive_data['ips_id']), 'doc_id');
            $inc_other_doc_details = $this->utility_model->get_result_data_by_id('ips_incentive_id', $ips_incentive_id, 'ips_incentive_od', 'ips_id', $incentive_data['ips_id']);
            $success_array = get_success_array();
            $incentive_data['doc_details'] = $inc_doc_details;
            $incentive_data['other_doc_details'] = $inc_other_doc_details;
            $success_array['incentive_data'] = $incentive_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_incentives_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id_for_incentives');
            $doc_id = get_from_post('doc_id_for_incentives');
            if (!is_post() || $session_user_id == null || !$session_user_id || $ips_id == NULL || !$ips_id ||
                    $doc_id == NULL || !$doc_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ips_incentive_id = get_from_post('ips_incentive_id_for_incentives');
            $scheme_type = get_from_post('scheme_type_for_incentives');
            $scheme = get_from_post('scheme_for_incentives');
            if (!$scheme_type || !$scheme) {
                echo json_encode(array('success' => FALSE, 'message' => ONE_OPTION_MESSAGE));
                return false;
            }
            if ($_FILES['document_file']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $doc_size = $_FILES['document_file']['size'];
            if ($doc_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'ips_inc';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['document_file']['name']);
            $inc_doc_name = $ips_id . "_" . $scheme_type . "_" . $scheme_type . "_" . $doc_id . "_doc_" . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $module_path . DIRECTORY_SEPARATOR . $inc_doc_name;
            if (!move_uploaded_file($_FILES['document_file']['tmp_name'], $final_path)) {
                echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $incentives_data = array();
            $incentives_data['scheme_type'] = $scheme_type;
            $incentives_data['scheme'] = $scheme;
            if (!$ips_incentive_id) {
                $incentives_data['user_id'] = $session_user_id;
                $incentives_data['ips_id'] = $ips_id;
                $incentives_data['status'] = VALUE_ONE;
                $incentives_data['created_by'] = $session_user_id;
                $incentives_data['created_time'] = date('Y-m-d H:i:s');
                $ips_incentive_id = $this->utility_model->insert_data('ips_incentive', $incentives_data);
            } else {
                $incentives_data['updated_by'] = $session_user_id;
                $incentives_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('ips_incentive_id', $ips_incentive_id, 'ips_incentive', $incentives_data);
            }
            $doc_data = array();
            $doc_data['ips_incentive_id'] = $ips_incentive_id;
            $doc_data['user_id'] = $session_user_id;
            $doc_data['ips_id'] = $ips_id;
            $doc_data['doc_id'] = $doc_id;
            $doc_data['doc_name'] = $inc_doc_name;
            $doc_data['created_by'] = $session_user_id;
            $doc_data['created_time'] = date('Y-m-d H:i:s');
            $this->utility_model->insert_data('ips_incentive_doc', $doc_data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['ips_data'] = array('doc_name' => $inc_doc_name, 'ips_incentive_id' => $ips_incentive_id);
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function remove_incentives_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id_for_incentives');
            $ips_incentive_id = get_from_post('ips_incentive_id_for_incentives');
            $doc_id = get_from_post('doc_id_for_incentives');
            if (!is_post() || $session_user_id == null || !$session_user_id || $ips_id == NULL || !$ips_id ||
                    $ips_incentive_id == NULL || !$ips_incentive_id || $doc_id == NULL || !$doc_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_ips_inc_doc_data = $this->utility_model->get_by_id('user_id', $session_user_id, 'ips_incentive_doc', 'ips_id', $ips_id, 'ips_incentive_id', $ips_incentive_id, 'doc_id', $doc_id);
            if (empty($ex_ips_inc_doc_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'ips_inc' . DIRECTORY_SEPARATOR . $ex_ips_inc_doc_data['doc_name'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->db->trans_start();
            $this->utility_model->update_data('ips_incentive_doc_id', $ex_ips_inc_doc_data['ips_incentive_doc_id'], 'ips_incentive_doc', array('is_delete' => VALUE_ONE, 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function get_incentive_with_ips_data_by_id() {
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
            $ips_incentive_id = get_from_post('ips_incentive_id');
            if (!$ips_incentive_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $incentive_data = $this->utility_model->get_incentive_details_by_id($ips_incentive_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($incentive_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FIFTYTWO, $ips_incentive_id, $incentive_data);
            $incentive_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FIFTYTWO, 'fees_bifurcation', 'module_id', $ips_incentive_id);
            $success_array = get_success_array();
            $success_array['incentive_data'] = $incentive_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function remove_fees_paid_challan() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_incentive_id = get_from_post('ips_incentive_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$ips_incentive_id || $ips_incentive_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('ips_incentive_id', $ips_incentive_id, 'ips_incentive');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'ips_inc' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('ips_incentive_id', $ips_incentive_id, 'ips_incentive', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_fees_paid_challan() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            $ips_incentive_id = get_from_post('ips_incentive_id_for_incentives_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $ips_incentive_id == NULL || !$ips_incentive_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_incentives_data = $this->utility_model->get_incentive_details_by_id($ips_incentive_id);
            if (empty($ex_incentives_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_incentives_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_incentives_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_incentives_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $incentives_data = array();
            if ($_FILES['fees_paid_challan_for_incentives_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'ips_inc';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_incentives_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_incentives_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $incentives_data['status'] = VALUE_FOUR;
                $incentives_data['fees_paid_challan'] = $filename;
                $incentives_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_incentives_data['payment_type'] == VALUE_TWO) {
                $incentives_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $incentives_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $incentives_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FIFTYTWO, $ips_incentive_id, $ex_incentives_data['district'], $ex_incentives_data['total_fees'], $incentives_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $incentives_data['user_payment_type'] = $user_payment_type;
            } else {
                $incentives_data['user_payment_type'] = VALUE_ZERO;
            }
            $incentives_data['updated_by'] = $user_id;
            $incentives_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('ips_incentive_id', $ips_incentive_id, 'ips_incentive', $incentives_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($incentives_data['status']) ? $incentives_data['status'] : $ex_incentives_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_incentives_data['payment_type'];
            $success_array['user_payment_type'] = $incentives_data['user_payment_type'];
            if ($ex_incentives_data['payment_type'] == VALUE_TWO && $incentives_data['user_payment_type'] == VALUE_THREE) {
                $success_array['op_mmptd'] = $enc_pg_data['op_mmptd'];
                $success_array['op_enct'] = $enc_pg_data['op_enct'];
                $success_array['op_mt'] = $enc_pg_data['op_mt'];
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_other_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id_for_incentives');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$ips_id || $ips_id == null) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ips_incentive_id = get_from_post('ips_incentive_id_for_incentives');
            $scheme_type = get_from_post('scheme_type_for_incentives');
            $scheme = get_from_post('scheme_for_incentives');
            if (!$scheme_type || !$scheme) {
                echo json_encode(array('success' => FALSE, 'message' => ONE_OPTION_MESSAGE));
                return false;
            }
            $ips_incentive_od_id = get_from_post('ips_incentive_od_id_for_iod');
            if ($_FILES['document_for_iod']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $od_size = $_FILES['document_for_iod']['size'];
            if ($od_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $maxsize = '104857600';
            if ($od_size >= $maxsize) {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_MAX_TEN_MB_MESSAGE));
                return;
            }
            $path = 'documents';
            if (!is_dir($path)) {
                mkdir($path);
                chmod("$path", 0755);
            }
            $main_path = $path . DIRECTORY_SEPARATOR . 'ips_inc';
            if (!is_dir($main_path)) {
                mkdir($main_path);
                chmod("$main_path", 0755);
            }
            $this->load->library('upload');
            $temp_od_filename = str_replace('_', '', $_FILES['document_for_iod']['name']);
            $od_filename = $ips_id . "_" . $scheme_type . "_" . $scheme_type . "_other_doc_" . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_od_filename, PATHINFO_EXTENSION);

            //Change file name
            $od_final_path = $main_path . DIRECTORY_SEPARATOR . $od_filename;
            if (!move_uploaded_file($_FILES['document_for_iod']['tmp_name'], $od_final_path)) {
                echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $incentives_data = array();
            $incentives_data['scheme_type'] = $scheme_type;
            $incentives_data['scheme'] = $scheme;
            if (!$ips_incentive_id || $ips_incentive_id == null) {
                $incentives_data['user_id'] = $session_user_id;
                $incentives_data['ips_id'] = $ips_id;
                $incentives_data['status'] = VALUE_ONE;
                $incentives_data['created_by'] = $session_user_id;
                $incentives_data['created_time'] = date('Y-m-d H:i:s');
                $ips_incentive_id = $this->utility_model->insert_data('ips_incentive', $incentives_data);
            }
            $od_data = array();
            $od_data['document'] = $od_filename;
            if (!$ips_incentive_od_id || $ips_incentive_od_id == NULL) {
                $od_data['ips_incentive_id'] = $ips_incentive_id;
                $od_data['user_id'] = $ips_id;
                $od_data['ips_id'] = $ips_id;
                $od_data['created_by'] = $session_user_id;
                $od_data['created_time'] = date('Y-m-d H:i:s');
                $ips_incentive_od_id = $this->utility_model->insert_data('ips_incentive_od', $od_data);
            } else {
                $od_data['updated_by'] = $session_user_id;
                $od_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('ips_incentive_od_id', $ips_incentive_od_id, 'ips_incentive_od', $od_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['ips_incentive_id'] = $ips_incentive_id;
            $success_array['ips_incentive_od_id'] = $ips_incentive_od_id;
            $success_array['document_name'] = $od_filename;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function remove_other_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id');
            $ips_incentive_id = get_from_post('ips_incentive_id');
            $ips_incentive_od_id = get_from_post('ips_incentive_od_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || $ips_id == null || !$ips_id ||
                    $ips_incentive_id == null || !$ips_incentive_id || $ips_incentive_od_id == null || !$ips_incentive_od_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('ips_incentive_od_id', $ips_incentive_od_id, 'ips_incentive_od', 'ips_incentive_id', $ips_incentive_id, 'ips_id', $ips_id);
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            if ($ex_data['document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'ips_inc' . DIRECTORY_SEPARATOR . $ex_data['document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['document'] = '';
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ips_incentive_od_id', $ips_incentive_od_id, 'ips_incentive_od', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function remove_other_doc_item() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $ips_id = get_from_post('ips_id');
            $ips_incentive_id = get_from_post('ips_incentive_id');
            $ips_incentive_od_id = get_from_post('ips_incentive_od_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || $ips_id == null || !$ips_id ||
                    $ips_incentive_id == null || !$ips_incentive_id || $ips_incentive_od_id == null || !$ips_incentive_od_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('ips_incentive_od_id', $ips_incentive_od_id, 'ips_incentive_od', 'ips_incentive_id', $ips_incentive_id, 'ips_id', $ips_id);
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            if ($ex_data['document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'ips_inc' . DIRECTORY_SEPARATOR . $ex_data['document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['is_delete'] = IS_DELETE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ips_incentive_od_id', $ips_incentive_od_id, 'ips_incentive_od', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_ITEM_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/BOCW.php
 */
