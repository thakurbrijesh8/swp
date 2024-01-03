<?php

class Migrantworkers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('migrantworkers_model');
        $this->load->model('utility_model');
    }

    public function index() {
        
    }

    public function get_all_migrantworkers() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['migrantworkers_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['migrantworkers_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'migrantworkers', 'district', $search_district, 'mw_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['migrantworkers_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['migrantworkers_data'] = array();
            echo json_encode($success_array);
        }
    }

    function submit_migrantworkers() {
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
            $mw_id = get_from_post('mw_id');
            $migrantworkers_data = $this->_get_post_data();
            $validation_message = $this->_check_validation($migrantworkers_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $new_est_cont_data = json_decode($this->input->post('new_contractor_data'), TRUE);
            $exi_est_cont_data = json_decode($this->input->post('exi_contractor_data'), TRUE);
            if (empty($new_est_cont_data) && empty($exi_est_cont_data)) {
                echo json_encode(get_error_array(ONE_CONTRACTOR_MESSAGE));
                return false;
            }

            $this->db->trans_start();
            $migrantworkers_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $migrantworkers_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$mw_id || $mw_id == NULL) {
                $migrantworkers_data['user_id'] = $user_id;
                $migrantworkers_data['mw_declaration'] = VALUE_ONE;
                $migrantworkers_data['created_by'] = $user_id;
                $migrantworkers_data['created_time'] = date('Y-m-d H:i:s');
                $mw_id = $this->utility_model->insert_data('migrantworkers', $migrantworkers_data);
            } else {
                $migrantworkers_data['updated_by'] = $user_id;
                $migrantworkers_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('mw_id', $mw_id, 'migrantworkers', $migrantworkers_data);
            }
            if (!empty($exi_est_cont_data)) {
                $ex_ids = array();
                foreach ($exi_est_cont_data as &$value) {
                    $value['updated_by'] = $user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                    array_push($ex_ids, $value['mc_id']);
                }
                $this->utility_model->update_data_batch('mc_id', 'migrantcontractors', $exi_est_cont_data);
                if (!empty($ex_ids)) {
                    $update_data = array();
                    $update_data['is_delete'] = IS_DELETE;
                    $update_data['updated_by'] = $user_id;
                    $update_data['updated_time'] = date('Y-m-d H:i:s');
                    $this->utility_model->update_data_not_in('mw_id', $mw_id, 'mc_id', $ex_ids, 'migrantcontractors', $update_data);
                }
            }
            if (!empty($new_est_cont_data)) {
                foreach ($new_est_cont_data as &$value) {
    //                $value['user_id'] = $user_id;
                    $value['mw_id'] = $mw_id;
                    $value['created_by'] = $user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('migrantcontractors', $new_est_cont_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYFOUR, $mw_id);
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

    public function _get_post_data() {
        $migrantworkers_data = array();
        $user_type = get_from_session('temp_type_for_eodbsws');
        $migrantworkers_data['district'] = get_from_post('district');
        $migrantworkers_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $migrantworkers_data['mw_name_of_establishment'] = get_from_post('name_of_migrantworkers_registration');
        $migrantworkers_data['mw_nature_of_work_of_establishment'] = get_from_post('nature_of_work_for_migrantworkers_registration');
        $migrantworkers_data['mw_location_of_establishment'] = get_from_post('loaction_for_migrantworkers_registration');
        $migrantworkers_data['mw_postal_address_of_establishment'] = get_from_post('postal_address_for_migrantworkers_registration');
        $migrantworkers_data['mw_principal_employer_name'] = get_from_post('principle_employer_full_name_for_migrantworkers_registration');
        $migrantworkers_data['mw_principal_employer_address'] = get_from_post('principle_employer_address_for_migrantworkers_registration');
        $migrantworkers_data['mw_directors_or_partners_name'] = get_from_post('directors_or_partners_name_migrantworkers_registration');
        $migrantworkers_data['mw_directors_or_partners_address'] = get_from_post('directors_or_partners_address_for_migrantworkers_registration');
        $migrantworkers_data['mw_manager_or_persons_name'] = get_from_post('manager_or_person_full_name_migrantworkers_registration');
        $migrantworkers_data['mw_manager_or_persons_address'] = get_from_post('manager_or_person_address_for_migrantworkers_registration');
        return $migrantworkers_data;
    }

    public function _check_validation($migrantworkers_data) {
        if (!$migrantworkers_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$migrantworkers_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$migrantworkers_data['mw_name_of_establishment']) {
            return ESTABLISHMENT_NAME_MESSAGE;
        }
        if (!$migrantworkers_data['mw_nature_of_work_of_establishment']) {
            return BUSINESS_TYPE_MESSAGE;
        }
        if (!$migrantworkers_data['mw_location_of_establishment']) {
            return ESTABLISHMENT_LOCATION_MESSAGE;
        }
        if (!$migrantworkers_data['mw_postal_address_of_establishment']) {
            return ESTABLISHMENT_POSTAL_ADDRESS_MESSAGE;
        }
        if (!$migrantworkers_data['mw_principal_employer_name']) {
            return PRINCIPLE_EMPLOYER_FULL_NAME_MESSAGE;
        }
        if (!$migrantworkers_data['mw_manager_or_persons_name']) {
            return MANAGER_FULL_NAME_MESSAGE;
        }
        if (!$migrantworkers_data['mw_manager_or_persons_address']) {
            return MANAGER_ADDRESS_MESSAGE;
        }

        return '';
    }

    public function get_migrantworkers_by_id() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            $mw_id = get_from_post('mw_id');
            if (!is_post() || $user_id == null || !$user_id || $mw_id == null || !$mw_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $post_id_validation_message = $this->utility_lib->check_post_id_validation('mw_id', $mw_id, 'migrantworkers');
            if ($post_id_validation_message != '') {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $migrantworkers_data = $this->utility_model->get_by_id('mw_id', $mw_id, 'migrantworkers');
            if (empty($migrantworkers_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $contractor_data = $this->migrantworkers_model->get_migrantworkers_under_all_contractor($user_id, $mw_id);
    //        if (empty($contractor_data)) {
    //            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE.'4'));
    //            return false;
    //        }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['migrantworkers_data'] = $migrantworkers_data;
            $success_array['contractor_data'] = $contractor_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    public function generate_formI_pdf() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $mw_id = get_from_post('mw_id_for_pdf');
            if (!is_post() || $user_id == null || !$user_id || $mw_id == null || !$mw_id) {
                print_r('Invalid Access');
                return false;
            }
            $this->db->trans_start();
            $existing_migrantworkers_data = $this->utility_model->get_by_id('mw_id', $mw_id, 'migrantworkers');
            $migrantworkers_under_all_contractor = $this->migrantworkers_model->get_migrantworkers_under_all_contractor($user_id, $mw_id);
            if (empty($existing_migrantworkers_data)) {
                print_r('Invalid Access');
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r('Some unexpected database error encountered due to which your transaction could not be complete');

                return;
            }
            error_reporting(E_ERROR);
            $data = array('migrantworkers_data' => $existing_migrantworkers_data, 'migrantworkers_under_all_contractor' => $migrantworkers_under_all_contractor);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('migrantworkers/formI_pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function generate_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $mw_id = get_from_post('mw_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $mw_id == null || !$mw_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_migrantworkers_data = $this->utility_model->get_by_id('mw_id', $mw_id, 'migrantworkers');
            if (empty($existing_migrantworkers_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_migrantworkers_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_migrantworkers($existing_migrantworkers_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_migrantworkers_data_by_migrantworkers_id() {
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
            $mw_id = get_from_post('mw_id');
            if (!$mw_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $migrantworkers_data = $this->utility_model->get_by_id_with_applicant_name('mw_id', $mw_id, 'migrantworkers');
            if (empty($migrantworkers_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYFOUR, $mw_id, $migrantworkers_data);
            $migrantworkers_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYFOUR, 'fees_bifurcation', 'module_id', $mw_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['migrantworkers_data'] = $migrantworkers_data;
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
            $mw_id = get_from_post('migrantworkers_id_for_migrantworkers_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $mw_id == NULL || !$mw_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('mw_id', $mw_id, 'migrantworkers');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_migrantworkers_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $migrantworkers_data = array();
            if ($_FILES['fees_paid_challan_for_migrantworkers_upload_challan']['name'] != '') {
                $main_path = 'documents/migrantworkers/';
                if (!is_dir($main_path)) {
                    mkdir($main_path);
                    chmod("$main_path", 0755);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_migrantworkers_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_migrantworkers_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $migrantworkers_data['status'] = VALUE_FOUR;
                $migrantworkers_data['fees_paid_challan'] = $filename;
                $migrantworkers_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $migrantworkers_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $migrantworkers_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $migrantworkers_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYFOUR, $mw_id, $ex_em_data['district'], $ex_em_data['total_fees'], $migrantworkers_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $migrantworkers_data['user_payment_type'] = $user_payment_type;
            } else {
                $migrantworkers_data['user_payment_type'] = VALUE_ZERO;
            }
            $migrantworkers_data['updated_by'] = $user_id;
            $migrantworkers_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('mw_id', $mw_id, 'migrantworkers', $migrantworkers_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($migrantworkers_data['status']) ? $migrantworkers_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $migrantworkers_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $migrantworkers_data['user_payment_type'] == VALUE_THREE) {
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

    function remove_fees_paid_challan() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $mw_id = get_from_post('mw_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$mw_id || $mw_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('mw_id', $mw_id, 'migrantworkers');
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
            $this->utility_model->update_data('mw_id', $mw_id, 'migrantworkers', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $mw_id = get_from_post('mw_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$mw_id || $mw_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('mw_id', $mw_id, 'migrantworkers');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'migrantworkers' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['mw_sign_of_principal_employer'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('mw_id', $mw_id, 'migrantworkers', array('mw_sign_of_principal_employer' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_migrantworkers_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $mw_id = get_from_post('mw_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $migrantworkers_data = $this->utility_model->upload_document('seal_and_stamp_for_migrantworkers', 'migrantworkers', 'signatur_', 'mw_sign_of_principal_employer');
            }
            if (!$migrantworkers_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$mw_id) {
                $migrantworkers_data['user_id'] = $session_user_id;
                $migrantworkers_data['status'] = VALUE_ONE;
                $migrantworkers_data['created_by'] = $session_user_id;
                $migrantworkers_data['created_time'] = date('Y-m-d H:i:s');
                $mw_id = $this->utility_model->insert_data('migrantworkers', $migrantworkers_data);
            } else {
                $migrantworkers_data['updated_by'] = $session_user_id;
                $migrantworkers_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('mw_id', $mw_id, 'migrantworkers', $migrantworkers_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['migrantworkers_data'] = $migrantworkers_data;
            $success_array['mw_id'] = $mw_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

}

/*
* EOF: ./application/controllers/Migrantworkers.php
*/
