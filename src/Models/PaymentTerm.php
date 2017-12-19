<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Filter;
use Economic\Models\Components\ContraAccountForPrepaidAmount;
use Economic\Models\Components\ContraAccountForRemainderAmount;
use Economic\Models\Components\CreditCardCompany;

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
    /** @var $paymentTermsType */
    private $paymentTermsType;
    /** @var int $percentageForPrepaidAmount */
    private $percentageForPrepaidAmount;
    /** @var int $percentageForRemainderAmount */
    private $percentageForRemainderAmount;
    /** @var string $self */
    private $self;

    /** @var Economic $api */
    private $api;

    /**
     * PaymentTerms constructor
     * @param Economic $api
     */
    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    /**
     * Transform stdClass object into PaymentTerms
     * @param \stdClass $object
     * @param Economic $api
     * @return PaymentTerm
     */
    public static function transform($api, $object)
    {
        $paymentTerm = new self($api);

        $paymentTerm->setContraAccountForPrepaidAmount($object->contraAccountForPrepaidAmount);
        $paymentTerm->setContraAccountForRemainderAmount($object->contraAccountForRemainderAccount);
        $paymentTerm->setCreditCardCompany($object->creditCardCompany);
        $paymentTerm->setDaysOfCredit($object->daysOfCredit);
        $paymentTerm->setDescription($object->description);
        $paymentTerm->setName($object->name);
        $paymentTerm->setPaymentTermsNumber($object->paymentTermsNumber);
        $paymentTerm->setPaymentTermsType($object->paymentTermsType);
        $paymentTerm->setPercentageForPrepaidAmount($object->percentageForPrepaidAmount);
        $paymentTerm->setPercentageForRemainderAmount($object->percentageForRemainderAmount);
        $paymentTerm->setSelf($object->self);

        return $paymentTerm;
    }

    /**
     * Retrieves collection of PaymentTerms
     * @param Filter $filter
     * @return PaymentTerm
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('/payment-terms?'.$filter->filter().'&', $this);
        } else {
            return $this->api->collection('/payment-terms?', $this);
        }
    }

    /**
     * Retrieves one single PaymentTerm
     * @param int $id
     * @return PaymentTerm
     */
    public function get($id)
    {
        return self::transform($this->api, $this->api->get('/payment-terms/'.$id));
    }

    /**
     * Creates a PaymentTerm
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
            'percentageForRemainderAmount' => $this->getPercentageForRemainderAmount()
        ];

        $this->api->cleanObject($data);
    }

    /**
     * Updates a PaymentTerm
     * @return PaymentTerm
     */
    public function update(){}

    /**
     * Deletes a PaymentTerm
     */
    public function delete()
    {
        return $this->api->delete('/payment-terms/'.$this->getPaymentTermsNumber());
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
    public function setPaymentTermsNumber(int $paymentTermsNumber)
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
    public function getDaysOfCredit() : ?int
    {
        return $this->daysOfCredit;
    }

    /**
     * @param int $daysOfCredit
     * @return PaymentTerm
     */
    public function setDaysOfCredit(int $daysOfCredit)
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
    public function setDescription(string $description)
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
    public function setPercentageForPrepaidAmount(int $percentageForPrepaidAmount)
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
    public function setPercentageForRemainderAmount(int $percentageForRemainderAmount)
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
