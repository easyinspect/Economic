<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class RequiredModules
{
    /** @var int $moduleNumber */
    public $moduleNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $moduleNumber = null, string $self = null)
    {
        $this->moduleNumber = $moduleNumber;
        $this->self = $self;
    }
}
