<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Singlereturn extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        // $this->load->model('single_return_model');
        $this->load->model('utility_model');
    }

    function get_single_return_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['single_return_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['single_return_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'singlereturn', 'district', $search_district, 'singlereturn_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['single_return_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['single_return_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_single_return_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['single_return_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_single_return_parta_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_parta');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $single_return_data['encrypt_id'] = $success_array['encrypt_id'];
            $single_return_data['singlereturn_id'] = $singlereturn_id;
            $success_array['single_return_parta_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_single_return_partb_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partb');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $single_return_data['encrypt_id'] = $success_array['encrypt_id'];
            $single_return_data['singlereturn_id'] = $singlereturn_id;
            $success_array['single_return_partb_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_single_return_partc_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partc');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $single_return_data['encrypt_id'] = $success_array['encrypt_id'];
            $single_return_data['singlereturn_id'] = $singlereturn_id;
            $success_array['single_return_partc_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_single_return_partd_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partd');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $single_return_data['encrypt_id'] = $success_array['encrypt_id'];
            $single_return_data['singlereturn_id'] = $singlereturn_id;
            $success_array['single_return_partd_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_single_return_parte_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_parte');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $single_return_data['encrypt_id'] = $success_array['encrypt_id'];
            $single_return_data['singlereturn_id'] = $singlereturn_id;
            $success_array['single_return_parte_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_single_return_partf_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partf');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $single_return_data['encrypt_id'] = $success_array['encrypt_id'];
            $single_return_data['singlereturn_id'] = $singlereturn_id;
            $success_array['single_return_partf_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_single_return_partg_data_by_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partg');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $single_return_data['encrypt_id'] = $success_array['encrypt_id'];
            $single_return_data['singlereturn_id'] = $singlereturn_id;
            $success_array['single_return_partg_data'] = $single_return_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_single_return() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            $single_return_data = $this->_get_post_data_for_single_return();
            $validation_message = $this->_check_validation_for_single_return($single_return_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $single_return_data['commencement_date'] = convert_to_mysql_date_format($single_return_data['commencement_date']);
            //$single_return_data['status'] = get_from_post('form_status');
            $single_return_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $single_return_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$singlereturn_id || $singlereturn_id == NULL) {
                $single_return_data['user_id'] = $user_id;
                $single_return_data['created_by'] = $user_id;
                $single_return_data['created_time'] = date('Y-m-d H:i:s');
                $singlereturn_id = $this->utility_model->insert_data('singlereturn', $single_return_data);
            } else {
                $single_return_data['updated_by'] = $user_id;
                $single_return_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_id', $singlereturn_id, 'singlereturn', $single_return_data);
            }
            $new_singlereturn_parta_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_parta');
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYNINE, $singlereturn_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_id);
            $new_singlereturn_parta_data['singlereturn_id'] = $singlereturn_id;
            $new_singlereturn_parta_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['singlereturn_parta_data'] = $new_singlereturn_parta_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return() {
        $single_return_data = array();
        $single_return_data['district'] = get_from_post('district');
        $single_return_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $single_return_data['esta_name'] = get_from_post('esta_name');
        $single_return_data['esta_address'] = get_from_post('esta_address');
        $single_return_data['esta_tel_no'] = get_from_post('esta_tel_no');
        $single_return_data['esta_mob_no'] = get_from_post('esta_mob_no');
        $single_return_data['esta_fax_no'] = get_from_post('esta_fax_no');
        $single_return_data['esta_email_id'] = get_from_post('esta_email_id');
        $single_return_data['emp_name'] = get_from_post('emp_name');
        $single_return_data['emp_address'] = get_from_post('emp_address');
        $single_return_data['emp_tel_no'] = get_from_post('emp_tel_no');
        $single_return_data['emp_mob_no'] = get_from_post('emp_mob_no');
        $single_return_data['emp_fax_no'] = get_from_post('emp_fax_no');
        $single_return_data['emp_email_id'] = get_from_post('emp_email_id');
        $single_return_data['manager_name'] = get_from_post('manager_name');
        $single_return_data['manager_address'] = get_from_post('manager_address');
        $single_return_data['manager_tel_no'] = get_from_post('manager_tel_no');
        $single_return_data['manager_mob_no'] = get_from_post('manager_mob_no');
        $single_return_data['manager_fax_no'] = get_from_post('manager_fax_no');
        $single_return_data['manager_email_id'] = get_from_post('manager_email_id');
        $single_return_data['registration_no'] = get_from_post('registration_no');
        $single_return_data['license_no'] = get_from_post('license_no');
        $single_return_data['commencement_date'] = get_from_post('commencement_date');
        $single_return_data['industry_nature'] = get_from_post('industry_nature');
        $single_return_data['direct_unskilled'] = get_from_post('direct_unskilled');
        $single_return_data['direct_semiskilled'] = get_from_post('direct_semiskilled');
        $single_return_data['direct_skilled'] = get_from_post('direct_skilled');
        $single_return_data['direct_total'] = get_from_post('direct_total');
        $single_return_data['direct_male'] = get_from_post('direct_male');
        $single_return_data['direct_female'] = get_from_post('direct_female');
        $single_return_data['contractor_unskilled'] = get_from_post('contractor_unskilled');
        $single_return_data['contractor_semiskilled'] = get_from_post('contractor_semiskilled');
        $single_return_data['contractor_skilled'] = get_from_post('contractor_skilled');
        $single_return_data['contractor_total'] = get_from_post('contractor_total');
        $single_return_data['contractor_male'] = get_from_post('contractor_male');
        $single_return_data['contractor_female'] = get_from_post('contractor_female');
        $single_return_data['total_unskilled'] = get_from_post('total_unskilled');
        $single_return_data['total_semiskilled'] = get_from_post('total_semiskilled');
        $single_return_data['total_skilled'] = get_from_post('total_skilled');
        $single_return_data['total_total'] = get_from_post('total_total');
        $single_return_data['total_male'] = get_from_post('total_male');
        $single_return_data['total_female'] = get_from_post('total_female');
        return $single_return_data;
    }

    function _check_validation_for_single_return($single_return_data) {
        if (!$single_return_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$single_return_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$single_return_data['esta_name']) {
            return FACTORY_NAME_MESSAGE;
        }
        if (!$single_return_data['esta_address']) {
            return FACTORY_ADDRESS_MESSAGE;
        }
        if (!$single_return_data['esta_tel_no']) {
            return TEL_NUMBER_MESSAGE;
        }
        if (!$single_return_data['esta_mob_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$single_return_data['esta_fax_no']) {
            return FAX_NUMBER_MESSAGE;
        }
        if (!$single_return_data['esta_email_id']) {
            return EMAIL_MESSAGE;
        }
        if (!$single_return_data['emp_name']) {
            return EMP_NAME_MESSAGE;
        }
        if (!$single_return_data['emp_address']) {
            return EMP_ADDRESS_MESSAGE;
        }
        if (!$single_return_data['emp_tel_no']) {
            return TEL_NUMBER_MESSAGE;
        }
        if (!$single_return_data['emp_mob_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$single_return_data['emp_fax_no']) {
            return FAX_NUMBER_MESSAGE;
        }
        if (!$single_return_data['emp_email_id']) {
            return EMAIL_MESSAGE;
        }
        if (!$single_return_data['manager_name']) {
            return MANAGER_PERSON_NAME_MESSAGE;
        }
        if (!$single_return_data['manager_address']) {
            return MANAGER_PERSON_ADDRESS_MESSAGE;
        }
        if (!$single_return_data['manager_tel_no']) {
            return TEL_NUMBER_MESSAGE;
        }
        if (!$single_return_data['manager_mob_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$single_return_data['manager_fax_no']) {
            return FAX_NUMBER_MESSAGE;
        }
        if (!$single_return_data['manager_email_id']) {
            return EMAIL_MESSAGE;
        }
        if (!$single_return_data['registration_no']) {
            return REGISTRATION_NUMBER_MESSAGE;
        }
        if (!$single_return_data['license_no']) {
            return LICENSE_NUMBER_MESSAGE;
        }
        if (!$single_return_data['commencement_date']) {
            return COMMENCEMENTS_DATE_MESSAGE;
        }
        if (!$single_return_data['industry_nature']) {
            return INDUSTRY_NATURE_MESSAGE;
        }
        if (!$single_return_data['direct_unskilled'] && $single_return_data['direct_unskilled'] != 0) {
            return DIRECT_UNSKILLEDMESSAGE;
        }
        if (!$single_return_data['direct_semiskilled'] && $single_return_data['direct_semiskilled'] != 0) {
            return DIRECT_SEMISKILLED_MESSAGE;
        }
        if (!$single_return_data['direct_skilled'] && $single_return_data['direct_skilled'] != 0) {
            return DIRECT_SKILLED_MESSAGE;
        }
        if (!$single_return_data['direct_total'] && $single_return_data['direct_total'] != 0) {
            return DIRECT_TOTAL_MESSAGE;
        }
        if (!$single_return_data['direct_male'] && $single_return_data['direct_male'] != 0) {
            return DIRECT_MALE_MESSAGE;
        }
        if (!$single_return_data['direct_female'] && $single_return_data['direct_female'] != 0) {
            return DIRECT_FEMALE_MESSAGE;
        }
        if (!$single_return_data['contractor_unskilled'] && $single_return_data['contractor_unskilled'] != 0) {
            return CONTRACTOR_UNSKILLEDMESSAGE;
        }
        if (!$single_return_data['contractor_semiskilled'] && $single_return_data['contractor_semiskilled'] != 0) {
            return CONTRACTOR_SEMISKILLED_MESSAGE;
        }
        if (!$single_return_data['contractor_skilled'] && $single_return_data['contractor_skilled'] != 0) {
            return CONTRACTOR_SKILLED_MESSAGE;
        }
        if (!$single_return_data['contractor_total'] && $single_return_data['contractor_total'] != 0) {
            return CONTRACTOR_TOTAL_MESSAGE;
        }
        if (!$single_return_data['contractor_male'] && $single_return_data['contractor_male'] != 0) {
            return CONTRACTOR_MALE_MESSAGE;
        }
        if (!$single_return_data['contractor_female'] && $single_return_data['contractor_female'] != 0) {
            return CONTRACTOR_FEMALE_MESSAGE;
        }
        if (!$single_return_data['total_unskilled'] && $single_return_data['total_unskilled'] != 0) {
            return TOTAL_UNSKILLEDMESSAGE;
        }
        if (!$single_return_data['total_semiskilled'] && $single_return_data['total_semiskilled'] != 0) {
            return TOTAL_SEMISKILLED_MESSAGE;
        }
        if (!$single_return_data['total_skilled'] && $single_return_data['total_skilled'] != 0) {
            return TOTAL_SKILLED_MESSAGE;
        }
        if (!$single_return_data['total_total'] && $single_return_data['total_total'] != 0) {
            return TOTAL_TOTAL_MESSAGE;
        }
        if (!$single_return_data['total_male'] && $single_return_data['total_male'] != 0) {
            return TOTAL_MALE_MESSAGE;
        }
        if (!$single_return_data['total_female'] && $single_return_data['total_female'] != 0) {
            return TOTAL_FEMALE_MESSAGE;
        }

        return '';
    }

    function submit_single_return_parta() {
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
            $singlereturn_parta_id = get_from_post('singlereturn_parta_id');
            $single_return_parta_data = $this->_get_post_data_for_single_return_parta();
            $validation_message = $this->_check_validation_for_single_return_parta($single_return_parta_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();
            //$single_return_parta_data['status'] = $module_type;
            $singlereturn_id = $single_return_parta_data['singlereturn_id'];
            $single_return_parta_data['user_id'] = $user_id;
            $single_return_parta_data['created_by'] = $user_id;
            $single_return_parta_data['created_time'] = date('Y-m-d H:i:s');
            if (!$singlereturn_parta_id || $singlereturn_parta_id == NULL) {
                $singlereturn_parta_id = $this->utility_model->insert_data('singlereturn_parta', $single_return_parta_data);
            } else {
                $single_return_parta_data['updated_by'] = $user_id;
                $single_return_parta_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_parta_id', $singlereturn_parta_id, 'singlereturn_parta', $single_return_parta_data);
            }
            $new_singlereturn_partb_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partb');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_parta_id);
            $new_singlereturn_partb_data['singlereturn_id'] = $singlereturn_id;
            $new_singlereturn_partb_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['singlereturn_partb_data'] = $new_singlereturn_partb_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return_parta() {
        $single_return_parta_data = array();
        $single_return_parta_data['singlereturn_id'] = get_from_post('singlereturn_id');
        $single_return_parta_data['worked_days'] = get_from_post('worked_days');
        $single_return_parta_data['man_worked_days'] = get_from_post('man_worked_days');
        $single_return_parta_data['average_emp'] = get_from_post('average_emp');
        $single_return_parta_data['male_wages'] = get_from_post('male_wages');
        $single_return_parta_data['female_wages'] = get_from_post('female_wages');
        $single_return_parta_data['total_fine'] = get_from_post('total_fine');
        $single_return_parta_data['deduction'] = get_from_post('deduction');
        return $single_return_parta_data;
    }

    function _check_validation_for_single_return_parta($single_return_parta_data) {
        if (!$single_return_parta_data['worked_days']) {
            return WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_parta_data['man_worked_days']) {
            return MAN_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_parta_data['average_emp']) {
            return AVERAGE_EMP_MESSAGE;
        }
        if (!$single_return_parta_data['male_wages']) {
            return MALE_WAGES_MESSAGE;
        }
        if (!$single_return_parta_data['female_wages']) {
            return FEMALE_WAGES_MESSAGE;
        }
        // if (!$single_return_parta_data['total_fine']) {
        //     return TOTAL_FINE_MESSAGE;
        // }
        // if (!$single_return_parta_data['deduction']) {
        //     return DEDUCTION_MESSAGE;
        // }

        return '';
    }

    function submit_single_return_partb() {
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
            $singlereturn_partb_id = get_from_post('singlereturn_partb_id');
            $single_return_partb_data = $this->_get_post_data_for_single_return_partb();
            $validation_message = $this->_check_validation_for_single_return_partb($single_return_partb_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();
            //$single_return_partb_data['status'] = $module_type;
            $singlereturn_id = $single_return_partb_data['singlereturn_id'];
            $single_return_partb_data['payment_date'] = convert_to_mysql_date_format($single_return_partb_data['payment_date']);
            $single_return_partb_data['user_id'] = $user_id;
            $single_return_partb_data['created_by'] = $user_id;
            $single_return_partb_data['created_time'] = date('Y-m-d H:i:s');
            if (!$singlereturn_partb_id || $singlereturn_partb_id == NULL) {
                $singlereturn_partb_id = $this->utility_model->insert_data('singlereturn_partb', $single_return_partb_data);
            } else {
                $single_return_partb_data['updated_by'] = $user_id;
                $single_return_partb_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_partb_id', $singlereturn_partb_id, 'singlereturn_partb', $single_return_partb_data);
            }
            $new_singlereturn_partc_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partc');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_partb_id);
            $new_singlereturn_partc_data['singlereturn_id'] = $singlereturn_id;
            $new_singlereturn_partc_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['singlereturn_partc_data'] = $new_singlereturn_partc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return_partb() {
        $single_return_partb_data = array();
        $single_return_partb_data['singlereturn_id'] = get_from_post('singlereturn_id');
        $single_return_partb_data['percentage_of_bonus'] = get_from_post('percentage_of_bonus');
        $single_return_partb_data['no_of_baneficiaries'] = get_from_post('no_of_baneficiaries');
        $single_return_partb_data['total_bonus_paid'] = get_from_post('total_bonus_paid');
        $single_return_partb_data['payment_date'] = get_from_post('payment_date');
        $single_return_partb_data['not_paid_reason'] = get_from_post('not_paid_reason');
        return $single_return_partb_data;
    }

    function _check_validation_for_single_return_partb($single_return_partb_data) {
        if (!$single_return_partb_data['percentage_of_bonus']) {
            return PERCENTAGE_BONUS_MESSAGE;
        }
        if (!$single_return_partb_data['no_of_baneficiaries']) {
            return NO_OF_BENEFICIARIES_MESSAGE;
        }
        if (!$single_return_partb_data['total_bonus_paid']) {
            return BONUS_PAID_MESSAGE;
        }
        if (!$single_return_partb_data['payment_date']) {
            return PAYMENT_DATE_MESSAGE;
        }
        // if (!$single_return_partb_data['not_paid_reason']) {
        //     return BONUS_REASON_MESSAGE;
        // }

        return '';
    }

    function submit_single_return_partc() {
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
            $singlereturn_partc_id = get_from_post('singlereturn_partc_id');
            $single_return_partc_data = $this->_get_post_data_for_single_return_partc();
            $validation_message = $this->_check_validation_for_single_return_partc($single_return_partc_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();
            //$single_return_partc_data['status'] = $module_type;
            $singlereturn_id = $single_return_partc_data['singlereturn_id'];
            $single_return_partc_data['user_id'] = $user_id;
            $single_return_partc_data['created_by'] = $user_id;
            $single_return_partc_data['created_time'] = date('Y-m-d H:i:s');
            if (!$singlereturn_partc_id || $singlereturn_partc_id == NULL) {
                $singlereturn_partc_id = $this->utility_model->insert_data('singlereturn_partc', $single_return_partc_data);
            } else {
                $single_return_partc_data['updated_by'] = $user_id;
                $single_return_partc_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_partc_id', $singlereturn_partc_id, 'singlereturn_partc', $single_return_partc_data);
            }
            $new_singlereturn_partd_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partd');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_partc_id);
            $new_singlereturn_partd_data['singlereturn_id'] = $singlereturn_id;
            $new_singlereturn_partd_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['singlereturn_partd_data'] = $new_singlereturn_partd_data;
            //$success_array['message'] = FACTORY_LICENSE_SAVED_MESSAGE;
            //$success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return_partc() {
        $single_return_partc_data = array();
        $single_return_partc_data['singlereturn_id'] = get_from_post('singlereturn_id');
        $single_return_partc_data['contractor_name'] = get_from_post('contractor_name');
        $single_return_partc_data['contractor_address'] = get_from_post('contractor_address');
        $single_return_partc_data['contractor_nature'] = get_from_post('contractor_nature');
        $single_return_partc_data['total_employed_labour'] = get_from_post('total_employed_labour');
        $single_return_partc_data['total_worked_days_by_labour'] = get_from_post('total_worked_days_by_labour');
        $single_return_partc_data['total_employed_direct_labour'] = get_from_post('total_employed_direct_labour');
        $single_return_partc_data['total_worked_days_by_direct_labour'] = get_from_post('total_worked_days_by_direct_labour');
        $single_return_partc_data['change_management_details'] = get_from_post('change_management_details');

        $single_return_partc_data['duration_of_contract'] = get_from_post('duration_of_contract');
        $single_return_partc_data['no_of_contract_labour'] = get_from_post('no_of_contract_labour');
        $single_return_partc_data['working_hours'] = get_from_post('working_hours');
        $single_return_partc_data['overtime_work'] = get_from_post('overtime_work');
        $single_return_partc_data['weekly_holiday'] = get_from_post('weekly_holiday');
        $single_return_partc_data['spread_over'] = get_from_post('spread_over');
        $single_return_partc_data['male_worked_days'] = get_from_post('male_worked_days');
        $single_return_partc_data['female_worked_days'] = get_from_post('female_worked_days');
        $single_return_partc_data['total_worked_days'] = get_from_post('total_worked_days');
        $single_return_partc_data['paid_amount'] = get_from_post('paid_amount');
        $single_return_partc_data['amount_deduction'] = get_from_post('amount_deduction');
        $single_return_partc_data['is_paid_weekly_holiday'] = get_from_post('is_paid_weekly_holiday');
        $single_return_partc_data['is_provide_canteen'] = get_from_post('is_provide_canteen');
        $single_return_partc_data['is_provide_restroom'] = get_from_post('is_provide_restroom');
        $single_return_partc_data['is_provide_drinking_water'] = get_from_post('is_provide_drinking_water');
        $single_return_partc_data['is_provide_creches'] = get_from_post('is_provide_creches');
        $single_return_partc_data['is_provide_firstaid'] = get_from_post('is_provide_firstaid');

        return $single_return_partc_data;
    }

    function _check_validation_for_single_return_partc($single_return_partc_data) {
        if (!$single_return_partc_data['contractor_name']) {
            return CONTRACTOR_NAME_MESSAGE;
        }
        if (!$single_return_partc_data['contractor_address']) {
            return CONTRACTOR_ADDRESS_MESSAGE;
        }
        if (!$single_return_partc_data['contractor_nature']) {
            return CONTRACTOR_NATURE_MESSAGE;
        }
        if (!$single_return_partc_data['total_employed_labour']) {
            return EMPLOYED_LABOUR_MESSAGE;
        }
        if (!$single_return_partc_data['total_worked_days_by_labour']) {
            return LABOUR_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_partc_data['total_employed_direct_labour']) {
            return EMPLOYED_DIRECT_LABOUR_MESSAGE;
        }
        if (!$single_return_partc_data['total_worked_days_by_direct_labour']) {
            return DIRECT_LABOUR_WORKED_DAYS_MESSAGE;
        }
        // if (!$single_return_partc_data['change_management_details']) {
        //     return CHNAGE_MANAGEMENT_DETAILS_MESSAGE;
        // }

        if (!$single_return_partc_data['duration_of_contract']) {
            return CONTRACT_DURATION_MESSAGE;
        }
        if (!$single_return_partc_data['no_of_contract_labour']) {
            return CONTRACT_LABOUR_MESSAGE;
        }
        if (!$single_return_partc_data['working_hours']) {
            return WORK_HOURS_MESSAGE;
        }
        if (!$single_return_partc_data['overtime_work']) {
            return OVERTIME_WORK_DAYS_MESSAGE;
        }
        if (!$single_return_partc_data['weekly_holiday']) {
            return WEEKLY_HOLIDAY_MESSAGE;
        }
        if (!$single_return_partc_data['spread_over']) {
            return SPREAD_OVER_MESSAGE;
        }
        if (!$single_return_partc_data['male_worked_days']) {
            return MALE_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_partc_data['female_worked_days']) {
            return FEMALE_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_partc_data['total_worked_days']) {
            return TOTAL_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_partc_data['paid_amount']) {
            return PAID_AMOUNT_MESSAGE;
        }
        if (!$single_return_partc_data['amount_deduction']) {
            return AMOUNT_DEDUCTION_MESSAGE;
        }

        return '';
    }

    function submit_single_return_partd() {
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
            $singlereturn_partd_id = get_from_post('singlereturn_partd_id');
            $single_return_partd_data = $this->_get_post_data_for_single_return_partd();
            $validation_message = $this->_check_validation_for_single_return_partd($single_return_partd_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $dangerousData = $this->input->post('dangerous_data');
            $dangerous_decode_Data = json_decode($dangerousData, true);
            if ($dangerousData == "" || empty($dangerous_decode_Data)) {
                echo json_encode(get_error_array('Enter Dangerous Process'));
                return false;
            }

            $hazardousData = $this->input->post('hazardous_data');
            $hazardous_decode_Data = json_decode($hazardousData, true);
            if ($hazardousData == "" || empty($hazardous_decode_Data)) {
                echo json_encode(get_error_array('Enter Hazardous Process'));
                return false;
            }


            $this->db->trans_start();
            //$single_return_partd_data['status'] = $module_type;
            $single_return_partd_data['dangerous_process_info'] = $dangerousData;
            $single_return_partd_data['hazardous_process_info'] = $hazardousData;
            $single_return_partd_data['plan_approval_date'] = convert_to_mysql_date_format($single_return_partd_data['plan_approval_date']);
            $single_return_partd_data['certificate_obtain_on_date'] = convert_to_mysql_date_format($single_return_partd_data['certificate_obtain_on_date']);
            $single_return_partd_data['certificate_submitted_on_date'] = convert_to_mysql_date_format($single_return_partd_data['certificate_submitted_on_date']);
            $single_return_partd_data['amended_date'] = convert_to_mysql_date_format($single_return_partd_data['amended_date']);
            $single_return_partd_data['rehearsals_date'] = convert_to_mysql_date_format($single_return_partd_data['rehearsals_date']);
            $singlereturn_id = $single_return_partd_data['singlereturn_id'];
            $single_return_partd_data['user_id'] = $user_id;
            $single_return_partd_data['created_by'] = $user_id;
            $single_return_partd_data['created_time'] = date('Y-m-d H:i:s');
            if (!$singlereturn_partd_id || $singlereturn_partd_id == NULL) {
                $singlereturn_partd_id = $this->utility_model->insert_data('singlereturn_partd', $single_return_partd_data);
            } else {
                $single_return_partd_data['updated_by'] = $user_id;
                $single_return_partd_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_partd_id', $singlereturn_partd_id, 'singlereturn_partd', $single_return_partd_data);
            }
            $new_singlereturn_parte_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_parte');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_partd_id);
            $new_singlereturn_parte_data['singlereturn_id'] = $singlereturn_id;
            $new_singlereturn_parte_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['singlereturn_parte_data'] = $new_singlereturn_parte_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return_partd() {
        $single_return_partd_data = array();
        $single_return_partd_data['singlereturn_id'] = get_from_post('singlereturn_id');
        $single_return_partd_data['fin'] = get_from_post('fin');
        $single_return_partd_data['nic_code'] = get_from_post('nic_code');
        $single_return_partd_data['sector'] = get_from_post('sector');
        $single_return_partd_data['registration_section'] = get_from_post('registration_section');
        $single_return_partd_data['registration_no'] = get_from_post('registration_no');
        $single_return_partd_data['license_no'] = get_from_post('license_no');
        $single_return_partd_data['license_workers'] = get_from_post('license_workers');
        $single_return_partd_data['license_hp'] = get_from_post('license_hp');
        $single_return_partd_data['license_renewal_year'] = get_from_post('license_renewal_year');
        $single_return_partd_data['license_submitted_year'] = get_from_post('license_submitted_year');
        $single_return_partd_data['plan_approval_no'] = get_from_post('plan_approval_no');
        $single_return_partd_data['plan_approval_date'] = get_from_post('plan_approval_date');
        $single_return_partd_data['certificate_obtain_on_date'] = get_from_post('certificate_obtain_on_date');
        $single_return_partd_data['certificate_submitted_on_date'] = get_from_post('certificate_submitted_on_date');
        $single_return_partd_data['finished_product'] = get_from_post('finished_product');
        $single_return_partd_data['intermediates'] = get_from_post('intermediates');
        $single_return_partd_data['raw_materials'] = get_from_post('raw_materials');
        $single_return_partd_data['male_average_workers'] = get_from_post('male_average_workers');
        $single_return_partd_data['female_average_workers'] = get_from_post('female_average_workers');
        $single_return_partd_data['factory_worked_days'] = get_from_post('factory_worked_days');
        $single_return_partd_data['adult_men_worked_days'] = get_from_post('adult_men_worked_days');
        $single_return_partd_data['adult_women_worked_days'] = get_from_post('adult_women_worked_days');
        $single_return_partd_data['adult_total_worked_days'] = get_from_post('adult_total_worked_days');
        $single_return_partd_data['adolescent_men_worked_days'] = get_from_post('adolescent_men_worked_days');
        $single_return_partd_data['adolescent_women_worked_days'] = get_from_post('adolescent_women_worked_days');
        $single_return_partd_data['adolescent_total_worked_days'] = get_from_post('adolescent_total_worked_days');
        $single_return_partd_data['adult_men_workers_employed'] = get_from_post('adult_men_workers_employed');
        $single_return_partd_data['adult_women_workers_employed'] = get_from_post('adult_women_workers_employed');
        $single_return_partd_data['adult_total_workers_employed'] = get_from_post('adult_total_workers_employed');
        $single_return_partd_data['adolescent_men_workers_employed'] = get_from_post('adolescent_men_workers_employed');
        $single_return_partd_data['adolescent_women_workers_employed'] = get_from_post('adolescent_women_workers_employed');
        $single_return_partd_data['adolescent_total_workers_employed'] = get_from_post('adolescent_total_workers_employed');
        $single_return_partd_data['adult_men_work_hours'] = get_from_post('adult_men_work_hours');
        $single_return_partd_data['adult_women_work_hours'] = get_from_post('adult_women_work_hours');
        $single_return_partd_data['adult_total_work_hours'] = get_from_post('adult_total_work_hours');
        $single_return_partd_data['adolescent_men_work_hours'] = get_from_post('adolescent_men_work_hours');
        $single_return_partd_data['adolescent_women_work_hours'] = get_from_post('adolescent_women_work_hours');
        $single_return_partd_data['adolescent_total_work_hours'] = get_from_post('adolescent_total_work_hours');
        $single_return_partd_data['is_dust_generated'] = get_from_post('is_dust_generated');
        $single_return_partd_data['is_provide_drinking_water'] = get_from_post('is_provide_drinking_water');
        $single_return_partd_data['is_provide_washroom'] = get_from_post('is_provide_washroom');
        $single_return_partd_data['washroom_for_men'] = get_from_post('washroom_for_men');
        $single_return_partd_data['washroom_for_women'] = get_from_post('washroom_for_women');
        $single_return_partd_data['is_health_record_maintain'] = get_from_post('is_health_record_maintain');
        $single_return_partd_data['is_provide_health_center'] = get_from_post('is_provide_health_center');
        $single_return_partd_data['is_provide_medical_officer'] = get_from_post('is_provide_medical_officer');
        $single_return_partd_data['retainer_ship'] = get_from_post('retainer_ship');
        $single_return_partd_data['no_of_hyginists_employed'] = get_from_post('no_of_hyginists_employed');
        $single_return_partd_data['safety_provision'] = get_from_post('safety_provision');
        $single_return_partd_data['is_provide_safe_access'] = get_from_post('is_provide_safe_access');
        $single_return_partd_data['is_provide_fire_exits'] = get_from_post('is_provide_fire_exits');
        $single_return_partd_data['fighting_equipments_details'] = get_from_post('fighting_equipments_details');
        $single_return_partd_data['is_devices_certified'] = get_from_post('is_devices_certified');
        $single_return_partd_data['is_pressure_vessels_certified'] = get_from_post('is_pressure_vessels_certified');
        $single_return_partd_data['personal_equipments_details'] = get_from_post('personal_equipments_details');
        $single_return_partd_data['safety_officers_detail'] = get_from_post('safety_officers_detail');
        $single_return_partd_data['is_functioning_safety_committee'] = get_from_post('is_functioning_safety_committee');
        $single_return_partd_data['is_provision_of_chapteriva'] = get_from_post('is_provision_of_chapteriva');
        $single_return_partd_data['no_of_safety_programs'] = get_from_post('no_of_safety_programs');
        $single_return_partd_data['no_of_worker_trained'] = get_from_post('no_of_worker_trained');
        $single_return_partd_data['amended_date'] = get_from_post('amended_date');
        $single_return_partd_data['rehearsals_date'] = get_from_post('rehearsals_date');
        $single_return_partd_data['safety_policy_detail'] = get_from_post('safety_policy_detail');
        $single_return_partd_data['is_action_taken'] = get_from_post('is_action_taken');
        $single_return_partd_data['is_firstaid_provide'] = get_from_post('is_firstaid_provide');
        $single_return_partd_data['is_ambulance_room_provide'] = get_from_post('is_ambulance_room_provide');
        $single_return_partd_data['is_provide_canteen'] = get_from_post('is_provide_canteen');
        $single_return_partd_data['canteen_managed_by'] = get_from_post('canteen_managed_by');
        $single_return_partd_data['is_provide_rest_room'] = get_from_post('is_provide_rest_room');
        $single_return_partd_data['is_provide_creche'] = get_from_post('is_provide_creche');
        $single_return_partd_data['is_welfare_officer_apponyed'] = get_from_post('is_welfare_officer_apponyed');
        $single_return_partd_data['working_hours_for_adults'] = get_from_post('working_hours_for_adults');
        $single_return_partd_data['is_disply_period_of_work'] = get_from_post('is_disply_period_of_work');
        $single_return_partd_data['working_hours_for_women'] = get_from_post('working_hours_for_women');
        $single_return_partd_data['is_obtain_fitness_certificate'] = get_from_post('is_obtain_fitness_certificate');
        $single_return_partd_data['is_leave_with_wages'] = get_from_post('is_leave_with_wages');
        $single_return_partd_data['no_of_worker_dismissed'] = get_from_post('no_of_worker_dismissed');
        $single_return_partd_data['no_of_paid_leave_worker'] = get_from_post('no_of_paid_leave_worker');

        $single_return_partd_data['adult_men_workers_employed_year'] = get_from_post('adult_men_workers_employed_year');
        $single_return_partd_data['adult_women_workers_employed_year'] = get_from_post('adult_women_workers_employed_year');
        $single_return_partd_data['adult_total_workers_employed_year'] = get_from_post('adult_total_workers_employed_year');
        $single_return_partd_data['adolescent_men_workers_employed_year'] = get_from_post('adolescent_men_workers_employed_year');
        $single_return_partd_data['adolescent_women_workers_employed_year'] = get_from_post('adolescent_women_workers_employed_year');
        $single_return_partd_data['adolescent_total_workers_employed_year'] = get_from_post('adolescent_total_workers_employed_year');
        $single_return_partd_data['adult_men_leave_with_wages'] = get_from_post('adult_men_leave_with_wages');
        $single_return_partd_data['adult_women_leave_with_wages'] = get_from_post('adult_women_leave_with_wages');
        $single_return_partd_data['adult_total_leave_with_wages'] = get_from_post('adult_total_leave_with_wages');
        $single_return_partd_data['adolescent_men_leave_with_wages'] = get_from_post('adolescent_men_leave_with_wages');
        $single_return_partd_data['adolescent_women_leave_with_wages'] = get_from_post('adolescent_women_leave_with_wages');
        $single_return_partd_data['adolescent_total_leave_with_wages'] = get_from_post('adolescent_total_leave_with_wages');
        $single_return_partd_data['adult_men_annual_leave_with_wages'] = get_from_post('adult_men_annual_leave_with_wages');
        $single_return_partd_data['adult_women_annual_leave_with_wages'] = get_from_post('adult_women_annual_leave_with_wages');
        $single_return_partd_data['adult_total_annual_leave_with_wages'] = get_from_post('adult_total_annual_leave_with_wages');
        $single_return_partd_data['adolescent_men_annual_leave_with_wages'] = get_from_post('adolescent_men_annual_leave_with_wages');
        $single_return_partd_data['adolescent_women_annual_leave_with_wages'] = get_from_post('adolescent_women_annual_leave_with_wages');
        $single_return_partd_data['adolescent_total_annual_leave_with_wages'] = get_from_post('adolescent_total_annual_leave_with_wages');
        $single_return_partd_data['is_report_accident'] = get_from_post('is_report_accident');

        $single_return_partd_data['fatal_dangerous_major_accidents'] = get_from_post('fatal_dangerous_major_accidents');
        $single_return_partd_data['nonfatal_dangerous_major_accidents'] = get_from_post('nonfatal_dangerous_major_accidents');
        $single_return_partd_data['nonfatal_dangerous_major_accidents_inside'] = get_from_post('nonfatal_dangerous_major_accidents_inside');
        $single_return_partd_data['nonfatal_dangerous_major_accidents_outside'] = get_from_post('nonfatal_dangerous_major_accidents_outside');
        $single_return_partd_data['fatal_dangerous_major_accidents'] = get_from_post('fatal_dangerous_major_accidents');
        $single_return_partd_data['fatal_dangerous_major_accidents_inside'] = get_from_post('fatal_dangerous_major_accidents_inside');
        $single_return_partd_data['fatal_dangerous_major_accidents_outside'] = get_from_post('fatal_dangerous_major_accidents_outside');
        $single_return_partd_data['fatal_dangerous_major_accidents_killed_inside'] = get_from_post('fatal_dangerous_major_accidents_killed_inside');
        $single_return_partd_data['fatal_dangerous_major_accidents_killed_outside'] = get_from_post('fatal_dangerous_major_accidents_killed_outside');
        $single_return_partd_data['fatal_nondangerous_accidents'] = get_from_post('fatal_nondangerous_accidents');
        $single_return_partd_data['nonfatal_nondangerous_accidents'] = get_from_post('nonfatal_nondangerous_accidents');
        $single_return_partd_data['nonfatal_nondangerous_accidents_inside'] = get_from_post('nonfatal_nondangerous_accidents_inside');
        $single_return_partd_data['nonfatal_nondangerous_accidents_outside'] = get_from_post('nonfatal_nondangerous_accidents_outside');
        $single_return_partd_data['fatal_nondangerous_accidents'] = get_from_post('fatal_nondangerous_accidents');
        $single_return_partd_data['fatal_nondangerous_accidents_inside'] = get_from_post('fatal_nondangerous_accidents_inside');
        $single_return_partd_data['fatal_nondangerous_accidents_outside'] = get_from_post('fatal_nondangerous_accidents_outside');
        $single_return_partd_data['fatal_nondangerous_accidents_killed_inside'] = get_from_post('fatal_nondangerous_accidents_killed_inside');
        $single_return_partd_data['fatal_nondangerous_accidents_killed_outside'] = get_from_post('fatal_nondangerous_accidents_killed_outside');
        $single_return_partd_data['fatal_dangerous_accidents'] = get_from_post('fatal_dangerous_accidents');
        $single_return_partd_data['nonfatal_dangerous_accidents'] = get_from_post('nonfatal_dangerous_accidents');
        $single_return_partd_data['nonfatal_dangerous_accidents_inside'] = get_from_post('nonfatal_dangerous_accidents_inside');
        $single_return_partd_data['nonfatal_dangerous_accidents_outside'] = get_from_post('nonfatal_dangerous_accidents_outside');
        $single_return_partd_data['fatal_dangerous_accidents'] = get_from_post('fatal_dangerous_accidents');
        $single_return_partd_data['fatal_dangerous_accidents_inside'] = get_from_post('fatal_dangerous_accidents_inside');
        $single_return_partd_data['fatal_dangerous_accidents_outside'] = get_from_post('fatal_dangerous_accidents_outside');
        $single_return_partd_data['fatal_dangerous_accidents_killed_inside'] = get_from_post('fatal_dangerous_accidents_killed_inside');
        $single_return_partd_data['fatal_dangerous_accidents_killed_outside'] = get_from_post('fatal_dangerous_accidents_killed_outside');
        $single_return_partd_data['fatal_major_accidents'] = get_from_post('fatal_major_accidents');
        $single_return_partd_data['nonfatal_major_accidents'] = get_from_post('nonfatal_major_accidents');
        $single_return_partd_data['nonfatal_major_accidents_inside'] = get_from_post('nonfatal_major_accidents_inside');
        $single_return_partd_data['nonfatal_major_accidents_outside'] = get_from_post('nonfatal_major_accidents_outside');
        $single_return_partd_data['fatal_major_accidents'] = get_from_post('fatal_major_accidents');
        $single_return_partd_data['fatal_major_accidents_inside'] = get_from_post('fatal_major_accidents_inside');
        $single_return_partd_data['fatal_major_accidents_outside'] = get_from_post('fatal_major_accidents_outside');
        $single_return_partd_data['fatal_major_accidents_killed_inside'] = get_from_post('fatal_major_accidents_killed_inside');
        $single_return_partd_data['fatal_major_accidents_killed_outside'] = get_from_post('fatal_major_accidents_killed_outside');
        $single_return_partd_data['fatal_nonmajor_accidents'] = get_from_post('fatal_nonmajor_accidents');
        $single_return_partd_data['nonfatal_nonmajor_accidents'] = get_from_post('nonfatal_nonmajor_accidents');
        $single_return_partd_data['nonfatal_nonmajor_accidents_inside'] = get_from_post('nonfatal_nonmajor_accidents_inside');
        $single_return_partd_data['nonfatal_nonmajor_accidents_outside'] = get_from_post('nonfatal_nonmajor_accidents_outside');
        $single_return_partd_data['fatal_nonmajor_accidents'] = get_from_post('fatal_nonmajor_accidents');
        $single_return_partd_data['fatal_nonmajor_accidents_inside'] = get_from_post('fatal_nonmajor_accidents_inside');
        $single_return_partd_data['fatal_nonmajor_accidents_outside'] = get_from_post('fatal_nonmajor_accidents_outside');
        $single_return_partd_data['fatal_nonmajor_accidents_killed_inside'] = get_from_post('fatal_nonmajor_accidents_killed_inside');
        $single_return_partd_data['fatal_nonmajor_accidents_killed_outside'] = get_from_post('fatal_nonmajor_accidents_killed_outside');

        $single_return_partd_data['hazardous_accidents'] = get_from_post('hazardous_accidents');
        $single_return_partd_data['hazardous_fatal_injured'] = get_from_post('hazardous_fatal_injured');
        $single_return_partd_data['hazardous_nonfatal_injured'] = get_from_post('hazardous_nonfatal_injured');
        $single_return_partd_data['dangerous_accidents'] = get_from_post('dangerous_accidents');
        $single_return_partd_data['dangerous_fatal_injured'] = get_from_post('dangerous_fatal_injured');
        $single_return_partd_data['dangerous_nonfatal_injured'] = get_from_post('dangerous_nonfatal_injured');
        $single_return_partd_data['other_accidents'] = get_from_post('other_accidents');
        $single_return_partd_data['other_fatal_injured'] = get_from_post('other_fatal_injured');
        $single_return_partd_data['other_nonfatal_injured'] = get_from_post('other_nonfatal_injured');
        $single_return_partd_data['no_of_non_fatal_injuries'] = get_from_post('no_of_non_fatal_injuries');
        $single_return_partd_data['no_of_non_fatal_lost_injuries'] = get_from_post('no_of_non_fatal_lost_injuries');
        $single_return_partd_data['no_of_return_non_fatal_injuries'] = get_from_post('no_of_return_non_fatal_injuries');
        $single_return_partd_data['no_of_return_non_fatal_lost_injuries'] = get_from_post('no_of_return_non_fatal_lost_injuries');

        return $single_return_partd_data;
    }

    function _check_validation_for_single_return_partd($single_return_partd_data) {
        if (!$single_return_partd_data['fin']) {
            return FIN_MESSAGE;
        }
        if (!$single_return_partd_data['nic_code']) {
            return NIC_CODE_MESSAGE;
        }
        if (!$single_return_partd_data['sector']) {
            return SECTOR_MESSAGE;
        }
        if (!$single_return_partd_data['registration_section']) {
            return REGISTRATION_SECTION_MESSAGE;
        }
        if (!$single_return_partd_data['registration_no']) {
            return FACTORY_REGISTRATION_NUMBER_MESSAGE;
        }
        if (!$single_return_partd_data['license_no']) {
            return LICENSE_NUMNER_MESSAGE;
        }
        if (!$single_return_partd_data['license_workers']) {
            return LICENSE_WORKER_MESSAGE;
        }
        if (!$single_return_partd_data['license_hp']) {
            return LICENSE_HP_MESSAGE;
        }
        if (!$single_return_partd_data['license_renewal_year']) {
            return LICENSE_RENEWAL_YEAR_MESSAGE;
        }
        if (!$single_return_partd_data['license_submitted_year']) {
            return LICENSE_SUBMIT_YEAR_MESSAGE;
        }
        if (!$single_return_partd_data['plan_approval_no']) {
            return PLAN_APPROVAL_NUMBER_MESSAGE;
        }
        if (!$single_return_partd_data['plan_approval_date']) {
            return PLAN_APPROVAL_DATE_MESSAGE;
        }
        if (!$single_return_partd_data['certificate_obtain_on_date']) {
            return CERTIFICATE_OBTAIN_DATE_MESSAGE;
        }
        if (!$single_return_partd_data['certificate_submitted_on_date']) {
            return CERTIFICATE_SUBMIT_DATE_MESSAGE;
        }
        if (!$single_return_partd_data['finished_product']) {
            return FINISHED_PRODUCT_MESSAGE;
        }
        if (!$single_return_partd_data['intermediates']) {
            return INTERMEDIATES_MESSAGE;
        }
        if (!$single_return_partd_data['raw_materials']) {
            return RAW_MATERIAL_MESSAGE;
        }
        if (!$single_return_partd_data['male_average_workers']) {
            return MAL_AVERAGE_WORKERS_MESSAGE;
        }
        if (!$single_return_partd_data['female_average_workers']) {
            return FEMALE_AVERAGE_WORKERS_MESSAGE;
        }
        if (!$single_return_partd_data['factory_worked_days']) {
            return FACTORY_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_partd_data['adult_men_worked_days']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_women_worked_days']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_total_worked_days']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_men_worked_days']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_women_worked_days']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_total_worked_days']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adult_men_workers_employed']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_women_workers_employed']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_total_workers_employed']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_men_workers_employed']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_women_workers_employed']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_total_workers_employed']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adult_men_work_hours']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_women_work_hours']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_total_work_hours']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_men_work_hours']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_women_work_hours']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_total_work_hours']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_hyginists_employed']) {
            return HYGINISTS_EMPLOYED_MESSAGE;
        }
        if (!$single_return_partd_data['safety_provision']) {
            return SAFETY_PROVISION_MESSAGE;
        }
        if (!$single_return_partd_data['fighting_equipments_details']) {
            return FIGHTING_EQUIPMENTS_MESSAGE;
        }
        // if (!$single_return_partd_data['personal_equipments_details']) {
        //     return PERSONAL_EQUPMENTS_MESSAGE;
        // }
        if (!$single_return_partd_data['safety_officers_detail']) {
            return SAFETY_OFFICER_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_safety_programs']) {
            return SAFETY_PROGRAMS_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_worker_trained']) {
            return WORKER_TRAINED_MESSAGE;
        }
        if (!$single_return_partd_data['amended_date']) {
            return AMENDED_DATE_MESSAGE;
        }
        if (!$single_return_partd_data['rehearsals_date']) {
            return REHEARSAL_DATE_MESSAGE;
        }
        // if (!$single_return_partd_data['safety_policy_detail']) {
        //     return SAFETY_POLICY_MESSAGE;
        // }
        if (!$single_return_partd_data['canteen_managed_by']) {
            return CANTEEN_MANAGED_BY_MESSAGE;
        }
        if (!$single_return_partd_data['working_hours_for_adults']) {
            return WORKING_HOURS_MESSAGE;
        }
        if (!$single_return_partd_data['working_hours_for_women']) {
            return WORKING_HOURS_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_worker_dismissed']) {
            return WORKER_DISMISSED_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_paid_leave_worker']) {
            return PAID_LEAVE_WORKER_MESSAGE;
        }
        if (!$single_return_partd_data['adult_men_workers_employed_year']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_women_workers_employed_year']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_total_workers_employed_year']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_men_workers_employed_year']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_women_workers_employed_year']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_total_workers_employed_year']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adult_men_leave_with_wages']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_women_leave_with_wages']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_total_leave_with_wages']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_men_leave_with_wages']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_women_leave_with_wages']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_total_leave_with_wages']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adult_men_annual_leave_with_wages']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_women_annual_leave_with_wages']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adult_total_annual_leave_with_wages']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_men_annual_leave_with_wages']) {
            return ADULT_MEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_women_annual_leave_with_wages']) {
            return ADULT_WOMEN_MESSAGE;
        }
        if (!$single_return_partd_data['adolescent_total_annual_leave_with_wages']) {
            return ADULT_TOTAL_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_dangerous_major_accidents'] && $single_return_partd_data['nonfatal_dangerous_major_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_dangerous_major_accidents_inside'] && $single_return_partd_data['nonfatal_dangerous_major_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_dangerous_major_accidents_outside'] && $single_return_partd_data['nonfatal_dangerous_major_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_major_accidents'] && $single_return_partd_data['fatal_dangerous_major_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_major_accidents_inside'] && $single_return_partd_data['fatal_dangerous_major_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_major_accidents_outside'] && $single_return_partd_data['fatal_dangerous_major_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_major_accidents_killed_inside'] && $single_return_partd_data['fatal_dangerous_major_accidents_killed_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_major_accidents_killed_outside'] && $single_return_partd_data['fatal_dangerous_major_accidents_killed_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_nondangerous_accidents'] && $single_return_partd_data['nonfatal_nondangerous_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_nondangerous_accidents_inside'] && $single_return_partd_data['nonfatal_nondangerous_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_nondangerous_accidents_outside'] && $single_return_partd_data['nonfatal_nondangerous_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nondangerous_accidents'] && $single_return_partd_data['fatal_nondangerous_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nondangerous_accidents_inside'] && $single_return_partd_data['fatal_nondangerous_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nondangerous_accidents_outside'] && $single_return_partd_data['fatal_nondangerous_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nondangerous_accidents_killed_inside'] && $single_return_partd_data['fatal_nondangerous_accidents_killed_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nondangerous_accidents_killed_outside'] && $single_return_partd_data['fatal_nondangerous_accidents_killed_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_dangerous_accidents'] && $single_return_partd_data['nonfatal_dangerous_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_dangerous_accidents_inside'] && $single_return_partd_data['nonfatal_dangerous_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_dangerous_accidents_outside'] && $single_return_partd_data['nonfatal_dangerous_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_accidents'] && $single_return_partd_data['fatal_dangerous_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_accidents_inside'] && $single_return_partd_data['fatal_dangerous_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_accidents_outside'] && $single_return_partd_data['fatal_dangerous_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_accidents_killed_inside'] && $single_return_partd_data['fatal_dangerous_accidents_killed_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_dangerous_accidents_killed_outside'] && $single_return_partd_data['fatal_dangerous_accidents_killed_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_major_accidents'] && $single_return_partd_data['nonfatal_major_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_major_accidents_inside'] && $single_return_partd_data['nonfatal_major_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_major_accidents_outside'] && $single_return_partd_data['nonfatal_major_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_major_accidents'] && $single_return_partd_data['fatal_major_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_major_accidents_inside'] && $single_return_partd_data['fatal_major_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_major_accidents_outside'] && $single_return_partd_data['fatal_major_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_major_accidents_killed_inside'] && $single_return_partd_data['fatal_major_accidents_killed_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_major_accidents_killed_outside'] && $single_return_partd_data['fatal_major_accidents_killed_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_nonmajor_accidents'] && $single_return_partd_data['nonfatal_nonmajor_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_nonmajor_accidents_inside'] && $single_return_partd_data['nonfatal_nonmajor_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['nonfatal_nonmajor_accidents_outside'] && $single_return_partd_data['nonfatal_nonmajor_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nonmajor_accidents'] && $single_return_partd_data['fatal_nonmajor_accidents'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nonmajor_accidents_inside'] && $single_return_partd_data['fatal_nonmajor_accidents_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nonmajor_accidents_outside'] && $single_return_partd_data['fatal_nonmajor_accidents_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nonmajor_accidents_killed_inside'] && $single_return_partd_data['fatal_nonmajor_accidents_killed_inside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['fatal_nonmajor_accidents_killed_outside'] && $single_return_partd_data['fatal_nonmajor_accidents_killed_outside'] != 0) {
            return ACCIDENTS_OCCURRENCES_MESSAGE;
        }
        if (!$single_return_partd_data['hazardous_accidents'] && $single_return_partd_data['hazardous_accidents'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['hazardous_fatal_injured'] && $single_return_partd_data['hazardous_fatal_injured'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['hazardous_nonfatal_injured'] && $single_return_partd_data['hazardous_nonfatal_injured'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['dangerous_accidents'] && $single_return_partd_data['dangerous_accidents'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['dangerous_fatal_injured'] && $single_return_partd_data['dangerous_fatal_injured'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['dangerous_nonfatal_injured'] && $single_return_partd_data['dangerous_nonfatal_injured'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['other_accidents'] && $single_return_partd_data['other_accidents'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['other_fatal_injured'] && $single_return_partd_data['other_fatal_injured'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['other_nonfatal_injured'] && $single_return_partd_data['other_nonfatal_injured'] != 0) {
            return INJURIES_OCCURING_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_non_fatal_injuries']) {
            return FATAL_INJURIES_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_non_fatal_lost_injuries']) {
            return NONFATAL_INJURIES_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_return_non_fatal_injuries']) {
            return RETURN_FATAL_INJURIES_MESSAGE;
        }
        if (!$single_return_partd_data['no_of_return_non_fatal_lost_injuries']) {
            return RETURN_NONFATAL_INJURIES_MESSAGE;
        }
        if ($single_return_partd_data['is_provide_washroom'] == IS_CHECKED_YES) {
            if (!$single_return_partd_data['washroom_for_men']) {
                return NO_OF_WASHROOM_MESSAGE;
            }
            if (!$single_return_partd_data['washroom_for_women']) {
                return NO_OF_WASHROOM_MESSAGE;
            }
        }
        if ($single_return_partd_data['is_provide_medical_officer'] == IS_CHECKED_YES) {
            if (!$single_return_partd_data['retainer_ship']) {
                return RETAINER_SHIP_MESSAGE;
            }
        }
        return '';
    }

    function submit_single_return_parte() {
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
            $singlereturn_parte_id = get_from_post('singlereturn_parte_id');
            $single_return_parte_data = $this->_get_post_data_for_single_return_parte();
            $validation_message = $this->_check_validation_for_single_return_parte($single_return_parte_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();
            //$single_return_parte_data['status'] = $module_type;
            $singlereturn_id = $single_return_parte_data['singlereturn_id'];
            $single_return_parte_data['user_id'] = $user_id;
            $single_return_parte_data['created_by'] = $user_id;
            $single_return_parte_data['created_time'] = date('Y-m-d H:i:s');
            if (!$singlereturn_parte_id || $singlereturn_parte_id == NULL) {
                $singlereturn_parte_id = $this->utility_model->insert_data('singlereturn_parte', $single_return_parte_data);
            } else {
                $single_return_parte_data['updated_by'] = $user_id;
                $single_return_parte_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_parte_id', $singlereturn_parte_id, 'singlereturn_parte', $single_return_parte_data);
            }
            $new_singlereturn_partf_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partf');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_parte_id);
            $new_singlereturn_partf_data['singlereturn_id'] = $singlereturn_id;
            $new_singlereturn_partf_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['singlereturn_partf_data'] = $new_singlereturn_partf_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return_parte() {
        $single_return_parte_data = array();
        $single_return_parte_data['singlereturn_id'] = get_from_post('singlereturn_id');
        $single_return_parte_data['respect_of_fines'] = get_from_post('respect_of_fines');
        $single_return_parte_data['adult_worked_days'] = get_from_post('adult_worked_days');
        $single_return_parte_data['young_person_worked_days'] = get_from_post('young_person_worked_days');
        $single_return_parte_data['adult_workers_employed'] = get_from_post('adult_workers_employed');
        $single_return_parte_data['young_peson_workers_employed'] = get_from_post('young_peson_workers_employed');
        $single_return_parte_data['basic_wages'] = get_from_post('basic_wages');
        $single_return_parte_data['dearness_allowances'] = get_from_post('dearness_allowances');
        $single_return_parte_data['composite_wages'] = get_from_post('composite_wages');
        $single_return_parte_data['overtime_wages'] = get_from_post('overtime_wages');
        $single_return_parte_data['nonprofit_bonus'] = get_from_post('nonprofit_bonus');
        $single_return_parte_data['other_bonus'] = get_from_post('other_bonus');
        $single_return_parte_data['other_amount'] = get_from_post('other_amount');
        $single_return_parte_data['arrears_of_pat'] = get_from_post('arrears_of_pat');
        $single_return_parte_data['total_wages'] = get_from_post('total_wages');
        $single_return_parte_data['year_total_wages'] = get_from_post('year_total_wages');
        $single_return_parte_data['year_paid_bonus'] = get_from_post('year_paid_bonus');
        $single_return_parte_data['commision_amount'] = get_from_post('commision_amount');
        $single_return_parte_data['realized_amount'] = get_from_post('realized_amount');
        return $single_return_parte_data;
    }

    function _check_validation_for_single_return_parte($single_return_parte_data) {
        if (!$single_return_parte_data['respect_of_fines']) {
            return RESPECT_OF_FINES_MESSAGE;
        }
        if (!$single_return_parte_data['adult_worked_days']) {
            return ADULT_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_parte_data['young_person_worked_days']) {
            return YOUNG_PERSON_WORKED_DAYS_MESSAGE;
        }
        if (!$single_return_parte_data['adult_workers_employed']) {
            return ADULTS_WORKERS_EMPLOYED_MESSAGE;
        }
        if (!$single_return_parte_data['young_peson_workers_employed']) {
            return YOUNG_PERSON_WORKERS_EMPLOYED_MESSAGE;
        }
        if (!$single_return_parte_data['basic_wages']) {
            return BASIC_WAGES_MESSAGE;
        }
        if (!$single_return_parte_data['dearness_allowances']) {
            return DEARNESS_ALLOWANCES_MESSAGE;
        }
        if (!$single_return_parte_data['composite_wages']) {
            return COMPOSITE_WAGES_MESSAGE;
        }
        if (!$single_return_parte_data['overtime_wages']) {
            return OVER_TIME_WAGES_MESSAGE;
        }
        if (!$single_return_parte_data['nonprofit_bonus']) {
            return NON_PROFIT_BONUS_MESSAGE;
        }
        if (!$single_return_parte_data['other_bonus']) {
            return OTHER_BONUS_MESSAGE;
        }
        if (!$single_return_parte_data['other_amount']) {
            return OTHER_AMOUNT_MESSAGE;
        }
        if (!$single_return_parte_data['arrears_of_pat']) {
            return ARREARS_OF_PAT_MESSAGE;
        }
        if (!$single_return_parte_data['total_wages']) {
            return TOTAL_WAGES_MESSAGE;
        }
        if (!$single_return_parte_data['year_total_wages']) {
            return YEAR_TOTAL_WAGES_MESSAGE;
        }
        if (!$single_return_parte_data['year_paid_bonus']) {
            return YEAR_PAID_BONUS_MESSAGE;
        }
        if (!$single_return_parte_data['commision_amount']) {
            return COMMISION_AMOUNT_MESSAGE;
        }
        if (!$single_return_parte_data['realized_amount']) {
            return REALIZED_AMOUNT_MESSAGE;
        }

        return '';
    }

    function submit_single_return_partf() {
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
            $singlereturn_partf_id = get_from_post('singlereturn_partf_id');
            $single_return_partf_data = $this->_get_post_data_for_single_return_partf();
            $validation_message = $this->_check_validation_for_single_return_partf($single_return_partf_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();
            //$single_return_partf_data['status'] = $module_type;
            $singlereturn_id = $single_return_partf_data['singlereturn_id'];
            $single_return_partf_data['user_id'] = $user_id;
            $single_return_partf_data['created_by'] = $user_id;
            $single_return_partf_data['created_time'] = date('Y-m-d H:i:s');
            if (!$singlereturn_partf_id || $singlereturn_partf_id == NULL) {
                $singlereturn_partf_id = $this->utility_model->insert_data('singlereturn_partf', $single_return_partf_data);
            } else {
                $single_return_partf_data['updated_by'] = $user_id;
                $single_return_partf_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_partf_id', $singlereturn_partf_id, 'singlereturn_partf', $single_return_partf_data);
            }
            $new_singlereturn_partg_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partg');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($singlereturn_partf_id);
            //$new_singlereturn_partg_data['singlereturn_partf_id'] = $success_array['encrypt_id'];
            $new_singlereturn_partg_data['singlereturn_id'] = $singlereturn_id;
            $new_singlereturn_partg_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['singlereturn_partg_data'] = $new_singlereturn_partg_data;
            //$success_array['message'] = FACTORY_LICENSE_SAVED_MESSAGE;
            //$success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return_partf() {
        $single_return_partf_data = array();
        $single_return_partf_data['singlereturn_id'] = get_from_post('singlereturn_id');
        $single_return_partf_data['no_of_female_workers'] = get_from_post('no_of_female_workers');
        $single_return_partf_data['no_of_maternity_women_workers'] = get_from_post('no_of_maternity_women_workers');
        $single_return_partf_data['medical_bonus_case'] = get_from_post('medical_bonus_case');
        $single_return_partf_data['miscarriage_leave_case'] = get_from_post('miscarriage_leave_case');
        $single_return_partf_data['additional_leave_case'] = get_from_post('additional_leave_case');
        $single_return_partf_data['maternity_benefit_amount'] = get_from_post('maternity_benefit_amount');
        $single_return_partf_data['is_nursing_breaks'] = get_from_post('is_nursing_breaks');
        $single_return_partf_data['is_dismissed_service'] = get_from_post('is_dismissed_service');
        $single_return_partf_data['no_of_dismissed_women'] = get_from_post('no_of_dismissed_women');
        $single_return_partf_data['dismissed_reason'] = get_from_post('dismissed_reason');
        return $single_return_partf_data;
    }

    function _check_validation_for_single_return_partf($single_return_partf_data) {
        if (!$single_return_partf_data['no_of_female_workers']) {
            return NO_OF_FEMALE_WORKERS_MESSAGE;
        }
        if (!$single_return_partf_data['no_of_maternity_women_workers']) {
            return NO_OF_MATERNITY_WOMEN_WORKERS_MESSAGE;
        }
        if (!$single_return_partf_data['medical_bonus_case']) {
            return MEDICAL_BONUS_MESSAGE;
        }
        if (!$single_return_partf_data['miscarriage_leave_case']) {
            return MISCARRIAGE_LEVEL_MESSAGE;
        }
        if (!$single_return_partf_data['additional_leave_case']) {
            return ADDITIONAL_LEAVE_MESSAGE;
        }
        if (!$single_return_partf_data['maternity_benefit_amount']) {
            return MATERNITY_BENEFIT_AMOUNT_MESSAGE;
        }
        return '';
    }

    function submit_single_return_partg() {
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
            $singlereturn_partg_id = get_from_post('singlereturn_partg_id');
            $single_return_partg_data = $this->_get_post_data_for_single_return_partg();
            $validation_message = $this->_check_validation_for_single_return_partg($single_return_partg_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();
            //$single_return_partg_data['status'] = $module_type;
            $singlereturn_id = $single_return_partg_data['singlereturn_id'];
            $single_return_partg_data['user_id'] = $user_id;
            $single_return_partg_data['created_by'] = $user_id;
            $single_return_partg_data['created_time'] = date('Y-m-d H:i:s');
            if (!$singlereturn_partg_id || $singlereturn_partg_id == NULL) {
                $singlereturn_partg_id = $this->utility_model->insert_data('singlereturn_partg', $single_return_partg_data);
            } else {
                $single_return_partg_data['updated_by'] = $user_id;
                $single_return_partg_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('singlereturn_partg_id', $singlereturn_partg_id, 'singlereturn_partg', $single_return_partg_data);
            }

            $single_return_status_update_data = array();
            $single_return_status_update_data['updated_by'] = $user_id;
            $single_return_status_update_data['updated_time'] = date('Y-m-d H:i:s');
            $single_return_status_update_data['status'] = $module_type;

            $this->utility_model->update_data('singlereturn_id', $singlereturn_id, 'singlereturn', $single_return_status_update_data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = FACTORY_LICENSE_SAVED_MESSAGE;
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_single_return_partg() {
        $single_return_partg_data = array();
        $single_return_partg_data['singlereturn_id'] = get_from_post('singlereturn_id');
        $single_return_partg_data['no_of_employed_workers'] = get_from_post('no_of_employed_workers');
        $single_return_partg_data['no_of_handicapped_employed'] = get_from_post('no_of_handicapped_employed');
        $single_return_partg_data['is_surgeon_obtain'] = get_from_post('is_surgeon_obtain');
        $single_return_partg_data['is_handicapped_recuited'] = get_from_post('is_handicapped_recuited');
        $single_return_partg_data['is_record_physically_handicapped'] = get_from_post('is_record_physically_handicapped');
        return $single_return_partg_data;
    }

    function _check_validation_for_single_return_partg($single_return_partg_data) {
        if (!$single_return_partg_data['no_of_employed_workers']) {
            return NO_OF_EMPLOYED_WORKERS_MESSAGE;
        }
        if (!$single_return_partg_data['no_of_handicapped_employed']) {
            return NO_OF_HANDICAPPED_EMPLOYED_MESSAGE;
        }
        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $singlereturn_id = get_from_post('singlereturn_id_for_singlereturn_form1');
            if (!is_post() || $user_id == null || !$user_id || $singlereturn_id == null || !$singlereturn_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_singlereturn_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn');
            $existing_singlereturn_parta_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_parta');
            $existing_singlereturn_partb_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partb');
            $existing_singlereturn_partc_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partc');
            $existing_singlereturn_partd_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partd');
            $existing_singlereturn_parte_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_parte');
            $existing_singlereturn_partf_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partf');
            $existing_singlereturn_partg_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn_partg');

            if (empty($existing_singlereturn_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array();
            $result = array_merge($existing_singlereturn_data, $existing_singlereturn_parta_data, $existing_singlereturn_partb_data, $existing_singlereturn_partc_data, $existing_singlereturn_partd_data, $existing_singlereturn_parte_data, $existing_singlereturn_partf_data, $existing_singlereturn_partg_data);
            $data = array('singlereturn_data' => $result);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('singlereturn/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_singlereturn_data_by_singlereturn_id() {
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $single_return_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn');
            if (empty($single_return_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYNINE, $singlereturn_id, $single_return_data);
            $single_return_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYNINE, 'fees_bifurcation', 'module_id', $singlereturn_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['single_return_data'] = $single_return_data;
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
            $singlereturn_id = get_from_post('singlereturn_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$singlereturn_id || $singlereturn_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'singlereturn' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('singlereturn_id', $singlereturn_id, 'singlereturn', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $singlereturn_id = get_from_post('single_return_id_for_single_return_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $singlereturn_id == NULL || !$singlereturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_single_return_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $single_return_data = array();
            if ($_FILES['fees_paid_challan_for_single_return_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'singlereturn';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_single_return_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_single_return_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $single_return_data['status'] = VALUE_FOUR;
                $single_return_data['fees_paid_challan'] = $filename;
                $single_return_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $single_return_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $single_return_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $single_return_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYNINE, $singlereturn_id, $ex_em_data['district'], $ex_em_data['total_fees'], $single_return_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $single_return_data['user_payment_type'] = $user_payment_type;
            } else {
                $single_return_data['user_payment_type'] = VALUE_ZERO;
            }
            $single_return_data['updated_by'] = $user_id;
            $single_return_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('singlereturn_id', $singlereturn_id, 'singlereturn', $single_return_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($single_return_data['status']) ? $single_return_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $single_return_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $single_return_data['user_payment_type'] == VALUE_THREE) {
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
            $singlereturn_id = get_from_post('singlereturn_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $singlereturn_id == null || !$singlereturn_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_singlereturn_data = $this->utility_model->get_by_id('singlereturn_id', $singlereturn_id, 'singlereturn');
            if (empty($existing_singlereturn_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_singlereturn_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_singlereturn($existing_singlereturn_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/BOCW.php
 */