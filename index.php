<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 14:10
 */

use Economic\Economic;

require 'vendor/autoload.php';

$economic = new Economic(
    'SwQn6scivHjMlAEmS9FbbDxYzyOb3sLjBuMnVBi2VSU1',
    'bje2Mxj6bD2uRIDTKcgMaQt1z5K868Y9mrhGBL8ywVI1'
);
$test = $economic
    ->draftInvoices()
    ->setCurrency('DKK')
    ->setCustomerNumber(1007)
    ->setRecipientName('EasyInspect ApS')
    ->setRecipientVatZoneNumber(3)
    ->setVendorReferenceNumber(1)
    ->setSalesPersonNumber(1)
    ->setInvoiceLine(1, "1", "Cult bundet af flok sjakaler", 100)
    ->setInvoiceLine(2, "2", "Cult Energy Strawberry", 111)
    ->setLineDiscountPercentage(1)
    ->setDate('2016-03-04')
    ->setPaymentTermsNumber(1)
    ->setLayoutNumber(18)
    ->create();

//$test = $economic->customer()->get(1007);

//$test = $economic->customer()->get(1001);
var_dump($test);


