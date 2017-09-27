<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 12:09
 */

namespace Economic;

use GuzzleHttp\Client;
use Economic\Models\RespondToSchema;
use Economic\Models\Customer;
use Economic\Models\CustomerCollection;
use Economic\Models\Units;
use Economic\Models\Products;
use Economic\Models\PaymentTypes;
use Economic\Models\Currency;
use Economic\Models\Layouts;
use Economic\Models\DraftInvoices;

class Economic implements RespondToSchema
{

    /* AppSecretToken - IBDTsO7n5FmWF4ms7YlBKScXJV14sqp14mYw3OxbAqU1
     * AgreementGrantToken - UBBtI0nDfUz2lLBMOFvDGdvpjVMkmZgH3SsBu01n5KY1
     * ContentType - application/json
     */

    private $appSecretToken;
    private $agreementGrantToken;
    private $contentType = 'application/json';
    private $baseUrl = 'https://restapi.e-conomic.com/';

    private $client;

    public function __construct($appSecretToken, $agreementGrantToken)
    {
        $this->appSecretToken = $appSecretToken;
        $this->agreementGrantToken = $agreementGrantToken;
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }

    public function retrieve($url)
    {
        $headers = [
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->contentType
            ]
        ];

        $response = $this->client->get($url, $headers);
        $data = json_decode($response->getBody()->getContents());

        return $data;
    }

    public function create($url, $body)
    {
        $data = [
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->contentType
            ],
            'body' => json_encode($body)
        ];

        $this->client->post($url, $data);
    }

    public function update($url, $body)
    {

        $data = [
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->contentType
            ],
            'body' => json_encode($body)
        ];

        $this->client->put($url, $data);
    }

    public function delete($url)
    {
        $data = [
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->contentType
            ]
        ];

        $this->client->delete($url, $data);
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

    public function draftInvoices() : DraftInvoices
    {
        return new DraftInvoices($this);
    }

}