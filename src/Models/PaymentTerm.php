<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\CreditCardCompany;
use Economic\Models\Components\ContraAccountForPrepaidAmount;
use Economic\Models\Components\ContraAccountForRemainderAmount;

class PaymentTerm
{
    /** @var ContraAccountForPrepaidAmount $contraAccountForPrepaidAmount */
    private $contraAccountForPrepaidAmount;
    /** @var ContraAccountForRemainderAmount $contraAccountForRemainderAmount */
    private $contraAccountForRemainderAmount;
    /** @var CreditCardCompany $creditCardCompany */
    private $creditCardCompany;
    /** @var int $daysOfCredit */
    private $daysOfCredit;
    /** @var string $description */
    private $description;
    /** @var string $name */
    private $name;
    /** @var int $paymentTermsNumber */
    private $paymentTermsNumber;
    /** @var string $paymentTermsType */
    private $paymentTermsType;
    /** @var int $percentageForPrepaidAmount */
    private $percentageForPrepaidAmount;
    /** @var int $percentageForRemainderAmount */
    private $percentageForRemainderAmount;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * PaymentTerms constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into PaymentTerms.
     * @param \stdClass $stdClass
     * @param Economic $economic
     * @return PaymentTerm
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $paymentTerm = new self($economic);

        $paymentTerm->setContraAccountForPrepaidAmount($stdClass->contraAccountForPrepaidAmount ?? null);
        $paymentTerm->setContraAccountForRemainderAmount($stdClass->contraAccountForRemainderAccount ?? null);
        $paymentTerm->setCreditCardCompany($stdClass->creditCardCompany ?? null);
        $paymentTerm->setDaysOfCredit($stdClass->daysOfCredit ?? null);
        $paymentTerm->setDescription($stdClass->description ?? null);
        $paymentTerm->setName($stdClass->name);
        $paymentTerm->setPaymentTermsNumber($stdClass->paymentTermsNumber ?? null);
        $paymentTerm->setPaymentTermsType($stdClass->paymentTermsType);
        $paymentTerm->setPercentageForPrepaidAmount($stdClass->percentageForPrepaidAmount ?? null);
        $paymentTerm->setPercentageForRemainderAmount($stdClass->percentageForRemainderAmount ?? null);
        $paymentTerm->setSelf($stdClass->self);

