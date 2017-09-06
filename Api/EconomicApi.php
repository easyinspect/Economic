<?php

namespace EconomicPHPWrapper\Api;

class EconomicApi {

    protected $userResource;

    public function __construct()
    {
        $this->userResource = new UserResource();
    }

    public function user() : UserResource
    {
        return $this->userResource;
    }


    /*public function customer():CustomerResource
    {
        return $this->customerResource;
    }*/

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