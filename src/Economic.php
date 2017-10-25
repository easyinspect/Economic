<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 12:09
 */

namespace Economic;


use GuzzleHttp\Client;
use Economic\Models\{
    Customer, CustomerCollection, Invoices, Journals, Units, Products, PaymentTypes, Currency, Layouts, DraftInvoices
};
use Economic\Exceptions\{EconomicRequestException, EconomicServerException};
use GuzzleHttp\Exception\{ClientException, ServerException, ConnectException};

class Economic
{
    /** @var string $appSecretToken */
    private $appSecretToken;
    /** @var string $agreementGrantToken */
    private $agreementGrantToken;
    /** @var string $contentType */
    private $contentType = 'application/json';
    /** @var string $baseUrl */
    private $baseUrl = 'https://restapi.e-conomic.com';
    /** @var array $headers */
    private $headers;

    /** @var Client $client */
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
        try
        {
            return \GuzzleHttp\json_decode($this->client->get($url, $this->headers)->getBody()->getContents());
        }
        catch (ClientException $exception)
        {
            throw new EconomicRequestException();
        }
        catch (ServerException $exception)
        {
            throw new EconomicServerException();
        }
        catch (ConnectException $exception)
        {
            throw new EconomicServerException('E-conomic is not available.');
        }
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
        foreach ($object as $key => $value) {
            if (method_exists($methods, 'set' . ucfirst($key))) {
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

    /**
     * @return Invoices
     */

    public function invoices() : Invoices
    {
        return new Invoices($this);
    }

    /**
     * @return Journals
     */

    public function journals() : Journals
    {
        return new Journals($this);
    }

}