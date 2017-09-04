<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 01-09-2017
 * Time: 14:00
 */

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

require 'vendor/autoload.php';

$headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => 'demo', 'X-AgreementGrantToken' => 'demo');

try {
    $response = Unirest\Request::get('https://restapi.e-conomic.com/customers?demo=true', $headers);
    var_dump($response->raw_body);
}
catch(Exception $e) {
    var_dump($e->Message());
}

