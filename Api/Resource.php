<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 06-09-2017
 * Time: 13:44
 */

namespace EconomicPHPWrapper\Api;

use Unirest\Request;

abstract class Resource
{

    protected function economicUrl()
    {
        return 'https://restapi.e-conomic.com';
    }

    protected function appSecretToken()
    {
        return 'tsf8fJFBD6B0b3VxkOPUTcoetTaMorbTsb8Xgtej9l81';
    }

    protected function agreementGrantToken()
    {
        return 'OtZCNMYv1VXEvcwGLUN6kVAmjzp4cNxR1D1b8yIeea41';
    }

    public function all()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function get($id)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function save($parameters)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function update($id)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function delete($id)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    protected function apiGet($url): array
    {
        $headers = array('Content-Type' => 'application/json', 'X-AppSecretToken' => $this->appSecretToken(), 'X-AgreementGrantToken' => $this->agreementGrantToken());
        $response = Request::get($this->economicUrl() . $url, $headers);
        return $response->body->collection;
    }

    protected function apiGetItem($route)
    {
        //Request->get($econicURL . $route);
    }

    protected function apiSave()
    {

    }

    protected function apiUpdate()
    {

    }

    protected function apiDelete()
    {

    }
}