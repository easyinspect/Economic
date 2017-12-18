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

class CompanyDetailsValidator
{
    public function validate(Company $company)
    {
        return ! is_null($company->getCompanyAddressLine1())
            && ! is_null($company->getCompanyAttention())
            && ! is_null($company->getCompanyCity())
            && ! is_null($company->getCompanyEmail())
            && ! is_null($company->getCompanyName())
            && ! is_null($company->getCompanyPhoneNumber())
            && ! is_null($company->getCompanyZip());
    }

    public function getException(Company $company)
    {
        $exception = new EconomicValidationException();

        if (is_null($company->getCompanyAddressLine1())) {
            $exception->addProperty('addressLine1');
        }

        if (is_null($company->getCompanyAttention())) {
            $exception->addProperty('attention');
        }

        if (is_null($company->getCompanyCity())) {
            $exception->addProperty('city');
        }

        if (is_null($company->getCompanyEmail())) {
            $exception->addProperty('email');
        }

        if (is_null($company->getCompanyName())) {
            $exception->addProperty('name');
        }

        if (is_null($company->getCompanyPhoneNumber())) {
            $exception->addProperty('phoneNumber');
        }

        if (is_null($company->getCompanyZip())) {
            $exception->addProperty('zip');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
