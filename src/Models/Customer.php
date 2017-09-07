<?php

namespace Economic\Models;

class Customer {

    public $name;
    public $currency;
    public $customerGroup;
    public $paymentTerms;
    public $vatZone;
    public $vatNumber;
    public $customerNumber;
    public $address;
    public $attention;
    public $balance;
    public $barred;
    public $city;
    public $contacts;
    public $corporateIdentificationNumber;
    public $country;
    public $creditLimit;
    public $customerContact;
    public $defaultDeliveryLocation;
    public $deliveryLocations;
    public $ean;
    public $email;
    public $invoices;
    public $lastUpdated;
    public $layout;
    public $publicEntryNumber;
    public $salesPerson;
    public $self;
    public $telephoneAndFaxNumber;
    public $templates;
    public $totals;
    public $website;
    public $zip;

    public function __construct($object)
    {
        foreach(get_object_vars($object) as $key => $value) {
            $this->$key = $value;
        }
    }

}