<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * generate array index as key value as object
 * @param type $result_set
 * @param type $index_field
 * @return type
 */
function generate_array_for_id_object($result_set, $index_field) {
    $main_array = array();
    foreach ($result_set as $record) {
        $main_array[intval(trim($record[$index_field]))] = $record;
    }
    return $main_array;
}

function generate_array_for_id_objects($temp_data, $id) {
    $all_data = array();
    foreach ($temp_data as $temp_op) {
        if (!isset($all_data[$temp_op[$id]])) {
            $all_data[$temp_op[$id]] = array();
        }
        array_push($all_data[$temp_op[$id]], $temp_op);
    }
    return $all_data;
}

function generate_array_for_id_inside_id_object($temp_data) {
    $id = 'district';
    $inside_id = 'department_id';
    $another_inside_id = 'questionary_id';
    $return_data = array();
    $return_data['questionary_data'] = array();
    $return_data['only_questionary_data'] = array();
    foreach ($temp_data as $temp_op) {
        if (!isset($return_data['questionary_data'][$temp_op[$id]])) {
            $return_data['questionary_data'][$temp_op[$id]] = array();
            $return_data['only_questionary_data'][$temp_op[$id]] = array();
        }
        if (!isset($return_data['questionary_data'][$temp_op[$id]][$temp_op[$inside_id]])) {
            $return_data['questionary_data'][$temp_op[$id]][$temp_op[$inside_id]] = array();
            $return_data['questionary_data'][$temp_op[$id]][$temp_op[$inside_id]]['department_id'] = $temp_op[$inside_id];
            $return_data['questionary_data'][$temp_op[$id]][$temp_op[$inside_id]]['department_name'] = $temp_op['department_name'];
            $return_data['questionary_data'][$temp_op[$id]][$temp_op[$inside_id]]['questionary_items'] = array();
        }
        if (!isset($return_data['questionary_data'][$temp_op[$id]][$temp_op[$inside_id]]['questionary_items'][$temp_op[$another_inside_id]])) {
            $return_data['questionary_data'][$temp_op[$id]][$temp_op[$inside_id]]['questionary_items'][$temp_op[$another_inside_id]] = $temp_op;
        }
        if (!isset($return_data['only_questionary_data'][$temp_op[$id]][$temp_op[$another_inside_id]])) {
            $return_data['only_questionary_data'][$temp_op[$id]][$temp_op[$another_inside_id]] = $temp_op;
        }
    }
    return $return_data;
}

function crypto_rand_secure($min, $max) {
    $range = $max - $min;
    if ($range < 1)
        return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

/**
 * Generate Random Token.
 * @param type $length
 * @param type $is_special_character_allow
 * @return string
 */
function generate_token($length = 20, $is_special_character_allow = FALSE) {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    if ($is_special_character_allow) {
        $codeAlphabet .= "!#$%_+<>=";
    }
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }

    return $token;
}

function convert_to_mysql_date_format($dt) {
    $date_time_object = new DateTime($dt);
    return $date_time_object->format('Y-m-d');
}

function convert_to_new_date_format($dt, $separator = '') {
    $separator = $separator != '' ? $separator : '-';
    $date_time_object = new DateTime($dt);
    return $date_time_object->format("d" . $separator . "m" . $separator . "Y");
}

function convert_to_new_datetime_format($dt) {
    $date_time_object = new DateTime($dt);
    return $date_time_object->format("d-m-Y H:i:s");
}

function encrypt($message) {
    $iv = random_bytes(16);
    $key = getKey(ENCRYPTION_KEY);
    $result = sign(openssl_encrypt($message, 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv), $key);
    return bin2hex($iv) . bin2hex($result);
}

function decrypt($hash) {
    $iv = hex2bin(substr($hash, 0, 32));
    $data = hex2bin(substr($hash, 32));
    $key = getKey(ENCRYPTION_KEY);
    if (!verify($data, $key)) {
        return null;
    }
    return openssl_decrypt(mb_substr($data, 64, null, '8bit'), 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv);
}

function sign($message, $key) {
    return hash_hmac('sha256', $message, $key) . $message;
}

function verify($bundle, $key) {
    return hash_equals(
            hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key), mb_substr($bundle, 0, 64, '8bit')
    );
}

function getKey($password, $keysize = 16) {
    return hash_pbkdf2('sha256', $password, 'some_token', 100000, $keysize, true);
}

function generate_random_string($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function generate_secure_mobile_number($mobile_number) {
    return $mobile_number[0] . 'xxxxxx' . $mobile_number[7] . $mobile_number[8] . $mobile_number[9];
}

function generate_registration_number($type, $id) {
    return $type . sprintf("%05d", $id);
}

function get_string($data_array, $value_array) {
    $string = '';
    $cnt = 1;
    if (strpos($value_array, ',')) {
        $array = explode(",", $value_array);
        foreach ($array as $index => $value) {
            if ($cnt != 1) {
                $string .= ' , ';
            }
            $string .= $data_array[$value] ? $data_array[$value] : '';
            $cnt++;
        }
    } else {
        if ($value_array) {
            $string .= $data_array[$value_array] ? $data_array[$value_array] : '';
        }
    }
    return $string;
}

function get_encrypt_id($id) {
    return generate_random_string(3) . base64_encode($id) . generate_random_string(3);
}

function get_decrypt_id($temp_access_token) {
    $removed_first_three_character = substr($temp_access_token, 3);
    $final_token = substr($removed_first_three_character, 0, -3);
    return base64_decode($final_token);
}

function move_image($file_name, $existing_data, $source, $destination, $is_detele = false) {
    if (!$existing_data[$file_name] && $is_detele) {
        return;
    }
//    $exsting_image_path = $source . DIRECTORY_SEPARATOR  . $existing_data[$file_name];
    $exsting_image_path = $source . DIRECTORY_SEPARATOR . $file_name . DIRECTORY_SEPARATOR . $existing_data[$file_name];
    $garbage_path = $destination;
    if (!is_dir($garbage_path)) {
        mkdir($garbage_path);
        chmod($garbage_path, 0777);
    }
    $file_store_path = $garbage_path . DIRECTORY_SEPARATOR . $file_name;
    if (!is_dir($file_store_path)) {
        mkdir($file_store_path);
        chmod($file_store_path, 0777);
    }
    $new_image_path = $file_store_path . DIRECTORY_SEPARATOR . $existing_data[$file_name];
    rename($exsting_image_path, $new_image_path);
}

function get_days_in_dates($end_date) {
    if ($end_date == '0000-00-00 00:00:00') {
        return 0;
    }
    $date1 = new DateTime($end_date);
    $date2 = new DateTime();
    return $date2->diff($date1)->format('%a') + 1;
}

function get_days_in_dates_single($start_date, $end_date) {
    if ($end_date == '0000-00-00 00:00:00') {
        return 0;
    }
    $date1 = new DateTime($end_date);
    $date2 = new DateTime($start_date);
    return $date2->diff($date1)->format('%a') + 1;
}

function generate_barcode_number($type, $id) {
    return sprintf("%02d", $type) . sprintf("%07d", $id);
}

function is_json($string) {
    json_decode($string);
    return json_last_error() == JSON_ERROR_NONE;
}

/**
 * EOF: ./application/helpers/request_helper.php
 */
