<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-10-2017
 * Time: 12:46
 */

namespace Economic\Models\Components\Journals;


class Currency
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

}