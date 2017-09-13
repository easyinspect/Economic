<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 14:10
 */

use Economic\Economic;

require 'vendor/autoload.php';

$economic = new Economic('tsf8fJFBD6B0b3VxkOPUTcoetTaMorbTsb8Xgtej9l81', 'OtZCNMYv1VXEvcwGLUN6kVAmjzp4cNxR1D1b8yIeea41', 'application/json', 'https://restapi.e-conomic.com');
$test = $economic->customer()->setCustomerNumber(1);
var_dump($test);