<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 12:09.
 */

namespace Economic;

use GuzzleHttp\Client;
use Economic\Models\Units;
use Economic\Models\Layouts;
use Economic\Models\Currency;
use Economic\Models\Customer;
use Economic\Models\Invoices;
use Economic\Models\Journals;
use Economic\Models\Products;
use Economic\Models\PaymentTypes;
use Economic\Models\DraftInvoices;
use Economic\Models\BillingContacts;
use Economic\Models\CustomerCollection;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Economic\Exceptions\EconomicServerException;
use Economic\Exceptions\EconomicRequestException;
use Economic\Exceptions\EconomicConnectionException;

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
    /** @var \ReflectionMethod $reflectionMethod */
    private $reflectionMethod;

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
                'Content-Type' => $this->contentType,
            ],
        ];
    }

    public function retrieve($url)
    {
        try {
            return \GuzzleHttp\json_decode($this->client->get($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new EconomicRequestException();
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    public function download($url)
    {
        try {
            return $this->client->get($url, $this->headers)->getBody()->getContents();
        } catch (ClientException $exception) {
            throw new EconomicRequestException();
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    public function create($url, $body)
    {
        try {
            $this->headers['body'] = \GuzzleHttp\json_encode($body);

            return \GuzzleHttp\json_decode($this->client->post($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new EconomicRequestException();
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    public function update($url, $body)
    {
        try {
            $this->headers['body'] = \GuzzleHttp\json_encode($body);

            return \GuzzleHttp\json_decode($this->client->put($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new EconomicRequestException();
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    public function delete($url)
    {
        try {
            return $this->client->delete($url, $this->headers);
        } catch (ClientException $exception) {
            throw new EconomicRequestException();
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    public function setObject($object, $methods)
    {
        foreach ($object as $key => $value) {
            if (method_exists($methods, 'set'.ucfirst($key))) {
                $methods->{'set'.ucfirst($key)}($value);
            }
        }

        return $this;
    }

    public function setClass($name, $property, $object = null)
    {
        $class = __NAMESPACE__.'\Models\Components\\'.$name;

        $this->reflectionMethod = new \ReflectionMethod($class, '__construct');

        $class = new $class;

        foreach ($this->reflectionMethod->getParameters() as $key => $value) {
            if ($value->name != $property) {
                unset($class->{$value->name});
            }
        }

        if (is_object($class->{$property})) {
            unset($class->{$property}->self);
        }

        if (isset($object->{strtolower($name)})) {
            $array = (array) $class;

            $map = array_merge($array, (array) $object->{strtolower($name)});

            foreach ($map as $key => $value) {
                $class->{$key} = $value;
            }
        }

        return $class;
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

    /**
     * @return BillingContacts
     */
    public function billingContacts() : BillingContacts
    {
        return new BillingContacts($this);
    }
}
