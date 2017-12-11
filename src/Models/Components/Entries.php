<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class Entries
{
    /** @var string $accountingYear */
    public $accountingYear;
    /** @var \Economic\Models\Interfaces\Entries $entries */
    public $entries;

    public function __construct(string $accountingYear = null, $entries)
    {
        $this->accountingYear = new AccountingYear($accountingYear);
        $this->entries = $entries;
    }
}
