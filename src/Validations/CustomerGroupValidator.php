<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-12-2017
 * Time: 12:48.
 */

namespace Economic\Validations;

use Economic\Models\CustomerGroup;
use Economic\Exceptions\EconomicValidationException;

class CustomerGroupValidator
{
    public function validate(CustomerGroup $customerGroup)
    {
        return ! is_null($customerGroup->getAccountNumber())
            && ! is_null($customerGroup->getCustomerGroupNumber());
    }

    public function getException(CustomerGroup $customerGroup)
    {
        $exception = new EconomicValidationException();

        if (is_null($customerGroup->getAccountNumber())) {
            $exception->addProperty('account.accountNumber');
        }

        if (is_null($customerGroup->getCustomerGroupNumber())) {
            $exception->addProperty('customerGroupNumber');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
