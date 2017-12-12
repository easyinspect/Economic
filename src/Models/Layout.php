<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:10.
 */

namespace Economic\Models;

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

    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function parse($api, $object)
    {
        $layout = new self($api);

        $layout->setLayoutNumber($object->layoutNumber)
                ->setName($object->name)
                ->setSelf($object->self);

        return $layout;
    }

    public function all()
    {
        return $this->api->collection('/layouts', $this);
    }

    public function get($id)
    {
        return self::parse($this->api, $this->api->get('/layouts/'.$id));
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
    public function setDeleted(bool $deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }
}
