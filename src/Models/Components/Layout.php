<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 14:21
 */

namespace Economic\Models\Components;

class Layout
{
    public $layoutNumber;

    public function __construct($layout)
    {
        $this->layoutNumber = $layout;
    }

}