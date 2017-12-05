<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-12-2017
 * Time: 12:48.
 */

namespace Economic\Validations;

use Economic\Models\Customer;
use Economic\Exceptions\EconomicValidationException;

class CustomerValidator
{
    public function validate(Customer $customer)
    {
        return ! is_null($customer->getCurrency())
            && ! is_null($customer->getCustomerGroup())
            && ! is_null($customer->getName())
            && ! is_null($customer->getPaymentTerms())
            && ! is_null($customer->getVatZone());
    }

    public function getException(Customer $customer)
    {
        $exception = new EconomicValidationException();

        if (is_null($customer->getCurrency())) {
            $exception->addProperty('currency');
        }

        if (is_null($customer->getCustomerGroup())) {
            $exception->addProperty('customerGroup');
        }

        if (is_null($customer->getName())) {
            $exception->addProperty('name');
        }

        if (is_null($customer->getPaymentTerms())) {
            $exception->addProperty('paymentTerms');
        }

        if (is_null($customer->getVatZone())) {
            $exception->addProperty('vatZone');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
