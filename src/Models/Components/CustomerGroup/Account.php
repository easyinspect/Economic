<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\CustomerGroup;

class Account
{
    /** @var string $accountingYears */
    public $accountingYears;
    /** @var int $accountNumber */
    public $accountNumber;
    /** @var string $accountType */
    public $accountType;
    /** @var int $balance */
    public $balance;
    /** @var bool $blockDirectEntries */
    public $blockDirectEntries;
    /** @var string $debitCredit */
    public $debitCredit;
    /** @var string $name */
    public $name;
    /** @var string $self */
    public $self;

    public function __construct(string $accountingYears = null, int $accountNumber = null, string $accountType = null, int $balance = null, bool $blockDirectEntries = null, string $debitCredit = null, string $name = null, string $self = null)
    {
        $this->accountingYears = $accountingYears;
        $this->accountNumber = $accountNumber;
        $this->accountType = $accountType;
        $this->balance = $balance;
        $this->blockDirectEntries = $blockDirectEntries;
        $this->debitCredit = $debitCredit;
        $this->name = $name;
        $this->self = $self;
    }
}
