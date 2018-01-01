<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class Settings
{
    /** @var ContraAccounts $contraAccounts */
    public $contraAccounts;
    /** @var string $entryTypeRestrictedTo */
    public $entryTypeRestrictedTo;
    /** @var VoucherNumbers $voucherNumbers */
    public $voucherNumbers;

    public function __construct($contraAccounts = null, string $entryTypeRestrictedTo = null, $voucherNumbers = null)
    {
        $this->contraAccounts = new ContraAccounts($contraAccounts->customerPayments ?? null, $contraAccounts->financeVouchers ?? null, $contraAccounts->supplierPayments ?? null);
        $this->entryTypeRestrictedTo = $entryTypeRestrictedTo;
        $this->voucherNumbers = new VoucherNumbers($voucherNumbers->maximumVoucherNumber ?? null, $voucherNumbers->minimumVoucherNumber ?? null);
    }
}
