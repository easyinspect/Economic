<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-09-2017
 * Time: 16:17
 */
namespace Economic\Models;

class Customer extends EconomicModel
{

    /** @var string $name */
    private $name;

    /** @var string $currency */
    private $currency;

    /** @var mixed $customerGroup */
    private $customerGroup;

    /** @var mixed $paymentTerms */
    private $paymentTerms;

    /** @var mixed $vatZone */
    private $vatZone;

    /** @var int $vatNumber */
    private $vatNumber;

    /** @var string $customerNumber */
    private $customerNumber;

    /** @var string $address */
    private $address;

    /** @var mixed $attention */
    private $attention;

    /** @var int $balance */
    private $balance;

    /** @var boolean $barred */
    private $barred;

    /** @var string $city */
    private $city;

    /** @var string $contacts */
    private $contacts;

    /** @var string $corporateIdentificationNumber */
    private $corporateIdentificationNumber;

    /** @var string $country */
    private $country;

    /** @var int $creditLimit */
    private $creditLimit;

    /** @var mixed $customerContact */
    private $customerContact;

    /** @var mixed $defaultDeliveryLocation */
    private $defaultDeliveryLocation;

    /** @var string $deliveryLocations */
    private $deliveryLocations;

    /** @var string $ean */
    private $ean;

    /** @var string $email */
    private $email;

    /** @var mixed $invoices */
    private $invoices;

    /** @var string $lastUpdated */
    private $lastUpdated;

    /** @var mixed $layout */
    private $layout;

    /** @var string $privateEntryNumber */
    private $privateEntryNumber;

    /** @var mixed $salesPerson */
    private $salesPerson;

    /** @var string $self */
    private $self;

    /** @var string $telephoneAndFaxNumber */
    private $telephoneAndFaxNumber;

    /** @var mixed $privateEntryNumber */
    private $templates;

    /** @var mixed $totals */
    private $totals;

    /** @var string $website */
    private $website;

    /** @var string $zip */
    private $zip;

    public function __construct($api)
    {
        $this->setApi($api);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getCustomerGroup()
    {
        return $this->customerGroup;
    }

    /**
     * @param object $customerGroup
     */
    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = $customerGroup;
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
    public function getVatZone()
    {
        return $this->vatZone;
    }

    /**
     * @param string $vatZone
     */
    public function setVatZone($vatZone)
    {
        $this->vatZone = new VatZone($this->api);
    }

    /**
     * @return int
     */
    public function getVatNumber(): int
    {
        return $this->vatNumber;
    }

    /**
     * @param int $vatNumber
     */
    public function setVatNumber(int $vatNumber)
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @return mixed
     */
    public function getCustomerNumber()
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
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
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
     * @return bool
     */
    public function isBarred(): bool
    {
        return $this->barred;
    }

    /**
     * @param bool $barred
     */
    public function setBarred(bool $barred)
    {
        $this->barred = $barred;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getContacts(): string
    {
        return $this->contacts;
    }

    /**
     * @param string $contacts
     */
    public function setContacts(string $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return string
     */
    public function getCorporateIdentificationNumber(): string
    {
        return $this->corporateIdentificationNumber;
    }

    /**
     * @param string $corporateIdentificationNumber
     */
    public function setCorporateIdentificationNumber(string $corporateIdentificationNumber)
    {
        $this->corporateIdentificationNumber = $corporateIdentificationNumber;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return number
     */
    public function getCreditLimit(): number
    {
        return $this->creditLimit;
    }

    /**
     * @param number $creditLimit
     */
    public function setCreditLimit(number $creditLimit)
    {
        $this->creditLimit = $creditLimit;
    }

    /**
     * @return mixed
     */
    public function getCustomerContact()
    {
        return $this->customerContact;
    }

    /**
     * @param object $customerContact
     */
    public function setCustomerContact( $customerContact)
    {
        $this->customerContact = $customerContact;
    }

    /**
     * @return object
     */
    public function getDefaultDeliveryLocation()
    {
        return $this->defaultDeliveryLocation;
    }

    /**
     * @param mixed $defaultDeliveryLocation
     */
    public function setDefaultDeliveryLocation( $defaultDeliveryLocation)
    {
        $this->defaultDeliveryLocation = $defaultDeliveryLocation;
    }

    /**
     * @return string
     */
    public function getDeliveryLocations(): string
    {
        return $this->deliveryLocations;
    }

    /**
     * @param string $deliveryLocations
     */
    public function setDeliveryLocations(string $deliveryLocations)
    {
        $this->deliveryLocations = $deliveryLocations;
    }

    /**
     * @return string
     */
    public function getEan(): string
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     */
    public function setEan(string $ean)
    {
        $this->ean = $ean;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return object
     */
    public function getInvoices(): object
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

    /**
     * @return string
     */
    public function getLastUpdated(): string
    {
        return $this->lastUpdated;
    }

    /**
     * @param string $lastUpdated
     */
    public function setLastUpdated(string $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param object $layout
     */
    public function setLayout( $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return string
     */
    public function getPrivateEntryNumber(): string
    {
        return $this->privateEntryNumber;
    }

    /**
     * @param string $privateEntryNumber
     */
    public function setPrivateEntryNumber(string $privateEntryNumber)
    {
        $this->privateEntryNumber = $privateEntryNumber;
    }

    /**
     * @return mixed
     */
    public function getSalesPerson()
    {
        return $this->salesPerson;
    }

    /**
     * @param object $salesPerson
     */
    public function setSalesPerson($salesPerson)
    {
        $this->salesPerson = $salesPerson;
    }

    /**
     * @return string
     */
    public function getSelf(): string
    {
        return $this->self;
    }

    /**
     * @param string $self
     */
    public function setSelf(string $self)
    {
        $this->self = $self;
    }

    /**
     * @return string
     */
    public function getTelephoneAndFaxNumber(): string
    {
        return $this->telephoneAndFaxNumber;
    }

    /**
     * @param string $telephoneAndFaxNumber
     */
    public function setTelephoneAndFaxNumber(string $telephoneAndFaxNumber)
    {
        $this->telephoneAndFaxNumber = $telephoneAndFaxNumber;
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
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }

    public function fillByObject($object)
    {
        foreach(get_object_vars($object) as $key => $value) {
            if (method_exists($this, 'set'. strtoupper($key)))
            {
                call_user_func_array(array($this,'set'. strtoupper($key)), array($value));
            }
        }
        return $this;
    }

    public function getByCustNumber($id)
    {
        $data = $this->api->getItem('/customers/' . $id);
        $this->fillByObject($data);
        return $this;
    }

    public function delete()
    {
        $this->api->delete('/customer/'. $this->getCustomerNumber());
        return $this;
    }

}