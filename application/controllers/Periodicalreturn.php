<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Periodicalreturn extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_periodicalreturn_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['periodicalreturn_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['periodicalreturn_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'periodicalreturn', 'district', $search_district, 'periodicalreturn_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['periodicalreturn_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['periodicalreturn_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_periodicalreturn_data_by_id() {
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
            $periodicalreturn_id = get_from_post('periodicalreturn_id');
            if (!$periodicalreturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $periodicalreturn_data = $this->utility_model->get_by_id('periodicalreturn_id', $periodicalreturn_id, 'periodicalreturn');
            if (empty($periodicalreturn_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['periodicalreturn_data'] = $periodicalreturn_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_periodicalreturn() {
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
            $periodicalreturn_id = get_from_post('periodicalreturn_id');
            $periodicalreturn_data = $this->_get_post_data_for_periodicalreturn();
            // $validation_message = $this->_check_validation_for_periodicalreturn($periodicalreturn_data);
            // if ($validation_message != '') {
            //     echo json_encode(get_error_array($validation_message));
            //     return false;
            // }
            $proprietorData = $this->input->post('proprietor_data');
            $proprietor_decode_Data = json_decode($proprietorData, true);
            // if ($proprietorData == "" || empty($proprietor_decode_Data)) {
            //     echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
            //     return false;
            // }
            $otherData = $this->input->post('other_data');
            $other_decode_Data = json_decode($otherData, true);
            // if ($otherData == "" || empty($other_decode_Data)) {
            //     echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
            //     return false;
            // }
            $manufacturerData = $this->input->post('manufacturer_data');
            $manufacturer_decode_Data = json_decode($manufacturerData, true);
            // if ($manufacturerData == "" || empty($manufacturer_decode_Data)) {
            //     echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
            //     return false;
            // }
            $manufacturertwoData = $this->input->post('manufacturertwo_data');
            $manufacturertwo_decode_Data = json_decode($manufacturertwoData, true);
            // if ($lrdetailData == "" || empty($lrdetail_decode_Data)) {
            //     echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
            //     return false;
            // }
            $repairerData = $this->input->post('repairer_data');
            $repairer_decode_Data = json_decode($repairerData, true);

            $this->db->trans_start();


            $periodicalreturn_data['applicant_licence_date'] = convert_to_mysql_date_format($periodicalreturn_data['applicant_licence_date']);
            $periodicalreturn_data['proprietor_details'] = $proprietorData;
            $periodicalreturn_data['other_details'] = $otherData;
            $periodicalreturn_data['manufacturer_details'] = $manufacturerData;
            $periodicalreturn_data['manufacturertwo_details'] = $manufacturertwoData;
            $periodicalreturn_data['repairer_details'] = $repairerData;
            $periodicalreturn_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $periodicalreturn_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$periodicalreturn_id || $periodicalreturn_id == NULL) {
                $periodicalreturn_data['user_id'] = $user_id;
                $periodicalreturn_data['created_by'] = $user_id;
                $periodicalreturn_data['created_time'] = date('Y-m-d H:i:s');
                $periodicalreturn_id = $this->utility_model->insert_data('periodicalreturn', $periodicalreturn_data);
            } else {
                $periodicalreturn_data['updated_by'] = $user_id;
                $periodicalreturn_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('periodicalreturn_id', $periodicalreturn_id, 'periodicalreturn', $periodicalreturn_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_FIFTY, $periodicalreturn_id);
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

    function _get_post_data_for_periodicalreturn() {
        $periodicalreturn_data = array();
        $periodicalreturn_data['district'] = get_from_post('district');
        $periodicalreturn_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $periodicalreturn_data['application_category'] = get_from_post('application_category');
        $periodicalreturn_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $periodicalreturn_data['applicant_address'] = get_from_post('applicant_address');
        $periodicalreturn_data['applicant_licence_no'] = get_from_post('applicant_licence_no');
        $periodicalreturn_data['applicant_licence_date'] = get_from_post('applicant_licence_date');
        $periodicalreturn_data['description_wm'] = get_from_post('description_wm');
        $periodicalreturn_data['period_validity_licence'] = get_from_post('period_validity_licence');
        $periodicalreturn_data['suspending_revoke'] = get_from_post('suspending_revoke');
        $periodicalreturn_data['category_of_wm'] = get_from_post('category_of_wm');
        return $periodicalreturn_data;
    }

    function _check_validation_for_periodicalreturn($periodicalreturn_data) {
        if (!$periodicalreturn_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$periodicalreturn_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$periodicalreturn_data['application_category']) {
            return SELECT_APPLICATIN_CATEGORY;
        }
        if (!$periodicalreturn_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$periodicalreturn_data['applicant_address']) {
            return APPLICANT_ADDRESS_MESSAGE;
        }
        if (!$periodicalreturn_data['applicant_licence_no']) {
            return LICENSE_NUMBER_MESSAGE;
        }

        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $periodicalreturn_id = get_from_post('periodicalreturn_id_for_periodicalreturn_form1');
            if (!is_post() || $user_id == null || !$user_id || $periodicalreturn_id == null || !$periodicalreturn_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_periodicalreturn_data = $this->utility_model->get_by_id('periodicalreturn_id ', $periodicalreturn_id, 'periodicalreturn');

            if (empty($existing_periodicalreturn_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('periodicalreturn_data' => $existing_periodicalreturn_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('periodicalreturn/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_periodicalreturn_data_by_periodicalreturn_id() {
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
            $periodicalreturn_id = get_from_post('periodicalreturn_id');
            if (!$periodicalreturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $periodicalreturn_data = $this->utility_model->get_by_id('periodicalreturn_id', $periodicalreturn_id, 'periodicalreturn');
            if (empty($periodicalreturn_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            //$periodicalreturn_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FIFTY, 'fees_bifurcation', 'module_id', $periodicalreturn_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['periodicalreturn_data'] = $periodicalreturn_data;
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
            $periodicalreturn_id = get_from_post('periodicalreturn_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$periodicalreturn_id || $periodicalreturn_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('periodicalreturn_id', $periodicalreturn_id, 'periodicalreturn');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'periodicalreturn' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('periodicalreturn_id', $periodicalreturn_id, 'periodicalreturn', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $periodicalreturn_id = get_from_post('periodicalreturn_id_for_periodicalreturn_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $periodicalreturn_id == NULL || !$periodicalreturn_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('periodicalreturn_id ', $periodicalreturn_id, 'periodicalreturn');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_periodicalreturn_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $periodicalreturn_data = array();
            if ($_FILES['fees_paid_challan_for_periodicalreturn_upload_challan']['name'] != '') {
                $main_path = 'documents/periodicalreturn';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'periodicalreturn';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_periodicalreturn_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_periodicalreturn_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $periodicalreturn_data['status'] = VALUE_FOUR;
                $periodicalreturn_data['fees_paid_challan'] = $filename;
                $periodicalreturn_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                if ($user_payment_type == VALUE_TWO) {
                    $periodicalreturn_data['status'] = VALUE_EIGHT;
                } else {
                    $periodicalreturn_data['status'] = VALUE_FOUR;
                }
                $periodicalreturn_data['user_payment_type'] = $user_payment_type;
            } else {
                $periodicalreturn_data['user_payment_type'] = VALUE_ZERO;
            }
            $periodicalreturn_data['updated_by'] = $user_id;
            $periodicalreturn_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('periodicalreturn_id ', $periodicalreturn_id, 'periodicalreturn', $periodicalreturn_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($periodicalreturn_data['status']) ? $periodicalreturn_data['status'] : $ex_em_data['status'];
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
            $periodicalreturn_id = get_from_post('periodicalreturn_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $periodicalreturn_id == null || !$periodicalreturn_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_periodicalreturn_data = $this->utility_model->get_by_id('periodicalreturn_id ', $periodicalreturn_id, 'periodicalreturn');
            if (empty($existing_periodicalreturn_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_periodicalreturn_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $this->utility_lib->gc_for_periodicalreturn($existing_periodicalreturn_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/BOCW.php
 */