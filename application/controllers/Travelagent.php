<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Travelagent extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_travelagent_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['travelagent_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['travelagent_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'travelagent', 'area_of_agency', $search_district, 'travelagent_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['travelagent_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['travelagent_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_travelagent_data_by_id() {
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
            $travelagent_id = get_from_post('travelagent_id');
            if (!$travelagent_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $travelagent_data = $this->utility_model->get_by_id('travelagent_id', $travelagent_id, 'travelagent');
            if (empty($travelagent_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['travelagent_data'] = $travelagent_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_travelagent() {
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
            $travelagent_id = get_from_post('travelagent_id');
            $travelagent_data = $this->_get_post_data_for_travelagent();
            $validation_message = $this->_check_validation_for_travelagent($travelagent_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $travelagent_data['fees'] = TRAVEL_AGENCY_FEES;
            $travelagent_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $travelagent_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$travelagent_id || $travelagent_id == NULL) {
                $travelagent_data['user_id'] = $user_id;
                $travelagent_data['created_by'] = $user_id;
                $travelagent_data['created_time'] = date('Y-m-d H:i:s');
                $travelagent_id = $this->utility_model->insert_data('travelagent', $travelagent_data);
            } else {
                $travelagent_data['updated_by'] = $user_id;
                $travelagent_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('travelagent_id', $travelagent_id, 'travelagent', $travelagent_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_NINETEEN, $travelagent_id);
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

    function _get_post_data_for_travelagent() {
        $travelagent_data = array();
        $travelagent_data['name_of_person'] = get_from_post('name_of_person');
        $travelagent_data['name_of_travel_agency'] = get_from_post('name_of_travel_agency');
        $travelagent_data['address_of_agency'] = get_from_post('address_of_agency');
        $travelagent_data['area_of_agency'] = get_from_post('area_of_agency');
        $travelagent_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $travelagent_data['mob_no'] = get_from_post('mob_no');

        return $travelagent_data;
    }

    function _check_validation_for_travelagent($travelagent_data) {

        if (!$travelagent_data['name_of_person']) {
            return PERSON_NAME_MESSAGE;
        }
        if (!$travelagent_data['name_of_travel_agency']) {
            return TRAVEL_AGENCY_NAME_MESSAGE;
        }
        if (!$travelagent_data['address_of_agency']) {
            return ADDRESS_OF_AGENCY_MESSAGE;
        }
        if (!$travelagent_data['area_of_agency']) {
            return AREA_OF_AGENCY_MESSAGE;
        }
        if (!$travelagent_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$travelagent_data['mob_no']) {
            return MOBILE_NUMBER_MESSAGE;
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
            $travelagent_id = get_from_post('travelagent_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$travelagent_id || $travelagent_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('travelagent_id', $travelagent_id, 'travelagent');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'travelagent' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_registration'];
            }

            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'travelagent' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('travelagent_id', $travelagent_id, 'travelagent', array('copy_of_registration' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('travelagent_id', $travelagent_id, 'travelagent', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $travelagent_id = get_from_post('travelagent_id_for_travelagent_form');
            if (!is_post() || $user_id == null || !$user_id || $travelagent_id == null || !$travelagent_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_travelagent_data = $this->utility_model->get_by_id('travelagent_id', $travelagent_id, 'travelagent');

            if (empty($existing_travelagent_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $taluka_array = $this->config->item('taluka_array');
            $existing_travelagent_data['area_of_agency'] = isset($taluka_array[$existing_travelagent_data['area_of_agency']]) ? $taluka_array[$existing_travelagent_data['area_of_agency']] : '-';
            error_reporting(E_ERROR);
            $data = array('travelagent_data' => $existing_travelagent_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('travelagent/pdf', $data, TRUE));
            $mpdf->Output('FORM.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_travelagent_data_by_travelagent_id() {
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
            $travelagent_id = get_from_post('travelagent_id');
            if (!$travelagent_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $travelagent_data = $this->utility_model->get_by_id('travelagent_id', $travelagent_id, 'travelagent');
            if (empty($travelagent_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_NINETEEN, $travelagent_id, $travelagent_data);
            $travelagent_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_NINETEEN, 'fees_bifurcation', 'module_id', $travelagent_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['travelagent_data'] = $travelagent_data;
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
            $travelagent_id = get_from_post('travelagent_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$travelagent_id || $travelagent_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('travelagent_id', $travelagent_id, 'travelagent');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'travelagent' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('travelagent_id', $travelagent_id, 'travelagent', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $travelagent_id = get_from_post('travelagent_id_for_travelagent_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $travelagent_id == NULL || !$travelagent_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('travelagent_id', $travelagent_id, 'travelagent');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_travelagent_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $travelagent_data = array();
            if ($_FILES['fees_paid_challan_for_travelagent_upload_challan']['name'] != '') {
                $main_path = 'documents/travelagent';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'travelagent';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_travelagent_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_travelagent_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $travelagent_data['status'] = VALUE_FOUR;
                $travelagent_data['fees_paid_challan'] = $filename;
                $travelagent_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $travelagent_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $travelagent_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $travelagent_data['status'] = VALUE_THREE;
                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_NINETEEN, $travelagent_id, $ex_em_data['area_of_agency'], $ex_em_data['total_fees'], $travelagent_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $travelagent_data['user_payment_type'] = $user_payment_type;
            } else {
                $travelagent_data['user_payment_type'] = VALUE_ZERO;
            }
            $travelagent_data['updated_by'] = $user_id;
            $travelagent_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('travelagent_id', $travelagent_id, 'travelagent', $travelagent_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($travelagent_data['status']) ? $travelagent_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $travelagent_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $travelagent_data['user_payment_type'] == VALUE_THREE) {
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
            $travelagent_id = get_from_post('travelagent_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $travelagent_id == null || !$travelagent_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_travelagent_data = $this->utility_model->get_by_id('travelagent_id', $travelagent_id, 'travelagent');
            if (empty($existing_travelagent_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_travelagent_data['status'] != VALUE_FIVE) {
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
            $existing_travelagent_data['area_of_agency'] = isset($taluka_array[$existing_travelagent_data['area_of_agency']]) ? $taluka_array[$existing_travelagent_data['area_of_agency']] : '-';
            $this->utility_lib->gc_for_travelagent($existing_travelagent_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_travelagent_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $travelagent_id = get_from_post('travelagent_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $travelagent_data = $this->utility_model->upload_document('copy_of_registration_for_travelagent', 'travelagent', 'copy_of_registration_', 'copy_of_registration');
            }
            if ($file_no == VALUE_TWO) {
                $travelagent_data = $this->utility_model->upload_document('seal_and_stamp_for_travelagent', 'travelagent', 'signature_', 'signature');
            }
            if (!$travelagent_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$travelagent_id) {
                $travelagent_data['user_id'] = $session_user_id;
                $travelagent_data['status'] = VALUE_ONE;
                $travelagent_data['created_by'] = $session_user_id;
                $travelagent_data['created_time'] = date('Y-m-d H:i:s');
                $travelagent_id = $this->utility_model->insert_data('travelagent', $travelagent_data);
            } else {
                $travelagent_data['updated_by'] = $session_user_id;
                $travelagent_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('travelagent_id', $travelagent_id, 'travelagent', $travelagent_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['travelagent_data'] = $travelagent_data;
            $success_array['travelagent_id'] = $travelagent_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Travelagent.php
 */