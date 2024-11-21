<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_transfer_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['transfer_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['transfer_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'transfer', 'district', $search_district, 'transfer_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['transfer_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['transfer_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_transfer_data_by_id() {
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
            $transfer_id = get_from_post('transfer_id');
            if (!$transfer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $transfer_data = $this->utility_model->get_by_id('transfer_id', $transfer_id, 'transfer');
            if (empty($transfer_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['transfer_data'] = $transfer_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_transfer() {
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
            $transfer_id = get_from_post('transfer_id');
            $transfer_data = $this->_get_post_data_for_transfer();
            $validation_message = $this->_check_validation_for_transfer($transfer_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();

            // $transfer_data['proprietor_details'] = $proprietorData;
            $transfer_data['application_date'] = convert_to_mysql_date_format($transfer_data['application_date']);
            $transfer_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $transfer_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$transfer_id || $transfer_id == NULL) {
                $transfer_data['user_id'] = $user_id;
                $transfer_data['application_date'] = date('Y-m-d');
                $transfer_data['created_by'] = $user_id;
                $transfer_data['created_time'] = date('Y-m-d H:i:s');
                $transfer_id = $this->utility_model->insert_data('transfer', $transfer_data);
            } else {
                $transfer_data['updated_by'] = $user_id;
                $transfer_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', $transfer_data);
            }

            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWELVE, $transfer_id);
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

    function _get_post_data_for_transfer() {
        $transfer_data = array();
        $transfer_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $transfer_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $transfer_data['application_date'] = get_from_post('application_date');
        $transfer_data['state'] = get_from_post('state');
        $transfer_data['district'] = get_from_post('district');
        $transfer_data['taluka'] = get_from_post('taluka');
        $transfer_data['village'] = get_from_post('villages_for_noc_data');
        $transfer_data['plot_no'] = get_from_post('plot_no_for_transfer_data');
        $transfer_data['survey_no'] = get_from_post('survey_no');
        $transfer_data['admeasuring_square_metre'] = get_from_post('admeasuring_square_metre');
        $transfer_data['govt_industrial_estate_area'] = get_from_post('govt_industrial_estate_area');
        $transfer_data['reason_of_transfer'] = get_from_post('reason_of_transfer');
        $transfer_data['transferer_name'] = get_from_post('transferer_name');
        $transfer_data['name_of_servicing'] = get_from_post('name_of_servicing');
        $transfer_data['other_services'] = get_from_post('other_services');
        $transfer_data['aadhar_no'] = get_from_post('aadhar_no');
        $transfer_data['pan_no'] = get_from_post('pan_no');
        $transfer_data['gst_no'] = get_from_post('gst_no');
        $transfer_data['account_no'] = get_from_post('account_no');
        $transfer_data['request_letter'] = get_from_post('request_letter');
        $transfer_data['project_report'] = get_from_post('project_report');
        $transfer_data['constitution_project'] = get_from_post('constitution_project');
        $transfer_data['valid_authorization'] = get_from_post('valid_authorization');
        return $transfer_data;
    }

    function _check_validation_for_transfer($transfer_data) {
        if (!$transfer_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$transfer_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$transfer_data['application_date']) {
            return APPLICATION_DATE_MESSAGE;
        }
        if (!$transfer_data['state']) {
            return STATE_MESSAGE;
        }
        if (!$transfer_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$transfer_data['taluka']) {
            return TALUKA_MESSAGE;
        }
        if (!$transfer_data['village']) {
            return VILLAGE_NAME_MESSAGE;
        }

        if (!$transfer_data['plot_no']) {
            return PLOT_NO_MESSAGE;
        }
        if (!$transfer_data['survey_no']) {
            return SURVEY_NO_MESSAGE;
        }
        if (!$transfer_data['admeasuring_square_metre']) {
            return ADMEASURING_MESSAGE;
        }
        if (!$transfer_data['govt_industrial_estate_area']) {
            return GOVT_INDUSTRIAL_AR_MESSAGE;
        }
        if (!$transfer_data['reason_of_transfer']) {
            return REASONOF_TRANSFER_MESSAGE;
        }

        if (!$transfer_data['transferer_name']) {
            return TRANSFERER_NAME_MESSAGE;
        }
        if (!$transfer_data['name_of_servicing']) {
            return NAME_OF_SERVICING_MESSAGE;
        }
        if (!$transfer_data['other_services']) {
            return OTHER_SERVICES_MESSAGE;
        }
        if (!$transfer_data['aadhar_no']) {
            return AADHAR_NO_MESSAGE;
        }
        if (!$transfer_data['pan_no']) {
            return PAN_NO_MESSAGE;
        }
        if (!$transfer_data['gst_no']) {
            return GST_NO_MESSAGE;
        }
        if (!$transfer_data['account_no']) {
            return ACCOUNT_NO_MESSAGE;
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
            $transfer_id = get_from_post('transfer_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$transfer_id || $transfer_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('transfer_id', $transfer_id, 'transfer');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'transfer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['request_letter_upload'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'transfer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['project_report_upload'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'transfer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['constitution_project_upload'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'transfer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['valid_authorization_upload'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'transfer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_seal'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', array('request_letter_upload' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', array('project_report_upload' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', array('constitution_project_upload' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', array('valid_authorization_upload' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', array('sign_seal' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $transfer_id = get_from_post('transfer_id_for_transfer_form1');
            if (!is_post() || $user_id == null || !$user_id || $transfer_id == null || !$transfer_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_transfer_data = $this->utility_model->get_by_id('transfer_id', $transfer_id, 'transfer');

            if (empty($existing_transfer_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('transfer_data' => $existing_transfer_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('transfer/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_transfer_data_by_transfer_id() {
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
            $transfer_id = get_from_post('transfer_id');
            if (!$transfer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $transfer_data = $this->utility_model->get_by_id('transfer_id', $transfer_id, 'transfer');
            if (empty($transfer_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWELVE, $transfer_id, $transfer_data);
            $transfer_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWELVE, 'fees_bifurcation', 'module_id', $transfer_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['transfer_data'] = $transfer_data;
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
            $transfer_id = get_from_post('transfer_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$transfer_id || $transfer_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('transfer_id', $transfer_id, 'transfer');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'transfer' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $transfer_id = get_from_post('transfer_id_for_transfer_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $transfer_id == NULL || !$transfer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('transfer_id', $transfer_id, 'transfer');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_transfer_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $transfer_data = array();
            if ($_FILES['fees_paid_challan_for_transfer_upload_challan']['name'] != '') {
                $main_path = 'documents/transfer';
                if (!is_dir($main_path)) {
                    mkdir($main_path);
                    chmod("$main_path", 0755);
                }
//                $documents_path = 'documents';
//                if (!is_dir($documents_path)) {
//                    mkdir($documents_path);
//                    chmod($documents_path, 0777);
//                }
//                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'transfer';
//                if (!is_dir($module_path)) {
//                    mkdir($module_path);
//                    chmod($module_path, 0777);
//                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_transfer_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_transfer_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $transfer_data['status'] = VALUE_FOUR;
                $transfer_data['fees_paid_challan'] = $filename;
                $transfer_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $transfer_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $transfer_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $transfer_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWELVE, $transfer_id, $ex_em_data['district'], $ex_em_data['total_fees'], $transfer_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $transfer_data['user_payment_type'] = $user_payment_type;
            } else {
                $transfer_data['user_payment_type'] = VALUE_ZERO;
            }
            $transfer_data['updated_by'] = $user_id;
            $transfer_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', $transfer_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($transfer_data['status']) ? $transfer_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $transfer_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $transfer_data['user_payment_type'] == VALUE_THREE) {
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
            $transfer_id = get_from_post('transfer_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $transfer_id == null || !$transfer_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_transfer_data = $this->utility_model->get_by_id('transfer_id', $transfer_id, 'transfer');
            if (empty($existing_transfer_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_transfer_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_transfer($existing_transfer_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_transfer_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $transfer_id = get_from_post('transfer_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $transfer_data = $this->utility_model->upload_document('request_letter_upload_for_transfer', 'transfer', 'request_letter_upload_', 'request_letter_upload');
            }
            if ($file_no == VALUE_TWO) {
                $transfer_data = $this->utility_model->upload_document('project_report_upload_for_transfer', 'transfer', 'project_report_upload_', 'project_report_upload');
            }
            if ($file_no == VALUE_THREE) {
                $transfer_data = $this->utility_model->upload_document('constitution_project_upload_for_transfer', 'transfer', 'constitution_project_upload_', 'constitution_project_upload');
            }
            if ($file_no == VALUE_FOUR) {
                $transfer_data = $this->utility_model->upload_document('valid_authorization_upload_for_transfer', 'transfer', 'valid_authorization_upload_', 'valid_authorization_upload');
            }
            if ($file_no == VALUE_FIVE) {
                $transfer_data = $this->utility_model->upload_document('sign_seal_for_transfer', 'transfer', 'sign_seal_', 'sign_seal');
            }
            if (!$transfer_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$transfer_id) {
                $transfer_data['user_id'] = $session_user_id;
                $transfer_data['status'] = VALUE_ONE;
                $transfer_data['created_by'] = $session_user_id;
                $transfer_data['created_time'] = date('Y-m-d H:i:s');
                $transfer_id = $this->utility_model->insert_data('transfer', $transfer_data);
            } else {
                $transfer_data['updated_by'] = $session_user_id;
                $transfer_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('transfer_id', $transfer_id, 'transfer', $transfer_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['transfer_data'] = $transfer_data;
            $success_array['transfer_id'] = $transfer_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/Transfer.php
 */