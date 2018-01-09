<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-12-2017
 * Time: 12:48.
 */

namespace Economic\Validations;

use Economic\Models\Product;
use Economic\Exceptions\EconomicValidationException;

class ProductValidator
{
    public function validate(Product $billingContact)
    {
        return ! is_null($billingContact->getName())
            && ! is_null($billingContact->getProductGroupNumber())
            && ! is_null($billingContact->getProductNumber());
    }

    public function getException(Product $billingContact)
    {
        $exception = new EconomicValidationException();

        if (is_null($billingContact->getName())) {
            $exception->addProperty('name');
        }

        if (is_null($billingContact->getProductGroupNumber())) {
            $exception->addProperty('productGroup.productGroupNumber');
        }

        if (is_null($billingContact->getProductNumber())) {
            $exception->addProperty('productNumber');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
