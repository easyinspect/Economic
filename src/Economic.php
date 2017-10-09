<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 12:09
 */

namespace Economic;

use GuzzleHttp\Client;
use Economic\Models\Customer;
use Economic\Models\CustomerCollection;
use Economic\Models\Units;
use Economic\Models\Products;
use Economic\Models\PaymentTypes;
use Economic\Models\Currency;
use Economic\Models\Layouts;
use Economic\Models\DraftInvoices;

class Economic
{
    private $appSecretToken;
    private $agreementGrantToken;
    private $contentType = 'application/json';
    private $baseUrl = 'https://restapi.e-conomic.com/';
    private $headers;

    private $client;

    public function __construct($appSecretToken, $agreementGrantToken)
    {
        $this->appSecretToken = $appSecretToken;
        $this->agreementGrantToken = $agreementGrantToken;
        $this->client = new Client(['base_uri' => $this->baseUrl]);

        $this->headers = [
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->contentType
            ],
        ];
    }

    public function retrieve($url)
    {
        $response = $this->client->get($url, $this->headers);
        $data = json_decode($response->getBody()->getContents());

        return $data;
    }

    public function download($url)
    {
        $response = $this->client->get($url, $this->headers);

        return $response->getBody()->getContents();

    }

    public function create($url, $body)
    {

        $this->headers['body'] = json_encode($body);

        $create = $this->client->post($url, $this->headers);
        $json = json_decode($create->getBody()->getContents());
        return $json;
    }

    public function update($url, $body)
    {

        $this->headers['body'] = json_encode($body);

        $update = $this->client->put($url, $this->headers);
        $json = json_decode($update->getBody()->getContents());
        return $json;
    }

    public function delete($url)
    {
        $this->client->delete($url, $this->headers);
        return $this;
    }

    public function setObject($object, $methods)
    {
        foreach ($object as $key => $value)
        {
            if (method_exists($methods, 'set'.ucfirst($key)))
            {
                $methods->{'set' . ucfirst($key)}($value);
            }
        }
        return $this;
    }

    /**
     * @return Customer
     */

    public function customer() : Customer
    {
        return new Customer($this);
    }

    /**
     * @return CustomerCollection
     */

    public function customerCollection() : CustomerCollection
    {
        return new CustomerCollection($this);
    }

    /**
     * @return Units
     */

    public function units() : Units
    {
        return new Units($this);
    }

    /**
     * @return Products
     */

    public function products() : Products
    {
        return new Products($this);
    }

    /**
     * @return PaymentTypes
     */

    public function paymentTypes() : PaymentTypes
    {
        return new PaymentTypes($this);
    }

    /**
     * @return Currency
     */

    public function currency() : Currency
    {
        return new Currency($this);
    }

    /**
     * @return Layouts
     */

    public function layouts() : Layouts
    {
        return new Layouts($this);
    }

    /**
     * @return draftInvoices
     */

    public function draftInvoices() : DraftInvoices
    {
        return new DraftInvoices($this);
    }

}