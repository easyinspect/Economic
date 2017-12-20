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

    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

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

    public function setAccountingYear($accountingYear)
    {
        $this->accountingYear = new AccountingYear($accountingYear->year, $accountingYear->self);

        return $this;
    }

    public function setEntries($entries)
    {
        $this->entries = $entries;

        return $this;
    }

    public function setJournal($journal)
    {
        $this->journal = new Journal($journal->journalNumber, $journal->self);

        return $this;
    }

    public function setVoucherNumber(int $voucherNumber)
    {
        $this->voucherNumber = $voucherNumber;

        return $this;
    }

    public function setAttachment(string $attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
