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
    /** @var int $layoutNumber */
    public $layoutNumber;

    public function __construct(int $layoutNumber)
    {
        $this->layoutNumber = $layoutNumber;
    }

}