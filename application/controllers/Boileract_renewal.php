<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Boileract_renewal extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_boiler_act_renewal_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['boiler_act_renewal_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['boiler_act_renewal_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'boileract_renewal', 'district', $search_district, 'boiler_renewal_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['boiler_act_renewal_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['boiler_act_renewal_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_boiler_act_data_by_id() {
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
            $boiler_act_data = $this->utility_model->get_by_id('registration_number', $license_number, 'boileract');
            // if (empty($boiler_act_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['boiler_act_data'] = $boiler_act_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_boiler_act_renewal_data_by_id() {
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
            $boiler_act_renewal_id = get_from_post('boiler_renewal_id');
            if (!$boiler_act_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $boiler_act_renewal_data = $this->utility_model->get_by_id('boiler_renewal_id', $boiler_act_renewal_id, 'boileract_renewal');
            if (empty($boiler_act_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['boiler_act_renewal_data'] = $boiler_act_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_boiler_act_renewal() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $boileract_renewal_id = get_from_post('boiler_renewal_id');
            $boiler_act_renewal_data = $this->_get_post_data_for_boiler_act_renewal();
            $validation_message = $this->_check_validation_for_boiler_act_renewal($boiler_act_renewal_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->db->trans_start();
            $boiler_act_renewal_data['hydraulically_tested_on'] = convert_to_mysql_date_format($boiler_act_renewal_data['hydraulically_tested_on']);
            //$boiler_act_renewal_data['status'] = get_from_post('form_status');
            $boiler_act_renewal_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $boiler_act_renewal_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$boileract_renewal_id || $boileract_renewal_id == NULL) {
                $boiler_act_renewal_data['user_id'] = $user_id;
                $boiler_act_renewal_data['created_by'] = $user_id;
                $boiler_act_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $boileract_renewal_id = $this->utility_model->insert_data('boileract_renewal', $boiler_act_renewal_data);
            } else {
                $boiler_act_renewal_data['updated_by'] = $user_id;
                $boiler_act_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('boiler_renewal_id', $boileract_renewal_id, 'boileract_renewal', $boiler_act_renewal_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTYFOUR, $boileract_renewal_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            //$success_array['message'] = FACTORY_LICENSE_SAVED_MESSAGE;
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_boiler_act_renewal() {
        $boiler_act_renewal_data = array();
        $boiler_act_renewal_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $boiler_act_renewal_data['boiler_id'] = get_from_post('boiler_id');
        $boiler_act_renewal_data['license_number'] = get_from_post('registration_number');
        $boiler_act_renewal_data['owner_name'] = get_from_post('owner_name');
        $boiler_act_renewal_data['situation_of_boiler'] = get_from_post('situation_of_boiler');
        $boiler_act_renewal_data['boiler_type'] = get_from_post('boiler_type');
        $boiler_act_renewal_data['district'] = get_from_post('district');
        $boiler_act_renewal_data['ut'] = get_from_post('ut');
        $boiler_act_renewal_data['working_pressure'] = get_from_post('working_pressure');
        $boiler_act_renewal_data['max_pressure'] = get_from_post('max_pressure');
        $boiler_act_renewal_data['heating_surface_area'] = get_from_post('heating_surface_area');
        $boiler_act_renewal_data['length_of_pipes'] = get_from_post('length_of_pipes');
        $boiler_act_renewal_data['max_evaporation'] = get_from_post('max_evaporation');
        $boiler_act_renewal_data['place_of_manufacture'] = get_from_post('place_of_manufacture');
        $boiler_act_renewal_data['year_of_manufacture'] = get_from_post('year_of_manufacture');
        $boiler_act_renewal_data['name_of_manufacture'] = get_from_post('name_of_manufacture');
        $boiler_act_renewal_data['manufacture_address'] = get_from_post('manufacture_address');
        $boiler_act_renewal_data['hydraulically_tested_on'] = get_from_post('hydraulically_tested_on');
        $boiler_act_renewal_data['hydraulically_tested_to'] = get_from_post('hydraulically_tested_to');
        $boiler_act_renewal_data['repairs'] = get_from_post('repairs');
        $boiler_act_renewal_data['remarks'] = get_from_post('remarks');
        $boiler_act_renewal_data['registration_number'] = get_from_post('registration_number');
        return $boiler_act_renewal_data;
    }

    function _check_validation_for_boiler_act_renewal($boiler_act_renewal_data) {
        if (!$boiler_act_renewal_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$boiler_act_renewal_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$boiler_act_renewal_data['license_number']) {
            return LICENSE_NUMBER_MESSAGE;
        }
        if (!$boiler_act_renewal_data['owner_name']) {
            return OWNER_NAME_MESSAGE;
        }
        if (!$boiler_act_renewal_data['situation_of_boiler']) {
            return BOILER_SITUATION_MESSAGE;
        }
        if (!$boiler_act_renewal_data['boiler_type']) {
            return BOILER_TYPE_MESSAGE;
        }

        if (!$boiler_act_renewal_data['ut']) {
            return UT_MESSAGE;
        }
        if (!$boiler_act_renewal_data['working_pressure']) {
            return WORKING_PRESSURE_MESSAGE;
        }
        if (!$boiler_act_renewal_data['max_pressure']) {
            return MAX_PRESSURE_MESSAGE;
        }
        if (!$boiler_act_renewal_data['heating_surface_area']) {
            return HEATING_SURFACE_MESSAGE;
        }
        if (!$boiler_act_renewal_data['length_of_pipes']) {
            return LENGTH_PIPES_MESSAGE;
        }
        if (!$boiler_act_renewal_data['max_evaporation']) {
            return MAX_EVAPORATION_MESSAGE;
        }
        if (!$boiler_act_renewal_data['place_of_manufacture']) {
            return MANUFACTURE_PLACE_MESSAGE;
        }
        if (!$boiler_act_renewal_data['year_of_manufacture']) {
            return MANUFACTURE_YEAR_MESSAGE;
        }
        if (!$boiler_act_renewal_data['name_of_manufacture']) {
            return MANUFACTURE_NAME_MESSAGE;
        }
        if (!$boiler_act_renewal_data['manufacture_address']) {
            return MANUFACTURE_ADDRESS_MESSAGE;
        }
        if (!$boiler_act_renewal_data['hydraulically_tested_on']) {
            return HYDRULICALLY_TESTED_ON_MESSAGE;
        }
        if (!$boiler_act_renewal_data['hydraulically_tested_to']) {
            return HYDRULICALLY_TESTED_MESSAGE;
        }
        if (!$boiler_act_renewal_data['repairs'] && $boiler_act_renewal_data['repairs'] != 0) {
            return REPAIRS_MESSAGE;
        }

        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $boiler_renewal_id = get_from_post('boileract_renewal_id_for_boileract_renewal_form1');
            if (!is_post() || $user_id == null || !$user_id || $boiler_renewal_id == null || !$boiler_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_boileract_renewal_data = $this->utility_model->get_by_id('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal');

            if (empty($existing_boileract_renewal_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            //$this->utility_lib->gc_for_boiler_renewal($existing_boiler_renewal_data);
            $taluka_array = $this->config->item('taluka_array');
            $existing_boileract_renewal_data['district'] = isset($taluka_array[$existing_boileract_renewal_data['district']]) ? $taluka_array[$existing_boileract_renewal_data['district']] : '-';
            //$this->utility_lib->gc_for_boiler_renewal($existing_boiler_renewal_data);
            $data = array('boileract_renewal_data' => $existing_boileract_renewal_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('boileract_renewal/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_boileract_renewal_data_by_boileract_renewal_id() {
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
            $boileract_renewal_id = get_from_post('boileract_renewal_id');
            if (!$boileract_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $boiler_act_renewal_data = $this->utility_model->get_by_id('boiler_renewal_id', $boileract_renewal_id, 'boileract_renewal');
            if (empty($boiler_act_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTYFOUR, $boileract_renewal_id, $boiler_act_renewal_data);
            $boiler_act_renewal_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTYFOUR, 'fees_bifurcation', 'module_id', $boileract_renewal_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['boiler_act_renewal_data'] = $boiler_act_renewal_data;
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
            $boileract_renewal_id = get_from_post('boileract_renewal_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$boileract_renewal_id || $boileract_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('boiler_renewal_id', $boileract_renewal_id, 'boileract_renewal');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boileract' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('boiler_renewal_id', $boileract_renewal_id, 'boileract_renewal', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $boileract_renewal_id = get_from_post('boiler_act_renewal_id_for_boiler_act_renewal_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $boileract_renewal_id == NULL || !$boileract_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_blr_data = $this->utility_model->get_by_id('boiler_renewal_id', $boileract_renewal_id, 'boileract_renewal');
            if (empty($ex_blr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_blr_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_boiler_act_renewal_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $boiler_act_renewal_data = array();
            if ($_FILES['fees_paid_challan_for_boiler_act_renewal_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'boileract';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_boiler_act_renewal_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_boiler_act_renewal_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $boiler_act_renewal_data['status'] = VALUE_FOUR;
                $boiler_act_renewal_data['fees_paid_challan'] = $filename;
                $boiler_act_renewal_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_blr_data['payment_type'] == VALUE_TWO) {
                $boiler_act_renewal_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $boiler_act_renewal_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $boiler_act_renewal_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTYFOUR, $boileract_renewal_id, $ex_blr_data['district'], $ex_blr_data['total_fees'], $boiler_act_renewal_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $boiler_act_renewal_data['user_payment_type'] = $user_payment_type;
            } else {
                $boiler_act_renewal_data['user_payment_type'] = VALUE_ZERO;
            }
            $boiler_act_renewal_data['updated_by'] = $user_id;
            $boiler_act_renewal_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('boiler_renewal_id', $boileract_renewal_id, 'boileract_renewal', $boiler_act_renewal_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($boiler_act_renewal_data['status']) ? $boiler_act_renewal_data['status'] : $ex_blr_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_blr_data['payment_type'];
            $success_array['user_payment_type'] = $boiler_act_renewal_data['user_payment_type'];
            if ($ex_blr_data['payment_type'] == VALUE_TWO && $boiler_act_renewal_data['user_payment_type'] == VALUE_THREE) {
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
            $boiler_renewal_id = get_from_post('boiler_renewal_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $boiler_renewal_id == null || !$boiler_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_boiler_data = $this->utility_model->get_by_id('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal');
            if (empty($existing_boiler_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_boiler_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $taluka_array = $this->config->item('taluka_array');
            $existing_boiler_data['district'] = isset($taluka_array[$existing_boiler_data['district']]) ? $taluka_array[$existing_boiler_data['district']] : '-';
            $this->utility_lib->gc_for_boiler_renewal($existing_boiler_data);
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
            $boiler_renewal_id = get_from_post('boiler_renewal_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$boiler_renewal_id || $boiler_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boileract' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['company_letter_head'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boileract' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_challan'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boileract' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['last_boiler_license'];
            }

            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boileract' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_of_applicant'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal', array('company_letter_head' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal', array('copy_of_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal', array('last_boiler_license' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal', array('sign_of_applicant' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }


            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_boileract_renewal_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $boiler_renewal_id = get_from_post('boiler_renewal_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $boiler_act_renewal_data = $this->utility_model->upload_document('company_letter_head_for_boileract_renewal', 'boileract', 'company_letter_head_', 'company_letter_head');
            }
            if ($file_no == VALUE_TWO) {
                $boiler_act_renewal_data = $this->utility_model->upload_document('copy_of_challan_for_boileract_renewal', 'boileract', 'copy_of_challan_', 'copy_of_challan');
            }
            if ($file_no == VALUE_THREE) {
                $boiler_act_renewal_data = $this->utility_model->upload_document('last_boiler_license_for_boileract_renewal', 'boileract', 'last_boiler_license_', 'last_boiler_license');
            }

            if ($file_no == VALUE_FOUR) {
                $boiler_act_renewal_data = $this->utility_model->upload_document('sign_of_applicant_for_boileract_renewal', 'boileract', 'sign_of_applicant_', 'sign_of_applicant');
            }
            if (!$boiler_act_renewal_data) {
                return false;
            }
            $this->db->trans_start();
            $boiler_act_renewal_data['status'] = VALUE_ONE;
            if (!$boiler_renewal_id) {
                $boiler_act_renewal_data['user_id'] = $session_user_id;
                $boiler_act_renewal_data['created_by'] = $session_user_id;
                $boiler_act_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $boiler_renewal_id = $this->utility_model->insert_data('boileract_renewal', $boiler_act_renewal_data);
            } else {
                $boiler_act_renewal_data['updated_by'] = $session_user_id;
                $boiler_act_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('boiler_renewal_id', $boiler_renewal_id, 'boileract_renewal', $boiler_act_renewal_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['boiler_act_renewal_data'] = $boiler_act_renewal_data;
            $success_array['boiler_renewal_id'] = $boiler_renewal_id;
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