<?php

define('ZED_TOKEN', '1B60AB8DD74B48A8AE94BFEC08517B6687990C1C248B4FD89274DC8697846330EEF87B5D9FC');
define('ZED_URL', 'https://loginzed.msme.gov.in/msme/GetDetailsByUdyam?token=' . ZED_TOKEN);

define('ZED_200', 200);
$config['zed_status_code_array'] = array(
    ZED_200 => VALUE_ONE,
    404 => VALUE_TWO,
    500 => VALUE_THREE,
    401 => VALUE_FOUR
);

$config['zed_status_array'] = array(
    VALUE_ONE => 'Details Fetched and Saved Successfully !',
    VALUE_TWO => 'Record Not Found in ZED Portal',
    VALUE_THREE => 'Internal Server Error in ZED Portal',
    VALUE_FOUR => 'Unauthorized User in ZED Portal',
    VALUE_FIVE => 'CURL Error',
    VALUE_SIX => 'Response Not Received',
    VALUE_SEVEN => 'Invalid JSON Return From ZED Portal',
    VALUE_EIGHT => 'Empty JSON Return From ZED Portal',
    VALUE_NINE => 'Invalid Status Code Return From ZED Portal',
);
