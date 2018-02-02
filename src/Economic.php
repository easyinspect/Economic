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
use Economic\Models\Company;
use Economic\Models\Invoice;
use Economic\Models\Journal;
use Economic\Models\Product;
use Economic\Models\Currency;
use Economic\Models\Customer;
use Economic\Models\PaymentType;
use Economic\Models\DraftInvoice;
use Economic\Models\BillingContact;
use Economic\Models\AccountingYears;
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

    /**
     * @param string $appSecretToken
     * @param string $agreementGrantToken
     */
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

    /**
     * @param string $url
     * @param $model
     * @param int $skipPages
     * @param int $pageSize
     * @param bool $recursive
     * @throws EconomicRequestException
     * @throws EconomicServerException
     * @throws EconomicConnectionException
     * @return array
     */
    public function collection(string $url, $model, int $skipPages = 0, int $pageSize = 20, bool $recursive = true) : array
    {
        try {
            $data = \GuzzleHttp\json_decode($this->client->get($url.'skippages='.$skipPages.'&pagesize='.$pageSize, $this->headers)->getBody()->getContents());

            if ($recursive && isset($data->pagination->nextPage)) {
                $collection = $this->collection($url, $model, $skipPages + 1, $pageSize, $recursive);
                $data->collection = array_merge($data->collection, $collection);
            }

            $data->collection = array_map(function ($item) use ($model) {
                return $model::transform($this, $item);
            }, $data->collection);

            return $data->collection;
        } catch (ClientException $exception) {
            throw new EconomicRequestException($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    /**
     * @param string $url
     * @throws EconomicRequestException
     * @throws EconomicServerException
     * @throws EconomicConnectionException
     * @return mixed
     */
    public function get(string $url) : mixed
    {
        try {
            return \GuzzleHttp\json_decode($this->client->get($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new EconomicRequestException($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    /**
     * @param string $url
     * @throws EconomicRequestException
     * @throws EconomicServerException
     * @throws EconomicConnectionException
     * @return mixed
     */
    public function download(string $url) : mixed
    {
        try {
            return $this->client->get($url, $this->headers)->getBody()->getContents();
        } catch (ClientException $exception) {
            throw new EconomicRequestException($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    /**
     * @param string $url
     * @param \stdClass $body
     * @throws EconomicRequestException
     * @throws EconomicServerException
     * @throws EconomicConnectionException
     * @return mixed
     */
    public function create(string $url, \stdClass $body) : mixed
    {
        try {
            $this->headers['body'] = json_encode($body);

            return \GuzzleHttp\json_decode($this->client->post($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new EconomicRequestException($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    /**
     * @param string
     * @param \stdClass $body
     * @throws EconomicRequestException
     * @throws EconomicServerException
     * @throws EconomicConnectionException
     * @return mixed
     */
    public function update(string $url, \stdClass $body) : mixed
    {
        try {
            $this->headers['body'] = \GuzzleHttp\json_encode($body);

            return \GuzzleHttp\json_decode($this->client->put($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new EconomicRequestException($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
    }

    /**
     * @param string
     * @throws EconomicRequestException
     * @throws EconomicServerException
     * @throws EconomicConnectionException
     * @return mixed
     */
    public function delete(string $url) : mixed
    {
        try {
            return $this->client->delete($url, $this->headers);
        } catch (ClientException $exception) {
            throw new EconomicRequestException($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new EconomicServerException();
        } catch (ConnectException $exception) {
            throw new EconomicConnectionException();
        }
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
     * @return draftInvoice
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

    public function accountingYears() : AccountingYears
    {
    }

    /**
     * @return Company
     */
    public function company() : Company
    {
        return new Company($this);
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
        foreach ($arr as $key => $item) {
            if (is_object($item)) {
                $this->cleanObject($item);
            }

            if (is_array($item)) {
                $this->cleanArray($item);
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
}
