<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 12:09.
 */

namespace Economic;

use GuzzleHttp\Client;
use Economic\Models\Unit;
use Economic\Models\Layout;
use Economic\Models\Invoice;
use Economic\Models\Journal;
use Economic\Models\Product;
use Economic\Models\Currency;
use Economic\Models\Customer;
use Economic\Models\PaymentType;
use Economic\Models\DraftInvoice;
use Economic\Models\BillingContact;
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
            $this->handleRequestException($exception);
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
            $this->handleRequestException($exception);
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    public function create($url, $body)
    {
        try {
            $this->headers['body'] = json_encode($body);

            return \GuzzleHttp\json_decode($this->client->post($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            $this->handleRequestException($exception);
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    public function update($url, \stdClass $body)
    {
        try {
            $this->headers['body'] = \GuzzleHttp\json_encode($body);

            return \GuzzleHttp\json_decode($this->client->put($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            $this->handleRequestException($exception);
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
            $this->handleRequestException($exception);
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    /**
     * @return Customer
     */
    public function customer(): Customer
    {
        return new Customer($this);
    }

    /**
     * @return CustomerCollection
     */
    public function customerCollection(): CustomerCollection
    {
        return new CustomerCollection($this);
    }

    /**
     * @return Unit
     */
    public function units(): Unit
    {
        return new Unit($this);
    }

    /**
     * @return Product
     */
    public function products(): Product
    {
        return new Product($this);
    }

    /**
     * @return PaymentType
     */
    public function paymentTypes(): PaymentType
    {
        return new PaymentType($this);
    }

    /**
     * @return Currency
     */
    public function currency(): Currency
    {
        return new Currency($this);
    }

    /**
     * @return Layout
     */
    public function layouts(): Layout
    {
        return new Layout($this);
    }

    /**
     * @return DraftInvoice
     */
    public function draftInvoices(): DraftInvoice
    {
        return new DraftInvoice($this);
    }

    /**
     * @return Invoice
     */
    public function invoices(): Invoice
    {
        return new Invoice($this);
    }

    /**
     * @return Journal
     */
    public function journals(): Journal
    {
        return new Journal($this);
    }

    /**
     * @return BillingContact
     */
    public function billingContacts(): BillingContact
    {
        return new BillingContact($this);
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

    public function cleanObject($obj)
    {
        foreach ($obj as $key => $value) {
            if (is_object($value)) {
                $this->cleanObject($value);
            }

            if (is_array($value)) {
                $this->cleanArray($value);
            }

            $this->filterData($obj, $key, $value);
        }
    }

    protected function cleanArray(array $arr)
    {
        foreach ($arr as $item) {
            if (is_object($item)) {
                $this->cleanObject($item);
            }
        }
    }

    protected function filterData($obj, $property, $value)
    {
        if ($property == 'self') {
            unset($obj->{$property});
        }

        if (is_null($value)) {
            unset($obj->{$property});
        }
    }

    protected function handleRequestException($exception)
    {
        $body = json_decode($exception->getResponse()->getBody()->getContents());

        $message = $body->message;

        if (isset($body->errors) && is_array($body->errors)) {
            foreach ($body->errors as $error) {
                $message .= ' '.$error;
            }
        }

        if (isset($body->errors)) {
            foreach ($body->errors as $key => $value) {
                foreach ($value->errors as $error) {
                    $message .= ' '.$error->errorMessage;
                }
            }
        }

        throw new EconomicRequestException($message, $exception->getResponse()->getStatusCode());
    }
}
