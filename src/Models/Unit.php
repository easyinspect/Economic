<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Filter;
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

    public static function transform($api, $object)
    {
        $unit = new self($api);

        $unit->setName($object->name)
            ->setUnitNumber($object->unitNumber)
            ->setSelf($object->self);

        return $unit;
    }

    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('/units?'.$filter->filter().'&', $this);
        } else {
            return $this->api->collection('/units?', $this);
        }
    }

    public function get($id)
    {
        return self::transform($this->api, $this->api->get('/units/'.$id));
    }

    public function delete()
    {
        $this->api->delete('/units/'.$this->getUnitNumber());
        return $this;
    }

    public function update()
    {
        $data = (object) [
          'name' => $this->getName(),
          'unitNumber' => $this->getUnitNumber(),
        ];

        return self::transform($this->api, $this->api->update('/units/'.$this->getUnitNumber(), $data));
    }

    public function create()
    {
        $data = (object) [
            'name' => $this->getName(),
        ];

        $validator = UnitValidator::getValidator();

        if (!$validator->validate($this)) {
             throw $validator->getException($this);
        }

        return self::transform($this->api, $this->api->create('/units', $data));
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
