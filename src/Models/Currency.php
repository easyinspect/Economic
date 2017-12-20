<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models;

use Economic\Filter;
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

    /** @var Economic $economic */
    private $economic;

    /**
     * Currency constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Currency
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Currency
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $currency = new self($economic);

        $currency->setName($stdClass->name);
        $currency->setIsoNumber($stdClass->isoNumber);
        $currency->setCode($stdClass->code);
        $currency->setSelf($stdClass->self);

        return $currency;
    }

    /**
     * Retrieves a collection of Currencies
     * @param Filter $filter
     * @return Currency
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/currencies?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/currencies?', $this);
        }
    }

    /**
     * Retrieves a single Currency by its code
     * @param string $code
     * @return Currency
     */
    public function get(string $code)
    {
        return self::transform($this->economic, $this->economic->get('/currencies/'.$code));
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
