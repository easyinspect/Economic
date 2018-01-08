<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\AccountingYear\Totals;
use Economic\Models\Components\AccountingYear\Periods;
use Economic\Models\Components\AccountingYear\Vouchers;

class AccountingYears
{
    /** @var bool $closed */
    private $closed;
    /** @var string $entries */
    private $entries;
    /** @var string $fromDate */
    private $fromDate;
    /** @var string $toDate */
    private $toDate;
    /** @var string $periods */
    private $periods;
    /** @var string $totals */
    private $totals;
    /** @var string $vouchers */
    private $vouchers;
    /** @var string $year */
    private $year;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * AccountingYears constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Accounting Year.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return AccountingYears
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $accountingYear = new self($economic);

        $accountingYear->setClosed($stdClass->closed ?? null);
        $accountingYear->setEntries($stdClass->entries);
        $accountingYear->setFromDate($stdClass->fromDate);
        $accountingYear->setPeriods($stdClass->periods);
        $accountingYear->setToDate($stdClass->toDate);
        $accountingYear->setTotals($stdClass->totals);
        $accountingYear->setVouchers($stdClass->vouchers);
        $accountingYear->setYear($stdClass->year);

        return $accountingYear;
    }

    /**
     * Retrieves a collection of Accounting Years.
     * @param Filter $filter
     * @return AccountingYears
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/accounting-years?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/accounting-years?', $this);
        }
    }

    /**
     * Retrieves a single AccountingYear by its year.
     * @param string $year
     * @return AccountingYears
     */
    public function get(string $year)
    {
        return self::transform($this->economic, $this->economic->get('/accounting-years/'.$year));
    }

    /**
     * Retrieves a collection of Entries that belongs to the given Accounting Year.
     * @return \Economic\Models\Entries
     */
    public function entries()
    {
        return $this->economic->collection('/accounting-years/'.$this->getYear().'/entries?', new Entries($this->economic));
    }

    /**
     * Retrieves a collection of Totals that belongs to the given Accounting Year.
     * @return Totals
     */
    /*public function totals()
    {
        return $this->economic->collection('/accounting-years/'.$this->getYear().'/totals?', new Totals($this->economic));
    }*/

    /**
     * Retrieves a collection of Periods that belongs to the given Accounting Year.
     * @return Periods
     */
    public function periods()
    {
        return $this->economic->collection('/accounting-years/'.$this->getYear().'/periods?', new Periods($this->economic));
    }

    /**
     * Retrieves a collection of Vouchers that belongs to the given Accounting Year.
     * @return Vouchers
     */
    public function vouchers()
    {
        return $this->economic->collection('/accounting-years/'.$this->getYear().'/vouchers?', new Vouchers($this->economic));
    }

    // Getters & Setters

    /**
     * @return bool
     */
    public function getClosed() : ?bool
    {
        return $this->closed;
    }

    /**
     * @param bool $closed
     * @return AccountingYears
     */
    public function setClosed(bool $closed = null)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * @return string
     */
    public function getEntries() : ?string
    {
        return $this->entries;
    }

    /**
     * @param string $entries
     * @return AccountingYears
     */
    public function setEntries(string $entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromDate() : ?string
    {
        return $this->fromDate;
    }

    /**
     * @param string $fromDate
     * @return AccountingYears
     */
    public function setFromDate(string $fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getPeriods() : ?string
    {
        return $this->periods;
    }

    /**
     * @param string $periods
     * @return AccountingYears
     */
    public function setPeriods(string $periods)
    {
        $this->periods = $periods;

        return $this;
    }

    /**
     * @return string
     */
    public function getToDate() : ?string
    {
        return $this->toDate;
    }

    /**
     * @param string $toDate
     * @return AccountingYears
     */
    public function setToDate(string $toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getTotals() : ?string
    {
        return $this->totals;
    }

    /**
     * @param string $totals
     * @return AccountingYears
     */
    public function setTotals(string $totals)
    {
        $this->totals = $totals;

        return $this;
    }

    /**
     * @return string
     */
    public function getVouchers() : ?string
    {
        return $this->vouchers;
    }

    /**
     * @param string $vouchers
     * @return AccountingYears
     */
    public function setVouchers(string $vouchers)
    {
        $this->vouchers = $vouchers;

        return $this;
    }

    /**
     * @return string
     */
    public function getYear() : ?string
    {
        return $this->year;
    }

    /**
     * @param string $year
     * @return AccountingYears
     */
    public function setYear(string $year)
    {
        $this->year = $year;

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
