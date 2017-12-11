<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class Templates
{
    /** @var string $financeVoucher */
    public $financeVoucher;
    /** @var string $manuelCustomerInvoice */
    public $manualCustomerInvoice;
    /** @var string $self */
    public $self;

    public function __construct(string $financeVoucher = null, string $manualCustomerInvoice = null, string $self = null)
    {
        $this->financeVoucher = $financeVoucher;
        $this->manualCustomerInvoice = $manualCustomerInvoice;
        $this->self = $self;
    }
}
