<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_renewal extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_hotel_renewal_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['hotel_renewal_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['hotel_renewal_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'hotel_renewal', 'name_of_tourist_area', $search_district, 'hotel_renewal_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['hotel_renewal_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['hotel_renewal_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_hotel_data_by_id() {
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
            $hotel_data = $this->utility_model->get_by_id('registration_number', $license_number, 'hotel');
            // if (empty($hotel_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['hotel_data'] = $hotel_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_hotel_renewal_data_by_id() {
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id');
            if (!$hotel_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $hotel_renewal_data = $this->utility_model->get_by_id('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal');
            if (empty($hotel_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['hotel_renewal_data'] = $hotel_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_hotel_renewal() {
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id');
            $hotel_renewal_data = $this->_get_post_data_for_hotel();
            $validation_message = $this->_check_validation_for_hotel($hotel_renewal_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $newEmployeesData = $this->input->post('newemployees_data');
            $employees_decode_Data = json_decode($newEmployeesData, true);

            $this->db->trans_start();
            $hotel_renewal_data['new_employees_details'] = $newEmployeesData;
            $hotel_renewal_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $hotel_renewal_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$hotel_renewal_id || $hotel_renewal_id == NULL) {
                $hotel_renewal_data['user_id'] = $user_id;
                $hotel_renewal_data['created_by'] = $user_id;
                $hotel_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $hotel_renewal_id = $this->utility_model->insert_data('hotel_renewal', $hotel_renewal_data);
            } else {
                $hotel_renewal_data['updated_by'] = $user_id;
                $hotel_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal', $hotel_renewal_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTY, $hotel_renewal_id);
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

    function _get_post_data_for_hotel() {
        $hotel_renewal_data = array();
        $hotel_renewal_data['hotelregi_id'] = get_from_post('hotelregi_id');
        $hotel_renewal_data['name_of_hotel'] = get_from_post('name_of_hotel');
        $hotel_renewal_data['registration_number'] = get_from_post('registration_number');
        $hotel_renewal_data['name_of_proprietor'] = get_from_post('name_of_proprietor');
        $hotel_renewal_data['last_valid_upto'] = convert_to_mysql_date_format(get_from_post('last_valid_upto'));
        $hotel_renewal_data['fees'] = get_from_post('fees');
        $hotel_renewal_data['mob_no'] = get_from_post('mob_no');
        $hotel_renewal_data['name_of_tourist_area'] = get_from_post('name_of_tourist_area');
        $hotel_renewal_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        return $hotel_renewal_data;
    }

    function _check_validation_for_hotel($hotel_renewal_data) {
        if (!$hotel_renewal_data['name_of_hotel']) {
            return HOTEL_NAME_MESSAGE;
        }
        if (!$hotel_renewal_data['name_of_proprietor']) {
            return PROPRIETOR_NAME_MESSAGE;
        }
        if (!$hotel_renewal_data['last_valid_upto']) {
            return DATE_MESSAGE;
        }
        if (!$hotel_renewal_data['mob_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$hotel_renewal_data['name_of_tourist_area']) {
            return TOURIST_AREA_NAME_MESSAGE;
        }
        if (!$hotel_renewal_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$hotel_renewal_id || $hotel_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['noc_fire'];
            } else if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'hotelregi' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal', array('noc_fire' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id_for_hotel_renewal_form');
            if (!is_post() || $user_id == null || !$user_id || $hotel_renewal_id == null || !$hotel_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_hotel_data = $this->utility_model->get_by_id('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal');

            if (empty($existing_hotel_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('hotel_renewal_data' => $existing_hotel_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('hotel_renewal/pdf', $data, TRUE));
            $mpdf->Output('FORM.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_hotel_renewal_data_by_hotel_renewal_id() {
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id');
            if (!$hotel_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $hotel_renewal_data = $this->utility_model->get_by_id('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal');
            if (empty($hotel_renewal_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWENTY, $hotel_renewal_id, $hotel_renewal_data);
            $hotel_renewal_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWENTY, 'fees_bifurcation', 'module_id', $hotel_renewal_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['hotel_renewal_data'] = $hotel_renewal_data;
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$hotel_renewal_id || $hotel_renewal_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal');
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
            $this->utility_model->update_data('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id_for_hotel_renewal_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $hotel_renewal_id == NULL || !$hotel_renewal_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_hotel_renewal_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $hotel_renewal_data = array();
            if ($_FILES['fees_paid_challan_for_hotel_renewal_upload_challan']['name'] != '') {
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
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_hotel_renewal_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_hotel_renewal_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $hotel_renewal_data['status'] = VALUE_FOUR;
                $hotel_renewal_data['fees_paid_challan'] = $filename;
                $hotel_renewal_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $hotel_renewal_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $hotel_renewal_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $hotel_renewal_data['status'] = VALUE_THREE;
                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWENTY, $hotel_renewal_id, $ex_em_data['name_of_tourist_area'], $ex_em_data['total_fees'], $hotel_renewal_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $hotel_renewal_data['user_payment_type'] = $user_payment_type;
            } else {
                $hotel_renewal_data['user_payment_type'] = VALUE_ZERO;
            }
            $hotel_renewal_data['updated_by'] = $user_id;
            $hotel_renewal_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal', $hotel_renewal_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($hotel_renewal_data['status']) ? $hotel_renewal_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $hotel_renewal_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $hotel_renewal_data['user_payment_type'] == VALUE_THREE) {
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
            $hotel_renewal_id = get_from_post('hotel_renewal_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $hotel_renewal_id == null || !$hotel_renewal_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_hotel_renewal_data = $this->utility_model->get_by_id('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal');
            if (empty($existing_hotel_renewal_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_hotel_renewal_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_hotel_renewal($existing_hotel_renewal_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_hotel_renewal_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $hotel_renewal_id = get_from_post('hotel_renewal_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $hotel_renewal_data = $this->utility_model->upload_document('noc_fire_for_hotelrenewal', 'hotelregi', 'noc_fire_', 'noc_fire');
            }
            if ($file_no == VALUE_TWO) {
                $hotel_renewal_data = $this->utility_model->upload_document('seal_and_stamp_for_hotelrenewal', 'hotelregi', 'signatur_', 'signature');
            }
            if (!$hotel_renewal_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$hotel_renewal_id) {
                $hotel_renewal_data['user_id'] = $session_user_id;
                $hotel_renewal_data['status'] = VALUE_ONE;
                $hotel_renewal_data['created_by'] = $session_user_id;
                $hotel_renewal_data['created_time'] = date('Y-m-d H:i:s');
                $hotel_renewal_id = $this->utility_model->insert_data('hotel_renewal', $hotel_renewal_data);
            } else {
                $hotel_renewal_data['updated_by'] = $session_user_id;
                $hotel_renewal_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('hotel_renewal_id', $hotel_renewal_id, 'hotel_renewal', $hotel_renewal_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['hotel_renewal_data'] = $hotel_renewal_data;
            $success_array['hotel_renewal_id'] = $hotel_renewal_id;
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