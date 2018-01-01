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

    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function transform($api, $object)
    {
        $paymentType = new self($api);

        $paymentType->setName($object->name)
                    ->setPaymentTypeNumber($object->paymentTypeNumber)
                    ->setSelf($object->self);

        return $paymentType;
    }

    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('/payment-types?'.$filter->filter().'&', $this);
        } else {
            return $this->api->collection('/payment-types?', $this);
        }
    }

    /**
     * @param int $id
     * @return PaymentType
     */
    public function get($id)
    {
        return self::transform($this->api, $this->api->get('/payment-types/'.$id));
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
