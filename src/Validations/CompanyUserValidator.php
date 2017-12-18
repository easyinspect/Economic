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

class CompanyUserValidator
{
    public function validate(Company $company)
    {
        return ! is_null($company->getUserAgreementNumber())
            && ! is_null($company->getUserEmail())
            && ! is_null($company->getUserLanguage())
            && ! is_null($company->getUserLoginId())
            && ! is_null($company->getUserUserName());
    }

    public function getException(Company $company)
    {
        $exception = new EconomicValidationException();

        if (is_null($company->getUserAgreementNumber())) {
            $exception->addProperty('agreementNumber');
        }

        if (is_null($company->getUserEmail())) {
            $exception->addProperty('email');
        }

        if (is_null($company->getUserLanguageCulture())) {
            $exception->addProperty('language.culture');
        }

        if (is_null($company->getUserLanguageLanguageNumber())) {
            $exception->addProperty('language.languageNumber');
        }

        if (is_null($company->getUserLanguageName())) {
            $exception->addProperty('language.name');
        }

        if (is_null($company->getUserLoginId())) {
            $exception->addProperty('loginId');
        }

        if (is_null($company->getUserUserName())) {
            $exception->addProperty('name');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
