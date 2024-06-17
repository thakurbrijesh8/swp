<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Repairer extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_repairer_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['repairer_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['repairer_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'wm_repairer', 'district', $search_district, 'repairer_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['repairer_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['repairer_data'] = array();
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
            $repairer_id = get_from_post('repairer_id');
            if (!$repairer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $repairer_data = $this->utility_model->get_by_id('repairer_id', $repairer_id, 'wm_repairer');
            if (empty($repairer_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
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

    function submit_repairer() {
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
            $repairer_id = get_from_post('repairer_id');
            $repairer_data = $this->_get_post_data_for_repairer();
            $validation_message = $this->_check_validation_for_repairer($repairer_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            if ($repairer_data['is_limited_company'] == IS_CHECKED_YES) {
                $proprietorData = $this->input->post('proprietor_data');
                $proprietor_decode_Data = json_decode($proprietorData, true);
                if ($proprietorData == "" || empty($proprietor_decode_Data)) {
                    echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
                    return false;
                }
            }

            $this->db->trans_start();
            $repairer_data['establishment_date'] = convert_to_mysql_date_format($repairer_data['establishment_date']);
            $repairer_data['registration_date'] = convert_to_mysql_date_format($repairer_data['registration_date']);
            if ($repairer_data['any_previous_application'] == IS_CHECKED_YES) {
                $repairer_data['license_application_date'] = convert_to_mysql_date_format($repairer_data['license_application_date']);
            }
            if ($repairer_data['is_limited_company'] == IS_CHECKED_YES) {
                $repairer_data['proprietor_details'] = $proprietorData;
            }
            $repairer_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $repairer_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$repairer_id || $repairer_id == NULL) {
                $repairer_data['user_id'] = $user_id;
                $repairer_data['created_by'] = $user_id;
                $repairer_data['created_time'] = date('Y-m-d H:i:s');
                $repairer_id = $this->utility_model->insert_data('wm_repairer', $repairer_data);
            } else {
                $repairer_data['updated_by'] = $user_id;
                $repairer_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', $repairer_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWO, $repairer_id);
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

    function _get_post_data_for_repairer() {
        $repairer_data = array();
        $repairer_data['district'] = get_from_post('district');
        $repairer_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $repairer_data['name_of_repairer'] = get_from_post('name_of_repairmen');
        $repairer_data['complete_address'] = get_from_post('complete_address');
        $repairer_data['premises_status'] = get_from_post('premises_status');
        $repairer_data['establishment_date'] = get_from_post('establishment_date');
        $repairer_data['is_limited_company'] = get_from_post('is_limited_company');
        $repairer_data['registration_date'] = get_from_post('registration_date');
        $repairer_data['registration_number'] = get_from_post('registration_number');
        $repairer_data['identity_choice'] = get_from_post('identity_choice');
        $repairer_data['identity_number'] = get_from_post('identity_number');
        $repairer_data['weights_type'] = get_from_post('weights_type');
        $repairer_data['area_operate'] = get_from_post('area_operate');
        $repairer_data['previous_experience'] = get_from_post('previous_experience');
        $repairer_data['no_of_skilled'] = get_from_post('no_of_skilled');
        $repairer_data['no_of_semiskilled'] = get_from_post('no_of_semiskilled');
        $repairer_data['no_of_unskilled'] = get_from_post('no_of_unskilled');
        $repairer_data['no_of_specialist'] = get_from_post('no_of_specialist');
        $repairer_data['details_of_personnel'] = get_from_post('details_of_personnel');
        $repairer_data['details_of_machinery'] = get_from_post('details_of_machinery');
        $repairer_data['electric_energy_availability'] = get_from_post('electric_energy_availability');
        $repairer_data['sufficient_stock'] = get_from_post('sufficient_stock');
        $repairer_data['stock_details'] = get_from_post('stock_details');
        $repairer_data['any_previous_application'] = get_from_post('any_previous_application');
        $repairer_data['license_application_date'] = get_from_post('license_application_date');
        $repairer_data['license_application_result'] = get_from_post('license_application_result');
        return $repairer_data;
    }

    function _check_validation_for_repairer($repairer_data) {
        if (!$repairer_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$repairer_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$repairer_data['name_of_repairer']) {
            return REPAIRMEN_NAME_MESSAGE;
        }
        if (!$repairer_data['complete_address']) {
            return WORKSHOPS_ADDRESS_MESSAGE;
        }
        if (!$repairer_data['registration_date']) {
            return SHOP_DATE_MESSAGE;
        }
        if (!$repairer_data['registration_number']) {
            return SHOP_REGISTRATION_NUMBER_MESSAGE;
        }
        if (!$repairer_data['identity_number']) {
            return IDENTITY_MESSAGE;
        }
        if (!$repairer_data['weights_type']) {
            return WEIGHT_TYPE_MESSAGE;
        }
        if (!$repairer_data['area_operate']) {
            return AREA_OPERATE_MESSAGE;
        }
        if (!$repairer_data['previous_experience']) {
            return PREV_EXPERIENCE_MESSAGE;
        }
        if (!$repairer_data['no_of_skilled']) {
            return SKILLED_NO_MESSAGE;
        }
        if (!$repairer_data['no_of_semiskilled']) {
            return SEMISKILLED_NO_MESSAGE;
        }
        if (!$repairer_data['no_of_unskilled']) {
            return UNSKILLED_NO_MESSAGE;
        }
        if (!$repairer_data['no_of_specialist']) {
            return TRAIN_EMP_MESSAGE;
        }
        if (!$repairer_data['details_of_personnel']) {
            return PERSONNEL_DETAIL_MESSAGE;
        }
        if (!$repairer_data['details_of_machinery']) {
            return MACHINERY_MESSAGE;
        }
        if (!$repairer_data['electric_energy_availability']) {
            return ELECTRIC_ENERGY_MESSAGE;
        }
        if ($repairer_data['sufficient_stock'] == IS_CHECKED_YES) {
            if (!$repairer_data['stock_details']) {
                return STOCK_DETAIL_MESSAGE;
            }
        }
        if ($repairer_data['any_previous_application'] == IS_CHECKED_YES) {
            if (!$repairer_data['license_application_date']) {
                return APPLIED_DATE_MESSAGE;
            }
            if (!$repairer_data['license_application_result']) {
                return LICENSE_RESULT_MESSAGE;
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
            $repairer_id = get_from_post('repairer_id');
            $document_type = get_from_post('document_type');
            //$document_id = get_from_post('document_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$repairer_id || $repairer_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('repairer_id', $repairer_id, 'wm_repairer');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['support_document'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['proof_of_ownership'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['gst_certificate'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['education_qualification'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['experience_certificate'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['partnership_deed'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['memorandum_of_association'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_raw_material'];
            }
            if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_machinery'];
            }
            if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_wm'];
            }
            if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_directors'];
            }
            if ($document_type == VALUE_TWELVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'repairer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('support_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('proof_of_ownership' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('gst_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('education_qualification' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('experience_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('partnership_deed' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('memorandum_of_association' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('list_of_raw_material' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('list_of_machinery' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('list_of_wm' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('list_of_directors' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWELVE) {
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $repairer_id = get_from_post('repairer_id_for_repairer_form1');
            if (!is_post() || $user_id == null || !$user_id || $repairer_id == null || !$repairer_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_repairer_data = $this->utility_model->get_by_id('repairer_id', $repairer_id, 'wm_repairer');

            if (empty($existing_repairer_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('repairer_data' => $existing_repairer_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('wmrepairer/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_repairer_data_by_repairer_id() {
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
            $repairer_id = get_from_post('repairer_id');
            if (!$repairer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $repairer_data = $this->utility_model->get_by_id('repairer_id', $repairer_id, 'wm_repairer');
            if (empty($repairer_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWO, $repairer_id, $repairer_data);
            $repairer_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWO, 'fees_bifurcation', 'module_id', $repairer_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
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

    function remove_fees_paid_challan() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $repairer_id = get_from_post('repairer_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$repairer_id || $repairer_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('repairer_id', $repairer_id, 'wm_repairer');
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
            $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $repairer_id = get_from_post('repairer_id_for_repairer_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $repairer_id == NULL || !$repairer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_rp_data = $this->utility_model->get_by_id('repairer_id', $repairer_id, 'wm_repairer');
            if (empty($ex_rp_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_rp_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_rp_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_repairer_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $repairer_data = array();
            if ($_FILES['fees_paid_challan_for_repairer_upload_challan']['name'] != '') {
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
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_repairer_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_repairer_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $repairer_data['status'] = VALUE_FOUR;
                $repairer_data['fees_paid_challan'] = $filename;
                $repairer_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_rp_data['payment_type'] == VALUE_TWO) {
                $repairer_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $repairer_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $repairer_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWO, $repairer_id, $ex_rp_data['district'], $ex_rp_data['total_fees'], $repairer_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $repairer_data['user_payment_type'] = $user_payment_type;
            } else {
                $repairer_data['user_payment_type'] = VALUE_ZERO;
            }
            $repairer_data['updated_by'] = $user_id;
            $repairer_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', $repairer_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($repairer_data['status']) ? $repairer_data['status'] : $ex_rp_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_rp_data['payment_type'];
            $success_array['user_payment_type'] = $repairer_data['user_payment_type'];
            if ($ex_rp_data['payment_type'] == VALUE_TWO && $repairer_data['user_payment_type'] == VALUE_THREE) {
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
            $repairer_id = get_from_post('repairer_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $repairer_id == null || !$repairer_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_repairer_data = $this->utility_model->get_by_id('repairer_id', $repairer_id, 'wm_repairer');
            if (empty($existing_repairer_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_repairer_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_repairer($existing_repairer_data);
            //        $data = array('repairer_data' => $existing_repairer_data);
            //        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            //        $mpdf->WriteHTML($this->load->view('wmrepairer/certificate', $data, TRUE));
            //        $mpdf->Output('Repairer_certificate_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_repairer_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $repairer_id = get_from_post('repairer_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $repairer_data = $this->utility_model->upload_document('support_document_for_repairer', 'repairer', 'support_document_', 'support_document');
            }
            if ($file_no == VALUE_TWO) {
                $repairer_data = $this->utility_model->upload_document('proof_of_ownership_for_repairer', 'repairer', 'proof_of_ownership_', 'proof_of_ownership');
            }
            if ($file_no == VALUE_THREE) {
                $repairer_data = $this->utility_model->upload_document('gst_certificate_for_repairer', 'repairer', 'gst_certificate_', 'gst_certificate');
            }
            if ($file_no == VALUE_FOUR) {
                $repairer_data = $this->utility_model->upload_document('education_qualification_for_repairer', 'repairer', 'education_qualification_', 'education_qualification');
            }
            if ($file_no == VALUE_FIVE) {
                $repairer_data = $this->utility_model->upload_document('experience_certificate_for_repairer', 'repairer', 'experience_certificate_', 'experience_certificate');
            }
            if ($file_no == VALUE_SIX) {
                $repairer_data = $this->utility_model->upload_document('partnership_deed_for_repairer', 'repairer', 'partnership_deed_', 'partnership_deed');
            }
            if ($file_no == VALUE_SEVEN) {
                $repairer_data = $this->utility_model->upload_document('memorandum_of_association_for_repairer', 'repairer', 'memorandum_of_association_', 'memorandum_of_association');
            }
            if ($file_no == VALUE_EIGHT) {
                $repairer_data = $this->utility_model->upload_document('list_of_raw_material_for_repairer', 'repairer', 'list_of_raw_material_', 'list_of_raw_material');
            }
            if ($file_no == VALUE_NINE) {
                $repairer_data = $this->utility_model->upload_document('list_of_machinery_for_repairer', 'repairer', 'list_of_machinery_', 'list_of_machinery');
            }
            if ($file_no == VALUE_TEN) {
                $repairer_data = $this->utility_model->upload_document('list_of_wm_for_repairer', 'repairer', 'list_of_wm_', 'list_of_wm');
            }
            if ($file_no == VALUE_ELEVEN) {
                $repairer_data = $this->utility_model->upload_document('list_of_directors_for_repairer', 'repairer', 'list_of_directors_', 'list_of_directors');
            }
            if ($file_no == VALUE_TWELVE) {
                $repairer_data = $this->utility_model->upload_document('seal_and_stamp_for_repairer', 'repairer', 'signature_', 'signature');
            }
            if (!$repairer_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$repairer_id) {
                $repairer_data['user_id'] = $session_user_id;
                $repairer_data['status'] = VALUE_ONE;
                $repairer_data['created_by'] = $session_user_id;
                $repairer_data['created_time'] = date('Y-m-d H:i:s');
                $repairer_id = $this->utility_model->insert_data('wm_repairer', $repairer_data);
            } else {
                $repairer_data['updated_by'] = $session_user_id;
                $repairer_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('repairer_id', $repairer_id, 'wm_repairer', $repairer_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['repairer_data'] = $repairer_data;
            $success_array['repairer_id'] = $repairer_id;
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