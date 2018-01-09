<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\AccountingYear;

class RemittanceInformation
{
    /** @var int $creditorId */
    public $creditorId;
    /** @var int $creditorInvoiceId */
    public $creditorInvoiceId;
    /** @var PaymentType $paymentType */
    public $paymentType;
    /** @var string $self */
    public $self;

    public function __construct(int $creditorId = null, int $creditorInvoiceId = null, \stdClass $stdClass = null, string $self = null)
    {
        $this->creditorId = $creditorId;
        $this->creditorInvoiceId = $creditorInvoiceId;
        $this->paymentType = new PaymentType($stdClass->paymentTypeNumber, $stdClass->self);
        $this->self = $self;
    }
}
