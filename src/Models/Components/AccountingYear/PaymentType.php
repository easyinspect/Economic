<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models\Components\AccountingYear;


class PaymentType
{
    /** @var int $paymentTypeNumber */
    public $paymentTypeNumber;
    /** @var string $self */
    public $self;

   public function __construct(int $paymentTypeNumber = null, string $self = null)
   {
        $this->paymentTypeNumber = $paymentTypeNumber;
        $this->self = $self;
   }
}
