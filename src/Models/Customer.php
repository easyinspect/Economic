<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 13:15.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\Totals;
use Economic\Models\Components\VatZone;
use Economic\Models\Components\Invoices;
use Economic\Models\Components\SalesPerson;
use Economic\Validations\CustomerValidator;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\CustomerGroup;
use Economic\Models\Components\CustomerContact;
use Economic\Models\Components\DefaultDeliveryLocation;

class Customer
{
    /** @var int $customerNumber */
    private $customerNumber;
    /** @var string $currency */
    private $currency;
    /** @var PaymentTerms $paymentTerms */
    private $paymentTerms;
    /** @var CustomerGroup $customerGroup */
    private $customerGroup;
    /** @var string $address */
    private $address;
    /** @var float $balance */
    private $balance;
    /** @var float $dueAmount */
    private $dueAmount;
    /** @var string $city */
    private $city;
    /** @var CustomerContact $customerContact */
    private $customerContact;
    /** @var string $country */
    private $country;
    /** @var string $email */
    private $email;
    /** @var string $name */
    private $name;
    /** @var int $zip */
    private $zip;
    /** @var int $telephoneAndFaxNumber */
    private $telephoneAndFaxNumber;
    /** @var Invoices $invoices */
    private $invoices;
    /** @var string $website */
    private $website;
    /** @var VatZone $vatZone */
    private $vatZone;
    /** @var string $lastUpdated */
    private $lastUpdated;
    /** @var DefaultDeliveryLocation $defaultDeliveryLocation */
    private $defaultDeliveryLocation;
    /** @var string $deliveryLocations */
    private $deliveryLocations;
    /** @var bool $barred */
    private $barred;
    /** @var string $corporateIdentificationNumber */
    private $corporateIdentificationNumber;
    /** @var int $creditLimit */
    private $creditLimit;
    /** @var string $ean */
    private $ean;
    /** @var Totals $totals */
    private $totals;
    /** @var string $publicEntryNumber */
    private $publicEntryNumber;
    /** @var string $vatNumber */
    private $vatNumber;
    /** @var SalesPerson $salesPerson */
    private $salesPerson;
    /** @var string $contacts */
    private $contacts;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * Customer constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Customer
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Customer
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $customer = new self($economic);

        $customer->setCustomerNumber($stdClass->customerNumber);
        $customer->setCurrency($stdClass->currency);
        $customer->setPaymentTerms($stdClass->paymentTerms);
        $customer->setCustomerGroup($stdClass->customerGroup);
        $customer->setAddress($stdClass->address ?? null);
        $customer->setBalance($stdClass->balance);
        $customer->setDueAmount($stdClass->dueAmount);
        $customer->setCity($stdClass->city ?? null);
        $customer->setCountry($stdClass->country ?? null);
        $customer->setEmail($stdClass->email ?? null);
        $customer->setName($stdClass->name);
        $customer->setZip($stdClass->zip ?? null);
        $customer->setTelephoneAndFaxNumber($stdClass->telephoneAndFaxNumber ?? null);
        $customer->setWebsite($stdClass->website ?? null);
        $customer->setVatZone($stdClass->vatZone);
        $customer->setLastUpdated($stdClass->lastUpdated);
        $customer->setBarred($stdClass->barred ?? null);
        $customer->setCorporateIdentificationNumber($stdClass->corporateIdentificationNumber ?? null);
        $customer->setCreditLimit($stdClass->creditLimit ?? null);
        $customer->setEan($stdClass->ean ?? null);
        $customer->setPublicEntryNumber($stdClass->publicEntryNumber ?? null);
        $customer->setSalesPerson($stdClass->salesPerson ?? null);
        $customer->setContacts($stdClass->contacts);
        $customer->setInvoices($stdClass->invoices);
        $customer->setDefaultDeliveryLocation($stdClass->defaultDeliveryLocation ?? null);
        $customer->setDeliveryLocations($stdClass->deliveryLocations);
        $customer->setTotals($stdClass->totals);
        $customer->setVatNumber($stdClass->vatNumber ?? null);
        $customer->setSelf($stdClass->self);

