<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-10-2017
 * Time: 14:15.
 */

namespace Economic\Models\Components\Journals;

interface Entries
{
    public function __construct($amount, $contraAccount, $currency, $date, $account = null, $invoiceNumber = null);
}
