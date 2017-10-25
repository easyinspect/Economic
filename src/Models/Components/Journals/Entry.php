<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 23-10-2017
 * Time: 10:34
 */

namespace Economic\Models\Components\Journals;


use Economic\Models\Components\AccountingYear;

class Entry
{
    /** @var string $accountingYear */
    public $accountingYear;
    /** @var Entries $entries */
    public $entries;
    /** @var int $voucherNumber */
    public $voucherNumber;

    public function __construct(string $year, int $voucherNumber, Entries $entries)
    {
        $this->accountingYear = new AccountingYear($year);
        $this->entries = $entries;
        $this->voucherNumber = $voucherNumber;
    }
}