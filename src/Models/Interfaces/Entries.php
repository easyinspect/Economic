<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 10:41
 */

namespace Economic\Models\Interfaces;

interface Entries
{
    public function __construct($amount, $accountNumber, $currency, $date, $account = null, $invoiceNumber = null);
}