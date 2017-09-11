<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-09-2017
 * Time: 16:34
 */

require 'vendor/autoload.php';


$api = new \Economic\Economic('tsf8fJFBD6B0b3VxkOPUTcoetTaMorbTsb8Xgtej9l81', 'OtZCNMYv1VXEvcwGLUN6kVAmjzp4cNxR1D1b8yIeea41');


$customer = $api
    ->customer()
    ->getByCustNumber(1001);
print_r($customer);




/**
 *
 */

$customer = $api
    ->customer()
    ->setCustomerNumber(12345678)
    ->setName('Firma1')
    ->save()
    ->setName('Firma2')
    ->save()
    ->delete()
    ->save();

print_r($customer);