<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Filter;

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

    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function transform($api, $object)
    {
        $currency = new self($api);

        $currency->setCode($object->code)
                ->setIsoNumber($object->isoNumber)
                ->setName($object->name)
                ->setSelf($object->self);

        return $currency;
    }

    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('/currencies?'.$filter->filter().'&', $this);
        } else {
            return $this->api->collection('/currencies?', $this);
        }
    }

    public function get(string $code)
    {
        return self::transform($this->api, $this->api->get('/currencies/'.$code));
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
