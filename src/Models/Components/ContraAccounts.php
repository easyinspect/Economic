<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class ContraAccounts
{
    /** @var CustomerPayments $customerPayments */
    public $customerPayments;
    /** @var FinanceVouchers $financeVouchers */
    public $financeVouchers;
    /** @var SupplierPayments $supplierPayments */
    public $supplierPayments;

    public function __construct($customerPayments = null, $financeVouchers = null, $supplierPayments = null)
    {
        $this->customerPayments = new CustomerPayments($customerPayments->accountNumber ?? null, $customerPayments->self ?? null);
        $this->financeVouchers = new FinanceVouchers($financeVouchers->accountNumber ?? null, $financeVouchers->self ?? null);
        $this->supplierPayments = new SupplierPayments($supplierPayments->accountNumber ?? null, $financeVouchers->self ?? null);
    }
}
