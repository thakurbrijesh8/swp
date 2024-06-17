<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_site_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['site_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['site_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'site_elevation', 'district', $search_district, 'site_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['site_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['site_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_site_data_by_id() {
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
            $site_id = get_from_post('site_id');
            if (!$site_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $site_data = $this->utility_model->get_by_id('site_id', $site_id, 'site_elevation');
            if (empty($site_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['site_data'] = $site_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_site() {
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
            $site_id = get_from_post('site_id');
            $site_data = $this->_get_post_data_for_site();
            $validation_message = $this->_check_validation_for_site($site_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();

            $site_data['application_date'] = convert_to_mysql_date_format($site_data['application_date']);
            $site_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $site_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$site_id || $site_id == NULL) {
                $site_data['user_id'] = $user_id;
                $site_data['created_by'] = $user_id;
                $site_data['created_time'] = date('Y-m-d H:i:s');
                $site_id = $this->utility_model->insert_data('site_elevation', $site_data);
            } else {
                $site_data['updated_by'] = $user_id;
                $site_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('site_id', $site_id, 'site_elevation', $site_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYNINE, $site_id);
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

    function _get_post_data_for_site() {
        $site_data = array();
        $site_data['district'] = get_from_post('district');
        $site_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $site_data['address'] = get_from_post('address');
        $site_data['mobile_no'] = get_from_post('mobile_no');
        $site_data['application_date'] = get_from_post('application_date');
        $site_data['pts_no'] = get_from_post('pts_no');
        $site_data['survey_no'] = get_from_post('survey_no');
        $site_data['village'] = get_from_post('village');
        $site_data['plot_area'] = get_from_post('plot_area');
        $site_data['fees'] = get_from_post('fees');
        return $site_data;
    }

    function _check_validation_for_site($site_data) {
        if (!$site_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$site_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$site_data['address']) {
            return OWNER_ADDRESS_MESSAGE;
        }
        if (!$site_data['mobile_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$site_data['village']) {
            return VILLAGE_MESSAGE;
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
            $site_id = get_from_post('site_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$site_id || $site_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('site_id', $site_id, 'site_elevation');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['site_plan'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['I_XIV_nakal'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('site_id', $site_id, 'site_elevation', array('site_plan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('site_id', $site_id, 'site_elevation', array('I_XIV_nakal' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('site_id', $site_id, 'site_elevation', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $site_id = get_from_post('site_id_for_site_form1');
            if (!is_post() || $user_id == null || !$user_id || $site_id == null || !$site_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_site_data = $this->utility_model->get_by_id('site_id', $site_id, 'site_elevation');

            if (empty($existing_site_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('site_data' => $existing_site_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('site/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_site_data_by_site_id() {
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
            $site_id = get_from_post('site_id');
            if (!$site_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $site_data = $this->utility_model->get_by_id('site_id', $site_id, 'site_elevation');
            if (empty($site_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['site_data'] = $site_data;
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
            $site_id = get_from_post('site_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$site_id || $site_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('site_id', $site_id, 'site_elevation');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('site_id', $site_id, 'site_elevation', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $site_id = get_from_post('site_id_for_site_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $site_id == NULL || !$site_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('site_id', $site_id, 'site_elevation');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_site_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $site_data = array();
            if ($_FILES['fees_paid_challan_for_site_upload_challan']['name'] != '') {
                $main_path = 'documents/site';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'site';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_site_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_site_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $site_data['status'] = VALUE_FOUR;
                $site_data['fees_paid_challan'] = $filename;
                $site_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                if ($user_payment_type == VALUE_TWO) {
                    $site_data['status'] = VALUE_EIGHT;
                } else {
                    $site_data['status'] = VALUE_FOUR;
                }
                $site_data['user_payment_type'] = $user_payment_type;
            } else {
                $site_data['user_payment_type'] = VALUE_ZERO;
            }
            $site_data['updated_by'] = $user_id;
            $site_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('site_id', $site_id, 'site_elevation', $site_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($site_data['status']) ? $site_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function generate_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $site_id = get_from_post('site_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $site_id == null || !$site_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_site_data = $this->utility_model->get_by_id('site_id', $site_id, 'site_elevation');
            if (empty($existing_site_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_site_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_site($existing_site_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_site_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $site_id = get_from_post('site_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $site_data = $this->utility_model->upload_document('site_plan_for_site', 'site', 'site_plan_', 'site_plan');
            }
            if ($file_no == VALUE_TWO) {
                $site_data = $this->utility_model->upload_document('I_XIV_nakal_for_site', 'site', 'I_XIV_nakal_', 'I_XIV_nakal');
            }
            if ($file_no == VALUE_THREE) {
                $site_data = $this->utility_model->upload_document('seal_and_stamp_for_site', 'site', 'signature_', 'signature');
            }
            if (!$site_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$site_id) {
                $site_data['user_id'] = $session_user_id;
                $site_data['status'] = VALUE_ONE;
                $site_data['created_by'] = $session_user_id;
                $site_data['created_time'] = date('Y-m-d H:i:s');
                $site_id = $this->utility_model->insert_data('site_elevation', $site_data);
            } else {
                $site_data['updated_by'] = $session_user_id;
                $site_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('site_id', $site_id, 'site_elevation', $site_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['site_data'] = $site_data;
            $success_array['site_id'] = $site_id;
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