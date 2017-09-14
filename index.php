<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 14:10
 */

use Economic\Economic;

require 'vendor/autoload.php';

$economic = new Economic('IBDTsO7n5FmWF4ms7YlBKScXJV14sqp14mYw3OxbAqU1', 'UBBtI0nDfUz2lLBMOFvDGdvpjVMkmZgH3SsBu01n5KY1', 'application/json', 'https://restapi.e-conomic.com');
$test = $economic->customer()->get(1001);


