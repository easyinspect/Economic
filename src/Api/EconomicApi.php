<?php

namespace Economic\Api;

class EconomicApi {

    protected $customerResource;

    public function __construct()
    {
        $this->customerResource = new CustomerResource();
    }

    /**
     * @return CustomerResource
     */
    public function customer() : CustomerResource
    {
        return $this->customerResource;
    }

}