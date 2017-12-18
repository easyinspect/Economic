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
use Economic\Validations\CompanyUserValidator;
use Economic\Models\Components\Company\Details;
use Economic\Models\Components\Company\Language;
use Economic\Models\Components\Company\Settings;
use Economic\Validations\CompanyDetailsValidator;
use Economic\Models\Components\Company\Application;
use Economic\Models\Components\Company\AgreementType;
use Economic\Models\Components\Company\BankInformation;
use Economic\Validations\CompanyBankInformationValidator;

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

    /**
     * @param Economic $api
     */
    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    /**
     * @param \stdClass $object
     * @return User
     */
    public static function user($object)
    {
        return new User($object->agreementNumber, $object->email, $object->language, $object->loginId, $object->name);
    }

    /**
     * @param \stdClass $object
     * @return Details
     */
    public static function company($object)
    {
        return new Details(
            $object->addressLine1,
            $object->addressLine2 ?? null,
            $object->attention,
            $object->city,
            $object->companyIdentificationNumber ?? null,
            $object->country ?? null,
            $object->email,
            $object->name,
            $object->phoneNumber,
            $object->vatNumber ?? null,
            $object->website ?? null,
            $object->zip);
    }

    /**
     * @param \stdClass $object
     * @return BankInformation
     */
    public static function bankInformation($object)
    {
        return new BankInformation(
            $object->bankAccountNumber ?? null,
            $object->bankGiroNumber ?? null,
            $object->bankSortCode ?? null,
            $object->pbsCustomerGroupNumber,
            $object->pbsFiSupplierNumber ?? null
        );
    }

    /**
     * @param Economic $api
     * @param \stdClass $object
     * @return Company
     */
    public static function transform($api, $object)
    {
        $company = new self($api);

        $company->setAgreementNumber($object->agreementNumber);
        $company->setAgreementType($object->agreementType);
        $company->setApplication($object->application);
        $company->setBankInformation($object->bankInformation);
        $company->setCanSendElectronicInvoice($object->canSendElectronicInvoice);
        $company->setCanSendMobilePay($object->canSendMobilePay);
        $company->setCompany($object->company);
        $company->setCompanyAffiliation($object->companyAffiliation);
        $company->setModules($object->modules);
        $company->setSettings($object->settings);
        $company->setSignUpDate($object->signupDate);
        $company->setUser($object->user);
        $company->setUserName($object->userName);
        $company->setSelf($object->self);

        return $company;
    }

    /**
     * @return Company
     */
    public function get()
    {
        return self::transform($this->api, $this->api->get('/self'));
    }

    public function updateUser()
    {
        $data = (object) [
            'agreementNumber' => $this->getUserAgreementNumber(),
            'email' => $this->getUserEmail(),
            'language' => $this->getUserLanguage(),
            'loginId' => $this->getUserLoginId(),
            'name' => $this->getUserUserName(),
        ];

        $this->api->cleanObject($data);

        $validator = CompanyUserValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::user($this->api->update('/self/user', $data));
    }

    public function updateBankInformation()
    {
        $data = (object) [
            'bankAccountNumber' => $this->getBankInformationBankAccountNumber(),
            'bankGiroNumber' => $this->getBankInformationBankGiroNumber(),
            'bankName' => $this->getBankInformationBankName(),
            'bankSortCode' => $this->getBankInformationBankSortCode(),
            'pbsCustomerGroupNumber' => $this->getBankInformationPbsCustomerGroupNumber(),
            'pbsFiSupplierNumber' => $this->getBankInformationPbsFiSupplierNumber(),
        ];

        $this->api->cleanObject($data);

        $validator = CompanyBankInformationValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::bankInformation($this->api->update('/self/company/bankinformation', $data));
    }

    public function update()
    {
        $data = (object) [
            'addressLine1' => $this->getCompanyAddressLine1(),
            'addressLine2' => $this->getCompanyAddressLine2(),
            'attention' => $this->getCompanyAttention(),
            'city' => $this->getCompanyCity(),
            'companyIdentificationNumber' => $this->getCompanyIdentificationNumber(),
            'country' => $this->getCompanyCountry(),
            'email' => $this->getCompanyEmail(),
            'name' => $this->getCompanyName(),
            'phoneNumber' => $this->getCompanyPhoneNumber(),
            'vatNumber' => $this->getCompanyVatNumber(),
            'website' => $this->getCompanyWebsite(),
            'zip' => $this->getCompanyZip(),
        ];

        $this->api->cleanObject($data);

        $validator = CompanyDetailsValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::company($this->api->update('/self/company', $data));
    }

    /**
     * @return int
     */
    public function getAgreementNumber() : ?int
    {
        return $this->agreementNumber;
    }

    /**
     * @param int $agreementNumber
     * @return $this
     */
    public function setAgreementNumber(int $agreementNumber)
    {
        $this->agreementNumber = $agreementNumber;

        return $this;
    }

    /**
     * @return AgreementType
     */
    public function getAgreementType() : ?AgreementType
    {
        return $this->agreementType;
    }

    /**
     * @param AgreementType $agreementType
     * @return $this
     */
    public function setAgreementType($agreementType)
    {
        $this->agreementType = new AgreementType($agreementType->agreementTypeNumber, $agreementType->name);

        return $this;
    }

    /**
     * @return Application
     */
    public function getApplication() : ?Application
    {
        return $this->application;
    }

    /**
     * @param Application $application
     * @return $this
     */
    public function setApplication($application)
    {
        if (is_array($application->requiredRoles)) {
            foreach ($application->requiredRoles as $role) {
                $requiredRole = $role;
            }
        }

        $this->application = new Application($application->appNumber, $application->appPublicToken, $application->created, $application->name, $requiredRole ?? $application->requiredRoles, $application->self);

        return $this;
    }

    /**
     * @return BankInformation
     */
    public function getBankInformation() : ?BankInformation
    {
        return $this->bankInformation;
    }

    /**
     * @param BankInformation $bankInformation
     * @return $this
     */
    public function setBankInformation($bankInformation = null)
    {
        if (isset($bankInformation)) {
            $this->bankInformation = new BankInformation($bankInformation->bankAccountNumber ?? null, $bankInformation->bankGiroNumber ?? null, $bankInformation->bankName ?? null, $bankInformation->bankSortCode ?? null, $bankInformation->pbsCustomerGroupNumber, $bankInformation->pbsFiSupplierNumber ?? null);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBankInformationBankAccountNumber() : ?string
    {
        if (isset($this->bankInformation->bankAccountNumber)) {
            return $this->bankInformation->bankAccountNumber;
        }

        return null;
    }

    /**
     * @param string $bankAccountNumber
     * @return Company
     */
    public function setBankInformationBankAccountNumber(string $bankAccountNumber)
    {
        if (isset($this->bankInformation)) {
            $this->bankInformation->bankAccountNumber = $bankAccountNumber;
        } else {
            $this->bankInformation = $this->api->setClass('Company\BankInformation', 'bankAccountNumber', $this);
            $this->bankInformation->bankAccountNumber = $bankAccountNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBankInformationBankGiroNumber() : ?string
    {
        if (isset($this->bankInformation->bankGiroNumber)) {
            return $this->bankInformation->bankGiroNumber;
        }

        return null;
    }

    /**
     * @param string $bankGiroNumber
     * @return Company
     */
    public function setBankInformationBankGiroNumber(string $bankGiroNumber)
    {
        if (isset($this->bankInformation)) {
            $this->bankInformation->bankGiroNumber = $bankGiroNumber;
        } else {
            $this->bankInformation = $this->api->setClass('Company\BankInformation', 'bankGiroNumber', $this);
            $this->bankInformation->bankGiroNumber = $bankGiroNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBankInformationBankName() : ?string
    {
        if (isset($this->bankInformation->bankName)) {
            return $this->bankInformation->bankName;
        }

        return null;
    }

    /**
     * @param string $bankName
     * @return Company
     */
    public function setBankInformationBankName(string $bankName)
    {
        if (isset($this->bankInformation)) {
            $this->bankInformation->bankName = $bankName;
        } else {
            $this->bankInformation = $this->api->setClass('Company\BankInformation', 'bankName', $this);
            $this->bankInformation->bankName = $bankName;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBankInformationBankSortCode() : ?string
    {
        if (isset($this->bankInformation->bankSortCode)) {
            return $this->bankInformation->bankSortCode;
        }

        return null;
    }

    /**
     * @param string $bankSortCode
     * @return Company
     */
    public function setBankInformationBankSortCode(string $bankSortCode)
    {
        if (isset($this->bankInformation)) {
            $this->bankInformation->bankSortCode = $bankSortCode;
        } else {
            $this->bankInformation = $this->api->setClass('Company\BankInformation', 'bankSortCode', $this);
            $this->bankInformation->bankSortCode = $bankSortCode;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBankInformationPbsCustomerGroupNumber() : ?string
    {
        if (isset($this->bankInformation->pbsCustomerGroupNumber)) {
            return $this->bankInformation->pbsCustomerGroupNumber;
        }

        return null;
    }

    /**
     * @param string $pbsCustomerGroupNumber
     * @return Company
     */
    public function setBankInformationPbsCustomerGroupNumber(string $pbsCustomerGroupNumber)
    {
        if (isset($this->bankInformation)) {
            $this->bankInformation->pbsCustomerGroupNumber = $pbsCustomerGroupNumber;
        } else {
            $this->bankInformation = $this->api->setClass('Company\BankInformation', 'pbsCustomerGroupNumber', $this);
            $this->bankInformation->pbsCustomerGroupNumber = $pbsCustomerGroupNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBankInformationPbsFiSupplierNumber() : ?string
    {
        if (isset($this->bankInformation->pbsFiSupplierNumber)) {
            return $this->bankInformation->pbsFiSupplierNumber;
        }

        return null;
    }

    /**
     * @param string $pbsFiSupplierNumber
     * @return Company
     */
    public function setBankInformationPbsFiSupplierNumber(string $pbsFiSupplierNumber)
    {
        if (isset($this->bankInformation)) {
            $this->bankInformation->pbsFiSupplierNumber = $pbsFiSupplierNumber;
        } else {
            $this->bankInformation = $this->api->setClass('Company\BankInformation', 'pbsFiSupplierNumber', $this);
            $this->bankInformation->pbsFiSupplierNumber = $pbsFiSupplierNumber;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function getCanSendElectronicInvoice() : ?bool
    {
        return $this->canSendElectronicInvoice;
    }

    /**
     * @param bool $canSendElectronicInvoice
     * @return $this
     */
    public function setCanSendElectronicInvoice(bool $canSendElectronicInvoice)
    {
        $this->canSendElectronicInvoice = $canSendElectronicInvoice;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCanSendMobilePay() : ?bool
    {
        return $this->canSendMobilePay;
    }

    /**
     * @param bool $canSendMobilePay
     * @return $this
     */
    public function setCanSendMobilePay(bool $canSendMobilePay)
    {
        $this->canSendMobilePay = $canSendMobilePay;

        return $this;
    }

    /**
     * @return Details
     */
    public function getCompany() : ?Details
    {
        return $this->company;
    }

    /**
     * @param Details $company
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = new Details($company->addressLine1, $company->addressLine2 ?? null, $company->attention, $company->city, $company->companyIdentificationNumber ?? null, $company->country ?? null, $company->email, $company->name, $company->phoneNumber, $company->vatNumber ?? null, $company->website ?? null, $company->zip);

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyAddressLine1() : ?string
    {
        if (isset($this->company->addressLine1)) {
            return $this->company->addressLine1;
        }

        return null;
    }

    /**
     * @param string $addressLine1
     * @return Company
     */
    public function setCompanyAddressLine1(string $addressLine1)
    {
        if (isset($this->company)) {
            $this->company->addressLine1 = $addressLine1;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'addressLine1', $this);
            $this->company->addressLine1 = $addressLine1;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyAddressLine2() : ?string
    {
        if (isset($this->company->addressLine2)) {
            return $this->company->addressLine2;
        }

        return null;
    }

    /**
     * @param string $addressLine2
     * @return Company
     */
    public function setCompanyAddressLine2(string $addressLine2)
    {
        if (isset($this->company)) {
            $this->company->addressLine2 = $addressLine2;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'addressLine2', $this);
            $this->company->addressLine2 = $addressLine2;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyAttention() : ?string
    {
        if (isset($this->company->attention)) {
            return $this->company->attention;
        }

        return null;
    }

    /**
     * @param string $attention
     * @return Company
     */
    public function setCompanyAttention(string $attention)
    {
        if (isset($this->company)) {
            $this->company->attention = $attention;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'attention', $this);
            $this->company->attention = $attention;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyCity() : ?string
    {
        if (isset($this->company->city)) {
            return $this->company->city;
        }

        return null;
    }

    /**
     * @param string $city
     * @return Company
     */
    public function setCompanyCity(string $city)
    {
        if (isset($this->company)) {
            $this->company->city = $city;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'city', $this);
            $this->company->city = $city;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyIdentificationNumber() : ?string
    {
        if (isset($this->company->companyIdentificationNumber)) {
            return $this->company->companyIdentificationNumber;
        }

        return null;
    }

    /**
     * @param string $companyIdentificationNumber
     * @return Company
     */
    public function setCompanyIdentificationNumber(string $companyIdentificationNumber)
    {
        if (isset($this->company)) {
            $this->company->companyIdentificationNumber = $companyIdentificationNumber;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'companyIdentificationNumber', $this);
            $this->company->companyIdentificationNumber = $companyIdentificationNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyCountry() : ?string
    {
        if (isset($this->company->country)) {
            return $this->company->country;
        }

        return null;
    }

    /**
     * @param string $country
     * @return Company
     */
    public function setCompanyCountry(string $country)
    {
        if (isset($this->company)) {
            $this->company->country = $country;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'country', $this);
            $this->company->country = $country;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyEmail() : ?string
    {
        if (isset($this->company->email)) {
            return $this->company->email;
        }

        return null;
    }

    /**
     * @param string $email
     * @return Company
     */
    public function setCompanyEmail(string $email)
    {
        if (isset($this->company)) {
            $this->company->email = $email;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'email', $this);
            $this->company->email = $email;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName() : ?string
    {
        if (isset($this->company->name)) {
            return $this->company->name;
        }

        return null;
    }

    /**
     * @param string $name
     * @return Company
     */
    public function setCompanyName(string $name)
    {
        if (isset($this->company)) {
            $this->company->name = $name;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'name', $this);
            $this->company->name = $name;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyPhoneNumber() : ?string
    {
        if (isset($this->company->phoneNumber)) {
            return $this->company->phoneNumber;
        }

        return null;
    }

    /**
     * @param string $phoneNumber
     * @return Company
     */
    public function setCompanyPhoneNumber(string $phoneNumber)
    {
        if (isset($this->company)) {
            $this->company->phoneNumber = $phoneNumber;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'phoneNumber', $this);
            $this->company->phoneNumber = $phoneNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyVatNumber() : ?string
    {
        if (isset($this->company->vatNumber)) {
            return $this->company->vatNumber;
        }

        return null;
    }

    /**
     * @param string $vatNumber
     * @return Company
     */
    public function setCompanyVatNumber(string $vatNumber)
    {
        if (isset($this->company)) {
            $this->company->vatNumber = $vatNumber;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'vatNumber', $this);
            $this->company->vatNumber = $vatNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyWebsite() : ?string
    {
        if (isset($this->company->website)) {
            return $this->company->website;
        }

        return null;
    }

    /**
     * @param string $website
     * @return Company
     */
    public function setCompanyWebsite(string $website)
    {
        if (isset($this->company)) {
            $this->company->website = $website;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'website', $this);
            $this->company->website = $website;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyZip() : ?string
    {
        if (isset($this->company->zip)) {
            return $this->company->zip;
        }

        return null;
    }

    /**
     * @param string $zip
     * @return Company
     */
    public function setCompanyZip(string $zip)
    {
        if (isset($this->company)) {
            $this->company->zip = $zip;
        } else {
            $this->company = $this->api->setClass('Company\Details', 'zip', $this);
            $this->company->zip = $zip;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyAffiliation() : ?string
    {
        return $this->companyAffiliation;
    }

    /**
     * @param string $companyAffiliation
     * @return $this
     */
    public function setCompanyAffiliation(string $companyAffiliation)
    {
        $this->companyAffiliation = $companyAffiliation;

        return $this;
    }

    /**
     * @return array
     */
    public function getModules() : ?array
    {
        return $this->modules;
    }

    /**
     * @param array $modules
     * @return $this
     */
    public function setModules(array $modules)
    {
        if (is_array($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = $module;
            }
        }

        return $this;
    }

    /**
     * @return Settings
     */
    public function getSettings() : ?Settings
    {
        return $this->settings;
    }

    /**
     * @param Settings $settings
     * @return $this
     */
    public function setSettings($settings)
    {
        $this->settings = new Settings($settings->baseCurrency, $settings->internationalLedger ?? null);

        return $this;
    }

    /**
     * @return string
     */
    public function getSignUpdate() : ?string
    {
        return $this->signUpDate;
    }

    /**
     * @param string $signUpDate
     * @return $this
     */
    public function setSignUpDate(string $signUpDate)
    {
        $this->signUpDate = $signUpDate;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser() : ?User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getUserAgreementNumber()
    {
        if (isset($this->user->agreementNumber)) {
            return $this->user->agreementNumber;
        }

        return null;
    }

    /**
     * @param int $agreementNumber
     * @return Company
     */
    public function setUserAgreementNumber(int $agreementNumber)
    {
        if (isset($this->user)) {
            $this->user->agreementNumber = $agreementNumber;
        } else {
            $this->user = $this->api->setClass('Company\User', 'agreementNumber', $this);
            $this->user->agreementNumber = $agreementNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getUserEmail() : ?string
    {
        if (isset($this->user->email)) {
            return $this->user->email;
        }

        return null;
    }

    /**
     * @param string $email
     * @return Company
     */
    public function setUserEmail(string $email)
    {
        if (isset($this->user)) {
            $this->user->email = $email;
        } else {
            $this->user = $this->api->setClass('Company\User', 'email', $this);
            $this->user->email = $email;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getUserLoginId() : ?string
    {
        if (isset($this->user->loginId)) {
            return $this->user->loginId;
        }

        return null;
    }

    /**
     * @param string $loginId
     * @return Company
     */
    public function setUserLoginId(string $loginId)
    {
        if (isset($this->user)) {
            $this->user->loginId = $loginId;
        } else {
            $this->user = $this->api->setClass('Company\User', 'loginId', $this);
            $this->user->loginId = $loginId;
        }

        return $this;
    }

    /**
     * @return Language
     */
    public function getUserLanguage() : ?Language
    {
        if (isset($this->user->language)) {
            return $this->user->language;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getUserLanguageCulture() : ?string
    {
        if (isset($this->user->language->culture)) {
            return $this->user->language->culture;
        }

        return null;
    }

    /**
     * @param string $culture
     * @return Company
     */
    public function setUserLanguageCulture(string $culture)
    {
        if (isset($this->user->language)) {
            $this->user->language->culture = $culture;
        } else {
            $this->user->language = $this->api->setClass('Company\Language', 'culture', $this);
            $this->user->language->culture = $culture;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getUserLanguageLanguageNumber() : ?int
    {
        if (isset($this->user->language->languageNumber)) {
            return $this->user->language->languageNumber;
        }

        return null;
    }

    /**
     * @param int $languageNumber
     * @return Company
     */
    public function setUserLanguageLanguageNumber(int $languageNumber)
    {
        if (isset($this->user->language)) {
            $this->user->language->languageNumber = $languageNumber;
        } else {
            $this->user->language = $this->api->setClass('Company\Language', 'languageNumber', $this);
            $this->user->language->languageNumber = $languageNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getUserLanguageName() : ?string
    {
        if (isset($this->user->language->name)) {
            return $this->user->language->name;
        }

        return null;
    }

    /**
     * @param string $name
     * @return Company
     */
    public function setUserLanguageName(string $name)
    {
        if (isset($this->user->language)) {
            $this->user->language->name = $name;
        } else {
            $this->user->language = $this->api->setClass('Company\Language', 'name', $this);
            $this->user->language->name = $name;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getUserUserName() : ?string
    {
        if (isset($this->user->name)) {
            return $this->user->name;
        }

        return null;
    }

    /**
     * @param string $name
     * @return Company
     */
    public function setUserUserName(string $name)
    {
        if (isset($this->user)) {
            $this->user->name = $name;
        } else {
            $this->user = $this->api->setClass('Company\User', 'name', $this);
            $this->user->name = $name;
        }

        return $this;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = new User($user->agreementNumber, $user->email, $user->language, $user->loginId, $user->name);

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName() : ?string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return $this
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return $this
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
