<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Factorylicense extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_factory_license_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['factory_license_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['factory_license_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'factorylicence', 'district', $search_district, 'factorylicence_id', 'DESC', 'status', $search_status);
            if ($this->db->trans_status() === FALSE) {
                $success_array['factory_license_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['factory_license_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_factory_license_data_by_id() {
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
            $factory_license_id = get_from_post('factorylicense_id');
            if (!$factory_license_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $factory_license_data = $this->utility_model->get_by_id('factorylicence_id', $factory_license_id, 'factorylicence');
            if (empty($factory_license_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['factory_license_data'] = $factory_license_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_factory_license() {
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

            $factorylicence_id = get_from_post('factorylicence_id');
            $factory_license_data = $this->_get_post_data_for_factory_license();
            $validation_message = $this->_check_validation_for_factory_license($factory_license_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $directorsData = $this->input->post('directors_data');
            $directors_decode_Data = json_decode($directorsData, true);
            // if ($directorsData == "" || empty($directors_decode_Data)) {
            //     echo json_encode(get_error_array('Enter Atlist One Directors Data'));
            //     return false;
            // }

            $managingdirectorsData = $this->input->post('managing_directors_data');
            $managing_directors_decode_Data = json_decode($managingdirectorsData, true);
            // if ($managingdirectorsData == "" || empty($managing_directors_decode_Data)) {
            //     echo json_encode(get_error_array('Enter Atlist One Managing Directors Data'));
            //     return false;
            // }

            if ($this->input->post('is_factory_exists') == IS_CHECKED_YES) {
                $productData = $this->input->post('product_data');
                $product_decode_Data = json_decode($productData, true);
                if ($productData == "" || empty($product_decode_Data)) {
                    echo json_encode(get_error_array('Enter Atlist One Products Data'));
                    return false;
                }
            }

            $this->db->trans_start();
            $factory_license_data['director_info'] = $directorsData;
            $factory_license_data['managing_director_info'] = $managingdirectorsData;
            if ($this->input->post('is_factory_exists') == IS_CHECKED_YES) {
                $factory_license_data['product_data'] = $productData;
            }
            $factory_license_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $factory_license_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$factorylicence_id || $factorylicence_id == NULL) {
                $factory_license_data['user_id'] = $user_id;
                $factory_license_data['created_by'] = $user_id;
                $factory_license_data['created_time'] = date('Y-m-d H:i:s');
                $factorylicence_id = $this->utility_model->insert_data('factorylicence', $factory_license_data);
            } else {
                $factory_license_data['updated_by'] = $user_id;
                $factory_license_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', $factory_license_data);
            }

            // $this->_update_image($user_id, $factorylicence_id, $factory_license_data, 'temp_sign_of_occupier', 'sign_of_occupier', 'sign_of_occupier');
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYFIVE, $factorylicence_id);
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

    function _get_post_data_for_factory_license() {
        $factory_license_data = array();
        $factory_license_data['district'] = get_from_post('district');
        $factory_license_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $factory_license_data['name_of_factory'] = get_from_post('name_of_factory');
        $factory_license_data['factory_address'] = get_from_post('factory_address');
        $factory_license_data['factory_postal_address'] = get_from_post('factory_postal_address');
        $factory_license_data['is_factory_exists'] = get_from_post('is_factory_exists');
        $factory_license_data['work_carried'] = get_from_post('work_carried');
        $factory_license_data['max_no_of_worker_year'] = get_from_post('max_no_of_worker_year');
        $factory_license_data['no_of_ordinarily_emp'] = get_from_post('no_of_ordinarily_emp');
        $factory_license_data['total_power_install'] = get_from_post('total_power_install');
        $factory_license_data['total_power_used'] = get_from_post('total_power_used');
        $factory_license_data['max_power_to_be_used'] = get_from_post('max_power_to_be_used');
        $factory_license_data['manager_detail'] = get_from_post('manager_detail');
        $factory_license_data['occupier_detail'] = get_from_post('occupier_detail');
        $factory_license_data['proprietor_of_factory'] = get_from_post('proprietor_of_factory');
        $factory_license_data['share_holders'] = get_from_post('share_holders');
        $factory_license_data['chief_head'] = get_from_post('chief_head');
        $factory_license_data['owner_detail'] = get_from_post('owner_detail');
        $factory_license_data['factory_extend'] = get_from_post('factory_extend');
        if (get_from_post('is_factory_exists') == IS_CHECKED_YES) {
            $factory_license_data['factory_license_no'] = get_from_post('factory_license_no');
            $factory_license_data['nature_of_work'] = get_from_post('nature_of_work');
            $factory_license_data['max_no_of_worker_month'] = get_from_post('max_no_of_worker_month');
        }
        if (get_from_post('factory_extend') == IS_CHECKED_YES) {
            $factory_license_data['reference_no'] = get_from_post('reference_no');
            $factory_license_data['date_of_approval'] = get_from_post('date_of_approval');
            $factory_license_data['date_of_approval'] = convert_to_mysql_date_format($factory_license_data['date_of_approval']);
            $factory_license_data['disposal_waste'] = get_from_post('disposal_waste');
            $factory_license_data['name_of_authority'] = get_from_post('name_of_authority');
        }
        return $factory_license_data;
    }

    function _check_validation_for_factory_license($factory_license_data) {
        if (!$factory_license_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$factory_license_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$factory_license_data['name_of_factory']) {
            return FACTORY_NAME_MESSAGE;
        }
        if (!$factory_license_data['factory_address']) {
            return FACTORY_ADDRESS_MESSAGE;
        }
        if (!$factory_license_data['factory_postal_address']) {
            return FACTORY_POSTAL_ADDRESS_MESSAGE;
        }
        if (!$factory_license_data['work_carried']) {
            return MANUFACTURING_NATURE_MESSAGE;
        }
        if (!$factory_license_data['max_no_of_worker_year']) {
            return MAX_WORKER_MESSAGE;
        }
        // if (!$factory_license_data['no_of_ordinarily_emp']) {
        //     return MAX_WORKER_MESSAGE;
        // }
        if (!$factory_license_data['total_power_install']) {
            return POWER_MESSAGE;
        }
        if (!$factory_license_data['total_power_used']) {
            return POWER_MESSAGE;
        }
        if (!$factory_license_data['max_power_to_be_used']) {
            return POWER_MESSAGE;
        }
        if (!$factory_license_data['manager_detail']) {
            return MANAGER_MESSAGE;
        }
        if (!$factory_license_data['occupier_detail']) {
            return OCCUPIER_MESSAGE;
        }
        if (!$factory_license_data['proprietor_of_factory']) {
            return FACTORY_PROPRIETOR_MESSAGE;
        }
        if (!$factory_license_data['share_holders']) {
            return SHARE_HOLDER_MESSAGE;
        }

        if (get_from_post('is_factory_exists') == IS_CHECKED_YES) {
            if (!$factory_license_data['factory_license_no']) {
                return FACTORY_LICENSE_NO_MESSAGE;
            }
            if (!$factory_license_data['nature_of_work']) {
                return MANUFACTURING_NATURE_MESSAGE;
            }
            if (!$factory_license_data['max_no_of_worker_month']) {
                return MAX_WORKER_MESSAGE;
            }
        }
        if (get_from_post('factory_extend') == IS_CHECKED_YES) {
            if (!$factory_license_data['reference_no']) {
                return REFERENCE_NO_MESSAGE;
            }
            if (!$factory_license_data['date_of_approval']) {
                return APPROVAL_DATE_MESSAGE;
            }
            if (!$factory_license_data['disposal_waste']) {
                return DISPOSAL_WASTE_MESSAGE;
            }
            if (!$factory_license_data['name_of_authority']) {
                return AUTHORITY_NAME_MESSAGE;
            }
        }
        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $factorylicence_id = get_from_post('factorylicense_id_for_factorylicense_form1');
            if (!is_post() || $user_id == null || !$user_id || $factorylicence_id == null || !$factorylicence_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_factory_license_data = $this->utility_model->get_by_id('factorylicence_id', $factorylicence_id, 'factorylicence');

            if (empty($existing_factory_license_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('factorylicense_data' => $existing_factory_license_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('factorylicense/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_factorylicense_data_by_factorylicense_id() {
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
            $factorylicence_id = get_from_post('factorylicence_id');
            if (!$factorylicence_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $factory_license_data = $this->utility_model->get_by_id('factorylicence_id', $factorylicence_id, 'factorylicence');
            if (empty($factory_license_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYFIVE, $factorylicence_id, $factory_license_data);
            $factory_license_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYFIVE, 'fees_bifurcation', 'module_id', $factorylicence_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['factory_license_data'] = $factory_license_data;
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
            $factorylicence_id = get_from_post('factorylicence_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$factorylicence_id || $factorylicence_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('factorylicence_id', $factorylicence_id, 'factorylicence');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicence' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $factorylicence_id = get_from_post('factory_license_id_for_factory_license_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $factorylicence_id == NULL || !$factorylicence_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_fact_data = $this->utility_model->get_by_id('factorylicence_id', $factorylicence_id, 'factorylicence');
            if (empty($ex_fact_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_fact_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_factory_license_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $factory_license_data = array();
            if ($_FILES['fees_paid_challan_for_factory_license_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'factorylicense';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_factory_license_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_factory_license_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $factory_license_data['status'] = VALUE_FOUR;
                $factory_license_data['fees_paid_challan'] = $filename;
                $factory_license_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_fact_data['payment_type'] == VALUE_TWO) {
                $factory_license_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $factory_license_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $factory_license_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYFIVE, $factorylicence_id, $ex_fact_data['district'], $ex_fact_data['total_fees'], $factory_license_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $factory_license_data['user_payment_type'] = $user_payment_type;
            } else {
                $factory_license_data['user_payment_type'] = VALUE_ZERO;
            }
            $factory_license_data['updated_by'] = $user_id;
            $factory_license_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', $factory_license_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($factory_license_data['status']) ? $factory_license_data['status'] : $ex_fact_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_fact_data['payment_type'];
            $success_array['user_payment_type'] = $factory_license_data['user_payment_type'];
            if ($ex_fact_data['payment_type'] == VALUE_TWO && $factory_license_data['user_payment_type'] == VALUE_THREE) {
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
            $factorylicence_id = get_from_post('factorylicense_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $factorylicence_id == null || !$factorylicence_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_factorylicence_data = $this->utility_model->get_by_id('factorylicence_id', $factorylicence_id, 'factorylicence');
            if (empty($existing_factorylicence_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_factorylicence_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_factorylicence($existing_factorylicence_data);
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
            $factorylicence_id = get_from_post('factorylicence_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$factorylicence_id || $factorylicence_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('factorylicence_id', $factorylicence_id, 'factorylicence');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['form_two_copy'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['occupancy_certificate'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['stability_certificate'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['safety_equipments_list'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['machinery_layout'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['approved_plan_copy'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['safety_provision'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_site_plans'];
            }

            if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['plan_approval'];
            }
            if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['self_certificate'];
            }
            if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['project_report'];
            }
            if ($document_type == VALUE_TWELVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['land_document_copy'];
            }
            if ($document_type == VALUE_THIRTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['ssi_registration_copy'];
            }
            if ($document_type == VALUE_FOURTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['detail_of_etp'];
            }
            if ($document_type == VALUE_FIFTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['questionnaire_copy'];
            }
            if ($document_type == VALUE_SIXTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'factorylicense' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sign_of_occupier'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('form_two_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('occupancy_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('stability_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('safety_equipments_list' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('machinery_layout' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('approved_plan_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('safety_provision' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('copy_of_site_plans' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('plan_approval' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('self_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('project_report' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWELVE) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('land_document_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THIRTEEN) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('ssi_registration_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOURTEEN) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('detail_of_etp' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIFTEEN) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('questionnaire_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIXTEEN) {
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', array('sign_of_occupier' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }



            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_factorylicense_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $factorylicence_id = get_from_post('factorylicence_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $factory_license_data = $this->utility_model->upload_document('form_two_copy_for_factorylicense', 'factorylicense', 'form_two_copy_', 'form_two_copy');
            }
            if ($file_no == VALUE_TWO) {
                $factory_license_data = $this->utility_model->upload_document('occupancy_certificate_for_factorylicense', 'factorylicense', 'occupancy_certificate_', 'occupancy_certificate');
            }
            if ($file_no == VALUE_THREE) {
                $factory_license_data = $this->utility_model->upload_document('stability_certificate_for_factorylicense', 'factorylicense', 'stability_certificate_', 'stability_certificate');
            }
            if ($file_no == VALUE_FOUR) {
                $factory_license_data = $this->utility_model->upload_document('safety_equipments_list_for_factorylicense', 'factorylicense', 'safety_equipments_list_', 'safety_equipments_list');
            }
            if ($file_no == VALUE_FIVE) {
                $factory_license_data = $this->utility_model->upload_document('machinery_layout_for_factorylicense', 'factorylicense', 'machinery_layout_', 'machinery_layout');
            }
            if ($file_no == VALUE_SIX) {
                $factory_license_data = $this->utility_model->upload_document('approved_plan_copy_for_factorylicense', 'factorylicense', 'approved_plan_copy_', 'approved_plan_copy');
            }
            if ($file_no == VALUE_SEVEN) {
                $factory_license_data = $this->utility_model->upload_document('safety_provision_for_factorylicense', 'factorylicense', 'safety_provision_', 'safety_provision');
            }
            if ($file_no == VALUE_EIGHT) {
                $factory_license_data = $this->utility_model->upload_document('copy_of_site_plans_for_factorylicense', 'factorylicense', 'copy_of_site_plans_', 'copy_of_site_plans');
            }

            if ($file_no == VALUE_NINE) {
                $factory_license_data = $this->utility_model->upload_document('plan_approval_for_factorylicense', 'factorylicense', 'plan_approval_', 'plan_approval');
            }
            if ($file_no == VALUE_TEN) {
                $factory_license_data = $this->utility_model->upload_document('self_certificate_for_factorylicense', 'factorylicense', 'self_certificate_', 'self_certificate');
            }
            if ($file_no == VALUE_ELEVEN) {
                $factory_license_data = $this->utility_model->upload_document('project_report_for_factorylicense', 'factorylicense', 'project_report_', 'project_report');
            }
            if ($file_no == VALUE_TWELVE) {
                $factory_license_data = $this->utility_model->upload_document('land_document_copy_for_factorylicense', 'factorylicense', 'land_document_copy_', 'land_document_copy');
            }
            if ($file_no == VALUE_THIRTEEN) {
                $factory_license_data = $this->utility_model->upload_document('ssi_registration_copy_for_factorylicense', 'factorylicense', 'ssi_registration_copy_', 'ssi_registration_copy');
            }
            if ($file_no == VALUE_FOURTEEN) {
                $factory_license_data = $this->utility_model->upload_document('detail_of_etp_for_factorylicense', 'factorylicense', 'detail_of_etp_', 'detail_of_etp');
            }
            if ($file_no == VALUE_FIFTEEN) {
                $factory_license_data = $this->utility_model->upload_document('questionnaire_copy_for_factorylicense', 'factorylicense', 'questionnaire_copy_', 'questionnaire_copy');
            }
            if ($file_no == VALUE_SIXTEEN) {
                $factory_license_data = $this->utility_model->upload_document('seal_and_stamp_for_factorylicense', 'factorylicense', 'sign_of_occupier_', 'sign_of_occupier');
            }
            if (!$factory_license_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$factorylicence_id) {
                $factory_license_data['user_id'] = $session_user_id;
                $factory_license_data['status'] = VALUE_ONE;
                $factory_license_data['created_by'] = $session_user_id;
                $factory_license_data['created_time'] = date('Y-m-d H:i:s');
                $factorylicence_id = $this->utility_model->insert_data('factorylicence', $factory_license_data);
            } else {
                $factory_license_data['updated_by'] = $session_user_id;
                $factory_license_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('factorylicence_id', $factorylicence_id, 'factorylicence', $factory_license_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['success'] = TRUE;
            $success_array['factory_license_data'] = $factory_license_data;
            $success_array['factorylicence_id'] = $factorylicence_id;
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