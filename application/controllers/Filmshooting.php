<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Filmshooting extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_filmshooting_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['filmshooting_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['filmshooting_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'filmshooting', 'district', $search_district, 'filmshooting_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['filmshooting_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['filmshooting_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_filmshooting_data_by_id() {
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
            $filmshooting_id = get_from_post('filmshooting_id');
            if (!$filmshooting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $filmshooting_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');
            if (empty($filmshooting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['filmshooting_data'] = $filmshooting_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_filmshooting_renewal_data_by_id() {
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
            $filmshooting_id = get_from_post('filmshooting_id');
            if (!$filmshooting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $filmshooting_renewal_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting_renewal');
            if (empty($filmshooting_renewal_data)) {
                $filmshooting_renewal_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');
                if (empty($filmshooting_renewal_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            //$filmshooting_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');   

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['filmshooting_data'] = $filmshooting_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_filmshooting() {
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
            $filmshooting_id = get_from_post('filmshooting_id');
            $filmshooting_data = $this->_get_post_data_for_filmshooting();
            $validation_message = $this->_check_validation_for_filmshooting($filmshooting_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->db->trans_start();
            $filmshooting_data['shooting_date_time'] = convert_to_mysql_date_format($filmshooting_data['shooting_date_time']);
            $filmshooting_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $filmshooting_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$filmshooting_id || $filmshooting_id == NULL) {
                $filmshooting_data['user_id'] = $user_id;
                $filmshooting_data['created_by'] = $user_id;
                $filmshooting_data['created_time'] = date('Y-m-d H:i:s');
                $filmshooting_id = $this->utility_model->insert_data('filmshooting', $filmshooting_data);
            } else {
                $filmshooting_data['updated_by'] = $user_id;
                $filmshooting_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', $filmshooting_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYTWO, $filmshooting_id);
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

    function _get_post_data_for_filmshooting() {
        $filmshooting_data = array();
        $filmshooting_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $filmshooting_data['production_house'] = get_from_post('production_house');
        $filmshooting_data['address'] = get_from_post('address');
        $filmshooting_data['production_manager'] = get_from_post('production_manager');
        $filmshooting_data['contact_no'] = get_from_post('contact_no');
        $filmshooting_data['email'] = get_from_post('email');
        $filmshooting_data['director_cast'] = get_from_post('director_cast');
        $filmshooting_data['film_title'] = get_from_post('film_title');
        $filmshooting_data['film_synopsis'] = get_from_post('film_synopsis');
        $filmshooting_data['film_shooting_days'] = get_from_post('film_shooting_days');
        $filmshooting_data['shooting_location'] = get_from_post('shooting_location');
        $filmshooting_data['shooting_date_time'] = get_from_post('shooting_date_time');
        $filmshooting_data['defense_installation'] = get_from_post('defense_installation');
        $filmshooting_data['district'] = get_from_post('district');
        $filmshooting_data['undersigned'] = get_from_post('undersigned');
        $filmshooting_data['aged'] = get_from_post('aged');
        $filmshooting_data['resident'] = get_from_post('resident');
        $filmshooting_data['purpose'] = get_from_post('purpose');
        $filmshooting_data['witness_one_name'] = get_from_post('witness_one_name');
        $filmshooting_data['witness_two_name'] = get_from_post('witness_two_name');
        return $filmshooting_data;
    }

    function _check_validation_for_filmshooting($filmshooting_data) {
        if (!$filmshooting_data['district']) {
            return OWNER_DisTRICT_MESSAGE;
        }
        if (!$filmshooting_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$filmshooting_data['production_house']) {
            return PRODUCTION_HOUSE_MESSAGE;
        }
        if (!$filmshooting_data['address']) {
            return WORKSHOPS_ADDRESS_MESSAGE;
        }
        if (!$filmshooting_data['production_manager']) {
            return PRODUCTION_MANAGER_MESSAGE;
        }
        if (!$filmshooting_data['contact_no']) {
            return CONTACT_NO_MESSAGE;
        }
        if (!$filmshooting_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$filmshooting_data['director_cast']) {
            return DIRECTOR_MESSAGE;
        }
        if (!$filmshooting_data['film_title']) {
            return FILM_TITLE_MESSAGE;
        }
        if (!$filmshooting_data['film_synopsis']) {
            return FILM_SYNOPSIS_MESSAGE;
        }
        if (!$filmshooting_data['film_shooting_days']) {
            return FILM_SHOOTING_DAYS_MESSAGE;
        }
        if (!$filmshooting_data['shooting_location']) {
            return SHOOTING_LOCATION_MESSAGE;
        }
        if (!$filmshooting_data['shooting_date_time']) {
            return SHOOTING_DATE_MESSAGE;
        }
        if (!$filmshooting_data['defense_installation']) {
            return DEFENSE_INSTALLATION_MESSAGE;
        }
        if (!$filmshooting_data['undersigned']) {
            return UNDERSIGNED_MESSAGE;
        }
        if (!$filmshooting_data['aged']) {
            return AGED_YEAR_MESSAGE;
        }
        if (!$filmshooting_data['resident']) {
            return RESIDENT_MESSAGE;
        }
        if (!$filmshooting_data['purpose']) {
            return DECPURPOSE_MESSAGE;
        }
        if (!$filmshooting_data['witness_one_name']) {
            return WITNESS_NAME_MESSAGE;
        }
        if (!$filmshooting_data['witness_two_name']) {
            return WITNESS_NAME_MESSAGE;
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
            $filmshooting_id = get_from_post('filmshooting_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$filmshooting_id || $filmshooting_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_filmshooting_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');
            if (empty($ex_filmshooting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            // $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_filmshooting_data[$document_id];
            if ($document_type == VALUE_ONE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_filmshooting_data['declaration'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_filmshooting_data['producer_signature'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_filmshooting_data['authorized_representative_sign'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_filmshooting_data['seal_of_company'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_filmshooting_data['witness_one_sign'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_filmshooting_data['witness_two_sign'];
            }
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            // $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array($document_id => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array('declaration' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array('producer_signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array('authorized_representative_sign' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array('seal_of_company' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array('witness_one_sign' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array('witness_two_sign' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $filmshooting_id = get_from_post('filmshooting_id_for_filmshooting_form1');
            if (!is_post() || $user_id == null || !$user_id || $filmshooting_id == null || !$filmshooting_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_filmshooting_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');

            if (empty($existing_filmshooting_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('filmshooting_data' => $existing_filmshooting_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('filmshooting/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_filmshooting_data_by_filmshooting_id() {
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
            $filmshooting_id = get_from_post('filmshooting_id');
            if (!$filmshooting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $filmshooting_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');
            if (empty($filmshooting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWENTYTWO, $filmshooting_id, $filmshooting_data);
            $filmshooting_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWENTYTWO, 'fees_bifurcation', 'module_id', $filmshooting_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['filmshooting_data'] = $filmshooting_data;
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
            $filmshooting_id = get_from_post('filmshooting_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$filmshooting_id || $filmshooting_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'filmshooting' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $filmshooting_id = get_from_post('filmshooting_id_for_filmshooting_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $filmshooting_id == NULL || !$filmshooting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_fs_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');
            if (empty($ex_fs_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_fs_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_filmshooting_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $filmshooting_data = array();
            if ($_FILES['fees_paid_challan_for_filmshooting_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'filmshooting';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_filmshooting_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_filmshooting_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $filmshooting_data['status'] = VALUE_FOUR;
                $filmshooting_data['fees_paid_challan'] = $filename;
                $filmshooting_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_fs_data['payment_type'] == VALUE_TWO) {
                $filmshooting_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $filmshooting_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $filmshooting_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWENTYTWO, $filmshooting_id, $ex_fs_data['district'], $ex_fs_data['total_fees'], $filmshooting_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $filmshooting_data['user_payment_type'] = $user_payment_type;
            } else {
                $filmshooting_data['user_payment_type'] = VALUE_ZERO;
            }
            $filmshooting_data['updated_by'] = $user_id;
            $filmshooting_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', $filmshooting_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($filmshooting_data['status']) ? $filmshooting_data['status'] : $ex_fs_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_fs_data['payment_type'];
            $success_array['user_payment_type'] = $filmshooting_data['user_payment_type'];
            if ($ex_fs_data['payment_type'] == VALUE_TWO && $filmshooting_data['user_payment_type'] == VALUE_THREE) {
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
            $filmshooting_id = get_from_post('filmshooting_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $filmshooting_id == null || !$filmshooting_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_filmshooting_data = $this->utility_model->get_by_id('filmshooting_id', $filmshooting_id, 'filmshooting');
            if (empty($existing_filmshooting_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_filmshooting_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_filmshooting($existing_filmshooting_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    // drct upload
    function upload_filmshooting_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $filmshooting_id = get_from_post('filmshooting_id');
            $file_no = get_from_post('file_no');


            if ($file_no == VALUE_ONE) {
                $filmshooting_data = $this->utility_model->upload_document('declaration_for_filmshooting', 'filmshooting', 'declaration_', 'declaration');
            }
            if ($file_no == VALUE_TWO) {
                $filmshooting_data = $this->utility_model->upload_document('producer_signature_for_filmshooting', 'filmshooting', 'producer_signature_', 'producer_signature');
            }
            if ($file_no == VALUE_THREE) {
                $filmshooting_data = $this->utility_model->upload_document('authorized_representative_sign_for_filmshooting', 'filmshooting', 'authorized_representative_sign_', 'authorized_representative_sign');
            }
            if ($file_no == VALUE_FOUR) {
                $filmshooting_data = $this->utility_model->upload_document('seal_of_company_for_filmshooting', 'filmshooting', 'seal_of_company_', 'seal_of_company');
            }
            if ($file_no == VALUE_FIVE) {
                $filmshooting_data = $this->utility_model->upload_document('witness_one_sign_for_filmshooting', 'filmshooting', 'witness_one_sign_', 'witness_one_sign');
            }
            if ($file_no == VALUE_SIX) {
                $filmshooting_data = $this->utility_model->upload_document('witness_two_sign_for_filmshooting', 'filmshooting', 'witness_two_sign_', 'witness_two_sign');
            }
            if (!$filmshooting_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$filmshooting_id) {
                $filmshooting_data['user_id'] = $session_user_id;
                $filmshooting_data['status'] = VALUE_ONE;
                $filmshooting_data['created_by'] = $session_user_id;
                $filmshooting_data['created_time'] = date('Y-m-d H:i:s');
                $filmshooting_id = $this->utility_model->insert_data('filmshooting', $filmshooting_data);
            } else {
                $filmshooting_data['updated_by'] = $session_user_id;
                $filmshooting_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('filmshooting_id', $filmshooting_id, 'filmshooting', $filmshooting_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['filmshooting_data'] = $filmshooting_data;
            $success_array['filmshooting_id'] = $filmshooting_id;
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