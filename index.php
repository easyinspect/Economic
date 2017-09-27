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
    'IBDTsO7n5FmWF4ms7YlBKScXJV14sqp14mYw3OxbAqU1',
    'UBBtI0nDfUz2lLBMOFvDGdvpjVMkmZgH3SsBu01n5KY1'
);
/*$test = $economic
    ->draftInvoices()
    ->setCurrency('DKK')
    ->setCustomerNumber(1007)
    ->setRecipientName('Martin kan godt lide skildpadder')
    ->setRecipientVatZoneNumber(3)
    ->setVendorReferenceNumber(1)
    ->setSalesPersonNumber(1)
    ->setDate('2016-03-04')
    ->setPaymentTermsNumber(1)
    ->setLineQuantity(1)
    ->setLineProduct(11)
    ->setLayoutNumber(18)
    ->create();
*/
$test = $economic->draftInvoices()->get(9);

//$test = $economic->customer()->get(1001);
var_dump($test);
