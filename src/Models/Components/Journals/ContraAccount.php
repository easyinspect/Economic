<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-10-2017
 * Time: 12:45
 */

namespace Economic\Models\Components\Journals;


class ContraAccount
{
    public $accountNumber;

    public function __construct($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }
}