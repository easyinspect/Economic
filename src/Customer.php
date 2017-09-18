<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 13:15
 */

namespace Economic;

use Economic\Models\Components\CustomerGroup;
use Economic\Models\Components\VatZone;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\CustomerContact;
use Economic\Models\Components\DefaultDeliveryLocations;
use Economic\Models\Components\Attention;
use Economic\Models\Components\Layout;
use Economic\Models\Components\SalesPerson;

class Customer
{

    private $customerNumber;
    private $currency;
    private $paymentTerms;
    private $customerGroup;
    private $address;
    private $balance;
    private $dueAmount;
    private $city;
    private $country;
    private $email;
    private $name;
    private $zip;
    private $telephoneAndFaxNumber;
    private $website;
    private $vatZone;
    private $attention;
    private $lastUpdated;
    private $contacts;
    private $templates;
    private $totals;
    private $deliveryLocations;
    private $invoices;
    private $barred;
    private $corporateIdentificationNumber;
    private $creditLimit;
    private $customerContact;
    private $defaultDeliveryLocations;
    private $ean;
    private $layout;
    private $publicEntryNumber;
    private $salesPerson;
    private $vatNumber;

    private $listener;

    public function __construct(RespondToSchema $listener)
    {
        $this->listener = $listener;
    }

    protected function processObject($object)
    {
        foreach ($object as $key => $value)
        {
            if (method_exists($this, 'set'.ucfirst($key)))
            {
                $this->{'set' . ucfirst($key)}($value);
            }
        }

        return $this;
    }

    public function all()
    {
        $customers = $this->listener->retrieve('/customers');

        return $customers;
    }

    public function get($id)
    {
        $customer = $this->listener->retrieve('/customers/' . $id);
        $this->processObject($customer);

        return $this;
    }

    public function delete()
    {
        $this->listener->delete('/customers/' . $this->getCustomerNumber());

        return $this;
    }

    public function create()
    {
        $data = [
            'name' => $this->getName(),
            'currency' => $this->getCurrency(),
            'customerGroup' => $this->getCustomerGroup(),
            'vatZone' => $this->getVatZone(),
            'paymentTerms' => $this->getVatZone()
        ];

       $this->listener->create('/customers', $data);

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
            /*'address' => $this->getAddress(),
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
            */
        ];

        $this->listener->update('/customers/' . $this->getCustomerNumber(), $data);

        return $this;
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

    public function getPaymentTerms() : PaymentTerms
    {
        return new PaymentTerms($this->paymentTerms);
    }

    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;

        return $this;
    }

    public function getCustomerGroup() : CustomerGroup
    {
        return new CustomerGroup($this->customerGroup);
    }

    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = $customerGroup;

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
    }

    public function getDueAmount()
    {
        return $this->dueAmount;
    }

    public function setDueAmount($dueAmount)
    {
        $this->dueAmount = $dueAmount;
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

    public function getVatZone() : VatZone
    {
        return new VatZone($this->vatZone);
    }

    public function setVatZone($vatZone)
    {
        $this->vatZone = $vatZone;

        return $this;
    }

    public function getAttention() : Attention
    {
        return new Attention($this->attention);
    }

    public function setAttention($attention)
    {
        $this->attention = $attention;

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

    public function getTemplates()
    {
        return $this->templates;
    }

    public function setTemplates($templates)
    {
        $this->templates = $templates;

        return $this;
    }

    public function getTotals()
    {
        return $this->totals;
    }

    public function setTotals($totals)
    {
        $this->totals = $totals;

        return $this;
    }

    public function getDeliveryLocations()
    {
        return $this->deliveryLocations;
    }

    public function setDeliveryLocations($deliveryLocations)
    {
        $this->deliveryLocations = $deliveryLocations;

        return $this;
    }

    public function getInvoices()
    {
        return $this->invoices;
    }

    public function setInvoices($invoices)
    {
        $this->invoices = $invoices;

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

    public function getCustomerContact() : CustomerContact
    {
        return new CustomerContact($this->customerContact);
    }

    public function setCustomerContact($customerContact)
    {
        $this->customerContact = $customerContact;

        return $this;
    }

    public function getDefaultDeliveryLocations() : DefaultDeliveryLocations
    {
        return new DefaultDeliveryLocations($this->defaultDeliveryLocations);
    }

    public function setDefaultDeliveryLocations($defaultDeliveryLocations)
    {
        $this->defaultDeliveryLocations = $defaultDeliveryLocations;

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

    public function getLayout() : Layout
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

    public function getSalesPerson() : SalesPerson
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