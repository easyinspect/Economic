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
    private $listener;

    public function __construct(RespondToSchema $listener)
    {
        $this->listener = $listener;
    }

    public function all()
    {
        $currencies = $this->listener->retrieve('/currencies');
        return $currencies;
    }

    public function get(string $code)
    {
        $currency = $this->listener->retrieve('/currencies/' . $code);
        return $currency;
    }

}