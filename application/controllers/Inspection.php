<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inspection extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_inspection_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['inspection_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['inspection_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'inspection', 'district', $search_district, 'inspection_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['inspection_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['inspection_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_inspection_data_by_id() {
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
            $inspection_id = get_from_post('inspection_id');
            if (!$inspection_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $inspection_data = $this->utility_model->get_by_id('inspection_id', $inspection_id, 'inspection');
            if (empty($inspection_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['inspection_data'] = $inspection_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_inspection() {
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
            $inspection_id = get_from_post('inspection_id');
            $inspection_data = $this->_get_post_data_for_inspection();
            $validation_message = $this->_check_validation_for_inspection($inspection_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();

            $inspection_data['application_date'] = convert_to_mysql_date_format($inspection_data['application_date']);
           $inspection_data['valid_upto_date'] = $inspection_data['valid_upto_date'] != '' ? convert_to_mysql_date_format($inspection_data['valid_upto_date']) : '';
            $inspection_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $inspection_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$inspection_id || $inspection_id == NULL) {
                $inspection_data['user_id'] = $user_id;
                $inspection_data['application_date'] = date('Y-m-d');
                $inspection_data['created_by'] = $user_id;
                $inspection_data['created_time'] = date('Y-m-d H:i:s');
                $inspection_id = $this->utility_model->insert_data('inspection', $inspection_data);
            } else {
                $inspection_data['updated_by'] = $user_id;
                $inspection_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('inspection_id', $inspection_id, 'inspection', $inspection_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYSEVEN, $inspection_id);
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

    function _get_post_data_for_inspection() {
        $inspection_data = array();
        $inspection_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $inspection_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $inspection_data['address'] = get_from_post('address');
        $inspection_data['application_date'] = get_from_post('application_date');
        $inspection_data['plinth_column'] = get_from_post('plinth_column');
        $inspection_data['plot_no'] = get_from_post('plot_no');
        $inspection_data['communication_number'] = get_from_post('communication_number');       
        $inspection_data['name_licensed'] = get_from_post('name_licensed');
        $inspection_data['registration_no'] = get_from_post('registration_no');
        $inspection_data['valid_upto_date'] = get_from_post('valid_upto_date');
        $inspection_data['district'] = get_from_post('district');
        $inspection_data['village'] = get_from_post('village'); 
        return $inspection_data;
    }

    function _check_validation_for_inspection($inspection_data) {
        if (!$inspection_data['district']) {
            return OWNER_DisTRICT_MESSAGE;
        }
        if (!$inspection_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$inspection_data['communication_number']) {
            return COMMUNICATION_MESSAGE;
        }
        if (!$inspection_data['name_licensed']) {
            return Licensed_NAME_MESSAGE;
        }
        if (!$inspection_data['address']) {
            return fULL_ADDRESS_MESSAGE;
        }
        if (!$inspection_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$inspection_data['application_date']) {
            return APPLICATION_DATE_MESSAGE;
        }
        if (!$inspection_data['village']) {
            return VILLAGE_MESSAGE;
        }


        return '';
    }

    function remove_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $inspection_id = get_from_post('inspection_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$inspection_id || $inspection_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('inspection_id', $inspection_id, 'inspection');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            if ($document_type == VALUE_ONE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'inspection' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature_architecture'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'inspection' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_seal'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'inspection' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['annexure_9'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'inspection' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['approved_license'];
            }
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('inspection_id', $inspection_id, 'inspection', array('signature_architecture' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('inspection_id', $inspection_id, 'inspection', array('sign_seal' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('inspection_id', $inspection_id, 'inspection', array('annexure_9' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('inspection_id', $inspection_id, 'inspection', array('approved_license' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $inspection_id = get_from_post('inspection_id_for_inspection_form1');
            if (!is_post() || $user_id == null || !$user_id || $inspection_id == null || !$inspection_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_inspection_data = $this->utility_model->get_by_id('inspection_id', $inspection_id, 'inspection');

            if (empty($existing_inspection_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('inspection_data' => $existing_inspection_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('inspection/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_inspection_data_by_inspection_id() {
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
            $inspection_id = get_from_post('inspection_id');
            if (!$inspection_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $inspection_data = $this->utility_model->get_by_id('inspection_id', $inspection_id, 'inspection');
            if (empty($inspection_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $inspection_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWENTYSEVEN, 'fees_bifurcation', 'module_id', $inspection_id);
            $this->db->trans_complete();
            $success_array = get_success_array();
            $success_array['inspection_data'] = $inspection_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $inspection_id = get_from_post('inspection_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $inspection_id == null || !$inspection_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_inspection_data = $this->utility_model->get_by_id('inspection_id', $inspection_id, 'inspection');
            if (empty($existing_inspection_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_inspection_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_inspection($existing_inspection_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_inspection_document() {
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
            $inspection_id = get_from_post('inspection_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $inspection_data = $this->utility_model->upload_document('signature_architecture_for_inspection', 'inspection', 'signature_architecture_', 'signature_architecture');
            }
            if ($file_no == VALUE_TWO) {
                $inspection_data = $this->utility_model->upload_document('sign_seal_for_inspection', 'inspection', 'sign_seal_', 'sign_seal');
            }
            if ($file_no == VALUE_THREE) {
                $inspection_data = $this->utility_model->upload_document('annexure_9_for_inspection', 'inspection', 'annexure_9_', 'annexure_9');
            }
            if ($file_no == VALUE_FOUR) {
                $inspection_data = $this->utility_model->upload_document('approved_license_for_inspection', 'inspection', 'approved_license_', 'approved_license');
            }
            if (!$inspection_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$inspection_id) {
                $inspection_data['user_id'] = $session_user_id;
                $inspection_data['status'] = VALUE_ONE;
                $inspection_data['created_by'] = $session_user_id;
                $inspection_data['created_time'] = date('Y-m-d H:i:s');
                $inspection_id = $this->utility_model->insert_data('inspection', $inspection_data);
            } else {
                $inspection_data['updated_by'] = $session_user_id;
                $inspection_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('inspection_id', $inspection_id, 'inspection', $inspection_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['inspection_data'] = $inspection_data;
            $success_array['inspection_id'] = $inspection_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/BOCW.php
 */