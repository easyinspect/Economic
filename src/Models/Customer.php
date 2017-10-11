<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 13:15
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\CustomerGroup;
use Economic\Models\Components\VatZone;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\CustomerContact;
use Economic\Models\Components\Layout;
use Economic\Models\Components\SalesPerson;

class Customer
{
    /** @var int $customerNumber*/
    private $customerNumber;
    /** @var string $currency*/
    private $currency;
    /** @var PaymentTerms*/
    private $paymentTerms;
    /** @var CustomerGroup*/
    private $customerGroup;
    /** @var string $address*/
    private $address;
    /** @var float $balance*/
    private $balance;
    /** @var float $dueAmount*/
    private $dueAmount;
    /** @var string $city*/
    private $city;
    /** @var string $country*/
    private $country;
    /** @var string $email*/
    private $email;
    /** @var string $name*/
    private $name;
    /** @var int $zip*/
    private $zip;
    /** @var int $telephoneAndFaxNumber*/
    private $telephoneAndFaxNumber;
    /** @var string $website*/
    private $website;
    /** @var VatZone*/
    private $vatZone;
    /** @var string $lastUpdated*/
    private $lastUpdated;
    /** @var string $contacts*/
    private $contacts;
    /** @var boolean $barred*/
    private $barred;
    /** @var string $corporateIdentificationNumber*/
    private $corporateIdentificationNumber;
    /** @var int $creditLimit*/
    private $creditLimit;
    /** @var CustomerContact*/
    private $customerContact;
    /** @var string $ean*/
    private $ean;
    /** @var Layout*/
    private $layout;
    /** @var string $publicEntryNumber*/
    private $publicEntryNumber;
    /** @var SalesPerson*/
    private $salesPerson;
    /** @var string $vatNumber*/
    private $vatNumber;

    /** @var Economic*/
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function get($id)
    {
        $customer = $this->api->retrieve('/customers/' . $id);
        $this->api->setObject($customer, $this);
        return $this;
    }

    public function delete()
    {
        $this->api->delete('/customers/' . $this->getCustomerNumber());
        return $this;
    }

    public function create()
    {
        $data = [
            'name' => $this->getName(),
            'currency' => $this->getCurrency(),
            'customerGroup' => $this->getCustomerGroup(),
            'vatZone' => $this->getVatZone(),
            'paymentTerms' => $this->getPaymentTerms(),
            'website' => $this->getWebsite(),
            'address' => $this->getAddress(),
            'barred' => $this->getBarred(),
            'city' => $this->getCity(),
            'corporateIdentificationNumber' => $this->getCorporateIdentificationNumber(),
            'country' => $this->getCountry(),
            'creditLimit' => $this->getCreditLimit(),
            //1. Før at man kan tilknytte en kundekontakt, skal de være oprettet 'customerContact' => $this->getCustomerContact(),
            'customerNumber' => $this->getCustomerNumber(),
            'ean' => $this->getEan(),
            'email' => $this->getEmail(),
            //2. Error'layout' => $this->getLayout(),
            'publicEntryNumber' => $this->getPublicEntryNumber(),
            //3. Error'salesPerson' => $this->getSalesPerson(),
            'telephoneAndFaxNumber' => $this->getTelephoneAndFaxNumber(),
            'vatNumber' => $this->getVatNumber(),
            'zip' => $this->getZip()
        ];

       $customer = $this->api->create('/customers', array_filter($data));
       $this->api->setObject($customer, $this);
       return $this;
    }

    public function update()
    {
        $data = [
            'name' => $this->getName(),
            'currency' => $this->getCurrency(),
            'customerGroup' => $this->getCustomerGroup(),
            'vatZone' => $this->getVatZone(),
            'paymentTerms' => $this->getPaymentTerms(),
            'website' => $this->getWebsite(),
            'address' => $this->getAddress(),
            'barred' => $this->getBarred(),
            'city' => $this->getCity(),
            'corporateIdentificationNumber' => $this->getCorporateIdentificationNumber(),
            'country' => $this->getCountry(),
            'creditLimit' => $this->getCreditLimit(),
            //1. Før at man kan tilknytte en kundekontakt, skal de være oprettet 'customerContact' => $this->getCustomerContact(),
            'customerNumber' => $this->getCustomerNumber(),
            'ean' => $this->getEan(),
            'email' => $this->getEmail(),
            //2. Error'layout' => $this->getLayout(),
            'publicEntryNumber' => $this->getPublicEntryNumber(),
            //3. Error'salesPerson' => $this->getSalesPerson(),
            'telephoneAndFaxNumber' => $this->getTelephoneAndFaxNumber(),
            'vatNumber' => $this->getVatNumber(),
            'zip' => $this->getZip()
        ];

        $customer = $this->api->update('/customers/' . $this->getCustomerNumber(), $data);
        $this->api->setObject($customer, $this);
        return $this;
    }

