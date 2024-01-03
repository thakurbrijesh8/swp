<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sublessee extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_sublessee_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['sublessee_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['sublessee_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'sub_lessee', 'district', $search_district, 'sublessee_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['sublessee_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['sublessee_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_sublessee_data_by_id() {
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
            $sublessee_id = get_from_post('sublessee_id');
            if (!$sublessee_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $sublessee_data = $this->utility_model->get_by_id('sublessee_id', $sublessee_id, 'sub_lessee');
            if (empty($sublessee_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['sublessee_data'] = $sublessee_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_sublessee() {
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
            $sublessee_id = get_from_post('sublessee_id');
            $sublessee_data = $this->_get_post_data_for_sublessee();
            $validation_message = $this->_check_validation_for_sublessee($sublessee_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            if ($sublessee_data['request_letter'] == IS_CHECKED_YES) {
                if ($_FILES['request_letter_manufacture_for_sublessee']['name'] != '') {
                    $main_path = 'documents/sublessee';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'sublessee';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['request_letter_manufacture_for_sublessee']['name']);
                    $filename = 'request_letter_manufacture_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['request_letter_manufacture_for_sublessee']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $sublessee_data['request_letter_manufacture'] = $filename;
                }
            }
            if ($sublessee_data['detail_project'] == IS_CHECKED_YES) {
                if ($_FILES['detail_project_report_for_sublessee']['name'] != '') {
                    $main_path = 'documents/sublessee';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'sublessee';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['detail_project_report_for_sublessee']['name']);
                    $filename = 'detail_project_report_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['detail_project_report_for_sublessee']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $sublessee_data['detail_project_report'] = $filename;
                }
            }
            if ($sublessee_data['partnership_deed'] == IS_CHECKED_YES) {
                if ($_FILES['memorandum_partnership_deed_for_sublessee']['name'] != '') {
                    $main_path = 'documents/sublessee';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'sublessee';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['memorandum_partnership_deed_for_sublessee']['name']);
                    $filename = 'memorandum_partnership_deed_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['memorandum_partnership_deed_for_sublessee']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $sublessee_data['memorandum_partnership_deed'] = $filename;
                }
            }
            if ($sublessee_data['sign_sublessee'] == IS_CHECKED_YES) {
                if ($_FILES['behalf_sign_sublessee_for_sublessee']['name'] != '') {
                    $main_path = 'documents/sublessee';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'sublessee';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['behalf_sign_sublessee_for_sublessee']['name']);
                    $filename = 'behalf_sign_sublessee_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['behalf_sign_sublessee_for_sublessee']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $sublessee_data['behalf_sign_sublessee'] = $filename;
                }
            }
            if ($_FILES['seal_and_stamp_for_sublessee']['name'] != '') {
                $main_path = 'documents/sublessee';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'sublessee';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['seal_and_stamp_for_sublessee']['name']);
                $filename = 'sublessee_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['seal_and_stamp_for_sublessee']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $sublessee_data['signature'] = $filename;
            }
            $this->db->trans_start();
            //  if ($subletting_data['request_letter'] == VALUE_TWO) {
            //     $subletting_data['request_letter_premises'] = convert_to_mysql_date_format($subletting_data['request_letter_premises']);
            // }
            $sublessee_data['date'] = convert_to_mysql_date_format($sublessee_data['date']);
            //  $sublessee_data['date'] = convert_to_mysql_date_format($sublessee_data['date']);
            $sublessee_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $sublessee_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$sublessee_id || $sublessee_id == NULL) {
                $sublessee_data['user_id'] = $user_id;
                $sublessee_data['created_by'] = $user_id;
                $sublessee_data['created_time'] = date('Y-m-d H:i:s');
                $sublessee_data['date'] = date('Y-m-d');
                $sublessee_id = $this->utility_model->insert_data('sub_lessee', $sublessee_data);
            } else {
                $sublessee_data['updated_by'] = $user_id;
                $sublessee_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', $sublessee_data);
            }
            // $this->db->trans_start();
            // $sublessee_data['date'] = convert_to_mysql_date_format($sublessee_data['date']);
            // $sublessee_data['user_id'] = $user_id;
            // $sublessee_data['status'] = $module_type;
            // $sublessee_data['created_by'] = $user_id;
            // $sublessee_data['created_time'] = date('Y-m-d H:i:s');
            // if ($module_type == VALUE_TWO) {
            //     $sublessee_data['submitted_datetime'] = date('Y-m-d H:i:s');
            // }
            // if (!$sublessee_id || $sublessee_id == NULL) {
            //     //$sublessee_data['date'] = date('Y-m-d')
            //     $sublessee_id = $this->utility_model->insert_data('sub_lessee', $sublessee_data);
            // } else {
            //     $sublessee_data['updated_by'] = $user_id;
            //     $sublessee_data['updated_time'] = date('Y-m-d H:i:s');
            //     $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', $sublessee_data);
            // }

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

    function _get_post_data_for_sublessee() {
        $sublessee_data = array();
        $sublessee_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $sublessee_data['state'] = get_from_post('state');
        $sublessee_data['district'] = get_from_post('district');
        $sublessee_data['taluka'] = get_from_post('taluka');
        $sublessee_data['village'] = get_from_post('villages_for_noc_data');
        $sublessee_data['date'] = get_from_post('date');
        $sublessee_data['plot_no'] = get_from_post('plot_no_for_sublessee_data');
        $sublessee_data['survey_no'] = get_from_post('survey_no');
        $sublessee_data['admeasuring'] = get_from_post('admeasuring');
        $sublessee_data['govt_industrial_estate_area'] = get_from_post('govt_industrial_estate_area');
        $sublessee_data['name_of_manufacturing'] = get_from_post('name_of_manufacturing');
        $sublessee_data['request_letter'] = get_from_post('request_letter');
        $sublessee_data['detail_project'] = get_from_post('detail_project');
        $sublessee_data['partnership_deed'] = get_from_post('partnership_deed');
        $sublessee_data['sign_sublessee'] = get_from_post('sign_sublessee');
        return $sublessee_data;
    }

    function _check_validation_for_sublessee($sublessee_data) {
        if (!$sublessee_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$sublessee_data['state']) {
            return STATE_MESSAGE;
        }
        if (!$sublessee_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$sublessee_data['taluka']) {
            return TALUKA_MESSAGE;
        }
        if (!$sublessee_data['village']) {
            return VILLAGE_NAME_MESSAGE;
        }
        if (!$sublessee_data['plot_no']) {
            return PLOT_NO_MESSAGE;
        }
        if (!$sublessee_data['survey_no']) {
            return SURVEY_NO_MESSAGE;
        }
        if (!$sublessee_data['admeasuring']) {
            return ADMEASURING_MESSAGE;
        }
        if (!$sublessee_data['name_of_manufacturing']) {
            return NAME_OF_MANUFACTRING_MESSAGE;
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
            $sublessee_id = get_from_post('sublessee_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$sublessee_id || $sublessee_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('sublessee_id', $sublessee_id, 'sub_lessee');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'sublessee' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['request_letter_manufacture'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'sublessee' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['detail_project_report'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'sublessee' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['memorandum_partnership_deed'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'sublessee' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['behalf_sign_sublessee'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'sublessee' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }



            if (file_exists($file_path)) {
                unlink($file_path);
            }


            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', array('request_letter_manufacture' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', array('detail_project_report' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', array('memorandum_partnership_deed' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', array('behalf_sign_sublessee' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $sublessee_id = get_from_post('sublessee_id_for_sublessee_form1');
            if (!is_post() || $user_id == null || !$user_id || $sublessee_id == null || !$sublessee_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_sublessee_data = $this->utility_model->get_by_id('sublessee_id', $sublessee_id, 'sub_lessee');

            if (empty($existing_sublessee_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('sublessee_data' => $existing_sublessee_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('sublessee/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_sublessee_data_by_sublessee_id() {
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
            $sublessee_id = get_from_post('sublessee_id');
            if (!$sublessee_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $sublessee_data = $this->utility_model->get_by_id('sublessee_id', $sublessee_id, 'sub_lessee');
            if (empty($sublessee_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['sublessee_data'] = $sublessee_data;
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
            $sublessee_id = get_from_post('sublessee_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$sublessee_id || $sublessee_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('sublessee_id', $sublessee_id, 'sub_lessee');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'sublessee' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $sublessee_id = get_from_post('sublessee_id_for_sublessee_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $sublessee_id == NULL || !$sublessee_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $sublessee_data = array();
            if ($_FILES['fees_paid_challan_for_sublessee_upload_challan']['name'] != '') {
                $main_path = 'documents/sublessee';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'sublessee';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_sublessee_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_sublessee_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $sublessee_data['status'] = VALUE_FOUR;
                $sublessee_data['fees_paid_challan'] = $filename;
                $sublessee_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            $sublessee_data['updated_by'] = $user_id;
            $sublessee_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('sublessee_id', $sublessee_id, 'sub_lessee', $sublessee_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
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
            $sublessee_id = get_from_post('sublessee_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $sublessee_id == null || !$sublessee_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_sublessee_data = $this->utility_model->get_by_id('sublessee_id', $sublessee_id, 'sub_lessee');
            if (empty($existing_sublessee_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_sublessee_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_sublessee($existing_sublessee_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/BOCW.php
 */