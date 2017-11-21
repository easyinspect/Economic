<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 17:09.
 */

namespace Economic\Models\Components\Journals;

class CustomerPayments implements Entries
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
        $this->customerPayments[] = [
            'amount' => $amount,
            'contraAccount' => new ContraAccount($contraAccount),
            'currency' => new Currency($currency),
            'date' => $date,
            'customerInvoice' => $invoiceNumber,
        ];
    }
}
