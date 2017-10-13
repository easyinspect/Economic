<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 20-09-2017
 * Time: 14:33
 */

namespace Economic\Models;

use Economic\{Economic, Filter};

class CustomerCollection
{
    /** @var Economic $api*/
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function all(Filter $filter = null)
    {
        if (is_null($filter)) {
            $customers = $this->api->retrieve('/customers');
        } else {
            $customers = $this->api->retrieve('/customers'.$filter->filter());
        }
        return $customers;
    }
}