<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 09-10-2017
 * Time: 11:33
 */

namespace Economic\Models\Components;


class DeliveryLocation
{
    public $deliveryLocationNumber;

    public function __construct($deliveryLocationNumber)
    {
        $this->deliveryLocationNumber = $deliveryLocationNumber;
    }

}