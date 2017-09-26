<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:44
 */

namespace Economic\Models\Components;


class Layout
{

    public $layoutNumber;

    public function __construct($layoutNumber)
    {
        $this->layoutNumber = $layoutNumber;
    }

}