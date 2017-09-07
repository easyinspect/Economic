<?php

namespace Economic\Api;

class EconomicApi {

    protected $customerResource;

    public function __construct()
    {
        $this->customerResource = new CustomerResource();
    }

    public function customer() : CustomerResource
    {
        return $this->customerResource;
    }

    /**
    public function a($url) {

        $headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        $response = Request::get($url, $headers);

        return $response->body->collection;
    }

    public function Delete($url, $id) {

        $headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        Request::delete($url . $id, $headers);
    }**/
}