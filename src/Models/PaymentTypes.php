<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 16:49
 */

namespace Economic\Models;

use Economic\Economic;

class PaymentTypes
{
    /** @var Economic $api*/
    private $api;

    public function __construct(Economic $api)
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