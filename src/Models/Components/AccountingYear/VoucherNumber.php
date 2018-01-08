<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\AccountingYear;

class VoucherNumber
{
    /** @var string $displayVoucherNumber */
    public $displayVoucherNumber;
    /** @var string $prefix */
    public $prefix;
    /** @var int $voucherNumber */
    public $voucherNumber;

    public function __construct(string $displayVoucherNumber = null, string $prefix = null, int $voucherNumber = null)
    {
        $this->displayVoucherNumber = $displayVoucherNumber;
        $this->prefix = $prefix;
        $this->voucherNumber = $voucherNumber;
    }
}
