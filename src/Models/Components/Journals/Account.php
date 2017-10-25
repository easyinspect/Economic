<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-10-2017
 * Time: 14:55
 */

namespace Economic\Models\Components\Journals;


class Account
{
    public $accountNumber;

    public function __construct($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }
}