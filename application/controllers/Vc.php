<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vc extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_vc_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['vc_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['vc_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'vc', 'district', $search_district, 'vc_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['vc_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['vc_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_vc_data_by_id() {
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
            $vc_id = get_from_post('vc_id');
            if (!$vc_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $vc_data = $this->utility_model->get_by_id('vc_id', $vc_id, 'vc');
            if (empty($vc_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['vc_data'] = $vc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_vc() {
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
            $vc_id = get_from_post('vc_id');
            $vc_data = $this->_get_post_data_for_vc();
            $validation_message = $this->_check_validation_for_vc($vc_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $vc_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $vc_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$vc_id || $vc_id == NULL) {
                $vc_data['user_id'] = $user_id;
                $vc_data['created_by'] = $user_id;
                $vc_data['created_time'] = date('Y-m-d H:i:s');
                $vc_id = $this->utility_model->insert_data('vc', $vc_data);
            } else {
                $vc_data['updated_by'] = $user_id;
                $vc_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('vc_id', $vc_id, 'vc', $vc_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTYEIGHT, $vc_id);
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

    function _get_post_data_for_vc() {
        $vc_data = array();
        $vc_data['district'] = get_from_post('district');
        $vc_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $vc_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $vc_data['address'] = get_from_post('address');
        $vc_data['trade'] = get_from_post('trade');
        $vc_data['type'] = get_from_post('type');
        $vc_data['sub_type'] = get_from_post('sub_type');
        $vc_data['capacity'] = get_from_post('capacity');
        $vc_data['capacity_type'] = get_from_post('capacity_type');
        $vc_data['class'] = get_from_post('class');
        $vc_data['make'] = get_from_post('make');
        $vc_data['model_no'] = get_from_post('model_no');
        $vc_data['serial_no'] = get_from_post('serial_no');
        $vc_data['verification_at'] = get_from_post('verification_at');
        $vc_data['quantity_units'] = get_from_post('quantity_units');
        return $vc_data;
    }

    function _check_validation_for_vc($vc_data) {
        if (!$vc_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$vc_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$vc_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$vc_data['address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$vc_data['trade']) {
            return SELECT_ONE_OPTION_MESSAGE;
        }
//        if (!$vc_data['type']) {
//            return SELECT_ONE_OPTION_MESSAGE;
//        }
//        if (!$vc_data['sub_type']) {
//            return SELECT_ONE_OPTION_MESSAGE;
//        }
        if (!$vc_data['capacity']) {
            return CAPACITY_MESSAGE;
        }
        if (!$vc_data['class']) {
            return SELECT_ONE_OPTION_MESSAGE;
        }
        if (!$vc_data['make']) {
            return MAKE_MESSAGE;
        }
        if (!$vc_data['model_no']) {
            return MODEL_NO_MESSAGE;
        }
        if (!$vc_data['serial_no']) {
            return SERIAL_NO_MESSAGE;
        }
        if (!$vc_data['verification_at']) {
            return SELECT_ONE_OPTION_MESSAGE;
        }
        if (!$vc_data['quantity_units']) {
            return SELECT_ONE_OPTION_MESSAGE;
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
            $vc_id = get_from_post('vc_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$vc_id || $vc_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('vc_id', $vc_id, 'vc');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'vc' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['invoice_doc'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('vc_id', $vc_id, 'vc', array('invoice_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $vc_id = get_from_post('vc_id_for_vc_form1');
            if (!is_post() || $user_id == null || !$user_id || $vc_id == null || !$vc_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_vc_data = $this->utility_model->get_by_id('vc_id', $vc_id, 'vc');

            if (empty($existing_vc_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('vc_data' => $existing_vc_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('vc/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_vc_data_by_vc_id() {
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
            $vc_id = get_from_post('vc_id');
            if (!$vc_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $vc_data = $this->utility_model->get_by_id('vc_id', $vc_id, 'vc');
            if (empty($vc_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTYEIGHT, $vc_id, $vc_data);
            $vc_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTYEIGHT, 'fees_bifurcation', 'module_id', $vc_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['vc_data'] = $vc_data;
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
            $vc_id = get_from_post('vc_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$vc_id || $vc_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('vc_id', $vc_id, 'vc');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'vc' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('vc_id', $vc_id, 'vc', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $vc_id = get_from_post('vc_id_for_vc_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $vc_id == NULL || !$vc_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('vc_id', $vc_id, 'vc');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_vc_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $vc_data = array();
            if ($_FILES['fees_paid_challan_for_vc_upload_challan']['name'] != '') {
                $main_path = 'documents/vc';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'vc';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_vc_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_vc_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $vc_data['status'] = VALUE_FOUR;
                $vc_data['fees_paid_challan'] = $filename;
                $vc_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $vc_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $vc_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $vc_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTYEIGHT, $vc_id, $ex_em_data['district'], $ex_em_data['total_fees'], $vc_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $vc_data['user_payment_type'] = $user_payment_type;
            } else {
                $vc_data['user_payment_type'] = VALUE_ZERO;
            }
            $vc_data['updated_by'] = $user_id;
            $vc_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('vc_id', $vc_id, 'vc', $vc_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($vc_data['status']) ? $vc_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $vc_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $vc_data['user_payment_type'] == VALUE_THREE) {
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
            $vc_id = get_from_post('vc_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $vc_id == null || !$vc_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_vc_data = $this->utility_model->get_by_id('vc_id', $vc_id, 'vc');
            if (empty($existing_vc_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_vc_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_vc($existing_vc_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_vc_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $vc_id = get_from_post('vc_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $vc_data = $this->utility_model->upload_document('invoice_doc', 'vc', 'invoice_doc_', 'invoice_doc');
            }

            if (!$vc_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$vc_id) {
                $vc_data['user_id'] = $session_user_id;
                $vc_data['status'] = VALUE_ONE;
                $vc_data['created_by'] = $session_user_id;
                $vc_data['created_time'] = date('Y-m-d H:i:s');
                $vc_id = $this->utility_model->insert_data('vc', $vc_data);
            } else {
                $vc_data['updated_by'] = $session_user_id;
                $vc_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('vc_id', $vc_id, 'vc', $vc_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['vc_data'] = $vc_data;
            $success_array['vc_id'] = $vc_id;
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