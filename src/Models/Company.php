<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:10.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\Company\User;
use Economic\Models\Components\Company\Details;
use Economic\Models\Components\Company\Settings;
use Economic\Models\Components\Company\Application;
use Economic\Models\Components\Company\AgreementType;
use Economic\Models\Components\Company\BankInformation;

class Company
{
    /** @var int $agreementNumber */
    private $agreementNumber;
    /** @var AgreementType $agreementType */
    private $agreementType;
    /** @var Application $application */
    private $application;
    /** @var BankInformation $bankInformation */
    private $bankInformation;
    /** @var bool $canSendElectronicInvoice */
    private $canSendElectronicInvoice;
    /** @var bool $canSendMobilePay */
    private $canSendMobilePay;
    /** @var Details $company */
    private $company;
    /** @var string $companyAffiliation */
    private $companyAffiliation;
    /** @var array $modules */
    private $modules = [];
    /** @var Settings $settings */
    private $settings;
    /** @var string $signUpDate */
    private $signUpDate;
    /** @var User $user */
    private $user;
    /** @var string $userName */
    private $userName;
    /** @var string $self */
    private $self;

    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function transform($api, $object)
    {
        //var_dump($object);

        $company = new self($api);

        $company->setAgreementNumber($object->agreementNumber);
        $company->setAgreementType($object->agreementType);
        $company->setApplication($object->application);
        //$company->setBankInformation($object->bankInformation);
        $company->setCanSendElectronicInvoice($object->canSendElectronicInvoice);
        $company->setCanSendMobilePay($object->canSendMobilePay);
        //$company->setCompany($object->company);
        $company->setCompanyAffiliation($object->companyAffiliation);
        $company->setModules($object->modules);
        //$company->setSettings($object->settings);
        $company->setSignUpDate($object->signupDate);
        $company->setUser($object->user);
        $company->setUserName($object->userName);
        $company->setSelf($object->self);

        return $company;
    }

    public function get()
    {
        return self::transform($this->api, $this->api->get('/self'));
    }

    public function setAgreementNumber(int $agreementNumber)
    {
        $this->agreementNumber = $agreementNumber;

        return $this;
    }

    public function setAgreementType($agreementType)
    {
        $this->agreementType = new AgreementType($agreementType->agreementTypeNumber, $agreementType->name);

        return $this;
    }

    public function setApplication($application)
    {
        $this->application = new Application($application->appNumber, $application->appPublicToken, $application->created, $application->name, $application->requiredRoles, $application->self);

        return $this;
    }

    public function setBankInformation($bankInformation)
    {
        $this->bankInformation = new BankInformation($bankInformation->bankAccountNumber, $bankInformation->bankGiroNumber, $bankInformation->bankName, $bankInformation->bankSortCode, $bankInformation->pbsCustomerGroupNumber, $bankInformation->pbsFiSupplierNumber);

        return $this;
    }

    public function setCanSendElectronicInvoice(bool $canSendElectronicInvoice)
    {
        $this->canSendElectronicInvoice = $canSendElectronicInvoice;

        return $this;
    }

    public function setCanSendMobilePay(bool $canSendMobilePay)
    {
        $this->canSendMobilePay = $canSendMobilePay;

        return $this;
    }

    public function setCompany($company)
    {
        $this->company = new Details($company->addressLine1, $company->addressLine2, $company->attention, $company->city, $company->companyIdentificationNumber, $company->country, $company->email, $company->name, $company->phoneNumber, $company->vatNumber, $company->website, $company->zip);

        return $this;
    }

    public function setCompanyAffiliation($companyAffiliation)
    {
        $this->companyAffiliation = $companyAffiliation;

        return $this;
    }

    public function setModules(array $modules)
    {
        if (is_array($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = $module;
            }
        }

        return $this;
    }

    public function setSettings($settings)
    {
        $this->settings = new Settings($settings->baseCurrency, $settings->internationalLedger);

        return $this;
    }

    public function setSignUpDate(string $signUpDate)
    {
        $this->signUpDate = $signUpDate;

        return $this;
    }

    public function setUser($user)
    {
        $this->user = new User($user->agreementNumber, $user->email, $user->language, $user->loginId, $user->name);

        return $this;
    }

    public function setUserName(string $userName)
    {
        $this->userName = $userName;

        return $this;
    }

    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
