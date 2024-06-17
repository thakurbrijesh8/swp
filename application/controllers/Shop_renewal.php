<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_renewal extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('shop_renewal_model');
    }

    function get_shop_renewal_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['shop_renewal_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['shop_renewal_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'shop_renewal', 'district', $search_district, 'shop_renewal_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['shop_renewal_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['shop_renewal_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_shop_data_by_id() {
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
            $shop_data = $this->utility_model->get_by_id('s_registration_no', $license_number, 'shop');
            if (empty($shop_data)) {
                $shop_data = $this->utility_model->get_by_id('registration_number', $license_number, 'shop_renewal');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['shop_data'] = $shop_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_shop_renewal_data_by_id() {
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
            $shop_renewal_id = get_from_post('shop_renewal_id');
            if (!$shop_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $shop_renewal_data = $this->utility_model->get_by_id('shop_renewal_id', $shop_renewal_id, 'shop_renewal');
            if (empty($shop_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['shop_renewal_data'] = $shop_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_shop_renewal() {
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
            $shop_renewal_id = get_from_post('shop_renewal_id');
            $shop_renewal_data = $this->_get_post_data_for_shop();
            $validation_message = $this->_check_validation_for_shop($shop_renewal_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $existing_shop_data = $this->utility_model->get_by_id('user_id', $user_id, 'shop', 's_registration_no', $shop_renewal_data['registration_number']);
            if (!empty($existing_shop_data)) {
                $shop_renewal_data['shop_id'] = $existing_shop_data['s_id'];
            } else {
                $existing_shop_renewal_data = $this->utility_model->get_by_id('user_id', $user_id, 'shop_renewal', 'registration_number', $shop_renewal_data['registration_number']);
                if (!empty($existing_shop_renewal_data)) {
                    $shop_renewal_data['parent_id'] = $existing_shop_renewal_data['shop_renewal_id'];
                } else {
                    $shop_renewal_data['parent_id'] = VALUE_ZERO;
                }
            }
            $shop_renewal_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $shop_renewal_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$shop_renewal_id || $shop_renewal_id == NULL) {
                $shop_renewal_data['user_id'] = $user_id;
                $shop_renewal_data['created_by'] = $user_id;
                $shop_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $shop_renewal_id = $this->utility_model->insert_data('shop_renewal', $shop_renewal_data);
            } else {
                $shop_renewal_data['updated_by'] = $user_id;
                $shop_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('shop_renewal_id', $shop_renewal_id, 'shop_renewal', $shop_renewal_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FOURTYTWO, $shop_renewal_id);
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

    function _get_post_data_for_shop() {
        $shop_renewal_data = array();
        $shop_renewal_data['shop_id'] = get_from_post('shop_id');
        $shop_renewal_data['district'] = get_from_post('district');
        $shop_renewal_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $shop_renewal_data['name_of_shop'] = get_from_post('name_of_shop');
        $shop_renewal_data['door_no'] = get_from_post('door_no_for_shop');
        $shop_renewal_data['street_name'] = get_from_post('street_name_for_shop');
        $shop_renewal_data['location'] = get_from_post('loaction_for_shop');
        $shop_renewal_data['total_employees'] = get_from_post('total_employees');
        $shop_renewal_data['nature_of_business'] = get_from_post('nature_of_business_for_shop');
        $shop_renewal_data['employer_name'] = get_from_post('name_of_employer_for_shop');
        $shop_renewal_data['employer_mobile_no'] = get_from_post('mobile_no_employer_for_shop');
        $shop_renewal_data['employer_residential_address'] = get_from_post('residential_address_employer_for_shop');
        $shop_renewal_data['manager_name'] = get_from_post('manager_name_for_shop');
        $shop_renewal_data['manager_residential_address'] = get_from_post('residential_address_manager_for_shop');
        $shop_renewal_data['category'] = get_from_post('category_for_shop');
        $shop_renewal_data['registration_number'] = get_from_post('registration_number');
        return $shop_renewal_data;
    }

    function _check_validation_for_shop($shop_renewal_data) {
        if (!$shop_renewal_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$shop_renewal_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$shop_renewal_data['name_of_shop']) {
            return SHOP_NAME_MESSAGE;
        }
        if (!$shop_renewal_data['door_no']) {
            return SHOP_DOOR_NO_MESSAGE;
        }
        if (!$shop_renewal_data['street_name']) {
            return SHOP_STREET_NAME_MESSAGE;
        }
        if (!$shop_renewal_data['location']) {
            return SHOP_LOCATION_MESSAGE;
        }
        if (!$shop_renewal_data['total_employees']) {
            return TOTAL_TOTAL_MESSAGE;
        }
        if (!$shop_renewal_data['nature_of_business']) {
            return SHOP_NATURE_OF_BUSINESS_MESSAGE;
        }
        if (!$shop_renewal_data['employer_name']) {
            return SHOP_EMPLOYER_NAME_MESSAGE;
        }
        if (!$shop_renewal_data['employer_mobile_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$shop_renewal_data['employer_residential_address']) {
            return SHOP_EMPLOYER_RESIDENTIAL_ADDRESS_MESSAGE;
        }
        if (!$shop_renewal_data['manager_name']) {
            return SHOP_MANAGER_NAME_MESSAGE;
        }
        if (!$shop_renewal_data['manager_residential_address']) {
            return SHOP_MANAGER_RESIDENTIAL_ADDRESS_MESSAGE;
        }
        if (!$shop_renewal_data['category']) {
            return SHOP_CATEGORY_MESSAGE;
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
            $shop_renewal_id = get_from_post('shop_renewal_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$shop_renewal_id || $shop_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('shop_renewal_id', $shop_renewal_id, 'shop_renewal');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('shop_renewal_id', $shop_renewal_id, 'shop_renewal', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $shop_renewal_id = get_from_post('shop_renewal_id_for_shop_renewal_form');
            if (!is_post() || $user_id == null || !$user_id || $shop_renewal_id == null || !$shop_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_shop_data = $this->utility_model->get_by_id('shop_renewal_id', $shop_renewal_id, 'shop_renewal');

            if (empty($existing_shop_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $taluka_array = $this->config->item('taluka_array');
            $existing_shop_data['district'] = isset($taluka_array[$existing_shop_data['district']]) ? $taluka_array[$existing_shop_data['district']] : '-';
            error_reporting(E_ERROR);
            $data = array('shop_renewal_data' => $existing_shop_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('shop_renewal/pdf', $data, TRUE));
            $mpdf->Output('FORM.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_shop_renewal_data_by_shop_renewal_id() {
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
            $shop_renewal_id = get_from_post('shop_renewal_id');
            if (!$shop_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $shop_renewal_data = $this->utility_model->get_by_id('shop_renewal_id', $shop_renewal_id, 'shop_renewal');
            if (empty($shop_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FOURTYTWO, $shop_renewal_id, $shop_renewal_data);
            $shop_renewal_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FOURTYTWO, 'fees_bifurcation', 'module_id', $shop_renewal_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['shop_renewal_data'] = $shop_renewal_data;
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
            $shop_renewal_id = get_from_post('shop_renewal_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$shop_renewal_id || $shop_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('shop_renewal_id', $shop_renewal_id, 'shop_renewal');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('shop_renewal_id', $shop_renewal_id, 'shop_renewal', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $shop_renewal_id = get_from_post('shop_renewal_id_for_shop_renewal_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $shop_renewal_id == NULL || !$shop_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('shop_renewal_id', $shop_renewal_id, 'shop_renewal');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_shop_renewal_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $shop_renewal_data = array();
            if ($_FILES['fees_paid_challan_for_shop_renewal_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'shop';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_shop_renewal_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_shop_renewal_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $shop_renewal_data['status'] = VALUE_FOUR;
                $shop_renewal_data['fees_paid_challan'] = $filename;
                $shop_renewal_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $shop_renewal_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $shop_renewal_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $shop_renewal_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FOURTYTWO, $shop_renewal_id, $ex_em_data['district'], $ex_em_data['total_fees'], $shop_renewal_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $shop_renewal_data['user_payment_type'] = $user_payment_type;
            } else {
                $shop_renewal_data['user_payment_type'] = VALUE_ZERO;
            }
            $shop_renewal_data['updated_by'] = $user_id;
            $shop_renewal_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('shop_renewal_id', $shop_renewal_id, 'shop_renewal', $shop_renewal_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($shop_renewal_data['status']) ? $shop_renewal_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $shop_renewal_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $shop_renewal_data['user_payment_type'] == VALUE_THREE) {
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
            $shop_renewal_id = get_from_post('shop_renewal_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $shop_renewal_id == null || !$shop_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('shop_renewal_id', $shop_renewal_id, 'shop_renewal');
            if (empty($ex_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            if ($ex_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $shop_data = array();
            $shop_renewal_data = array();
            $temp_shop_renewal_data = array();
            if ($ex_data['shop_id'] != VALUE_ZERO) {
                $shop_data = $this->utility_model->get_by_id('s_id', $ex_data['shop_id'], 'shop', 'user_id', $ex_data['user_id']);
                if (empty($shop_data)) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return false;
                }
                $temp_shop_renewal_data = $this->shop_renewal_model->get_result_data_by_id_shop_renewal('shop_id', $ex_data['shop_id'], 'shop_renewal', 'user_id', $ex_data['user_id']);
                $temp_array = array();
                $shop_renewal_data = array_merge($temp_array, $temp_shop_renewal_data);
            } else {
                if ($ex_data['parent_id'] != VALUE_ZERO) {
                    $temp_shop_renewal_data = $this->shop_renewal_model->get_result_data_by_id_shop_renewal('user_id', $ex_data['user_id'], 'shop_renewal', 'parent_id', $ex_data['parent_id']);

                    $temp_array = array();
                    $ex_parent_data = $this->utility_model->get_by_id('shop_renewal_id', $ex_data['parent_id'], 'shop_renewal', 'user_id', $ex_data['user_id']);
                    array_push($temp_array, $ex_parent_data);
                    $shop_renewal_data = array_merge($temp_array, $temp_shop_renewal_data);
                } else {
                    array_push($shop_renewal_data, $ex_data);
                    $temp_shop_renewal_data = $this->shop_renewal_model->get_result_data_by_id_shop_renewal('parent_id', $ex_data['shop_renewal_id'], 'shop_renewal', 'user_id', $ex_data['user_id']);
                    $shop_renewal_data = array_merge($shop_renewal_data, $temp_shop_renewal_data);
                }
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_shop_renewal($shop_renewal_data, $shop_data, $ex_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_shoprenewal_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $shop_renewal_id = get_from_post('shop_renewal_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $shop_renewal_data = $this->utility_model->upload_document('seal_and_stamp_for_shoprenewal', 'shop', 'signatur_', 'signature');
            }
            if (!$shop_renewal_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$shop_renewal_id) {
                $shop_renewal_data['user_id'] = $session_user_id;
                $shop_renewal_data['status'] = VALUE_ONE;
                $shop_renewal_data['created_by'] = $session_user_id;
                $shop_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $shop_renewal_id = $this->utility_model->insert_data('shop_renewal', $shop_renewal_data);
            } else {
                $shop_renewal_data['updated_by'] = $session_user_id;
                $shop_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('shop_renewal_id', $shop_renewal_id, 'shop_renewal', $shop_renewal_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['shop_renewal_data'] = $shop_renewal_data;
            $success_array['shop_renewal_id'] = $shop_renewal_id;
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