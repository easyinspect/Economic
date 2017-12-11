<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06
 */

namespace Economic\Models\Components\Journals;

use Economic\Models\Components\Account;
use Economic\Models\Components\Currency;
use Economic\Models\Interfaces\Entries;
use Economic\Models\Components\ContraAccount;

class FinanceVouchers implements Entries
{
    /** @var array $manualCustomerInvoices */
    public $manualCustomerInvoices;
    /** @var array $customerPayments */
    public $customerPayments;
    /** @var array $supplierPayments */
    public $supplierPayments;
    /** @var array $supplierInvoices */
    public $supplierInvoices;
    /** @var array $financeVouchers */
    public $financeVouchers;

    public function __construct($amount, $accountNumber, $currency, $date, $account = null, $invoiceNumber = null)
    {
        $this->financeVouchers[] = [
            'account' => new Account($account),
            'amount' => $amount,
            'contraAccount' => new ContraAccount($accountNumber),
            'currency' => new Currency($currency),
            'date' => $date
        ];
    }

}