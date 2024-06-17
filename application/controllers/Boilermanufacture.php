<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Boilermanufacture extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('boiler_manufacture_model');
        $this->load->model('utility_model');
    }

    function get_boiler_manufacture_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['boiler_manufacture_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['boiler_manufacture_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'boilermanufactures', 'district', $search_district, 'boilermanufacture_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['boiler_manufacture_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['boiler_manufacture_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_boiler_manufacture_data_by_id() {
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
            $boiler_manufacture_id = get_from_post('boilermanufacture_id');
            if (!$boiler_manufacture_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $boiler_manufacture_data = $this->utility_model->get_by_id('boilermanufacture_id', $boiler_manufacture_id, 'boilermanufactures');
            if (empty($boiler_manufacture_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['boiler_manufacture_data'] = $boiler_manufacture_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_boiler_manufacture() {
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
            $boilermanufacture_id = get_from_post('boilermanufacture_id');
            $boiler_manufacture_data = $this->_get_post_data_for_boiler_manufacture();
            $validation_message = $this->_check_validation_for_boiler_manufacture($boiler_manufacture_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }



            $weldersData = $this->input->post('welders_data');
            $welders_decode_Data = json_decode($weldersData, true);
            if ($weldersData == "" || empty($welders_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Welders Info'));
                return false;
            }

            $technicalPersonData = $this->input->post('technical_person_data');
            $technical_person_decode_Data = json_decode($technicalPersonData, true);
            if ($technicalPersonData == "" || empty($technical_person_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Supervisor Staff Data'));
                return false;
            }



            $this->db->trans_start();
            $boiler_manufacture_data['welders_info'] = $weldersData;
            $boiler_manufacture_data['technical_personnel_info'] = $technicalPersonData;
            //$boiler_manufacture_data['status'] = get_from_post('form_status');
            $boiler_manufacture_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $boiler_manufacture_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$boilermanufacture_id || $boilermanufacture_id == NULL) {
                $boiler_manufacture_data['user_id'] = $user_id;
                $boiler_manufacture_data['created_by'] = $user_id;
                $boiler_manufacture_data['created_time'] = date('Y-m-d H:i:s');
                $boilermanufacture_id = $this->utility_model->insert_data('boilermanufactures', $boiler_manufacture_data);
            } else {
                $boiler_manufacture_data['updated_by'] = $user_id;
                $boiler_manufacture_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', $boiler_manufacture_data);
            }
            // $this->_update_image($user_id, $boilermanufacture_id, $boiler_manufacture_data, 'temp_copy_of_noc', 'copy_of_noc', 'copy_of_noc');
            // $this->_update_image($user_id, $boilermanufacture_id, $boiler_manufacture_data, 'temp_plan_of_workshop', 'plan_of_workshop', 'plan_of_workshop');
            // $this->_update_image($user_id, $boilermanufacture_id, $boiler_manufacture_data, 'temp_signature_and_seal_and_seal', 'signature_and_seal_and_seal', 'signature_and_seal_and_seal');
            // foreach ($technical_person_decode_Data as &$value) {
            //     $this->_update_image($user_id, $boilermanufacture_id, $boiler_manufacture_data, 'temp_welders_certificate', 'welders_certificate', 'welders_certificate');
            // }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYEIGHT, $boilermanufacture_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            //$success_array['message'] = FACTORY_LICENSE_SAVED_MESSAGE;
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_boiler_manufacture() {
        $boiler_manufacture_data = array();
        $boiler_manufacture_data['district'] = get_from_post('district');
        $boiler_manufacture_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $boiler_manufacture_data['name_of_firm'] = get_from_post('name_of_firm');
        $boiler_manufacture_data['address_of_workshop'] = get_from_post('address_of_workshop');
        $boiler_manufacture_data['address_of_communication'] = get_from_post('address_of_communication');
        $boiler_manufacture_data['type_of_jobs'] = get_from_post('type_of_jobs');
        $boiler_manufacture_data['tools_and_tackles'] = get_from_post('tools_and_tackles');
        $boiler_manufacture_data['standard_of_work'] = get_from_post('standard_of_work');
        $boiler_manufacture_data['controversial_issue'] = get_from_post('controversial_issue');
        $boiler_manufacture_data['power_sanction'] = get_from_post('power_sanction');
        $boiler_manufacture_data['conversant_with_boiler'] = get_from_post('conversant_with_boiler');
        $boiler_manufacture_data['testing_facility'] = get_from_post('testing_facility');
        $boiler_manufacture_data['recording_system'] = get_from_post('recording_system');
        $boiler_manufacture_data['is_internal_quality_control'] = get_from_post('is_internal_quality_control');
        if (get_from_post('is_internal_quality_control') == IS_CHECKED_YES) {
            $boiler_manufacture_data['quality_control_detail'] = get_from_post('quality_control_detail');
        }
        $boiler_manufacture_data['is_instruments_calibrated'] = get_from_post('is_instruments_calibrated');
        if (get_from_post('is_instruments_calibrated') == IS_CHECKED_YES) {
            $boiler_manufacture_data['instruments_calibrate_detail'] = get_from_post('instruments_calibrate_detail');
        }

        return $boiler_manufacture_data;
    }

    function _check_validation_for_boiler_manufacture($boiler_manufacture_data) {
        if (!$boiler_manufacture_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$boiler_manufacture_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$boiler_manufacture_data['name_of_firm']) {
            return FIRM_NAME_MESSAGE;
        }
        if (!$boiler_manufacture_data['address_of_workshop']) {
            return WORKSHOP_ADDRESS_MESSAGE;
        }
        if (!$boiler_manufacture_data['address_of_communication']) {
            return COMM_ADDRESS_MESSAGE;
        }
        if (!$boiler_manufacture_data['type_of_jobs']) {
            return JOB_TYPE_MESSAGE;
        }
        if (!$boiler_manufacture_data['tools_and_tackles']) {
            return TOOLS_MESSAGE;
        }
        if (!$boiler_manufacture_data['standard_of_work']) {
            return STANDARD_WORK_MESSAGE;
        }
        if (!$boiler_manufacture_data['controversial_issue']) {
            return CONTROVERSIAL_ISSUE_MESSAGE;
        }
        if (!$boiler_manufacture_data['power_sanction']) {
            return POWER_SANCTION_MESSAGE;
        }
        if (!$boiler_manufacture_data['conversant_with_boiler']) {
            return CONVERSANT_MESSAGE;
        }
        if (!$boiler_manufacture_data['testing_facility']) {
            return TESTING_FACILITY_MESSAGE;
        }
        if (!$boiler_manufacture_data['recording_system']) {
            return RECORD_SYSTEM_MESSAGE;
        }
        if ($boiler_manufacture_data['is_internal_quality_control'] == IS_CHECKED_YES) {
            if (!$boiler_manufacture_data['quality_control_detail']) {
                return QUALITY_CONTROL_MESSAGE;
            }
        }
        if ($boiler_manufacture_data['is_instruments_calibrated'] == IS_CHECKED_YES) {
            if (!$boiler_manufacture_data['instruments_calibrate_detail']) {
                return INSTRUMENT_CALIBRATE_MESSAGE;
            }
        }

        return '';
    }

    function _update_image($user_id, $boiler_manufacture_id, &$boiler_manufacture_data, $is_exists_doc, $post_filename, $db_field_name) {
        $form_application_data = array();
        $temp_existing_doc_name = get_from_post($is_exists_doc);
        if (!$temp_existing_doc_name) {
            $this->load->library('upload');
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . 'boilermanufactures';
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $upload_doc_path = $module_path . DIRECTORY_SEPARATOR . $boiler_manufacture_id;
            if (!is_dir($upload_doc_path)) {
                mkdir($upload_doc_path);
                chmod($upload_doc_path, 0777);
            }

            $filename = $_FILES[$post_filename]['name'];
            if (!empty($filename)) {
                //Change file name
                $new_name = preg_replace('/\s/', '_', generate_random_string(30));
                $final_path = $upload_doc_path . DIRECTORY_SEPARATOR . $new_name;
                $form_application_data[$db_field_name] = $new_name;
                $boiler_manufacture_data[$db_field_name] = $new_name;
            }
        }
        $form_application_data['updated_by'] = $user_id;
        $form_application_data['updated_time'] = date('Y-m-d H:i:s');
        $this->utility_model->update_data('boilermanufacture_id', $boiler_manufacture_id, 'boilermanufactures', $form_application_data);

        if (!empty($filename)) {
            if (!$temp_existing_doc_name) {
                //Upload image
                move_uploaded_file($_FILES[$post_filename]['tmp_name'], $final_path);
            }
        }
    }

    function image_validation($is_exists_doc, $post_filename) {
        $temp_existing_doc_name = get_from_post($is_exists_doc);
        if (!$temp_existing_doc_name) {
            $allowed = array('pdf', 'png', 'jpg', 'jpeg');
            //  $filename = $_FILES['upload_file_for_uploads']['name'];
            $filename = $_FILES[$post_filename]['name'];
            $invalid_image_error_message = 'Please upload Copies of single pdf with multiple pages: <b> ' . join(', ', $allowed) . ' </b> only.';
//            if (!$filename) {
//                return $invalid_image_error_message;
//            }

            if ($filename != '') {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    return $invalid_image_error_message;
                }
                if ((($_FILES[$post_filename]['size'] / 1024) / 1024) > MAX_FILE_SIZE_IN_MB) {
                    return 'Maximum upload size ' . MAX_FILE_SIZE_IN_MB . ' mb only.';
                    die;
                }
            }
        }
    }

    function delete_upload_file_for_boiler_manufacture() {
        $user_id = get_from_session('temp_id_for_eodbsws');
        $boiler_manufacture_id = get_from_post('boilermanufacture_id');
        $dbFileNameField = get_from_post('dbFileNameField');
        if (!is_post() || $user_id == NULL || !$user_id || $boiler_manufacture_id == NULL || !$boiler_manufacture_id || $dbFileNameField == NULL || !$dbFileNameField) {
            echo json_encode(get_error_array('Invalid Access'));
            return false;
        }
        $this->db->trans_start();
        $existing_application_data = $this->utility_model->get_by_id('boilermanufacture_id', $boiler_manufacture_id, 'boilermanufactures');
        if (empty($existing_application_data)) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return;
        }
        //document_file
        //move_image($dbFileNameField, $existing_application_data, "documents/boilermanufacture/$boiler_manufacture_id", 'garbage');

        $application_data = array();
        $application_data[$dbFileNameField] = '';
        $application_data['updated_by'] = $user_id;
        $application_data['updated_time'] = date('Y-m-d H:i:s');
        $this->utility_model->update_data('boilermanufacture_id', $boiler_manufacture_id, 'boilermanufactures', $application_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $application_data[$dbFileNameField] = '';
        $success_array = get_success_array();
        $success_array['message'] = 'Attached Document Removed Successfully !';
        $success_array['upload_file_for_boiler_manufacture'] = $application_data;
        echo json_encode($success_array);
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $boilermanufacture_id = get_from_post('boilermanufacture_id_for_boilermanufacture_form1');
            if (!is_post() || $user_id == null || !$user_id || $boilermanufacture_id == null || !$boilermanufacture_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_boiler_manufacture_data = $this->utility_model->get_by_id('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures');

            if (empty($existing_boiler_manufacture_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('boilermanufactures_data' => $existing_boiler_manufacture_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('boilermanufacture/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_boilermanufacture_data_by_boilermanufacture_id() {
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
            $boilermanufacture_id = get_from_post('boilermenufacture_id');
            if (!$boilermanufacture_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $boiler_manufacture_data = $this->utility_model->get_by_id('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures');
            if (empty($boiler_manufacture_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYEIGHT, $boilermanufacture_id, $boiler_manufacture_data);
            $boiler_manufacture_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYEIGHT, 'fees_bifurcation', 'module_id', $boilermanufacture_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['boiler_manufacture_data'] = $boiler_manufacture_data;
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
            $boilermanufacture_id = get_from_post('boilermenufacture_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$boilermanufacture_id || $boilermanufacture_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $boilermanufacture_id = get_from_post('boiler_manufacture_id_for_boiler_manufacture_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $boilermanufacture_id == NULL || !$boilermanufacture_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_manu_data = $this->utility_model->get_by_id('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures');
            if (empty($ex_manu_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_manu_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_manu_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_boiler_manufacture_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $boiler_manufacture_data = array();
            if ($_FILES['fees_paid_challan_for_boiler_manufacture_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'boilermanufactures';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_boiler_manufacture_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_boiler_manufacture_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $boiler_manufacture_data['status'] = VALUE_FOUR;
                $boiler_manufacture_data['fees_paid_challan'] = $filename;
                $boiler_manufacture_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_manu_data['payment_type'] == VALUE_TWO) {
                $boiler_manufacture_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $boiler_manufacture_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $boiler_manufacture_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYEIGHT, $boilermanufacture_id, $ex_manu_data['district'], $ex_manu_data['total_fees'], $boiler_manufacture_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $boiler_manufacture_data['user_payment_type'] = $user_payment_type;
            } else {
                $boiler_manufacture_data['user_payment_type'] = VALUE_ZERO;
            }
            $boiler_manufacture_data['updated_by'] = $user_id;
            $boiler_manufacture_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', $boiler_manufacture_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($boiler_manufacture_data['status']) ? $boiler_manufacture_data['status'] : $ex_manu_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_manu_data['payment_type'];
            $success_array['user_payment_type'] = $boiler_manufacture_data['user_payment_type'];
            if ($ex_manu_data['payment_type'] == VALUE_TWO && $boiler_manufacture_data['user_payment_type'] == VALUE_THREE) {
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
            $boilermanufacture_id = get_from_post('boilermanufacture_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $boilermanufacture_id == null || !$boilermanufacture_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_boilermanufacture_data = $this->utility_model->get_by_id('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures');
            if (empty($existing_boilermanufacture_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_boilermanufacture_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_boilermanufacture($existing_boilermanufacture_data);
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
            $boilermanufacture_id = get_from_post('boilermanufacture_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$boilermanufacture_id || $boilermanufacture_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_noc'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['plan_of_workshop'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['occupancy_certificate_copy'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['factory_license_copy'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['machinery_layout_copy'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['qualification_detail'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['shop_photograph_copy'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'boilermanufactures' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature_and_seal'];
            }



            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('copy_of_noc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('plan_of_workshop' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('occupancy_certificate_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('factory_license_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('machinery_layout_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('qualification_detail' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('shop_photograph_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', array('signature_and_seal' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }




            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_boiler_manufacture_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $boilermanufacture_id = get_from_post('boilermanufacture_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $boiler_manufacture_data = $this->utility_model->upload_document('copy_of_noc_for_boilermanufacture', 'boilermanufactures', 'copy_of_noc_', 'copy_of_noc');
            }
            if ($file_no == VALUE_TWO) {
                $boiler_manufacture_data = $this->utility_model->upload_document('plan_of_workshop_for_boilermanufacture', 'boilermanufactures', 'plan_of_workshop_', 'plan_of_workshop');
            }
            if ($file_no == VALUE_THREE) {
                $boiler_manufacture_data = $this->utility_model->upload_document('occupancy_certificate_copy_for_boilermanufacture', 'boilermanufactures', 'occupancy_certificate_copy_', 'occupancy_certificate_copy');
            }
            if ($file_no == VALUE_FOUR) {
                $boiler_manufacture_data = $this->utility_model->upload_document('factory_license_copy_for_boilermanufacture', 'boilermanufactures', 'factory_license_copy_', 'factory_license_copy');
            }
            if ($file_no == VALUE_FIVE) {
                $boiler_manufacture_data = $this->utility_model->upload_document('machinery_layout_copy_for_boilermanufacture', 'boilermanufactures', 'machinery_layout_copy_', 'machinery_layout_copy');
            }
            if ($file_no == VALUE_SIX) {
                $boiler_manufacture_data = $this->utility_model->upload_document('qualification_detail_for_boilermanufacture', 'boilermanufactures', 'qualification_detail_', 'qualification_detail');
            }
            if ($file_no == VALUE_SEVEN) {
                $boiler_manufacture_data = $this->utility_model->upload_document('shop_photograph_copy_for_boilermanufacture', 'boilermanufactures', 'shop_photograph_copy_', 'shop_photograph_copy');
            }
            if ($file_no == VALUE_EIGHT) {
                $boiler_manufacture_data = $this->utility_model->upload_document('signature_and_seal_for_boilermanufacture', 'boilermanufactures', 'signature_and_seal_', 'signature_and_seal');
            }
            if (!$boiler_manufacture_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$boilermanufacture_id) {
                $boiler_manufacture_data['user_id'] = $session_user_id;
                $boiler_manufacture_data['status'] = VALUE_ONE;
                $boiler_manufacture_data['created_by'] = $session_user_id;
                $boiler_manufacture_data['created_time'] = date('Y-m-d H:i:s');
                $boilermanufacture_id = $this->utility_model->insert_data('boilermanufactures', $boiler_manufacture_data);
            } else {
                $boiler_manufacture_data['updated_by'] = $session_user_id;
                $boiler_manufacture_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('boilermanufacture_id', $boilermanufacture_id, 'boilermanufactures', $boiler_manufacture_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['boiler_manufacture_data'] = $boiler_manufacture_data;
            $success_array['boilermanufacture_id'] = $boilermanufacture_id;
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