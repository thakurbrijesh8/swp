<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Textile extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_textile_data() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        $success_array = get_success_array();
        $success_array['textile_data'] = array();
        if ($session_user_id == NULL || !$session_user_id) {
            echo json_encode($success_array);
            return false;
        }
        $this->db->trans_start();
        $success_array['textile_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'incentive_generalform_textile', NULL, NULL, 'incentive_id', 'DESC');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $success_array['textile_data'] = array();
            echo json_encode($success_array);
            return;
        }
        echo json_encode($success_array);
    }

    function get_textile_data_by_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_start();
        $textile_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_generalform_textile');
        if (empty($textile_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array = get_success_array();
        $success_array['textile_data'] = $textile_data;
        echo json_encode($success_array);
    }

    function get_incentive_scheme_data_by_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }

        $success_array = get_success_array();
        $this->db->trans_start();
        $scheme_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_scheme');
        if (empty($scheme_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $scheme_data['encrypt_id'] = $success_array['encrypt_id'];
        $scheme_data['incentive_id'] = $incentive_id;
        $success_array['scheme_data'] = $scheme_data;
        echo json_encode($success_array);
    }

    function get_incentive_partf_data_by_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }

        $success_array = get_success_array();
        $this->db->trans_start();
        $partf_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partf');
        if (empty($partf_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $partf_data['encrypt_id'] = $success_array['encrypt_id'];
        $partf_data['incentive_id'] = $incentive_id;
        $success_array['partf_data'] = $partf_data;
        echo json_encode($success_array);
    }

    function get_incentive_partg_data_by_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }

        $success_array = get_success_array();
        $this->db->trans_start();
        $partg_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partg');
        if (empty($partg_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $partg_data['encrypt_id'] = $success_array['encrypt_id'];
        $partg_data['incentive_id'] = $incentive_id;
        $success_array['partg_data'] = $partg_data;
        echo json_encode($success_array);
    }

    function get_incentive_parth_data_by_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }

        $success_array = get_success_array();
        $this->db->trans_start();
        $parth_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_parth');
        if (empty($parth_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $parth_data['encrypt_id'] = $success_array['encrypt_id'];
        $parth_data['incentive_id'] = $incentive_id;
        $success_array['parth_data'] = $parth_data;
        echo json_encode($success_array);
    }

    // function get_incentive_partd_data_by_id() {
    //     $session_user_id = get_from_session('temp_id_for_eodbsws');
    //     if (!is_post() || $session_user_id == NULL || !$session_user_id) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $incentive_id = get_from_post('incentive_id');
    //     if (!$incentive_id) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $success_array = get_success_array();
    //     $this->db->trans_start();
    //     $partd_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partd');
    //     if (empty($partd_data)) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //         echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
    //         return;
    //     }
    //     $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
    //     $partd_data['encrypt_id'] = $success_array['encrypt_id'];
    //     $partd_data['incentive_id'] = $incentive_id;
    //     $success_array['partd_data'] = $partd_data;
    //     echo json_encode($success_array);
    // }
    // function get_incentive_parte_data_by_id() {
    //     $session_user_id = get_from_session('temp_id_for_eodbsws');
    //     if (!is_post() || $session_user_id == NULL || !$session_user_id) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $incentive_id = get_from_post('incentive_id');
    //     if (!$incentive_id) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $success_array = get_success_array();
    //     $this->db->trans_start();
    //     $parte_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_parte');
    //     if (empty($parte_data)) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //         echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
    //         return;
    //     }
    //     $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
    //     $parte_data['encrypt_id'] = $success_array['encrypt_id'];
    //     $parte_data['incentive_id'] = $incentive_id;
    //     $success_array['parte_data'] = $parte_data;
    //     echo json_encode($success_array);
    // }
    function get_incentive_declaration_data_by_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }

        $success_array = get_success_array();
        $this->db->trans_start();
        $declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');
        if (empty($declaration_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $declaration_data['encrypt_id'] = $success_array['encrypt_id'];
        $declaration_data['incentive_id'] = $incentive_id;
        $success_array['declaration_data'] = $declaration_data;
        echo json_encode($success_array);
    }

    function get_incentive_checklist_data_by_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }

        $success_array = get_success_array();
        $this->db->trans_start();
        $checklist_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_checklist');
        if (empty($checklist_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $checklist_data['encrypt_id'] = $success_array['encrypt_id'];
        $checklist_data['incentive_id'] = $incentive_id;
        $success_array['checklist_data'] = $checklist_data;
        echo json_encode($success_array);
    }

    function submit_textile() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $module_type = get_from_post('module_type');
        if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        $textile_data = $this->_get_post_data_for_textile();
        $validation_message = $this->_check_validation_for_textile($textile_data);
        if ($validation_message != '') {
            echo json_encode(get_error_array($validation_message));
            return false;
        }
        if ($textile_data['is_women_entrepreneur'] == IS_CHECKED_YES) {
            if ($_FILES['women_entrepreneur_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['women_entrepreneur_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['women_entrepreneur_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['women_entrepreneur'] = $filename;
            }
        }
        if ($textile_data['is_sc_st_entrepreneur'] == IS_CHECKED_YES) {
            if ($_FILES['sc_st_entrepreneur_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['sc_st_entrepreneur_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['sc_st_entrepreneur_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['sc_st_entrepreneur'] = $filename;
            }
        }
        if ($textile_data['is_physically_entrepreneur'] == IS_CHECKED_YES) {
            if ($_FILES['physically_entrepreneur_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['physically_entrepreneur_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['physically_entrepreneur_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['physically_entrepreneur'] = $filename;
            }
        }
        if ($textile_data['is_transgender_entrepreneur'] == IS_CHECKED_YES) {
            if ($_FILES['transgender_entrepreneur_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['transgender_entrepreneur_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['transgender_entrepreneur_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['transgender_entrepreneur'] = $filename;
            }
        }

        if ($textile_data['is_other_entrepreneur'] == IS_CHECKED_YES) {
            if ($_FILES['other_entrepreneur_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['other_entrepreneur_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['other_entrepreneur_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['other_entrepreneur'] = $filename;
            }
        }

        if ($textile_data['financial_assistance'] == IS_CHECKED_YES) {
            if ($_FILES['financial_assistance_upload_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['financial_assistance_upload_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['financial_assistance_upload_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['financial_assistance_upload'] = $filename;
            }
        }

        if ($textile_data['govt_dues'] == IS_CHECKED_YES) {
            if ($_FILES['govt_dues_upload_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['govt_dues_upload_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['govt_dues_upload_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $textile_data['govt_dues_upload'] = $filename;
            }
        }

        if ($textile_data['is_women_entrepreneur'] == IS_CHECKED_YES || $textile_data['is_sc_st_entrepreneur'] == IS_CHECKED_YES || $textile_data['is_physically_entrepreneur'] == IS_CHECKED_YES || $textile_data['is_transgender_entrepreneur'] == IS_CHECKED_YES) {
            $proprietorShareData = $this->input->post('proprietor_share_data');
            $proprietor_share_decode_Data = json_decode($proprietorShareData, true);
            if ($proprietorShareData == "" || empty($proprietor_share_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
                return false;
            }
        }

        $this->db->trans_start();
        $textile_data['emdate_part1'] = convert_to_mysql_date_format($textile_data['emdate_part1']);
        $textile_data['emdate_part2'] = convert_to_mysql_date_format($textile_data['emdate_part2']);
        $textile_data['pccno_date'] = convert_to_mysql_date_format($textile_data['pccno_date']);
        $textile_data['pccno_validupto_date'] = convert_to_mysql_date_format($textile_data['pccno_validupto_date']);
        $textile_data['establishment_date'] = convert_to_mysql_date_format($textile_data['establishment_date']);
        $textile_data['establishment_validupto_date'] = convert_to_mysql_date_format($textile_data['establishment_validupto_date']);
        $textile_data['commencement_date'] = convert_to_mysql_date_format($textile_data['commencement_date']);
        if ($textile_data['is_women_entrepreneur'] == IS_CHECKED_YES || $textile_data['is_sc_st_entrepreneur'] == IS_CHECKED_YES || $textile_data['is_physically_entrepreneur'] == IS_CHECKED_YES || $textile_data['is_transgender_entrepreneur'] == IS_CHECKED_YES) {
            $textile_data['proprietor_share_details'] = $proprietorShareData;
        }
        $textile_data['status'] = $module_type;
        if ($module_type == VALUE_TWO) {
            $textile_data['submitted_datetime'] = date('Y-m-d H:i:s');
        }
        if (!$incentive_id || $incentive_id == NULL) {
            $textile_data['user_id'] = $user_id;
            $textile_data['created_by'] = $user_id;
            $textile_data['created_time'] = date('Y-m-d H:i:s');
            $incentive_id = $this->utility_model->insert_data('incentive_generalform_textile', $textile_data);
        } else {
            $textile_data['updated_by'] = $user_id;
            $textile_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('incentive_id', $incentive_id, 'incentive_generalform_textile', $textile_data);
        }
        $new_textile_scheme_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_scheme');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }

        $success_array = get_success_array();
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $new_textile_scheme_data['incentive_id'] = $incentive_id;
        $new_textile_scheme_data['encrypt_id'] = $success_array['encrypt_id'];
        $success_array['incentive_scheme_data'] = $new_textile_scheme_data;
        echo json_encode($success_array);
    }

    function _get_post_data_for_textile() {
        $textile_data = array();
        $textile_data['enterprise_name'] = get_from_post('enterprise_name');
        $textile_data['office_address'] = get_from_post('office_address');
        $textile_data['office_contactno'] = get_from_post('office_contactno');
        $textile_data['factory_address'] = get_from_post('factory_address');
        $textile_data['factory_contactno'] = get_from_post('factory_contactno');
        $textile_data['fax'] = get_from_post('fax');
        $textile_data['cellphone'] = get_from_post('cellphone');
        $textile_data['email'] = get_from_post('email');
        $textile_data['promoters_details'] = get_from_post('promoters_details');
        $textile_data['othorized_person_detail'] = get_from_post('othorized_person_detail');
        $textile_data['emno_part1'] = get_from_post('emno_part1');
        $textile_data['emdate_part1'] = get_from_post('emdate_part1');
        $textile_data['emno_part2'] = get_from_post('emno_part2');
        $textile_data['emdate_part2'] = get_from_post('emdate_part2');
        $textile_data['manufacturing_items'] = get_from_post('manufacturing_items');
        $textile_data['annual_capacity'] = get_from_post('annual_capacity');
        $textile_data['approval_no'] = get_from_post('approval_no');
        $textile_data['pccno_date'] = get_from_post('pccno_date');
        $textile_data['pccno_validupto_date'] = get_from_post('pccno_validupto_date');
        $textile_data['factory_registration_no'] = get_from_post('factory_registration_no');
        $textile_data['establishment_date'] = get_from_post('establishment_date');
        $textile_data['establishment_validupto_date'] = get_from_post('establishment_validupto_date');
        $textile_data['commencement_date'] = get_from_post('commencement_date');
        $textile_data['bank_name'] = get_from_post('bank_name');
        $textile_data['account_no'] = get_from_post('account_no');
        $textile_data['ifsc_no'] = get_from_post('ifsc_no');
        $textile_data['bankbranch_no'] = get_from_post('bankbranch_no');
        $textile_data['pancard_no'] = get_from_post('pancard_no');
        $textile_data['district'] = get_from_post('district');

        $textile_data['is_women_entrepreneur'] = get_from_post('is_women_entrepreneur');
        $textile_data['is_sc_st_entrepreneur'] = get_from_post('is_sc_st_entrepreneur');
        $textile_data['is_physically_entrepreneur'] = get_from_post('is_physically_entrepreneur');
        $textile_data['is_transgender_entrepreneur'] = get_from_post('is_transgender_entrepreneur');
        $textile_data['is_other_entrepreneur'] = get_from_post('is_other_entrepreneur');
        $textile_data['constitution'] = get_from_post('constitution');
        $textile_data['unit_type'] = get_from_post('unit_type');
        $textile_data['category'] = get_from_post('category');
        $textile_data['financial_assistance'] = get_from_post('financial_assistance');
        $textile_data['govt_dues'] = get_from_post('govt_dues');
        $textile_data['annual_turnover'] = get_from_post('annual_turnover');
        $textile_data['annual_turnover_one'] = get_from_post('annual_turnover_one');
        $textile_data['annual_turnover_two'] = get_from_post('annual_turnover_two');
        $textile_data['annual_turnover_three'] = get_from_post('annual_turnover_three');
        $textile_data['annual_turnover_four'] = get_from_post('annual_turnover_four');
        return $textile_data;
    }

    function _check_validation_for_textile($textile_data) {
        if (!$textile_data['enterprise_name']) {
            return ENTERPRISE_NAME_MESSAGE;
        }
        if (!$textile_data['office_address']) {
            return OFFICE_ADDRESS_MESSAGE;
        }
        if (!$textile_data['office_contactno']) {
            return OFFICE_CONTACT_NO_MESSAGE;
        }
        if (!$textile_data['factory_address']) {
            return FACTORY_ADDRESS_MESSAGE;
        }
        if (!$textile_data['factory_contactno']) {
            return FACTORY_CONTACT_NO_MESSAGE;
        }
        if (!$textile_data['fax']) {
            return FAX_MESSAGE;
        }
        if (!$textile_data['cellphone']) {
            return CELL_PHNO_MESSAGE;
        }
        if (!$textile_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$textile_data['promoters_details']) {
            return PROMOTERS_DETAIL_MESSAGE;
        }
        if (!$textile_data['othorized_person_detail']) {
            return OTHORIZED_PERSON_DETAIL_MESSAGE;
        }
        if (!$textile_data['emno_part1']) {
            return EM_NO_MESSAGE;
        }
        if (!$textile_data['emdate_part1']) {
            return EM_DATE_MESSAGE;
        }
        if (!$textile_data['emno_part2']) {
            return EM_NO_MESSAGE;
        }
        if (!$textile_data['emdate_part2']) {
            return EM_DATE_MESSAGE;
        }
        if (!$textile_data['manufacturing_items']) {
            return MANUFACTURING_ITEM_MESSAGE;
        }
        if (!$textile_data['annual_capacity']) {
            return ANNUAL_CAPACITY_MESSAGE;
        }
        if (!$textile_data['approval_no']) {
            return APPROVAL_NO_MESSAGE;
        }
        if (!$textile_data['pccno_date']) {
            return PCC_DATE_MESSAGE;
        }
        if (!$textile_data['pccno_validupto_date']) {
            return PCC_VALIDUPTO_DATE_MESSAGE;
        }
        if (!$textile_data['factory_registration_no']) {
            return FACTORY_NO_MESSAGE;
        }
        if (!$textile_data['establishment_date']) {
            return ESTABLISHMENTS_DATE_MESSAGE;
        }
        if (!$textile_data['establishment_validupto_date']) {
            return ESTABLISHMENT_VALIDUPTO_DATE_MESSAGE;
        }
        if (!$textile_data['commencement_date']) {
            return COMMENCEMENT_DATE_MESSAGE;
        }
        if (!$textile_data['bank_name']) {
            return NAME_OF_BANK_MESSAGE;
        }
        if (!$textile_data['account_no']) {
            return BANK_ACCOUNT_NO_MESSAGE;
        }
        if (!$textile_data['ifsc_no']) {
            return IFSC_CODE_MESSAGE;
        }
        if (!$textile_data['bankbranch_no']) {
            return BRANCH_CODE_MESSAGE;
        }
        if (!$textile_data['pancard_no']) {
            return PAN_CARD_MESSAGE;
        }
        if (!$textile_data['annual_turnover']) {
            return TURNOVER_MESSAGE;
        }
        if (!$textile_data['annual_turnover_one']) {
            return TURNOVER_MESSAGE;
        }
        if (!$textile_data['annual_turnover_two']) {
            return TURNOVER_MESSAGE;
        }
        if (!$textile_data['annual_turnover_three']) {
            return TURNOVER_MESSAGE;
        }
        if (!$textile_data['annual_turnover_four']) {
            return TURNOVER_MESSAGE;
        }
        if (!$textile_data['district']) {
            return OWNER_DisTRICT_MESSAGE;
        }
        return '';
    }

    function submit_incentive_scheme() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $module_type = get_from_post('module_type');
        if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_scheme_id = get_from_post('incentive_scheme_id');
        $scheme_data = $this->_get_post_data_for_scheme();
        // $validation_message = $this->_check_validation_for_scheme($scheme_data);
        // if ($validation_message != '') {
        //     echo json_encode(get_error_array($validation_message));
        //     return false;
        // }


        $this->db->trans_start();
        $incentive_id = $scheme_data['incentive_id'];
        $scheme_data['user_id'] = $user_id;
        //$scheme_data['status'] = $module_type;
        $scheme_data['created_by'] = $user_id;
        $scheme_data['created_time'] = date('Y-m-d H:i:s');
        if (!$incentive_scheme_id || $incentive_scheme_id == NULL) {
            $incentive_scheme_id = $this->utility_model->insert_data('incentive_scheme', $scheme_data);
        } else {
            $scheme_data['updated_by'] = $user_id;
            $scheme_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('incentive_scheme_id', $incentive_scheme_id, 'incentive_scheme', $scheme_data);
        }
        $new_scheme_data = $this->utility_model->get_by_id('incentive_scheme_id', $incentive_scheme_id, 'incentive_scheme');
        $scheme_flag = '';
        if ($new_scheme_data['partf_form'] == 1) {
            $scheme_flag = 'partf_form';
            $new_textile_partf_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partf');
        } else if ($new_scheme_data['partg_form'] == 1) {
            $scheme_flag = 'partg_form';
            $new_textile_partg_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partg');
        } else if ($new_scheme_data['parth_form'] == 1) {
            $scheme_flag = 'parth_form';
            $new_textile_parth_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_parth');
        } else {
            $scheme_flag = 'declaration_form';
            $new_textile_declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');
        }
        if ($module_type == VALUE_TWO) {
            $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TEN, $incentive_id);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));

            return;
        }
        $success_array = get_success_array();
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $success_array['scheme_flag'] = $scheme_flag;

        if ($new_scheme_data['partf_form'] == 1) {
            $new_textile_partf_data['incentive_id'] = $incentive_id;
            $new_textile_partf_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['incentive_partf_data'] = $new_textile_partf_data;
        } else if ($new_scheme_data['partg_form'] == 1) {
            $new_textile_partg_data['incentive_id'] = $incentive_id;
            $new_textile_partg_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['incentive_partg_data'] = $new_textile_partg_data;
        } else if ($new_scheme_data['parth_form'] == 1) {
            $new_textile_parth_data['incentive_id'] = $incentive_id;
            $new_textile_parth_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['incentive_parth_data'] = $new_textile_parth_data;
        } else {
            $new_textile_declaration_data['incentive_id'] = $incentive_id;
            $new_textile_declaration_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['declaration_data'] = $new_textile_declaration_data;
        }

        echo json_encode($success_array);
    }

    function _get_post_data_for_scheme() {
        $textile_data = array();
        $textile_data['incentive_id'] = get_from_post('incentive_id');
        $textile_data['partf_form'] = get_from_post('partf_form');
        $textile_data['partg_form'] = get_from_post('partg_form');
        $textile_data['parth_form'] = get_from_post('parth_form');

        return $textile_data;
    }

    function submit_textile_partf() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $module_type = get_from_post('module_type');
        if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_partf_id = get_from_post('incentive_partf_id');
        $incentive_partf_data = $this->_get_post_data_for_incentive_partf();
        $validation_message = $this->_check_validation_for_incentive_partf($incentive_partf_data);
        if ($validation_message != '') {
            echo json_encode(get_error_array($validation_message));
            return false;
        }

        if ($_FILES['project_profile_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['project_profile_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['project_profile_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_partf_data['project_profile_uploader'] = $filename;
        }
        if ($_FILES['details_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['details_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['details_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_partf_data['details_uploader'] = $filename;
        }
        if ($_FILES['investment_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['investment_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['investment_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_partf_data['investment_uploader'] = $filename;
        }


        $financialInstitution = $this->input->post('financial_institution_data');
        $financial_institution_decode_Data = json_decode($financialInstitution, true);
        if ($financialInstitution == "" || empty($financial_institution_decode_Data)) {
            echo json_encode(get_error_array('Enter Atlist One Financial Institution Detail'));
            return false;
        }

        $this->db->trans_start();
        $incentive_id = $incentive_partf_data['incentive_id'];
        $incentive_partf_data['term_loan_date'] = convert_to_mysql_date_format($incentive_partf_data['term_loan_date']);
        $incentive_partf_data['financial_data_info'] = $financialInstitution;
        $incentive_partf_data['user_id'] = $user_id;
        //$incentive_partf_data['status'] = $module_type;
        $incentive_partf_data['created_by'] = $user_id;
        $incentive_partf_data['created_time'] = date('Y-m-d H:i:s');
        if (!$incentive_partf_id || $incentive_partf_id == NULL) {
            $incentive_partf_id = $this->utility_model->insert_data('incentive_partf', $incentive_partf_data);
        } else {
            $incentive_partf_data['updated_by'] = $user_id;
            $incentive_partf_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('incentive_partf_id', $incentive_partf_id, 'incentive_partf', $incentive_partf_data);
        }
        $new_scheme_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_scheme');
        $scheme_flag = '';
        if ($new_scheme_data['partg_form'] == 1) {
            $scheme_flag = 'partg_form';
            $new_textile_partg_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partg');
        } else if ($new_scheme_data['parth_form'] == 1) {
            $scheme_flag = 'parth_form';
            $new_textile_parth_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_parth');
        } else {
            $scheme_flag = 'declaration_form';
            $new_textile_declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));

            return;
        }
        $success_array = get_success_array();
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $success_array['scheme_flag'] = $scheme_flag;

        if ($new_scheme_data['partg_form'] == 1) {
            $new_textile_partg_data['incentive_id'] = $incentive_id;
            $new_textile_partg_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['incentive_partg_data'] = $new_textile_partg_data;
        } else if ($new_scheme_data['parth_form'] == 1) {
            $new_textile_parth_data['incentive_id'] = $incentive_id;
            $new_textile_parth_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['incentive_parth_data'] = $new_textile_parth_data;
        } else {
            $new_textile_declaration_data['incentive_id'] = $incentive_id;
            $new_textile_declaration_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['declaration_data'] = $new_textile_declaration_data;
        }

        echo json_encode($success_array);
    }

    function _get_post_data_for_incentive_partf() {
        $incentive_partf_data = array();
        $incentive_partf_data['incentive_id'] = get_from_post('incentive_id');
        $incentive_partf_data['enterprise_name'] = get_from_post('enterprise_name');
        $incentive_partf_data['enterprise_category'] = get_from_post('enterprise_category');
        if ($incentive_partf_data['enterprise_category'] == VALUE_ONE) {
            $incentive_partf_data['investment'] = get_from_post('investment');
        }
        if ($incentive_partf_data['enterprise_category'] == VALUE_TWO || $incentive_partf_data['enterprise_category'] == VALUE_THREE || $incentive_partf_data['enterprise_category'] == VALUE_FOUR) {
            $incentive_partf_data['machinery_units'] = get_from_post('machinery_units');
            $incentive_partf_data['new_investment'] = get_from_post('new_investment');
            $incentive_partf_data['investment_percentage'] = get_from_post('investment_percentage');
        }
        $incentive_partf_data['contribution'] = get_from_post('contribution');
        $incentive_partf_data['term_loan'] = get_from_post('term_loan');
        $incentive_partf_data['unsecured_loan'] = get_from_post('unsecured_loan');
        $incentive_partf_data['accruals'] = get_from_post('accruals');
        $incentive_partf_data['finance_total'] = get_from_post('finance_total');
        $incentive_partf_data['term_loan_date'] = get_from_post('term_loan_date');
        $incentive_partf_data['loan_accountno'] = get_from_post('loan_accountno');
        $incentive_partf_data['interest_subsidy'] = get_from_post('interest_subsidy');
        $incentive_partf_data['other_info'] = get_from_post('other_info');

        return $incentive_partf_data;
    }

    function _check_validation_for_incentive_partf($incentive_partf_data) {
        if (!$incentive_partf_data['enterprise_name']) {
            return ENTERPRISE_NAME_MESSAGE;
        }
        if ($incentive_partf_data['enterprise_category'] == VALUE_ONE) {
            if (!$incentive_partf_data['investment']) {
                return OFFICE_ADDRESS_MESSAGE;
            }
        }
        if ($incentive_partf_data['enterprise_category'] == VALUE_TWO || $incentive_partf_data['enterprise_category'] == VALUE_THREE || $incentive_partf_data['enterprise_category'] == VALUE_FOUR) {
            if (!$incentive_partf_data['machinery_units']) {
                return OFFICE_CONTACT_NO_MESSAGE;
            }
            if (!$incentive_partf_data['new_investment']) {
                return FACTORY_ADDRESS_MESSAGE;
            }
            if (!$incentive_partf_data['investment_percentage']) {
                return FACTORY_CONTACT_NO_MESSAGE;
            }
        }
        if (!$incentive_partf_data['contribution']) {
            return CONTRIBUTION_MESSAGE;
        }
        if (!$incentive_partf_data['term_loan']) {
            return CELL_PHNO_MESSAGE;
        }
        if (!$incentive_partf_data['unsecured_loan']) {
            return EMAIL_MESSAGE;
        }
        if (!$incentive_partf_data['accruals']) {
            return PROMOTERS_DETAIL_MESSAGE;
        }
        if (!$incentive_partf_data['finance_total']) {
            return OTHORIZED_PERSON_DETAIL_MESSAGE;
        }
        if (!$incentive_partf_data['term_loan_date']) {
            return EM_NO_MESSAGE;
        }
        if (!$incentive_partf_data['loan_accountno']) {
            return EM_DATE_MESSAGE;
        }
        if (!$incentive_partf_data['interest_subsidy']) {
            return INTREST_SUBSIDY_MESSAGE;
        }
        if (!$incentive_partf_data['other_info']) {
            return OTHER_INFO_MESSAGE;
        }

        return '';
    }

    function submit_textile_partg() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $module_type = get_from_post('module_type');
        if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_partg_id = get_from_post('incentive_partg_id');
        $incentive_partg_data = $this->_get_post_data_for_incentive_partg();
        $validation_message = $this->_check_validation_for_incentive_partg($incentive_partg_data);
        if ($validation_message != '') {
            echo json_encode(get_error_array($validation_message));
            return false;
        }

        if ($_FILES['project_profile_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['project_profile_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['project_profile_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_partg_data['project_profile_uploader'] = $filename;
        }
        if ($_FILES['details_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['details_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['details_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_partg_data['details_uploader'] = $filename;
        }
        if ($_FILES['investment_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['investment_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['investment_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_partg_data['investment_uploader'] = $filename;
        }


        $financialInstitution = $this->input->post('financial_institution_data');
        $financial_institution_decode_Data = json_decode($financialInstitution, true);
        if ($financialInstitution == "" || empty($financial_institution_decode_Data)) {
            echo json_encode(get_error_array('Enter Atlist One Financial Institution Detail'));
            return false;
        }

        $this->db->trans_start();
        $incentive_id = $incentive_partg_data['incentive_id'];
        $incentive_partg_data['term_loan_date'] = convert_to_mysql_date_format($incentive_partg_data['term_loan_date']);
        $incentive_partg_data['financial_data_info'] = $financialInstitution;
        $incentive_partg_data['user_id'] = $user_id;
        //$incentive_partg_data['status'] = $module_type;
        $incentive_partg_data['created_by'] = $user_id;
        $incentive_partg_data['created_time'] = date('Y-m-d H:i:s');
        if (!$incentive_partg_id || $incentive_partg_id == NULL) {
            $incentive_partg_id = $this->utility_model->insert_data('incentive_partg', $incentive_partg_data);
        } else {
            $incentive_partg_data['updated_by'] = $user_id;
            $incentive_partg_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('incentive_partg_id', $incentive_partg_id, 'incentive_partg', $incentive_partg_data);
        }
        $new_scheme_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_scheme');
        $scheme_flag = '';
        if ($new_scheme_data['parth_form'] == 1) {
            $scheme_flag = 'parth_form';
            $new_textile_parth_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_parth');
        } else {
            $scheme_flag = 'declaration_form';
            $new_textile_declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));

            return;
        }
        $success_array = get_success_array();
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $success_array['scheme_flag'] = $scheme_flag;

        if ($new_scheme_data['parth_form'] == 1) {
            $new_textile_parth_data['incentive_id'] = $incentive_id;
            $new_textile_parth_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['incentive_parth_data'] = $new_textile_parth_data;
        } else {
            $new_textile_declaration_data['incentive_id'] = $incentive_id;
            $new_textile_declaration_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['declaration_data'] = $new_textile_declaration_data;
        }

        echo json_encode($success_array);
    }

    function _get_post_data_for_incentive_partg() {
        $incentive_partg_data = array();
        $incentive_partg_data['incentive_id'] = get_from_post('incentive_id');
        $incentive_partg_data['enterprise_name'] = get_from_post('enterprise_name');
        $incentive_partg_data['enterprise_category'] = get_from_post('enterprise_category');
        if ($incentive_partg_data['enterprise_category'] == VALUE_ONE) {
            $incentive_partg_data['investment'] = get_from_post('investment');
        }
        if ($incentive_partg_data['enterprise_category'] == VALUE_TWO || $incentive_partg_data['enterprise_category'] == VALUE_THREE || $incentive_partg_data['enterprise_category'] == VALUE_FOUR) {
            $incentive_partg_data['machinery_units'] = get_from_post('machinery_units');
            $incentive_partg_data['new_investment'] = get_from_post('new_investment');
            $incentive_partg_data['investment_percentage'] = get_from_post('investment_percentage');
        }
        $incentive_partg_data['sector_textile'] = get_from_post('sector_textile');
        $incentive_partg_data['contribution'] = get_from_post('contribution');
        $incentive_partg_data['term_loan'] = get_from_post('term_loan');
        $incentive_partg_data['unsecured_loan'] = get_from_post('unsecured_loan');
        $incentive_partg_data['accruals'] = get_from_post('accruals');
        $incentive_partg_data['finance_total'] = get_from_post('finance_total');
        $incentive_partg_data['term_loan_date'] = get_from_post('term_loan_date');
        $incentive_partg_data['loan_accountno'] = get_from_post('loan_accountno');
        $incentive_partg_data['interest_subsidy'] = get_from_post('interest_subsidy');
        $incentive_partg_data['other_info'] = get_from_post('other_info');

        return $incentive_partg_data;
    }

    function _check_validation_for_incentive_partg($incentive_partg_data) {
        if (!$incentive_partg_data['enterprise_name']) {
            return ENTERPRISE_NAME_MESSAGE;
        }
        if ($incentive_partg_data['enterprise_category'] == VALUE_ONE) {
            if (!$incentive_partg_data['investment']) {
                return OFFICE_ADDRESS_MESSAGE;
            }
        }
        if ($incentive_partg_data['enterprise_category'] == VALUE_TWO || $incentive_partg_data['enterprise_category'] == VALUE_THREE || $incentive_partg_data['enterprise_category'] == VALUE_FOUR) {
            if (!$incentive_partg_data['machinery_units']) {
                return OFFICE_CONTACT_NO_MESSAGE;
            }
            if (!$incentive_partg_data['new_investment']) {
                return FACTORY_ADDRESS_MESSAGE;
            }
            if (!$incentive_partg_data['investment_percentage']) {
                return FACTORY_CONTACT_NO_MESSAGE;
            }
        }
        if (!$incentive_partg_data['sector_textile']) {
            return SECTOR_TEXTILE_MESSAGE;
        }
        if (!$incentive_partg_data['contribution']) {
            return CONTRIBUTION_MESSAGE;
        }
        if (!$incentive_partg_data['term_loan']) {
            return CELL_PHNO_MESSAGE;
        }
        if (!$incentive_partg_data['unsecured_loan']) {
            return EMAIL_MESSAGE;
        }
        if (!$incentive_partg_data['accruals']) {
            return PROMOTERS_DETAIL_MESSAGE;
        }
        if (!$incentive_partg_data['finance_total']) {
            return OTHORIZED_PERSON_DETAIL_MESSAGE;
        }
        if (!$incentive_partg_data['term_loan_date']) {
            return EM_NO_MESSAGE;
        }
        if (!$incentive_partg_data['loan_accountno']) {
            return EM_DATE_MESSAGE;
        }
        if (!$incentive_partg_data['interest_subsidy']) {
            return INTREST_SUBSIDY_MESSAGE;
        }
        if (!$incentive_partg_data['other_info']) {
            return OTHER_INFO_MESSAGE;
        }

        return '';
    }

    function submit_textile_parth() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $module_type = get_from_post('module_type');
        if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_parth_id = get_from_post('incentive_parth_id');
        $incentive_parth_data = $this->_get_post_data_for_incentive_parth();
        $validation_message = $this->_check_validation_for_incentive_parth($incentive_parth_data);
        if ($validation_message != '') {
            echo json_encode(get_error_array($validation_message));
            return false;
        }

        if ($_FILES['project_profile_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['project_profile_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['project_profile_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_parth_data['project_profile_uploader'] = $filename;
        }
        if ($_FILES['details_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['details_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['details_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_parth_data['details_uploader'] = $filename;
        }
        if ($_FILES['investment_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['investment_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['investment_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_parth_data['investment_uploader'] = $filename;
        }
        if ($_FILES['annual_production_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['annual_production_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['annual_production_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_parth_data['annual_production_uploader'] = $filename;
        }
        if ($_FILES['power_consumption_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['power_consumption_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['power_consumption_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_parth_data['power_consumption_uploader'] = $filename;
        }
        if ($_FILES['impact_uploader_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['impact_uploader_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['impact_uploader_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $incentive_parth_data['impact_uploader'] = $filename;
        }
        if ($incentive_parth_data['enterprise_accqu'] == VALUE_ONE) {
            if ($_FILES['mou_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['mou_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['mou_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $incentive_parth_data['mou_uploader'] = $filename;
            }
            if ($_FILES['arrangement_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['arrangement_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['arrangement_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $incentive_parth_data['arrangement_uploader'] = $filename;
            }
        }


        $financialInstitution = $this->input->post('financial_institution_data');
        $financial_institution_decode_Data = json_decode($financialInstitution, true);
        if ($financialInstitution == "" || empty($financial_institution_decode_Data)) {
            echo json_encode(get_error_array('Enter Atlist One Financial Institution Detail'));
            return false;
        }

        $this->db->trans_start();
        $incentive_id = $incentive_parth_data['incentive_id'];
        $incentive_parth_data['term_loan_date'] = convert_to_mysql_date_format($incentive_parth_data['term_loan_date']);
        $incentive_parth_data['financial_data_info'] = $financialInstitution;
        $incentive_parth_data['user_id'] = $user_id;
        //$incentive_parth_data['status'] = $module_type;
        $incentive_parth_data['created_by'] = $user_id;
        $incentive_parth_data['created_time'] = date('Y-m-d H:i:s');
        if (!$incentive_parth_id || $incentive_parth_id == NULL) {
            $incentive_parth_id = $this->utility_model->insert_data('incentive_parth', $incentive_parth_data);
        } else {
            $incentive_parth_data['updated_by'] = $user_id;
            $incentive_parth_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('incentive_parth_id', $incentive_parth_id, 'incentive_parth', $incentive_parth_data);
        }
        // $new_scheme_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_scheme');
        // $scheme_flag = '';
        // $scheme_flag = 'declaration_form';
        $new_textile_declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));

            return;
        }
        $success_array = get_success_array();
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        //$success_array['scheme_flag'] = $scheme_flag;

        $new_textile_declaration_data['incentive_id'] = $incentive_id;
        $new_textile_declaration_data['encrypt_id'] = $success_array['encrypt_id'];
        $success_array['declaration_data'] = $new_textile_declaration_data;

        echo json_encode($success_array);
    }

    function _get_post_data_for_incentive_parth() {
        $incentive_parth_data = array();
        $incentive_parth_data['incentive_id'] = get_from_post('incentive_id');
        $incentive_parth_data['enterprise_name'] = get_from_post('enterprise_name');
        $incentive_parth_data['technology_purpose'] = get_from_post('technology_purpose');
        $incentive_parth_data['enterprise_accqu'] = get_from_post('enterprise_accqu');
        if ($incentive_parth_data['enterprise_accqu'] == VALUE_ONE) {
            $incentive_parth_data['justification'] = get_from_post('justification');
            $incentive_parth_data['process_detail'] = get_from_post('process_detail');
            $incentive_parth_data['name_address'] = get_from_post('name_address');
        }
        $incentive_parth_data['sector_textile'] = get_from_post('sector_textile');
        $incentive_parth_data['commencement_date'] = get_from_post('commencement_date');
        $incentive_parth_data['purchase'] = get_from_post('purchase');
        $incentive_parth_data['technology_fees'] = get_from_post('technology_fees');
        $incentive_parth_data['other_detail'] = get_from_post('other_detail');
        $incentive_parth_data['upgradation_total'] = get_from_post('upgradation_total');
        $incentive_parth_data['contribution'] = get_from_post('contribution');
        $incentive_parth_data['term_loan'] = get_from_post('term_loan');
        $incentive_parth_data['unsecured_loan'] = get_from_post('unsecured_loan');
        $incentive_parth_data['accruals'] = get_from_post('accruals');
        $incentive_parth_data['finance_total'] = get_from_post('finance_total');
        $incentive_parth_data['term_loan_date'] = get_from_post('term_loan_date');
        $incentive_parth_data['loan_accountno'] = get_from_post('loan_accountno');
        $incentive_parth_data['interest_subsidy'] = get_from_post('interest_subsidy');
        $incentive_parth_data['other_info'] = get_from_post('other_info');

        return $incentive_parth_data;
    }

    function _check_validation_for_incentive_parth($incentive_parth_data) {
        if (!$incentive_parth_data['enterprise_name']) {
            return ENTERPRISE_NAME_MESSAGE;
        }
        if ($incentive_parth_data['enterprise_accqu'] == VALUE_ONE) {
            if (!$incentive_parth_data['justification']) {
                return JUSTIFICATION_MESSAGE;
            }
            if (!$incentive_parth_data['process_detail']) {
                return PROCESS_DETAIL_MESSAGE;
            }
            if (!$incentive_parth_data['name_address']) {
                return NAME_ADDRESS_MESSAGE;
            }
        }
        if (!$incentive_parth_data['sector_textile']) {
            return SECTOR_TEXTILE_MESSAGE;
        }
        if (!$incentive_parth_data['commencement_date']) {
            return COMMENCEMENT_DATE_MESSAGE;
        }
        if (!$incentive_parth_data['purchase']) {
            return PURCHASE_MESSAGE;
        }
        if (!$incentive_parth_data['technology_fees']) {
            return TECHNOLOGY_FEES_MESSAGE;
        }
        if (!$incentive_parth_data['other_detail']) {
            return OTHER_DETAIL_MESSAGE;
        }
        if (!$incentive_parth_data['upgradation_total']) {
            return FINANCE_TOTAL_MESSAGE;
        }
        if (!$incentive_parth_data['contribution']) {
            return CONTRIBUTION_MESSAGE;
        }
        if (!$incentive_parth_data['term_loan']) {
            return CELL_PHNO_MESSAGE;
        }
        if (!$incentive_parth_data['unsecured_loan']) {
            return EMAIL_MESSAGE;
        }
        if (!$incentive_parth_data['accruals']) {
            return PROMOTERS_DETAIL_MESSAGE;
        }
        if (!$incentive_parth_data['finance_total']) {
            return OTHORIZED_PERSON_DETAIL_MESSAGE;
        }
        if (!$incentive_parth_data['term_loan_date']) {
            return EM_NO_MESSAGE;
        }
        if (!$incentive_parth_data['loan_accountno']) {
            return EM_DATE_MESSAGE;
        }
        if (!$incentive_parth_data['interest_subsidy']) {
            return INTREST_SUBSIDY_MESSAGE;
        }
        if (!$incentive_parth_data['other_info']) {
            return OTHER_INFO_MESSAGE;
        }

        return '';
    }

    // function submit_textile_partd() {
    //     $user_id = get_from_session('temp_id_for_eodbsws');
    //     $module_type = get_from_post('module_type');
    //     if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $incentive_partd_id = get_from_post('incentive_partd_id');
    //     $incentive_partd_data = $this->_get_post_data_for_incentive_partd();
    //     $validation_message = $this->_check_validation_for_incentive_partd($incentive_partd_data);
    //     if ($validation_message != '') {
    //         echo json_encode(get_error_array($validation_message));
    //         return false;
    //     }
    //     $equipment = $this->input->post('equipment_data');
    //     $equipment_decode_Data = json_decode($equipment, true);
    //     if ($equipment == "" || empty($equipment_decode_Data)) {
    //         echo json_encode(get_error_array('Enter Atlist One Equipments Detail'));
    //         return false;
    //     }
    //     if ($_FILES['audit_report_for_textile']['name'] != '') {
    //         $main_path = 'documents/textile';
    //         // if (!is_dir($main_path)) {
    //         //     mkdir($main_path);
    //         //     chmod("$main_path", 0755);
    //         // }
    //         $documents_path = 'documents';
    //         if (!is_dir($documents_path)) {
    //             mkdir($documents_path);
    //             chmod($documents_path, 0777);
    //         }
    //         $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
    //         if (!is_dir($module_path)) {
    //             mkdir($module_path);
    //             chmod($module_path, 0777);
    //         }
    //         $this->load->library('upload');
    //         $temp_filename = str_replace('_', '', $_FILES['audit_report_for_textile']['name']);
    //         $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
    //         //Change file name
    //         $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
    //         if (!move_uploaded_file($_FILES['audit_report_for_textile']['tmp_name'], $final_path)) {
    //             echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
    //             return;
    //         }
    //         $incentive_partd_data['audit_report'] = $filename;
    //     }
    //     $this->db->trans_start();
    //     $incentive_id = $incentive_partd_data['incentive_id'];
    //     $incentive_partd_data['equipment_info'] = $equipment;
    //     $incentive_partd_data['user_id'] = $user_id;
    //     //$incentive_partd_data['status'] = $module_type;
    //     $incentive_partd_data['created_by'] = $user_id;
    //     $incentive_partd_data['created_time'] = date('Y-m-d H:i:s');
    //     if (!$incentive_partd_id || $incentive_partd_id == NULL) {
    //         $incentive_partd_id = $this->utility_model->insert_data('incentive_partd',$incentive_partd_data);
    //     }else{
    //         $incentive_partd_data['updated_by'] = $user_id;
    //         $incentive_partd_data['updated_time'] = date('Y-m-d H:i:s');
    //         $this->utility_model->update_data('incentive_partd_id', $incentive_partd_id, 'incentive_partd', $incentive_partd_data);
    //     }
    //     $new_scheme_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_scheme');
    //     $scheme_flag = '';
    //     if($new_scheme_data['parte_form'] == 1){
    //         $scheme_flag = 'parte_form';
    //         $new_textile_parte_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_parte');
    //     }else{
    //         $scheme_flag = 'declaration_form';
    //         $new_textile_declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');
    //     }
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //         echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
    //         return;
    //     }
    //     $success_array = get_success_array();
    //     $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
    //     $success_array['scheme_flag'] = $scheme_flag;
    //     if($new_scheme_data['parte_form'] == 1){
    //         $new_textile_parte_data['incentive_id'] = $incentive_id;
    //         $new_textile_parte_data['encrypt_id'] = $success_array['encrypt_id'];
    //         $success_array['incentive_parte_data'] = $new_textile_parte_data;
    //     }else{
    //         $new_textile_declaration_data['incentive_id'] = $incentive_id;
    //         $new_textile_declaration_data['encrypt_id'] = $success_array['encrypt_id'];
    //         $success_array['declaration_data'] = $new_textile_declaration_data;
    //     }
    //     echo json_encode($success_array);
    // }
    // function _get_post_data_for_incentive_partd() {
    //     $incentive_partd_data = array();
    //     $incentive_partd_data['incentive_id'] = get_from_post('incentive_id');
    //     $incentive_partd_data['consultant_name'] = get_from_post('consultant_name');
    //     $incentive_partd_data['suggestion'] = get_from_post('suggestion');
    //     $incentive_partd_data['result_benefit'] = get_from_post('result_benefit');
    //     $incentive_partd_data['total_expenditure'] = get_from_post('total_expenditure');
    //     $incentive_partd_data['audit_fees'] = get_from_post('audit_fees');
    //     $incentive_partd_data['equipment_cost'] = get_from_post('equipment_cost');
    //     $incentive_partd_data['cliam_amount_total'] = get_from_post('cliam_amount_total');
    //     return $incentive_partd_data;
    // }
    // function _check_validation_for_incentive_partd($incentive_partd_data) {
    //     if (!$incentive_partd_data['consultant_name']) {
    //         return CONSULTANT_NAME_MESSAGE;
    //     }
    //     if (!$incentive_partd_data['suggestion']) {
    //         return SUGGESTION_MESSAGE;
    //     }
    //     if (!$incentive_partd_data['result_benefit']) {
    //         return RESULT_BENEFIT_MESSAGE;
    //     }
    //     if (!$incentive_partd_data['total_expenditure']) {
    //         return TOTAL_EXPENDITURE_MESSAGE;
    //     }
    //     if (!$incentive_partd_data['audit_fees']) {
    //         return AUDIT_FEES_MESSAGE;
    //     }
    //     if (!$incentive_partd_data['equipment_cost']) {
    //         return EQUIPMENT_COST_MESSAGE;
    //     }
    //     if (!$incentive_partd_data['cliam_amount_total']) {
    //         return CLIAM_AMOUNT_MESSAGE;
    //     }
    //     return '';
    // }
    // function submit_textile_parte() {
    //     $user_id = get_from_session('temp_id_for_eodbsws');
    //     $module_type = get_from_post('module_type');
    //     if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $incentive_parte_id = get_from_post('incentive_parte_id');
    //     $incentive_parte_data = $this->_get_post_data_for_incentive_parte();
    //     $validation_message = $this->_check_validation_for_incentive_parte($incentive_parte_data);
    //     if ($validation_message != '') {
    //         echo json_encode(get_error_array($validation_message));
    //         return false;
    //     }
    //     $this->db->trans_start();
    //     $incentive_id = $incentive_parte_data['incentive_id'];
    //     $incentive_parte_data['user_id'] = $user_id;
    //     //$incentive_parte_data['status'] = $module_type;
    //     $incentive_parte_data['created_by'] = $user_id;
    //     $incentive_parte_data['created_time'] = date('Y-m-d H:i:s');
    //     if (!$incentive_parte_id || $incentive_parte_id == NULL) {
    //         $incentive_parte_id = $this->utility_model->insert_data('incentive_parte',$incentive_parte_data);
    //     }else{
    //         $incentive_parte_data['updated_by'] = $user_id;
    //         $incentive_parte_data['updated_time'] = date('Y-m-d H:i:s');
    //         $this->utility_model->update_data('incentive_parte_id', $incentive_parte_id, 'incentive_parte', $incentive_parte_data);
    //     }
    //      $new_textile_declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //         echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
    //         return;
    //     }
    //     // $success_array = get_success_array();
    //     // $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
    //     // echo json_encode($success_array);
    //     $success_array = get_success_array();
    //     $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
    //     $new_textile_declaration_data['incentive_id'] = $incentive_id;
    //     $new_textile_declaration_data['encrypt_id'] = $success_array['encrypt_id'];
    //     $success_array['declaration_data'] = $new_textile_declaration_data;
    //     echo json_encode($success_array);
    // }
    // function _get_post_data_for_incentive_parte() {
    //     $incentive_parte_data = array();
    //     $incentive_parte_data['incentive_id'] = get_from_post('incentive_id');
    //     $incentive_parte_data['newly_requit_emp'] = get_from_post('newly_requit_emp');
    //     $incentive_parte_data['emp_total_expenditure'] = get_from_post('emp_total_expenditure');
    //     $incentive_parte_data['assclaim_amount'] = get_from_post('assclaim_amount');
    //     return $incentive_parte_data;
    // }
    // function _check_validation_for_incentive_parte($incentive_parte_data) {
    //     if (!$incentive_parte_data['newly_requit_emp']) {
    //         return REQUIT_EMP_MESSAGE;
    //     }
    //     if (!$incentive_parte_data['emp_total_expenditure']) {
    //         return EMP_EXPENDITURE_MESSAGE;
    //     }
    //     if (!$incentive_parte_data['assclaim_amount']) {
    //         return ASSCLAIM_AMOUNT_MESSAGE;
    //     }
    //     return '';
    // }

    function submit_textile_declaration() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $module_type = get_from_post('module_type');
        if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $declaration_id = get_from_post('declaration_id');

        if ($_FILES['sign_seal_for_textile']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['sign_seal_for_textile']['name']);
            $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['sign_seal_for_textile']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $declaration_data['sign_seal'] = $filename;
        }

        $this->db->trans_start();
        $incentive_id = get_from_post('incentive_id');
        $declaration_data['incentive_id'] = $incentive_id;
        $declaration_data['user_id'] = $user_id;
        //$declaration_data['status'] = $module_type;
        $declaration_data['created_by'] = $user_id;
        $declaration_data['created_time'] = date('Y-m-d H:i:s');
        if (!$declaration_id || $declaration_id == NULL) {
            $declaration_id = $this->utility_model->insert_data('textile_declaration', $declaration_data);
        } else {
            $declaration_data['updated_by'] = $user_id;
            $declaration_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('declaration_id', $declaration_id, 'textile_declaration', $declaration_data);
        }
        $new_textile_checklist_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_checklist');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }

        // $success_array = get_success_array();
        // $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
        // echo json_encode($success_array);

        $success_array = get_success_array();
        $success_array['encrypt_id'] = get_encrypt_id($incentive_id);
        $new_textile_checklist_data['incentive_id'] = $incentive_id;
        $new_textile_checklist_data['encrypt_id'] = $success_array['encrypt_id'];
        $success_array['checklist_data'] = $new_textile_checklist_data;
        echo json_encode($success_array);
    }

    function submit_textile_checklist() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $module_type = get_from_post('module_type');
        if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $checklist_id = get_from_post('checklist_id');
        $is_capital_investment = get_from_post('is_capital_investment');
        $is_intrest_subsidy = get_from_post('is_intrest_subsidy');

        $checklist_data['is_capital_investment'] = $is_capital_investment;
        $checklist_data['is_intrest_subsidy'] = $is_intrest_subsidy;

        if ($is_capital_investment == IS_CHECKED_YES) {
            if ($_FILES['entrepreneur_memorandum_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['entrepreneur_memorandum_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['entrepreneur_memorandum_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['entrepreneur_memorandum_uploader'] = $filename;
            }
            if ($_FILES['partnership_deed_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['partnership_deed_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['partnership_deed_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['partnership_deed_uploader'] = $filename;
            }
            if ($_FILES['lease_agreement_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['lease_agreement_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['lease_agreement_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['lease_agreement_uploader'] = $filename;
            }
            if ($_FILES['loan_sanction_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['loan_sanction_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['loan_sanction_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['loan_sanction_uploader'] = $filename;
            }
            if ($_FILES['power_release_order_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['power_release_order_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['power_release_order_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['power_release_order_uploader'] = $filename;
            }
            if ($_FILES['invoice_copy_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['invoice_copy_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['invoice_copy_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['invoice_copy_uploader'] = $filename;
            }
            if ($_FILES['ca_prescribed_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['ca_prescribed_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['ca_prescribed_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['ca_prescribed_uploader'] = $filename;
            }
            if ($_FILES['certificate_commencement_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['certificate_commencement_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['certificate_commencement_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['certificate_commencement_uploader'] = $filename;
            }
            if ($_FILES['engineer_certificate_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['engineer_certificate_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['engineer_certificate_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['engineer_certificate_uploader'] = $filename;
            }
            if ($_FILES['expenses_certificate_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['expenses_certificate_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['expenses_certificate_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['expenses_certificate_uploader'] = $filename;
            }
            if ($_FILES['stamped_receipt_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['stamped_receipt_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['stamped_receipt_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['stamped_receipt_uploader'] = $filename;
            }
            if ($_FILES['sale_invoice_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['sale_invoice_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['sale_invoice_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['sale_invoice_uploader'] = $filename;
            }
            if ($_FILES['additional_document_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['additional_document_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['additional_document_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['additional_document_uploader'] = $filename;
            }
            if ($_FILES['factorylicence_copy_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['factorylicence_copy_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['factorylicence_copy_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['factorylicence_copy_uploader'] = $filename;
            }
            if ($_FILES['pcc_copy_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['pcc_copy_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['pcc_copy_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['pcc_copy_uploader'] = $filename;
            }
            if ($_FILES['expansion_date_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['expansion_date_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['expansion_date_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['expansion_date_uploader'] = $filename;
            }
            if ($_FILES['production_turnover_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['production_turnover_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['production_turnover_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['production_turnover_uploader'] = $filename;
            }
            if ($_FILES['fix_assets_value_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fix_assets_value_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fix_assets_value_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['fix_assets_value_uploader'] = $filename;
            }
            if ($_FILES['production_capacity_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['production_capacity_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['production_capacity_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['production_capacity_uploader'] = $filename;
            }
            if ($_FILES['patent_registration_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['patent_registration_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['patent_registration_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['patent_registration_uploader'] = $filename;
            }
            if ($_FILES['energy_water_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['energy_water_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['energy_water_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['energy_water_uploader'] = $filename;
            }
            if ($_FILES['quality_certificate_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['quality_certificate_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['quality_certificate_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['quality_certificate_uploader'] = $filename;
            }
            if ($_FILES['resident_certificate_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['resident_certificate_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['resident_certificate_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['resident_certificate_uploader'] = $filename;
            }
        }
        if ($is_intrest_subsidy == IS_CHECKED_YES) {
            if ($_FILES['bank_total_interest_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['bank_total_interest_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['bank_total_interest_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['bank_total_interest_uploader'] = $filename;
            }
            if ($_FILES['bank_statement_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['bank_statement_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['bank_statement_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['bank_statement_uploader'] = $filename;
            }
            if ($_FILES['annexure3_declaration_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['annexure3_declaration_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['annexure3_declaration_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['annexure3_declaration_uploader'] = $filename;
            }
            if ($_FILES['interest_subsidy_cal_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['interest_subsidy_cal_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['interest_subsidy_cal_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['interest_subsidy_cal_uploader'] = $filename;
            }
            if ($_FILES['year_annual_prod_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['year_annual_prod_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['year_annual_prod_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['year_annual_prod_uploader'] = $filename;
            }
            if ($_FILES['year_bank_statement_uploader_for_textile']['name'] != '') {
                $main_path = 'documents/textile';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'textile';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['year_bank_statement_uploader_for_textile']['name']);
                $filename = 'textile_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['year_bank_statement_uploader_for_textile']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $checklist_data['year_bank_statement_uploader'] = $filename;
            }
        }

        $this->db->trans_start();
        $incentive_id = get_from_post('incentive_id');
        $checklist_data['incentive_id'] = $incentive_id;
        $checklist_data['user_id'] = $user_id;
        //$checklist_data['status'] = $module_type;
        $checklist_data['created_by'] = $user_id;
        $checklist_data['created_time'] = date('Y-m-d H:i:s');
        if (!$checklist_id || $checklist_id == NULL) {
            $checklist_id = $this->utility_model->insert_data('textile_checklist', $checklist_data);
        } else {
            $checklist_data['updated_by'] = $user_id;
            $checklist_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('checklist_id', $checklist_id, 'textile_checklist', $checklist_data);
        }

        $textile_update_data = array();
        $textile_update_data['updated_by'] = $user_id;
        $textile_update_data['updated_time'] = date('Y-m-d H:i:s');
        $textile_update_data['status'] = $module_type;

        $this->utility_model->update_data('incentive_id', $incentive_id, 'incentive_generalform_textile', $textile_update_data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }

        $success_array = get_success_array();
        $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
        echo json_encode($success_array);
    }

    function remove_document() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        $incentive_id = get_from_post('incentive_id');
        $document_id = get_from_post('document_id');
        $table_name = get_from_post('table_name');
        if (!is_post() || $session_user_id == NULL || !$session_user_id || !$incentive_id || $incentive_id == NULL) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_start();
        $ex_est_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, $table_name);
        if (empty($ex_est_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $file_path = 'documents' . DIRECTORY_SEPARATOR . 'textile' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data[$document_id];

        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $this->utility_model->update_data('incentive_id', $incentive_id, $table_name, array($document_id => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));

        $success_array = get_success_array();
        $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
        echo json_encode($success_array);
    }

    function generate_form1() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $incentive_id = get_from_post('incentive_id_for_textile_form1');
        if (!is_post() || $user_id == null || !$user_id || $incentive_id == null || !$incentive_id) {
            print_r(INVALID_ACCESS_MESSAGE);
            return false;
        }
        $this->db->trans_start();
        // $existing_textile_parta_data = '';
        // $existing_textile_partb_data = '';
        // $existing_textile_partc_data = '';
        // $existing_textile_partd_data = '';
        // $existing_textile_parte_data = '';

        $existing_textile_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_generalform_textile');
        $existing_scheme_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_scheme');
        //if($existing_scheme_data['parta_form'] == 1){
        $existing_textile_partf_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partf');
        // }
        // else if($existing_scheme_data['partb_form'] == 1){
        $existing_textile_partg_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_partg');
        // }
        // else if($existing_scheme_data['partc_form'] == 1){
        $existing_textile_parth_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_parth');
        // }
        $existing_textile_declaration_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'textile_declaration');

        if (empty($existing_textile_data)) {
            print_r(INVALID_ACCESS_MESSAGE);
            return;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            print_r(DATABASE_ERROR_MESSAGE);
            return;
        }
        error_reporting(E_ERROR);
        $data = array();
        // $result = array_merge($existing_textile_data,$existing_textile_partf_data,$existing_textile_partg_data,$existing_textile_parth_data,$existing_textile_declaration_data);
        // $data = array('textile_data' => $result);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->WriteHTML($this->load->view('textile/pdf', array('textile_data' => $existing_textile_data, 'textile_partf_data' => $existing_textile_partf_data, 'textile_partg_data' => $existing_textile_partg_data, 'textile_parth_data' => $existing_textile_parth_data, 'textile_declaration_data' => $existing_textile_declaration_data), TRUE));
        $mpdf->Output('FORM-I.pdf', 'I');
    }

    function get_textile_data_by_incentive_id() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $incentive_id = get_from_post('incentive_id');
        if (!$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_start();
        $textile_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_generalform_textile');
        if (empty($textile_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $success_array = get_success_array();
        $success_array['textile_data'] = $textile_data;
        echo json_encode($success_array);
    }

    function remove_fees_paid_challan() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        $incentive_id = get_from_post('incentive_id');
        if (!is_post() || $session_user_id == NULL || !$session_user_id || !$incentive_id || $incentive_id == NULL) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_start();
        $ex_est_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_generalform_textile');
        if (empty($ex_est_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $file_path = 'documents' . DIRECTORY_SEPARATOR . 'incentive_generalform_textile' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $this->utility_model->update_data('incentive_id', $incentive_id, 'incentive_generalform_textile', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
        $success_array = get_success_array();
        $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
        echo json_encode($success_array);
    }

    function upload_fees_paid_challan() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $incentive_id = get_from_post('incentive_id_for_textile_upload_challan');
        if (!is_post() || $user_id == NULL || !$user_id || $incentive_id == NULL || !$incentive_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $ex_textile_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_generalform_textile');
        if (empty($ex_textile_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        if ($ex_textile_data['user_id'] != $user_id) {
            header("Location:" . base_url() . "login");
            return false;
        }
        if ($ex_textile_data['payment_type'] == VALUE_TWO) {
            $user_payment_type = get_from_post('user_payment_type_for_textile_upload_challan');
            if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
        }
        $textile_data = array();
        if ($_FILES['fees_paid_challan_for_textile_upload_challan']['name'] != '') {
            $main_path = 'documents/textile';
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'wmtextile';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_textile_upload_challan']['name']);
            $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES['fees_paid_challan_for_textile_upload_challan']['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $textile_data['status'] = VALUE_FOUR;
            $textile_data['fees_paid_challan'] = $filename;
            $textile_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
        }
        if ($ex_textile_data['payment_type'] == VALUE_TWO) {
            if ($user_payment_type == VALUE_TWO) {
                $textile_data['status'] = VALUE_EIGHT;
            } else {
                $textile_data['status'] = VALUE_FOUR;
            }
            $textile_data['user_payment_type'] = $user_payment_type;
        } else {
            $textile_data['user_payment_type'] = VALUE_ZERO;
        }
        $textile_data['updated_by'] = $user_id;
        $textile_data['updated_time'] = date('Y-m-d H:i:s');
        $this->db->trans_start();
        $this->utility_model->update_data('incentive_id', $incentive_id, 'incentive_generalform_textile', $textile_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array = get_success_array();
        $success_array['status'] = isset($textile_data['status']) ? $textile_data['status'] : $ex_textile_data['status'];
        $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
        echo json_encode($success_array);
    }

    function generate_certificate() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $incentive_id = get_from_post('incentive_id_for_certificate');
        if (!is_post() || $user_id == null || !$user_id || $incentive_id == null || !$incentive_id) {
            print_r(INVALID_ACCESS_MESSAGE);
            return false;
        }
        $this->db->trans_start();
        $existing_textile_data = $this->utility_model->get_by_id('incentive_id', $incentive_id, 'incentive_generalform_textile');
        if (empty($existing_textile_data)) {
            print_r(INVALID_ACCESS_MESSAGE);
            return;
        }
        if ($existing_textile_data['status'] != VALUE_FIVE) {
            print_r(INVALID_ACCESS_MESSAGE);
            return;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            print_r(DATABASE_ERROR_MESSAGE);
            return;
        }
        error_reporting(E_ERROR);
        $this->utility_lib->gc_for_textile($existing_textile_data);
//        $data = array('textile_data' => $existing_textile_data);
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
//        $mpdf->WriteHTML($this->load->view('textile/certificate', $data, TRUE));
//        $mpdf->Output('Textile_certificate_' . time() . '.pdf', 'I');
    }
}

/*
 * EOF: ./application/controller/BOCW.php
 */