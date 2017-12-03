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
    /** @var string $self */
    public $self;

    public function __construct(int $paymentTermsNumber = null, string $self = null)
    {
        $this->paymentTermsNumber = $paymentTermsNumber;
        $this->self = $self;
    }
}
