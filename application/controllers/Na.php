<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Na extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_na_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['na_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['na_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'na', 'district', $search_district, 'na_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['na_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['na_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_na_data_by_id() {
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
            $na_id = get_from_post('na_id');
            if (!$na_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $na_data = $this->utility_model->get_by_id('na_id', $na_id, 'na');
            if (empty($na_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['na_data'] = $na_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_na() {
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
            $na_id = get_from_post('na_id');
            $na_data = $this->_get_post_data_for_na();
            $validation_message = $this->_check_validation_for_na($na_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $applicantData = $this->input->post('applicant_data');
            $applicant_decode_Data = json_decode($applicantData, true);
            if ($applicantData == "" || empty($applicant_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Applicant Details'));
                return false;
            }

            $this->db->trans_start();
            $na_data['multiple_applicant'] = $applicantData;
            $na_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $na_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$na_id || $na_id == NULL) {
                $na_data['user_id'] = $user_id;
                $na_data['created_by'] = $user_id;
                $na_data['created_time'] = date('Y-m-d H:i:s');
                $na_id = $this->utility_model->insert_data('na', $na_data);
            } else {
                $na_data['updated_by'] = $user_id;
                $na_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('na_id', $na_id, 'na', $na_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTY, $na_id);
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

    function _get_post_data_for_na() {
        $na_data = array();
        $na_data['district'] = get_from_post('district');
        $na_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $na_data['agri_purpose_a'] = get_from_post('agri_purpose_a');
        $na_data['non_agri_purpose_b'] = get_from_post('non_agri_purpose_b');
        $na_data['non_agri_purpose_c'] = get_from_post('non_agri_purpose_c');
        $na_data['rel_condition_c'] = get_from_post('rel_condition_c');
        $na_data['pre_non_agri_c'] = get_from_post('pre_non_agri_c');
        $na_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $na_data['occupation'] = get_from_post('occupation');
        $na_data['purpose'] = get_from_post('purpose');
        $na_data['postel_address'] = get_from_post('postel_address');
        $na_data['village'] = get_from_post('village');
        $na_data['survey_no'] = get_from_post('survey_no');
        $na_data['area_assessment'] = get_from_post('area_assessment');
        $na_data['area_of_site_used'] = get_from_post('area_of_site_used');
        $na_data['occupant_class'] = get_from_post('occupant_class');
        $na_data['present_use_land'] = get_from_post('present_use_land');
        $na_data['situated_land'] = get_from_post('situated_land');
        $na_data['electrical_distance_land'] = get_from_post('electrical_distance_land');
        $na_data['acquisition_under_land'] = get_from_post('acquisition_under_land');
        $na_data['accessible_land'] = get_from_post('accessible_land');
        $na_data['site_access_land'] = get_from_post('site_access_land');
        $na_data['rejected_land'] = get_from_post('rejected_land');
        return $na_data;
    }

    function _check_validation_for_na($na_data) {
        if (!$na_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$na_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$na_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$na_data['occupation']) {
            return NA_OCCUPANT_CLASS_MESSAGE;
        }
//        if (!$na_data['purpose']) {
//            return NA_PURPOSE_MESSAGE;
//        }
        if (!$na_data['postel_address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$na_data['village']) {
            return VILLAGE_NAME_MESSAGE;
        }
        if (!$na_data['survey_no']) {
            return NA_SURVEY_NO_MESSAGE;
        }
        if (!$na_data['area_assessment']) {
            return NA_AREA_ASSESSMENT_MESSAGE;
        }
        if (!$na_data['area_of_site_used']) {
            return NA_AREA_SITE_MESSAGE;
        }
        if (!$na_data['occupant_class']) {
            return NA_OCCUPANT_CLASS_MESSAGE;
        }
        if (!$na_data['present_use_land']) {
            return NA_PRESENT_USE_MESSAGE;
        }
        if (!$na_data['situated_land']) {
            return NA_SITUATED_LAND_MESSAGE;
        }
//        if (!$na_data['electrical_distance_land']) {
//            return NA_ELECTRICAL_DISTANCE_LAND_MESSAGE;
//        }
//        if (!$na_data['acquisition_under_land']) {
//            return NA_ACQUISITIONS_UNDER_LAND_MESSAGE;
//        }
//        if (!$na_data['accessible_land']) {
//            return NA_ACCESSIBLE_LAND_MESSAGE;
//        }
//        if (!$na_data['site_access_land']) {
//            return NA_SITE_ACCESS_LAND_MESSAGE;
//        }
//        if (!$na_data['rejected_land']) {
//            return NA_REJECTED_LAND_MESSAGE;
//        }

        return '';
    }

    function remove_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $na_id = get_from_post('na_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$na_id || $na_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('na_id', $na_id, 'na');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'na' . DIRECTORY_SEPARATOR . $ex_est_data['form_land_document'];
            } else if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'na' . DIRECTORY_SEPARATOR . $ex_est_data['site_plan_document'];
            } else if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'na' . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            } else if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'na' . DIRECTORY_SEPARATOR . $ex_est_data['certified_copy'];
            } else if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'na' . DIRECTORY_SEPARATOR . $ex_est_data['sketch_layout'];
            } else if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'na' . DIRECTORY_SEPARATOR . $ex_est_data['written_consent'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('na_id', $na_id, 'na', array('form_land_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('na_id', $na_id, 'na', array('site_plan_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('na_id', $na_id, 'na', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('na_id', $na_id, 'na', array('certified_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('na_id', $na_id, 'na', array('sketch_layout' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('na_id', $na_id, 'na', array('written_consent' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_form() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $na_id = get_from_post('na_id_for_na_form');
            if (!is_post() || $user_id == null || !$user_id || $na_id == null || !$na_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_na_data = $this->utility_model->get_by_id('na_id', $na_id, 'na');

            if (empty($existing_na_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $taluka_array = $this->config->item('taluka_array');
            $existing_na_data['district'] = isset($taluka_array[$existing_na_data['district']]) ? $taluka_array[$existing_na_data['district']] : '-';
            error_reporting(E_ERROR);
            $data = array('na_data' => $existing_na_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('na/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_na_data_by_na_id() {
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
            $na_id = get_from_post('na_id');
            if (!$na_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $na_data = $this->utility_model->get_by_id('na_id', $na_id, 'na');
            if (empty($na_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTY, $na_id, $na_data);
            $na_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTY, 'fees_bifurcation', 'module_id', $na_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['na_data'] = $na_data;
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
            $na_id = get_from_post('na_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$na_id || $na_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('na_id', $na_id, 'na');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'na' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('na_id', $na_id, 'na', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $na_id = get_from_post('na_id_for_na_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $na_id == NULL || !$na_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('na_id', $na_id, 'na');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_na_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $na_data = array();
            if ($_FILES['fees_paid_challan_for_na_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'na';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_na_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_na_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $na_data['status'] = VALUE_FOUR;
                $na_data['fees_paid_challan'] = $filename;
                $na_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $na_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $na_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $na_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTY, $na_id, $ex_em_data['district'], $ex_em_data['total_fees'], $na_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $na_data['user_payment_type'] = $user_payment_type;
            } else {
                $na_data['user_payment_type'] = VALUE_ZERO;
            }
            $na_data['updated_by'] = $user_id;
            $na_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('na_id', $na_id, 'na', $na_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($na_data['status']) ? $na_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $na_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $na_data['user_payment_type'] == VALUE_THREE) {
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
            $na_id = get_from_post('na_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $na_id == null || !$na_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_na_data = $this->utility_model->get_by_id('na_id', $na_id, 'na');
            if (empty($existing_na_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_na_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
    //        $taluka_array = $this->config->item('taluka_array');
    //        $existing_na_data['district'] = isset($taluka_array[$existing_na_data['district']]) ? $taluka_array[$existing_na_data['district']] : '-';
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_na($existing_na_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_na_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $na_id = get_from_post('na_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $na_data = $this->utility_model->upload_document('form_land_document', 'na', 'form_land_document_', 'form_land_document');
            }
            if ($file_no == VALUE_TWO) {
                $na_data = $this->utility_model->upload_document('site_plan_document', 'na', 'site_plan_document_', 'site_plan_document');
            }
            if ($file_no == VALUE_THREE) {
                $na_data = $this->utility_model->upload_document('seal_and_stamp_for_na', 'na', 'signature_', 'signature');
            }
            if ($file_no == VALUE_FOUR) {
                $na_data = $this->utility_model->upload_document('certified_copy', 'na', 'certified_copy_', 'certified_copy');
            }
            if ($file_no == VALUE_FIVE) {
                $na_data = $this->utility_model->upload_document('sketch_layout', 'na', 'sketch_layout_', 'sketch_layout');
            }
            if ($file_no == VALUE_SIX) {
                $na_data = $this->utility_model->upload_document('written_consent', 'na', 'written_consent_', 'written_consent');
            }
            if (!$na_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$na_id) {
                $na_data['user_id'] = $session_user_id;
                $na_data['status'] = VALUE_ONE;
                $na_data['created_by'] = $session_user_id;
                $na_data['created_time'] = date('Y-m-d H:i:s');
                $na_id = $this->utility_model->insert_data('na', $na_data);
            } else {
                $na_data['updated_by'] = $session_user_id;
                $na_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('na_id', $na_id, 'na', $na_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['success'] = TRUE;
            $success_array['na_data'] = $na_data;
            $success_array['na_id'] = $na_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Naapp.php
 */