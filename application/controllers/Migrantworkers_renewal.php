<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrantworkers_renewal extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('migrantworkers_model');
        $this->load->model('utility_model');
    }

    function get_migrantworkers_renewal_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['migrantworkers_renewal_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['migrantworkers_renewal_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'migrantworkers_renewal', 'district', $search_district, 'migrantworkers_renewal_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['migrantworkers_renewal_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['migrantworkers_renewal_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_migrantworkers_data_by_id() {
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
            $license_number = get_from_post('license_number');
            if (!$license_number) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $migrantworkers_data = $this->utility_model->get_by_id('mw_registration_no', $license_number, 'migrantworkers');
            if (empty($migrantworkers_data)) {
                $migrantworkers_data = $this->utility_model->get_by_id('registration_number', $license_number, 'migrantworkers_renewal');
            }
            if ($migrantworkers_data != null) {
                $contractor_data = $this->migrantworkers_model->get_migrantworkers_under_all_contractor($session_user_id, $migrantworkers_data['mw_id']);
            }
            if (empty($migrantworkers_data)) {
                $shop_data = $this->utility_model->get_by_id('registration_number', $license_number, 'migrantworkers_renewal');
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['migrantworkers_data'] = $migrantworkers_data;
            if ($migrantworkers_data != null) {
                $success_array['migrantcontractors_data'] = $contractor_data;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_migrantworkers_renewal_data_by_id() {
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id');
            if (!$migrantworkers_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $migrantworkers_renewal_data = $this->utility_model->get_by_id('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal');
            if (empty($migrantworkers_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['migrantworkers_renewal_data'] = $migrantworkers_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_migrantworkers_renewal() {
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id');
            $migrantworkers_renewal_data = $this->_get_post_data_for_migrantworkers();
            $validation_message = $this->_check_validation_for_migrantworkers($migrantworkers_renewal_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $contractorData = $this->input->post('new_contractor_data');

            $this->db->trans_start();
            $migrantworkers_renewal_data['contractor_details'] = $contractorData;
            $migrantworkers_renewal_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $migrantworkers_renewal_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$migrantworkers_renewal_id || $migrantworkers_renewal_id == NULL) {
                $migrantworkers_renewal_data['user_id'] = $user_id;
                $migrantworkers_renewal_data['created_by'] = $user_id;
                $migrantworkers_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $migrantworkers_renewal_id = $this->utility_model->insert_data('migrantworkers_renewal', $migrantworkers_renewal_data);
            } else {
                $migrantworkers_renewal_data['updated_by'] = $user_id;
                $migrantworkers_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal', $migrantworkers_renewal_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTYFIVE, $migrantworkers_renewal_id);
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

    function _get_post_data_for_migrantworkers() {
        $migrantworkers_renewal_data = array();
        $migrantworkers_renewal_data['mw_id'] = get_from_post('migrantworkers_id');
        $migrantworkers_renewal_data['district'] = get_from_post('district');
        $migrantworkers_renewal_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $migrantworkers_renewal_data['registration_number'] = get_from_post('registration_number');
        $migrantworkers_renewal_data['last_valid_upto'] = convert_to_mysql_date_format(get_from_post('last_valid_upto'));
        $migrantworkers_renewal_data['name_of_establishment'] = get_from_post('name_of_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['nature_of_work_of_establishment'] = get_from_post('nature_of_work_for_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['location_of_establishment'] = get_from_post('loaction_for_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['postal_address_of_establishment'] = get_from_post('postal_address_for_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['principal_employer_name'] = get_from_post('principle_employer_full_name_for_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['principal_employer_address'] = get_from_post('principle_employer_address_for_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['directors_or_partners_name'] = get_from_post('directors_or_partners_name_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['directors_or_partners_address'] = get_from_post('directors_or_partners_address_for_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['manager_or_persons_name'] = get_from_post('manager_or_person_full_name_migrantworkersrenewal_registration');
        $migrantworkers_renewal_data['manager_or_persons_address'] = get_from_post('manager_or_person_address_for_migrantworkersrenewal_registration');
        return $migrantworkers_renewal_data;
    }

    function _check_validation_for_migrantworkers($migrantworkers_renewal_data) {
        if (!$migrantworkers_renewal_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['name_of_establishment']) {
            return ESTABLISHMENT_NAME_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['location_of_establishment']) {
            return ESTABLISHMENT_LOCATION_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['nature_of_work_of_establishment']) {
            return BUSINESS_TYPE_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['postal_address_of_establishment']) {
            return ESTABLISHMENT_POSTAL_ADDRESS_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['principal_employer_name']) {
            return PRINCIPLE_EMPLOYER_FULL_NAME_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['manager_or_persons_name']) {
            return MANAGER_FULL_NAME_MESSAGE;
        }
        if (!$migrantworkers_renewal_data['manager_or_persons_address']) {
            return MANAGER_ADDRESS_MESSAGE;
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$migrantworkers_renewal_id || $migrantworkers_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'migrantworkers' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id_for_migrantworkers_renewal_form');
            if (!is_post() || $user_id == null || !$user_id || $migrantworkers_renewal_id == null || !$migrantworkers_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_migrantworkers_data = $this->utility_model->get_by_id('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal');

            if (empty($existing_migrantworkers_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('migrantworkers_renewal_data' => $existing_migrantworkers_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('migrantworkers_renewal/pdf', $data, TRUE));
            $mpdf->Output('FORM.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_migrantworkers_renewal_data_by_migrantworkers_renewal_id() {
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id');
            if (!$migrantworkers_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $migrantworkers_renewal_data = $this->utility_model->get_by_id('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal');
            if (empty($migrantworkers_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTYFIVE, $migrantworkers_renewal_id, $migrantworkers_renewal_data);
            $migrantworkers_renewal_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTYFIVE, 'fees_bifurcation', 'module_id', $migrantworkers_renewal_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['migrantworkers_renewal_data'] = $migrantworkers_renewal_data;
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$migrantworkers_renewal_id || $migrantworkers_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'migrantworkers' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id_for_migrantworkers_renewal_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $migrantworkers_renewal_id == NULL || !$migrantworkers_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_migrantworkers_renewal_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $migrantworkers_renewal_data = array();
            if ($_FILES['fees_paid_challan_for_migrantworkers_renewal_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'migrantworkers';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_migrantworkers_renewal_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_migrantworkers_renewal_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $migrantworkers_renewal_data['status'] = VALUE_FOUR;
                $migrantworkers_renewal_data['fees_paid_challan'] = $filename;
                $migrantworkers_renewal_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $migrantworkers_renewal_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $migrantworkers_renewal_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $migrantworkers_renewal_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTYFIVE, $migrantworkers_renewal_id, $ex_em_data['district'], $ex_em_data['total_fees'], $migrantworkers_renewal_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $migrantworkers_renewal_data['user_payment_type'] = $user_payment_type;
            } else {
                $migrantworkers_renewal_data['user_payment_type'] = VALUE_ZERO;
            }
            $migrantworkers_renewal_data['updated_by'] = $user_id;
            $migrantworkers_renewal_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal', $migrantworkers_renewal_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($migrantworkers_renewal_data['status']) ? $migrantworkers_renewal_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $migrantworkers_renewal_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $migrantworkers_renewal_data['user_payment_type'] == VALUE_THREE) {
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
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $migrantworkers_renewal_id == null || !$migrantworkers_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_migrantworkers_renewal_data = $this->utility_model->get_by_id('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal');
            if (empty($existing_migrantworkers_renewal_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_migrantworkers_renewal_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_migrantworkers_renewal($existing_migrantworkers_renewal_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_migrantworkersrenewal_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $migrantworkers_renewal_id = get_from_post('migrantworkers_renewal_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $migrantworkersrenewal_data = $this->utility_model->upload_document('seal_and_stamp_for_migrantworkersrenewal', 'migrantworkers', 'signatur_', 'signature');
            }
            if (!$migrantworkersrenewal_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$migrantworkers_renewal_id) {
                $migrantworkersrenewal_data['user_id'] = $session_user_id;
                $migrantworkersrenewal_data['status'] = VALUE_ONE;
                $migrantworkersrenewal_data['created_by'] = $session_user_id;
                $migrantworkersrenewal_data['created_time'] = date('Y-m-d H:i:s');
                $migrantworkers_renewal_id = $this->utility_model->insert_data('migrantworkers_renewal', $migrantworkersrenewal_data);
            } else {
                $migrantworkersrenewal_data['updated_by'] = $session_user_id;
                $migrantworkersrenewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('migrantworkers_renewal_id', $migrantworkers_renewal_id, 'migrantworkers_renewal', $migrantworkersrenewal_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['migrantworkers_renewal_data'] = $migrantworkersrenewal_data;
            $success_array['migrantworkers_renewal_id'] = $migrantworkers_renewal_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Migrantworkers_renewal.php
 */