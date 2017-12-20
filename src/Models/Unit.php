<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Filter;
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

    /** @var Economic $economic */
    private $economic;

    /**
     * Unit constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Unit
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Unit
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $unit = new self($economic);

        $unit->setName($stdClass->name);
        $unit->setUnitNumber($stdClass->unitNumber);
        $unit->setSelf($stdClass->self);

        return $unit;
    }

    /**
     * Retrieves a collection of Units
     * @param Filter $filter
     * @return Unit
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/units?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/units?', $this);
        }
    }

    /**
     * Retrieves a single Unit by ID
     * @param int $id
     * @return Unit
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/units/'.$id));
    }

    /**
     * Deletes a Unit
     * Requires Unit's get(id) method in order to perform this.
     */
    public function delete()
    {
        return $this->economic->delete('/units/'.$this->getUnitNumber());
    }

    /**
     * Updates a Unit by its unitNumber
     * @return Unit
     */
    public function update()
    {
        $data = (object) [
          'name' => $this->getName(),
          'unitNumber' => $this->getUnitNumber(),
        ];

        return self::transform($this->economic, $this->economic->update('/units/'.$this->getUnitNumber(), $data));
    }

    /**
     * Creates a Unit
     * @return Unit
     */
    public function create()
    {
        $data = (object) [
            'name' => $this->getName(),
        ];

        $validator = UnitValidator::getValidator();

        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->create('/units', $data));
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
