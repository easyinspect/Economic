<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 14:26
 */

namespace Economic\Models\Components;

class SalesPerson
{
    public $employeeNumber;

    public function __construct($salesPerson)
    {
        $this->employeeNumber = $salesPerson;
    }

}