<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 20-09-2017
 * Time: 14:33
 */

namespace Economic\Models;

class CustomerCollection
{
    private $listener;

    public function __construct(RespondToSchema $listener)
    {
        $this->listener = $listener;
    }

    public function all()
    {
        $customers = $this->listener->retrieve('/customers');
        return $customers;
    }

    public function sortByName($name)
    {
        $customers = $this->listener->retrieve('/customers?filter=name$like:' . $name);
        return $customers;

    }

}