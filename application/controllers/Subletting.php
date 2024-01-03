<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subletting extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_subletting_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['subletting_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['subletting_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'sub_letting', 'district', $search_district, 'subletting_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['subletting_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['wmregistration_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_subletting_data_by_id() {
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
            $subletting_id = get_from_post('subletting_id');
            if (!$subletting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $subletting_data = $this->utility_model->get_by_id('subletting_id', $subletting_id, 'sub_letting');
            if (empty($subletting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['subletting_data'] = $subletting_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_subletting() {
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
            $subletting_id = get_from_post('subletting_id');
            $subletting_data = $this->_get_post_data_for_subletting();
            $validation_message = $this->_check_validation_for_subletting($subletting_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }


            if ($subletting_data['request_letter'] == IS_CHECKED_YES) {
                if ($_FILES['request_letter_premises_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['request_letter_premises_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['request_letter_premises_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['request_letter_premises'] = $filename;
                }
            }
            if ($subletting_data['original_extract'] == IS_CHECKED_YES) {
                if ($_FILES['original_extract_certificate_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['original_extract_certificate_for_subletting']['name']);
                    $filename = 'original_extract_certificate_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['original_extract_certificate_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['original_extract_certificate'] = $filename;
                }
            }
            if ($subletting_data['land_revenue'] == IS_CHECKED_YES) {
                if ($_FILES['land_revenue_certificate_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['land_revenue_certificate_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['land_revenue_certificate_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['land_revenue_certificate'] = $filename;
                }
            }
            if ($subletting_data['electricity_bill'] == IS_CHECKED_YES) {
                if ($_FILES['electricity_bill_certificate_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['electricity_bill_certificate_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['electricity_bill_certificate_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['electricity_bill_certificate'] = $filename;
                }
            }
            if ($subletting_data['bank_loan'] == IS_CHECKED_YES) {
                if ($_FILES['bank_loan_certificate_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['bank_loan_certificate_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['bank_loan_certificate_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['bank_loan_certificate'] = $filename;
                }
            }
            if ($subletting_data['panchayat_tax'] == IS_CHECKED_YES) {
                if ($_FILES['panchayat_tax_certificate_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['panchayat_tax_certificate_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['panchayat_tax_certificate_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['panchayat_tax_certificate'] = $filename;
                }
            }
            if ($subletting_data['challan_of_lease'] == IS_CHECKED_YES) {
                if ($_FILES['challan_of_lease_rent_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['challan_of_lease_rent_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['challan_of_lease_rent_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['challan_of_lease_rent'] = $filename;
                }
            }
            if ($subletting_data['occupancy'] == IS_CHECKED_YES) {
                if ($_FILES['occupancy_certificate_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['occupancy_certificate_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['occupancy_certificate_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['occupancy_certificate'] = $filename;
                }
            }
            if ($subletting_data['central_excise'] == IS_CHECKED_YES) {
                if ($_FILES['central_excise_certificate_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    // if (!is_dir($main_path)) {
                    //     mkdir($main_path);
                    //     chmod("$main_path", 0755);
                    // }
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['central_excise_certificate_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['central_excise_certificate_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['central_excise_certificate'] = $filename;
                }
            }
            if ($subletting_data['authorization_sign'] == IS_CHECKED_YES) {
                if ($_FILES['authorization_sign_lessee_for_subletting']['name'] != '') {
                    $main_path = 'documents/subletting';
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['authorization_sign_lessee_for_subletting']['name']);
                    $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['authorization_sign_lessee_for_subletting']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $subletting_data['authorization_sign_lessee'] = $filename;
                }
            }


            if ($_FILES['seal_and_stamp_for_subletting']['name'] != '') {
                $main_path = 'documents/subletting';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['seal_and_stamp_for_subletting']['name']);
                $filename = 'subletting_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['seal_and_stamp_for_subletting']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $subletting_data['signature'] = $filename;
            }
            //  $this->db->trans_start();
            // // $noc_data['proprietor_details'] = $proprietorData;
            // $subletting_data['application_date'] = convert_to_mysql_date_format($subletting_data['application_date']);
            // $subletting_data['user_id'] = $user_id;
            // $subletting_data['status'] = $module_type;
            // if ($module_type == VALUE_TWO) {
            //     $subletting_data['submitted_datetime'] = date('Y-m-d H:i:s');
            // }
            // if (!$subletting_id || $subletting_id == NULL) {
            //     $subletting_data['application_date'] = date('Y-m-d');
            //     $subletting_data['created_by'] = $user_id;
            //     $subletting_data['created_time'] = date('Y-m-d H:i:s');
            //     $subletting_id = $this->utility_model->insert_data('sub_letting', $subletting_data);
            // } else {
            //     $subletting_data['updated_by'] = $user_id;
            //     $subletting_data['updated_time'] = date('Y-m-d H:i:s');
            //     $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', $subletting_data);
            // }
            $this->db->trans_start();
            //  if ($subletting_data['request_letter'] == VALUE_TWO) {
            //     $subletting_data['request_letter_premises'] = convert_to_mysql_date_format($subletting_data['request_letter_premises']);
            // }
            $subletting_data['application_date'] = convert_to_mysql_date_format($subletting_data['application_date']);
            //  $subletting_data['date'] = convert_to_mysql_date_format($subletting_data['date']);
            $subletting_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $subletting_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$subletting_id || $subletting_id == NULL) {
                $subletting_data['user_id'] = $user_id;
                $subletting_data['created_by'] = $user_id;
                $subletting_data['created_time'] = date('Y-m-d H:i:s');
                $subletting_data['application_date'] = date('Y-m-d');
                $subletting_id = $this->utility_model->insert_data('sub_letting', $subletting_data);
            } else {
                $subletting_data['updated_by'] = $user_id;
                $subletting_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', $subletting_data);
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

    function _get_post_data_for_subletting() {
        $subletting_data = array();
        $subletting_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $subletting_data['state'] = get_from_post('state');
        $subletting_data['district'] = get_from_post('district');
        $subletting_data['taluka'] = get_from_post('taluka');
        $subletting_data['village'] = get_from_post('villages_for_noc_data');
        $subletting_data['application_date'] = get_from_post('application_date');
        $subletting_data['plot_no'] = get_from_post('plot_no_for_subletting_data');
        $subletting_data['survey_no'] = get_from_post('survey_no');
        $subletting_data['admeasuring'] = get_from_post('admeasuring');
        $subletting_data['govt_industrial_estate_area'] = get_from_post('govt_industrial_estate_area');
        $subletting_data['name_of_manufacturing'] = get_from_post('name_of_manufacturing');
        $subletting_data['request_letter'] = get_from_post('request_letter');
        $subletting_data['original_extract'] = get_from_post('original_extract');
        $subletting_data['land_revenue'] = get_from_post('land_revenue');
        $subletting_data['electricity_bill'] = get_from_post('electricity_bill');
        $subletting_data['bank_loan'] = get_from_post('bank_loan');
        $subletting_data['panchayat_tax'] = get_from_post('panchayat_tax');
        $subletting_data['challan_of_lease'] = get_from_post('challan_of_lease');
        $subletting_data['occupancy'] = get_from_post('occupancy');
        $subletting_data['central_excise'] = get_from_post('central_excise');
        $subletting_data['authorization_sign'] = get_from_post('authorization_sign');


        return $subletting_data;
    }

    function _check_validation_for_subletting($subletting_data) {
        if (!$subletting_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$subletting_data['state']) {
            return STATE_MESSAGE;
        }
        if (!$subletting_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$subletting_data['taluka']) {
            return TALUKA_MESSAGE;
        }
        if (!$subletting_data['village']) {
            return VILLAGE_NAME_MESSAGE;
        }
        if (!$subletting_data['plot_no']) {
            return PLOT_NO_MESSAGE;
        }
        if (!$subletting_data['survey_no']) {
            return SURVEY_NO_MESSAGE;
        }
        if (!$subletting_data['admeasuring']) {
            return ADMEASURING_MESSAGE;
        }
        if (!$subletting_data['govt_industrial_estate_area']) {
            return GOVT_INDUSTRIAL_AR_MESSAGE;
        }
        if (!$subletting_data['name_of_manufacturing']) {
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
            $subletting_id = get_from_post('subletting_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$subletting_id || $subletting_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('subletting_id', $subletting_id, 'sub_letting');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['request_letter_premises'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['original_extract_certificate'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['land_revenue_certificate'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['electricity_bill_certificate'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['bank_loan_certificate'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['panchayat_tax_certificate'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['challan_of_lease_rent'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['occupancy_certificate'];
            }
            if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['central_excise_certificate'];
            }
            if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['authorization_sign_lessee'];
            }
            if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }



            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('request_letter_premises' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('original_extract_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('land_revenue_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('electricity_bill_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('bank_loan_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('panchayat_tax_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('challan_of_lease_rent' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('occupancy_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('central_excise_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('authorization_sign_lessee' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $subletting_id = get_from_post('subletting_id_for_subletting_form1');
            if (!is_post() || $user_id == null || !$user_id || $subletting_id == null || !$subletting_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_subletting_data = $this->utility_model->get_by_id('subletting_id', $subletting_id, 'sub_letting');

            if (empty($existing_subletting_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('subletting_data' => $existing_subletting_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('subletting/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_subletting_data_by_subletting_id() {
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
            $subletting_id = get_from_post('subletting_id');
            if (!$subletting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $subletting_data = $this->utility_model->get_by_id('subletting_id', $subletting_id, 'sub_letting');
            if (empty($subletting_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['subletting_data'] = $subletting_data;
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
            $subletting_id = get_from_post('subletting_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$subletting_id || $subletting_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('subletting_id', $subletting_id, 'sub_letting');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'subletting' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $subletting_id = get_from_post('subletting_id_for_subletting_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $subletting_id == NULL || !$subletting_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $subletting_data = array();
            if ($_FILES['fees_paid_challan_for_subletting_upload_challan']['name'] != '') {
                $main_path = 'documents/subletting';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'subletting';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_subletting_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_subletting_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $subletting_data['status'] = VALUE_FOUR;
                $subletting_data['fees_paid_challan'] = $filename;
                $subletting_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            $subletting_data['updated_by'] = $user_id;
            $subletting_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('subletting_id', $subletting_id, 'sub_letting', $subletting_data);
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
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            $subletting_id = get_from_post('subletting_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $subletting_id == null || !$subletting_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_subletting_data = $this->utility_model->get_by_id('subletting_id', $subletting_id, 'sub_letting');
            if (empty($existing_subletting_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_subletting_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_subletting($existing_subletting_data);
    //        $data = array('subletting_data' => $existing_subletting_data);
    //        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
    //        $mpdf->WriteHTML($this->load->view('subletting/certificate', $data, TRUE));
    //        $mpdf->Output('Repairer_certificate_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/BOCW.php
 */