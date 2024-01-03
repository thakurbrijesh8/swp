<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buildingplan extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('building_plan_model');
        $this->load->model('utility_model');
    }

    function get_building_plan_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['building_plan_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['building_plan_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'buildingplan', 'district', $search_district, 'buildingplan_id', 'DESC', 'status', $search_status);
            if ($this->db->trans_status() === FALSE) {
                $success_array['building_plan_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['building_plan_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_building_plan_data_by_id() {
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
            $building_plan_id = get_from_post('buildingplan_id');
            if (!$building_plan_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $building_plan_data = $this->utility_model->get_by_id('buildingplan_id', $building_plan_id, 'buildingplan');
            if (empty($building_plan_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['building_plan_data'] = $building_plan_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_building_plan() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $buildingplan_id = get_from_post('buildingplan_id');
            $building_plan_data = $this->_get_post_data_for_building_plan();
            $validation_message = $this->_check_validation_for_building_plan($building_plan_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            //$building_plan_data['status'] = get_from_post('form_status');
            $building_plan_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $building_plan_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$buildingplan_id || $buildingplan_id == NULL) {
                $building_plan_data['user_id'] = $user_id;
                $building_plan_data['created_by'] = $user_id;
                $building_plan_data['created_time'] = date('Y-m-d H:i:s');
                $buildingplan_id = $this->utility_model->insert_data('buildingplan', $building_plan_data);
            } else {
                $building_plan_data['updated_by'] = $user_id;
                $building_plan_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', $building_plan_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYSIX, $buildingplan_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            //$success_array['message'] = FACTORY_LICENSE_SAVED_MESSAGE;
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_building_plan() {
        $building_plan_data = array();
        $building_plan_data['district'] = get_from_post('district');
        $building_plan_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $building_plan_data['applicant_name'] = get_from_post('applicant_name');
        $building_plan_data['applicant_phoneno'] = get_from_post('applicant_phoneno');
        $building_plan_data['email'] = get_from_post('email');
        $building_plan_data['applicant_address'] = get_from_post('applicant_address');
        $building_plan_data['factory_name'] = get_from_post('factory_name');
        $building_plan_data['factory_building'] = get_from_post('factory_building');
        $building_plan_data['factory_streetno'] = get_from_post('factory_streetno');
        $building_plan_data['factory_city'] = get_from_post('factory_city');
        $building_plan_data['factory_pincode'] = get_from_post('factory_pincode');
        $building_plan_data['factory_district'] = get_from_post('factory_district');
        $building_plan_data['factory_town'] = get_from_post('factory_town');
        $building_plan_data['nearest_police_station'] = get_from_post('nearest_police_station');
        $building_plan_data['nrearest_railway_station'] = get_from_post('nrearest_railway_station');
        $building_plan_data['particulars_of_plant'] = get_from_post('particulars_of_plant');

        return $building_plan_data;
    }

    function _check_validation_for_building_plan($building_plan_data) {
        if (!$building_plan_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$building_plan_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$building_plan_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$building_plan_data['applicant_phoneno']) {
            return APPLICANT_PHNO_MESSAGE;
        }
        if (!$building_plan_data['email']) {
            return APPLICANT_EMAIL_MESSAGE;
        }
        if (!$building_plan_data['applicant_address']) {
            return FACTORY_ADDRESS_MESSAGE;
        }
        if (!$building_plan_data['factory_name']) {
            return FACTORY_NAME_MESSAGE;
        }
        if (!$building_plan_data['factory_building']) {
            return FACTORY_BUILDING_MESSAGE;
        }
        if (!$building_plan_data['factory_streetno']) {
            return FACTORY_SECTOR_MESSAGE;
        }
        if (!$building_plan_data['factory_city']) {
            return FACTORY_CITY_MESSAGE;
        }
        if (!$building_plan_data['factory_pincode']) {
            return FACTORY_PINCODE_MESSAGE;
        }
        if (!$building_plan_data['factory_district']) {
            return FACTORY_DISTRICT_MESSAGE;
        }
        if (!$building_plan_data['factory_town']) {
            return FACTORY_TOWN_MESSAGE;
        }
        if (!$building_plan_data['nearest_police_station']) {
            return POLICE_STATION_MESSAGE;
        }
        if (!$building_plan_data['nrearest_railway_station']) {
            return RAILWAY_STATION_MESSAGE;
        }
        if (!$building_plan_data['particulars_of_plant']) {
            return PLAN_MESSAGE;
        }

        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $buildingplan_id = get_from_post('buildingplan_id_for_buildingplan_form1');
            if (!is_post() || $user_id == null || !$user_id || $buildingplan_id == null || !$buildingplan_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_building_plan_data = $this->utility_model->get_by_id('buildingplan_id', $buildingplan_id, 'buildingplan');

            if (empty($existing_building_plan_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $taluka_array = $this->config->item('taluka_array');
            $existing_building_plan_data['district'] = isset($taluka_array[$existing_building_plan_data['district']]) ? $taluka_array[$existing_building_plan_data['district']] : '-';
            $data = array('building_plan_data' => $existing_building_plan_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('buildingplan/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_buildingplan_data_by_buildingplan_id() {
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
            $buildingplan_id = get_from_post('buildingplan_id');
            if (!$buildingplan_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $building_plan_data = $this->utility_model->get_by_id('buildingplan_id', $buildingplan_id, 'buildingplan');
            if (empty($building_plan_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYSIX, $buildingplan_id, $building_plan_data);
            $building_plan_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYSIX, 'fees_bifurcation', 'module_id', $buildingplan_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['building_plan_data'] = $building_plan_data;
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
            $buildingplan_id = get_from_post('buildingplan_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$buildingplan_id || $buildingplan_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('buildingplan_id', $buildingplan_id, 'buildingplan');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
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
            $buildingplan_id = get_from_post('buildingplan_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$buildingplan_id || $buildingplan_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('buildingplan_id', $buildingplan_id, 'buildingplan');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['building_drawing_plans'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['provisional_registration'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['project_report'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['mode_of_storage'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['drawing_of_treatment_plant'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['machinery_layout'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['questionnaire_copy'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'buildingplan' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_of_applicant'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('building_drawing_plans' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('provisional_registration' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('project_report' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('mode_of_storage' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('drawing_of_treatment_plant' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('machinery_layout' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('questionnaire_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', array('sign_of_applicant' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

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
            $buildingplan_id = get_from_post('building_plan_id_for_building_plan_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $buildingplan_id == NULL || !$buildingplan_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_buld_data = $this->utility_model->get_by_id('buildingplan_id', $buildingplan_id, 'buildingplan');
            if (empty($ex_buld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_buld_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_building_plan_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $building_plan_data = array();
            if ($_FILES['fees_paid_challan_for_building_plan_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'buildingplan';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_building_plan_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_building_plan_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $building_plan_data['status'] = VALUE_FOUR;
                $building_plan_data['fees_paid_challan'] = $filename;
                $building_plan_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_buld_data['payment_type'] == VALUE_TWO) {
                $building_plan_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $building_plan_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $building_plan_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYSIX, $buildingplan_id, $ex_buld_data['district'], $ex_buld_data['total_fees'], $building_plan_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $building_plan_data['user_payment_type'] = $user_payment_type;
            } else {
                $building_plan_data['user_payment_type'] = VALUE_ZERO;
            }
            $building_plan_data['updated_by'] = $user_id;
            $building_plan_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', $building_plan_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($building_plan_data['status']) ? $building_plan_data['status'] : $ex_buld_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_buld_data['payment_type'];
            $success_array['user_payment_type'] = $building_plan_data['user_payment_type'];
            if ($ex_buld_data['payment_type'] == VALUE_TWO && $building_plan_data['user_payment_type'] == VALUE_THREE) {
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
            $buildingplan_id = get_from_post('buildingplan_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $buildingplan_id == null || !$buildingplan_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_buildingplan_data = $this->utility_model->get_by_id('buildingplan_id', $buildingplan_id, 'buildingplan');
            if (empty($existing_buildingplan_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_buildingplan_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $taluka_array = $this->config->item('taluka_array');
            $existing_buildingplan_data['district'] = isset($taluka_array[$existing_buildingplan_data['district']]) ? $taluka_array[$existing_buildingplan_data['district']] : '-';
            $this->utility_lib->gc_for_buildingplan($existing_buildingplan_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_buildingplan_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $buildingplan_id = get_from_post('buildingplan_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $building_plan_data = $this->utility_model->upload_document('building_drawing_plans_for_buildingplan', 'buildingplan', 'building_drawing_plans_', 'building_drawing_plans');
            }
            if ($file_no == VALUE_TWO) {
                $building_plan_data = $this->utility_model->upload_document('provisional_registration_for_buildingplan', 'buildingplan', 'provisional_registration_', 'provisional_registration');
            }
            if ($file_no == VALUE_THREE) {
                $building_plan_data = $this->utility_model->upload_document('project_report_for_buildingplan', 'buildingplan', 'project_report_', 'project_report');
            }
            if ($file_no == VALUE_FOUR) {
                $building_plan_data = $this->utility_model->upload_document('mode_of_storage_for_buildingplan', 'buildingplan', 'mode_of_storage_', 'mode_of_storage');
            }
            if ($file_no == VALUE_FIVE) {
                $building_plan_data = $this->utility_model->upload_document('drawing_of_treatment_plant_for_buildingplan', 'buildingplan', 'drawing_of_treatment_plant_', 'drawing_of_treatment_plant');
            }
            if ($file_no == VALUE_SIX) {
                $building_plan_data = $this->utility_model->upload_document('machinery_layout_for_buildingplan', 'buildingplan', 'machinery_layout_', 'machinery_layout');
            }
            if ($file_no == VALUE_SEVEN) {
                $building_plan_data = $this->utility_model->upload_document('questionnaire_copy_for_buildingplan', 'buildingplan', 'questionnaire_copy_', 'questionnaire_copy');
            }
            if ($file_no == VALUE_EIGHT) {
                $building_plan_data = $this->utility_model->upload_document('sign_of_applicant_for_buildingplan', 'buildingplan', 'sign_of_applicant_', 'sign_of_applicant');
            }
            if (!$building_plan_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$buildingplan_id) {
                $building_plan_data['user_id'] = $session_user_id;
                $building_plan_data['status'] = VALUE_ONE;
                $building_plan_data['created_by'] = $session_user_id;
                $building_plan_data['created_time'] = date('Y-m-d H:i:s');
                $buildingplan_id = $this->utility_model->insert_data('buildingplan', $building_plan_data);
            } else {
                $building_plan_data['updated_by'] = $session_user_id;
                $building_plan_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('buildingplan_id', $buildingplan_id, 'buildingplan', $building_plan_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['building_plan_data'] = $building_plan_data;
            $success_array['buildingplan_id'] = $buildingplan_id;
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