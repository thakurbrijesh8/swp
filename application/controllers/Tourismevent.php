<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tourismevent extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_tourismevent_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['tourismevent_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['tourismevent_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'tourismevent', 'district', $search_district, 'tourismevent_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['tourismevent_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['tourismevent_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_tourismevent_data_by_id() {
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
            $tourismevent_id = get_from_post('tourismevent_id');
            if (!$tourismevent_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $tourismevent_data = $this->utility_model->get_by_id('tourismevent_id', $tourismevent_id, 'tourismevent');
            if (empty($tourismevent_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['tourismevent_data'] = $tourismevent_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_tourismevent() {
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
            $tourismevent_id = get_from_post('tourismevent_id');
            $tourismevent_data = $this->_get_post_data_for_tourismevent();
            $validation_message = $this->_check_validation_for_tourismevent($tourismevent_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $tourismevent_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $tourismevent_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$tourismevent_id || $tourismevent_id == NULL) {
                $tourismevent_data['user_id'] = $user_id;
                $tourismevent_data['created_by'] = $user_id;
                $tourismevent_data['created_time'] = date('Y-m-d H:i:s');
                $tourismevent_id = $this->utility_model->insert_data('tourismevent', $tourismevent_data);
            } else {
                $tourismevent_data['submitted_datetime'] = date('Y-m-d H:i:s');
                $tourismevent_data['updated_by'] = $user_id;
                $tourismevent_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('tourismevent_id', $tourismevent_id, 'tourismevent', $tourismevent_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYFOUR, $tourismevent_id);
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

    function _get_post_data_for_tourismevent() {
        $tourismevent_data = array();
        $tourismevent_data['district'] = get_from_post('district');
        $tourismevent_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $tourismevent_data['name_of_person'] = get_from_post('name_of_person');
        $tourismevent_data['name_of_event'] = get_from_post('name_of_event');
        $tourismevent_data['location_of_event'] = get_from_post('location_of_event');
        $tourismevent_data['date_of_event'] = convert_to_mysql_date_format(get_from_post('date_of_event'));
        $tourismevent_data['time_of_event'] = get_from_post('time_of_event');
        $tourismevent_data['duration_of_event'] = get_from_post('duration_of_event');
        $tourismevent_data['mob_no'] = get_from_post('mob_no');

        return $tourismevent_data;
    }

    function _check_validation_for_tourismevent($tourismevent_data) {
        if (!$tourismevent_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$tourismevent_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$tourismevent_data['name_of_person']) {
            return PERSON_NAME_MESSAGE;
        }
        if (!$tourismevent_data['name_of_event']) {
            return NAME_OF_EVENT_MESSAGE;
        }
        if (!$tourismevent_data['location_of_event']) {
            return LOCATION_OF_EVENT_MESSAGE;
        }
        if (!$tourismevent_data['date_of_event']) {
            return DATE_MESSAGE;
        }
        if (!$tourismevent_data['time_of_event']) {
            return TIME_OF_EVENT_MESSAGE;
        }
        if (!$tourismevent_data['duration_of_event']) {
            return DURATION_OF_MESSAGE;
        }
        if (!$tourismevent_data['mob_no']) {
            return MOBILE_NUMBER_MESSAGE;
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
            $tourismevent_id = get_from_post('tourismevent_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$tourismevent_id || $tourismevent_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('tourismevent_id', $tourismevent_id, 'tourismevent');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'tourismevent' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['proposal_details_document'];
            }

            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'tourismevent' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('tourismevent_id', $tourismevent_id, 'tourismevent', array('proposal_details_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('tourismevent_id', $tourismevent_id, 'tourismevent', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_form() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $tourismevent_id = get_from_post('tourismevent_id_for_tourismevent_form');
            if (!is_post() || $user_id == null || !$user_id || $tourismevent_id == null || !$tourismevent_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_tourismevent_data = $this->utility_model->get_by_id('tourismevent_id', $tourismevent_id, 'tourismevent');

            if (empty($existing_tourismevent_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('tourismevent_data' => $existing_tourismevent_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('tourismevent/pdf', $data, TRUE));
            $mpdf->Output('FORM.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_tourismevent_data_by_tourismevent_id() {
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
            $tourismevent_id = get_from_post('tourismevent_id');
            if (!$tourismevent_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $tourismevent_data = $this->utility_model->get_by_id('tourismevent_id', $tourismevent_id, 'tourismevent');
            if (empty($tourismevent_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['tourismevent_data'] = $tourismevent_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $tourismevent_id = get_from_post('tourismevent_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $tourismevent_id == null || !$tourismevent_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_tourismevent_data = $this->utility_model->get_by_id('tourismevent_id', $tourismevent_id, 'tourismevent');
            if (empty($existing_tourismevent_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_tourismevent_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_tourismevent($existing_tourismevent_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_tourismevent_document() {
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
            $tourismevent_id = get_from_post('tourismevent_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $tourismevent_data = $this->utility_model->upload_document('proposal_details_document_for_tourismevent', 'tourismevent', 'proposal_details_document_', 'proposal_details_document');
            }
            if ($file_no == VALUE_TWO) {
                $tourismevent_data = $this->utility_model->upload_document('seal_and_stamp_for_tourismevent', 'tourismevent', 'signatur_', 'signature');
            }
            if (!$tourismevent_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$tourismevent_id) {
                $tourismevent_data['user_id'] = $session_user_id;
                $tourismevent_data['status'] = VALUE_ONE;
                $tourismevent_data['created_by'] = $session_user_id;
                $tourismevent_data['created_time'] = date('Y-m-d H:i:s');
                $tourismevent_id = $this->utility_model->insert_data('tourismevent', $tourismevent_data);
            } else {
                $tourismevent_data['updated_by'] = $session_user_id;
                $tourismevent_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('tourismevent_id', $tourismevent_id, 'tourismevent', $tourismevent_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['tourismevent_data'] = $tourismevent_data;
            $success_array['tourismevent_id'] = $tourismevent_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Tourismevent.php
 */