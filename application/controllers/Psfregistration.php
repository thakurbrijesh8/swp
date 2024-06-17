<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Psfregistration extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_psfregistration_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['psfregistration_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['psfregistration_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'psf_registration', 'district', $search_district, 'psfregistration_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['psfregistration_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['wmregistration_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_psfregistration_data_by_id() {
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
            $psfregistration_id = get_from_post('psfregistration_id');
            if (!$psfregistration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $psfregistration_data = $this->utility_model->get_by_id('psfregistration_id', $psfregistration_id, 'psf_registration');
            if (empty($psfregistration_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['psfregistration_data'] = $psfregistration_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_psfregistration() {
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
            $psfregistration_id = get_from_post('psfregistration_id');
            $psfregistration_data = $this->_get_post_data_for_psfregistration();
            $validation_message = $this->_check_validation_for_psfregistration($psfregistration_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $this->db->trans_start();
            // $psfregistration_data['proprietor_details'] = $proprietorData;
            $psfregistration_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $psfregistration_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$psfregistration_id || $psfregistration_id == NULL) {
                $psfregistration_data['user_id'] = $user_id;
                $psfregistration_data['created_by'] = $user_id;
                $psfregistration_data['created_time'] = date('Y-m-d H:i:s');
                $psfregistration_id = $this->utility_model->insert_data('psf_registration', $psfregistration_data);
            } else {
                $psfregistration_data['updated_by'] = $user_id;
                $psfregistration_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', $psfregistration_data);
            }

            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_SEVEN, $psfregistration_id);
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

    function _get_post_data_for_psfregistration() {
        $psfregistration_data = array();
        $psfregistration_data['district'] = get_from_post('district');
        $psfregistration_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $psfregistration_data['firm_name'] = get_from_post('firm_name');
        $psfregistration_data['email'] = get_from_post('email');
        $psfregistration_data['principal_address'] = get_from_post('principal_address');
        $psfregistration_data['other_address'] = get_from_post('other_address');
        $psfregistration_data['firm_duration'] = get_from_post('firm_duration');
        $psfregistration_data['import_from_outside'] = get_from_post('import_from_outside');
        $psfregistration_data['import_from_outside_ret'] = get_from_post('import_from_outside_ret');
        $psfregistration_data['aadharcard_all_parties'] = get_from_post('aadharcard_all_parties');
        $psfregistration_data['pancard_all_parties'] = get_from_post('pancard_all_parties');
        $psfregistration_data['alteration_name_firm'] = get_from_post('alteration_name_firm');
        return $psfregistration_data;
    }

    function _check_validation_for_psfregistration($psfregistration_data) {
        if (!$psfregistration_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$psfregistration_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$psfregistration_data['firm_name']) {
            return FIRM_NAME_MESSAGE;
        }
        if (!$psfregistration_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$psfregistration_data['principal_address']) {
            return PRINCIPAL_ADDRESS_MESSAGE;
        }
        // if (!$psfregistration_data['other_address']) {
        //     return OTHER_ADDRESS_MESSAGE;
        // }



        return '';
    }

    function remove_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $psfregistration_id = get_from_post('psfregistration_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$psfregistration_id || $psfregistration_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('psfregistration_id', $psfregistration_id, 'psf_registration');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['application_of_firm_document'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['formII_document'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['partnership_deed'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['aadharcard'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['pancard'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['alteration_name_firm_doc'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['retirement_form'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }



            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('application_of_firm_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('formII_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('partnership_deed' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('aadharcard' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('pancard' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('alteration_name_firm_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('retirement_form' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $psfregistration_id = get_from_post('psfregistration_id_for_psfregistration_form1');
            if (!is_post() || $user_id == null || !$user_id || $psfregistration_id == null || !$psfregistration_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_psfregistration_data = $this->utility_model->get_by_id('psfregistration_id', $psfregistration_id, 'psf_registration');

            if (empty($existing_psfregistration_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('psfregistration_data' => $existing_psfregistration_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('psfregistration/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_psfregistration_data_by_psfregistration_id() {
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
            $psfregistration_id = get_from_post('psfregistration_id');
            if (!$psfregistration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $psfregistration_data = $this->utility_model->get_by_id('psfregistration_id', $psfregistration_id, 'psf_registration');
            if (empty($psfregistration_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_SEVEN, $psfregistration_id, $psfregistration_data);
            $psfregistration_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_SEVEN, 'fees_bifurcation', 'module_id', $psfregistration_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['psfregistration_data'] = $psfregistration_data;
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
            $psfregistration_id = get_from_post('psfregistration_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$psfregistration_id || $psfregistration_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('psfregistration_id', $psfregistration_id, 'psf_registration');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'psfregistration' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $psfregistration_id = get_from_post('psfregistration_id_for_psfregistration_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $psfregistration_id == NULL || !$psfregistration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('psfregistration_id', $psfregistration_id, 'psf_registration');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_psfregistration_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $psfregistration_data = array();
            if ($_FILES['fees_paid_challan_for_psfregistration_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'psfregistration';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_psfregistration_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_psfregistration_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $psfregistration_data['status'] = VALUE_FOUR;
                $psfregistration_data['fees_paid_challan'] = $filename;
                $psfregistration_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $psfregistration_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $psfregistration_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $psfregistration_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_SEVEN, $psfregistration_id, $ex_em_data['district'], $ex_em_data['total_fees'], $psfregistration_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $psfregistration_data['user_payment_type'] = $user_payment_type;
            } else {
                $psfregistration_data['user_payment_type'] = VALUE_ZERO;
            }
            $psfregistration_data['updated_by'] = $user_id;
            $psfregistration_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', $psfregistration_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($psfregistration_data['status']) ? $psfregistration_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $psfregistration_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $psfregistration_data['user_payment_type'] == VALUE_THREE) {
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
            $psfregistration_id = get_from_post('psfregistration_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $psfregistration_id == null || !$psfregistration_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_psfregistration_data = $this->utility_model->get_by_id('psfregistration_id', $psfregistration_id, 'psf_registration');
            if (empty($existing_psfregistration_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_psfregistration_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_psfregistration($existing_psfregistration_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_psfregistration_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $psfregistration_id = get_from_post('psfregistration_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $psfregistration_data = $this->utility_model->upload_document('application_of_firm_document_for_psfregistration', 'psfregistration', 'application_of_firm_document_', 'application_of_firm_document');
            }
            if ($file_no == VALUE_TWO) {
                $psfregistration_data = $this->utility_model->upload_document('formII_document_for_psfregistration', 'psfregistration', 'formII_document_', 'formII_document');
            }
            if ($file_no == VALUE_THREE) {
                $psfregistration_data = $this->utility_model->upload_document('partnership_deed_for_psfregistration', 'psfregistration', 'partnership_deed_', 'partnership_deed');
            }
            if ($file_no == VALUE_FOUR) {
                $psfregistration_data = $this->utility_model->upload_document('aadharcard_for_psfregistration', 'psfregistration', 'aadharcard_', 'aadharcard');
            }
            if ($file_no == VALUE_FIVE) {
                $psfregistration_data = $this->utility_model->upload_document('pancard_for_psfregistration', 'psfregistration', 'pancard_', 'pancard');
            }
            if ($file_no == VALUE_SIX) {
                $psfregistration_data = $this->utility_model->upload_document('alteration_name_firm_doc_for_psfregistration', 'psfregistration', 'alteration_name_firm_doc_', 'alteration_name_firm_doc');
            }
            if ($file_no == VALUE_SEVEN) {
                $psfregistration_data = $this->utility_model->upload_document('retirement_form_for_psfregistration', 'psfregistration', 'retirement_form_', 'retirement_form');
            }
            if ($file_no == VALUE_EIGHT) {
                $psfregistration_data = $this->utility_model->upload_document('seal_and_stamp_for_psfregistration', 'psfregistration', 'signature_', 'signature');
            }
            if (!$psfregistration_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$psfregistration_id) {
                $psfregistration_data['user_id'] = $session_user_id;
                $psfregistration_data['status'] = VALUE_ONE;
                $psfregistration_data['created_by'] = $session_user_id;
                $psfregistration_data['created_time'] = date('Y-m-d H:i:s');
                $psfregistration_id = $this->utility_model->insert_data('psf_registration', $psfregistration_data);
            } else {
                $psfregistration_data['updated_by'] = $session_user_id;
                $psfregistration_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('psfregistration_id', $psfregistration_id, 'psf_registration', $psfregistration_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['psfregistration_data'] = $psfregistration_data;
            $success_array['psfregistration_id'] = $psfregistration_id;
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