<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\AccountingYear;

class Department
{
    /** @var int $departmentNumber */
    public $departmentNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $departmentNumber = null, string $self = null)
    {
        $this->departmentNumber = $departmentNumber;
        $this->self = $self;
    }
}
