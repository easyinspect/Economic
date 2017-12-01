<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 16:49
 */

namespace Economic\Models;

use Economic\Economic;

class PaymentTypes
{
    /** @var string $name */
    private $name;
    /** @var int $paymentTypeNumber */
    private $paymentTypeNumber;
    /** @var string $self */
    private $self;

    /** @var Economic $api*/
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function parse($api, $object)
    {
        $paymentType = new PaymentTypes($api);

        $paymentType->setName($object->name)
                    ->setPaymentTypeNumber($object->paymentTypeNumber)
                    ->setSelf($object->self);

        return $paymentType;
    }

    public function all($pageSize = 20, $skipPages = 0, $recursive = true)
    {
        $paymentTypes = $this->api->retrieve('/payment-types?skippages='.$skipPages.'&pagesize='.$pageSize.'');

        if ($recursive && isset($paymentTypes->pagination->nextPage)) {
            $collection = $this->all($pageSize, $skipPages + 1);
            $paymentTypes->collection = array_merge($paymentTypes->collection, $collection);
        }

        $paymentTypes->collection = array_map(function($item) {
            return self::parse($this->api, $item);
        }, $paymentTypes->collection);

        return $paymentTypes->collection;
    }

    public function get($id)
    {
        $paymentType = $this->api->retrieve('/payment-types/' . $id);
        return $paymentType;
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