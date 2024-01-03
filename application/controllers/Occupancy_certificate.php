<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Occupancy_certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_occupancycertificate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['occupancycertificate_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['occupancycertificate_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'occupancy_certificate', 'district', $search_district, 'occupancy_certificate_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['occupancycertificate_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['occupancycertificate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_occupancycertificate_data_by_id() {
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
            $occupancy_certificate_id = get_from_post('occupancy_certificate_id');
            if (!$occupancy_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $occupancycertificate_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate');
            if (empty($occupancycertificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['occupancycertificate_data'] = $occupancycertificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_occupancycertificate_renewal_data_by_id() {
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
            $occupancy_certificate_id = get_from_post('occupancy_certificate_id');
            if (!$occupancy_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $occupancycertificate_renewal_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancycertificate_renewal');
            if (empty($occupancycertificate_renewal_data)) {
                $occupancycertificate_renewal_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate');
                if (empty($occupancycertificate_renewal_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            //$occupancycertificate_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate');   

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['occupancycertificate_data'] = $occupancycertificate_renewal_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_occupancycertificate() {
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
            $occupancy_certificate_id = get_from_post('occupancy_certificate_id');
            $occupancycertificate_data = $this->_get_post_data_for_occupancycertificate();
            $validation_message = $this->_check_validation_for_occupancycertificate($occupancycertificate_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $occupancycertificate_data['completed_on'] = $occupancycertificate_data['completed_on'] != '' ? convert_to_mysql_date_format($occupancycertificate_data['completed_on']) : '';
            $occupancycertificate_data['occupancy_valid_upto'] = $occupancycertificate_data['occupancy_valid_upto'] != '' ? convert_to_mysql_date_format($occupancycertificate_data['occupancy_valid_upto']) : '';
            $occupancycertificate_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $occupancycertificate_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$occupancy_certificate_id || $occupancy_certificate_id == NULL) {
                $occupancycertificate_data['user_id'] = $user_id;
                $occupancycertificate_data['created_by'] = $user_id;
                $occupancycertificate_data['created_time'] = date('Y-m-d H:i:s');
                $occupancy_certificate_id = $this->utility_model->insert_data('occupancy_certificate', $occupancycertificate_data);
            } else {
                $occupancycertificate_data['updated_by'] = $user_id;
                $occupancycertificate_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', $occupancycertificate_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYEIGHT, $occupancy_certificate_id);
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

    function _get_post_data_for_occupancycertificate() {
        $occupancycertificate_data = array();
        $occupancycertificate_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $occupancycertificate_data['district'] = get_from_post('district');
        $occupancycertificate_data['plot_no'] = get_from_post('plot_no');
        $occupancycertificate_data['survey_no'] = get_from_post('survey_no');
        $occupancycertificate_data['situated_at'] = get_from_post('situated_at');
        $occupancycertificate_data['license_no'] = get_from_post('license_no');
        $occupancycertificate_data['completed_on'] = get_from_post('completed_on');
        $occupancycertificate_data['licensed_engineer_name'] = get_from_post('licensed_engineer_name');
        $occupancycertificate_data['owner_name'] = get_from_post('owner_name');
        $occupancycertificate_data['occupancy_registration_no'] = get_from_post('occupancy_registration_no');
        $occupancycertificate_data['occupancy_valid_upto'] = get_from_post('occupancy_valid_upto');
        $occupancycertificate_data['address'] = get_from_post('address');
        $occupancycertificate_data['is_fire_noc'] = get_from_post('is_fire_noc');
        $occupancycertificate_data['is_existing_building_plan'] = get_from_post('is_existing_building_plan');
        $occupancycertificate_data['is_form_of_indemnity'] = get_from_post('is_form_of_indemnity');
        $occupancycertificate_data['is_stability_certificate'] = get_from_post('is_stability_certificate');
        $occupancycertificate_data['is_occupancy_certificate_dnh'] = get_from_post('is_occupancy_certificate_dnh');
        return $occupancycertificate_data;
    }

    function _check_validation_for_occupancycertificate($occupancycertificate_data) {
        if (!$occupancycertificate_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$occupancycertificate_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$occupancycertificate_data['situated_at']) {
            return SITUATED_AT_MESSAGE;
        }
        if (!$occupancycertificate_data['license_no']) {
            return LICENSE_NO_MESSAGE;
        }
        if (!$occupancycertificate_data['occupancy_registration_no']) {
            return OCCUPANCY_REGISTRATION_NO_MESSAGE;
        }
        if (!$occupancycertificate_data['address']) {
            return OCCUPANCY_ADDRESS_MESSAGE;
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
            $occupancy_certificate_id = get_from_post('occupancy_certificate_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$occupancy_certificate_id || $occupancy_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['annexure_14'];
            } if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['oc_part_oc'];
            } if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_construction_permission'];
            } if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_building_plan'];
            } if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['stability_certificate'];
            } if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['building_height_noc'];
            } if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['fire_noc'];
            } if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_water_harvesting'];
            } if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['existing_building_plan'];
            } if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['form_of_indemnity'];
            } if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['fire_emergency'];
            } if ($document_type == VALUE_TWELVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['building_plan'];
            } if ($document_type == VALUE_THIRTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['stability_certificate_dnh'];
            } if ($document_type == VALUE_FOURTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['occupancy_certificate_dnh'];
            } if ($document_type == VALUE_FIFTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['existing_cp'];
            } if ($document_type == VALUE_SIXTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['labour_cess_certificate'];
            } if ($document_type == VALUE_SEVENTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['valuation_certificate'];
            } if ($document_type == VALUE_EIGHTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['bank_deposit_sleep'];
            } if ($document_type == VALUE_NINETEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['deviation_photographs'];
            } if ($document_type == VALUE_TWENTY) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_7_12'];
            } if ($document_type == VALUE_TWENTYONE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['certificate_map'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }


            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('annexure_14' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('oc_part_oc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('copy_of_construction_permission' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('copy_of_building_plan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('stability_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('building_height_noc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('fire_noc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('copy_of_water_harvesting' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('existing_building_plan    ' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('form_of_indemnity' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('fire_emergency' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_TWELVE) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('building_plan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_THIRTEEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('stability_certificate_dnh' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_FOURTEEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('occupancy_certificate_dnh' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_FIFTEEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('existing_cp' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_SIXTEEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('labour_cess_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_SEVENTEEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('valuation_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_EIGHTEEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('bank_deposit_sleep' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_NINETEEN) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('deviation_photographs' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_TWENTY) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('copy_7_12' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } if ($document_type == VALUE_TWENTYONE) {
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('certificate_map' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $occupancycertificate_id = get_from_post('occupancycertificate_id_for_occupancycertificate_form1');
            if (!is_post() || $user_id == null || !$user_id || $occupancycertificate_id == null || !$occupancycertificate_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_occupancycertificate_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancycertificate_id, 'occupancy_certificate');

            if (empty($existing_occupancycertificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('occupancycertificate_data' => $existing_occupancycertificate_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('occupancycertificate/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_occupancycertificate_data_by_occupancycertificate_id() {
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
            $occupancycertificate_id = get_from_post('occupancycertificate_id');
            if (!$occupancycertificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $occupancycertificate_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancycertificate_id, 'occupancy_certificate');
            if (empty($occupancycertificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWENTYEIGHT, $occupancycertificate_id, $occupancycertificate_data);
            $occupancycertificate_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWENTYEIGHT, 'fees_bifurcation', 'module_id', $occupancycertificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['occupancycertificate_data'] = $occupancycertificate_data;
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
            $occupancy_certificate_id = get_from_post('occupancy_certificate_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$occupancy_certificate_id || $occupancy_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'occupancycertificate' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $occupancy_certificate_id = get_from_post('occupancycertificate_id_for_occupancycertificate_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $occupancy_certificate_id == NULL || !$occupancy_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_oc_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate');
            if (empty($ex_oc_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_oc_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_occupancycertificate_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $occupancycertificate_data = array();
            if ($_FILES['fees_paid_challan_for_occupancycertificate_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'occupancycertificate';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_occupancycertificate_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_occupancycertificate_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $occupancycertificate_data['status'] = VALUE_FOUR;
                $occupancycertificate_data['fees_paid_challan'] = $filename;
                $occupancycertificate_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_oc_data['payment_type'] == VALUE_TWO) {
                $occupancycertificate_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $occupancycertificate_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $occupancycertificate_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWENTYEIGHT, $occupancy_certificate_id, $ex_oc_data['district'], $ex_oc_data['total_fees'], $occupancycertificate_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $occupancycertificate_data['user_payment_type'] = $user_payment_type;
            } else {
                $occupancycertificate_data['user_payment_type'] = VALUE_ZERO;
            }
            $occupancycertificate_data['updated_by'] = $user_id;
            $occupancycertificate_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', $occupancycertificate_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($occupancycertificate_data['status']) ? $occupancycertificate_data['status'] : $ex_oc_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_oc_data['payment_type'];
            $success_array['user_payment_type'] = $occupancycertificate_data['user_payment_type'];
            if ($ex_oc_data['payment_type'] == VALUE_TWO && $occupancycertificate_data['user_payment_type'] == VALUE_THREE) {
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
            $occupancy_certificate_id = get_from_post('occupancycertificate_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $occupancy_certificate_id == null || !$occupancy_certificate_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_occupancycertificate_data = $this->utility_model->get_by_id('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate');
            if (empty($existing_occupancycertificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_occupancycertificate_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_occupancycertificate($existing_occupancycertificate_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_occupancy_certificate_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $occupancy_certificate_id = get_from_post('occupancy_certificate_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $occupancycertificate_data = $this->utility_model->upload_document('annexure_14_for_occupancycertificate', 'occupancycertificate', 'annexure_14_', 'annexure_14');
            }
            if ($file_no == VALUE_TWO) {
                $occupancycertificate_data = $this->utility_model->upload_document('oc_part_oc_for_occupancycertificate', 'occupancycertificate', 'oc_part_oc_', 'oc_part_oc');
            }
            if ($file_no == VALUE_THREE) {
                $occupancycertificate_data = $this->utility_model->upload_document('copy_of_construction_permission_for_occupancycertificate', 'occupancycertificate', 'copy_of_construction_permission_', 'copy_of_construction_permission');
            }
            if ($file_no == VALUE_FOUR) {
                $occupancycertificate_data = $this->utility_model->upload_document('copy_of_building_plan_for_occupancycertificate', 'occupancycertificate', 'copy_of_building_plan_', 'copy_of_building_plan');
            }
            if ($file_no == VALUE_FIVE) {
                $occupancycertificate_data = $this->utility_model->upload_document('stability_certificate_for_occupancycertificate', 'occupancycertificate', 'stability_certificate_', 'stability_certificate');
            }
            if ($file_no == VALUE_SIX) {
                $occupancycertificate_data = $this->utility_model->upload_document('building_height_noc_for_occupancycertificate', 'occupancycertificate', 'building_height_noc_', 'building_height_noc');
            }
            if ($file_no == VALUE_SEVEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('fire_noc_for_occupancycertificate', 'occupancycertificate', 'fire_noc_', 'fire_noc');
            }
            if ($file_no == VALUE_EIGHT) {
                $occupancycertificate_data = $this->utility_model->upload_document('copy_of_water_harvesting_for_occupancycertificate', 'occupancycertificate', 'copy_of_water_harvesting_', 'copy_of_water_harvesting');
            }
            if ($file_no == VALUE_NINE) {
                $occupancycertificate_data = $this->utility_model->upload_document('existing_building_plan_for_occupancycertificate', 'occupancycertificate', 'existing_building_plan_', 'existing_building_plan');
            }
            if ($file_no == VALUE_TEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('form_of_indemnity_for_occupancycertificate', 'occupancycertificate', 'form_of_indemnity_', 'form_of_indemnity');
            }
            if ($file_no == VALUE_ELEVEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('fire_emergency_for_occupancycertificate', 'occupancycertificate', 'fire_emergency_', 'fire_emergency');
            }
            if ($file_no == VALUE_TWELVE) {
                $occupancycertificate_data = $this->utility_model->upload_document('building_plan_for_occupancycertificate', 'occupancycertificate', 'building_plan_', 'building_plan');
            }
            if ($file_no == VALUE_THIRTEEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('stability_certificate_dnh_for_occupancycertificate', 'occupancycertificate', 'stability_certificate_dnh_', 'stability_certificate_dnh');
            }
            if ($file_no == VALUE_FOURTEEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('occupancy_certificate_dnh_for_occupancycertificate', 'occupancycertificate', 'occupancy_certificate_dnh_', 'occupancy_certificate_dnh');
            }
            if ($file_no == VALUE_FIFTEEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('existing_cp_for_occupancycertificate', 'occupancycertificate', 'existing_cp_', 'existing_cp');
            }
            if ($file_no == VALUE_SIXTEEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('labour_cess_certificate_for_occupancycertificate', 'occupancycertificate', 'labour_cess_certificate_', 'labour_cess_certificate');
            }
            if ($file_no == VALUE_SEVENTEEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('valuation_certificate_for_occupancycertificate', 'occupancycertificate', 'valuation_certificate_', 'valuation_certificate');
            }
            if ($file_no == VALUE_EIGHTEEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('bank_deposit_sleep_for_occupancycertificate', 'occupancycertificate', 'bank_deposit_sleep_', 'bank_deposit_sleep');
            }
            if ($file_no == VALUE_NINETEEN) {
                $occupancycertificate_data = $this->utility_model->upload_document('deviation_photographs_for_occupancycertificate', 'occupancycertificate', 'deviation_photographs_', 'deviation_photographs');
            }
            if ($file_no == VALUE_TWENTY) {
                $occupancycertificate_data = $this->utility_model->upload_document('copy_7_12_for_occupancycertificate', 'occupancycertificate', 'copy_7_12_', 'copy_7_12');
            }
            if ($file_no == VALUE_TWENTYONE) {
                $occupancycertificate_data = $this->utility_model->upload_document('certificate_map_for_occupancycertificate', 'occupancycertificate', 'certificate_map_', 'certificate_map');
            }
            if (!$occupancycertificate_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$occupancy_certificate_id) {
                $occupancycertificate_data['user_id'] = $session_user_id;
                $occupancycertificate_data['status'] = VALUE_ONE;
                $occupancycertificate_data['created_by'] = $session_user_id;
                $occupancycertificate_data['created_time'] = date('Y-m-d H:i:s');
                $occupancy_certificate_id = $this->utility_model->insert_data('occupancy_certificate', $occupancycertificate_data);
            } else {
                $occupancycertificate_data['updated_by'] = $session_user_id;
                $occupancycertificate_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('occupancy_certificate_id', $occupancy_certificate_id, 'occupancy_certificate', $occupancycertificate_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['occupancycertificate_data'] = $occupancycertificate_data;
            $success_array['occupancy_certificate_id'] = $occupancy_certificate_id;
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