<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 12:09
 */

namespace Economic;

use GuzzleHttp\Client;

class Economic implements RespondToSchema
{

    /* AppSecretToken - IBDTsO7n5FmWF4ms7YlBKScXJV14sqp14mYw3OxbAqU1
     * AgreementGrantToken - UBBtI0nDfUz2lLBMOFvDGdvpjVMkmZgH3SsBu01n5KY1
     * ContentType - application/json
     */

    private $appSecretToken;
    private $agreementGrantToken;
    private $contentType;
    private $baseUrl;

    public function __construct($appSecretToken, $agreementGrantToken, $contentType, $baseUrl)
    {
        $this->appSecretToken = $appSecretToken;
        $this->agreementGrantToken = $agreementGrantToken;
        $this->contentType = $contentType;
        $this->baseUrl = $baseUrl;
    }

    public function retrieve($url)
    {
        $client = new Client([
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->baseUrl
            ]
        ]);

        $response = $client->request('GET', $this->baseUrl . $url);
        $data = json_decode($response->getBody()->getContents());

        return $data;

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete($url)
    {
        $client = new Client([
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->baseUrl
            ]
        ]);

        $client->request('DELETE', $this->baseUrl . $url);

    }

    /**
     * @return Customer
     */

    public function customer() : Customer
    {
        return new Customer($this);
    }

}