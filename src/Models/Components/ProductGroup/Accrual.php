<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:44.
 */

namespace Economic\Models\Components\ProductGroup;

use Economic\Economic;
use Economic\Models\Components\ContraAccount;

class Accrual
{
    /** @var string $accountingYears */
    public $accountingYears;
    /** @var int $accountNumber */
    public $accountNumber;
    /** @var array $accountsSummed */
    public $accountsSummed = [];
    /** @var string $accountType */
    public $accountType;
    /** @var int $balance */
    public $balance;
    /** @var bool $barred */
    public $barred;
    /** @var bool $blockDirectEntries */
    public $blockDirectEntries;
    /** @var ContraAccount $contraAccount */
    public $contraAccount;
    /** @var string $debitCredit */
    public $debitCredit;
    /** @var int $draftBalance */
    public $draftBalance;
    /** @var string $name */
    public $name;
    /** @var TotalFromAccount $totalFromAccount */
    public $totalFromAccount;
    /** @var VatAccount $vatAccount */
    public $vatAccount;

    public function __construct(string $accountingYears = null, int $accountNumber = null, array $accountsSummed = null, string $accountType = null, int $balance = null, bool $barred = null, bool $blockDirectEntries = null, \stdClass $contraAccount = null, string $debitCredit = null, int $draftBalance = null, string $name = null, \stdClass $totalFromAccount = null, \stdClass $vatAccount = null)
    {
        $this->accountingYears = $accountingYears;
        $this->accountNumber = $accountNumber;
        $this->accountsSummed[] = $accountsSummed;
        $this->accountType = $accountType;
        $this->balance = $balance;
        $this->barred = $barred;
        $this->blockDirectEntries = $blockDirectEntries;
        $this->contraAccount = new ContraAccount($contraAccount->accountNumber ?? null, $contraAccount->self ?? null);
        $this->debitCredit = $debitCredit;
        $this->draftBalance = $draftBalance;
        $this->name = $name;
        $this->totalFromAccount = new TotalFromAccount($totalFromAccount->accountNumber ?? null, $totalFromAccount->self ?? null);
        $this->vatAccount = new VatAccount($vatAccount->vatCode ?? null, $vatAccount->self ?? null);
    }

    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        return $economic->productGroups()->setAccrual($stdClass->salesAccount)->getAccrual();
    }
}
