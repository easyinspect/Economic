<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 01-09-2017
 * Time: 14:00
 */

namespace EconomicPHPWrapper\Api;

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

require 'vendor/autoload.php';

$api = new \EconomicPHPWrapper\Api\EconomicApi();

$user = $api->user()->all();
var_dump($user);

?>
