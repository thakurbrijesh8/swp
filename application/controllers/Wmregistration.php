<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wmregistration extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_wmregistration_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['wmregistration_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['wmregistration_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'wm_registration', 'district', $search_district, 'wmregistration_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['wmregistration_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['wmregistration_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_wmregistration_data_by_id() {
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
            $wmregistration_id = get_from_post('wmregistration_id');
            if (!$wmregistration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $wmregistration_data = $this->utility_model->get_by_id('wmregistration_id', $wmregistration_id, 'wm_registration');
            if (empty($wmregistration_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['wmregistration_data'] = $wmregistration_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_wmregistration() {
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
            $wmregistration_id = get_from_post('wmregistration_id');
            $wmregistration_data = $this->_get_post_data_for_wmregistration();
            $validation_message = $this->_check_validation_for_wmregistration($wmregistration_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $proprietorData = $this->input->post('proprietor_data');
            $proprietor_decode_Data = json_decode($proprietorData, true);
            if ($proprietorData == "" || empty($proprietor_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
                return false;
            }

            $this->db->trans_start();
            $wmregistration_data['proprietor_details'] = $proprietorData;
            $wmregistration_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $wmregistration_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$wmregistration_id || $wmregistration_id == NULL) {
                $wmregistration_data['user_id'] = $user_id;
                $wmregistration_data['created_by'] = $user_id;
                $wmregistration_data['created_time'] = date('Y-m-d H:i:s');
                $wmregistration_id = $this->utility_model->insert_data('wm_registration', $wmregistration_data);
            } else {
                $wmregistration_data['updated_by'] = $user_id;
                $wmregistration_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', $wmregistration_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_ONE, $wmregistration_id);
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

    function _get_post_data_for_wmregistration() {
        $wmregistration_data = array();
        $wmregistration_data['district'] = get_from_post('district');
        $wmregistration_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $wmregistration_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $wmregistration_data['location_of_factory'] = get_from_post('location_of_factory');
        $wmregistration_data['branches'] = get_from_post('branches');
        $wmregistration_data['application_category'] = get_from_post('application_category');
        $wmregistration_data['item_detail'] = get_from_post('item_detail');
        return $wmregistration_data;
    }

    function _check_validation_for_wmregistration($wmregistration_data) {
        if (!$wmregistration_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$wmregistration_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$wmregistration_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$wmregistration_data['location_of_factory']) {
            return COMPLETE_ADDRESS_MESSAGE;
        }
        if (!$wmregistration_data['branches']) {
            return BRANCH_MESSAGE;
        }
        if (!$wmregistration_data['application_category']) {
            return APPLICANT_CATEGORY_MESSAGE;
        }
        if (!$wmregistration_data['item_detail']) {
            return ITEM_DETAIL_MESSAGE;
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
            $wmregistration_id = get_from_post('wmregistration_id');
            $document_type = get_from_post('document_type');
            //  $document_id = get_from_post('document_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$wmregistration_id || $wmregistration_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('wmregistration_id', $wmregistration_id, 'wm_registration');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['trade_licence'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['proof_of_ownership'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['gst_certificate'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['partnership_deed'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['memorandum_articles'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['item_to_be_packed'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_directors'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['code_certificate'];
            }
            if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('trade_licence' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('proof_of_ownership' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('gst_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('partnership_deed' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('memorandum_articles' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('item_to_be_packed' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('list_of_directors' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('code_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $wmregistration_id = get_from_post('wmregistration_id_for_wmregistration_form1');
            if (!is_post() || $user_id == null || !$user_id || $wmregistration_id == null || !$wmregistration_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_wmregistration_data = $this->utility_model->get_by_id('wmregistration_id', $wmregistration_id, 'wm_registration');

            if (empty($existing_wmregistration_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('wmregistration_data' => $existing_wmregistration_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('wmregistration/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_wmregistration_data_by_wmregistration_id() {
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
            $wmregistration_id = get_from_post('wmregistration_id');
            if (!$wmregistration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $wmregistration_data = $this->utility_model->get_by_id('wmregistration_id', $wmregistration_id, 'wm_registration');
            if (empty($wmregistration_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_ONE, $wmregistration_id, $wmregistration_data);
            $wmregistration_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_ONE, 'fees_bifurcation', 'module_id', $wmregistration_id);
            $this->db->trans_complete();
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['wmregistration_data'] = $wmregistration_data;
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
            $wmregistration_id = get_from_post('wmregistration_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$wmregistration_id || $wmregistration_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('wmregistration_id', $wmregistration_id, 'wm_registration');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wmregistration' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $wmregistration_id = get_from_post('wmregistration_id_for_wmregistration_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $wmregistration_id == NULL || !$wmregistration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('wmregistration_id', $wmregistration_id, 'wm_registration');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_wmregistration_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $wmregistration_data = array();
            if ($_FILES['fees_paid_challan_for_wmregistration_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'wmregistration';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_wmregistration_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_wmregistration_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $wmregistration_data['status'] = VALUE_FOUR;
                $wmregistration_data['fees_paid_challan'] = $filename;
                $wmregistration_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $wmregistration_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $wmregistration_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $wmregistration_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_ONE, $wmregistration_id, $ex_em_data['district'], $ex_em_data['total_fees'], $wmregistration_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $wmregistration_data['user_payment_type'] = $user_payment_type;
            } else {
                $wmregistration_data['user_payment_type'] = VALUE_ZERO;
            }
            $wmregistration_data['updated_by'] = $user_id;
            $wmregistration_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', $wmregistration_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($wmregistration_data['status']) ? $wmregistration_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $wmregistration_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $wmregistration_data['user_payment_type'] == VALUE_THREE) {
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
            $wmregistration_id = get_from_post('wmregistration_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $wmregistration_id == null || !$wmregistration_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_wmregistration_data = $this->utility_model->get_by_id('wmregistration_id', $wmregistration_id, 'wm_registration');
            if (empty($existing_wmregistration_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_wmregistration_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $this->utility_lib->gc_for_wm_registration($existing_wmregistration_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_wmregistration_document() {
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
            $wmregistration_id = get_from_post('wmregistration_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $wmregistration_data = $this->utility_model->upload_document('trade_licence_for_wmregistration', 'wmregistration', 'trade_licence_', 'trade_licence');
            }
            if ($file_no == VALUE_TWO) {
                $wmregistration_data = $this->utility_model->upload_document('proof_of_ownership_for_wmregistration', 'wmregistration', 'proof_of_ownership_', 'proof_of_ownership');
            }
            if ($file_no == VALUE_THREE) {
                $wmregistration_data = $this->utility_model->upload_document('gst_certificate_for_wmregistration', 'wmregistration', 'gst_certificate_', 'gst_certificate');
            }
            if ($file_no == VALUE_FOUR) {
                $wmregistration_data = $this->utility_model->upload_document('partnership_deed_for_wmregistration', 'wmregistration', 'partnership_deed_', 'partnership_deed');
            }
            if ($file_no == VALUE_FIVE) {
                $wmregistration_data = $this->utility_model->upload_document('memorandum_articles_for_wmregistration', 'wmregistration', 'memorandum_articles_', 'memorandum_articles');
            }
            if ($file_no == VALUE_SIX) {
                $wmregistration_data = $this->utility_model->upload_document('item_to_be_packed_for_wmregistration', 'wmregistration', 'item_to_be_packed_', 'item_to_be_packed');
            }
            if ($file_no == VALUE_SEVEN) {
                $wmregistration_data = $this->utility_model->upload_document('list_of_directors_for_wmregistration', 'wmregistration', 'list_of_directors_', 'list_of_directors');
            }
            if ($file_no == VALUE_EIGHT) {
                $wmregistration_data = $this->utility_model->upload_document('code_certificate_for_wmregistration', 'wmregistration', 'code_certificate_', 'code_certificate');
            }
            if ($file_no == VALUE_NINE) {
                $wmregistration_data = $this->utility_model->upload_document('seal_and_stamp_for_wmregistration', 'wmregistration', 'signature_', 'signature');
            }
            if (!$wmregistration_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$wmregistration_id) {
                $wmregistration_data['user_id'] = $session_user_id;
                $wmregistration_data['status'] = VALUE_ONE;
                $wmregistration_data['created_by'] = $session_user_id;
                $wmregistration_data['created_time'] = date('Y-m-d H:i:s');
                $wmregistration_id = $this->utility_model->insert_data('wm_registration', $wmregistration_data);
            } else {
                $wmregistration_data['updated_by'] = $session_user_id;
                $wmregistration_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('wmregistration_id', $wmregistration_id, 'wm_registration', $wmregistration_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['wmregistration_data'] = $wmregistration_data;
            $success_array['wmregistration_id'] = $wmregistration_id;
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