    public function draftInvoices()
    {
        $invoices = $this->api->retrieve('/customers/'.$this->getCustomerNumber().'/invoices/drafts');
        return $invoices;
    }

    public function bookedInvoices()
    {
        $invoices = $this->api->retrieve('/customers/'.$this->getCustomerNumber().'/invoices/booked');
        return $invoices;
    }

    // Getters & Setters


    public function getCustomerNumber()
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber($customerNumber)
    {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function getPaymentTerms() : ?PaymentTerms
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = new PaymentTerms($paymentTerms->paymentTermsNumber);
        return $this;
    }

    public function getPaymentTermsNumber() {

        if (isset($this->paymentTerms))
        {
            return $this->paymentTerms->paymentTermsNumber;
        }

        return null;
    }

    public function setPaymentTermsNumber(int $paymentTermsNumber)
    {
        if (isset($this->paymentTerms))
        {
            $this->paymentTerms->paymentTermsNumber = $paymentTermsNumber;
        } else {
            $this->paymentTerms = new PaymentTerms($paymentTermsNumber);
        }

        return $this;
    }

    public function getCustomerGroup() : ?CustomerGroup
    {
        return $this->customerGroup;
    }

    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = new CustomerGroup($customerGroup->customerGroupNumber);
        return $this;
    }

    public function getCustomerGroupNumber()
    {
        if (isset($this->customerGroup))
        {
            return $this->customerGroup->customerGroupNumber;
        }

        return null;
    }

    public function setCustomerGroupNumber(int $customerGroupNumber)
    {
        if (isset($this->customerGroup))
        {
            $this->customerGroup->customerGroupNumber = $customerGroupNumber;
        } else {
            $this->customerGroup = new CustomerGroup($customerGroupNumber);
        }

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

    public function getDueAmount()
    {
        return $this->dueAmount;
    }

    public function setDueAmount($dueAmount)
    {
        $this->dueAmount = $dueAmount;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    public function getTelephoneAndFaxNumber()
    {
        return $this->telephoneAndFaxNumber;
    }

    public function setTelephoneAndFaxNumber($telephoneAndFaxNumber)
    {
        $this->telephoneAndFaxNumber = $telephoneAndFaxNumber;
        return $this;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    public function getVatZone() : ?VatZone
    {
        return $this->vatZone;
    }

    /**
     * @param \stdClass|object $vatZone
     * @return $this
     */
    public function setVatZone($vatZone)
    {
        $this->vatZone = new VatZone($vatZone->vatZoneNumber);
        return $this;
    }

    public function getVatZoneNumber()
    {
        if (isset($this->vatZone))
        {
            return $this->vatZone->vatZoneNumber;
        }
        return null;
    }

    public function setVatZoneNumber(int $vatZoneNumber)
    {
        if (isset($this->vatZone))
        {
            $this->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->vatZone = new VatZone($vatZoneNumber);
        }
        return $this;
    }

    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    public function getContacts()
    {
        return $this->contacts;
    }

    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
        return $this;
    }

    public function getBarred()
    {
        return $this->barred;
    }

    public function setBarred($barred)
    {
        $this->barred = $barred;
        return $this;
    }

    public function getCorporateIdentificationNumber()
    {
        return $this->corporateIdentificationNumber;
    }

    public function setCorporateIdentificationNumber($corporateIdentificationNumber)
    {
        $this->corporateIdentificationNumber = $corporateIdentificationNumber;
        return $this;
    }

    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;
        return $this;
    }

    public function getCustomerContact() : ?CustomerContact
    {
        return new CustomerContact($this->customerContact);
    }

    public function setCustomerContact($customerContact)
    {
        $this->customerContact = $customerContact;
        return $this;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function setEan($ean)
    {
        $this->ean = $ean;
        return $this;
    }

    public function getLayout() : ?Layout
    {
        return new Layout($this->layout);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function getPublicEntryNumber()
    {
        return $this->publicEntryNumber;
    }

    public function setPublicEntryNumber($publicEntryNumber)
    {
        $this->publicEntryNumber = $publicEntryNumber;
        return $this;
    }

    public function getSalesPerson() : ?SalesPerson
    {
        return new SalesPerson($this->salesPerson);
    }

    public function setSalesPerson($salesPerson)
    {
        $this->salesPerson = $salesPerson;
    }

    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;
        return $this;
    }

}