<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 19-12-2017
 * Time: 10:21.
 */
use Economic\Models\PaymentTerm;
use Economic\Exceptions\EconomicValidationException;

class PaymentTermValidator
{
    public function validate(PaymentTerm $paymentTerm)
    {
        return ! is_null($paymentTerm->getName())
            && ! is_null($paymentTerm->getPaymentTermsType());
    }

    public function getException(PaymentTerm $paymentTerm)
    {
        $exception = new EconomicValidationException();

        if (is_null($paymentTerm->getName())) {
            $exception->addProperty('name');
        }

        if (is_null($paymentTerm->getPaymentTermsType())) {
            $exception->addProperty('paymentTermsType');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
