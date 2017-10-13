<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04
 */

namespace Economic\Models;

use Economic\Economic;

class Units
{
    /** @var string $name*/
    private $name;
    /** @var int $unitNumber*/
    private $unitNumber;

    /** @var Economic $api*/
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function all()
    {
        $units = $this->api->retrieve('/units');
        return $units;
    }

    public function get($id)
    {
        $unit = $this->api->retrieve('/units/' . $id);
        $this->api->setObject($unit, $this);
        return $this;
    }

    public function delete()
    {
        $this->api->delete('/units/' . $this->getUnitNumber());
        return $this;
    }

    public function update()
    {
        $data = [
          'name' => $this->getName(),
          'unitNumber' => $this->getUnitNumber()
        ];

        $unit = $this->api->update('/units/' . $this->getUnitNumber(), array_filter($data));
        $this->api->setObject($unit, $this);
        return $this;
    }

    public function create()
    {
        $data = [
            'name' => $this->getName()
        ];

        $unit = $this->api->create('/units', $data);
        $this->api->setObject($unit, $this);
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

}