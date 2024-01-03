<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rii extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        //$this->load->model('rii_model');
        $this->load->model('utility_model');
    }

    function get_rii_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['rii_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['rii_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'rii', 'district', $search_district, 'rii_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['rii_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['rii_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_rii_data_by_id() {
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
            $rii_id = get_from_post('rii_id');
            if (!$rii_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $rii_data = $this->utility_model->get_by_id('rii_id', $rii_id, 'rii');
            if (empty($rii_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['rii_data'] = $rii_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_rii() {
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
            $rii_id = get_from_post('rii_id');
            $rii_data = $this->_get_post_data_for_rii();
            $validation_message = $this->_check_validation_for_rii($rii_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $rii_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $rii_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$rii_id || $rii_id == NULL) {
                $rii_data['user_id'] = $user_id;
                $rii_data['created_by'] = $user_id;
                $rii_data['created_time'] = date('Y-m-d H:i:s');
                $rii_id = $this->utility_model->insert_data('rii', $rii_data);
            } else {
                $rii_data['updated_by'] = $user_id;
                $rii_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('rii_id', $rii_id, 'rii', $rii_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTYNINE, $rii_id);
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

    function _get_post_data_for_rii() {
        $rii_data = array();
        $rii_data['user_name'] = get_from_post('user_name');
        $rii_data['district'] = get_from_post('district');
        $rii_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $rii_data['address'] = get_from_post('address');
        $rii_data['trade'] = get_from_post('trade');
        $rii_data['reporting'] = get_from_post('reporting');
        return $rii_data;
    }

    function _check_validation_for_rii($rii_data) {
        if (!$rii_data['user_name']) {
            return USER_NAME_MESSAGE;
        }
        if (!$rii_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$rii_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$rii_data['address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$rii_data['trade']) {
            return TRADE_MESSAGE;
        }
        if (!$rii_data['reporting']) {
            return REPORT_MESSAGE;
        }
        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $rii_id = get_from_post('rii_id_for_rii_form1');
            if (!is_post() || $user_id == null || !$user_id || $rii_id == null || !$rii_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_rii_data = $this->utility_model->get_by_id('rii_id', $rii_id, 'rii');

            if (empty($existing_rii_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('rii_data' => $existing_rii_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('rii/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_rii_data_by_rii_id() {
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
            $rii_id = get_from_post('rii_id');
            if (!$rii_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $rii_data = $this->utility_model->get_by_id('rii_id', $rii_id, 'rii');
            if (empty($rii_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTYNINE, $rii_id, $rii_data);
            $rii_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTYNINE, 'fees_bifurcation', 'module_id', $rii_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['rii_data'] = $rii_data;
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
            $rii_id = get_from_post('rii_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rii_id || $rii_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('rii_id', $rii_id, 'rii');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'rii' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('rii_id', $rii_id, 'rii', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $rii_id = get_from_post('rii_id_for_rii_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $rii_id == NULL || !$rii_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('rii_id', $rii_id, 'rii');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_rii_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $rii_data = array();
            if ($_FILES['fees_paid_challan_for_rii_upload_challan']['name'] != '') {
                $main_path = 'documents/rii';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'rii';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_rii_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_rii_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $rii_data['status'] = VALUE_FOUR;
                $rii_data['fees_paid_challan'] = $filename;
                $rii_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $rii_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $rii_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $rii_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTYNINE, $rii_id, $ex_em_data['district'], $ex_em_data['total_fees'], $rii_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $rii_data['user_payment_type'] = $user_payment_type;
            } else {
                $rii_data['user_payment_type'] = VALUE_ZERO;
            }
            $rii_data['updated_by'] = $user_id;
            $rii_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('rii_id', $rii_id, 'rii', $rii_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($rii_data['status']) ? $rii_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $rii_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $rii_data['user_payment_type'] == VALUE_THREE) {
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
            $rii_id = get_from_post('rii_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $rii_id == null || !$rii_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_rii_data = $this->utility_model->get_by_id('rii_id', $rii_id, 'rii');
            if (empty($existing_rii_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_rii_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_rii($existing_rii_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
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
            $rii_id = get_from_post('rii_id');
            $document_id = get_from_post('document_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rii_id || $rii_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('rii_id', $rii_id, 'rii');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if ($document_id == VALUE_ONE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'rii' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['form_one'];
            }
            if ($document_id == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'rii' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['workorder_copy'];
            }
            if ($document_id == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'rii' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_challan'];
            }
            if ($document_id == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'rii' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_of_principal_employee'];
            }
    //        $file_path = 'documents' . DIRECTORY_SEPARATOR . 'rii' . DIRECTORY_SEPARATOR . $ex_est_data[$document_id];
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_id == VALUE_ONE) {
                $this->utility_model->update_data('rii_id', $rii_id, 'rii', array('form_one' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_id == VALUE_TWO) {
                $this->utility_model->update_data('rii_id', $rii_id, 'rii', array('workorder_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_id == VALUE_THREE) {
                $this->utility_model->update_data('rii_id', $rii_id, 'rii', array('copy_of_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_id == VALUE_FOUR) {
                $this->utility_model->update_data('rii_id', $rii_id, 'rii', array('sign_of_principal_employee' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
    //        $this->utility_model->update_data('rii_id', $rii_id, 'rii', array($document_id => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_rii_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $rii_id = get_from_post('rii_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $rii_data = $this->utility_model->upload_document('form_one_for_rii', 'rii', 'form_one_', 'form_one');
            }
            if ($file_no == VALUE_TWO) {
                $rii_data = $this->utility_model->upload_document('workorder_copy_for_rii', 'rii', 'workorder_copy_', 'workorder_copy');
            }
            if ($file_no == VALUE_THREE) {
                $rii_data = $this->utility_model->upload_document('copy_of_challan_for_rii', 'rii', 'copy_of_challan_', 'copy_of_challan');
            }
            if ($file_no == VALUE_FOUR) {
                $rii_data = $this->utility_model->upload_document('seal_and_stamp_for_rii', 'rii', 'signatur_', 'sign_of_principal_employee');
            }

            $this->db->trans_start();
            $rii_data['user_id'] = $session_user_id;
            $rii_data['status'] = VALUE_ONE;
            $rii_data['created_by'] = $session_user_id;
            $rii_data['created_time'] = date('Y-m-d H:i:s');

            if (!$rii_id) {
                $rii_id = $this->utility_model->insert_data('rii', $rii_data);
            } else {
    //            $rii_data['submitted_datetime'] = date('Y-m-d H:i:s');
                $rii_data['updated_by'] = $session_user_id;
                $rii_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('rii_id', $rii_id, 'rii', $rii_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['rii_data'] = $rii_data;
            $success_array['rii_id'] = $rii_id;
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