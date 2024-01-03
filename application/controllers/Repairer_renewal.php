<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Repairer_renewal extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_repairer_renewal_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['repairer_renewal_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['repairer_renewal_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'wm_repairer_renewal', 'district', $search_district, 'repairer_renewal_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['repairer_renewal_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['repairer_renewal_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_repairer_data_by_id() {
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
            $repairer_data = $this->utility_model->get_by_id('admin_registration_number', $license_number, 'wm_repairer');
            // if (empty($repairer_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['repairer_data'] = $repairer_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_repairer_renewal_data_by_id() {
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id');
            if (!$repairer_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $repairer_renewal_data = $this->utility_model->get_by_id('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal');
            if (empty($repairer_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTEEN, $repairer_renewal_id, $repairer_renewal_data);
            $repairer_renewal_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTEEN, 'fees_bifurcation', 'module_id', $repairer_renewal_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['repairer_renewal_data'] = $repairer_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_repairer_renewal() {
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id');
            $repairer_renewal_data = $this->_get_post_data_for_repairer_renewal();
            $validation_message = $this->_check_validation_for_repairer_renewal($repairer_renewal_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            if ($repairer_renewal_data['is_limited_company'] == IS_CHECKED_YES) {
                $proprietorData = $this->input->post('proprietor_data');
                $proprietor_decode_Data = json_decode($proprietorData, true);
                if ($proprietorData == "" || empty($proprietor_decode_Data)) {
                    echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
                    return false;
                }
            }


            $this->db->trans_start();
            $repairer_renewal_data['registration_date'] = convert_to_mysql_date_format($repairer_renewal_data['registration_date']);
            if ($repairer_renewal_data['is_limited_company'] == IS_CHECKED_YES) {
                $repairer_renewal_data['proprietor_details'] = $proprietorData;
            }
            $repairer_renewal_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $repairer_renewal_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$repairer_renewal_id || $repairer_renewal_id == NULL) {
                $repairer_renewal_data['user_id'] = $user_id;
                $repairer_renewal_data['created_by'] = $user_id;
                $repairer_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $repairer_renewal_id = $this->utility_model->insert_data('wm_repairer_renewal', $repairer_renewal_data);
            } else {
                $repairer_renewal_data['updated_by'] = $user_id;
                $repairer_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', $repairer_renewal_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTEEN, $repairer_renewal_id);
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

    function _get_post_data_for_repairer_renewal() {
        $repairer_renewal_data = array();
        $repairer_renewal_data['repairer_id'] = get_from_post('repairer_id');
        $repairer_renewal_data['district'] = get_from_post('district');
        $repairer_renewal_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $repairer_renewal_data['name_of_repairer'] = get_from_post('name_of_repairmen');
        $repairer_renewal_data['complete_address'] = get_from_post('complete_address');
        $repairer_renewal_data['license_number'] = get_from_post('admin_registration_number');
        $repairer_renewal_data['is_limited_company'] = get_from_post('is_limited_company');
        $repairer_renewal_data['registration_date'] = get_from_post('registration_date');
        $repairer_renewal_data['registration_number'] = get_from_post('registration_number');
        $repairer_renewal_data['identity_choice'] = get_from_post('identity_choice');
        $repairer_renewal_data['identity_number'] = get_from_post('identity_number');
        $repairer_renewal_data['weights_type'] = get_from_post('weights_type');
        $repairer_renewal_data['propose_change'] = get_from_post('propose_change');
        $repairer_renewal_data['area_operate'] = get_from_post('area_operate');
        $repairer_renewal_data['sufficient_stock'] = get_from_post('sufficient_stock');
        $repairer_renewal_data['stock_details'] = get_from_post('stock_details');
        $repairer_renewal_data['admin_registration_number'] = get_from_post('admin_registration_number');
        return $repairer_renewal_data;
    }

    function _check_validation_for_repairer_renewal($repairer_renewal_data) {
        if (!$repairer_renewal_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$repairer_renewal_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$repairer_renewal_data['admin_registration_number']) {
            return LICENSE_NUMBER_MESSAGE;
        }
        if (!$repairer_renewal_data['name_of_repairer']) {
            return REPAIRMEN_NAME_MESSAGE;
        }
        if (!$repairer_renewal_data['complete_address']) {
            return WORKSHOPS_ADDRESS_MESSAGE;
        }
        if (!$repairer_renewal_data['registration_date']) {
            return SHOP_DATE_MESSAGE;
        }
        if (!$repairer_renewal_data['registration_number']) {
            return SHOP_REGISTRATION_NUMBER_MESSAGE;
        }
        if (!$repairer_renewal_data['identity_number']) {
            return IDENTITY_MESSAGE;
        }
        if (!$repairer_renewal_data['weights_type']) {
            return WEIGHT_TYPE_MESSAGE;
        }
        if (!$repairer_renewal_data['area_operate']) {
            return AREA_OPERATE_MESSAGE;
        }
        if ($repairer_renewal_data['sufficient_stock'] == IS_CHECKED_YES) {
            if (!$repairer_renewal_data['stock_details']) {
                return STOCK_DETAIL_MESSAGE;
            }
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id');
            $document_type = get_from_post('document_type');
            // $document_id = get_from_post('document_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$repairer_renewal_id || $repairer_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['original_licence'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['renewed_licence'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['periodical_return'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['verification_certificate'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', array('original_licence' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', array('renewed_licence' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', array('periodical_return' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', array('verification_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id_for_repairer_renewal_form1');
            if (!is_post() || $user_id == null || !$user_id || $repairer_renewal_id == null || !$repairer_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_repairer_renewal_data = $this->utility_model->get_by_id('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal');

            if (empty($existing_repairer_renewal_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('repairer_renewal_data' => $existing_repairer_renewal_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('wmrepairer_renewal/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_repairer_renewal_data_by_repairer_renewal_id() {
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id');
            if (!$repairer_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $repairer_renewal_data = $this->utility_model->get_by_id('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal');
            if (empty($repairer_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['repairer_renewal_data'] = $repairer_renewal_data;
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$repairer_renewal_id || $repairer_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id_for_repairer_renewal_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $repairer_renewal_id == NULL || !$repairer_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_rp_data = $this->utility_model->get_by_id('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal');
            if (empty($ex_rp_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_rp_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_repairer_renewal_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $repairer_renewal_data = array();
            if ($_FILES['fees_paid_challan_for_repairer_renewal_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'repairer';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_repairer_renewal_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_repairer_renewal_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $repairer_renewal_data['status'] = VALUE_FOUR;
                $repairer_renewal_data['fees_paid_challan'] = $filename;
                $repairer_renewal_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_rp_data['payment_type'] == VALUE_TWO) {
                $repairer_renewal_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $repairer_renewal_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $repairer_renewal_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTEEN, $repairer_renewal_id, $ex_rp_data['district'], $ex_rp_data['total_fees'], $repairer_renewal_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $repairer_renewal_data['user_payment_type'] = $user_payment_type;
            } else {
                $repairer_renewal_data['user_payment_type'] = VALUE_ZERO;
            }
            $repairer_renewal_data['updated_by'] = $user_id;
            $repairer_renewal_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', $repairer_renewal_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($repairer_renewal_data['status']) ? $repairer_renewal_data['status'] : $ex_rp_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_rp_data['payment_type'];
            $success_array['user_payment_type'] = $repairer_renewal_data['user_payment_type'];
            if ($ex_rp_data['payment_type'] == VALUE_TWO && $repairer_renewal_data['user_payment_type'] == VALUE_THREE) {
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
            $repairer_renewal_id = get_from_post('repairer_renewal_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $repairer_renewal_id == null || !$repairer_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_repairer_renewal_data = $this->utility_model->get_by_id('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal');
            if (empty($existing_repairer_renewal_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_repairer_renewal_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
    //        $data = array('repairer_renewal_data' => $existing_repairer_renewal_data);
    //        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
    //        $mpdf->WriteHTML($this->load->view('wmrepairer_renewal/certificate', $data, TRUE));
    //        $mpdf->Output('Repairer_certificate_' . time() . '.pdf', 'I');
            $this->utility_lib->gc_for_repairer_renewal($existing_repairer_renewal_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_repairer_renewal_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $repairer_renewal_id = get_from_post('repairer_renewal_id');
            $file_no = get_from_post('file_no');


            if ($file_no == VALUE_ONE) {
                $repairer_renewal_data = $this->utility_model->upload_document('original_licence_for_repairer', 'repairer', 'original_licence_', 'original_licence');
            }
            if ($file_no == VALUE_TWO) {
                $repairer_renewal_data = $this->utility_model->upload_document('renewed_licence_for_repairer', 'repairer', 'renewed_licence_', 'renewed_licence');
            }
            if ($file_no == VALUE_THREE) {
                $repairer_renewal_data = $this->utility_model->upload_document('periodical_return_for_repairer', 'repairer', 'periodical_return_', 'periodical_return');
            }
            if ($file_no == VALUE_FOUR) {
                $repairer_renewal_data = $this->utility_model->upload_document('verification_certificate_for_repairer', 'repairer', 'verification_certificate_', 'verification_certificate');
            }
            if ($file_no == VALUE_FIVE) {
                $repairer_renewal_data = $this->utility_model->upload_document('seal_and_stamp_for_repairer', 'repairer', 'signature_', 'signature');
            }
            if (!$repairer_renewal_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$repairer_renewal_id) {
                $repairer_renewal_data['user_id'] = $session_user_id;
                $repairer_renewal_data['status'] = VALUE_ONE;
                $repairer_renewal_data['created_by'] = $session_user_id;
                $repairer_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $repairer_renewal_id = $this->utility_model->insert_data('wm_repairer_renewal', $repairer_renewal_data);
            } else {
                $repairer_renewal_data['updated_by'] = $session_user_id;
                $repairer_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('repairer_renewal_id', $repairer_renewal_id, 'wm_repairer_renewal', $repairer_renewal_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['repairer_renewal_data'] = $repairer_renewal_data;
            $success_array['repairer_renewal_id'] = $repairer_renewal_id;
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