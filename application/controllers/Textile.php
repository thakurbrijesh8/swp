<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Textile extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_textile_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['textile_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['textile_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'textile', 'district', $search_district, 'textile_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['textile_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['textile_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_textile_data_by_id() {
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
            $textile_id = get_from_post('textile_id');
            if (!$textile_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $textile_data = $this->utility_model->get_by_id('textile_id', $textile_id, 'textile');
            if (empty($textile_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['textile_data'] = $textile_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_textile() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $textile_id = get_from_post('textile_id_for_textile');
            $textile_data = $this->_get_post_data_for_textile();
            $validation_message = $this->_check_validation_for_textile($textile_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->db->trans_start();
            if (is_array($textile_data['social_status'])) {
                $textile_data['social_status'] = implode(',', $textile_data['social_status']);
            }
            $textile_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $textile_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_array($textile_data['form_application_checklist'])) {
                $textile_data['form_application_checklist'] = implode(',', $textile_data['form_application_checklist']);
            }
            if (!$textile_id || $textile_id == NULL) {
                $textile_data['user_id'] = $user_id;
                $textile_data['created_by'] = $user_id;
                $textile_data['created_time'] = date('Y-m-d H:i:s');
                $textile_id = $this->utility_model->insert_data('textile', $textile_data);
            } else {
                $textile_data['updated_by'] = $user_id;
                $textile_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('textile_id', $textile_id, 'textile', $textile_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TEN, $textile_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $success_array = get_success_array();
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_textile() {
        $textile_data = array();
        $textile_data['district'] = get_from_post('district_for_textile');
        $textile_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $textile_data['enterprise_name'] = get_from_post('enterprise_name_for_textile');
        $textile_data['office_address'] = get_from_post('office_address_for_textile');
        $textile_data['factory_address'] = get_from_post('factory_address_for_textile');
        $textile_data['office_contact_number'] = get_from_post('office_contact_number_for_textile');
        $textile_data['factory_contact_number'] = get_from_post('factory_contact_number_for_textile');
        $textile_data['fax'] = get_from_post('fax_for_textile');
        $textile_data['cellphone'] = get_from_post('cellphone_for_textile');
        $textile_data['email'] = get_from_post('email_for_textile');
        $textile_data['constitution'] = get_from_post('constitution_for_textile');
        $textile_data['promoter_name'] = get_from_post('promoter_name_for_textile');
        $textile_data['promoter_designation'] = get_from_post('promoter_designation_for_textile');
        $textile_data['promoter_contact_number'] = get_from_post('promoter_contact_number_for_textile');
        $textile_data['promoter_email'] = get_from_post('promoter_email_for_textile');
        $textile_data['social_status'] = $this->input->post('social_status_for_textile');
        $textile_data['ap_name'] = get_from_post('ap_name_for_textile');
        $textile_data['ap_designation'] = get_from_post('ap_designation_for_textile');
        $textile_data['ap_contact_number'] = get_from_post('ap_contact_number_for_textile');
        $textile_data['ap_email'] = get_from_post('ap_email_for_textile');
        $textile_data['unit_type'] = get_from_post('unit_type_for_textile');
        $textile_data['form_application_checklist'] = $this->input->post('form_application_checklist_for_textile') ? $this->input->post('form_application_checklist_for_textile') : '';
        return $textile_data;
    }

    function _check_validation_for_textile($textile_data) {
        if (!$textile_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$textile_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$textile_data['enterprise_name']) {
            return ENTERPRISE_NAME_MESSAGE;
        }
        if (!$textile_data['office_address']) {
            return OFFICE_ADDRESS_MESSAGE;
        }
        if (!$textile_data['factory_address']) {
            return FACTORY_ADDRESS_MESSAGE;
        }
        if (!$textile_data['office_contact_number']) {
            return OFFICE_CONTACT_NO_MESSAGE;
        }
        if (!$textile_data['factory_contact_number']) {
            return FACTORY_CONTACT_NO_MESSAGE;
        }
        if (!$textile_data['constitution']) {
            return SELECT_ONE_OPTION_MESSAGE;
        }
        if (!$textile_data['promoter_name']) {
            return PROMOTER_NAME_MESSAGE;
        }
        if (!$textile_data['promoter_designation']) {
            return PROMOTER_DESIGNATION_MESSAGE;
        }
        if (!$textile_data['social_status']) {
            return SELECT_ONE_OPTION_MESSAGE;
        }
        if (!$textile_data['ap_name']) {
            return AP_NAME_MESSAGE;
        }
        if (!$textile_data['ap_designation']) {
            return AP_DESIGNATION_MESSAGE;
        }
        if (!$textile_data['unit_type']) {
            return SELECT_ONE_OPTION_MESSAGE;
        }
        return '';
    }

    function get_textile_data_by_textile_id() {
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
            $textile_id = get_from_post('textile_id');
            if (!$textile_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $textile_data = $this->utility_model->get_by_id('textile_id', $textile_id, 'textile');
            if (empty($textile_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TEN, $textile_id, $textile_data);
            $textile_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TEN, 'fees_bifurcation', 'module_id', $textile_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['textile_data'] = $textile_data;
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
            $textile_id = get_from_post('textile_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$textile_id || $textile_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('textile_id', $textile_id, 'textile');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'textile' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('textile_id', $textile_id, 'textile', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $textile_id = get_from_post('textile_id_for_textile_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $textile_id == NULL || !$textile_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_textile_data = $this->utility_model->get_by_id('textile_id', $textile_id, 'textile');
            if (empty($ex_textile_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
             if ($ex_textile_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_textile_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_textile_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $textile_data = array();
            if ($_FILES['fees_paid_challan_for_textile_upload_challan']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'wmtextile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_textile_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_textile_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['status'] = VALUE_FOUR;
                $textile_data['fees_paid_challan'] = $filename;
                $textile_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_textile_data['payment_type'] == VALUE_TWO) {
                $textile_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $textile_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $textile_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TEN, $textile_id, $ex_textile_data['district'], $ex_textile_data['total_fees'], $textile_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $textile_data['user_payment_type'] = $user_payment_type;
            } else {
                $textile_data['user_payment_type'] = VALUE_ZERO;
            }
            $textile_data['updated_by'] = $user_id;
            $textile_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('textile_id', $textile_id, 'textile', $textile_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($textile_data['status']) ? $textile_data['status'] : $ex_textile_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_textile_data['payment_type'];
            $success_array['user_payment_type'] = $textile_data['user_payment_type'];
            if ($ex_textile_data['payment_type'] == VALUE_TWO && $textile_data['user_payment_type'] == VALUE_THREE) {
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

    function generate_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $textile_id = get_from_post('textile_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $textile_id == null || !$textile_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_textile_data = $this->utility_model->get_by_id('textile_id', $textile_id, 'textile');
            if (empty($existing_textile_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_textile_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_textile($existing_textile_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_textile_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $textile_id = get_from_post('textile_id_for_textile');
            $file_no = get_from_post('file_number_for_textile');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $textile_document_array = $this->config->item('textile_document_array');
            if (!isset($textile_document_array[$file_no])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $field_name = $textile_document_array[$file_no];
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
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['document_file']['name']);
                $filename = "textile_doc_" . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['document_file']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data[$field_name] = $filename;
            }
            if (!$textile_id) {
                $textile_data['user_id'] = $session_user_id;
                $textile_data['status'] = VALUE_ONE;
                $textile_data['created_by'] = $session_user_id;
                $textile_data['created_time'] = date('Y-m-d H:i:s');
                $textile_id = $this->utility_model->insert_data('textile', $textile_data);
            } else {
                $textile_data['updated_by'] = $session_user_id;
                $textile_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('textile_id', $textile_id, 'textile', $textile_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['textile_data'] = array('file_name' => $filename, 'textile_id' => $textile_id);
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
            $textile_id = get_from_post('textile_id_for_textile');
            $file_no = get_from_post('file_number_for_textile');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $textile_document_array = $this->config->item('textile_document_array');
            if (!isset($textile_document_array[$file_no])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $field_name = $textile_document_array[$file_no];
            $this->db->trans_start();
            $ex_textile_data = $this->utility_model->get_by_id('textile_id', $textile_id, 'textile');
            if (empty($ex_textile_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'textile' . DIRECTORY_SEPARATOR . $ex_textile_data[$field_name];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('textile_id', $textile_id, 'textile', array($field_name => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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

}

/*
 * EOF: ./application/controller/BOCW.php
 */