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

    public function all($pageSize = 20, $skipPages = 0, $recursive = true)
    {
        $layouts = $this->api->retrieve('/layouts?skippages='.$skipPages.'&pagesize='.$pageSize);

        if ($recursive && isset($layouts->pagination->nextPage)) {
            $collection = $this->all($pageSize, $skipPages + 1);
            $layouts->collection = array_merge($layouts->collection, $collection);
        }

        $layouts->collection = array_map(function ($item) {
            return self::parse($this->api, $item);
        }, $layouts->collection);

        return $layouts->collection;
    }

    public function get($id)
    {
        $layout = $this->api->retrieve('/layouts/'.$id);

        return self::parse($this->api, $layout);
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
