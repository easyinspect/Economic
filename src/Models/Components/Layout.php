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
    /** @var string $self */
    public $self;

    public function __construct(int $layoutNumber = null, string $self = null)
    {
        $this->layoutNumber = $layoutNumber;
        $this->self = $self;
    }

}