<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-09-2017
 * Time: 16:12
 */
namespace Economic;

use Unirest\Request;
use Economic\Models\Customer;

class Economic
{

    private $appSecretToken;
    private $agreementGrantToken;
    private $contentType = 'application/json';
    private $economicUrl = 'https://restapi.e-conomic.com';

    public function __construct($appSecretToken, $agreementGrantToken)
    {
        $this->setAppSecretToken($appSecretToken);
        $this->setAgreementGrantToken($agreementGrantToken);
    }

    /**
     * @return string
     */
    public function getAppSecretToken()
    {
        return $this->appSecretToken;
    }

    /**
     * @param string $appSecretToken
     */
    public function setAppSecretToken($appSecretToken)
    {
        $this->appSecretToken = $appSecretToken;
    }

    /**
     * @return string
     */
    public function getAgreementGrantToken()
    {
        return $this->agreementGrantToken;
    }

    /**
     * @param string $agreementGrantToken
     */
    public function setAgreementGrantToken($agreementGrantToken)
    {
        $this->agreementGrantToken = $agreementGrantToken;
    }

    /**
     * @param string $url
     */

    public function getCollection($url)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->getAppSecretToken(), 'X-AgreementGrantToken' => $this->getAgreementGrantToken());
        $response = Request::get($this->economicUrl.$url, $headers);
        return $response->body;
    }

    /**
     * @param string $route
     * @return object
     */

    public function getItem($route)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->getAppSecretToken(), 'X-AgreementGrantToken' => $this->getAgreementGrantToken());
        $response = Request::get($this->economicUrl.$route, $headers);
        return $response->body;
    }

    /**
     * @param string $url
     * @param array $data
     */

    public function save($url, $data)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->getAppSecretToken(), 'X-AgreementGrantToken' => $this->getAgreementGrantToken());
        $body = Request\Body::json($data);
        Request::post($this->economicUrl.$url, $headers, $body);
    }

    /**
     * @param string $url
     * @param array $data
     */

    public function update($url, $data)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->getAppSecretToken(), 'X-AgreementGrantToken' => $this->getAgreementGrantToken());
        $body = Request\Body::json($data);
        Request::put($this->economicUrl.$url, $headers, $body);
    }

    /**
     * @param string $route
     */

    public function delete($route)
    {
        $headers = array('Content-Type' => $this->contentType, 'X-AppSecretToken' => $this->getAppSecretToken(), 'X-AgreementGrantToken' => $this->getAgreementGrantToken());
        $response = Request::delete($this->economicUrl.$route, $headers);
    }

    /**
     * @return Customer
     */
    public function customer()
    {
        return new Customer($this);
    }

    /**
     * @return \Economic\Models\CustomerCollection
     */
    public function customerCollection()
    {
        return new \Economic\Models\CustomerCollection($this);
    }
}