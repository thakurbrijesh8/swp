<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aplicence extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_aplicence_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['aplicence_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['aplicence_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'appli_licence', 'district', $search_district, 'aplicence_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['aplicence_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['aplicence_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_aplicence_data_by_id() {
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
            $aplicence_id = get_from_post('aplicence_id');
            if (!$aplicence_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $aplicence_data = $this->utility_model->get_by_id('aplicence_id', $aplicence_id, 'appli_licence');
            if (empty($aplicence_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['aplicence_data'] = $aplicence_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_aplicence() {
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
            $aplicence_id = get_from_post('aplicence_id');
            $aplicence_data = $this->_get_post_data_for_aplicence();
            $validation_message = $this->_check_validation_for_aplicence($aplicence_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $aplicence_data['date_of_certificate'] = convert_to_mysql_date_format($aplicence_data['date_of_certificate']);

            //$aplicence_data['proprietor_details'] = $proprietorData;
            $aplicence_data['user_id'] = $user_id;
            $aplicence_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $aplicence_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$aplicence_id || $aplicence_id == NULL) {
                $aplicence_data['created_by'] = $user_id;
                $aplicence_data['created_time'] = date('Y-m-d H:i:s');
                $aplicence_id = $this->utility_model->insert_data('appli_licence', $aplicence_data);
            } else {
                $aplicence_data['updated_by'] = $user_id;
                $aplicence_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', $aplicence_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTYTHREE, $aplicence_id);
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

    function _get_post_data_for_aplicence() {
        $aplicence_data = array();
        $aplicence_data['district'] = get_from_post('district');
        $aplicence_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $aplicence_data['contractor_name'] = get_from_post('contractor_name');
        $aplicence_data['contractor_fathername'] = get_from_post('contractor_fathername');
        $aplicence_data['contractor_address'] = get_from_post('contractor_address');
        $aplicence_data['contractor_contact'] = get_from_post('contractor_contact');
        $aplicence_data['contractor_email'] = get_from_post('contractor_email');
        $aplicence_data['establi_name'] = get_from_post('establi_name');
        $aplicence_data['establi_address'] = get_from_post('establi_address');
        $aplicence_data['no_of_certificate'] = get_from_post('no_of_certificate');
        $aplicence_data['date_of_certificate'] = get_from_post('date_of_certificate');
        $aplicence_data['employer_name'] = get_from_post('employer_name');
        $aplicence_data['employer_address'] = get_from_post('employer_address');
        $aplicence_data['nature_of_process_for_establi'] = get_from_post('nature_of_process_for_establi');
        $aplicence_data['nature_of_process_for_labour'] = get_from_post('nature_of_process_for_labour');
        $aplicence_data['duration_of_work'] = get_from_post('duration_of_work');
        $aplicence_data['name_of_agent'] = get_from_post('establi_address');
        $aplicence_data['address_of_agent'] = get_from_post('address_of_agent');
        $aplicence_data['max_no_of_empl'] = get_from_post('max_no_of_empl');
        $aplicence_data['if_contractor_work_other_place'] = get_from_post('if_contractor_work_other_place');
        $aplicence_data['detail_of_other_work'] = get_from_post('detail_of_other_work');
        $aplicence_data['estimeted_value'] = get_from_post('estimeted_value');
        return $aplicence_data;
    }

    function _check_validation_for_aplicence($aplicence_data) {
        if (!$aplicence_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$aplicence_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$aplicence_data['contractor_name']) {
            return CONTRACTOR_NAME_MESSAGE;
        }
        if (!$aplicence_data['contractor_fathername']) {
            return CONTRACTOR_FATHER_NAME_MESSAGE;
        }
        if (!$aplicence_data['contractor_address']) {
            return CONTRACTOR_ADDRESS_MESSAGE;
        }
        if (!$aplicence_data['contractor_contact']) {
            return CONTRACTOR_CONTACT_MESSAGE;
        }
        if (!$aplicence_data['contractor_email']) {
            return ESTABLISHMENT_NAME_MESSAGE;
        }
        if (!$aplicence_data['establi_name']) {
            return ESTABLISHMENT_ADDRESS_MESSAGE;
        }
        if (!$aplicence_data['establi_address']) {
            return CERTIFICATE_NO_MESSAGE;
        }
        if (!$aplicence_data['no_of_certificate']) {
            return CERTIFICATE_DATE_MESSAGE;
        }
        if (!$aplicence_data['date_of_certificate']) {
            return CERTIFICATE_DATE_MESSAGE;
        }
        if (!$aplicence_data['employer_name']) {
            return EMPLOYER_NAME_MESSAGE;
        }
        if (!$aplicence_data['employer_address']) {
            return EMPLOYER_ADDRESS_MESSAGE;
        }
        if (!$aplicence_data['nature_of_process_for_establi']) {
            return NATURE_PROCESS_MESSAGE;
        }
        if (!$aplicence_data['nature_of_process_for_labour']) {
            return NATURE_PROCESS_LABOUR_MESSAGE;
        }
        if (!$aplicence_data['duration_of_work']) {
            return DURATION_WORK_MESSAGE;
        }
        if (!$aplicence_data['name_of_agent']) {
            return NAME_OF_AGENT_MESSAGE;
        }
        if (!$aplicence_data['address_of_agent']) {
            return AGENT_ADDRESS_MESSAGE;
        }
        if (!$aplicence_data['max_no_of_empl']) {
            return MAX_NO_MESSAGE;
        }
        if (!$aplicence_data['estimeted_value']) {
            return ESTABLISHMENT_MESSAGE;
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
            $aplicence_id = get_from_post('aplicence_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$aplicence_id || $aplicence_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('aplicence_id', $aplicence_id, 'appli_licence');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'aplicence' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['formv_doc'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'aplicence' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['formiv_doc'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'aplicence' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['register_certification_doc'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'aplicence' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', array('formv_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', array('formiv_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', array('register_certification_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $aplicence_id = get_from_post('aplicence_id_for_aplicence_form1');
            if (!is_post() || $user_id == null || !$user_id || $aplicence_id == null || !$aplicence_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_aplicence_data = $this->utility_model->get_by_id('aplicence_id', $aplicence_id, 'appli_licence');

            if (empty($existing_aplicence_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('aplicence_data' => $existing_aplicence_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('aplicence/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_aplicence_data_by_aplicence_id() {
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
            $aplicence_id = get_from_post('aplicence_id');
            if (!$aplicence_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $aplicence_data = $this->utility_model->get_by_id('aplicence_id', $aplicence_id, 'appli_licence');
            if (empty($aplicence_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTYTHREE, $aplicence_id, $aplicence_data);
            $aplicence_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTYTHREE, 'fees_bifurcation', 'module_id', $aplicence_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['aplicence_data'] = $aplicence_data;
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
            $aplicence_id = get_from_post('aplicence_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$aplicence_id || $aplicence_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('aplicence_id', $aplicence_id, 'appli_licence');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'aplicence' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $aplicence_id = get_from_post('aplicence_id_for_aplicence_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $aplicence_id == NULL || !$aplicence_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('aplicence_id', $aplicence_id, 'appli_licence');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_aplicence_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $aplicence_data = array();
            if ($_FILES['fees_paid_challan_for_aplicence_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'aplicence';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_aplicence_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_aplicence_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $aplicence_data['status'] = VALUE_FOUR;
                $aplicence_data['fees_paid_challan'] = $filename;
                $aplicence_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $aplicence_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $aplicence_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $aplicence_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTYTHREE, $aplicence_id, $ex_em_data['district'], $ex_em_data['total_fees'], $aplicence_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $aplicence_data['user_payment_type'] = $user_payment_type;
            } else {
                $aplicence_data['user_payment_type'] = VALUE_ZERO;
            }
            $aplicence_data['updated_by'] = $user_id;
            $aplicence_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', $aplicence_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($aplicence_data['status']) ? $aplicence_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $aplicence_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $aplicence_data['user_payment_type'] == VALUE_THREE) {
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
            $aplicence_id = get_from_post('aplicence_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $aplicence_id == null || !$aplicence_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_aplicence_data = $this->utility_model->get_by_id('aplicence_id', $aplicence_id, 'appli_licence');
            if (empty($existing_aplicence_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_aplicence_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $this->utility_lib->gc_for_appli_licence($existing_aplicence_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_aplicence_document() {
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
            $aplicence_id = get_from_post('aplicence_id');
            $file_no = get_from_post('file_no');
            $aplicence_data = '';
            if ($file_no == VALUE_ONE) {
                $aplicence_data = $this->utility_model->upload_document('formv_doc_for_aplicence', 'aplicence', 'formv_doc_', 'formv_doc');
            }
            if ($file_no == VALUE_TWO) {
                $aplicence_data = $this->utility_model->upload_document('formiv_doc_for_aplicence', 'aplicence', 'formiv_doc_', 'formiv_doc');
            }
            if ($file_no == VALUE_THREE) {
                $aplicence_data = $this->utility_model->upload_document('register_certification_doc_for_aplicence', 'aplicence', 'register_certification_doc', 'register_certification_doc');
            }
            if ($file_no == VALUE_FOUR) {
                $aplicence_data = $this->utility_model->upload_document('seal_and_stamp_for_aplicence', 'aplicence', 'signatur_', 'signature');
            }
            if (!$aplicence_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$aplicence_id) {
                $aplicence_data['user_id'] = $session_user_id;
                $aplicence_data['status'] = VALUE_ONE;
                $aplicence_data['created_by'] = $session_user_id;
                $aplicence_data['created_time'] = date('Y-m-d H:i:s');
                $aplicence_id = $this->utility_model->insert_data('appli_licence', $aplicence_data);
            } else {
                $aplicence_data['updated_by'] = $session_user_id;
                $aplicence_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('aplicence_id', $aplicence_id, 'appli_licence', $aplicence_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['aplicence_data'] = $aplicence_data;
            $success_array['aplicence_id'] = $aplicence_id;
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