        return $customer;
    }

    /**
     * Retrieves a single Customer by its ID
     * @param int $id
     * @return Customer
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/customers/'.$id));
    }

    /**
     * Deletes a Customer
     * Requires the get(id) method in order to perform this.
     */
    public function delete()
    {
        return $this->economic->delete('/customers/'.$this->getCustomerNumber());
    }

    /**
     * Creates a Customer
     * @return Customer
     */
    public function create()
    {
        $data = (object) [
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
            'customerNumber' => $this->getCustomerNumber(),
            'ean' => $this->getEan(),
            'email' => $this->getEmail(),
            'publicEntryNumber' => $this->getPublicEntryNumber(),
            'salesPerson' => $this->getSalesPerson(),
            'telephoneAndFaxNumber' => $this->getTelephoneAndFaxNumber(),
            'zip' => $this->getZip(),
            'vatNumber' => $this->getVatNumber(),
        ];

        $this->economic->cleanObject($data);

        $validator = CustomerValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->create('/customers', $data));
    }

    /**
     * Updates a Customer
     * @return Customer
     */
    public function update()
    {
        $data = (object) [
            'address' => $this->getAddress(),
            'barred' => $this->getBarred(),
            'city' => $this->getCity(),
            'corporateIdentificationNumber' => $this->getCorporateIdentificationNumber(),
            'country' => $this->getCountry(),
            'creditLimit' => $this->getCreditLimit(),
            'currency' => $this->getCurrency(),
            'customerGroup' => $this->getCustomerGroup(),
            'customerNumber' => $this->getCustomerNumber(),
            'ean' => $this->getEan(),
            'email' => $this->getEmail(),
            'name' => $this->getName(),
            'paymentTerms' => $this->getPaymentTerms(),
            'publicEntryNumber' => $this->getPublicEntryNumber(),
            'salesPerson' => $this->getSalesPerson(),
            'customerContact' => $this->getCustomerContact(),
            'telephoneAndFaxNumber' => $this->getTelephoneAndFaxNumber(),
            'vatNumber' => $this->getVatNumber(),
            'vatZone' => $this->getVatZone(),
            'website' => $this->getWebsite(),
            'zip' => $this->getZip(),
        ];

        $this->economic->cleanObject($data);

        return self::transform($this->economic, $this->economic->update('/customers/'.$this->getCustomerNumber(), $data));
    }

    /**
     * Retrieves a collection of draft Invoices
     * @return DraftInvoice
     */
    public function draftInvoices()
    {
        return $this->economic->collection('/customers/'.$this->getCustomerNumber().'/invoices/drafts?', new DraftInvoice($this->economic));
    }

    /**
     * Retrieves a collection of booked Invoices
     * @return Invoice
     */
    public function bookedInvoices()
    {
        return $this->economic->collection('/customers/'.$this->getCustomerNumber().'/invoices/booked?', new Invoice($this->economic));
    }

    // Getters & Setters

    /**
     * @return CustomerContact
     */
    public function getCustomerContact() : ?CustomerContact
    {
        return $this->customerContact;
    }

    /**
     * @param CustomerContact $customerContact
     * @return $this
     */
    public function setCustomerContact($customerContact = null)
    {
        if (isset($customerContact)) {
            $this->customerContact = new CustomerContact($customerContact->customerContactNumber, $customerContact->self);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerContactNumber() : ?int
    {
        if (isset($this->customerContact)) {
            return $this->customerContact->customerContactNumber;
        }

        return null;
    }

    /**
     * @param int $customerContactNumber
     * @return $this
     */
    public function setCustomerContactNumber(int $customerContactNumber)
    {
        if (isset($this->customerContact)) {
            $this->customerContact->customerContactNumber = $customerContactNumber;
        } else {
            $this->customerContact = $this->economic->setClass('CustomerContact', 'customerContactNumber');
            $this->customerContact->customerContactNumber = $customerContactNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getVatNumber() : ?string
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     * @return $this
     */
    public function setVatNumber(?string $vatNumber)
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    /**
     * @return Totals
     */
    public function getTotals() : ?Totals
    {
        return $this->totals;
    }

    /**
     * @param Totals $totals
     * @return $this
     */
    public function setTotals($totals)
    {
        $this->totals = new Totals($totals->booked, $totals->drafts, $totals->self);

        return $this;
    }

    /**
     * @return Invoices
     */
    public function getInvoices() : ?Invoices
    {
        return $this->invoices;
    }

    /**
     * @param Invoices $invoices
     * @return $this
     */
    public function setInvoices($invoices)
    {
        $this->invoices = new Invoices($invoices->booked, $invoices->drafts);

        return $this;
    }

    /**
     * @return DefaultDeliveryLocation
     */
    public function getDefaultDeliveryLocation() : ?DefaultDeliveryLocation
    {
        return $this->defaultDeliveryLocation;
    }

    /**
     * @param DefaultDeliveryLocation $defaultDeliveryLocation
     * @return $this
     */
    public function setDefaultDeliveryLocation($defaultDeliveryLocation = null)
    {
        if (isset($defaultDeliveryLocation)) {
            $this->defaultDeliveryLocation = new DefaultDeliveryLocation($defaultDeliveryLocation->deliveryLocationNumber, $defaultDeliveryLocation->self);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerNumber() : ?int
    {
        return $this->customerNumber;
    }

    /**
     * @param int $customerNumber
     * @return $this
     */
    public function setCustomerNumber(int $customerNumber)
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }

    /** @return string */
    public function getCurrency() : ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

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
     * @return $this
     */
    public function setContacts(string $contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /** @return PaymentTerms */
    public function getPaymentTerms() : ?PaymentTerms
    {
        return $this->paymentTerms;
    }

    /**
     * @param PaymentTerms
     * @return $this
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = new PaymentTerms($paymentTerms->paymentTermsNumber, $paymentTerms->self);

        return $this;
    }

    /** @return int */
    public function getPaymentTermsNumber() : ?int
    {
        if (isset($this->paymentTerms)) {
            return $this->paymentTerms->paymentTermsNumber;
        }

        return null;
    }

    /**
     * @param int $paymentTermsNumber
     * @return $this
     */
    public function setPaymentTermsNumber(int $paymentTermsNumber)
    {
        if (isset($this->paymentTerms)) {
            $this->paymentTerms->paymentTermsNumber = $paymentTermsNumber;
        } else {
            $this->paymentTerms = $this->economic->setClass('PaymentTerms', 'paymentTermsNumber');
            $this->paymentTerms->paymentTermsNumber = $paymentTermsNumber;
        }

        return $this;
    }

    /** @return CustomerGroup */
    public function getCustomerGroup() : ?CustomerGroup
    {
        return $this->customerGroup;
    }

    /**
     * @param CustomerGroup $customerGroup
     * @return $this
     */
    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = new CustomerGroup($customerGroup->customerGroupNumber, $customerGroup->self);

        return $this;
    }

    /** @return int */
    public function getCustomerGroupNumber() : ?int
    {
        if (isset($this->customerGroup)) {
            return $this->customerGroup->customerGroupNumber;
        }

        return null;
    }

    /**
     * @param int $customerGroupNumber
     * @return $this
     */
    public function setCustomerGroupNumber(int $customerGroupNumber)
    {
        if (isset($this->customerGroup)) {
            $this->customerGroup->customerGroupNumber = $customerGroupNumber;
        } else {
            $this->customerGroup = $this->economic->setClass('CustomerGroup', 'customerGroupNumber');
            $this->customerGroup->customerGroupNumber = $customerGroupNumber;
        }

        return $this;
    }

    /** @return string */
    public function getAddress() : ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(?string $address)
    {
        $this->address = $address;

        return $this;
    }

    /** @return float */
    public function getBalance() : ?float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     * @return $this
     */
    public function setBalance(float $balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /** @return float */
    public function getDueAmount() : ?float
    {
        return $this->dueAmount;
    }

    /**
     * @param float $dueAmount
     * @return $this
     */
    public function setDueAmount(float $dueAmount)
    {
        $this->dueAmount = $dueAmount;

        return $this;
    }

    /** @return string */
    public function getCity() : ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(?string $city)
    {
        $this->city = $city;

        return $this;
    }

    /** @return string */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(?string $country)
    {
        $this->country = $country;

        return $this;
    }

    /** @return string */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }

    /** @return string */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(?string $name)
    {
        $this->name = $name;

        return $this;
    }

    /** @return string */
    public function getZip() : ?string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return $this
     */
    public function setZip(?string $zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /** @return string */
    public function getTelephoneAndFaxNumber() : ?string
    {
        return $this->telephoneAndFaxNumber;
    }

    /**
     * @param string $telephoneAndFaxNumber
     * @return $this
     */
    public function setTelephoneAndFaxNumber(?string $telephoneAndFaxNumber)
    {
        $this->telephoneAndFaxNumber = $telephoneAndFaxNumber;

        return $this;
    }

    /** @return string */
    public function getWebsite() : ?string
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return $this
     */
    public function setWebsite(?string $website)
    {
        $this->website = $website;

        return $this;
    }

    /** @return VatZone */
    public function getVatZone() : ?VatZone
    {
        return $this->vatZone;
    }

    /**
     * @param VatZone $vatZone
     * @return $this
     */
    public function setVatZone($vatZone)
    {
        $this->vatZone = new VatZone($vatZone->vatZoneNumber, $vatZone->self);

        return $this;
    }

    /** @return int */
    public function getVatZoneNumber() : ?int
    {
        if (isset($this->vatZone)) {
            return $this->vatZone->vatZoneNumber;
        }

        return null;
    }

    /**
     * @param int $vatZoneNumber
     * @return $this
     */
    public function setVatZoneNumber(int $vatZoneNumber)
    {
        if (isset($this->vatZone)) {
            $this->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->vatZone = $this->economic->setClass('VatZone', 'vatZoneNumber');
            $this->vatZone->vatZoneNumber = $vatZoneNumber;
        }

        return $this;
    }

    /** @return string */
    public function getLastUpdated() : ?string
    {
        return $this->lastUpdated;
    }

    /**
     * @param string $lastUpdated
     * @return $this
     */
    public function setLastUpdated(string $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /** @return bool */
    public function getBarred() : ?boolean
    {
        return $this->barred;
    }

    /**
     * @param bool $barred
     * @return $this
     */
    public function setBarred(?boolean $barred)
    {
        $this->barred = $barred;

        return $this;
    }

    /** @return string */
    public function getCorporateIdentificationNumber() : ?string
    {
        return $this->corporateIdentificationNumber;
    }

    /**
     * @param string $corporateIdentificationNumber
     * @return $this
     */
    public function setCorporateIdentificationNumber(?string $corporateIdentificationNumber)
    {
        $this->corporateIdentificationNumber = $corporateIdentificationNumber;

        return $this;
    }

    /** @return float */
    public function getCreditLimit() : ?float
    {
        return $this->creditLimit;
    }

    /**
     * @param float $creditLimit
     * @return $this
     */
    public function setCreditLimit(?float $creditLimit)
    {
        $this->creditLimit = $creditLimit;

        return $this;
    }

    /** @return string */
    public function getEan() : ?string
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     * @return $this
     */
    public function setEan(?string $ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /** @return string */
    public function getPublicEntryNumber() : ?string
    {
        return $this->publicEntryNumber;
    }

    /**
     * @param string $publicEntryNumber
     * @return $this
     */
    public function setPublicEntryNumber(?string $publicEntryNumber)
    {
        $this->publicEntryNumber = $publicEntryNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryLocations() : ?string
    {
        return $this->deliveryLocations;
    }

    /**
     * @param string $deliveryLocations
     * @return $this
     */
    public function setDeliveryLocations(string $deliveryLocations)
    {
        $this->deliveryLocations = $deliveryLocations;

        return $this;
    }

    /** @return SalesPerson */
    public function getSalesPerson() : ?SalesPerson
    {
        return $this->salesPerson;
    }

    /**
     * @param SalesPerson $salesPerson
     * @return $this
     */
    public function setSalesPerson($salesPerson = null)
    {
        if (isset($salesPerson)) {
            $this->salesPerson = new SalesPerson($salesPerson->employeeNumber, $salesPerson->self);
        }

        return $this;
    }

    /** @return int */
    public function getSalesPersonNumber() : ?int
    {
        if (isset($this->salesPerson)) {
            return $this->salesPerson->employeeNumber;
        }

        return null;
    }

    /**
     * @param int $employeeNumber
     * @return $this
     */
    public function setSalesPersonNumber(?int $employeeNumber)
    {
        if (isset($this->salesPerson)) {
            $this->salesPerson->employeeNumber = $employeeNumber;
        } else {
            $this->salesPerson = $this->economic->setClass('SalesPerson', 'employeeNumber');
            $this->salesPerson->employeeNumber = $employeeNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return $this
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
