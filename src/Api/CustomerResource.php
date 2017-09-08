<?php

namespace Economic\Api;

use Economic\Models\Customer;

class CustomerResource extends Resource {

    /**
     * @return array
     */

    public function all() : array
    {
        $customers = $this->apiGet('/customers');

        $return = [];

        foreach ($customers as $customer)
        {
            $return[] = new Customer($customer);
        }

        return $return;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function get($id) : Customer
    {
        $customer = $this->apiGetItem('/customers/' . $id);
        return new Customer($customer);
    }

    /**
     * @param array $parameters
     * @return void
     */

    public function save($parameters)
    {
       $this->apiSave('/customers', $parameters);
       header('Location: test.php');
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return void
     */

    public function update($id, $parameters)
    {
        $this->apiUpdate('/customers/' . $id, $parameters);
        header('Location: test.php');
    }

    /**
     * @param int $id
     * @return void
     */

    public function delete($id)
    {
        $this->apiDelete('/customers/' . $id);
        header('Location: test.php');
    }
}