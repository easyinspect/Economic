<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 13:15
 */

namespace Economic;

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
        $vatZone = new \stdClass();
        $vatZone->vatZoneNumber = $this->getVatZone();

        $customerGroup = new \stdClass();
        $customerGroup->customerGroupNumber = $this->getCustomerGroup();

        $paymentTerms = new \stdClass();
        $paymentTerms->paymentTermsNumber = $this->getPaymentTerms();

        $data = [
            'name' => $this->getName(),
            'currency' => $this->getCurrency(),
            'customerGroup' => $customerGroup,
            'vatZone' => $vatZone,
            'paymentTerms' => $paymentTerms
        ];

       $this->listener->create('/customers', $data);

       return $this;
    }

    public function update()
    {
        $vatZone = new \stdClass();
        $vatZone->vatZoneNumber = $this->getVatZone();

        $customerGroup = new \stdClass();
        $customerGroup->customerGroupNumber = $this->getCustomerGroup();

        $paymentTerms = new \stdClass();
        $paymentTerms->paymentTermsNumber = $this->getPaymentTerms();

        $data = [
            'name' => $this->getName(),
            'currency' => $this->getCurrency(),
            'customerGroup' => $customerGroup,
            'vatZone' => $vatZone,
            'paymentTerms' => $paymentTerms
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

    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;

        return $this;
    }

    public function getCustomerGroup()
    {
        return $this->customerGroup;
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

    public function getVatZone()
    {
        return $this->vatZone;
    }

    public function setVatZone($vatZone)
    {
        $this->vatZone = $vatZone;

        return $this;
    }

    public function getAttention()
    {
        return $this->attention;
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
}