<?php

namespace Economic\Api;

use Economic\Models\Customer;

class CustomerResource extends Resource {

    public function all() : array {

        $customers = $this->apiGet('/customers');

        $return = [];

        foreach ($customers as $customer)
        {
            $return[] = new Customer($customer);
        }

        return $return;
    }

    public function get($id) : Customer {

        $customer = $this->apiGetItem('/customers/' . $id);
        return new Customer($customer);

    }

    public function save($parameters)
    {
       $this->apiSave('/customers', $parameters);
    }

    public function update($id)
    {

    }
    public function delete($id) {
        $this->apiDelete('/customers/' . $id);
    }
}