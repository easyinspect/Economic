<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04
 */

namespace Economic\Models;

class Units
{

    private $name;
    private $unitNumber;

    private $api;

    public function __construct(RespondToSchema $api)
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
        $this->processObject($unit);
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

        $this->api->update('/units/' . $this->getUnitNumber(), array_filter($data));
        return $this;
    }

    public function create()
    {
        $data = [
            'name' => $this->getName()
        ];

        $this->api->create('/units', $data);
        return $this;
    }

    public function processObject($object)
    {
        foreach ($object as $key => $value)
        {
            if (method_exists($this, 'set'.ucfirst($key)))
            {
                $this->{'set' . ucfirst($key)}($value);
            }
        }
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