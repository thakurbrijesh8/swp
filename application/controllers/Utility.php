<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
        $this->load->model('payment_model');
    }

    function generate_new_token() {
        if (!is_post()) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        echo json_encode(get_success_array());
    }

    function get_query_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            if ($module_type == VALUE_FIFTYTWO) {
                $module_data = $this->utility_model->get_incentive_details_by_id($module_id);
            } else {
                $module_data = $this->utility_model->get_by_id($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text']);
            }
            if (empty($module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_query_data = $this->utility_model->query_data_by_type_id($module_type, $module_id);
            $query_data = array();
            foreach ($temp_query_data as $qd_data) {
                if (!isset($query_data[$qd_data['query_id']])) {
                    $query_data[$qd_data['query_id']] = array();
                    $query_data[$qd_data['query_id']]['query_id'] = $qd_data['query_id'];
                    $query_data[$qd_data['query_id']]['module_type'] = $qd_data['module_type'];
                    $query_data[$qd_data['query_id']]['module_id'] = $qd_data['module_id'];
                    $query_data[$qd_data['query_id']]['query_type'] = $qd_data['query_type'];
                    $query_data[$qd_data['query_id']]['user_id'] = $qd_data['user_id'];
                    $query_data[$qd_data['query_id']]['remarks'] = $qd_data['remarks'];
                    $query_data[$qd_data['query_id']]['display_datetime'] = $qd_data['display_datetime'];
                    $query_data[$qd_data['query_id']]['status'] = $qd_data['status'];
                    $query_data[$qd_data['query_id']]['query_documents'] = array();
                }
                if ($qd_data['query_document_id']) {
                    $tmp_doc = array();
                    $tmp_doc['query_document_id'] = $qd_data['query_document_id'];
                    $tmp_doc['doc_name'] = $qd_data['doc_name'];
                    $tmp_doc['document'] = $qd_data['document'];
                    array_push($query_data[$qd_data['query_id']]['query_documents'], $tmp_doc);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['module_data'] = $module_data;
            $success_array['query_data'] = $query_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function answer_a_query() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type_for_query_answer');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE && $module_type != VALUE_FOUR &&
                    $module_type != VALUE_FIVE && $module_type != VALUE_SIX && $module_type != VALUE_SEVEN && $module_type != VALUE_EIGHT && $module_type != VALUE_NINE && $module_type != VALUE_TEN && $module_type != VALUE_ELEVEN && $module_type != VALUE_TWELVE && $module_type != VALUE_THIRTEEN && $module_type != VALUE_FOURTEEN && $module_type != VALUE_FIFTEEN && $module_type != VALUE_SIXTEEN && $module_type != VALUE_SEVENTEEN && $module_type != VALUE_EIGHTEEN &&
                    $module_type != VALUE_NINETEEN && $module_type != VALUE_TWENTY && $module_type != VALUE_TWENTYONE && $module_type != VALUE_TWENTYTWO && $module_type != VALUE_TWENTYTHREE && $module_type != VALUE_TWENTYFOUR && $module_type != VALUE_TWENTYFIVE && $module_type != VALUE_TWENTYSIX && $module_type != VALUE_TWENTYSEVEN && $module_type != VALUE_TWENTYEIGHT && $module_type != VALUE_TWENTYNINE && $module_type != VALUE_THIRTY && $module_type != VALUE_THIRTYONE && $module_type != VALUE_THIRTYTWO &&
                    $module_type != VALUE_THIRTYTHREE && $module_type != VALUE_THIRTYFOUR && $module_type != VALUE_THIRTYFIVE && $module_type != VALUE_THIRTYSIX && $module_type != VALUE_THIRTYSEVEN && $module_type != VALUE_THIRTYEIGHT && $module_type != VALUE_THIRTYNINE && $module_type != VALUE_FOURTY && $module_type != VALUE_FOURTYONE && $module_type != VALUE_FOURTYTWO && $module_type != VALUE_FOURTYTHREE && $module_type != VALUE_FOURTYFOUR && $module_type != VALUE_FOURTYFIVE && $module_type != VALUE_FOURTYSIX &&
                    $module_type != VALUE_FOURTYEIGHT && $module_type != VALUE_FOURTYNINE && $module_type != VALUE_FIFTY && $module_type != VALUE_FIFTYTWO && $module_type != VALUE_FIFTYNINE && $module_type != VALUE_SIXTY && $module_type != VALUE_SIXTYONE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id_for_query_answer');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_type = get_from_post('query_type_for_query_answer');
            if ($query_type != VALUE_ONE && $query_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $remarks = get_from_post('remarks_for_query_answer');
            if (!$remarks) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_id = get_from_post('query_id_for_query_answer');
            $this->db->trans_start();
            $iu_data = array();
            $iu_data['remarks'] = $remarks;
            $iu_data['status'] = VALUE_ONE;
            if (!$query_id || $query_id == NULL) {
                $iu_data['module_type'] = $module_type;
                $iu_data['module_id'] = $module_id;
                $iu_data['query_type'] = $query_type;
                $iu_data['user_id'] = $session_user_id;
                $iu_data['created_by'] = $session_user_id;
                $iu_data['created_time'] = date('Y-m-d H:i:s');
                $iu_data['query_datetime'] = $iu_data['created_time'];
                $iu_data['query_id'] = $this->utility_model->insert_data('query', $iu_data);
            } else {
                $iu_data['updated_by'] = $session_user_id;
                $iu_data['updated_time'] = date('Y-m-d H:i:s');
                $iu_data['query_datetime'] = $iu_data['updated_time'];
                $this->utility_model->update_data('query_id', $query_id, 'query', $iu_data);
                $iu_data['query_id'] = $query_id;
            }

            $this->_update_qd_items($session_user_id, $query_id);

            $update_data = array();
            $update_data['query_status'] = VALUE_TWO;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = $iu_data['query_datetime'];
            $this->utility_model->update_data($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text'], $update_data);

            $qd_data = $this->utility_model->get_result_data_by_id('query_id', $query_id, 'query_document');

            $this->utility_lib->send_email_for_query_response($temp_access_data, $module_id, $module_type, $session_user_id);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = QUERY_RESPONDED_MESSAGE;
            $success_array['query_status'] = VALUE_TWO;
            $success_array['query_datetime'] = convert_to_new_datetime_format($iu_data['query_datetime']);
            $success_array['query_document_data'] = $qd_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _update_qd_items($user_id, $query_id) {
        $exi_qd_items = $this->input->post('exi_qd_items');
        if ($exi_qd_items != '') {
            if (!empty($exi_qd_items)) {
                foreach ($exi_qd_items as &$value) {
                    $value['query_id'] = $query_id;
                    $value['updated_by'] = $user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('query_document_id', 'query_document', $exi_qd_items);
            }
        }
        $new_qd_items = $this->input->post('new_qd_items');
        if ($new_qd_items != '') {
            if (!empty($new_qd_items)) {
                foreach ($new_qd_items as &$value) {
                    $value['query_id'] = $query_id;
                    $value['created_by'] = $user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('query_document', $new_qd_items);
            }
        }
    }

    function upload_query_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $query_id = get_from_post('query_id_for_query_answer');
            $query_document_id = get_from_post('query_document_id_for_query_answer');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type_for_query_answer');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE && $module_type != VALUE_FOUR &&
                    $module_type != VALUE_FIVE && $module_type != VALUE_SIX && $module_type != VALUE_SEVEN && $module_type != VALUE_EIGHT && $module_type != VALUE_NINE && $module_type != VALUE_TEN && $module_type != VALUE_ELEVEN && $module_type != VALUE_TWELVE && $module_type != VALUE_THIRTEEN && $module_type != VALUE_FOURTEEN && $module_type != VALUE_FIFTEEN && $module_type != VALUE_SIXTEEN && $module_type != VALUE_SEVENTEEN && $module_type != VALUE_EIGHTEEN &&
                    $module_type != VALUE_NINETEEN && $module_type != VALUE_TWENTY && $module_type != VALUE_TWENTYONE && $module_type != VALUE_TWENTYTWO && $module_type != VALUE_TWENTYTHREE && $module_type != VALUE_TWENTYFOUR && $module_type != VALUE_TWENTYFIVE && $module_type != VALUE_TWENTYSIX && $module_type != VALUE_TWENTYSEVEN && $module_type != VALUE_TWENTYEIGHT && $module_type != VALUE_TWENTYNINE && $module_type != VALUE_THIRTY && $module_type != VALUE_THIRTYONE && $module_type != VALUE_THIRTYTWO &&
                    $module_type != VALUE_THIRTYTHREE && $module_type != VALUE_THIRTYFOUR && $module_type != VALUE_THIRTYFIVE && $module_type != VALUE_THIRTYSIX && $module_type != VALUE_THIRTYSEVEN && $module_type != VALUE_THIRTYEIGHT && $module_type != VALUE_THIRTYNINE && $module_type != VALUE_FOURTY && $module_type != VALUE_FOURTYONE && $module_type != VALUE_FOURTYTWO && $module_type != VALUE_FOURTYTHREE && $module_type != VALUE_FOURTYFOUR && $module_type != VALUE_FOURTYFIVE && $module_type != VALUE_FOURTYSIX &&
                    $module_type != VALUE_FOURTYEIGHT && $module_type != VALUE_FOURTYNINE && $module_type != VALUE_FIFTY && $module_type != VALUE_FIFTYTWO && $module_type != VALUE_FIFTYNINE && $module_type != VALUE_SIXTY && $module_type != VALUE_SIXTYONE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id_for_query_answer');
            if (!$module_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_type = get_from_post('query_type_for_query_answer');
            if ($query_type != VALUE_TWO) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }

            if ($_FILES['document_for_query_answer']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $evidence_size = $_FILES['document_for_query_answer']['size'];
            if ($evidence_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $maxsize = '209715200';
            if ($evidence_size >= $maxsize) {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_MAX_ONE_MB_MESSAGE));
                return;
            }
            $path = 'documents';
            if (!is_dir($path)) {
                mkdir($path);
                chmod("$path", 0755);
            }
            $main_path = $path . DIRECTORY_SEPARATOR . 'query';
            if (!is_dir($main_path)) {
                mkdir($main_path);
                chmod("$main_path", 0755);
            }
            $this->load->library('upload');
            $temp_qd_filename = str_replace('_', '', $_FILES['document_for_query_answer']['name']);
            $qd_filename = 'query_doc_' . (rand(10000, 99999)) . time() . '.' . pathinfo($temp_qd_filename, PATHINFO_EXTENSION);
            //Change file name
            $qd_final_path = $main_path . DIRECTORY_SEPARATOR . $qd_filename;
            if (!move_uploaded_file($_FILES['document_for_query_answer']['tmp_name'], $qd_final_path)) {
                echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $qdata = array();
            if (!$query_id || $query_id == NULL) {
                $qdata['module_type'] = $module_type;
                $qdata['module_id'] = $module_id;
                $qdata['query_type'] = $query_type;
                $qdata['user_id'] = $session_user_id;
                $qdata['created_by'] = $session_user_id;
                $qdata['created_time'] = date('Y-m-d H:i:s');
                $query_id = $this->utility_model->insert_data('query', $qdata);
            }

            $qd_data = array();
            $qd_data['document'] = $qd_filename;
            if (!$query_document_id || $query_document_id == NULL) {
                $qd_data['query_id'] = $query_id;
                $qd_data['created_by'] = $session_user_id;
                $qd_data['created_time'] = date('Y-m-d H:i:s');
                $query_document_id = $this->utility_model->insert_data('query_document', $qd_data);
            } else {
                $qd_data['updated_by'] = $session_user_id;
                $qd_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('query_document_id', $query_document_id, 'query_document', $qd_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['query_id'] = $query_id;
            $success_array['query_document_id'] = $query_document_id;
            $success_array['document_name'] = $qd_filename;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function remove_query_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $query_document_id = get_from_post('query_document_id');
            if ($session_user_id == NULL || !$session_user_id || !$query_document_id || $query_document_id == NULL) {
                echo json_encode(get_error_array('Invalid Access'));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('query_document_id', $query_document_id, 'query_document');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'query' . DIRECTORY_SEPARATOR . $ex_data['document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['document'] = '';
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('query_document_id', $query_document_id, 'query_document', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function remove_query_document_item() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $query_document_id = get_from_post('query_document_id');
            if ($session_user_id == NULL || !$session_user_id || !$query_document_id || $query_document_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('query_document_id', $query_document_id, 'query_document');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'query' . DIRECTORY_SEPARATOR . $ex_data['document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['is_delete'] = IS_DELETE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('query_document_id', $query_document_id, 'query_document', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = QUERY_DOCUMENT_ITEM_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_common_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = array();
            $success_array['success'] = true;
            $success_array['village_data'] = array();
            $success_array['plot_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $success_array['village_data'] = $this->utility_model->get_result_data('villages');
            $temp_plot_data = $this->utility_model->get_plot_result_data('plot_numbers');
            $plot_data = array();
            foreach ($temp_plot_data as $data) {
                if (!isset($plot_data[$data['village_id']])) {
                    $plot_data[$data['village_id']] = array();
                }
                if (!isset($plot_data[$data['village_id']][$data['plot_id']])) {
                    $plot_data[$data['village_id']][$data['plot_id']] = $data;
                }
            }
            $success_array['plot_data'] = $plot_data;

            $module_type_array = $this->config->item('query_module_array');
            $pending_app_for_dv = $this->payment_model->get_pending_dv_data($session_user_id);
            if (!empty($pending_app_for_dv)) {
                foreach ($pending_app_for_dv as $fp) {
                    $this->payment_lib->check_payment_dv($module_type_array, $fp);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['plot_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_dept_wise_questionary_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $success_array = array();
            $success_array['success'] = true;
            $success_array['dept_wise_questionary_data'] = array();
            $district = get_from_post('district_for_clearances');
            if ($district == NULL || !$district || ($district != TALUKA_DAMAN && $district != TALUKA_DIU && $district != TALUKA_DNH)) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $temp_questionary_data = $this->utility_model->get_district_wise_services($district);
            $questionary_data = array();
            $service_data = array();
            $questions_data = array();
            $dept_id = ($district == TALUKA_DAMAN ? 'daman' : ($district == TALUKA_DIU ? 'diu' : ($district == TALUKA_DNH ? 'dnh' : ''))) . '_department_id';
            foreach ($temp_questionary_data as $tq_data) {
                if (!isset($questionary_data[$tq_data[$dept_id]])) {
                    $questionary_data[$tq_data[$dept_id]] = array();
                }
                if (!isset($questionary_data[$tq_data[$dept_id]][$tq_data['service_id']])) {
                    $questionary_data[$tq_data[$dept_id]][$tq_data['service_id']] = $tq_data['service_id'];
                }
                if (!isset($service_data[$tq_data['service_id']])) {
                    $service_data[$tq_data['service_id']]['department_id'] = $tq_data[$dept_id];
                    $service_data[$tq_data['service_id']]['daman_department_id'] = $tq_data['daman_department_id'];
                    $service_data[$tq_data['service_id']]['diu_department_id'] = $tq_data['diu_department_id'];
                    $service_data[$tq_data['service_id']]['dnh_department_id'] = $tq_data['dnh_department_id'];
                    $service_data[$tq_data['service_id']]['service_name'] = $tq_data['service_name'];
                    $service_data[$tq_data['service_id']]['service_type'] = $tq_data['service_type'];
                    $service_data[$tq_data['service_id']]['timeline'] = $tq_data['timeline'];
                    $service_data[$tq_data['service_id']]['competent_authority'] = $tq_data['competent_authority'];
                    $service_data[$tq_data['service_id']]['first_aagr'] = $tq_data['first_aagr'];
                    $service_data[$tq_data['service_id']]['second_aagr'] = $tq_data['second_aagr'];
                    $service_data[$tq_data['service_id']]['apply_url'] = $tq_data['apply_url'];
                    $service_data[$tq_data['service_id']]['fees_details'] = $tq_data['fees_details'];
                    $service_data[$tq_data['service_id']]['document_checklist'] = $tq_data['document_checklist'];
                    $service_data[$tq_data['service_id']]['procedure'] = $tq_data['procedure'];
                    $service_data[$tq_data['service_id']]['questionary_items'] = array();
                }
                if (intval($tq_data['questionary_id']) != 0) {
                    array_push($service_data[$tq_data['service_id']]['questionary_items'], $tq_data['questionary_id']);
                    if (!isset($questions_data[$tq_data['questionary_id']])) {
                        $tmp_array = array();
                        $tmp_array['questionary_id'] = $tq_data['questionary_id'];
                        $tmp_array['question'] = $tq_data['question'];
                        $tmp_array['answer'] = $tq_data['answer'];
                        $questions_data[$tq_data['questionary_id']] = $tmp_array;
                    }
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode($success_array);
                return;
            }
            $success_array['dept_wise_questionary_data'] = $questionary_data;
            $success_array['service_data'] = $service_data;
            $success_array['questions_data'] = $questions_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array = array();
            $success_array['success'] = true;
            $success_array['dept_wise_questionary_data'] = array();
            $success_array['service_data'] = array();
            $success_array['questions_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_all_payment_history() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = array();
            $success_array['success'] = true;
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                $success_array['payment_history'] = array();
                echo json_encode($success_array);
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            $this->db->trans_start();
            $payment_history = $this->payment_model->get_payment_history($session_user_id);
            foreach ($payment_history as &$ph) {
                $ph['department_name'] = '';
                $ph['service_name'] = '';
                if (isset($module_type_array[$ph['module_type']])) {
                    $temp_access_data = $module_type_array[$ph['module_type']];
                    if (!empty($temp_access_data)) {
                        $ph['department_name'] = isset($temp_access_data['department_name']) ? $temp_access_data['department_name'] : '';
                        $ph['service_name'] = isset($temp_access_data['title']) ? $temp_access_data['title'] : '';
                    }
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['payment_history'] = array();
                echo json_encode($success_array);
                return false;
            }
            $success_array['payment_history'] = $payment_history;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['payment_history'] = array();
            echo json_encode($success_array);
        }
    }

    function upload_module_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            $query_module_array = $this->config->item('query_module_array');
            if (!isset($query_module_array[$module_type])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $qm_data = $query_module_array[$module_type];
            $module_id = get_from_post('module_id');
            $doc_id = get_from_post('doc_id');
            $m_doc_array = $this->config->item('module_doc_array');
            if (!isset($m_doc_array[$module_type][$doc_id])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($_FILES['document_file']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $evidence_size = $_FILES['document_file']['size'];
            if ($evidence_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . $qm_data['tbl_text'];
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['document_file']['name']);
            $filename = $qm_data['tbl_text'] . '_doc_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['document_file']['tmp_name'], $final_path)) {
                echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $this->db->trans_start();
            if (!$module_id || $module_id == NULL) {
                $m_data = array();
                $m_data['user_id'] = $session_user_id;
                $m_data['status'] = VALUE_ONE;
                $m_data['created_by'] = $session_user_id;
                $m_data['created_time'] = date('Y-m-d H:i:s');
                $module_id = $this->utility_model->insert_data($qm_data['tbl_text'], $m_data);
            }
            $doc_data = array();
            $doc_data['module_type'] = $module_type;
            $doc_data['module_id'] = $module_id;
            $doc_data['user_id'] = $session_user_id;
            $doc_data['doc_id'] = $doc_id;
            $doc_data['doc_name'] = $filename;
            $doc_data['doc_path'] = $module_path;
            $doc_data['created_by'] = $session_user_id;
            $doc_data['created_time'] = date('Y-m-d H:i:s');
            $this->utility_model->insert_data('module_documents', $doc_data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['doc_data'] = $doc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function remove_module_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            $module_id = get_from_post('module_id');
            $doc_id = get_from_post('doc_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$module_type || $module_type == NULL ||
                    !$module_id || $module_id == NULL || !$doc_id || $doc_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $qm_data = $this->config->item('query_module_array');
            if (!isset($qm_data[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $m_doc_array = $this->config->item('module_doc_array');
            if (!isset($m_doc_array[$module_type][$doc_id])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('module_type', $module_type, 'module_documents', 'module_id', $module_id, 'doc_id', $doc_id);
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $file_path = $ex_data['doc_path'] . DIRECTORY_SEPARATOR . $ex_data['doc_name'];
            $this->db->trans_start();
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('module_documents_id', $ex_data['module_documents_id'], 'module_documents', array('is_delete' => VALUE_ONE, 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_module_other_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            $query_module_array = $this->config->item('query_module_array');
            if (!isset($query_module_array[$module_type])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $qm_data = $query_module_array[$module_type];
            $mod_id = get_from_post('mod_id');
            $module_id = get_from_post('module_id');
            if ($_FILES['document_file']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $evidence_size = $_FILES['document_file']['size'];
            if ($evidence_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . $qm_data['tbl_text'];
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['document_file']['name']);
            $filename = $qm_data['tbl_text'] . '_other_doc_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['document_file']['tmp_name'], $final_path)) {
                echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $this->db->trans_start();
            if (!$module_id || $module_id == NULL) {
                $m_data = array();
                $m_data['user_id'] = $session_user_id;
                $m_data['status'] = VALUE_ONE;
                $m_data['created_by'] = $session_user_id;
                $m_data['created_time'] = date('Y-m-d H:i:s');
                $module_id = $this->utility_model->insert_data($qm_data['tbl_text'], $m_data);
            }

            $od_data = array();
            $od_data['other_doc_path'] = $module_path;
            $od_data['other_doc'] = $filename;
            if (!$mod_id || $mod_id == NULL) {
                $od_data['module_type'] = $module_type;
                $od_data['module_id'] = $module_id;
                $od_data['user_id'] = $session_user_id;
                $od_data['created_by'] = $session_user_id;
                $od_data['created_time'] = date('Y-m-d H:i:s');
                $mod_id = $this->utility_model->insert_data('module_other_documents', $od_data);
            } else {
                $od_data['updated_by'] = $session_user_id;
                $od_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('module_other_documents_id', $mod_id, 'module_other_documents', $od_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $od_data['module_type'] = $module_type;
            $od_data['module_id'] = $module_id;
            $od_data['user_id'] = $session_user_id;
            $od_data['module_other_documents_id'] = $mod_id;
            $success_array = get_success_array();
            $success_array['doc_data'] = $od_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function remove_module_other_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            $module_id = get_from_post('module_id');
            $mod_id = get_from_post('mod_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$module_type || $module_type == NULL ||
                    !$module_id || $module_id == NULL || !$mod_id || $mod_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $qm_data = $this->config->item('query_module_array');
            if (!isset($qm_data[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('module_type', $module_type, 'module_other_documents', 'module_id', $module_id, 'module_other_documents_id', $mod_id);
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $file_path = $ex_data['other_doc_path'] . DIRECTORY_SEPARATOR . $ex_data['other_doc'];
            $this->db->trans_start();
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('module_other_documents_id', $ex_data['module_other_documents_id'], 'module_other_documents', array('other_doc' => '', 'other_doc_path' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function remove_module_other_document_item() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            $module_id = get_from_post('module_id');
            $mod_id = get_from_post('mod_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$module_type || $module_type == NULL ||
                    !$module_id || $module_id == NULL || !$mod_id || $mod_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $qm_data = $this->config->item('query_module_array');
            if (!isset($qm_data[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('module_type', $module_type, 'module_other_documents', 'module_id', $module_id, 'module_other_documents_id', $mod_id);
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }

            $this->db->trans_start();
            if ($ex_data['other_doc'] != '') {
                $file_path = $ex_data['other_doc_path'] . DIRECTORY_SEPARATOR . $ex_data['other_doc'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['is_delete'] = IS_DELETE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('module_other_documents_id', $ex_data['module_other_documents_id'], 'module_other_documents', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_ITEM_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_basic_details_for_feedback_rating() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            $module_id = get_from_post('module_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$module_type || $module_type == NULL ||
                    !$module_id || $module_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_module_array = $this->config->item('query_module_array');
            if (!isset($query_module_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $qm_data = $query_module_array[$module_type];
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_details_for_feedback_rating($qm_data, $module_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['fr_data'] = $ex_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_details_for_feedback_rating() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type_for_fr');
            $module_id = get_from_post('module_id_for_fr');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$module_type || $module_type == NULL ||
                    !$module_id || $module_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_module_array = $this->config->item('query_module_array');
            if (!isset($query_module_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $fr_data = array();
            $fr_data['rating'] = get_from_post('rating_for_fr');
            if (!$fr_data['rating']) {
                echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                return false;
            }
            $fr_data['feedback'] = get_from_post('feedback_for_fr');
            if (!$fr_data['feedback']) {
                echo json_encode(get_error_array(FEEDBACK_MESSAGE));
                return false;
            }
            $fr_data['fr_datetime'] = date('Y-m-d H:i:s');
            $qm_data = $query_module_array[$module_type];
            $this->db->trans_start();
            $this->utility_model->update_data($qm_data['key_id_text'], $module_id, $qm_data['tbl_text'], $fr_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = FEEDBACK_SUBMITTED_MESSAGE;
            $success_array['fr_data'] = $fr_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_basic_details_for_withdraw_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            $module_id = get_from_post('module_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$module_type || $module_type == NULL ||
                    !$module_id || $module_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_module_array = $this->config->item('query_module_array');
            if (!isset($query_module_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $qm_data = $query_module_array[$module_type];
            $this->db->trans_start();
            if ($module_type == VALUE_FIFTYTWO) {
                $ex_data = $this->utility_model->get_details_for_ips_incentives_withdraw_application($qm_data, $module_id);
            } else {
                $ex_data = $this->utility_model->get_details_for_withdraw_application($qm_data, $module_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['status'] == VALUE_ELEVEN) {
                echo json_encode(get_error_array(ALREADY_WITHDRAW_APPLICATION_MESSAGE));
                return;
            }
            if ($ex_data['status'] != VALUE_ZERO && $ex_data['status'] != VALUE_ONE && $ex_data['status'] != VALUE_TWO && $ex_data['status'] != VALUE_THREE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['wa_data'] = $ex_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_details_for_withdraw_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type_for_withdraw_application');
            $module_id = get_from_post('module_id_for_withdraw_application');
            if (!is_post() || $session_user_id == null || !$session_user_id || !$module_type || $module_type == NULL ||
                    !$module_id || $module_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_module_array = $this->config->item('query_module_array');
            if (!isset($query_module_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $qm_data = $query_module_array[$module_type];
            $update_data = array();
            $update_data['withdrawal_remarks'] = get_from_post('remarks_for_withdraw_application');
            if (!$update_data['withdrawal_remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id($qm_data['key_id_text'], $module_id, $qm_data['tbl_text']);
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_data['status'] == VALUE_ELEVEN) {
                echo json_encode(get_error_array(ALREADY_WITHDRAW_APPLICATION_MESSAGE));
                return;
            }
            if ($ex_data['status'] != VALUE_ZERO && $ex_data['status'] != VALUE_ONE && $ex_data['status'] != VALUE_TWO && $ex_data['status'] != VALUE_THREE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['submitted_datetime'] != '0000-00-00 00:00:00') {
                $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_THIRTYTHREE, $ex_data['submitted_datetime']);
            }
            if ($ex_data['query_status'] == VALUE_ONE || $ex_data['query_status'] == VALUE_TWO) {
                $update_data['query_status'] = VALUE_THREE;
            }
            $this->db->trans_start();
            $update_data['status'] = VALUE_ELEVEN;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data($qm_data['key_id_text'], $module_id, $qm_data['tbl_text'], $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = WITHDRAW_APPLICATION_MESSAGE;
            $success_array['wa_data'] = $update_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
     * EOF: ./application/controller/Utility.php
     */    