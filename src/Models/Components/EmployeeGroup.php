<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class EmployeeGroup
{
    /** @var int $employeeGroupNumber */
    public $employeeGroupNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $employeeGroupNumber = null, string $self = null)
    {
        $this->employeeGroupNumber = $employeeGroupNumber;
        $this->self = $self;
    }
}
