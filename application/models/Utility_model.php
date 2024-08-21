<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utility_model extends CI_Model {

    function get_by_id($id, $compare_id, $table_name, $second_id = NULL, $second_value = NULL, $third_id = NULL, $third_value = NULL, $fourth_id = NULL, $fourth_value = NULL) {
        $this->db->where($id, $compare_id);
        if ($second_id != NULL && $second_value != NULL) {
            $this->db->where($second_id, $second_value);
        }
        if ($third_id != NULL && $third_value != NULL) {
            $this->db->where($third_id, $third_value);
        }
        if ($fourth_id != NULL && $fourth_value != NULL) {
            $this->db->where($fourth_id, $fourth_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_by_id_multiple($id, $compare_id, $table_name, $second_id = NULL, $second_value = NULL, $third_id = NULL, $third_value = NULL, $fourth_id = NULL, $fourth_value = '') {
        $this->db->where($id, $compare_id);
        if ($second_id != NULL && $second_value != NULL) {
            $this->db->where($second_id, $second_value);
        }
        if ($third_id != NULL && $third_value != NULL) {
            $this->db->where($third_id, $third_value);
        }
        if ($fourth_id != NULL && $fourth_value != '') {
            $this->db->where($fourth_id, $fourth_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_by_id_with_applicant_name($id, $compare_id, $table_name) {
        $this->db->select('t.*, u.applicant_name');
        $this->db->where("t.$id", $compare_id);
        $this->db->where('t.is_delete !=' . IS_DELETE);
        $this->db->from("$table_name AS t");
        $this->db->join('users as u', 'u.user_id = t.user_id');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function insert_data($table_name, $table_data) {
        $this->db->insert($table_name, $table_data);
        return $this->db->insert_id();
    }

    function insert_data_batch($table_name, $table_data) {
        $this->db->insert_batch($table_name, $table_data);
    }

    function update_data($id, $id_value, $table_name, $table_data, $where_id = NULL, $where_id_text = NULL) {
        $this->db->where($id, $id_value);
        if ($where_id != NULL && $where_id_text != NULL) {
            $this->db->where($where_id, $where_id_text);
        }
        $this->db->update($table_name, $table_data);
    }

    function update_data_not_in($id, $id_value, $id2, $ids2, $table_name, $table_data, $where_id = NULL, $where_id_text = NULL) {
        $this->db->where($id, $id_value);
        $this->db->where_not_in($id2, $ids2);
        if ($where_id != NULL && $where_id_text != NULL) {
            $this->db->where($where_id, $where_id_text);
        }
        $this->db->update($table_name, $table_data);
    }

    function update_data_batch($id, $table_name, $table_data) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->update_batch($table_name, $table_data, $id);
    }

    function get_result_data($table_name, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_result_data_by_id($id_text, $id, $table_name, $id_text2 = NULL, $id2 = NULL, $order_by_id = NULL, $order_by = NULL, $id_text3 = NULL, $id3 = NULL) {
        $this->db->where($id_text, $id);
        if ($id_text2 != NULL && $id2 != NULL) {
            $this->db->where($id_text2, $id2);
        }
        if ($id_text3 != NULL && $id3 != NULL) {
            if ($id_text3 == 'status' && $id3 == VALUE_TEN) {
                $this->db->where("(query_status='" . VALUE_ONE . "' OR query_status='" . VALUE_TWO . "')");
                $this->db->where("$id_text3 !=" . VALUE_FIVE);
                $this->db->where("$id_text3 !=" . VALUE_SIX);
            } else {
                if ($id3 != VALUE_FIVE && $id3 != VALUE_SIX) {
                    $this->db->where("(query_status='" . VALUE_ZERO . "' OR query_status='" . VALUE_THREE . "')");
                }
                $this->db->where($id_text3, $id3);
            }
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function check_field_value_exists_or_not($field_name, $field_value, $table_name, $id = NULL, $id_value = NULL, $field_name2 = NULL, $field_value2 = NULL) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where($field_name, $field_value);
        if ($field_name2 != NULL && $field_value2 != NULL) {
            $this->db->where($field_name2, $field_value2);
        }
        if ($id != NULL && $id_value != NULL) {
            $this->db->where("$id != $id_value");
        }
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function is_valid_post_data($key_post_id, $post_id, $table_name) {
        $this->db->where($key_post_id, $post_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function update_OTP($mobile_number, $OTP_type, $OTP_data) {
        $this->db->where('mobile_number', $mobile_number);
        $this->db->where('otp_type', $OTP_type);
        $this->db->where('is_expired !=' . IS_DELETE);
        $this->db->update('otp', $OTP_data);
    }

    function get_OTP_data_by_mobile_number_and_type($mobile_number, $OTP_type) {
        $this->db->where('mobile_number', $mobile_number);
        $this->db->where('otp_type', $OTP_type);
        $this->db->where('is_expired !=' . IS_DELETE);
        $this->db->from('otp');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function query_data_by_type_id($module_type, $module_id) {
        $this->db->select("q.*, date_format(q.query_datetime, '%d-%m-%Y %H:%i:%s') AS display_datetime, "
                . "qd.query_document_id, qd.doc_name, qd.document");
        $this->db->where('q.module_type', $module_type);
        $this->db->where('q.module_id', $module_id);
        $this->db->where('q.is_delete != ' . IS_DELETE);
        $this->db->from('query AS q');
        $this->db->join('query_document AS qd', 'qd.query_id = q.query_id AND qd.is_delete != ' . IS_DELETE, 'LEFT');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_plot_result_data($table_name, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('is_vacant =' . VALUE_ONE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_district_wise_services($district, $risk_category, $size_of_firm, $foreign_domestic_investor) {
        $this->db->select('s.*, q.questionary_id, q.question, q.answer');
        if ($district == TALUKA_DAMAN) {
            $this->db->where('s.daman_district', $district);
        }
        if ($district == TALUKA_DIU) {
            $this->db->where('s.diu_district', $district);
        }
        if ($district == TALUKA_DNH) {
            $this->db->where('s.dnh_district', $district);
        }
        if ($risk_category != '') {
            $this->db->like('s.risk_category', $risk_category);
        }
        if ($size_of_firm != '') {
            $this->db->like('s.size_of_firm', $size_of_firm);
        }
        if ($foreign_domestic_investor != '') {
            $this->db->like('s.foreign_domestic_investor', $foreign_domestic_investor);
        }
        $this->db->where('s.is_delete != ' . VALUE_ONE);
        $this->db->from('service AS s');
        $this->db->join('questionary AS q', 'q.service_id = s.service_id AND q.is_delete != ' . IS_DELETE, 'LEFT');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function upload_document($field_name, $folder_name, $replace_name, $db_name) {
        if ($_FILES[$field_name]['name'] == '') {
            echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
            return;
        }
        $evidence_size = $_FILES[$field_name]['size'];
        if ($evidence_size == 0) {
            echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
            return;
        }
//        $maxsize = '20971520';
//        if ($evidence_size >= $maxsize) {
//            echo json_encode(array('success' => FALSE, 'message' => UPLOAD_MAX_ONE_MB_MESSAGE));
//            return;
//        }

        if ($_FILES[$field_name]['name'] != '') {
            $main_path = "documents/$folder_name";
            // if (!is_dir($main_path)) {
            //     mkdir($main_path);
            //     chmod("$main_path", 0755);
            // }
            $documents_path = 'documents';
            if (!is_dir($documents_path)) {
                mkdir($documents_path);
                chmod($documents_path, 0777);
            }
            $module_path = $documents_path . DIRECTORY_SEPARATOR . "$folder_name";
            if (!is_dir($module_path)) {
                mkdir($module_path);
                chmod($module_path, 0777);
            }
            $this->load->library('upload');
            $temp_filename = str_replace('_', '', $_FILES[$field_name]['name']);
            $filename = "$replace_name" . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
            //Change file name
            $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
            if (!move_uploaded_file($_FILES[$field_name]['tmp_name'], $final_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $document_data[$db_name] = $filename;

            return $document_data;
        }
    }

    function get_incentive_details_by_id($ips_incentive_id) {
        $this->db->select('i.*, r.ips_incentive_id, r.user_id ,r.scheme_type, r.scheme, r.status, r.status_datetime, '
                . 'r.submitted_datetime, r.processing_days, r.query_status, r.challan, r.challan_updated_date, r.fees_paid_challan, '
                . 'r.fees_paid_challan_updated_date, r.registration_number, r.valid_upto, r.certificate_file, r.final_certificate, '
                . 'r.remarks, r.payment_type, r.user_payment_type, r.total_fees, r.last_op_reference_number');
        $this->db->where('r.ips_incentive_id', $ips_incentive_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->from('ips_incentive AS r');
        $this->db->join('ips AS i', 'i.ips_id = r.ips_id');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_details_for_feedback_rating($qm_data, $module_id) {
        $this->db->select($qm_data['key_id_text'] . " AS module_id, rating, feedback, fr_datetime");
        $this->db->where($qm_data['key_id_text'], $module_id);
        $this->db->where_in('status', array(VALUE_FIVE, VALUE_SIX));
        $this->db->where('is_delete != ' . IS_DELETE);
        $this->db->from($qm_data['tbl_text']);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_details_for_withdraw_application($qm_data, $module_id) {
        $this->db->select('*, ' . $qm_data['key_id_text'] . " AS module_id");
        $this->db->where($qm_data['key_id_text'], $module_id);
        $this->db->where('is_delete != ' . IS_DELETE);
        $this->db->from($qm_data['tbl_text']);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_details_for_ips_incentives_withdraw_application($qm_data, $module_id) {
        $this->db->select('ii.*, i.*, ' . 'ii.' . $qm_data['key_id_text'] . " AS module_id");
        $this->db->where('ii.' . $qm_data['key_id_text'], $module_id);
        $this->db->where('ii.is_delete != ' . IS_DELETE);
        $this->db->from($qm_data['tbl_text'] . ' AS ii');
        $this->db->join('ips AS i', 'i.ips_id = ii.ips_id');
        $resc = $this->db->get();
        return $resc->row_array();
    }

}

/*
 * EOF: ./application/models/Utility_model.php
 */