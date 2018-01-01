<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06.
 */

namespace Economic\Models\Components\Company;

class Application
{
    /** @var int $appNumber */
    public $appNumber;
    /** @var string $appPublicToken */
    public $appPublicToken;
    /** @var string $created */
    public $created;
    /** @var string $name */
    public $name;
    /** @var array $requiredRoles */
    public $requiredRoles = [];
    /** @var string $self */
    public $self;

    public function __construct(int $appNumber, string $appPublicToken, string $created, string $name, $requiredRoles, string $self)
    {
        $this->appNumber = $appNumber;
        $this->appPublicToken = $appPublicToken;
        $this->created = $created;
        $this->name = $name;
        $this->requiredRoles[] = $requiredRoles;
        $this->self = $self;
    }
}
