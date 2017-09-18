<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 13:58
 */

namespace Economic\Models\Components;

class DefaultDeliveryLocations
{
    public $deliveryLocationNumber;

    public function __construct($defaultDeliveryLocations)
    {
        $this->deliveryLocationNumber = $defaultDeliveryLocations;
    }

}