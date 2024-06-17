<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tree_cutting extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_tree_cutting_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['tree_cutting_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['tree_cutting_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'tree_cutting', 'district', $search_district, 'tree_cutting_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['tree_cutting_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['tree_cutting_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_tree_cutting_data_by_id() {
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
            $tree_cutting_id = get_from_post('tree_cutting_id');
            if (!$tree_cutting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $tree_cutting_data = $this->utility_model->get_by_id('tree_cutting_id', $tree_cutting_id, 'tree_cutting');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($tree_cutting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $is_edit = get_from_post('is_edit');
            if ($is_edit == VALUE_ZERO) {
                if ($tree_cutting_data['status'] != VALUE_ZERO && $tree_cutting_data['status'] != VALUE_ONE) {
                    if ($tree_cutting_data['status'] == VALUE_FIVE || $tree_cutting_data['status'] == VALUE_SIX || $tree_cutting_data['query_status'] != VALUE_ONE) {
                        echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                        return false;
                    }
                }
            }
            $success_array = get_success_array();
            $tree_cutting_data['m_doc'] = generate_array_for_id_object($this->utility_model->get_result_data_by_id('module_type', VALUE_FIFTYNINE, 'module_documents', 'module_id', $tree_cutting_id), 'doc_id');
            $tree_cutting_data['m_other_doc'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FIFTYNINE, 'module_other_documents', 'module_id', $tree_cutting_id);
            $success_array['tree_cutting_data'] = $tree_cutting_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_tree_cutting() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO &&
                    $module_type != VALUE_FIVE)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $tree_cutting_id = get_from_post('tree_cutting_id_for_tree_cutting');
            $tree_cutting_data = $this->_get_post_data_for_tree_cutting();
            $validation_message = $this->_check_validation_for_tree_cutting($tree_cutting_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $is_validation = $this->utility_lib->app_edit_and_query_response($session_user_id, $module_type, VALUE_FIFTYNINE, $tree_cutting_id, $tree_cutting_data);
            if ($is_validation != '') {
                echo json_encode(get_error_array($is_validation));
                return false;
            }
            $this->db->trans_start();
            if (!$tree_cutting_id || $tree_cutting_id == NULL) {
                $tree_cutting_data['user_id'] = $session_user_id;
                $tree_cutting_data['created_by'] = $session_user_id;
                $tree_cutting_data['created_time'] = date('Y-m-d H:i:s');
                $tree_cutting_id = $this->utility_model->insert_data('tree_cutting', $tree_cutting_data);
            } else {
                $tree_cutting_data['updated_by'] = $session_user_id;
                $tree_cutting_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('tree_cutting_id', $tree_cutting_id, 'tree_cutting', $tree_cutting_data);
            }

            $this->utility_lib->update_module_other_document_items($session_user_id, VALUE_FIFTYNINE, $tree_cutting_id);

            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($session_user_id, VALUE_SIX, VALUE_FIFTYNINE, $tree_cutting_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $module_type == VALUE_FIVE ? APP_SUBMITTED_QR_MESSAGE : ($module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE);
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_tree_cutting() {
        $tree_cutting_data = array();
        $tree_cutting_data['district'] = get_from_post('district_for_tree_cutting');
        $tree_cutting_data['village_dmc_ward'] = get_from_post('village_dmc_ward_for_tree_cutting');
        $tree_cutting_data['entity_establishment_type'] = get_from_post('entity_establishment_type_for_tree_cutting');
        $tree_cutting_data['applicant_name'] = get_from_post('applicant_name_for_tree_cutting');
        $tree_cutting_data['applicant_address'] = get_from_post('applicant_address_for_tree_cutting');
        $tree_cutting_data['applicant_mobile_number'] = get_from_post('applicant_mobile_number_for_tree_cutting');
        $tree_cutting_data['owner_name'] = get_from_post('owner_name_for_tree_cutting');
        $tree_cutting_data['owner_address'] = get_from_post('owner_address_for_tree_cutting');
        return $tree_cutting_data;
    }

    function _check_validation_for_tree_cutting($tree_cutting_data) {
        if (!$tree_cutting_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$tree_cutting_data['village_dmc_ward'] || !$tree_cutting_data['entity_establishment_type']) {
            return ONE_OPTION_MESSAGE;
        }
        if (!$tree_cutting_data['applicant_name']) {
            return NAME_MESSAGE;
        }
        if (!$tree_cutting_data['applicant_address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$tree_cutting_data['applicant_mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$tree_cutting_data['owner_name']) {
            return OWNER_NAME_MESSAGE;
        }
        if (!$tree_cutting_data['owner_address']) {
            return OWNER_ADDRESS_MESSAGE;
        }
        return '';
    }

    function get_tree_cutting_data_by_tree_cutting_id() {
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
            $tree_cutting_id = get_from_post('tree_cutting_id');
            if (!$tree_cutting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $tree_cutting_data = $this->utility_model->get_by_id('tree_cutting_id', $tree_cutting_id, 'tree_cutting');
            if (empty($tree_cutting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_FIFTYNINE, $tree_cutting_id, $tree_cutting_data);
            $tree_cutting_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_FIFTYNINE, 'fees_bifurcation', 'module_id', $tree_cutting_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['tree_cutting_data'] = $tree_cutting_data;
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
            $tree_cutting_id = get_from_post('tree_cutting_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$tree_cutting_id || $tree_cutting_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('tree_cutting_id', $tree_cutting_id, 'tree_cutting');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'tree_cutting' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('tree_cutting_id', $tree_cutting_id, 'tree_cutting', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $tree_cutting_id = get_from_post('tree_cutting_id_for_tree_cutting_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $tree_cutting_id == NULL || !$tree_cutting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_tree_cutting_data = $this->utility_model->get_by_id('tree_cutting_id', $tree_cutting_id, 'tree_cutting');
            if (empty($ex_tree_cutting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_tree_cutting_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_tree_cutting_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_tree_cutting_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $tree_cutting_data = array();
            if ($_FILES['fees_paid_challan_for_tree_cutting_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'tree_cutting';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_tree_cutting_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_tree_cutting_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $tree_cutting_data['status'] = VALUE_FOUR;
                $tree_cutting_data['fees_paid_challan'] = $filename;
                $tree_cutting_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_tree_cutting_data['payment_type'] == VALUE_TWO) {
                $tree_cutting_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $tree_cutting_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $tree_cutting_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_FIFTYNINE, $tree_cutting_id, $ex_tree_cutting_data['district'], $ex_tree_cutting_data['total_fees'], $tree_cutting_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $tree_cutting_data['user_payment_type'] = $user_payment_type;
            } else {
                $tree_cutting_data['user_payment_type'] = VALUE_ZERO;
            }
            $tree_cutting_data['updated_by'] = $user_id;
            $tree_cutting_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('tree_cutting_id', $tree_cutting_id, 'tree_cutting', $tree_cutting_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($tree_cutting_data['status']) ? $tree_cutting_data['status'] : $ex_tree_cutting_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_tree_cutting_data['payment_type'];
            $success_array['user_payment_type'] = $tree_cutting_data['user_payment_type'];
            if ($ex_tree_cutting_data['payment_type'] == VALUE_TWO && $tree_cutting_data['user_payment_type'] == VALUE_THREE) {
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
}

/*
 * EOF: ./application/controller/Tree_cutting.php
 */
