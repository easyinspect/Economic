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

    private $listener;

    public function __construct(RespondToSchema $listener)
    {
        $this->listener = $listener;
    }

    public function all()
    {
        $paymentTypes = $this->listener->retrieve('/payment-types');
        return $paymentTypes;
    }

    public function get($id)
    {
        $paymentType = $this->listener->retrieve('/payment-types/' . $id);
        return $paymentType;
    }

}