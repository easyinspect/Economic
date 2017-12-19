<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-12-2017
 * Time: 12:48.
 */

namespace Economic\Validations;

use Economic\Exceptions\EconomicValidationException;
use Economic\Models\Company;

class CompanyBankInformationValidator
{
    public function validate(Company $company)
    {
        return ! is_null($company->getBankInformationPbsCustomerGroupNumber());
    }

    public function getException(Company $company)
    {
        $exception = new EconomicValidationException();

        if (is_null($company->getBankInformationPbsCustomerGroupNumber())) {
            $exception->addProperty('pbsCustomerGroupNumber');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
