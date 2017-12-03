<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 15:16.
 */

namespace Economic\Models\Components;

class VendorReference
{
    /** @var int $employeeNumber */
    public $employeeNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $employeeNumber = null, string $self = null)
    {
        $this->employeeNumber = $employeeNumber;
        $this->self = $self;
    }
}
