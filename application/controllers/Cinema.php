<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cinema extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_cinema_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['cinema_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['cinema_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'cinema', 'district', $search_district, 'cinema_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['cinema_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['cinema_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_cinema_data_by_id() {
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
            $cinema_id = get_from_post('cinema_id');
            if (!$cinema_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $cinema_data = $this->utility_model->get_by_id('cinema_id', $cinema_id, 'cinema');
            if (empty($cinema_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['cinema_data'] = $cinema_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_cinema() {
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
            $cinema_id = get_from_post('cinema_id');
            $cinema_data = $this->_get_post_data_for_cinema();
            $validation_message = $this->_check_validation_for_cinema($cinema_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $cinema_data['dob'] = convert_to_mysql_date_format($cinema_data['dob']);
            $cinema_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $cinema_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$cinema_id || $cinema_id == NULL) {
                $cinema_data['user_id'] = $user_id;
                $cinema_data['created_by'] = $user_id;
                $cinema_data['created_time'] = date('Y-m-d H:i:s');
                $cinema_id = $this->utility_model->insert_data('cinema', $cinema_data);
            } else {
                $cinema_data['updated_by'] = $user_id;
                $cinema_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', $cinema_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_EIGHT, $cinema_id);
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

    function _get_post_data_for_cinema() {
        $cinema_data = array();
        $cinema_data['district'] = get_from_post('district');
        $cinema_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $cinema_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $cinema_data['father_name'] = get_from_post('father_name');
        $cinema_data['dob'] = get_from_post('dob');
        $cinema_data['permanent_address'] = get_from_post('permanent_address');
        $cinema_data['temporary_address'] = get_from_post('temporary_address');
        $cinema_data['video_cassette_recorder'] = get_from_post('video_cassette_recorder');
        $cinema_data['tb_license_affected'] = get_from_post('tb_license_affected');
        $cinema_data['is_case_of_building'] = get_from_post('is_case_of_building');
        if ($cinema_data['is_case_of_building'] == IS_CHECKED_YES) {
            $cinema_data['name_of_building'] = get_from_post('name_of_building');
            $cinema_data['place_of_building'] = get_from_post('place_of_building');
            $cinema_data['distance_of_building'] = get_from_post('distance_of_building');
        } else {
            $cinema_data['name_of_building'] = '';
            $cinema_data['place_of_building'] = '';
            $cinema_data['distance_of_building'] = '';
        }
        $cinema_data['name_of_building'] = get_from_post('name_of_building');
        $cinema_data['place_of_building'] = get_from_post('place_of_building');
        $cinema_data['distance_of_building'] = get_from_post('distance_of_building');
        $cinema_data['building_as'] = get_from_post('building_as');
        $cinema_data['auditorium_as'] = get_from_post('auditorium_as');
        $cinema_data['passages_and_gangways_as'] = get_from_post('passages_and_gangways_as');
        $cinema_data['urinals_and_wc_as'] = get_from_post('urinals_and_wc_as');
        $cinema_data['time_schedule_film'] = get_from_post('time_schedule_film');
        $cinema_data['screen_width'] = get_from_post('screen_width');
        return $cinema_data;
    }

    function _check_validation_for_cinema($cinema_data) {
        if (!$cinema_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$cinema_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$cinema_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$cinema_data['father_name']) {
            return FATHER_NAME_MESSAGE;
        }
        if (!$cinema_data['dob']) {
            return DOB_MESSAGE;
        }
        if (!$cinema_data['permanent_address']) {
            return PERMANENT_ADDRESS_MESSAGE;
        }
        if (!$cinema_data['temporary_address']) {
            return TEMPORARY_ADDRESS_MESSAGE;
        }
        if (!$cinema_data['video_cassette_recorder']) {
            return VIDEO_CASSETTE_RECORDER_LINK_MESSAGE;
        }
        if ($cinema_data['is_case_of_building'] == IS_CHECKED_YES) {
            if (!$cinema_data['name_of_building']) {
                return NAME_OF_BUILDING_MESSAGE;
            }
            if (!$cinema_data['place_of_building']) {
                return PLACE_OF_BUILDING_MESSAGE;
            }
            if (!$cinema_data['distance_of_building']) {
                return DISTANCE_OF_BUILDING_MESSAGE;
            }
        }
        if (!$cinema_data['tb_license_affected']) {
            return TB_LICENSE_AFFECTED_MESSAGE;
        }
        if (!$cinema_data['building_as']) {
            return BUILDING_AS_MESSAGE;
        }
        if (!$cinema_data['auditorium_as']) {
            return AUDITORIUM_AS_MESSAGE;
        }
        if (!$cinema_data['passages_and_gangways_as']) {
            return PASSAGE_GANGWAYS_AS_MESSAGE;
        }
        if (!$cinema_data['urinals_and_wc_as']) {
            return URINALS_WC_AS_MESSAGE;
        }
        if (!$cinema_data['time_schedule_film']) {
            return TIME_SCHEDULE_FILM_MESSAGE;
        }
        if (!$cinema_data['screen_width']) {
            return SCREEN_WIDTH_MESSAGE;
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
            $cinema_id = get_from_post('cinema_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$cinema_id || $cinema_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('cinema_id', $cinema_id, 'cinema');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['plan_of_building_document'];
            } else if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['character_licence_certificate'];
            } else if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['photo_state_copy'];
            } else if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['ownership_document'];
            } else if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['motor_vehicles_document'];
            } else if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['business_trade_authority_license'];
            } else if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('plan_of_building_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('character_licence_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('photo_state_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('ownership_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('motor_vehicles_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('business_trade_authority_license' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $cinema_id = get_from_post('cinema_id_for_cinema_form1');
            if (!is_post() || $user_id == null || !$user_id || $cinema_id == null || !$cinema_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_cinema_data = $this->utility_model->get_by_id('cinema_id', $cinema_id, 'cinema');

            if (empty($existing_cinema_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('cinema_data' => $existing_cinema_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('cinema/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_cinema_data_by_cinema_id() {
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
            $cinema_id = get_from_post('cinema_id');
            if (!$cinema_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $cinema_data = $this->utility_model->get_by_id('cinema_id', $cinema_id, 'cinema');
            if (empty($cinema_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_EIGHT, $cinema_id, $cinema_data);
            $cinema_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_EIGHT, 'fees_bifurcation', 'module_id', $cinema_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['cinema_data'] = $cinema_data;
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
            $cinema_id = get_from_post('cinema_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$cinema_id || $cinema_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('cinema_id', $cinema_id, 'cinema');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'cinema' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $cinema_id = get_from_post('cinema_id_for_cinema_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $cinema_id == NULL || !$cinema_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('cinema_id', $cinema_id, 'cinema');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_cinema_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $cinema_data = array();
            if ($_FILES['fees_paid_challan_for_cinema_upload_challan']['name'] != '') {
                $main_path = 'documents/cinema';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'cinema';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_cinema_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_cinema_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $cinema_data['status'] = VALUE_FOUR;
                $cinema_data['fees_paid_challan'] = $filename;
                $cinema_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $cinema_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $cinema_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $cinema_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_EIGHT, $cinema_id, $ex_em_data['district'], $ex_em_data['total_fees'], $cinema_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $cinema_data['user_payment_type'] = $user_payment_type;
            } else {
                $cinema_data['user_payment_type'] = VALUE_ZERO;
            }
            $cinema_data['updated_by'] = $user_id;
            $cinema_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', $cinema_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($cinema_data['status']) ? $cinema_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $cinema_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $cinema_data['user_payment_type'] == VALUE_THREE) {
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
            $cinema_id = get_from_post('cinema_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $cinema_id == null || !$cinema_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_cinema_data = $this->utility_model->get_by_id('cinema_id', $cinema_id, 'cinema');
            if (empty($existing_cinema_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_cinema_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_cinema($existing_cinema_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_cinema_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $cinema_id = get_from_post('cinema_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_TWO) {
                $cinema_data = $this->utility_model->upload_document('plan_of_building_document', 'cinema', 'plan_of_building_document_', 'plan_of_building_document');
            }
            if ($file_no == VALUE_THREE) {
                $cinema_data = $this->utility_model->upload_document('character_licence_certificate', 'cinema', 'character_licence_certificate_', 'character_licence_certificate');
            }
            if ($file_no == VALUE_FOUR) {
                $cinema_data = $this->utility_model->upload_document('photo_state_copy', 'cinema', 'photo_state_copy_', 'photo_state_copy');
            }
            if ($file_no == VALUE_FIVE) {
                $cinema_data = $this->utility_model->upload_document('ownership_document', 'cinema', 'ownership_document_', 'ownership_document');
            }
            if ($file_no == VALUE_SIX) {
                $cinema_data = $this->utility_model->upload_document('motor_vehicles_document', 'cinema', 'motor_vehicles_document_', 'motor_vehicles_document');
            }
            if ($file_no == VALUE_SEVEN) {
                $cinema_data = $this->utility_model->upload_document('business_trade_authority_license', 'cinema', 'business_trade_authority_license_', 'business_trade_authority_license');
            }
            if ($file_no == VALUE_EIGHT) {
                $cinema_data = $this->utility_model->upload_document('seal_and_stamp_for_cinema', 'cinema', 'signatur_', 'signature');
            }
            if (!$cinema_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$cinema_id) {
                $cinema_data['user_id'] = $session_user_id;
                $cinema_data['status'] = VALUE_ONE;
                $cinema_data['created_by'] = $session_user_id;
                $cinema_data['created_time'] = date('Y-m-d H:i:s');
                $cinema_id = $this->utility_model->insert_data('cinema', $cinema_data);
            } else {
                $cinema_data['updated_by'] = $session_user_id;
                $cinema_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('cinema_id', $cinema_id, 'cinema', $cinema_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['cinema_data'] = $cinema_data;
            $success_array['cinema_id'] = $cinema_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Cinema.php
 */