        return $paymentTerm;
    }

    /**
     * Retrieves collection of PaymentTerms.
     * @param Filter $filter
     * @return PaymentTerm
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/payment-terms?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/payment-terms?', $this);
        }
    }

    /**
     * Retrieves one single PaymentTerm.
     * @param int $id
     * @return PaymentTerm
     */
    public function get($id)
    {
        return self::transform($this->economic, $this->economic->get('/payment-terms/'.$id));
    }

    /**
     * Creates a PaymentTerm.
     * @return PaymentTerm
     */
    public function create()
    {
        $data = (object) [
            'contraAccountForPrepaidAmount' => $this->getContraAccountForPrepaidAmount(),
            'contraAccountForRemainderAmount' => $this->getContraAccountForRemainderAmount(),
            'creditCardCompany' => $this->getCreditCardCompany(),
            'daysOfCredit' => $this->getDaysOfCredit(),
            'description' => $this->getDescription(),
            'name' => $this->getName(),
            'paymentTermsType' => $this->getPaymentTermsType(),
            'percentageForPrepaidAmount' => $this->getPercentageForPrepaidAmount(),
            'percentageForRemainderAmount' => $this->getPercentageForRemainderAmount(),
        ];

        $this->economic->cleanObject($data);

        $validator = \PaymentTermValidator::getValidator();
        if (!$validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->create('/payment-terms', $data));
    }

    /**
     * Updates a PaymentTerm.
     * @return PaymentTerm
     */
    public function update()
    {
        $data = (object) [
            'contraAccountForPrepaidAmount' => $this->getContraAccountForPrepaidAmount(),
            'contraAccountForRemainderAmount' => $this->getContraAccountForRemainderAmount(),
            'creditCardCompany' => $this->getCreditCardCompany(),
            'daysOfCredit' => $this->getDaysOfCredit(),
            'description' => $this->getDescription(),
            'name' => $this->getName(),
            'paymentTermsType' => $this->getPaymentTermsType(),
            'percentageForPrepaidAmount' => $this->getPercentageForPrepaidAmount(),
            'percentageForRemainderAmount' => $this->getPercentageForRemainderAmount()
        ];

        $this->economic->cleanObject($data);

        $validator = \PaymentTermValidator::getValidator();
        if (!$validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->update('/payment-terms/'.$this->getPaymentTermsNumber(), $data));
    }

    /**
     * Deletes a PaymentTerm.
     * Requires PaymentTerm's get(id) method in order to perform this.
     */
    public function delete()
    {
        return $this->economic->delete('/payment-terms/'.$this->getPaymentTermsNumber());
    }

    // Getters & Setters

    /**
     * @return int
     */
    public function getPaymentTermsNumber() : ?int
    {
        return $this->paymentTermsNumber;
    }

    /**
     * @param int $paymentTermsNumber
     * @return PaymentTerm
     */
    public function setPaymentTermsNumber(int $paymentTermsNumber = null)
    {
        $this->paymentTermsNumber = $paymentTermsNumber;

        return $this;
    }

    /**
     * @return ContraAccountForPrepaidAmount
     */
    public function getContraAccountForPrepaidAmount() : ?ContraAccountForPrepaidAmount
    {
        return $this->contraAccountForPrepaidAmount;
    }

    /**
     * @param \stdClass $contraAccountForPrepaidAmount
     * @return PaymentTerm
     */
    public function setContraAccountForPrepaidAmount(\stdClass $contraAccountForPrepaidAmount = null)
    {
        if (isset($contraAccountForPrepaidAmount)) {
            $this->contraAccountForPrepaidAmount = new ContraAccountForPrepaidAmount(
                $contraAccountForPrepaidAmount->accountNumber,
                $contraAccountForPrepaidAmount->self);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getContraAccountForPrepaidAmountAccountNumber() : ?int
    {
        if (isset($this->contraAccountForPrepaidAmount)) {
            return $this->contraAccountForPrepaidAmount->accountNumber;
        }

        return null;
    }

    /**
     * @param int $accountNumber
     * @return PaymentTerm
     */
    public function setContraAccountForPrepaidAmountAccountNumber(int $accountNumber)
    {
        if (isset($this->contraAccountForPrepaidAmount)) {
            $this->contraAccountForPrepaidAmount->accountNumber = $accountNumber;
        } else {
            $this->contraAccountForPrepaidAmount = $this->economic->setClass('ContraAccountForPrepaidAmount', 'accountNumber');
            $this->contraAccountForPrepaidAmount->accountNumber = $accountNumber;
        }

        return $this;
    }

    /**
     * @return ContraAccountForRemainderAmount
     */
    public function getContraAccountForRemainderAmount() : ?ContraAccountForRemainderAmount
    {
        return $this->contraAccountForRemainderAmount;
    }

    /**
     * @param \stdClass $contraAccountForRemainderAmount
     * @return PaymentTerm
     */
    public function setContraAccountForRemainderAmount(\stdClass $contraAccountForRemainderAmount = null)
    {
        if (isset($contraAccountForRemainderAmount)) {
            $this->contraAccountForRemainderAmount = new ContraAccountForRemainderAmount(
                $contraAccountForRemainderAmount->accountNumber,
                $contraAccountForRemainderAmount->self);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getContraAccountForRemainderAmountAccountNumber() : ?int
    {
        if (isset($this->contraAccountForRemainderAmount)) {
            return $this->contraAccountForRemainderAmount->accountNumber;
        }

        return null;
    }

    /**
     * @param int $accountNumber
     * @return PaymentTerm
     */
    public function setContraAccountForRemainderAmountAccountNumber(int $accountNumber)
    {
        if (isset($this->contraAccountForRemainderAmount)) {
            $this->contraAccountForRemainderAmount->accountNumber = $accountNumber;
        } else {
            $this->contraAccountForRemainderAmount = $this->economic->setClass('ContraAccountForRemainderAmount', 'accountNumber');
            $this->contraAccountForRemainderAmount->accountNumber = $accountNumber;
        }

        return $this;
    }

    /**
     * @return CreditCardCompany
     */
    public function getCreditCardCompany() : ?CreditCardCompany
    {
        return $this->creditCardCompany;
    }

    /**
     * @param \stdClass $creditCardCompany
     * @return PaymentTerm
     */
    public function setCreditCardCompany(\stdClass $creditCardCompany = null)
    {
        if (isset($creditCardCompany)) {
            $this->creditCardCompany = new CreditCardCompany(
                $creditCardCompany->customerNumber,
                $creditCardCompany->self);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getCreditCardCompanyCustomerNumber() : ?int
    {
        if (isset($this->creditCardCompany)) {
            return $this->creditCardCompany->customerNumber;
        }

        return null;
    }

    /**
     * @param int $customerNumber
     * @return PaymentTerm
     */
    public function setCreditCardCompanyCustomerNumber(int $customerNumber)
    {
        if (isset($this->creditCardCompany)) {
            $this->creditCardCompany->customerNumber = $customerNumber;
        } else {
            $this->creditCardCompany = $this->economic->setClass('CreditCardCompany', 'customerNumber');
            $this->creditCardCompany->customerNumber = $customerNumber;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getDaysOfCredit() : ?int
    {
        return $this->daysOfCredit;
    }

    /**
     * @param int $daysOfCredit
     * @return PaymentTerm
     */
    public function setDaysOfCredit(int $daysOfCredit = null)
    {
        $this->daysOfCredit = $daysOfCredit;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return PaymentTerm
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PaymentTerm
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentTermsType() : ?string
    {
        return $this->paymentTermsType;
    }

    /**
     * @param string $paymentTermsType
     * @return PaymentTerm
     */
    public function setPaymentTermsType(string $paymentTermsType)
    {
        $this->paymentTermsType = $paymentTermsType;

        return $this;
    }

    /**
     * @return int
     */
    public function getPercentageForPrepaidAmount() : ?int
    {
        return $this->percentageForPrepaidAmount;
    }

    /**
     * @param int $percentageForPrepaidAmount
     * @return PaymentTerm
     */
    public function setPercentageForPrepaidAmount(int $percentageForPrepaidAmount = null)
    {
        $this->percentageForPrepaidAmount = $percentageForPrepaidAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getPercentageForRemainderAmount() : ?int
    {
        return $this->percentageForRemainderAmount;
    }

    /**
     * @param int $percentageForRemainderAmount
     * @return PaymentTerm
     */
    public function setPercentageForRemainderAmount(int $percentageForRemainderAmount = null)
    {
        $this->percentageForRemainderAmount = $percentageForRemainderAmount;

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
     * @return PaymentTerm
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
