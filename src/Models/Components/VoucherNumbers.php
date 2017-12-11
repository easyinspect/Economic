<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class VoucherNumbers
{
    /** @var int $maximumVoucherNumber */
    public $maximumVoucherNumber;
    /** @var int $minimumVoucherNumber */
    public $minimumVoucherNumber;

    public function __construct(int $maximumVoucherNumber = null, int $minimumVoucherNumber = null)
    {
        $this->maximumVoucherNumber = $maximumVoucherNumber;
        $this->minimumVoucherNumber = $minimumVoucherNumber;
    }
}
