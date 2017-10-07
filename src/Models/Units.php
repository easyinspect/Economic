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

    private $name;
    private $unitNumber;

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
     * @return int
     */
    public function getUnitNumber()
    {
        return $this->unitNumber;
    }

    /**
     * @param int $unitNumber
     * @return $this
     */
    public function setUnitNumber($unitNumber)
    {
        $this->unitNumber = $unitNumber;

        return $this;
    }

}