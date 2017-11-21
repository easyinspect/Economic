<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 14:26.
 */

namespace Economic\Models\Components;

class SalesPerson
{
    /** @var int $employeeNumber */
    public $employeeNumber;

    public function __construct(int $employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;
    }
}
