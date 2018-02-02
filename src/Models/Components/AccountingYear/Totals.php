<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models\Components\AccountingYear;

use Economic\Economic;
use Economic\Models\Components\Account;

class Totals
{
    /** @var Account $account */
    public $account;
    /** @var string $fromDate */
    public $fromDate;
    /** @var string $toDate */
    public $toDate;
    /** @var int $totalInBaseCurrency */
    public $totalInBaseCurrency;
    /** @var string $self */
    public $self;

    /** @var Economic $economic */
    public $economic;

    /**
     * Totals constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Totals.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Totals
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $vouchers = new self($economic);

        $vouchers->setSelf($stdClass->self);

        return $vouchers;
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
     * @return Totals
     */
    public function setAccount(\stdClass $stdClass)
    {
        $this->account = new Account($stdClass->accountNumber, $stdClass->self);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFromDate() : ?string
    {
        return $this->fromDate;
    }

    /**
     * @param string $fromDate
     * @return Totals
     */
    public function setFromDate(string $fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToDate() : ?string
    {
        return $this->toDate;
    }

    /**
     * @param string $toDate
     * @return Totals
     */
    public function setToDate(string $toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotalInBaseCurrency() : ?int
    {
        return $this->totalInBaseCurrency;
    }

    /**
     * @param int $totalInBaseCurrency
     * @return Totals
     */
    public function setTotalInBaseCurrency(int $totalInBaseCurrency)
    {
        $this->totalInBaseCurrency = $totalInBaseCurrency;

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
     * @return Totals
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
