<?php

define('PAN_PFX_FILE_PATH', 'assets/pfx/Signer.pfx');
define('PAN_PFX_PASSWORD', 'emudhra');
define('PAN_USER_ID', 'V0024301');
define('PAN_API_VERSION', 4);
define('PAN_URL', 'https://121.240.36.237/TIN/PanInquiryAPIBackEnd');

$config['pan_api_status_array'] = array(
    VALUE_ONE => 'Success',
    VALUE_TWO => 'CURL Error',
    VALUE_THREE => 'Response Not Received',
    VALUE_FOUR => 'Invalid JSON Return From PAN Portal',
    VALUE_FIVE => 'Empty JSON Return From PAN Portal',
    VALUE_SIX => 'Invalid Response Code Return From PAN Portal',
    VALUE_SEVEN => 'Empty Response Data Return From PAN Portal',
);

$config['pan_api_response_code_array'] = array(
    VALUE_ONE => 'Success',
    VALUE_TWO => 'System Error',
    VALUE_THREE => 'Authentication Failure',
    VALUE_FOUR => 'User not authorized',
    VALUE_FIVE => 'No PANs Entered or Number of PANs exceeds the limit (5)',
    VALUE_SIX => 'User validity has expired',
    VALUE_EIGHT => 'Not enough balance',
    VALUE_NINE => 'Not an HTTPs request',
    VALUE_TEN => 'POST method not used',
    VALUE_ELEVEN => 'Invalid version number entered',
    VALUE_TWELVE => 'Valid User ID not sent in Input request and only PAN sent or User ID is greater than 12 character or Contains special characters.',
    VALUE_FIFTEEN => 'Certificate Revocation List issued by the Certifying Authorities is expired',
    VALUE_SIXTEEN => 'User id Deactivated',
    VALUE_SEVENTEEN => 'The Certificate used for signing is not matched with the certificate with the Database.',
    VALUE_EIGHTEEN => 'Signature sent in input request is blank',
    VALUE_TWENTY => 'User ID and PAN not sent in Input request',
    VALUE_TWENTYONE => 'No value sent in Input request',
    VALUE_TWENTYTWO => 'PAN Number is more than 10 characters or value is Null',
    VALUE_TWENTYTHREE => 'System Failure or common error message for request',
    VALUE_TWENTYFOUR => 'Duplicate Transaction ID entered',
    VALUE_TWENTYFIVE => 'Parse Exception in JSON',
    VALUE_TWENTYSIX => 'Records Count Passed from the header value is not matched with the Records Count present in the JSON Input Array',
    VALUE_TWENTYSEVEN => 'Name of Pan holder/Name on card is greater than 85 character or Value is null or contains ~ ^ special characters',
    VALUE_TWENTYEIGHT => 'Father Name field is greater than 75 character or Value is Null or contains ~ ^ special characters',
    VALUE_TWENTYNINE => 'Date of Birth format is incorrect it should be separated with slash (/) and in format of (DD/MM/YYYY)',
    VALUE_THIRTY => 'Request Time is greater than 30 characters or Value is Null',
    VALUE_THIRTYONE => 'Transaction ID is greater than 50 characters or Value is Null',
    VALUE_THIRTYTWO => 'Record count is blank or Record count contains alphabets or special characters',
    VALUE_THIRTYTHREE => 'Request Time is could not be future date/time and could not be older than last half an hour',
);

$config['pan_status_array'] = array(
    'E' => 'EXISTING AND VALID',
    'F' => 'Marked as Fake',
    'X' => 'Marked as Deactivated',
    'D' => 'Deleted',
    'N' => 'Record (PAN) Not Found in ITD Database/Invalid PAN',
    'EA' => 'Existing and Valid but event marked as “Amalgamation” in ITD database',
    'EC' => 'Existing and Valid but event marked as “Acquisition” in ITD database',
    'ED' => 'Existing and Valid but event marked as “Death” in ITD database',
    'EI' => 'Existing and Valid but event marked as “Dissolution” in ITD database',
    'EL' => 'Existing and Valid but event marked as “Liquidated” in ITD database',
    'EM' => 'Existing and Valid but event marked as “Merger” in ITD database',
    'EP' => 'Existing and Valid but event marked as “Partition” in ITD database',
    'ES' => 'Existing and Valid but event marked as “Split” in ITD database',
    'EU' => 'Existing and Valid but event marked as “Under Liquidation” in ITD database '
);
