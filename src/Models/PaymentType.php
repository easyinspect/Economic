<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 16:49.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;

class PaymentType
{
    /** @var string $name */
    private $name;
    /** @var int $paymentTypeNumber */
    private $paymentTypeNumber;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * PaymentType constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClas object into PaymentType.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return PaymentType
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $paymentType = new self($economic);

        $paymentType->setName($stdClass->name);
        $paymentType->setPaymentTypeNumber($stdClass->paymentTypeNumber);
        $paymentType->setSelf($stdClass->self);

        return $paymentType;
    }

    /**
     * Retrieves a collection of PaymentType(s).
     * @param Filter $filter
     * @return PaymentType
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/payment-types?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/payment-types?', $this);
        }
    }

    /**
     * Retrieves a single PaymentType by its ID.
     * @param int $id
     * @return PaymentType
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/payment-types/'.$id));
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
     * @return PaymentType
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentTypeNumber() : ?int
    {
        return $this->paymentTypeNumber;
    }

    /**
     * @param int $paymentTypeNumber
     * @return PaymentType
     */
    public function setPaymentTypeNumber(int $paymentTypeNumber)
    {
        $this->paymentTypeNumber = $paymentTypeNumber;

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
     * @return PaymentType
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
