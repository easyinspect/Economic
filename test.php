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

$api = new Economic\Api\EconomicApi();

if(isset($_GET['addCustomer'])) {

    $array = array(
        'currency' => 'DKK',
        'customerGroup' => array(
            'customerGroupNumber' => 1,
            'self' => 'https://restapi.e-conomic.com/customer-groups/1'
        ),
        'name' => 'Mathias er mega sej',
        'paymentTerms' => array(
            'paymentTermsNumber' => 1,
            'self' => 'https://restapi.e-conomic.com/payment-terms/1'
        ),
        'vatZone' => array(
            'vatZoneNumber' => 1,
            'self' => 'https://restapi.e-conomic.com/vat-zones/1'
        )
    );
    $api->customer()->save($array);
}

if(isset($_GET['customerDelete'])) {
    $api->customer()->delete($_GET['customerDelete']);
}

if(isset($_GET['customerNumber'])) {

    $customer = $api->customer()->get($_GET['customerNumber']);
    //var_dump($customer);
}
else {
    $customer = $api->customer()->all();
    //var_dump($customer);
}

?>
