<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Factorylicense_renewal extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_factory_license_renewal_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['factory_license_renewal_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['factory_license_renewal_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'factorylicence_renewal', 'district', $search_district, 'factorylicence_renewal_id', 'DESC', 'status', $search_status);
            if ($this->db->trans_status() === FALSE) {
                $success_array['factory_license_renewal_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['factory_license_renewal_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_factory_license_data_by_id() {
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
            $factory_license_data = $this->utility_model->get_by_id('registration_number', $license_number, 'factorylicence');
            // if (empty($factory_license_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['factory_license_data'] = $factory_license_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_factory_license_renewal_data_by_id() {
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
            $factory_license_renewal_id = get_from_post('factorylicense_id');
            if (!$factory_license_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $factory_license_renewal_data = $this->utility_model->get_by_id('factorylicence_renewal_id', $factory_license_renewal_id, 'factorylicence_renewal');
            if (empty($factory_license_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['factory_license_renewal_data'] = $factory_license_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_factory_license_renewal() {
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

            $factorylicence_renewal_id = get_from_post('factorylicence_renewal_id');
            $factory_license_renewal_data = $this->_get_post_data_for_factory_license_renewal();
            $validation_message = $this->_check_validation_for_factory_license_renewal($factory_license_renewal_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            $this->db->trans_start();
            $factory_license_renewal_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $factory_license_renewal_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$factorylicence_renewal_id || $factorylicence_renewal_id == NULL) {
                $factory_license_renewal_data['user_id'] = $user_id;
                $factory_license_renewal_data['created_by'] = $user_id;
                $factory_license_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $factorylicence_renewal_id = $this->utility_model->insert_data('factorylicence_renewal', $factory_license_renewal_data);
            } else {
                $factory_license_renewal_data['updated_by'] = $user_id;
                $factory_license_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal', $factory_license_renewal_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTYONE, $factorylicence_renewal_id);
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

    function _get_post_data_for_factory_license_renewal() {
        $factory_license_renewal_data = array();
        $factory_license_renewal_data['district'] = get_from_post('district');
        $factory_license_renewal_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $factory_license_renewal_data['factorylicence_renewal_id'] = get_from_post('factorylicence_renewal_id');
        $factory_license_renewal_data['license_number'] = get_from_post('registration_number');
        $factory_license_renewal_data['name_of_factory'] = get_from_post('name_of_factory');
        $factory_license_renewal_data['factory_address'] = get_from_post('factory_address');
        $factory_license_renewal_data['factory_postal_address'] = get_from_post('factory_postal_address');
        $factory_license_renewal_data['max_no_of_worker_year'] = get_from_post('max_no_of_worker_year');
        $factory_license_renewal_data['max_power_to_be_used'] = get_from_post('max_power_to_be_used');
//        $factory_license_renewal_data['fee_paid_ammount'] = get_from_post('fee_paid_ammount');
//        $factory_license_renewal_data['receipt_number'] = get_from_post('receipt_number');
//        $factory_license_renewal_data['receipt_date'] = get_from_post('receipt_date');
        $factory_license_renewal_data['manager_detail'] = get_from_post('manager_detail');
        $factory_license_renewal_data['occupier_detail'] = get_from_post('occupier_detail');
        $factory_license_renewal_data['registration_number'] = get_from_post('registration_number');
        return $factory_license_renewal_data;
    }

    function _check_validation_for_factory_license_renewal($factory_license_renewal_data) {
        if (!$factory_license_renewal_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$factory_license_renewal_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$factory_license_renewal_data['license_number']) {
            return LICENSE_NUMBER_MESSAGE;
        }
        if (!$factory_license_renewal_data['name_of_factory']) {
            return FACTORY_NAME_MESSAGE;
        }
        if (!$factory_license_renewal_data['factory_address']) {
            return FACTORY_ADDRESS_MESSAGE;
        }
        if (!$factory_license_renewal_data['max_no_of_worker_year']) {
            return MAX_WORKER_MESSAGE;
        }
        if (!$factory_license_renewal_data['max_power_to_be_used']) {
            return POWER_MESSAGE;
        }
        if (!$factory_license_renewal_data['manager_detail']) {
            return MANAGER_MESSAGE;
        }
        if (!$factory_license_renewal_data['occupier_detail']) {
            return OCCUPIER_MESSAGE;
        }
        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $factorylicence_renewal_id = get_from_post('factorylicense_renewal_id_for_factorylicense_renewal_form1');
            if (!is_post() || $user_id == null || !$user_id || $factorylicence_renewal_id == null || !$factorylicence_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_factory_license_renewal_data = $this->utility_model->get_by_id('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal');

            if (empty($existing_factory_license_renewal_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('factorylicense_renewal_data' => $existing_factory_license_renewal_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('factorylicense_renewal/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_factorylicense_renewal_data_by_factorylicense_renewal_id() {
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
            $factorylicence_renewal_id = get_from_post('factorylicence_renewal_id');
            if (!$factorylicence_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $factory_license_renewal_data = $this->utility_model->get_by_id('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal');
            if (empty($factory_license_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTYONE, $factorylicence_renewal_id, $factory_license_renewal_data);
            $factory_license_renewal_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTYONE, 'fees_bifurcation', 'module_id', $factorylicence_renewal_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['factory_license_renewal_data'] = $factory_license_renewal_data;
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
            $factorylicence_renewal_id = get_from_post('factorylicence_renewal_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$factorylicence_renewal_id || $factorylicence_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicence' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $factorylicence_renewal_id = get_from_post('factory_license_renewal_id_for_factory_license_renewal_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $factorylicence_renewal_id == NULL || !$factorylicence_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_fact_data = $this->utility_model->get_by_id('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal');
            if (empty($ex_fact_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_fact_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_factory_license_renewal_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $factory_license_renewal_data = array();
            if ($_FILES['fees_paid_challan_for_factory_license_renewal_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'factorylicense';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_factory_license_renewal_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_factory_license_renewal_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $factory_license_renewal_data['status'] = VALUE_FOUR;
                $factory_license_renewal_data['fees_paid_challan'] = $filename;
                $factory_license_renewal_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_fact_data['payment_type'] == VALUE_TWO) {
                $factory_license_renewal_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $factory_license_renewal_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $factory_license_renewal_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTYONE, $factorylicence_renewal_id, $ex_fact_data['district'], $ex_fact_data['total_fees'], $factory_license_renewal_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $factory_license_renewal_data['user_payment_type'] = $user_payment_type;
            } else {
                $factory_license_renewal_data['user_payment_type'] = VALUE_ZERO;
            }
            $factory_license_renewal_data['updated_by'] = $user_id;
            $factory_license_renewal_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal', $factory_license_renewal_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($factory_license_renewal_data['status']) ? $factory_license_renewal_data['status'] : $ex_fact_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_fact_data['payment_type'];
            $success_array['user_payment_type'] = $factory_license_renewal_data['user_payment_type'];
            if ($ex_fact_data['payment_type'] == VALUE_TWO && $factory_license_renewal_data['user_payment_type'] == VALUE_THREE) {
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
            $factorylicence_renewal_id = get_from_post('factorylicense_renewal_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $factorylicence_renewal_id == null || !$factorylicence_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_factorylicence_data = $this->utility_model->get_by_id('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal');
            if (empty($existing_factorylicence_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_factorylicence_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_factorylicence_renewal($existing_factorylicence_data);
    //        $this->utility_lib->gc_for_factorylicence($existing_factorylicence_data);
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
            $factorylicence_renewal_id = get_from_post('factorylicence_renewal_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$factorylicence_renewal_id || $factorylicence_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_of_occupier'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_of_manager'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal', array('sign_of_occupier' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal', array('sign_of_manager' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_factorylicence_renewal_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $factorylicence_renewal_id = get_from_post('factorylicence_renewal_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $factory_license_renewal_data = $this->utility_model->upload_document('sign_of_occupier_for_factorylicense_renewal', 'factorylicense', 'sign_of_occupier_', 'sign_of_occupier');
            }
            if ($file_no == VALUE_TWO) {
                $factory_license_renewal_data = $this->utility_model->upload_document('sign_of_manager_for_factorylicense_renewal', 'factorylicense', 'sign_of_manager_', 'sign_of_manager');
            }
            if (!$factory_license_renewal_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$factorylicence_renewal_id) {
                $factory_license_renewal_data['user_id'] = $session_user_id;
                $factory_license_renewal_data['status'] = VALUE_ONE;
                $factory_license_renewal_data['created_by'] = $session_user_id;
                $factory_license_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $factorylicence_renewal_id = $this->utility_model->insert_data('factorylicence_renewal', $factory_license_renewal_data);
            } else {
                $factory_license_renewal_data['updated_by'] = $session_user_id;
                $factory_license_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('factorylicence_renewal_id', $factorylicence_renewal_id, 'factorylicence_renewal', $factory_license_renewal_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['success'] = TRUE;
            $success_array['factory_license_renewal_data'] = $factory_license_renewal_data;
            $success_array['factorylicence_renewal_id'] = $factorylicence_renewal_id;
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