<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\Account;
use Economic\Models\Components\Project;
use Economic\Models\Components\Customer;
use Economic\Models\Components\Supplier;
use Economic\Models\Components\ProductGroup\VatAccount;
use Economic\Models\Components\DepartmentalDistribution;

class Entries
{
    /** @var Account $account */
    private $account;
    /** @var int $amount */
    private $amount;
    /** @var int $amountInBaseCurrency */
    private $amountInBaseCurrency;
    /** @var string $currency */
    private $currency;
    /** @var Customer $customer */
    private $customer;
    /** @var string $date */
    private $date;
    /** @var DepartmentalDistribution $departmentalDistribution */
    private $departmentalDistribution;
    /** @var int $entryNumber */
    private $entryNumber;
    /** @var string $entryType */
    private $entryType;
    /** @var Project $project */
    private $project;
    /** @var Supplier $supplier */
    private $supplier;
    /** @var string $text */
    private $text;
    /** @var VatAccount $vatAccount */
    private $vatAccount;
    /** @var int $voucherNumber */
    private $voucherNumber;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * Entries constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Entries.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Entries
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $entries = new self($economic);

        $entries->setAccount($stdClass->account);
        $entries->setAmount($stdClass->amount);
        $entries->setAmountInBaseCurrency($stdClass->amountInBaseCurrency);
        $entries->setCurrency($stdClass->currency);
        $entries->setCustomer($stdClass->customer);
        $entries->setDate($stdClass->date);
        $entries->setDepartmentalDistribution($stdClass->departmentalDistribution);
        $entries->setEntryNumber($stdClass->entryNumber);
        $entries->setEntryType($stdClass->entryType);
        $entries->setProject($stdClass->project);
        $entries->setSupplier($stdClass->supplier);
        $entries->setText($stdClass->text);
        $entries->setVatAccount($stdClass->vatAccount);
        $entries->setVoucherNumber($stdClass->voucherNumber);
        $entries->setSelf($stdClass->self);

        return $entries;
    }

    /**
     * Retrieves a single Currency by its code.
     * @param int $entryNumber
     * @return Entries
     */
    public function get(int $entryNumber)
    {
        return self::transform($this->economic, $this->economic->get('/entries/'.$entryNumber));
    }

    // Getters & Setters

    /**
     * @return Account|null
     */
    public function getAccount() : ?Account
    {
        return $this->account;
    }

    /**
     * @param \stdClass $stdClass
     * @return Entries
     */
    public function setAccount(\stdClass $stdClass)
    {
        $this->account = new Account($stdClass->accountNumber, $stdClass->self);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAmount() : ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Entries
     */
    public function setAmount(int $amount)
    {
        $this->account = $amount;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAmountInBaseCurrency() : ?int
    {
        return $this->amountInBaseCurrency;
    }

    /**
     * @param int $amountInBaseCurrency
     * @return Entries
     */
    public function setAmountInBaseCurrency(int $amountInBaseCurrency)
    {
        $this->amountInBaseCurrency = $amountInBaseCurrency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency() : ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Entries
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer() : ?Customer
    {
        return $this->customer;
    }

    /**
     * @param \stdClass $stdClass
     * @return Entries
     */
    public function setCustomer(\stdClass $stdClass)
    {
        $this->customer = new Customer($stdClass->customerNumber, $stdClass->self);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate() : ?string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Entries
     */
    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return DepartmentalDistribution|null
     */
    public function getDepartmentalDistribution() : ?DepartmentalDistribution
    {
        return $this->departmentalDistribution;
    }

    /**
     * @param \stdClass $stdClass
     * @return Entries
     */
    public function setDepartmentalDistribution(\stdClass $stdClass)
    {
        $this->departmentalDistribution = new DepartmentalDistribution($stdClass->departmentalDistributionNumber, null, $stdClass->self);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEntryNumber() : ?int
    {
        return $this->entryNumber;
    }

    /**
     * @param int $entryNumber
     * @return Entries
     */
    public function setEntryNumber(int $entryNumber)
    {
        $this->entryNumber = $entryNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntryType() : ?string
    {
        return $this->entryType;
    }

    /**
     * @param string $entryType
     * @return Entries
     */
    public function setEntryType(string $entryType)
    {
        $this->entryType = $entryType;

        return $this;
    }

    /**
     * @return Project|null
     */
    public function getProject() : ?Project
    {
        return $this->project;
    }

    /**
     * @param \stdClass $stdClass
     * @return Entries
     */
    public function setProject(\stdClass $stdClass)
    {
        $this->project = new Project($stdClass->projectNumber, $stdClass->self);

        return $this;
    }

    /**
     * @return Supplier|null
     */
    public function getSupplier() : ?Supplier
    {
        return $this->supplier;
    }

    /**
     * @param \stdClass $stdClass
     * @return Entries
     */
    public function setSupplier(\stdClass $stdClass)
    {
        $this->supplier = new Supplier($stdClass->supplierNumber, $stdClass->self);

        return $this;
    }

    /**
     * @return VatAccount|null
     */
    public function getVatAccount() : ?VatAccount
    {
        return $this->vatAccount;
    }

    /**
     * @param \stdClass $stdClass
     * @return Entries
     */
    public function setVatAccount(\stdClass $stdClass)
    {
        $this->vatAccount = new VatAccount($stdClass->vatCode, $stdClass->self);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText() : ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Entries
     */
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVoucherNumber() : ?int
    {
        return $this->voucherNumber;
    }

    /**
     * @param int $voucherNumber
     * @return Entries
     */
    public function setVoucherNumber(int $voucherNumber)
    {
        $this->voucherNumber = $voucherNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return Entries
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
