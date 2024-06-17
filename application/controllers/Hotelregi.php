<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hotelregi extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_hotelregi_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['hotelregi_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['hotelregi_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'hotel', 'name_of_tourist_area', $search_district, 'hotelregi_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['hotelregi_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['hotelregi_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_hotelregi_data_by_id() {
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
            $hotelregi_id = get_from_post('hotelregi_id');
            if (!$hotelregi_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $hotelregi_data = $this->utility_model->get_by_id('hotelregi_id', $hotelregi_id, 'hotel');
            if (empty($hotelregi_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['hotelregi_data'] = $hotelregi_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_hotelregi() {
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
            $hotelregi_id = get_from_post('hotelregi_id');
            $hotelregi_data = $this->_get_post_data_for_hotelregi();
            $validation_message = $this->_check_validation_for_hotelregi($hotelregi_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $agentData = $this->input->post('agent_data');
            $agent_decode_Data = json_decode($agentData, true);
            if ($agentData == "" || empty($agent_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Agent/Agents/employee/employees Data'));
                return false;
            }

            $this->db->trans_start();
            $hotelregi_data['name_of_agent'] = $agentData;
            $hotelregi_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $hotelregi_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$hotelregi_id || $hotelregi_id == NULL) {
                $hotelregi_data['user_id'] = $user_id;
                $hotelregi_data['created_by'] = $user_id;
                $hotelregi_data['created_time'] = date('Y-m-d H:i:s');
                $hotelregi_id = $this->utility_model->insert_data('hotel', $hotelregi_data);
            } else {
                $hotelregi_data['submitted_datetime'] = date('Y-m-d H:i:s');
                $hotelregi_data['updated_by'] = $user_id;
                $hotelregi_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', $hotelregi_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_SIX, $hotelregi_id);
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

    function _get_post_data_for_hotelregi() {
        $hotelregi_data = array();
        $hotelregi_data['name_of_hotel'] = get_from_post('name_of_hotel');
        $hotelregi_data['name_of_person'] = get_from_post('name_of_person');
        $hotelregi_data['full_address'] = get_from_post('full_address');
        $hotelregi_data['name_of_tourist_area'] = get_from_post('name_of_tourist_area');
        $hotelregi_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $hotelregi_data['name_of_proprietor'] = get_from_post('name_of_proprietor');
        $hotelregi_data['category_of_hotel'] = get_from_post('category_of_hotel');
        $hotelregi_data['fees'] = get_from_post('fees');
        $hotelregi_data['mob_no'] = get_from_post('mob_no');
        $hotelregi_data['name_of_manager'] = get_from_post('name_of_manager');
        $hotelregi_data['manager_permanent_address'] = get_from_post('manager_permanent_address');
        $hotelregi_data['permanent_resident_of_ut'] = get_from_post('permanent_resident_of_ut');
        $hotelregi_data['other_business_of_applicant'] = get_from_post('other_business_of_applicant');

        return $hotelregi_data;
    }

    function _check_validation_for_hotelregi($hotelregi_data) {

        if (!$hotelregi_data['name_of_hotel']) {
            return HOTEL_NAME_MESSAGE;
        }
        if (!$hotelregi_data['name_of_person']) {
            return PERSON_NAME_MESSAGE;
        }
        if (!$hotelregi_data['full_address']) {
            return FULL_ADDRESS_MESSAGE;
        }
        if (!$hotelregi_data['name_of_tourist_area']) {
            return TOURIST_AREA_NAME_MESSAGE;
        }
        if (!$hotelregi_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$hotelregi_data['name_of_proprietor']) {
            return PROPRIETOR_NAME_MESSAGE;
        }
        if (!$hotelregi_data['category_of_hotel']) {
            return CATEGORY_HOTEL_MESSAGE;
        }
        if (!$hotelregi_data['mob_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$hotelregi_data['name_of_manager']) {
            return MANAGER_NAME_MESSAGE;
        }
        if (!$hotelregi_data['manager_permanent_address']) {
            return MANAGER_PERMANENT_ADDRESS_MESSAGE;
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
            $hotelregi_id = get_from_post('hotelregi_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$hotelregi_id || $hotelregi_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('hotelregi_id', $hotelregi_id, 'hotel');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['site_plan'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['construction_plan'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['occupancy_certificate'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['noc_medical'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['noc_concerned'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['noc_electricity'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['aadhar_card_homestay'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['form_xiv_homestay'];
            }
            if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['site_plan_homestay'];
            }
            if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['na_order_homestay'];
            }
            if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['completion_certificate_homestay'];
            }
            if ($document_type == VALUE_TWELVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['house_tax_receipt_homestay'];
            }
            if ($document_type == VALUE_THIRTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['electricity_bill_homestay'];
            }
            if ($document_type == VALUE_FOURTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['noc_fire'];
            }
            if ($document_type == VALUE_FIFTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['police_clearance_certificate'];
            }
            if ($document_type == VALUE_SIXTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('site_plan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('construction_plan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('occupancy_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('noc_medical' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('noc_concerned' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('noc_electricity' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('aadhar_card_homestay' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('form_xiv_homestay' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('site_plan_homestay' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('na_order_homestay' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('completion_certificate_homestay' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWELVE) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('house_tax_receipt_homestay' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THIRTEEN) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('electricity_bill_homestay' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOURTEEN) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('noc_fire' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIFTEEN) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('police_clearance_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIXTEEN) {
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_formII() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $hotelregi_id = get_from_post('hotelregi_id_for_hotelregi_formII');
            if (!is_post() || $user_id == null || !$user_id || $hotelregi_id == null || !$hotelregi_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_hotelregi_data = $this->utility_model->get_by_id('hotelregi_id', $hotelregi_id, 'hotel');

            if (empty($existing_hotelregi_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $taluka_array = $this->config->item('taluka_array');
            $existing_hotelregi_data['name_of_tourist_area'] = isset($taluka_array[$existing_hotelregi_data['name_of_tourist_area']]) ? $taluka_array[$existing_hotelregi_data['name_of_tourist_area']] : '-';
            error_reporting(E_ERROR);
            $data = array('hotelregi_data' => $existing_hotelregi_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('hotelregi/pdf', $data, TRUE));
            $mpdf->Output('FORM-II.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_hotelregi_data_by_hotelregi_id() {
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
            $hotelregi_id = get_from_post('hotelregi_id');
            if (!$hotelregi_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $hotelregi_data = $this->utility_model->get_by_id('hotelregi_id', $hotelregi_id, 'hotel');
            if (empty($hotelregi_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_SIX, $hotelregi_id, $hotelregi_data);
            $hotelregi_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_SIX, 'fees_bifurcation', 'module_id', $hotelregi_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            $success_array = get_success_array();
            $success_array['hotelregi_data'] = $hotelregi_data;
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
            $hotelregi_id = get_from_post('hotelregi_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$hotelregi_id || $hotelregi_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('hotelregi_id', $hotelregi_id, 'hotel');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $hotelregi_id = get_from_post('hotelregi_id_for_hotelregi_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $hotelregi_id == NULL || !$hotelregi_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('hotelregi_id', $hotelregi_id, 'hotel');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_hotelregi_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $hotelregi_data = array();
            if ($_FILES['fees_paid_challan_for_hotelregi_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'hotelregi';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_hotelregi_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_hotelregi_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $hotelregi_data['status'] = VALUE_FOUR;
                $hotelregi_data['fees_paid_challan'] = $filename;
                $hotelregi_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $hotelregi_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $hotelregi_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $hotelregi_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_SIX, $hotelregi_id, $ex_em_data['name_of_tourist_area'], $ex_em_data['total_fees'], $hotelregi_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $hotelregi_data['user_payment_type'] = $user_payment_type;
            } else {
                $hotelregi_data['user_payment_type'] = VALUE_ZERO;
            }
            $hotelregi_data['updated_by'] = $user_id;
            $hotelregi_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', $hotelregi_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($hotelregi_data['status']) ? $hotelregi_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $hotelregi_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $hotelregi_data['user_payment_type'] == VALUE_THREE) {
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
            $hotelregi_id = get_from_post('hotelregi_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $hotelregi_id == null || !$hotelregi_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_hotelregi_data = $this->utility_model->get_by_id('hotelregi_id', $hotelregi_id, 'hotel');
            if (empty($existing_hotelregi_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_hotelregi_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $taluka_array = $this->config->item('taluka_array');
            $existing_hotelregi_data['name_of_tourist_area'] = isset($taluka_array[$existing_hotelregi_data['name_of_tourist_area']]) ? $taluka_array[$existing_hotelregi_data['name_of_tourist_area']] : '-';
            $this->utility_lib->gc_for_hotelregi($existing_hotelregi_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_hotelregi_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $hotelregi_id = get_from_post('hotelregi_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $hotelregi_data = $this->utility_model->upload_document('site_plan_for_hotelregi', 'hotelregi', 'site_plan_', 'site_plan');
            }
            if ($file_no == VALUE_TWO) {
                $hotelregi_data = $this->utility_model->upload_document('construction_plan_for_hotelregi', 'hotelregi', 'construction_plan_', 'construction_plan');
            }
            if ($file_no == VALUE_THREE) {
                $hotelregi_data = $this->utility_model->upload_document('occupancy_certificate_for_hotelregi', 'hotelregi', 'occupancy_certificate_', 'occupancy_certificate');
            }
            if ($file_no == VALUE_FOUR) {
                $hotelregi_data = $this->utility_model->upload_document('noc_medical_for_hotelregi', 'hotelregi', 'noc_medical_', 'noc_medical');
            }
            if ($file_no == VALUE_FIVE) {
                $hotelregi_data = $this->utility_model->upload_document('noc_concerned_for_hotelregi', 'hotelregi', 'noc_concerned_', 'noc_concerned');
            }
            if ($file_no == VALUE_SIX) {
                $hotelregi_data = $this->utility_model->upload_document('noc_electricity_for_hotelregi', 'hotelregi', 'noc_electricity_', 'noc_electricity');
            }
            if ($file_no == VALUE_SEVEN) {
                $hotelregi_data = $this->utility_model->upload_document('aadhar_card_for_homestay', 'hotelregi', 'aadhar_card_homestay_', 'aadhar_card_homestay');
            }
            if ($file_no == VALUE_EIGHT) {
                $hotelregi_data = $this->utility_model->upload_document('form_xiv_for_homestay', 'hotelregi', 'form_xiv_homestay_', 'form_xiv_homestay');
            }
            if ($file_no == VALUE_NINE) {
                $hotelregi_data = $this->utility_model->upload_document('site_plan_for_homestay', 'hotelregi', 'site_plan_homestay_', 'site_plan_homestay');
            }
            if ($file_no == VALUE_TEN) {
                $hotelregi_data = $this->utility_model->upload_document('na_order_for_homestay', 'hotelregi', 'na_order_homestay_', 'na_order_homestay');
            }
            if ($file_no == VALUE_ELEVEN) {
                $hotelregi_data = $this->utility_model->upload_document('completion_certificate_for_homestay', 'hotelregi', 'completion_certificate_homestay_', 'completion_certificate_homestay');
            }
            if ($file_no == VALUE_TWELVE) {
                $hotelregi_data = $this->utility_model->upload_document('house_tax_receipt_for_homestay', 'hotelregi', 'house_tax_receipt_homestay_', 'house_tax_receipt_homestay');
            }
            if ($file_no == VALUE_THIRTEEN) {
                $hotelregi_data = $this->utility_model->upload_document('electricity_bill_for_homestay', 'hotelregi', 'electricity_bill_homestay_', 'electricity_bill_homestay');
            }
            if ($file_no == VALUE_FOURTEEN) {
                $hotelregi_data = $this->utility_model->upload_document('noc_fire_for_hotelregi', 'hotelregi', 'noc_fire_', 'noc_fire');
            }
            if ($file_no == VALUE_FIFTEEN) {
                $hotelregi_data = $this->utility_model->upload_document('police_clearance_certificate_for_hotelregi', 'hotelregi', 'police_clearance_certificate_', 'police_clearance_certificate');
            }
            if ($file_no == VALUE_SIXTEEN) {
                $hotelregi_data = $this->utility_model->upload_document('seal_and_stamp_for_hotelregi', 'hotelregi', 'signature_', 'signature');
            }
            if (!$hotelregi_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$hotelregi_id) {
                $hotelregi_data['user_id'] = $session_user_id;
                $hotelregi_data['status'] = VALUE_ONE;
                $hotelregi_data['created_by'] = $session_user_id;
                $hotelregi_data['created_time'] = date('Y-m-d H:i:s');
                $hotelregi_id = $this->utility_model->insert_data('hotel', $hotelregi_data);
            } else {
                $hotelregi_data['updated_by'] = $session_user_id;
                $hotelregi_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('hotelregi_id', $hotelregi_id, 'hotel', $hotelregi_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['hotelregi_data'] = $hotelregi_data;
            $success_array['hotelregi_id'] = $hotelregi_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/Hotelregi.php
 */