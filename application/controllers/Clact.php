<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clact extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_clact_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['clact_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['clact_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'establishment', 'district', $search_district, 'establishment_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['clact_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['clact_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_clact_data_by_id() {
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
            $establishment_id = get_from_post('clact_id');
            if (!$establishment_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $clact_data = $this->utility_model->get_by_id('establishment_id', $establishment_id, 'establishment');
            if (empty($clact_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $contractor_data = $this->utility_model->get_result_data_by_id('establishment_id', $establishment_id, 'establishment_contractor');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['clact_data'] = $clact_data;
            $success_array['contractor_data'] = $contractor_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_clact_data_by_clact_id() {
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
            $establishment_id = get_from_post('clact_id');
            if (!$establishment_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $clact_data = $this->utility_model->get_by_id('establishment_id', $establishment_id, 'establishment');
            if (empty($clact_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYONE, $establishment_id, $clact_data);
            $clact_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYONE, 'fees_bifurcation', 'module_id', $establishment_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['clact_data'] = $clact_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_clact() {
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
            $establishment_id = get_from_post('clact_id_for_clact');
            $clact_data = $this->_get_post_data_for_clact();
            $validation_message = $this->_check_validation_for_clact($clact_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $new_est_cont_data = json_decode($this->input->post('new_contractor_item_for_clact'), TRUE);
            $exi_est_cont_data = json_decode($this->input->post('exi_contractor_item_for_clact'), TRUE);
            if (empty($new_est_cont_data) && empty($exi_est_cont_data)) {
                echo json_encode(get_error_array(ONE_CONTRACTOR_MESSAGE));
                return false;
            }

            $this->db->trans_start();
            $clact_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $clact_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$establishment_id || $establishment_id == NULL) {
                $clact_data['user_id'] = $user_id;
                $clact_data['declaration'] = VALUE_ONE;
                $clact_data['created_by'] = $user_id;
                $clact_data['created_time'] = date('Y-m-d H:i:s');
                $establishment_id = $this->utility_model->insert_data('establishment', $clact_data);
            } else {
                $clact_data['updated_by'] = $user_id;
                $clact_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('establishment_id', $establishment_id, 'establishment', $clact_data);
            }
            if (!empty($exi_est_cont_data)) {
                $ex_ids = array();
                foreach ($exi_est_cont_data as &$value) {
                    $value['updated_by'] = $user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                    array_push($ex_ids, $value['establishment_contractor_id']);
                }
                $this->utility_model->update_data_batch('establishment_contractor_id', 'establishment_contractor', $exi_est_cont_data);
                if (!empty($ex_ids)) {
                    $update_data = array();
                    $update_data['is_delete'] = IS_DELETE;
                    $update_data['updated_by'] = $user_id;
                    $update_data['updated_time'] = date('Y-m-d H:i:s');
                    $this->utility_model->update_data_not_in('establishment_id', $establishment_id, 'establishment_contractor_id', $ex_ids, 'establishment_contractor', $update_data);
                }
            }
            if (!empty($new_est_cont_data)) {
                foreach ($new_est_cont_data as &$value) {
                    $value['user_id'] = $user_id;
                    $value['establishment_id'] = $establishment_id;
                    $value['created_by'] = $user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('establishment_contractor', $new_est_cont_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYONE, $establishment_id);
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

    function _get_post_data_for_clact() {
        $clact_data = array();
        $clact_data['district'] = get_from_post('district');
        $clact_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $clact_data['establishment_name'] = get_from_post('establishment_name_for_clact');
        $clact_data['establishment_location'] = get_from_post('establishment_location_for_clact');
        $clact_data['establishment_postel_address'] = get_from_post('establishment_postel_address_for_clact');
        $clact_data['nature_of_work'] = get_from_post('nature_of_work_for_clact');
        $clact_data['pe_full_name'] = get_from_post('pe_full_name_for_clact');
        $clact_data['pe_address'] = get_from_post('pe_address_for_clact');
        $clact_data['pe_mobile_number'] = get_from_post('pe_mobile_number_for_clact');
        $clact_data['pe_email_id'] = get_from_post('pe_email_id_for_clact');
        $clact_data['mp_full_name'] = get_from_post('mp_full_name_for_clact');
        $clact_data['mp_address'] = get_from_post('mp_address_for_clact');
        $clact_data['mp_mobile_number'] = get_from_post('mp_mobile_number_for_clact');
        $clact_data['mp_email_id'] = get_from_post('mp_email_id_for_clact');
        return $clact_data;
    }

    function _check_validation_for_clact($clact_data) {
        if (!$clact_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$clact_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$clact_data['establishment_name']) {
            return ESTABLISHMENT_NAME_MESSAGE;
        }
        if (!$clact_data['establishment_location']) {
            return ESTABLISHMENT_LOCATION_MESSAGE;
        }
        if (!$clact_data['establishment_postel_address']) {
            return ESTABLISHMENT_POSTAL_ADDRESS_MESSAGE;
        }
        if (!$clact_data['nature_of_work']) {
            return CONTRACTOR_NATURE_WORKING_MESSAGE;
        }
        if (!$clact_data['pe_full_name']) {
            return PRINCIPLE_EMPLOYER_FULL_NAME_MESSAGE;
        }
        if (!$clact_data['pe_address']) {
            return PRINCIPLE_EMPLOYER_ADDRESS_MESSAGE;
        }
        if (!$clact_data['pe_mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$clact_data['pe_email_id']) {
            return EMAIL_MESSAGE;
        }
        if (!$clact_data['mp_full_name']) {
            return MANAGER_NAME_MESSAGE;
        }
        if (!$clact_data['mp_address']) {
            return MANAGER_ADDRESS_MESSAGE;
        }
        if (!$clact_data['pe_mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$clact_data['mp_email_id']) {
            return EMAIL_MESSAGE;
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
            $establishment_id = get_from_post('establishment_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$establishment_id || $establishment_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('establishment_id', $establishment_id, 'establishment');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'clact' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['seal_and_stamp'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('establishment_id', $establishment_id, 'establishment', array('seal_and_stamp' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $establishment_id = get_from_post('establishment_id_for_clact_form1');
            if (!is_post() || $user_id == null || !$user_id || $establishment_id == null || !$establishment_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_establishment_data = $this->utility_model->get_by_id('establishment_id', $establishment_id, 'establishment');
            $establishment_under_all_contractor = $this->utility_model->get_result_data_by_id('establishment_id', $establishment_id, 'establishment_contractor');
            if (empty($existing_establishment_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('establishment_data' => $existing_establishment_data, 'establishment_under_all_contractor' => $establishment_under_all_contractor);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('clact/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
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
            $establishment_id = get_from_post('establishment_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$establishment_id || $establishment_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('establishment_id', $establishment_id, 'establishment');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'clact' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('establishment_id', $establishment_id, 'establishment', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $clact_id = get_from_post('clact_id_for_clact_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $clact_id == NULL || !$clact_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('establishment_id', $clact_id, 'establishment');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_clact_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $clact_data = array();
            if ($_FILES['fees_paid_challan_for_clact_upload_challan']['name'] != '') {
                $main_path = 'documents/clact';
                if (!is_dir($main_path)) {
                    mkdir($main_path);
                    chmod("$main_path", 0755);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_clact_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_clact_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $clact_data['status'] = VALUE_FOUR;
                $clact_data['fees_paid_challan'] = $filename;
                $clact_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $clact_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $clact_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $clact_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYONE, $clact_id, $ex_em_data['district'], $ex_em_data['total_fees'], $clact_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $clact_data['user_payment_type'] = $user_payment_type;
            } else {
                $clact_data['user_payment_type'] = VALUE_ZERO;
            }
            $clact_data['updated_by'] = $user_id;
            $clact_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('establishment_id', $clact_id, 'establishment', $clact_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($clact_data['status']) ? $clact_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $clact_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $clact_data['user_payment_type'] == VALUE_THREE) {
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
            $establishment_id = get_from_post('establishment_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $establishment_id == null || !$establishment_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_establishment_data = $this->utility_model->get_by_id('establishment_id', $establishment_id, 'establishment');
            if (empty($existing_establishment_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_establishment_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $establishment_under_all_contractor = $this->utility_model->get_result_data_by_id('establishment_id', $establishment_id, 'establishment_contractor');
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_clact($existing_establishment_data, $establishment_under_all_contractor);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_clact_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $establishment_id = get_from_post('clact_id_for_clact');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $clact_data = $this->utility_model->upload_document('seal_and_stamp_for_clact', 'clact', 'signatur_', 'seal_and_stamp');
            }
            if (!$clact_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$establishment_id) {
                $clact_data['user_id'] = $session_user_id;
                $clact_data['status'] = VALUE_ONE;
                $clact_data['created_by'] = $session_user_id;
                $clact_data['created_time'] = date('Y-m-d H:i:s');
                $establishment_id = $this->utility_model->insert_data('establishment', $clact_data);
            } else {
                $clact_data['updated_by'] = $session_user_id;
                $clact_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('establishment_id', $establishment_id, 'establishment', $clact_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['clact_data'] = $clact_data;
            $success_array['establishment_id'] = $establishment_id;
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