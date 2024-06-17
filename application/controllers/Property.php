<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_property_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['property_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['property_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'property_registration', 'district', $search_district, 'property_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['property_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['wmregistration_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_property_data_by_id() {
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
            $property_id = get_from_post('property_id');
            if (!$property_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $property_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');
            if (empty($property_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['property_data'] = $property_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_appointment_data_by_id() {
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
            $property_id = get_from_post('property_id');
            if (!$property_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $success_array = get_success_array();
            $this->db->trans_start();
            $appointment_data = $this->utility_model->get_by_id('property_id', $property_id, 'appointment');
            if (empty($appointment_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($property_id);
            $appointment_data['encrypt_id'] = $success_array['encrypt_id'];
            $appointment_data['property_id'] = $property_id;
            $success_array['appointment_data'] = $appointment_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_property() {
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
            $property_id = get_from_post('property_id');
            $property_data = $this->_get_post_data_for_property();
            $validation_message = $this->_check_validation_for_property($property_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $property_data['application_date'] = convert_to_mysql_date_format($property_data['application_date']);

            $dates_array = array();
            $holiday_dates = array();
            $temp_holiday_dates = $this->utility_model->get_result_data_by_id('fdw_ess', VALUE_ONE, 'holidaylist');
            foreach ($temp_holiday_dates as $thd) {
                array_push($holiday_dates, $thd['holiday_date']);
            }
            // $dates_array = array();
            $temp_cnt = 0;
            for ($i = 1; $i <= 7; $i++) {
                $date_cnt = $temp_cnt + $i;
                $tomorrow = date('Y-m-d', strtotime("$date_cnt day"));
                if (in_array($tomorrow, $holiday_dates)) {
                    $i--;
                    $temp_cnt++;
                } else {
                    $new_tomorrow = convert_to_new_date_format($tomorrow);
                    if (!isset($dates_array[$new_tomorrow])) {
                        $dates_array[$new_tomorrow] = $new_tomorrow;
                    }
                }
            }
            $property_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $property_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$property_id || $property_id == NULL) {
                $property_data['user_id'] = $user_id;
                $property_data['created_by'] = $user_id;
                $property_data['created_time'] = date('Y-m-d H:i:s');
                $property_id = $this->utility_model->insert_data('property_registration', $property_data);
            } else {
                $property_data['updated_by'] = $user_id;
                $property_data['updated_time'] = date('Y-m-d H:i:s');

                $this->utility_model->update_data('property_id', $property_id, 'property_registration', $property_data);
            }
            $new_property_data = $this->utility_model->get_by_id('property_id', $property_id, 'appointment');

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($property_id);
            $new_property_data['property_id'] = $property_id;
            $new_property_data['encrypt_id'] = $success_array['encrypt_id'];
            $new_property_data['dates_array'] = $dates_array;
            $success_array['appointment_data'] = $new_property_data;

            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_property() {
        $property_data = array();
        $property_data['district'] = get_from_post('district');
        $property_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $property_data['application_date'] = get_from_post('application_date');
        $property_data['party_type'] = get_from_post('party_type_for_property_data');
        $property_data['document_type'] = get_from_post('document_type');
        $property_data['party_name'] = get_from_post('party_name');
        $property_data['party_address'] = get_from_post('party_address');
        $property_data['digit_mobile_number'] = get_from_post('digit_mobile_number');
        $property_data['email'] = get_from_post('email');
        $property_data['document'] = get_from_post('document');
        $property_data['pancard_all_parties'] = get_from_post('pancard_all_parties');

        return $property_data;
    }

    function _check_validation_for_property($property_data) {
        if (!$property_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$property_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$property_data['party_type']) {
            return PARTY_TYPE_MESSAGE;
        }
        if (!$property_data['document_type']) {
            return DOCUMENT_TYPE_MESSAGE;
        }
        if (!$property_data['party_name']) {
            return PARTY_NAME_MESSAGE;
        }
        if (!$property_data['party_address']) {
            return PARTY_ADDRESS_MESSAGE;
        }
        if (!$property_data['digit_mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$property_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$property_data['document']) {
            return PROPERTY_DESCRIPTION_MESSAGE;
        }

        return '';
    }

    function submit_appointment() {
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
            $appointment_id = get_from_post('appointment_id');
            $appointment_data = $this->_get_post_data_for_appointment();
            $validation_message = $this->_check_validation_for_appointment($appointment_data);
            // $is_capital_investment = get_from_post('is_capital_investment');
            // $is_intrest_subsidy = get_from_post('is_intrest_subsidy');



            $this->db->trans_start();
            //   $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_data['appointment_date']);
            $property_id = get_from_post('property_id');
            $appointment_data['property_id'] = $property_id;
            $appointment_data['user_id'] = $user_id;
            //$appointment_data['status'] = $module_type;
            $appointment_data['created_by'] = $user_id;
            $appointment_data['created_time'] = date('Y-m-d H:i:s');

            if (!$appointment_id || $appointment_id == NULL) {
                $appointment_id = $this->utility_model->insert_data('appointment', $appointment_data);
            } else {
                $appointment_data['updated_by'] = $user_id;
                $appointment_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('appointment_id', $appointment_id, 'appointment', $appointment_data);
            }

            $property_update_data = array();
            $property_update_data['updated_by'] = $user_id;
            $property_update_data['updated_time'] = date('Y-m-d H:i:s');
            $property_update_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $property_update_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }


            $this->utility_model->update_data('property_id', $property_id, 'property_registration', $property_update_data);

            $new_appointment_data = $this->utility_model->get_by_id('property_id', $property_id, 'appointment');
            $new_property_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');

            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYONE, $property_id);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $success_array = get_success_array();
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;

            $success_array['encrypt_id'] = get_encrypt_id($property_id);
            $new_appointment_data['property_id'] = $property_id;
            $new_appointment_data['encrypt_id'] = $success_array['encrypt_id'];
            //  $new_appointment_data['dates_array'] = $dates_array;
            $success_array['appointment_data'] = $new_appointment_data;

            $success_array['encrypt_id'] = get_encrypt_id($property_id);
            $new_property_data['property_id'] = $property_id;
            $new_property_data['encrypt_id'] = $success_array['encrypt_id'];
            //  $new_property_data['dates_array'] = $dates_array;
            $success_array['property_data'] = $new_property_data;

            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_appointment() {
        $appointment_data = array();
        $appointment_data['appointment_date'] = get_from_post('appointment_date_for_appointment');
        $appointment_data['select_time'] = get_from_post('select_time');
        return $appointment_data;
    }

    function _check_validation_for_appointment($appointment_data) {
        if (!$appointment_data['appointment_date']) {
            return APPOINTMENT_DATE_MESSAGE;
        }
        if (!$appointment_data['select_time']) {
            return DOCUMENT_TYPE_MESSAGE;
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
            $property_id = get_from_post('property_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$property_id || $property_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'property' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['pan_card'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'property' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['aadhaar_card'];
            }
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('property_id', $property_id, 'property_registration', array('pan_card' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('property_id', $property_id, 'property_registration', array('aadhaar_card' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $property_id = get_from_post('property_id_for_property_form1');
            if (!is_post() || $user_id == null || !$user_id || $property_id == null || !$property_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_property_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');

            if (empty($existing_property_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('property_data' => $existing_property_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('property/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_property_data_by_property_id() {
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
            $property_id = get_from_post('property_id');
            if (!$property_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $property_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');
            if (empty($property_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWENTYONE, $property_id, $property_data);
            $property_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWENTYONE, 'fees_bifurcation', 'module_id', $property_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['property_data'] = $property_data;
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
            $property_id = get_from_post('property_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$property_id || $property_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'property' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('property_id', $property_id, 'property_registration', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $property_id = get_from_post('property_id_for_property_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $property_id == NULL || !$property_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_pr_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');
            if (empty($ex_pr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_pr_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_pr_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_property_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $property_data = array();
            if ($_FILES['fees_paid_challan_for_property_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'property';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_property_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_property_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $property_data['status'] = VALUE_FOUR;
                $property_data['fees_paid_challan'] = $filename;
                $property_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_pr_data['payment_type'] == VALUE_TWO) {
                $property_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $property_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $property_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWENTYONE, $property_id, $ex_pr_data['district'], $ex_pr_data['total_fees'], $property_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $property_data['user_payment_type'] = $user_payment_type;
            } else {
                $property_data['user_payment_type'] = VALUE_ZERO;
            }
            $property_data['updated_by'] = $user_id;
            $property_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('property_id', $property_id, 'property_registration', $property_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($property_data['status']) ? $property_data['status'] : $ex_pr_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_pr_data['payment_type'];
            $success_array['user_payment_type'] = $property_data['user_payment_type'];
            if ($ex_pr_data['payment_type'] == VALUE_TWO && $property_data['user_payment_type'] == VALUE_THREE) {
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
            $property_id = get_from_post('property_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $property_id == null || !$property_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_property_data = $this->utility_model->get_by_id('property_id', $property_id, 'property_registration');
            if (empty($existing_property_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_property_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_property($existing_property_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_property_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $property_id = get_from_post('property_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $property_data = $this->utility_model->upload_document('pan_card_for_property', 'property', 'pan_card_', 'pan_card');
            }
            if ($file_no == VALUE_TWO) {
                $property_data = $this->utility_model->upload_document('aadhaar_card_for_property', 'property', 'aadhaar_card_', 'aadhaar_card');
            }
            if (!$property_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$property_id) {
                $property_data['user_id'] = $session_user_id;
                $property_data['status'] = VALUE_ONE;
                $property_data['created_by'] = $session_user_id;
                $property_data['created_time'] = date('Y-m-d H:i:s');
                $property_id = $this->utility_model->insert_data('property_registration', $property_data);
            } else {
                $property_data['updated_by'] = $session_user_id;
                $property_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('property_id', $property_id, 'property_registration', $property_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['property_data'] = $property_data;
            $success_array['property_id'] = $property_id;
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