<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32
 */

namespace Economic\Models\Components;

class AccountingYear
{
    public $year;

    public function __construct(string $year)
    {
        $this->year = $year;
    }
}