<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:10.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;

class Layout
{
    /** @var int $layoutNumber */
    private $layoutNumber;
    /** @var string $name */
    private $name;
    /** @var string $self */
    private $self;
    /** @var bool $deleted */
    private $deleted;

    /** @var Economic $economic */
    private $economic;

    /**
     * Layout constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transforms stdClass object into Layout
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Layout
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $layout = new self($economic);

        $layout->setName($stdClass->name);
        $layout->setLayoutNumber($stdClass->layoutNumber);
        $layout->setDeleted($stdClass->deleted ?? null);
        $layout->setSelf($stdClass->self);

        return $layout;
    }

    /**
     * Retrieves a collection of Layout(s)
     * @param Filter $filter
     * @return Layout
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/layouts?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/layouts?', $this);
        }
    }

    /**
     * Retrieve a single Layout by its ID
     * @param int $id
     * @return Layout
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/layouts/'.$id));
    }

    /**
     * @return int
     */
    public function getLayoutNumber()
    {
        return $this->layoutNumber;
    }

    /**
     * @param int $layoutNumber
     * @return $this
     */
    public function setLayoutNumber($layoutNumber)
    {
        $this->layoutNumber = $layoutNumber;

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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return $this
     */
    public function setSelf($self)
    {
        $this->self = $self;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDeleted() : ?bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     * @return $this
     */
    public function setDeleted(bool $deleted = null)
    {
        $this->deleted = $deleted;

        return $this;
    }
}
