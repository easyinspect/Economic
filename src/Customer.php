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

    public function all() {
        $customers = $this->listener->retrieve('/customers');
    }

    public function get($id) {
        $customer = $this->listener->retrieve('/customers/' . $id);
    }



    // Getters & Setters

    /**
     * @return int
     */
    public function getCustomerNumber() : int
    {
        return $this->customerNumber;
    }

    /**
     * @param int $customerNumber
     */
    public function setCustomerNumber(int $customerNumber)
    {
        $this->customerNumber = $customerNumber;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @param mixed $paymentTerms
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;
    }

    /**
     * @return mixed
     */
    public function getCustomerGroup()
    {
        return $this->customerGroup;
    }

    /**
     * @param mixed $customerGroup
     */
    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = $customerGroup;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getDueAmount()
    {
        return $this->dueAmount;
    }

    /**
     * @param mixed $dueAmount
     */
    public function setDueAmount($dueAmount)
    {
        $this->dueAmount = $dueAmount;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getTelephoneAndFaxNumber()
    {
        return $this->telephoneAndFaxNumber;
    }

    /**
     * @param mixed $telephoneAndFaxNumber
     */
    public function setTelephoneAndFaxNumber($telephoneAndFaxNumber)
    {
        $this->telephoneAndFaxNumber = $telephoneAndFaxNumber;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getVatZone()
    {
        return $this->vatZone;
    }

    /**
     * @param mixed $vatZone
     */
    public function setVatZone($vatZone)
    {
        $this->vatZone = $vatZone;
    }

    /**
     * @return mixed
     */
    public function getAttention()
    {
        return $this->attention;
    }

    /**
     * @param mixed $attention
     */
    public function setAttention($attention)
    {
        $this->attention = $attention;
    }

    /**
     * @return mixed
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @param mixed $lastUpdated
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * @return mixed
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param mixed $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return mixed
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @param mixed $templates
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;
    }

    /**
     * @return mixed
     */
    public function getTotals()
    {
        return $this->totals;
    }

    /**
     * @param mixed $totals
     */
    public function setTotals($totals)
    {
        $this->totals = $totals;
    }

    /**
     * @return mixed
     */
    public function getDeliveryLocations()
    {
        return $this->deliveryLocations;
    }

    /**
     * @param mixed $deliveryLocations
     */
    public function setDeliveryLocations($deliveryLocations)
    {
        $this->deliveryLocations = $deliveryLocations;
    }

    /**
     * @return mixed
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    /**
     * @param mixed $invoices
     */
    public function setInvoices($invoices)
    {
        $this->invoices = $invoices;
    }

}