<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Construction extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    function get_construction_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['construction_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['construction_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'construction', 'district', $search_district, 'construction_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['construction_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['construction_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_construction_data_by_id() {
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
            $construction_id = get_from_post('construction_id');
            if (!$construction_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $construction_data = $this->utility_model->get_by_id('construction_id', $construction_id, 'construction');
            if (empty($construction_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['construction_data'] = $construction_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_construction() {
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
            $construction_id = get_from_post('construction_id');
            $construction_data = $this->_get_post_data_for_construction();
            $validation_message = $this->_check_validation_for_construction($construction_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $construction_data['valid_upto_date'] = $construction_data['valid_upto_date'] != '' ? convert_to_mysql_date_format($construction_data['valid_upto_date']) : '';
            $construction_data['application_date'] = convert_to_mysql_date_format($construction_data['application_date']);
            $construction_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $construction_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$construction_id || $construction_id == NULL) {
                // $construction_data['declaration'] = VALUE_ONE;
                //  $construction_data['application_date'] = date('Y-m-d');
                $construction_data['user_id'] = $user_id;
                $construction_data['created_by'] = $user_id;
                $construction_data['created_time'] = date('Y-m-d H:i:s');
                $construction_id = $this->utility_model->insert_data('construction', $construction_data);
            } else {
                $construction_data['updated_by'] = $user_id;
                $construction_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', $construction_data);
            }

            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_TWENTYSIX, $construction_id);
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

    function _get_post_data_for_construction() {
        $construction_data = array();
        $construction_data['district'] = get_from_post('district');
        $construction_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $construction_data['name_of_owner'] = get_from_post('name_of_owner');
        $construction_data['address_of_owner'] = get_from_post('address_of_owner');
        $construction_data['building_no'] = get_from_post('building_no');
        $construction_data['plot_no'] = get_from_post('plot_no');
        $construction_data['village'] = get_from_post('village');
        $construction_data['name'] = get_from_post('name');
        $construction_data['license_no'] = get_from_post('license_no');
        $construction_data['application_date'] = get_from_post('application_date');
        $construction_data['annexureV'] = get_from_post('annexureV');
        $construction_data['provisional_noc'] = get_from_post('provisional_noc');
        $construction_data['crz_clearance'] = get_from_post('crz_clearance');
        $construction_data['sub_division'] = get_from_post('sub_division');
        $construction_data['amalgamation'] = get_from_post('amalgamation');
        $construction_data['occupancy'] = get_from_post('occupancy');
        $construction_data['certificate_land'] = get_from_post('certificate_land');
        $construction_data['valid_upto_date'] = get_from_post('valid_upto_date');
        $construction_data['district'] = get_from_post('district');
        $construction_data['annexureVI'] = get_from_post('annexureVI');
        $construction_data['layoutplan'] = get_from_post('layoutplan');
        return $construction_data;
    }

    function _check_validation_for_construction($construction_data) {
        if (!$construction_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$construction_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$construction_data['name_of_owner']) {
            return OWNER_NAME_MESSAGE;
        }
        if (!$construction_data['address_of_owner']) {
            return OWNER_ADDRESS_MESSAGE;
        }
        if (!$construction_data['village']) {
            return VILLAGE_MESSAGE;
        }
        if (!$construction_data['name']) {
            return ARCHITECT_NAME_MESSAGE;
        }

        return '';
    }

    // 
    function remove_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $construction_id = get_from_post('construction_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$construction_id || $construction_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('construction_id', $construction_id, 'construction');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['annexure_III'];
            } else if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['annexure_IV'];
            } else if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['copy_of_na'];
            } else if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['original_certified_map'];
            } else if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['I_and_XIV_nakal'];
            } else if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['building_plan_dcr'];
            } else if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['cost_estimate'];
            } else if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['noc_coast_guard'];
            } else if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['annexure_V'];
            } else if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['provisional_noc_fire'];
            } else if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['crz_clearance_certificate'];
            } else if ($document_type == VALUE_TWELVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['sub_division_order'];
            } else if ($document_type == VALUE_THIRTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['amalgamation_order'];
            } else if ($document_type == VALUE_FOURTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['occupancy_certificate'];
            } else if ($document_type == VALUE_FIFTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['certificate_land_acquisition'];
            } else if ($document_type == VALUE_SIXTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['signature'];
            } else if ($document_type == VALUE_SEVENTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['annexure_VI'];
            } else if ($document_type == VALUE_EIGHTEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['layout_plan'];
            } else if ($document_type == VALUE_NINETEEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['licensed_engineer_signature'];
            } else if ($document_type == VALUE_TWENTY) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['labour_cess'];
            } else if ($document_type == VALUE_TWENTYONE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['undertaking'];
            } else if ($document_type == VALUE_TWENTYTWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['fire_noc'];
            } else if ($document_type == VALUE_TWENTYTHREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['owner_signature'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }


            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('annexure_III' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('annexure_IV' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('copy_of_na' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('original_certified_map' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('I_and_XIV_nakal' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('building_plan_dcr' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('cost_estimate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('noc_coast_guard' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('annexure_V    ' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('provisional_noc_fire' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('crz_clearance_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWELVE) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('sub_division_order' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_THIRTEEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('amalgamation_order' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FOURTEEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('occupancy_certificate' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FIFTEEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('certificate_land_acquisition' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SIXTEEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SEVENTEEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('annexure_VI' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_EIGHTEEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('layout_plan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_NINETEEN) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('licensed_engineer_signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWENTY) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('labour_cess' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWENTYONE) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('undertaking' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWENTYTWO) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('fire_noc' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWENTYTHREE) {
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('owner_signature' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $construction_id = get_from_post('construction_id_for_construction_form1');
            if (!is_post() || $user_id == null || !$user_id || $construction_id == null || !$construction_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_construction_data = $this->utility_model->get_by_id('construction_id', $construction_id, 'construction');

            if (empty($existing_construction_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('construction_data' => $existing_construction_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('construction/pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_construction_data_by_construction_id() {
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
            $construction_id = get_from_post('construction_id');
            if (!$construction_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $construction_data = $this->utility_model->get_by_id('construction_id', $construction_id, 'construction');
            if (empty($construction_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_TWENTYSIX, $construction_id, $construction_data);
            $construction_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_TWENTYSIX, 'fees_bifurcation', 'module_id', $construction_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['construction_data'] = $construction_data;
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
            $construction_id = get_from_post('construction_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$construction_id || $construction_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('construction_id', $construction_id, 'construction');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'construction' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('construction_id', $construction_id, 'construction', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
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
            $construction_id = get_from_post('construction_id_for_construction_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $construction_id == NULL || !$construction_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('construction_id', $construction_id, 'construction');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_construction_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $construction_data = array();
            if ($_FILES['fees_paid_challan_for_construction_upload_challan']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'construction';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_construction_upload_challan']['name']);
                $filename = 'fees_paid_challan_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_construction_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $construction_data['status'] = VALUE_FOUR;
                $construction_data['fees_paid_challan'] = $filename;
                $construction_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $construction_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $construction_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $construction_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_TWENTYSIX, $construction_id, $ex_em_data['district'], $ex_em_data['total_fees'], $construction_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $construction_data['user_payment_type'] = $user_payment_type;
            } else {
                $construction_data['user_payment_type'] = VALUE_ZERO;
            }
            $construction_data['updated_by'] = $user_id;
            $construction_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('construction_id', $construction_id, 'construction', $construction_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($construction_data['status']) ? $construction_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $construction_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $construction_data['user_payment_type'] == VALUE_THREE) {
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
            $construction_id = get_from_post('construction_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $construction_id == null || !$construction_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_construction_data = $this->utility_model->get_by_id('construction_id', $construction_id, 'construction');
            if (empty($existing_construction_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($existing_construction_data['status'] != VALUE_FIVE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $this->utility_lib->gc_for_construction($existing_construction_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function upload_construction_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $construction_id = get_from_post('construction_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $construction_data = $this->utility_model->upload_document('annexure_III_for_construction', 'construction', 'annexure_III_', 'annexure_III');
            }
            if ($file_no == VALUE_TWO) {
                $construction_data = $this->utility_model->upload_document('annexure_IV_for_construction', 'construction', 'annexure_IV_', 'annexure_IV');
            }
            if ($file_no == VALUE_THREE) {
                $construction_data = $this->utility_model->upload_document('copy_of_na_for_construction', 'construction', 'copy_of_na_', 'copy_of_na');
            }
            if ($file_no == VALUE_FOUR) {
                $construction_data = $this->utility_model->upload_document('original_certified_map_for_construction', 'construction', 'original_certified_map_', 'original_certified_map');
            }
            if ($file_no == VALUE_FIVE) {
                $construction_data = $this->utility_model->upload_document('I_and_XIV_nakal_for_construction', 'construction', 'I_and_XIV_nakal_', 'I_and_XIV_nakal');
            }
            if ($file_no == VALUE_SIX) {
                $construction_data = $this->utility_model->upload_document('building_plan_dcr_for_construction', 'construction', 'building_plan_dcr_', 'building_plan_dcr');
            }
            if ($file_no == VALUE_SEVEN) {
                $construction_data = $this->utility_model->upload_document('cost_estimate_for_construction', 'construction', 'cost_estimate_', 'cost_estimate');
            }
            if ($file_no == VALUE_EIGHT) {
                $construction_data = $this->utility_model->upload_document('noc_coast_guard_for_construction', 'construction', 'noc_coast_guard_', 'noc_coast_guard');
            }
            if ($file_no == VALUE_NINE) {
                $construction_data = $this->utility_model->upload_document('annexure_V_for_construction', 'construction', 'annexure_V_', 'annexure_V');
            }
            if ($file_no == VALUE_TEN) {
                $construction_data = $this->utility_model->upload_document('provisional_noc_fire_for_construction', 'construction', 'provisional_noc_fire_', 'provisional_noc_fire');
            }
            if ($file_no == VALUE_ELEVEN) {
                $construction_data = $this->utility_model->upload_document('crz_clearance_certificate_for_construction', 'construction', 'crz_clearance_certificate_', 'crz_clearance_certificate');
            }
            if ($file_no == VALUE_TWELVE) {
                $construction_data = $this->utility_model->upload_document('sub_division_order_for_construction', 'construction', 'sub_division_order_', 'sub_division_order');
            }
            if ($file_no == VALUE_THIRTEEN) {
                $construction_data = $this->utility_model->upload_document('amalgamation_order_for_construction', 'construction', 'amalgamation_order_', 'amalgamation_order');
            }
            if ($file_no == VALUE_FOURTEEN) {
                $construction_data = $this->utility_model->upload_document('occupancy_certificate_for_construction', 'construction', 'occupancy_certificate_', 'occupancy_certificate');
            }
            if ($file_no == VALUE_FIFTEEN) {
                $construction_data = $this->utility_model->upload_document('certificate_land_acquisition_for_construction', 'construction', 'certificate_land_acquisition_', 'certificate_land_acquisition');
            }
            if ($file_no == VALUE_SIXTEEN) {
                $construction_data = $this->utility_model->upload_document('seal_and_stamp_for_construction', 'construction', 'signature_', 'signature');
            }
            if ($file_no == VALUE_SEVENTEEN) {
                $construction_data = $this->utility_model->upload_document('annexure_VI_for_construction', 'construction', 'annexure_VI_', 'annexure_VI');
            }
            if ($file_no == VALUE_EIGHTEEN) {
                $construction_data = $this->utility_model->upload_document('layout_plan_for_construction', 'construction', 'layout_plan_', 'layout_plan');
            }
            if ($file_no == VALUE_NINETEEN) {
                $construction_data = $this->utility_model->upload_document('licensed_engineer_signature_for_construction', 'construction', 'licensed_engineer_signature_', 'licensed_engineer_signature');
            }
            if ($file_no == VALUE_TWENTY) {
                $construction_data = $this->utility_model->upload_document('labour_cess_for_construction', 'construction', 'labour_cess_', 'labour_cess');
            }
            if ($file_no == VALUE_TWENTYONE) {
                $construction_data = $this->utility_model->upload_document('undertaking_for_construction', 'construction', 'undertaking_', 'undertaking');
            }
            if ($file_no == VALUE_TWENTYTWO) {
                $construction_data = $this->utility_model->upload_document('fire_noc_for_construction', 'construction', 'fire_noc_', 'fire_noc');
            }
            if ($file_no == VALUE_TWENTYTHREE) {
                $construction_data = $this->utility_model->upload_document('owner_signature_for_construction', 'construction', 'owner_signature_', 'owner_signature');
            }
            if (!$construction_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$construction_id) {
                $construction_data['user_id'] = $session_user_id;
                $construction_data['status'] = VALUE_ONE;
                $construction_data['created_by'] = $session_user_id;
                $construction_data['created_time'] = date('Y-m-d H:i:s');
                $construction_id = $this->utility_model->insert_data('construction', $construction_data);
            } else {
                $construction_data['updated_by'] = $session_user_id;
                $construction_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('construction_id', $construction_id, 'construction', $construction_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['construction_data'] = $construction_data;
            $success_array['construction_id'] = $construction_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Construction.php
 */