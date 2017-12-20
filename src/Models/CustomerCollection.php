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
    /** @var Economic $economic */
    private $economic;

    /**
     * CustomerCollection constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Retrieves a collection of Customers
     * @param Filter $filter
     * @return Customer
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/customers?'.$filter->filter().'&', new Customer($this->economic));
        } else {
            return $this->economic->collection('/customers?', new Customer($this->economic));
        }
    }
}
