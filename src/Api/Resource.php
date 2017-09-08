<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 06-09-2017
 * Time: 13:44
 */

namespace Economic\Api;

use Unirest\Request;

abstract class Resource
{

    public $appSecretToken = 'tsf8fJFBD6B0b3VxkOPUTcoetTaMorbTsb8Xgtej9l81';
    public $agreementGrantToken = 'OtZCNMYv1VXEvcwGLUN6kVAmjzp4cNxR1D1b8yIeea41';
    public $contentType = 'application/json';
    public $economicUrl = 'https://restapi.e-conomic.com';

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

    public function update($id, $parameters)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function delete($id)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @param string $url
     * @return array
     */

    protected function apiGet($url): array
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        $response = Request::get($this->economicUrl.$url, $headers);
        return $response->body->collection;
    }

    /**
     * @param string $route
     * @return object
     */

    protected function apiGetItem($route)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        $response = Request::get($this->economicUrl.$route, $headers);
        return $response->body;
    }

    /**
     * @param string $url
     * @param array $data
     * @return void
     */

    protected function apiSave($url, $data)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        $body = Request\Body::json($data);
        Request::post($this->economicUrl.$url, $headers, $body);
    }

    /**
     * @param string $url
     * @param array $data
     * @return void
     */

    protected function apiUpdate($url, $data)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        $body = Request\Body::json($data);
        Request::put($this->economicUrl.$url, $headers, $body);
    }

    /**
     * @param string $route
     * @return void
     */

    protected function apiDelete($route)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->appSecretToken, 'X-AgreementGrantToken' => $this->agreementGrantToken);
        Request::delete($this->economicUrl.$route, $headers);
    }

}
