<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-09-2017
 * Time: 11:31
 */

require 'economicUrls.php';

class economicCustomer extends economicUrls {

    public function customerShow() {

        $headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        $response = Unirest\Request::get($this->customerUrl, $headers);

        return $response->body->collection;
    }

    public function customerDelete($id) {

        $headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        Unirest\Request::delete($this->customerUrl . $id, $headers);
    }
}