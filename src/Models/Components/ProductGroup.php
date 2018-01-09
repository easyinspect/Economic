<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 22-09-2017
 * Time: 12:41.
 */

namespace Economic\Models\Components;

use Economic\Models\Components\ProductGroup\Accrual;

class ProductGroup
{
    /** @var int $productGroupNumber */
    public $productGroupNumber;
    /** @var string $name */
    public $name;
    /** @var string $products */
    public $products;
    /** @var string $salesAccounts */
    public $salesAccounts;
    /** @var bool $inventoryEnabled */
    public $inventoryEnabled;
    /** @var Accrual $accrual */
    public $accrual;
    /** @var string $self */
    public $self;

    public function __construct(int $productGroupNumber = null, string $name = null, string $products = null, string $salesAccounts = null, string $self = null, bool $inventoryEnabled = null, \stdClass $accrual = null)
    {
        $this->productGroupNumber = $productGroupNumber;
        $this->name = $name;
        $this->products = $products;
        $this->salesAccounts = $salesAccounts;
        $this->inventoryEnabled = $inventoryEnabled;
        $this->accrual = new Accrual(
            $accrual->accountingYears ?? null,
            $accrual->accountNumber ?? null,
            $accrual->accountsSummed ?? null,
            $accrual->accountType ?? null,
            $accrual->balance ?? null,
            $accrual->barred ?? null,
            $accrual->blockDirectEntries ?? null,
            $accrual->contraAccount ?? null,
            $accrual->debitCredit ?? null,
            $accrual->draftBalance ?? null,
            $accrual->name ?? null,
            $accrual->totalFromAccount ?? null,
            $accrual->vatAccount ?? null
        );
        $this->self = $self;
    }
}
