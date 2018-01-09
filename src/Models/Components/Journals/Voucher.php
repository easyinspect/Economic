<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\Journals;

use Economic\Economic;
use Economic\Models\Components\Journal;
use Economic\Models\Interfaces\Entries;
use Economic\Models\Components\AccountingYear;

class Voucher
{
    /** @var AccountingYear $accountingYear */
    private $accountingYear;
    /** @var Entries $entries */
    private $entries;
    /** @var Journal $journal */
    private $journal;
    /** @var int $voucherNumber */
    private $voucherNumber;
    /** @var string $attachment */
    private $attachment;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * Voucher constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Voucher.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Voucher
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $voucher = new self($economic);

        $voucher->setAccountingYear($stdClass->accountingYear);
        $voucher->setEntries($stdClass->entries);
        $voucher->setJournal($stdClass->journal);
        $voucher->setVoucherNumber($stdClass->voucherNumber);
        $voucher->setAttachment($stdClass->attachment);
        $voucher->setSelf($stdClass->self);

        return $voucher;
    }

    // Getters & Setters

    /**
     * @param \stdClass $accountingYear
     * @return Voucher
     */
    public function setAccountingYear($accountingYear)
    {
        $this->accountingYear = new AccountingYear($accountingYear->year, $accountingYear->self);

        return $this;
    }

    /**
     * @return AccountingYear
     */
    public function getAccountingYear() : ?AccountingYear
    {
        return $this->accountingYear;
    }

    /**
     * @param \stdClass $entries
     * @return Voucher
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @return Entries
     */
    public function getEntries() : ?Entries
    {
        return $this->entries;
    }

    /**
     * @param \stdClass $journal
     * @return Voucher
     */
    public function setJournal($journal)
    {
        $this->journal = new Journal($journal->journalNumber, $journal->self);

        return $this;
    }

    /**
     * @return Journal
     */
    public function getJournal() : ?Journal
    {
        return $this->journal;
    }

    /**
     * @param int $voucherNumber
     * @return Voucher
     */
    public function setVoucherNumber(int $voucherNumber)
    {
        $this->voucherNumber = $voucherNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getVoucherNumber() : ?int
    {
        return $this->voucherNumber;
    }

    /**
     * @param string $attachment
     * @return Voucher
     */
    public function setAttachment(string $attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttachment() : ?string
    {
        return $this->attachment;
    }

    /**
     * @param string $self
     * @return Voucher
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }
}
