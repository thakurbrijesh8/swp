<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Industryprofile extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_industry_profile_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['industry_profile_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['industry_profile_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'company_survey', 'district', $search_district, 'company_survey_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['industry_profile_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['industry_profile_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_industry_profile_data_by_id() {
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
            $industry_profile_id = get_from_post('company_survey_id');
            if (!$industry_profile_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $this->db->trans_start();
            $industry_profile_data = $this->utility_model->get_by_id('company_survey_id', $industry_profile_id, 'company_survey');
            if (empty($industry_profile_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array['industry_profile_data'] = $industry_profile_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_industry_profile() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_eodbsws');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $company_survey_id = get_from_post('company_survey_id');
            $industry_profile_data = $this->_get_post_data_for_industry_profile();
            $validation_message = $this->_check_validation_for_industry_profile($industry_profile_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            // $company_data = array();
            // $company_data['company_address'] = $industry_profile_data['company_address'];
            // $company_data['industry_type'] = $industry_profile_data['industry_type'];
            // $company_data['remarks'] = $industry_profile_data['remarks'];
            // unset($industry_profile_data['company_address']);
            // unset($industry_profile_data['industry_type']);
            // unset($industry_profile_data['remarks']);
            //$state_wise_pe = $this->input->post('state_wise_pe_details_for_survey');

            $state_wise_pe = $this->input->post('state_wise_pe_details_for_survey');
            $tate_wise_pe_decode_Data = json_decode($state_wise_pe, true);
            if ($state_wise_pe == "" || empty($tate_wise_pe_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Persons Employed Data'));
                return false;
            }

            // if (!empty($state_wise_pe)) {
            //     foreach ($state_wise_pe as &$value) {
            //         $value['user_id'] = $session_user_id;
            //         $value['created_time'] = date('Y-m-d H:i:s');
            //     }
            // }
            if (is_array($industry_profile_data['connectivity'])) {
                $industry_profile_data['connectivity'] = implode(',', $industry_profile_data['connectivity']);
            }
            if (!is_array($industry_profile_data['ipc'])) {
                $temp_arr = array();
                array_push($temp_arr, $industry_profile_data['ipc']);
                $industry_profile_data['ipc'] = $temp_arr;
            }
            $industry_profile_data['ipc'] = json_encode($industry_profile_data['ipc']);
            $this->db->trans_start();
            //$industry_profile_data['status'] = $module_type;
            $industry_profile_data['pe'] = $state_wise_pe;
            if (!$company_survey_id || $company_survey_id == NULL) {
                $industry_profile_data['user_id'] = $user_id;
                $industry_profile_data['created_by'] = $user_id;
                $industry_profile_data['created_time'] = date('Y-m-d H:i:s');
                $company_survey_id = $this->utility_model->insert_data('company_survey', $industry_profile_data);
            } else {
                $industry_profile_data['updated_by'] = $user_id;
                $industry_profile_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('company_survey_id', $company_survey_id, 'company_survey', $industry_profile_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = UPDATE_COMPANY_PROFILE_MESSAGE;
            // $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_industry_profile() {
        $industry_profile_data = array();
        $industry_profile_data['company_name'] = get_from_post('company_name_for_survey');
        $industry_profile_data['entrepreneur_name'] = get_from_post('entrepreneur_name_for_survey');
        $industry_profile_data['company_address'] = get_from_post('company_address_for_survey');
        $industry_profile_data['estate_name'] = get_from_post('estate_name_for_survey');
        $industry_profile_data['estate_details'] = get_from_post('estate_details_for_survey');
        $industry_profile_data['udyog_aadhar_memorandum'] = get_from_post('udyog_aadhar_memorandum_for_survey');
        $industry_profile_data['pan_number'] = get_from_post('pan_number_for_survey');
        $industry_profile_data['official_address'] = get_from_post('official_address_for_survey');
        $industry_profile_data['authorized_person_name'] = get_from_post('authorized_person_name_for_survey');
        $industry_profile_data['authorized_person_contactno'] = get_from_post('authorized_person_contactno_for_survey');
        $industry_profile_data['authorized_person_email'] = get_from_post('authorized_person_email_for_survey');
        $industry_profile_data['industry_type'] = get_from_post('industry_type_for_survey');
        $industry_profile_data['remarks'] = get_from_post('remarks_for_survey');
        $industry_profile_data['turnover'] = get_from_post('turnover_for_survey');
        $industry_profile_data['major_activity'] = get_from_post('major_activity_for_survey');
        $industry_profile_data['nature_activity'] = get_from_post('nature_activity_for_survey');
        $industry_profile_data['social_category'] = get_from_post('social_category_for_survey');
        $industry_profile_data['gender'] = get_from_post('gender_for_survey');
        $industry_profile_data['differently_abled'] = get_from_post('differently_abled_for_survey');
        $industry_profile_data['organization_type'] = get_from_post('organization_type_for_survey');
        $industry_profile_data['other_organization'] = get_from_post('other_organization_for_survey');
        $industry_profile_data['pcc_category'] = get_from_post('pcc_category_for_survey');
        $industry_profile_data['total_employment'] = get_from_post('total_employment_for_survey');
        $industry_profile_data['skilled_employment'] = get_from_post('skilled_employment_for_survey');
        $industry_profile_data['semi_skilled_employment'] = get_from_post('semi_skilled_employment_for_survey');
        $industry_profile_data['unskilled_employment'] = get_from_post('unskilled_employment_for_survey');
        $industry_profile_data['managerial_employment'] = get_from_post('managerial_employment_for_survey');
        $industry_profile_data['lcc_employment'] = get_from_post('lcc_employment_for_survey');
        $industry_profile_data['emp_tlc'] = get_from_post('emp_tlc_for_survey');
        $industry_profile_data['skilled_local_pe'] = get_from_post('skilled_local_pe_for_survey');
        $industry_profile_data['semi_skilled_local_pe'] = get_from_post('semi_skilled_local_pe_for_survey');
        $industry_profile_data['unskilled_local_pe'] = get_from_post('unskilled_local_pe_for_survey');
        $industry_profile_data['emp_pf'] = get_from_post('emp_pf_for_survey');
        $industry_profile_data['emp_is'] = get_from_post('emp_is_for_survey');
        $industry_profile_data['emp_ois'] = get_from_post('emp_ois_for_survey');
        $industry_profile_data['investment'] = get_from_post('investment_for_survey');
        $industry_profile_data['ipc'] = $this->input->post('ipc_for_survey');
        $industry_profile_data['raw_material'] = get_from_post('raw_material_for_survey');
        $industry_profile_data['major_product'] = get_from_post('major_product_for_survey');
        $industry_profile_data['industrial_process'] = get_from_post('industrial_process_for_survey');
        $industry_profile_data['past_year_turnover'] = get_from_post('past_year_turnover_for_survey');
        $industry_profile_data['intial_production_year'] = get_from_post('intial_production_year_for_survey');
        $industry_profile_data['expansion_year'] = get_from_post('expansion_year_for_survey');
        $industry_profile_data['proposed_expansion_year'] = get_from_post('proposed_expansion_year_for_survey');
        $industry_profile_data['skill_requirement'] = get_from_post('skill_requirement_for_survey');
        $industry_profile_data['loan_outstanding'] = get_from_post('loan_outstanding_for_survey');
        $industry_profile_data['interest_outstanding_loan'] = get_from_post('interest_outstanding_loan_for_survey');
        $industry_profile_data['subsidy'] = get_from_post('subsidy_for_survey');
        $industry_profile_data['grants'] = get_from_post('grants_for_survey');
        $industry_profile_data['foreign_direct_investment'] = get_from_post('foreign_direct_investment_for_survey');
        $industry_profile_data['registered_number'] = get_from_post('registered_number_for_survey');
        $industry_profile_data['is_gstin'] = get_from_post('is_gstin_for_survey');
        $industry_profile_data['gstin_number'] = $industry_profile_data['is_gstin'] == VALUE_ONE ? get_from_post('gstin_number_for_survey') : '';
        $industry_profile_data['social_distancing'] = get_from_post('social_distancing_for_survey');
        $industry_profile_data['thermal_screening'] = get_from_post('thermal_screening_for_survey');
        $industry_profile_data['mask_availability'] = get_from_post('mask_availability_for_survey');
        $industry_profile_data['face_shield'] = get_from_post('face_shield_for_survey');
        $industry_profile_data['washing_hands'] = get_from_post('washing_hands_for_survey');
        $industry_profile_data['avoiding_water'] = get_from_post('avoiding_water_for_survey');
        $industry_profile_data['phsw'] = get_from_post('phsw_for_survey');
        $industry_profile_data['cleanliness'] = get_from_post('cleanliness_for_survey');
        $industry_profile_data['overcrowding'] = get_from_post('overcrowding_for_survey');
        $industry_profile_data['arrangements'] = get_from_post('arrangements_for_survey');
        $industry_profile_data['fire_saftey_measures'] = get_from_post('fire_saftey_measures_for_survey');
        $industry_profile_data['washing_facilities'] = get_from_post('washing_facilities_for_survey');
        $industry_profile_data['first_aid_appliances'] = get_from_post('first_aid_appliances_for_survey');
        $industry_profile_data['workers_quarters'] = get_from_post('workers_quarters_for_survey');
        $industry_profile_data['quarters_number'] = get_from_post('quarters_number_for_survey');
        $industry_profile_data['canteen'] = get_from_post('canteen_for_survey');
        $industry_profile_data['commu_fiber'] = get_from_post('commu_fiber_for_survey');
        $industry_profile_data['srl'] = get_from_post('srl_for_survey');
        $industry_profile_data['connectivity'] = $this->input->post('connectivity_for_survey');
        $industry_profile_data['creches'] = get_from_post('creches_for_survey');
        $industry_profile_data['apprenticeship'] = get_from_post('apprenticeship_for_survey');
        $industry_profile_data['saftey_measures'] = get_from_post('saftey_measures_for_survey');
        $industry_profile_data['pollution_control_measures'] = get_from_post('pollution_control_measures_for_survey');
        $industry_profile_data['air_pcm'] = get_from_post('air_pcm_for_survey');
        $industry_profile_data['etmc'] = get_from_post('etmc_for_survey');
        $industry_profile_data['liquid_waste'] = get_from_post('liquid_waste_for_survey');
        $industry_profile_data['solid_waste'] = get_from_post('solid_waste_for_survey');
        $industry_profile_data['hazardous_waste'] = get_from_post('hazardous_waste_for_survey');
        $industry_profile_data['e_waste'] = get_from_post('e_waste_for_survey');
        $industry_profile_data['liquor_waste'] = get_from_post('liquor_waste_for_survey');
        $industry_profile_data['wpit'] = get_from_post('wpit_for_survey');
        $industry_profile_data['unit_status'] = get_from_post('unit_status_for_survey');
        $industry_profile_data['tax_due_ppy'] = get_from_post('tax_due_ppy_for_survey');
        return $industry_profile_data;
    }

    function _check_validation_for_industry_profile($industry_profile_data) {
        if (!$industry_profile_data['company_name']) {
            return COMPANY_NAME_MESSAGE;
        }
        if (!$industry_profile_data['entrepreneur_name']) {
            return ENTREPRENEUR_NAME_MESSAGE;
        }
        if (!$industry_profile_data['company_address']) {
            return COMPANY_ADDRESS_MESSAGE;
        }
        if (!$industry_profile_data['estate_name']) {
            return ESTATE_NAME_MESSAGE;
        }
        if (!$industry_profile_data['udyog_aadhar_memorandum']) {
            return UDYOG_AADHAR_MEMORANDUM_MESSAGE;
        }
        if (!$industry_profile_data['official_address']) {
            return OFFICIAL_ADDRESS_MESSAGE;
        }
        if (!$industry_profile_data['authorized_person_name']) {
            return PERSON_NAME_MESSAGE;
        }
        if (!$industry_profile_data['authorized_person_contactno']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$industry_profile_data['authorized_person_email']) {
            return EMAIL_MESSAGE;
        }

        return '';
    }

    function generate_form1() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $company_survey_id = get_from_post('company_survey_id_for_company_survey_form1');
            if (!is_post() || $user_id == null || !$user_id || $company_survey_id == null || !$company_survey_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_company_survey_data = $this->utility_model->get_by_id('company_survey_id', $company_survey_id, 'company_survey');

            if (empty($existing_company_survey_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('company_survey_data' => $existing_company_survey_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('company_survey/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_company_survey_data_by_company_survey_id() {
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
            $company_survey_id = get_from_post('company_survey_id');
            if (!$company_survey_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $industry_profile_data = $this->utility_model->get_by_id('company_survey_id', $company_survey_id, 'company_survey');
            if (empty($industry_profile_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['industry_profile_data'] = $industry_profile_data;
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
            $company_survey_id = get_from_post('company_survey_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$company_survey_id || $company_survey_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('company_survey_id', $company_survey_id, 'company_survey');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'company_survey' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('company_survey_id', $company_survey_id, 'company_survey', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $company_survey_id = get_from_post('industry_profile_id_for_industry_profile_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $company_survey_id == NULL || !$company_survey_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_blr_data = $this->utility_model->get_by_id('company_survey_id', $company_survey_id, 'company_survey');
            if (empty($ex_blr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_blr_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_blr_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_industry_profile_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $industry_profile_data = array();
            if ($_FILES['fees_paid_challan_for_industry_profile_upload_challan']['name'] != '') {
                $main_path = 'documents/company_survey';
                // if (!is_dir($main_path)) {
                //     mkdir($main_path);
                //     chmod("$main_path", 0755);
                // }
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'company_survey';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_industry_profile_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_industry_profile_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $industry_profile_data['status'] = VALUE_FOUR;
                $industry_profile_data['fees_paid_challan'] = $filename;
                $industry_profile_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_blr_data['payment_type'] == VALUE_TWO) {
                if ($user_payment_type == VALUE_TWO) {
                    $industry_profile_data['status'] = VALUE_EIGHT;
                } else {
                    $industry_profile_data['status'] = VALUE_FOUR;
                }
                $industry_profile_data['user_payment_type'] = $user_payment_type;
            } else {
                $industry_profile_data['user_payment_type'] = VALUE_ZERO;
            }
            $industry_profile_data['updated_by'] = $user_id;
            $industry_profile_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('company_survey_id', $company_survey_id, 'company_survey', $industry_profile_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($industry_profile_data['status']) ? $industry_profile_data['status'] : $ex_blr_data['status'];
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
            $company_survey_id = get_from_post('company_survey_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $company_survey_id == null || !$company_survey_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_boiler_data = $this->utility_model->get_by_id('company_survey_id', $company_survey_id, 'company_survey');
            if (empty($existing_boiler_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_boiler_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_company_survey($existing_boiler_data);
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
            $company_survey_id = get_from_post('company_survey_id');
            $document_id = get_from_post('document_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$company_survey_id || $company_survey_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('company_survey_id', $company_survey_id, 'company_survey');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'company_survey' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data[$document_id];

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('company_survey_id', $company_survey_id, 'company_survey', array($document_id => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/BOCW.php
 */