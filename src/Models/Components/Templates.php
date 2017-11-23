<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Templates
{
    /** @var string $heading */
    public $self;

    public function __construct(?string $self)
    {
        $this->self = $self;
    }

}