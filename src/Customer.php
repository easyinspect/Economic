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
    }

    public function save()
    {

        foreach ($this->all()->collection as $key => $value)
        {

            if ($value->customerNumber === $this->getCustomerNumber())
            {
                echo $this->getCustomerNumber() . 'findes allerede i API kaldet';

            } else {

                echo $this->getCustomerNumber() . 'findes ikke i API kaldet';
            }
        }
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
     * @return mixed
     */
    public function setCustomerNumber(int $customerNumber)
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
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
     * @return mixed
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;

        return $this;
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
     * @return mixed
     */
    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = $customerGroup;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return string
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
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
    public function getCity() : string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return string
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return string
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return string
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return string
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getZip() : string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return string
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
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
     * @return mixed
     */
    public function setTelephoneAndFaxNumber($telephoneAndFaxNumber)
    {
        $this->telephoneAndFaxNumber = $telephoneAndFaxNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite() : string
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return string
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
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
     * @return mixed
     */
    public function setVatZone($vatZone)
    {
        $this->vatZone = $vatZone;

        return $this;
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
     * @return mixed
     */
    public function setAttention($attention)
    {
        $this->attention = $attention;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastUpdated() : string
    {
        return $this->lastUpdated;
    }

    /**
     * @param string $lastUpdated
     * @return string
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * @return string
     */
    public function getContacts() : string
    {
        return $this->contacts;
    }

    /**
     * @param string $contacts
     * @return string
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
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
     * @return mixed
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;

        return $this;
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
     * @return mixed
     */
    public function setTotals($totals)
    {
        $this->totals = $totals;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryLocations() : string
    {
        return $this->deliveryLocations;
    }

    /**
     * @param string $deliveryLocations
     * @return string
     */
    public function setDeliveryLocations($deliveryLocations)
    {
        $this->deliveryLocations = $deliveryLocations;

        return $this;
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
     * @return mixed
     */
    public function setInvoices($invoices)
    {
        $this->invoices = $invoices;

        return $this;
    }
}