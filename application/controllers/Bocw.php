<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bocw extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('bocw_model');
        $this->load->model('utility_model');
    }

    function get_bocw_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['bocw_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['bocw_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'bocw', 'district', $search_district, 'bocw_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['bocw_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['bocw_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_bocw_data_by_id() {
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
            $bocw_id = get_from_post('bocw_id');
            if (!$bocw_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $bocw_data = $this->utility_model->get_by_id('bocw_id', $bocw_id, 'bocw');
            if (empty($bocw_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['bocw_data'] = $bocw_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_bocw() {
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
            $bocw_id = get_from_post('bocw_id');
            $bocw_data = $this->_get_post_data_for_bocw();
            $validation_message = $this->_check_validation_for_bocw($bocw_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $bocw_data['estimated_date_of_commencement'] = convert_to_mysql_date_format($bocw_data['estimated_date_of_commencement']);
            $bocw_data['estimated_date_of_completion'] = convert_to_mysql_date_format($bocw_data['estimated_date_of_completion']);
            $bocw_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $bocw_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$bocw_id || $bocw_id == NULL) {
                $bocw_data['user_id'] = $user_id;
                $bocw_data['created_by'] = $user_id;
                $bocw_data['created_time'] = date('Y-m-d H:i:s');
                $bocw_id = $this->utility_model->insert_data('bocw', $bocw_data);
            } else {
                $bocw_data['updated_by'] = $user_id;
                $bocw_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('bocw_id', $bocw_id, 'bocw', $bocw_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYTWO, $bocw_id);
            }
            //$this->_update_image($user_id, $bocw_id, $bocw_data, 'temp_sign_of_principal_employee', 'sign_of_principal_employee', 'sign_of_principal_employee');

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

    function _get_post_data_for_bocw() {
        $bocw_data = array();
        $bocw_data['district'] = get_from_post('district');
        $bocw_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $bocw_data['name_location_of_est'] = get_from_post('name_location_of_est');
        $bocw_data['postal_address_of_est'] = get_from_post('postal_address_of_est');
        $bocw_data['name_address_of_est'] = get_from_post('name_address_of_est');
        $bocw_data['name_address_of_manager'] = get_from_post('name_address_of_manager');
        $bocw_data['nature_of_building'] = get_from_post('nature_of_building');
        $bocw_data['max_num_building_workers'] = get_from_post('max_num_building_workers');
        $bocw_data['estimated_date_of_commencement'] = get_from_post('estimated_date_of_commencement');
        $bocw_data['estimated_date_of_completion'] = get_from_post('estimated_date_of_completion');
        return $bocw_data;
    }

    function _check_validation_for_bocw($bocw_data) {
        if (!$bocw_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$bocw_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$bocw_data['name_location_of_est']) {
            return NAME_LOCATION_MESSAGE;
        }
        if (!$bocw_data['postal_address_of_est']) {
            return POSTAL_ADDRESS_MESSAGE;
        }
        if (!$bocw_data['name_address_of_manager']) {
            return MANAGER_NAME_ADDRESS_MESSAGE;
        }
        if (!$bocw_data['nature_of_building']) {
            return BUILDING_NATURE_MESSAGE;
        }
        if (!$bocw_data['max_num_building_workers']) {
            return MAX_NUMBER_MESSAGE;
        }
        if (!$bocw_data['estimated_date_of_commencement']) {
            return COMMENCEMENT_DATE_MESSAGE;
        }
        if (!$bocw_data['estimated_date_of_completion']) {
            return COMPLETION_DATE_MESSAGE;
        }
        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $bocw_id = get_from_post('bocw_id_for_bocw_form1');
            if (!is_post() || $user_id == null || !$user_id || $bocw_id == null || !$bocw_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_bocw_data = $this->utility_model->get_by_id('bocw_id', $bocw_id, 'bocw');

            if (empty($existing_bocw_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('bocw_data' => $existing_bocw_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('bocw/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_bocw_data_by_bocw_id() {
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
            $bocw_id = get_from_post('bocw_id');
            if (!$bocw_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $bocw_data = $this->utility_model->get_by_id('bocw_id', $bocw_id, 'bocw');
            if (empty($bocw_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYTWO, $bocw_id, $bocw_data);
            $bocw_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYTWO, 'fees_bifurcation', 'module_id', $bocw_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['bocw_data'] = $bocw_data;
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
            $bocw_id = get_from_post('bocw_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$bocw_id || $bocw_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('bocw_id', $bocw_id, 'bocw');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'bocw' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('bocw_id', $bocw_id, 'bocw', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $bocw_id = get_from_post('bocw_id_for_bocw_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $bocw_id == NULL || !$bocw_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('bocw_id', $bocw_id, 'bocw');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_bocw_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $bocw_data = array();
            if ($_FILES['fees_paid_challan_for_bocw_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'bocw';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_bocw_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_bocw_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $bocw_data['status'] = VALUE_FOUR;
                $bocw_data['fees_paid_challan'] = $filename;
                $bocw_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $bocw_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $bocw_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $bocw_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYTWO, $bocw_id, $ex_em_data['district'], $ex_em_data['total_fees'], $bocw_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $bocw_data['user_payment_type'] = $user_payment_type;
            } else {
                $bocw_data['user_payment_type'] = VALUE_ZERO;
            }
            $bocw_data['updated_by'] = $user_id;
            $bocw_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('bocw_id', $bocw_id, 'bocw', $bocw_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($bocw_data['status']) ? $bocw_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $bocw_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $bocw_data['user_payment_type'] == VALUE_THREE) {
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
            $bocw_id = get_from_post('bocw_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $bocw_id == null || !$bocw_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_bocw_data = $this->utility_model->get_by_id('bocw_id', $bocw_id, 'bocw');
            if (empty($existing_bocw_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_bocw_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_bocw($existing_bocw_data);
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
            $bocw_id = get_from_post('bocw_id');
            $document_id = get_from_post('document_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$bocw_id || $bocw_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('bocw_id', $bocw_id, 'bocw');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'bocw' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['workorder_copy'];
            }
            if ($document_id == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'bocw' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_of_principal_employee'];
            }
            //        $file_path = 'documents' . DIRECTORY_SEPARATOR . 'bocw' . DIRECTORY_SEPARATOR . $ex_est_data[$document_id];
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_id == VALUE_ONE) {
                $this->utility_model->update_data('bocw_id', $bocw_id, 'bocw', array('workorder_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_id == VALUE_TWO) {
                $this->utility_model->update_data('bocw_id', $bocw_id, 'bocw', array('sign_of_principal_employee' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            //        $this->utility_model->update_data('bocw_id', $bocw_id, 'bocw', array($document_id => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_bocw_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $bocw_id = get_from_post('bocw_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $bocw_data = $this->utility_model->upload_document('workorder_copy_for_bocw', 'bocw', 'workorder_copy_', 'workorder_copy');
            }
            if ($file_no == VALUE_TWO) {
                $bocw_data = $this->utility_model->upload_document('seal_and_stamp_for_bocw', 'bocw', 'signatur_', 'sign_of_principal_employee');
            }
            if (!$bocw_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$bocw_id) {
                $bocw_data['user_id'] = $session_user_id;
                $bocw_data['status'] = VALUE_ONE;
                $bocw_data['created_by'] = $session_user_id;
                $bocw_data['created_time'] = date('Y-m-d H:i:s');
                $bocw_id = $this->utility_model->insert_data('bocw', $bocw_data);
            } else {
                $bocw_data['updated_by'] = $session_user_id;
                $bocw_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('bocw_id', $bocw_id, 'bocw', $bocw_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['bocw_data'] = $bocw_data;
            $success_array['bocw_id'] = $bocw_id;
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