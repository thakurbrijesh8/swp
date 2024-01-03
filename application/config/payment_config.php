<?php

$config['uban_array'] = array(
    VALUE_NINE => array(
//        TALUKA_DAMAN => 37667476239
    ),
    //Labour Department
    VALUE_THIRTYONE => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    VALUE_THIRTYTWO => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    VALUE_THIRTYTHREE => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    VALUE_THIRTYFOUR => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    VALUE_FOURTYTWO => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    VALUE_FOURTYTHREE => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    VALUE_FOURTYFIVE => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    VALUE_FOURTYSIX => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'dnhlabour'
    ),
    //Weights & Measure Department
    VALUE_ONE => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    VALUE_TWO => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    VALUE_THREE => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    VALUE_FOUR => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    VALUE_FOURTEEN => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    VALUE_FIFTEEN => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    VALUE_SIXTEEN => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    VALUE_FOURTYEIGHT => array(
        TALUKA_DAMAN => 'damanwm', TALUKA_DIU => 'damanwm', TALUKA_DNH => 'damanwm'
    ),
    //Factory & Boilers Department
    VALUE_THIRTYFIVE => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'damanlabour'
    ),
    VALUE_THIRTYSEVEN => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'damanlabour'
    ),
    VALUE_FOURTYONE => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'damanlabour'
    ),
    VALUE_FOURTYFOUR => array(
        TALUKA_DAMAN => 'damanlabour', TALUKA_DIU => 'damanlabour', TALUKA_DNH => 'damanlabour'
    ),
    //CRSR - Civil REgistrar Cum Sub Registrar
    VALUE_SEVEN => array(
        TALUKA_DAMAN => 'damancrsr', TALUKA_DIU => 'diucrsr', TALUKA_DNH => 'dnhcrsr'
    ),
    VALUE_SIXTYONE => array(
        TALUKA_DAMAN => 'damancrsr', TALUKA_DIU => 'diucrsr', TALUKA_DNH => 'dnhcrsr'
    ),
    //Forest Department
    VALUE_FIFTYNINE => array(
        TALUKA_DAMAN => '', TALUKA_DIU => '', TALUKA_DNH => ''
    ),
    //Revenue / Collector
    VALUE_EIGHT => array(
        TALUKA_DAMAN => 'damancollector', TALUKA_DIU => '', TALUKA_DNH => ''
    ),
    VALUE_TWENTYTWO => array(
        TALUKA_DAMAN => 'damancollector', TALUKA_DIU => '', TALUKA_DNH => ''
    ),
    VALUE_FOURTY => array(
        TALUKA_DAMAN => 'damancollector', TALUKA_DIU => '', TALUKA_DNH => ''
    ),
    //PWD Department
    VALUE_FIVE => array(
        TALUKA_DAMAN => 'damanpwdwdone', TALUKA_DIU => '', TALUKA_DNH => ''
    ),
);

define('PG_MID', 1001501);
define('PG_KEY', 'nprVtAlqf0ypMdzvXp7pZq5LakQoHKL7MqNM9l/0A64=');
define('PG_OM', 'DOM');
define('PG_COUNTRY', 'IN');
define('PG_CURRENCY', 'INR');
define('PG_SUCCESS_URL', 'https://swp.dddgov.in/payment-success');
//define('PG_SUCCESS_URL', 'http://localhost:90/swp/payment-success');
define('PG_FAIL_URL', 'https://swp.dddgov.in/payment-fail');
//define('PG_FAIL_URL', 'http://localhost:90/swp/payment-fail');
define('PG_AGG_ID', 'SBIEPAY');
define('PG_PM', 'NB');
define('PG_ACC', 'ONLINE');
define('PG_TS', 'ONLINE');
define('PG_URL', 'https://www.sbiepay.sbi/secure/AggregatorHostedListener');
define('PG_DV_URL', 'https://www.sbiepay.sbi/payagg/statusQuery/getStatusQuery');

$config['pg_status_array'] = array(
    VALUE_ZERO => 'Payment Not Initiated',
    VALUE_ONE => 'Payment Initiated',
    VALUE_TWO => 'Payment Success',
    VALUE_THREE => 'Payment Failed',
    VALUE_FOUR => 'Response Pending From Bank',
    VALUE_FIVE => 'Response Pending From Bank',
    VALUE_SIX => 'Payment In Process',
);

$config['pg_status_text_array'] = array(
    VALUE_ZERO => '<span class="badge bg-gray app-status">Payment Not Initiated</span>',
    VALUE_ONE => '<span class="badge bg-nic-blue app-status">Payment Initiated</span>',
    VALUE_TWO => '<span class="badge bg-success app-status">Payment Success</span>',
    VALUE_THREE => '<span class="badge bg-danger app-status">Payment Failed</span>',
    VALUE_FOUR => '<span class="badge bg-warning app-status">Response Pending From Bank</span>',
    VALUE_FIVE => '<span class="badge bg-warning app-status">Response Pending From Bank</span>',
    VALUE_SIX => '<span class="badge bg-warning app-status">Payment In Process</span>'
);

$config['dv_status_array'] = array(
    VALUE_ZERO => 'Not Initiated',
    VALUE_ONE => 'Initiated',
    VALUE_TWO => 'Success',
    VALUE_THREE => 'Failed',
    VALUE_FOUR => 'Response Pending From Bank',
    VALUE_FIVE => 'Response Pending From Bank',
    VALUE_SIX => 'In Process',
);
