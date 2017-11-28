<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 11:22
 */

namespace Economic\Models\Components;

class VatZone
{
    /** @var int $vatZoneNumber */
    public $vatZoneNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $vatZoneNumber = null, string $self = null)
    {
        $this->vatZoneNumber = $vatZoneNumber;
        $this->self = $self;
    }

}