<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 13:26.
 */

namespace Economic\Models\Components;

class PaymentTerms
{
    /** @var int $paymentTermsNumber */
    public $paymentTermsNumber;

    public function __construct(int $paymentTermsNumber)
    {
        $this->paymentTermsNumber = $paymentTermsNumber;
    }
}
