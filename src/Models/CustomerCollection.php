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
    private $api;

    public function __construct(RespondToSchema $api)
    {
        $this->api = $api;
    }

    public function all()
    {
        $customers = $this->api->retrieve('/customers');
        return $customers;
    }

    public function sortByName($name)
    {
        $customers = $this->api->retrieve('/customers?filter=name$like:' . $name);
        return $customers;

    }
}