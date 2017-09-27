<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 16:49
 */

namespace Economic\Models;


class PaymentTypes
{

    private $api;

    public function __construct(RespondToSchema $api)
    {
        $this->api = $api;
    }

    public function all()
    {
        $paymentTypes = $this->api->retrieve('/payment-types');
        return $paymentTypes;
    }

    public function get($id)
    {
        $paymentType = $this->api->retrieve('/payment-types/' . $id);
        return $paymentType;
    }

}