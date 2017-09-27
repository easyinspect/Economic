<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05
 */

namespace Economic\Models;


class Currency
{
    private $api;

    public function __construct(RespondToSchema $api)
    {
        $this->api = $api;
    }

    public function all()
    {
        $currencies = $this->api->retrieve('/currencies');
        return $currencies;
    }

    public function get(string $code)
    {
        $currency = $this->api->retrieve('/currencies/' . $code);
        return $currency;
    }

}