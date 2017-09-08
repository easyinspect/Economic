<?php

namespace Economic\Models;

use Economic\Api\CustomerResource;

class Customer {

    /** @var string $name */
    public $name;

    /** @var string $currency */
    public $currency;

    /** @var object $customerGroup */
    public $customerGroup;

    /** @var object $paymentTerms */
    public $paymentTerms;

    /** @var object $vatZone */
    public $vatZone;

    /** @var int $vatNumber */
    public $vatNumber;

    /** @var int $customerNumber */
    public $customerNumber;

    /** @var string $address */
    public $address;

    /** @var object $attention */
    public $attention;

    /** @var number $balance */
    public $balance;

    /** @var boolean $barred */
    public $barred;

    /** @var string $city */
    public $city;

    /** @var string $contacts */
    public $contacts;

    /** @var string $corporateIdentificationNumber */
    public $corporateIdentificationNumber;

    /** @var string $country */
    public $country;

    /** @var number $creditLimit */
    public $creditLimit;

    /** @var object $customerContact */
    public $customerContact;

    /** @var object $defaultDeliveryLocation */
    public $defaultDeliveryLocation;

    /** @var string $deliveryLocations */
    public $deliveryLocations;

    /** @var string $ean */
    public $ean;

    /** @var string $email */
    public $email;

    /** @var object $invoices */
    public $invoices;

    /** @var string $lastUpdated */
    public $lastUpdated;

    /** @var object $layout */
    public $layout;

    /** @var string $publicEntryNumber */
    public $publicEntryNumber;

    /** @var object $salesPerson */
    public $salesPerson;

    /** @var string $self */
    public $self;

    /** @var string $telephoneAndFaxNumber */
    public $telephoneAndFaxNumber;

    /** @var object $publicEntryNumber */
    public $templates;

    /** @var object $totals */
    public $totals;

    /** @var string $website */
    public $website;

    /** @var string $zip */
    public $zip;

    /** @var CustomerResource */
    protected $api;

    public function __construct($object)
    {
        foreach(get_object_vars($object) as $key => $value) {
            $this->$key = $value;
        }
    }

    /*public function save()
    {



        $arr = get_object_vars($this);

        $this->api->customer()->update($this->id, $arr);
    }*/
}