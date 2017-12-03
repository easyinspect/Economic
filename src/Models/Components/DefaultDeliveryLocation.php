<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12.
 */

namespace Economic\Models\Components;

class DefaultDeliveryLocation
{
    /** @var int $deliveryLocationNumber */
    public $deliveryLocationNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $deliveryLocationNumber = null, string $self = null)
    {
        $this->deliveryLocationNumber = $deliveryLocationNumber;
        $this->self = $self;
    }
}
