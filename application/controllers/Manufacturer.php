<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturer extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_manufacturer_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['manufacturer_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['manufacturer_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'wm_manufacturer', 'district', $search_district, 'manufacturer_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['manufacturer_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['manufacturer_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_manufacturer_data_by_id() {
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
            $manufacturer_id = get_from_post('manufacturer_id');
            if (!$manufacturer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $manufacturer_data = $this->utility_model->get_by_id('manufacturer_id', $manufacturer_id, 'wm_manufacturer');
            if (empty($manufacturer_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['manufacturer_data'] = $manufacturer_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_manufacturer() {
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
            $manufacturer_id = get_from_post('manufacturer_id');
            $manufacturer_data = $this->_get_post_data_for_manufacturer();
            $validation_message = $this->_check_validation_for_manufacturer($manufacturer_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            if ($manufacturer_data['is_limited_company'] == IS_CHECKED_YES) {
                $proprietorData = $this->input->post('proprietor_data');
                $proprietor_decode_Data = json_decode($proprietorData, true);
                if ($proprietorData == "" || empty($proprietor_decode_Data)) {
                    echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
                    return false;
                }
            }

            $this->db->trans_start();
            $manufacturer_data['establishment_date'] = convert_to_mysql_date_format($manufacturer_data['establishment_date']);
            $manufacturer_data['registration_date'] = convert_to_mysql_date_format($manufacturer_data['registration_date']);
            $manufacturer_data['inspection_sample_date'] = convert_to_mysql_date_format($manufacturer_data['inspection_sample_date']);
            if ($manufacturer_data['any_previous_application'] == IS_CHECKED_YES) {
                $manufacturer_data['license_application_date'] = convert_to_mysql_date_format($manufacturer_data['license_application_date']);
            }
            if ($manufacturer_data['is_limited_company'] == IS_CHECKED_YES) {
                $manufacturer_data['proprietor_details'] = $proprietorData;
            }
            $manufacturer_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $manufacturer_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$manufacturer_id || $manufacturer_id == NULL) {
                $manufacturer_data['user_id'] = $user_id;
                $manufacturer_data['created_by'] = $user_id;
                $manufacturer_data['created_time'] = date('Y-m-d H:i:s');
                $manufacturer_id = $this->utility_model->insert_data('wm_manufacturer', $manufacturer_data);
            } else {
                $manufacturer_data['updated_by'] = $user_id;
                $manufacturer_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', $manufacturer_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOUR, $manufacturer_id);
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

    function _get_post_data_for_manufacturer() {
        $manufacturer_data = array();
        $manufacturer_data['district'] = get_from_post('district');
        $manufacturer_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $manufacturer_data['name_of_manufacturer'] = get_from_post('name_of_manufacturer');
        $manufacturer_data['complete_address'] = get_from_post('complete_address');
        $manufacturer_data['premises_status'] = get_from_post('premises_status');
        $manufacturer_data['establishment_date'] = get_from_post('establishment_date');
        $manufacturer_data['is_limited_company'] = get_from_post('is_limited_company');
        $manufacturer_data['registration_date'] = get_from_post('registration_date');
        $manufacturer_data['registration_number'] = get_from_post('registration_number');
        $manufacturer_data['manufacturing_activity'] = get_from_post('manufacturing_activity');
        $manufacturer_data['weights_type'] = get_from_post('weights_type');
        $manufacturer_data['measures_type'] = get_from_post('measures_type');
        $manufacturer_data['weighing_instruments_type'] = get_from_post('weighing_instruments_type');
        $manufacturer_data['measuring_instruments_type'] = get_from_post('measuring_instruments_type');
        $manufacturer_data['no_of_skilled'] = get_from_post('no_of_skilled');
        $manufacturer_data['no_of_semiskilled'] = get_from_post('no_of_semiskilled');
        $manufacturer_data['no_of_unskilled'] = get_from_post('no_of_unskilled');
        $manufacturer_data['no_of_specialist'] = get_from_post('no_of_specialist');
        $manufacturer_data['details_of_personnel'] = get_from_post('details_of_personnel');
        $manufacturer_data['details_of_machinery'] = get_from_post('details_of_machinery');
        $manufacturer_data['details_of_foundry'] = get_from_post('details_of_foundry');
        $manufacturer_data['steel_casting_facility'] = get_from_post('steel_casting_facility');
        $manufacturer_data['electric_energy_availability'] = get_from_post('electric_energy_availability');
        $manufacturer_data['details_of_loan'] = get_from_post('details_of_loan');
        $manufacturer_data['banker_names'] = get_from_post('banker_names');
        $manufacturer_data['identity_choice'] = get_from_post('identity_choice');
        $manufacturer_data['identity_number'] = get_from_post('identity_number');
        $manufacturer_data['any_previous_application'] = get_from_post('any_previous_application');
        $manufacturer_data['license_application_date'] = get_from_post('license_application_date');
        $manufacturer_data['license_application_result'] = get_from_post('license_application_result');
        $manufacturer_data['location_of_selling'] = get_from_post('location_of_selling');
        $manufacturer_data['model_approval_detail'] = get_from_post('model_approval_detail');
        $manufacturer_data['inspection_sample_date'] = get_from_post('inspection_sample_date');
        return $manufacturer_data;
    }

    function _check_validation_for_manufacturer($manufacturer_data) {
        if (!$manufacturer_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$manufacturer_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$manufacturer_data['name_of_manufacturer']) {
            return REPAIRMEN_NAME_MESSAGE;
        }
        if (!$manufacturer_data['complete_address']) {
            return WORKSHOPS_ADDRESS_MESSAGE;
        }
        if (!$manufacturer_data['premises_status']) {
            return PREMISES_STATUS_MESSAGE;
        }
        if (!$manufacturer_data['registration_date']) {
            return SHOP_DATE_MESSAGE;
        }
        if (!$manufacturer_data['registration_number']) {
            return SHOP_REGISTRATION_NUMBER_MESSAGE;
        }
        if (!$manufacturer_data['manufacturing_activity']) {
            return ACTIVITY_MESSAGE;
        }
        if (!$manufacturer_data['weights_type']) {
            return WEIGHT_TYPE_MESSAGE;
        }
        if (!$manufacturer_data['measures_type']) {
            return MEASURE_TYPE_MESSAGE;
        }
        if (!$manufacturer_data['weighing_instruments_type']) {
            return WEIGHT_INSTRUMENT_MESSAGE;
        }
        if (!$manufacturer_data['measuring_instruments_type']) {
            return MEASURE_INSTRUMENT_MESSAGE;
        }
        if (!$manufacturer_data['no_of_skilled']) {
            return SKILLED_NO_MESSAGE;
        }
        if (!$manufacturer_data['no_of_semiskilled']) {
            return SEMISKILLED_NO_MESSAGE;
        }
        if (!$manufacturer_data['no_of_unskilled']) {
            return UNSKILLED_NO_MESSAGE;
        }
        if (!$manufacturer_data['no_of_specialist']) {
            return TRAIN_EMP_MESSAGE;
        }
        if (!$manufacturer_data['details_of_personnel']) {
            return PERSONNEL_DETAIL_MESSAGE;
        }
        if (!$manufacturer_data['details_of_machinery']) {
            return MACHINERY_MESSAGE;
        }
        if (!$manufacturer_data['details_of_foundry']) {
            return FOUNDRY_MESSAGE;
        }
        if (!$manufacturer_data['steel_casting_facility']) {
            return CASTING_FACILITY_MESSAGE;
        }
        if (!$manufacturer_data['electric_energy_availability']) {
            return ELECTRIC_ENERGY_MESSAGE;
        }
        if (!$manufacturer_data['details_of_loan']) {
            return LOAN_DETAIL_MESSAGE;
        }
        if (!$manufacturer_data['banker_names']) {
            return BANK_NAME_MESSAGE;
        }
        if (!$manufacturer_data['identity_choice']) {
            return IDENTITY_CHOICE_MESSAGE;
        }
        if (!$manufacturer_data['identity_number']) {
            return IDENTITY_MESSAGE;
        }
        if ($manufacturer_data['any_previous_application'] == IS_CHECKED_YES) {
            if (!$manufacturer_data['license_application_date']) {
                return APPLIED_DATE_MESSAGE;
            }
            if (!$manufacturer_data['license_application_result']) {
                return LICENSE_RESULT_MESSAGE;
            }
        }
        if (!$manufacturer_data['location_of_selling']) {
            return SELLING_LOCATION_MESSAGE;
        }
        if (!$manufacturer_data['model_approval_detail']) {
            return APPROVAL_MODEL_MESSAGE;
        }
        if (!$manufacturer_data['inspection_sample_date']) {
            return INSPECTION_DATE_MESSAGE;
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
            $manufacturer_id = get_from_post('manufacturer_id');
            $document_type = get_from_post('document_type');
            //$document_id = get_from_post('document_id');

            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$manufacturer_id || $manufacturer_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('manufacturer_id', $manufacturer_id, 'wm_manufacturer');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['support_document'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['monogram_uploader'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['model_approval_certificate'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['proof_of_ownership'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['gst_certificate'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['partnership_deed'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['memorandum_of_association'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_raw_material'];
            }
            if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_machinery'];
            }
            if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_wm'];
            }
            if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['list_of_directors'];
            }
            if ($document_type == VALUE_TWELVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('support_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('monogram_uploader' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('model_approval_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('proof_of_ownership' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('gst_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('partnership_deed' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('memorandum_of_association' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('list_of_raw_material' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('list_of_machinery' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('list_of_wm' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('list_of_directors' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWELVE) {
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $manufacturer_id = get_from_post('manufacturer_id_for_manufacturer_form1');
            if (!is_post() || $user_id == null || !$user_id || $manufacturer_id == null || !$manufacturer_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_manufacturer_data = $this->utility_model->get_by_id('manufacturer_id', $manufacturer_id, 'wm_manufacturer');

            if (empty($existing_manufacturer_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('manufacturer_data' => $existing_manufacturer_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('wmmanufacturer/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_manufacturer_data_by_manufacturer_id() {
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
            $manufacturer_id = get_from_post('manufacturer_id');
            if (!$manufacturer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $manufacturer_data = $this->utility_model->get_by_id('manufacturer_id', $manufacturer_id, 'wm_manufacturer');
            if (empty($manufacturer_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOUR, $manufacturer_id, $manufacturer_data);
            $manufacturer_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOUR, 'fees_bifurcation', 'module_id', $manufacturer_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['manufacturer_data'] = $manufacturer_data;
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
            $manufacturer_id = get_from_post('manufacturer_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$manufacturer_id || $manufacturer_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('manufacturer_id', $manufacturer_id, 'wm_manufacturer');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'manufacturer' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $manufacturer_id = get_from_post('manufacturer_id_for_manufacturer_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $manufacturer_id == NULL || !$manufacturer_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('manufacturer_id', $manufacturer_id, 'wm_manufacturer');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_manufacturer_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $manufacturer_data = array();
            if ($_FILES['fees_paid_challan_for_manufacturer_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'manufacturer';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_manufacturer_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_manufacturer_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $manufacturer_data['status'] = VALUE_FOUR;
                $manufacturer_data['fees_paid_challan'] = $filename;
                $manufacturer_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $manufacturer_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $manufacturer_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $manufacturer_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOUR, $manufacturer_id, $ex_em_data['district'], $ex_em_data['total_fees'], $manufacturer_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $manufacturer_data['user_payment_type'] = $user_payment_type;
            } else {
                $manufacturer_data['user_payment_type'] = VALUE_ZERO;
            }
            $manufacturer_data['updated_by'] = $user_id;
            $manufacturer_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', $manufacturer_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($manufacturer_data['status']) ? $manufacturer_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $manufacturer_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $manufacturer_data['user_payment_type'] == VALUE_THREE) {
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
            $manufacturer_id = get_from_post('manufacturer_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $manufacturer_id == null || !$manufacturer_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_manufacturer_data = $this->utility_model->get_by_id('manufacturer_id', $manufacturer_id, 'wm_manufacturer');
            if (empty($existing_manufacturer_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_manufacturer_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_manufacturer($existing_manufacturer_data);
            //        $data = array('manufacturer_data' => $existing_manufacturer_data);
            //        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            //        $mpdf->WriteHTML($this->load->view('wmmanufacturer/certificate', $data, TRUE));
            //        $mpdf->Output('Repairer_certificate_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_manufacturer_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $manufacturer_id = get_from_post('manufacturer_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $manufacturer_data = $this->utility_model->upload_document('support_document_for_manufacturer', 'manufacturer', 'support_document_', 'support_document');
            }
            if ($file_no == VALUE_TWO) {
                $manufacturer_data = $this->utility_model->upload_document('monogram_uploader_for_manufacturer', 'manufacturer', 'monogram_uploader_', 'monogram_uploader');
            }
            if ($file_no == VALUE_THREE) {
                $manufacturer_data = $this->utility_model->upload_document('model_approval_certificate_for_manufacturer', 'manufacturer', 'model_approval_certificate_', 'model_approval_certificate');
            }
            if ($file_no == VALUE_FOUR) {
                $manufacturer_data = $this->utility_model->upload_document('proof_of_ownership_for_manufacturer', 'manufacturer', 'proof_of_ownership_', 'proof_of_ownership');
            }
            if ($file_no == VALUE_FIVE) {
                $manufacturer_data = $this->utility_model->upload_document('gst_certificate_for_manufacturer', 'manufacturer', 'gst_certificate_', 'gst_certificate');
            }
            if ($file_no == VALUE_SIX) {
                $manufacturer_data = $this->utility_model->upload_document('partnership_deed_for_manufacturer', 'manufacturer', 'partnership_deed_', 'partnership_deed');
            }
            if ($file_no == VALUE_SEVEN) {
                $manufacturer_data = $this->utility_model->upload_document('memorandum_of_association_for_manufacturer', 'manufacturer', 'memorandum_of_association_', 'memorandum_of_association');
            }
            if ($file_no == VALUE_EIGHT) {
                $manufacturer_data = $this->utility_model->upload_document('list_of_raw_material_for_manufacturer', 'manufacturer', 'list_of_raw_material_', 'list_of_raw_material');
            }
            if ($file_no == VALUE_NINE) {
                $manufacturer_data = $this->utility_model->upload_document('list_of_machinery_for_manufacturer', 'manufacturer', 'list_of_machinery_', 'list_of_machinery');
            }
            if ($file_no == VALUE_TEN) {
                $manufacturer_data = $this->utility_model->upload_document('list_of_wm_for_manufacturer', 'manufacturer', 'list_of_wm_', 'list_of_wm');
            }
            if ($file_no == VALUE_ELEVEN) {
                $manufacturer_data = $this->utility_model->upload_document('list_of_directors_for_manufacturer', 'manufacturer', 'list_of_directors_', 'list_of_directors');
            }
            if ($file_no == VALUE_TWELVE) {
                $manufacturer_data = $this->utility_model->upload_document('seal_and_stamp_for_manufacturer', 'manufacturer', 'signature_', 'signature');
            }
            if (!$manufacturer_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$manufacturer_id) {
                $manufacturer_data['user_id'] = $session_user_id;
                $manufacturer_data['status'] = VALUE_ONE;
                $manufacturer_data['created_by'] = $session_user_id;
                $manufacturer_data['created_time'] = date('Y-m-d H:i:s');
                $manufacturer_id = $this->utility_model->insert_data('wm_manufacturer', $manufacturer_data);
            } else {
                $manufacturer_data['updated_by'] = $session_user_id;
                $manufacturer_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('manufacturer_id', $manufacturer_id, 'wm_manufacturer', $manufacturer_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['manufacturer_data'] = $manufacturer_data;
            $success_array['manufacturer_id'] = $manufacturer_id;
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