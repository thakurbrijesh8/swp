<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zone extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_zone_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['zone_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['zone_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'zone_information', 'district', $search_district, 'zone_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['zone_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['wmregistration_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_zone_data_by_id() {
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
            $zone_id = get_from_post('zone_id');
            if (!$zone_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $zone_data = $this->utility_model->get_by_id('zone_id', $zone_id, 'zone_information');
            if (empty($zone_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['zone_data'] = $zone_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_zone() {
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
            $zone_id = get_from_post('zone_id');
            $zone_data = $this->_get_post_data_for_zone();
            $validation_message = $this->_check_validation_for_zone($zone_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();

            $zone_data['application_date'] = convert_to_mysql_date_format($zone_data['application_date']);
            $zone_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $zone_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$zone_id || $zone_id == NULL) {
                $zone_data['user_id'] = $user_id;
                $zone_data['created_by'] = $user_id;
                $zone_data['created_time'] = date('Y-m-d H:i:s');
                $zone_id = $this->utility_model->insert_data('zone_information', $zone_data);
            } else {
                $zone_data['updated_by'] = $user_id;
                $zone_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('zone_id', $zone_id, 'zone_information', $zone_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTY, $zone_id);
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

    function _get_post_data_for_zone() {
        $zone_data = array();
        $zone_data['district'] = get_from_post('district');
        $zone_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $zone_data['address'] = get_from_post('address');
        $zone_data['mobile_no'] = get_from_post('mobile_no');
        $zone_data['application_date'] = get_from_post('application_date');
        $zone_data['pts_no'] = get_from_post('pts_no');
        $zone_data['survey_no'] = get_from_post('survey_no');
        $zone_data['village'] = get_from_post('village');
        return $zone_data;
    }

    function _check_validation_for_zone($zone_data) {
        if (!$zone_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$zone_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$zone_data['address']) {
            return OWNER_ADDRESS_MESSAGE;
        }
        if (!$zone_data['mobile_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$zone_data['village']) {
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
            $zone_id = get_from_post('zone_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$zone_id || $zone_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('zone_id', $zone_id, 'zone_information');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'zone' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['site_plan'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'zone' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['I_XIV_nakal'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'zone' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('zone_id', $zone_id, 'zone_information', array('site_plan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('zone_id', $zone_id, 'zone_information', array('I_XIV_nakal' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('zone_id', $zone_id, 'zone_information', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $zone_id = get_from_post('zone_id_for_zone_form1');
            if (!is_post() || $user_id == null || !$user_id || $zone_id == null || !$zone_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_zone_data = $this->utility_model->get_by_id('zone_id', $zone_id, 'zone_information');

            if (empty($existing_zone_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('zone_data' => $existing_zone_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('zone/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_zone_data_by_zone_id() {
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
            $zone_id = get_from_post('zone_id');
            if (!$zone_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $zone_data = $this->utility_model->get_by_id('zone_id', $zone_id, 'zone_information');
            if (empty($zone_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['zone_data'] = $zone_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $zone_id = get_from_post('zone_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $zone_id == null || !$zone_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_zone_data = $this->utility_model->get_by_id('zone_id', $zone_id, 'zone_information');
            if (empty($existing_zone_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_zone_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_zone($existing_zone_data);
    //        $data = array('zone_data' => $existing_zone_data);
    //        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
    //        $mpdf->WriteHTML($this->load->view('zone/certificate', $data, TRUE));
    //        $mpdf->Output('Repairer_certificate_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_zone_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $zone_id = get_from_post('zone_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $zone_data = $this->utility_model->upload_document('site_plan_for_zone', 'zone', 'site_plan_', 'site_plan');
            }
            if ($file_no == VALUE_TWO) {
                $zone_data = $this->utility_model->upload_document('I_XIV_nakal_for_zone', 'zone', 'I_XIV_nakal_', 'I_XIV_nakal');
            }
            if ($file_no == VALUE_THREE) {
                $zone_data = $this->utility_model->upload_document('seal_and_stamp_for_zone', 'zone', 'signature_', 'signature');
            }
            if (!$zone_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$zone_id) {
                $zone_data['user_id'] = $session_user_id;
                $zone_data['status'] = VALUE_ONE;
                $zone_data['created_by'] = $session_user_id;
                $zone_data['created_time'] = date('Y-m-d H:i:s');
                $zone_id = $this->utility_model->insert_data('zone_information', $zone_data);
            } else {
                $zone_data['updated_by'] = $session_user_id;
                $zone_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('zone_id', $zone_id, 'zone_information', $zone_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['zone_data'] = $zone_data;
            $success_array['zone_id'] = $zone_id;
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