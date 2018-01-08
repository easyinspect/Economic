<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models\Components\AccountingYear;

use Economic\Economic;
use Economic\Models\Components\AccountingYear;

class Periods
{
    /** @var AccountingYear $accountingYear */
    public $accountingYear;
    /** @var bool $closed */
    public $closed;
    /** @var string $entries */
    public $entries;
    /** @var string $fromDate */
    public $fromDate;
    /** @var string $toDate */
    public $toDate;
    /** @var string $totals */
    public $totals;
    /** @var int $periodNumber */
    public $periodNumber;
    /** @var string $self */
    public $self;

    /** @var Economic $economic */
    public $economic;

    /**
     * Periods constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Periods.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Periods
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $periods = new self($economic);

        $periods->setAccountingYear($stdClass->accountingYear);
        $periods->setClosed($stdClass->closed ?? null);
        $periods->setEntries($stdClass->entries);
        $periods->setFromDate($stdClass->fromDate);
        $periods->setToDate($stdClass->toDate);
        $periods->setTotals($stdClass->totals);
        $periods->setPeriodNumber($stdClass->periodNumber);
        $periods->setSelf($stdClass->self);

        return $periods;
    }

    // Getters & Setters

    /**
     * @return AccountingYear|null
     */
    public function getAccountingYear() : ?AccountingYear
    {
        return $this->accountingYear;
    }

    /**
     * @param \stdClass $stdClass
     * @return Periods
     */
    public function setAccountingYear(\stdClass $stdClass)
    {
        $this->accountingYear = new AccountingYear($stdClass->year, $stdClass->self);

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getClosed() : ?bool
    {
        return $this->closed;
    }

    /**
     * @param bool $closed
     * @return Periods
     */
    public function setClosed(bool $closed = null)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntries() : ?string
    {
        return $this->entries;
    }

    /**
     * @param string $entries
     * @return Periods
     */
    public function setEntries(string $entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPeriodNumber() : ?int
    {
        return $this->periodNumber;
    }

    /**
     * @param int $periodNumber
     * @return Periods
     */
    public function setPeriodNumber(int $periodNumber)
    {
        $this->periodNumber = $periodNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotals() : ?string
    {
        return $this->totals;
    }

    /**
     * @param string $totals
     * @return Periods
     */
    public function setTotals(string $totals)
    {
        $this->totals = $totals;

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
     * @return Periods
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
     * @return Periods
     */
    public function setToDate(string $toDate)
    {
        $this->toDate = $toDate;

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
     * @return Periods
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
