<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class Currency
{
    /** @var string $code */
    public $code;
    /** @var string $self */
    public $self;

    public function __construct(string $code = null, string $self = null)
    {
        $this->code = $code;
        $this->self = $self;
    }
}
