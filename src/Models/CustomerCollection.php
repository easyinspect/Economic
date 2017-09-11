<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-09-2017
 * Time: 16:22
 */

namespace Economic\Models;



class CustomerCollection extends EconomicModel
{

    private $customers;

    public function getAll()
    {
        $data = $this->api->getCollection('/customers');

        foreach ($data->collection as $cust)
        {
            $tmpCustomer = new Customer($this->api);
            $tmpCustomer->fillByObject($cust);
            $this->customers[] = $tmpCustomer;
        }
        return $this;
    }

}