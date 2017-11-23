<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05
 */

namespace Economic\Models;


use Economic\Economic;

class Currency
{
    /** @var string $code */
    private $code;
    /** @var string $isoNumber */
    private $isoNumber;
    /** @var string $name */
    private $name;
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
        $currency = new Currency($api);

        $currency->setCode($object->code)
                ->setIsoNumber($object->isoNumber)
                ->setName($object->name)
                ->setSelf($object->self);

        return $currency;
    }

    public function all($pageSize = 20, $skipPages = 0, $recursive = true)
    {
        $currencies = $this->api->retrieve('/currencies');

        if ($recursive && isset($currencies->pagination->nextPage)) {
            $collection = $this->all($pageSize, $skipPages + 1);
            $currencies->collection = array_merge($currencies->collection, $collection);
        }

        $currencies->collection = array_map(function($item) {
            return self::parse($this->api, $item);
        }, $currencies->collection);

        return $currencies->collection;
    }

    public function get(string $code)
    {
        $currency = $this->api->retrieve('/currencies/' . $code);
        $this->api->setObject($currency, $this);
        return $this;
    }

    /**
     * @return string
     */
    public function getCode() : ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsoNumber() : ?string
    {
        return $this->isoNumber;
    }

    /**
     * @param string $isoNumber
     * @return $this
     */
    public function setIsoNumber(string $isoNumber)
    {
        $this->isoNumber = $isoNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
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