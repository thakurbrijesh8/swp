<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wc extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_wc_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['wc_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['wc_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'wc', 'district', $search_district, 'wc_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['wc_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['wmregistration_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_wc_data_by_id() {
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
            $wc_id = get_from_post('wc_id');
            if (!$wc_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $wc_data = $this->utility_model->get_by_id('wc_id', $wc_id, 'wc');
            if (empty($wc_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['wc_data'] = $wc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_wc() {
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
            $wc_id = get_from_post('wc_id');
            $wc_data = $this->_get_post_data_for_wc();
            $validation_message = $this->_check_validation_for_wc($wc_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $wc_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $wc_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$wc_id || $wc_id == NULL) {
                $wc_data['user_id'] = $user_id;
                $wc_data['created_by'] = $user_id;
                $wc_data['created_time'] = date('Y-m-d H:i:s');
                $wc_data['declaration'] = VALUE_ONE;
                $wc_id = $this->utility_model->insert_data('wc', $wc_data);
            } else {
                $wc_data['updated_by'] = $user_id;
                $wc_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('wc_id', $wc_id, 'wc', $wc_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FIVE, $wc_id);
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

    function _get_post_data_for_wc() {
        $wc_data = array();
        $wc_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $wc_data['house_no'] = get_from_post('house_no');
        $wc_data['ward_no'] = get_from_post('ward_no');
        $wc_data['village'] = get_from_post('village');
        $wc_data['panchayat_or_dmc'] = get_from_post('panchayat_or_dmc');
        $wc_data['application_category'] = get_from_post('application_category');
        $wc_data['house_ownership'] = get_from_post('house_ownership');
        $wc_data['wc_type'] = get_from_post('wc_type');
        $wc_data['diameter_service_connection'] = get_from_post('diameter_service_connection');
        $wc_data['water_meter'] = get_from_post('water_meter');
        $wc_data['district'] = get_from_post('district');
        $wc_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        return $wc_data;
    }

    function _check_validation_for_wc($wc_data) {
        if (!$wc_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$wc_data['house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$wc_data['ward_no']) {
            return WARD_NO_MESSAGE;
        }
        if (!$wc_data['village']) {
            return VILLAGE_MESSAGE;
        }
        if (!$wc_data['panchayat_or_dmc']) {
            return PANCHAYT_OR_DMC_MESSAGE;
        }
        if (!$wc_data['application_category']) {
            return APPLICANT_CATEGORY_WC_MESSAGE;
        }
        if (!$wc_data['house_ownership']) {
            return HOUSE_OWNERSHIP_MESSAGE;
        }
        if (!$wc_data['wc_type']) {
            return WC_TYPE_MESSAGE;
        }
        if (!$wc_data['diameter_service_connection']) {
            return DIAMETER_SERVICE_CONNECTION_MESSAGE;
        }
        if (!$wc_data['water_meter']) {
            return WATER_METER_MESSAGE;
        }
        if (!$wc_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$wc_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
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
            $wc_id = get_from_post('wc_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$wc_id || $wc_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('wc_id', $wc_id, 'wc');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wc' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['receipt_of_last_years_house_tax'];
            } else if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wc' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            } else if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wc' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['id_proof'];
            } else if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wc' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['electricity_bill'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('wc_id', $wc_id, 'wc', array('receipt_of_last_years_house_tax' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('wc_id', $wc_id, 'wc', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('wc_id', $wc_id, 'wc', array('id_proof' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('wc_id', $wc_id, 'wc', array('electricity_bill' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $wc_id = get_from_post('wc_id_for_wc_form1');
            if (!is_post() || $user_id == null || !$user_id || $wc_id == null || !$wc_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_wc_data = $this->utility_model->get_by_id('wc_id', $wc_id, 'wc');

            if (empty($existing_wc_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('wc_data' => $existing_wc_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('wc/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_wc_data_by_wc_id() {
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
            $wc_id = get_from_post('wc_id');
            if (!$wc_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $wc_data = $this->utility_model->get_by_id('wc_id', $wc_id, 'wc');
            if (empty($wc_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FIVE, $wc_id, $wc_data);
            $wc_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FIVE, 'fees_bifurcation', 'module_id', $wc_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            $success_array = get_success_array();
            $success_array['wc_data'] = $wc_data;
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
            $wc_id = get_from_post('wc_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$wc_id || $wc_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('wc_id', $wc_id, 'wc');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'wc' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('wc_id', $wc_id, 'wc', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $wc_id = get_from_post('wc_id_for_wc_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $wc_id == NULL || !$wc_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('wc_id', $wc_id, 'wc');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_wc_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $wc_data = array();
            if ($_FILES['fees_paid_challan_for_wc_upload_challan']['name'] != '') {
                $main_path = 'documents/wc';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'wc';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_wc_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_wc_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $wc_data['status'] = VALUE_FOUR;
                $wc_data['fees_paid_challan'] = $filename;
                $wc_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $wc_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $wc_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $wc_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FIVE, $wc_id, $ex_em_data['district'], $ex_em_data['total_fees'], $wc_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $wc_data['user_payment_type'] = $user_payment_type;
            } else {
                $wc_data['user_payment_type'] = VALUE_ZERO;
            }
            $wc_data['updated_by'] = $user_id;
            $wc_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('wc_id', $wc_id, 'wc', $wc_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($wc_data['status']) ? $wc_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $wc_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $wc_data['user_payment_type'] == VALUE_THREE) {
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
            $wc_id = get_from_post('wc_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $wc_id == null || !$wc_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_wc_data = $this->utility_model->get_by_id('wc_id', $wc_id, 'wc');
            if (empty($existing_wc_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_wc_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_wc($existing_wc_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_wc_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $wc_id = get_from_post('wc_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $wc_data = $this->utility_model->upload_document('receipt_of_last_years_house_tax', 'wc', 'receipt_of_last_years_house_tax_', 'receipt_of_last_years_house_tax');
            }
            if ($file_no == VALUE_TWO) {
                $wc_data = $this->utility_model->upload_document('seal_and_stamp_for_wc', 'wc', 'signatur_', 'signature');
            }
            if ($file_no == VALUE_THREE) {
                $wc_data = $this->utility_model->upload_document('id_proof', 'wc', 'id_proof_', 'id_proof');
            }
            if ($file_no == VALUE_FOUR) {
                $wc_data = $this->utility_model->upload_document('electricity_bill', 'wc', 'electricity_bill_', 'electricity_bill');
            }
            if (!$wc_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$wc_id) {
                $wc_data['user_id'] = $session_user_id;
                $wc_data['status'] = VALUE_ONE;
                $wc_data['created_by'] = $session_user_id;
                $wc_data['created_time'] = date('Y-m-d H:i:s');
                $wc_id = $this->utility_model->insert_data('wc', $wc_data);
            } else {
                $wc_data['updated_by'] = $session_user_id;
                $wc_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('wc_id', $wc_id, 'wc', $wc_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['wc_data'] = $wc_data;
            $success_array['wc_id'] = $wc_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/WC.php
 */