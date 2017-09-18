<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 14:03
 */

namespace Economic\Models\Components;

class Attention
{
    public $customerContactNumber;

    public function __construct($attention)
    {
        $this->customerContactNumber = $attention;
    }

}