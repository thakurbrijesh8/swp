<?php

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
    }

    public function index() {
        
    }

    public function get_all_shop() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $success_array = get_success_array();
            $success_array['shop_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_district = get_from_post('search_district') ? get_from_post('search_district') : null;
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $this->db->trans_start();
            $success_array['shop_data'] = $this->utility_model->get_result_data_by_id('user_id', $session_user_id, 'shop', 'district', $search_district, 's_id', 'DESC', 'status', $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['shop_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['shop_data'] = array();
            echo json_encode($success_array);
        }
    }

    public function submit_shop() {
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
            $s_id = get_from_post('s_id');
            $shop_data = $this->_get_post_data();
            $validation_message = $this->_check_validation($shop_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $shop_data['s_employers_family_details'] = $this->input->post('employer_family_info_data');
            $shop_data['s_employees_details'] = $this->input->post('employees_info_data');
            $shop_data['multiple_partner'] = $this->input->post('partner_info_data');
            $shop_data['s_commencement_of_business_date'] = convert_to_mysql_date_format($shop_data['s_commencement_of_business_date']);
            $shop_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $shop_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$s_id || $s_id == NULL) {
                $shop_data['user_id'] = $user_id;
                $shop_data['s_declaration'] = VALUE_ONE;
                $shop_data['created_by'] = $user_id;
                $shop_data['created_time'] = date('Y-m-d H:i:s');
                $s_id = $this->utility_model->insert_data('shop', $shop_data);
            } else {
                $shop_data['updated_by'] = $user_id;
                $shop_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('s_id', $s_id, 'shop', $shop_data);
            }
            if ($module_type == VALUE_TWO) {
                $this->utility_lib->send_sms_and_email_for_app_submitted($user_id, VALUE_SIX, VALUE_THIRTYTHREE, $s_id);
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

    public function _get_post_data() {
        $shop_data = array();
        $shop_data['district'] = get_from_post('district');
        $shop_data['entity_establishment_type'] = get_from_post('entity_establishment_type');
        $shop_data['regi_category'] = get_from_post('regi_category');
        $shop_data['s_name'] = get_from_post('name_for_shop');
        $shop_data['s_door_no'] = get_from_post('door_no_for_shop');
        $shop_data['s_street_name'] = get_from_post('street_name_for_shop');
        $shop_data['s_location'] = get_from_post('loaction_for_shop');
        $shop_data['s_postal_address'] = get_from_post('postal_address_for_shop');
        $shop_data['s_different_location'] = get_from_post('different_location_for_shop');
        if ($shop_data['s_different_location'] == IS_CHECKED_YES) {
            $shop_data['s_different_location_office'] = get_from_post('office_location_for_shop');
            $shop_data['s_different_location_store_room'] = get_from_post('store_room_location_for_shop');
            $shop_data['s_different_location_godown'] = get_from_post('godown_location_for_shop');
            $shop_data['s_different_location_warehouse'] = get_from_post('warehouse_location_for_shop');
        } else {
            $shop_data['s_different_location_office'] = '';
            $shop_data['s_different_location_store_room'] = '';
            $shop_data['s_different_location_godown'] = '';
            $shop_data['s_different_location_warehouse'] = '';
        }

        $shop_data['s_employer_name'] = get_from_post('name_of_employer_for_shop');
        $shop_data['s_employer_mobile_no'] = get_from_post('mobile_no_employer_for_shop');
        $shop_data['s_employer_residential_address'] = get_from_post('residential_address_employer_for_shop');
        $shop_data['s_manager_name'] = get_from_post('manager_name_for_shop');
        $shop_data['s_manager_residential_address'] = get_from_post('residential_address_manager_for_shop');
        $shop_data['s_category'] = get_from_post('category_for_shop');
        $shop_data['s_nature_of_business'] = get_from_post('nature_of_business_for_shop');
        $shop_data['s_commencement_of_business_date'] = get_from_post('date_commencement_of_business_for_shop');
        return $shop_data;
    }

    public function _check_validation($shop_data) {
        if (!$shop_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$shop_data['entity_establishment_type']) {
            return ENTITY_ESTABLISHMENT_TYPE_MESSAGE;
        }
        if (!$shop_data['regi_category']) {
            return SHOP_REGISTRATION_CATEGORY_MESSAGE;
        }
        if (!$shop_data['s_name']) {
            return SHOP_NAME_MESSAGE;
        }
        if (!$shop_data['s_door_no']) {
            return SHOP_DOOR_NO_MESSAGE;
        }
        if (!$shop_data['s_street_name']) {
            return SHOP_STREET_NAME_MESSAGE;
        }
        if (!$shop_data['s_location']) {
            return SHOP_LOCATION_MESSAGE;
        }
        if (!$shop_data['s_postal_address']) {
            return SHOP_POSTAL_ADDRESS_MESSAGE;
        }
        if ($shop_data['s_different_location'] == IS_CHECKED_YES) {
            if (!$shop_data['s_different_location_office']) {
                return SHOP_OFFICE_LOCATION_MESSAGE;
            }
            if (!$shop_data['s_different_location_store_room']) {
                return SHOP_STORE_ROOM_LOCATION_MESSAGE;
            }
            if (!$shop_data['s_different_location_godown']) {
                return SHOP_GODOWN_LOCATION_MESSAGE;
            }
            if (!$shop_data['s_different_location_warehouse']) {
                return SHOP_WAREHOUSE_LOCATION_MESSAGE;
            }
        }

        if (!$shop_data['s_employer_name']) {
            return SHOP_EMPLOYER_NAME_MESSAGE;
        }
        if (!$shop_data['s_employer_mobile_no']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$shop_data['s_employer_residential_address']) {
            return SHOP_EMPLOYER_RESIDENTIAL_ADDRESS_MESSAGE;
        }
        if (!$shop_data['s_category']) {
            return SHOP_CATEGORY_MESSAGE;
        }
        if (!$shop_data['s_nature_of_business']) {
            return SHOP_NATURE_OF_BUSINESS_MESSAGE;
        }
        if (!$shop_data['s_commencement_of_business_date']) {
            return SHOP_DATE_COMMENCEMENT_OF_BUSINESS_MESSAGE;
        }

        return '';
    }

    public function generate_FormI_pdf() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $s_id = get_from_post('s_id_for_formI_pdf');
            if (!is_post() || $user_id == null || !$user_id || $s_id == null || !$s_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_shop_data = $this->utility_model->get_by_id('s_id', $s_id, 'shop');
            if (empty($existing_shop_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('shop_data' => $existing_shop_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('shop/formI_pdf', $data, TRUE));
            $mpdf->Output('FORM-I.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    public function generate_FormII_pdf() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $s_id = get_from_post('s_id_for_formII_pdf');
            if (!is_post() || $user_id == null || !$user_id || $s_id == null || !$s_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_shop_data = $this->utility_model->get_by_id('s_id', $s_id, 'shop');
            if (empty($existing_shop_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            $this->utility_lib->gc_for_shop($existing_shop_data);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    public function generate_FormXXIV_pdf() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $s_id = get_from_post('s_id_for_formXXIV_pdf');
            if (!is_post() || $user_id == null || !$user_id || $s_id == null || !$s_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_shop_data = $this->utility_model->get_by_id('s_id', $s_id, 'shop');
            if (empty($existing_shop_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);

                return;
            }
            error_reporting(E_ERROR);
            $data = array('shop_data' => $existing_shop_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('shop/formXXIV_pdf', $data, TRUE));
            $mpdf->Output('FORM-XXIV.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    public function generate_FormIV_pdf() {
        try {
            $user_id = get_from_session('temp_id_for_eodbsws');
            $s_id = get_from_post('s_id_for_formIV_pdf');
            if (!is_post() || $user_id == null || !$user_id || $s_id == null || !$s_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_shop_data = $this->utility_model->get_by_id('s_id', $s_id, 'shop');
            if (empty($existing_shop_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);

                return;
            }
            error_reporting(E_ERROR);
            $data = array('shop_data' => $existing_shop_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('shop/formIV_pdf', $data, TRUE));
            $mpdf->Output('FORM-IV.pdf', 'D');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_shop_data_by_shop_id() {
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
            $s_id = get_from_post('s_id');
            if (!$s_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $shop_data = $this->utility_model->get_by_id_with_applicant_name('s_id', $s_id, 'shop');
            if (empty($shop_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->payment_lib->get_payment_history_data($session_user_id, VALUE_THIRTYTHREE, $s_id, $shop_data);
            $shop_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', VALUE_THIRTYTHREE, 'fees_bifurcation', 'module_id', $s_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['shop_data'] = $shop_data;
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
            $s_id = get_from_post('shop_id_for_shop_upload_challan');
            if (!is_post() || $user_id == NULL || !$user_id || $s_id == NULL || !$s_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_em_data = $this->utility_model->get_by_id('s_id', $s_id, 'shop');
            if (empty($ex_em_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_em_data['user_id'] != $user_id) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $user_payment_type = get_from_post('user_payment_type_for_shop_upload_challan');
                if ($user_payment_type != VALUE_ONE && $user_payment_type != VALUE_TWO && $user_payment_type != VALUE_THREE) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $shop_data = array();
            if ($_FILES['fees_paid_challan_for_shop_upload_challan']['name'] != '') {
                $main_path = 'documents/shop/';
                if (!is_dir($main_path)) {
                    mkdir($main_path);
                    chmod("$main_path", 0755);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['fees_paid_challan_for_shop_upload_challan']['name']);
                $filename = 'fees_paid_challan_dd_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['fees_paid_challan_for_shop_upload_challan']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $shop_data['status'] = VALUE_FOUR;
                $shop_data['fees_paid_challan'] = $filename;
                $shop_data['fees_paid_challan_updated_date'] = date('Y-m-d H:i:s');
            }
            if ($ex_em_data['payment_type'] == VALUE_TWO) {
                $shop_data['status'] = VALUE_FOUR;
                if ($user_payment_type == VALUE_TWO) {
                    $shop_data['status'] = VALUE_EIGHT;
                } else if ($user_payment_type == VALUE_THREE) {
                    $shop_data['status'] = VALUE_THREE;

                    $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($user_id, VALUE_THIRTYTHREE, $s_id, $ex_em_data['district'], $ex_em_data['total_fees'], $shop_data);
                    if ($enc_pg_data['success'] == false) {
                        echo json_encode(get_error_array($enc_pg_data['message']));
                        return;
                    }
                }
                $shop_data['user_payment_type'] = $user_payment_type;
            } else {
                $shop_data['user_payment_type'] = VALUE_ZERO;
            }
            $shop_data['updated_by'] = $user_id;
            $shop_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('s_id', $s_id, 'shop', $shop_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($shop_data['status']) ? $shop_data['status'] : $ex_em_data['status'];
            $success_array['message'] = CHALLAN_UPLOADED_MESSAGE;
            $success_array['payment_type'] = $ex_em_data['payment_type'];
            $success_array['user_payment_type'] = $shop_data['user_payment_type'];
            if ($ex_em_data['payment_type'] == VALUE_TWO && $shop_data['user_payment_type'] == VALUE_THREE) {
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

    function remove_fees_paid_challan() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $s_id = get_from_post('s_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$s_id || $s_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('s_id', $s_id, 'shop');
            if (empty($ex_est_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . $ex_est_data['fees_paid_challan'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->utility_model->update_data('s_id', $s_id, 'shop', array('status' => VALUE_THREE, 'fees_paid_challan' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
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
            $s_id = get_from_post('s_id');
            $document_type = get_from_post('document_type');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$s_id || $s_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_est_data = $this->utility_model->get_by_id('s_id', $s_id, 'shop');
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['lease_agreement_document'];
            } else if ($document_type == VALUE_TWO) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['house_tax_copy'];
            } else if ($document_type == VALUE_THREE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['photo_of_shop'];
            } else if ($document_type == VALUE_FOUR) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['aadhar_card'];
            } else if ($document_type == VALUE_FIVE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['pan_card'];
            } else if ($document_type == VALUE_SIX) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['gst'];
            } else if ($document_type == VALUE_SEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['s_sign_of_employer'];
            } else if ($document_type == VALUE_EIGHT) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['certificate_tourism'];
            } else if ($document_type == VALUE_NINE) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['license_health'];
            } else if ($document_type == VALUE_TEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['noc_health'];
            } else if ($document_type == VALUE_ELEVEN) {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ex_est_data['security_license'];
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            if ($document_type == VALUE_ONE) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('lease_agreement_document' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TWO) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('house_tax_copy' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_THREE) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('photo_of_shop' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FOUR) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('aadhar_card' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_FIVE) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('pan_card' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SIX) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('gst' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_SEVEN) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('s_sign_of_employer' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_EIGHT) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('certificate_tourism' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_NINE) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('license_health' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_TEN) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('noc_health' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            } else if ($document_type == VALUE_ELEVEN) {
                $this->utility_model->update_data('s_id', $s_id, 'shop', array('security_license' => '', 'updated_by' => $session_user_id, 'updated_time' => date('Y-m-d H:i:s')));
            }

            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_shop_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_eodbsws');
            $s_id = get_from_post('s_id');
            $file_no = get_from_post('file_no');

            if ($file_no == VALUE_ONE) {
                $shop_data = $this->utility_model->upload_document('lease_agreement_document', 'shop', 'lease_agreement_document_', 'lease_agreement_document');
            }
            if ($file_no == VALUE_TWO) {
                $shop_data = $this->utility_model->upload_document('house_tax_copy', 'shop', 'house_tax_copy_', 'house_tax_copy');
            }
            if ($file_no == VALUE_THREE) {
                $shop_data = $this->utility_model->upload_document('photo_of_shop', 'shop', 'photo_of_shop_', 'photo_of_shop');
            }
            if ($file_no == VALUE_FOUR) {
                $shop_data = $this->utility_model->upload_document('aadhar_card', 'shop', 'aadhar_card_', 'aadhar_card');
            }
            if ($file_no == VALUE_FIVE) {
                $shop_data = $this->utility_model->upload_document('pan_card', 'shop', 'pan_card_', 'pan_card');
            }
            if ($file_no == VALUE_SIX) {
                $shop_data = $this->utility_model->upload_document('gst', 'shop', 'gst_', 'gst');
            }
            if ($file_no == VALUE_SEVEN) {
                $shop_data = $this->utility_model->upload_document('seal_and_stamp_for_shop', 'shop', 'signatur_', 's_sign_of_employer');
            }
            if ($file_no == VALUE_EIGHT) {
                $shop_data = $this->utility_model->upload_document('certificate_tourism', 'shop', 'certificate_tourism_', 'certificate_tourism');
            }
            if ($file_no == VALUE_NINE) {
                $shop_data = $this->utility_model->upload_document('license_health', 'shop', 'license_health_', 'license_health');
            }
            if ($file_no == VALUE_TEN) {
                $shop_data = $this->utility_model->upload_document('noc_health', 'shop', 'noc_health_', 'noc_health');
            }
            if ($file_no == VALUE_ELEVEN) {
                $shop_data = $this->utility_model->upload_document('security_license', 'shop', 'security_license_', 'security_license');
            }
            if (!$shop_data) {
                return false;
            }
            $this->db->trans_start();
            if (!$s_id) {
                $shop_data['user_id'] = $session_user_id;
                $shop_data['status'] = VALUE_ONE;
                $shop_data['created_by'] = $session_user_id;
                $shop_data['created_time'] = date('Y-m-d H:i:s');
                $s_id = $this->utility_model->insert_data('shop', $shop_data);
            } else {
                $shop_data['updated_by'] = $session_user_id;
                $shop_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('s_id', $s_id, 'shop', $shop_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['shop_data'] = $shop_data;
            $success_array['s_id'] = $s_id;
            $success_array['file_no'] = $file_no;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
* EOF: ./application/controllers/Establishment.php
*/
