<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 20-09-2017
 * Time: 14:33.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;

class CustomerCollection
{
    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function all(Filter $filter = null, $pageSize = 20, $skipPages = 0, $recursive = true)
    {
        if (is_null($filter)) {
            $customers = $this->api->retrieve('/customers?skippages='.$skipPages.'&pagesize='.$pageSize);
        } else {
            $customers = $this->api->retrieve('/customers?'.$filter->filter().'&pagesize='.$pageSize);
        }

        if ($recursive && isset($customers->pagination->nextPage)) {
            $temp = $this->all($filter, $pageSize, $skipPages + 1);
            $customers->collection = array_merge($customers->collection, $temp);
        }

        $customers->collection = array_map(function ($item) {
            return Customer::parse($this->api, $item);
        }, $customers->collection);

        return $customers->collection;
    }
}
