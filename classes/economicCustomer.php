<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-09-2017
 * Time: 11:31
 */

class economicCustomer {

    protected $appSecretToken = "tsf8fJFBD6B0b3VxkOPUTcoetTaMorbTsb8Xgtej9l81";
    protected $agreementGrantToken = "OtZCNMYv1VXEvcwGLUN6kVAmjzp4cNxR1D1b8yIeea41";

    public function customerShow() {

        $headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        $response = Unirest\Request::get('https://restapi.e-conomic.com/customers', $headers);

        return $response->body->collection;
    }

    public function customerDelete($id) {

        $headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        Unirest\Request::delete('https://restapi.e-conomic.com/customers/'.$id.'', $headers);
    }
}