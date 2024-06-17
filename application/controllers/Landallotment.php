<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landallotment extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_landallotment_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['landallotment_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['landallotment_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'land_allotment', 'district', $search_district, 'landallotment_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['landallotment_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['landallotment_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_landallotment_data_by_id() {
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
            $landallotment_id = get_from_post('landallotment_id');
            if (!$landallotment_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $landallotment_data = $this->utility_model->get_by_id('landallotment_id', $landallotment_id, 'land_allotment');
            if (empty($landallotment_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['landallotment_data'] = $landallotment_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_landallotment() {
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
            $landallotment_id = get_from_post('landallotment_id');
            $landallotment_data = $this->_get_post_data_for_landallotment();
            $validation_message = $this->_check_validation_for_landallotment($landallotment_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $proprietorData = $this->input->post('proprietor_data');
            $proprietor_decode_Data = json_decode($proprietorData, true);
            if ($proprietorData == "" || empty($proprietor_decode_Data)) {
                echo json_encode(get_error_array('Enter Atlist One Proprietor Data'));
                return false;
            }


            $this->db->trans_start();
            $landallotment_data['application_date'] = convert_to_mysql_date_format($landallotment_data['application_date']);

            $landallotment_data['proprietor_details'] = $proprietorData;

            $landallotment_data['district'] = TALUKA_DNH;
            $landallotment_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $landallotment_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$landallotment_id || $landallotment_id == NULL) {
                $landallotment_data['user_id'] = $user_id;
                $landallotment_data['created_by'] = $user_id;
                $landallotment_data['created_time'] = date('Y-m-d H:i:s');
                $landallotment_data['declaration'] = VALUE_ONE;
                $landallotment_data['application_date'] = date('Y-m-d');
                $landallotment_id = $this->utility_model->insert_data('land_allotment', $landallotment_data);
            } else {
                //$landallotment_data['is_vacant'] = VALUE_ZERO;
                $landallotment_data['updated_by'] = $user_id;
                $landallotment_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', $landallotment_data);
            }

            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYFIVE, $landallotment_id);
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

    function _get_post_data_for_landallotment() {
        $landallotment_data = array();
        $landallotment_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $landallotment_data['name_of_applicant'] = get_from_post('name_of_applicant');
        $landallotment_data['applicant_address'] = get_from_post('applicant_address');
        $landallotment_data['application_date'] = get_from_post('application_date');
        $landallotment_data['email'] = get_from_post('email');
        $landallotment_data['telehpone_no'] = get_from_post('telehpone_no');
        $landallotment_data['village'] = get_from_post('villages_for_noc_data');
        $landallotment_data['plot_no'] = get_from_post('plot_no_for_landallotment_data');
        $landallotment_data['govt_industrial_estate_area'] = get_from_post('govt_industrial_estate_area');
        $landallotment_data['expansion_industry'] = get_from_post('expansion_industry');
        $landallotment_data['nature_of_industry'] = get_from_post('nature_of_industry');
        $landallotment_data['constitution_artical'] = get_from_post('constitution_artical');
        $landallotment_data['possession_of_industry_plot'] = get_from_post('possession_of_industry_plot');
        $landallotment_data['industrial_license_necessary'] = get_from_post('industrial_license_necessary');
        $landallotment_data['obtained_letter_of_intent'] = get_from_post('obtained_letter_of_intent');
        $landallotment_data['regist_letter_msme'] = get_from_post('regist_letter_msme');
        $landallotment_data['if_project_collaboration'] = get_from_post('if_project_collaboration');
        $landallotment_data['project_collaboration'] = get_from_post('project_collaboration');
        $landallotment_data['if_project_requires_import'] = get_from_post('if_project_requires_import');
        $landallotment_data['project_requires_import'] = get_from_post('project_requires_import');
        $landallotment_data['no_of_persons_likely_emp'] = get_from_post('no_of_persons_likely_emp');
        $landallotment_data['no_of_persons_likely_emp_no'] = get_from_post('no_of_persons_likely_emp_no');
        $landallotment_data['no_of_persons_likely_emp_unskilled'] = get_from_post('no_of_persons_likely_emp_unskilled');
        $landallotment_data['no_of_persons_likely_emp_no_unskilled'] = get_from_post('no_of_persons_likely_emp_no_unskilled');
        $landallotment_data['no_of_persons_likely_emp_staff'] = get_from_post('no_of_persons_likely_emp_staff');
        $landallotment_data['no_of_persons_likely_emp_no_staff'] = get_from_post('no_of_persons_likely_emp_no_staff');
        $landallotment_data['if_backward_class_bac'] = get_from_post('if_backward_class_bac');
        $landallotment_data['if_backward_class_scst'] = get_from_post('if_backward_class_scst');
        $landallotment_data['if_backward_class_ex_serv'] = get_from_post('if_backward_class_ex_serv');
        $landallotment_data['if_backward_class_wm'] = get_from_post('if_backward_class_wm');
        $landallotment_data['if_backward_class_ph'] = get_from_post('if_backward_class_ph');
        $landallotment_data['if_belonging_transg'] = get_from_post('if_belonging_transg');
        $landallotment_data['if_belonging_other'] = get_from_post('if_belonging_other');
        $landallotment_data['if_bonafide'] = get_from_post('if_bonafide');
        $landallotment_data['ifnot_state_particular_place'] = get_from_post('ifnot_state_particular_place');
        $landallotment_data['state_particular_place'] = get_from_post('state_particular_place');
        $landallotment_data['detail_of_space'] = get_from_post('detail_of_space');
        $landallotment_data['treatment_indicate'] = get_from_post('treatment_indicate');
        $landallotment_data['detail_of_emission_of_gases'] = get_from_post('detail_of_emission_of_gases');
        $landallotment_data['if_promotion_council'] = get_from_post('if_promotion_council');
        return $landallotment_data;
    }

    function _check_validation_for_landallotment($landallotment_data) {
        // if (!$landallotment_data['district']) {
        //     return SELECT_DISTRICT;
        // }
        if (!$landallotment_data['name_of_applicant']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$landallotment_data['applicant_address']) {
            return APPLICANT_ADDRESS_MESSAGE;
        }
        if (!$landallotment_data['email']) {
            return EMAIL_MESSAGE;
        }
        if (!$landallotment_data['telehpone_no']) {
            return TELEPHONE_NO_MESSAGE;
        }
        if (!$landallotment_data['village']) {
            return VILLAGE_NAME_MESSAGE;
        }
        if (!$landallotment_data['plot_no']) {
            return PLOT_NO_MESSAGE;
        }
        if (!$landallotment_data['constitution_artical']) {
            return REASON_OF_LOAN_MESSAGE;
        }
        if (!$landallotment_data['expansion_industry']) {
            return EXPANSION_INDUSTRY_MESSAGE;
        }
        if (!$landallotment_data['nature_of_industry']) {
            return NATURE_OF_INDUSTRAY_MESSAGE;
        }
        if (!$landallotment_data['possession_of_industry_plot']) {
            return POSSESSTION_OF_INDUSTRY_MESSAGE;
        }
        if (!$landallotment_data['detail_of_space']) {
            return Detail_MESSAGE;
        }
        if (!$landallotment_data['treatment_indicate']) {
            return Detail_MESSAGE;
        }
        if (!$landallotment_data['detail_of_emission_of_gases']) {
            return Detail_MESSAGE;
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
            $landallotment_id = get_from_post('landallotment_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$landallotment_id || $landallotment_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('landallotment_id', $landallotment_id, 'land_allotment');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['bio_data_doc'];
            }
            if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['constitution_artical_doc'];
            }
            if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['obtained_letter_of_intent_doc'];
            }
            if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['regist_letter_msme_doc'];
            }
            if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['detailed_project_report_doc'];
            }
            if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['proposed_finance_terms_doc'];
            }
            if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['details_of_manufacturing_doc'];
            }
            if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['if_backward_class_bac_doc'];
            }
            if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['if_backward_class_scst_doc'];
            }
            if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['if_backward_class_ex_serv_doc'];
            }
            if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['if_backward_class_wm_doc'];
            }
            if ($document_type == VALUE_TWELVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['if_backward_class_ph_doc'];
            }
            if ($document_type == VALUE_THIRTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['if_belonging_transg_doc'];
            }

            if ($document_type == VALUE_FOURTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['bonafide_of_dnh_doc'];
            }
            if ($document_type == VALUE_FIFTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['information_raw_materials_doc'];
            }
            if ($document_type == VALUE_SIXTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['infrastructure_requirement_doc'];
            }
            if ($document_type == VALUE_SEVENTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['effluent_teratment_doc'];
            }
            if ($document_type == VALUE_EIGHTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['emission_of_gases_doc'];
            }
            if ($document_type == VALUE_NINETEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_authority_letter_doc'];
            }
            if ($document_type == VALUE_TWENTY) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_project_profile_doc'];
            }
            if ($document_type == VALUE_TWENTYONE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['demand_of_deposit_draft'];
            }
            if ($document_type == VALUE_TWENTYTWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_proposed_land_doc'];
            }
            if ($document_type == VALUE_TWENTYTHREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_partnership_deed_doc'];
            }
            if ($document_type == VALUE_TWENTYFOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['relevant_experience_doc'];
            }
            if ($document_type == VALUE_TWENTYFIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['certy_by_direc_indus_doc'];
            }
            if ($document_type == VALUE_TWENTYSIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['other_relevant_doc'];
            }
            if ($document_type == VALUE_TWENTYSEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            }


            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('bio_data_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('constitution_artical_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('obtained_letter_of_intent_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('regist_letter_msme_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('detailed_project_report_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('proposed_finance_terms_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('details_of_manufacturing_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('if_backward_class_bac_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('if_backward_class_scst_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('if_backward_class_ex_serv_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('if_backward_class_wm_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWELVE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('if_backward_class_ph_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_THIRTEEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('if_belonging_transg_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            if ($document_type == VALUE_FOURTEEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('bonafide_of_dnh_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_FIFTEEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('information_raw_materials_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SIXTEEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('infrastructure_requirement_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_SEVENTEEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('effluent_teratment_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_EIGHTEEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('emission_of_gases_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_NINETEEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('copy_authority_letter_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTY) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('copy_project_profile_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTYONE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('demand_of_deposit_draft' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTYTWO) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('copy_proposed_land_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTYTHREE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('copy_of_partnership_deed_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTYFOUR) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('relevant_experience_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTYFIVE) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('certy_by_direc_indus_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTYSIX) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('other_relevant_doc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }
            if ($document_type == VALUE_TWENTYSEVEN) {
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $landallotment_id = get_from_post('landallotment_id_for_landallotment_form1');
            if (!is_post() || $user_id == null || !$user_id || $landallotment_id == null || !$landallotment_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_landallotment_data = $this->utility_model->get_by_id('landallotment_id', $landallotment_id, 'land_allotment');

            if (empty($existing_landallotment_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $village_data = $this->utility_model->get_by_id('village_id', $existing_landallotment_data['village'], 'villages');
            $existing_landallotment_data['village_name'] = $village_data['village_name'];

            $plot_data = $this->utility_model->get_by_id('plot_id', $existing_landallotment_data['plot_no'], 'plot_numbers');
            $existing_landallotment_data['plot_no'] = $plot_data['plot_no'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('landallotment_data' => $existing_landallotment_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('landallotment/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_landallotment_data_by_landallotment_id() {
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
            $landallotment_id = get_from_post('landallotment_id');
            if (!$landallotment_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $landallotment_data = $this->utility_model->get_by_id('landallotment_id', $landallotment_id, 'land_allotment');
            if (empty($landallotment_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWENTYFIVE, $landallotment_id, $landallotment_data);
            $landallotment_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWENTYFIVE, 'fees_bifurcation', 'module_id', $landallotment_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['landallotment_data'] = $landallotment_data;
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
            $landallotment_id = get_from_post('landallotment_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$landallotment_id || $landallotment_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('landallotment_id', $landallotment_id, 'land_allotment');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'landallotment' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $landallotment_id = get_from_post('landallotment_id_for_landallotment_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $landallotment_id == NULL || !$landallotment_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_la_data = $this->utility_model->get_by_id('landallotment_id', $landallotment_id, 'land_allotment');
            if (empty($ex_la_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_la_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_la_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_landallotment_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $landallotment_data = array();
            if ($_FILES['fees_paid_challan_for_landallotment_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'landallotment';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_landallotment_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_landallotment_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $landallotment_data['status'] = VALUE_FOUR;
                $landallotment_data['fees_paid_challan'] = $filename;
                $landallotment_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_la_data['payment_type'] == VALUE_TWO) {
                $landallotment_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $landallotment_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $landallotment_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWENTYFIVE, $landallotment_id, $ex_la_data['district'], $ex_la_data['total_fees'], $landallotment_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $landallotment_data['user_payment_type'] = $user_payment_type;
            } else {
                $landallotment_data['user_payment_type'] = VALUE_ZERO;
            }
            $landallotment_data['updated_by'] = $user_id;
            $landallotment_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', $landallotment_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($landallotment_data['status']) ? $landallotment_data['status'] : $ex_la_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_la_data['payment_type'];
            $success_array['user_payment_type'] = $landallotment_data['user_payment_type'];
            if ($ex_la_data['payment_type'] == VALUE_TWO && $landallotment_data['user_payment_type'] == VALUE_THREE) {
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
            $landallotment_id = get_from_post('landallotment_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $landallotment_id == null || !$landallotment_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_landallotment_data = $this->utility_model->get_by_id('landallotment_id', $landallotment_id, 'land_allotment');
            if (empty($existing_landallotment_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_landallotment_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $village_data = $this->utility_model->get_by_id('village_id', $existing_landallotment_data['village'], 'villages');
            $existing_landallotment_data['village_name'] = $village_data['village_name'];

            $plot_data = $this->utility_model->get_by_id('plot_id', $existing_landallotment_data['plot_no'], 'plot_numbers');
            $existing_landallotment_data['plot_no'] = $plot_data['plot_no'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_landallotment($existing_landallotment_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_landallotment_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $landallotment_id = get_from_post('landallotment_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $landallotment_data = $this->utility_model->upload_document('bio_data_doc_for_landallotment', 'landallotment', 'bio_data_doc_', 'bio_data_doc');
            }
            if ($file_no == VALUE_TWO) {
                $landallotment_data = $this->utility_model->upload_document('constitution_artical_doc_for_landallotment', 'landallotment', 'constitution_artical_doc_', 'constitution_artical_doc');
            }
            if ($file_no == VALUE_THREE) {
                $landallotment_data = $this->utility_model->upload_document('obtained_letter_of_intent_doc_for_landallotment', 'landallotment', 'obtained_letter_of_intent_doc_', 'obtained_letter_of_intent_doc');
            }
            if ($file_no == VALUE_FOUR) {
                $landallotment_data = $this->utility_model->upload_document('regist_letter_msme_doc_for_landallotment', 'landallotment', 'regist_letter_msme_doc_', 'regist_letter_msme_doc');
            }
            if ($file_no == VALUE_FIVE) {
                $landallotment_data = $this->utility_model->upload_document('detailed_project_report_doc_for_landallotment', 'landallotment', 'detailed_project_report_doc_', 'detailed_project_report_doc');
            }
            if ($file_no == VALUE_SIX) {
                $landallotment_data = $this->utility_model->upload_document('proposed_finance_terms_doc_for_landallotment', 'landallotment', 'proposed_finance_terms_doc_', 'proposed_finance_terms_doc');
            }
            if ($file_no == VALUE_SEVEN) {
                $landallotment_data = $this->utility_model->upload_document('details_of_manufacturing_doc_for_landallotment', 'landallotment', 'details_of_manufacturing_doc_', 'details_of_manufacturing_doc');
            }
            if ($file_no == VALUE_EIGHT) {
                $landallotment_data = $this->utility_model->upload_document('if_backward_class_bac_doc_for_landallotment', 'landallotment', 'if_backward_class_bac_doc_', 'if_backward_class_bac_doc');
            }
            if ($file_no == VALUE_NINE) {
                $landallotment_data = $this->utility_model->upload_document('if_backward_class_scst_doc_for_landallotment', 'landallotment', 'if_backward_class_scst_doc_', 'if_backward_class_scst_doc');
            }
            if ($file_no == VALUE_TEN) {
                $landallotment_data = $this->utility_model->upload_document('if_backward_class_ex_serv_doc_for_landallotment', 'landallotment', 'if_backward_class_ex_serv_doc_', 'if_backward_class_ex_serv_doc');
            }
            if ($file_no == VALUE_ELEVEN) {
                $landallotment_data = $this->utility_model->upload_document('if_backward_class_wm_doc_for_landallotment', 'landallotment', 'if_backward_class_wm_doc_', 'if_backward_class_wm_doc');
            }
            if ($file_no == VALUE_TWELVE) {
                $landallotment_data = $this->utility_model->upload_document('if_backward_class_ph_doc_for_landallotment', 'landallotment', 'if_backward_class_ph_doc_', 'if_backward_class_ph_doc');
            }
            if ($file_no == VALUE_THIRTEEN) {
                $landallotment_data = $this->utility_model->upload_document('if_belonging_transg_doc_for_landallotment', 'landallotment', 'if_belonging_transg_doc_', 'if_belonging_transg_doc');
            }
            if ($file_no == VALUE_FOURTEEN) {
                $landallotment_data = $this->utility_model->upload_document('bonafide_of_dnh_doc_for_landallotment', 'landallotment', 'bonafide_of_dnh_doc_', 'bonafide_of_dnh_doc');
            }

            if ($file_no == VALUE_FIFTEEN) {
                $landallotment_data = $this->utility_model->upload_document('information_raw_materials_doc_for_landallotment', 'landallotment', 'information_raw_materials_doc_', 'information_raw_materials_doc');
            }
            if ($file_no == VALUE_SIXTEEN) {
                $landallotment_data = $this->utility_model->upload_document('infrastructure_requirement_doc_for_landallotment', 'landallotment', 'infrastructure_requirement_doc_', 'infrastructure_requirement_doc');
            }
            if ($file_no == VALUE_SEVENTEEN) {
                $landallotment_data = $this->utility_model->upload_document('effluent_teratment_doc_for_landallotment', 'landallotment', 'effluent_teratment_doc_', 'effluent_teratment_doc');
            }
            if ($file_no == VALUE_EIGHTEEN) {
                $landallotment_data = $this->utility_model->upload_document('emission_of_gases_doc_for_landallotment', 'landallotment', 'emission_of_gases_doc_', 'emission_of_gases_doc');
            }
            if ($file_no == VALUE_NINETEEN) {
                $landallotment_data = $this->utility_model->upload_document('copy_authority_letter_doc_for_landallotment', 'landallotment', 'copy_authority_letter_doc_', 'copy_authority_letter_doc');
            }
            if ($file_no == VALUE_TWENTY) {
                $landallotment_data = $this->utility_model->upload_document('copy_project_profile_doc_for_landallotment', 'landallotment', 'copy_project_profile_doc_', 'copy_project_profile_doc');
            }
            if ($file_no == VALUE_TWENTYONE) {
                $landallotment_data = $this->utility_model->upload_document('demand_of_deposit_draft_for_landallotment', 'landallotment', 'demand_of_deposit_draft_', 'demand_of_deposit_draft');
            }
            if ($file_no == VALUE_TWENTYTWO) {
                $landallotment_data = $this->utility_model->upload_document('copy_proposed_land_doc_for_landallotment', 'landallotment', 'copy_proposed_land_doc_', 'copy_proposed_land_doc');
            }
            if ($file_no == VALUE_TWENTYTHREE) {
                $landallotment_data = $this->utility_model->upload_document('copy_of_partnership_deed_doc_for_landallotment', 'landallotment', 'copy_of_partnership_deed_doc_', 'copy_of_partnership_deed_doc');
            }
            if ($file_no == VALUE_TWENTYFOUR) {
                $landallotment_data = $this->utility_model->upload_document('relevant_experience_doc_for_landallotment', 'landallotment', 'relevant_experience_doc_', 'relevant_experience_doc');
            }
            if ($file_no == VALUE_TWENTYFIVE) {
                $landallotment_data = $this->utility_model->upload_document('certy_by_direc_indus_doc_for_landallotment', 'landallotment', 'certy_by_direc_indus_doc_', 'certy_by_direc_indus_doc');
            }
            if ($file_no == VALUE_TWENTYSIX) {
                $landallotment_data = $this->utility_model->upload_document('other_relevant_doc_for_landallotment', 'landallotment', 'other_relevant_doc_', 'other_relevant_doc');
            }

            if ($file_no == VALUE_TWENTYSEVEN) {
                $landallotment_data = $this->utility_model->upload_document('seal_and_stamp_for_landallotment', 'landallotment', 'signature_', 'signature');
            }
            if (!$landallotment_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$landallotment_id) {
                $landallotment_data['user_id'] = $session_user_id;
                $landallotment_data['status'] = VALUE_ONE;
                $landallotment_data['created_by'] = $session_user_id;
                $landallotment_data['created_time'] = date('Y-m-d H:i:s');
                $landallotment_id = $this->utility_model->insert_data('land_allotment', $landallotment_data);
            } else {
                $landallotment_data['updated_by'] = $session_user_id;
                $landallotment_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('landallotment_id', $landallotment_id, 'land_allotment', $landallotment_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['landallotment_data'] = $landallotment_data;
            $success_array['landallotment_id'] = $landallotment_id;
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