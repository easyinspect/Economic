<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-12-2017
 * Time: 12:48.
 */

namespace Economic\Validations;

use Economic\Models\BillingContact;
use Economic\Exceptions\EconomicValidationException;

class BillingContactValidator
{
    public function validate(BillingContact $billingContact)
    {
        return ! is_null($billingContact->getName())
            && ! is_null($billingContact->getCustomer());
    }

    public function getException(BillingContact $billingContact)
    {
        $exception = new EconomicValidationException();

        if (is_null($billingContact->getName())) {
            $exception->addProperty('name');
        }

        if (is_null($billingContact->getCustomer())) {
            $exception->addProperty('customer');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
