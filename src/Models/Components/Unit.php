<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Unit
{
    /** @var int $unitNumber */
    public $unitNumber;
    /** @var string $name */
    public $name;
    /** @var string $self */
    public $self;


    public function __construct($unitNumber = null, $name = null, $self = null)
    {

        $this->unitNumber = $unitNumber;
        $this->name = $name;
        $this->self = $self;

    }

}