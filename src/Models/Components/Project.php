<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Project
{
    /** @var string $heading */
    public $projectNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $projectNumber = null, int $self = null)
    {
        $this->projectNumber = $projectNumber;
        $this->self = $self;
    }

}