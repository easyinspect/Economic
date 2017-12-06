<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Validations\UnitValidator;

class Unit
{
    /** @var int $unitNumber */
    private $unitNumber;
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

    public static function parse($api, $object)
    {
        $unit = new self($api);

        $unit->setName($object->name)
            ->setUnitNumber($object->unitNumber)
            ->setSelf($object->self);

        return $unit;
    }

    public function all($pageSize = 20, $skipPages = 0, $recursive = true)
    {
        $units = $this->api->retrieve('/units?skippages='.$skipPages.'&pagesize='.$pageSize.'');

        if ($recursive && isset($units->pagination->nextPage)) {
            $collection = $this->all($pageSize, $skipPages + 1);
            $units->collection = array_merge($units->collection, $collection);
        }

        $units->collection = array_map(function ($item) {
            return self::parse($this->api, $item);
        }, $units->collection);

        return $units->collection;
    }

    public function get($id)
    {
        $unit = $this->api->retrieve('/units/'.$id);

        return self::parse($this->api, $unit);
    }

    public function create()
    {
        $data = (object) [
            'name' => $this->getName(),
        ];

        $this->api->cleanObject($data);

        $validator = UnitValidator::getValidator();

        if (! $validator->validate($this)) {
            $validator->getException($this);
        }

        $unit = $this->api->create('/units', $data);

        return self::parse($this->api, $unit);
    }

    public function update()
    {
        $data = (object) [
            'name' => $this->getName(),
            'unitNumber' => $this->getUnitNumber(),
        ];

        $this->api->cleanObject($data);
        $this->api->update('/units/'.$this->getUnitNumber(), $data);

        return $this;
    }

    public function delete()
    {
        $this->api->delete('/units/'.$this->getUnitNumber());

        return $this;
    }

    // Getters & Setters

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
    public function getUnitNumber() : ?int
    {
        return $this->unitNumber;
    }

    /**
     * @param int $unitNumber
     * @return $this
     */
    public function setUnitNumber(int $unitNumber)
    {
        $this->unitNumber = $unitNumber;

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
