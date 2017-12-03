<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-10-2017
 * Time: 14:51.
 */

namespace Economic\Models\Components\Journals;

class FinanceVouchers implements Entries
{
    /** @var array $manuelCustomerInvoices */
    public $manuelCustomerInvoices = [];
    /** @var array $customerPayments */
    public $customerPayments = [];
    /** @var array $supplierPayments */
    public $supplierPayments = [];
    /** @var array $supplierInvoices */
    public $supplierInvoices = [];
    /** @var array $financeVouchers */
    public $financeVouchers = [];

    public function __construct($amount, $contraAccount, $currency, $date, $account = null, $invoiceNumber = null)
    {
        $this->financeVouchers[] = [
            'account' => new Account($account),
            'amount' => $amount,
            'contraAccount' => new ContraAccount($contraAccount),
            'currency' => new Currency($currency),
            'date' => $date,
        ];
    }
}
