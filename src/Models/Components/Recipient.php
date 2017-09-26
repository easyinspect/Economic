<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 12:58
 */

namespace Economic\Models\Components;

class Recipient
{
    public $name;
    public $vatZone;

    public function __construct($name)
    {
        $this->name = $name;
        $this->vatZone = new \stdClass();
    }


}