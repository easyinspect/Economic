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

require 'classes/economicCustomer.php';
require 'vendor/autoload.php';



$economicCustomer = new economicCustomer();
$economicCustomer->customerShow();


?>

