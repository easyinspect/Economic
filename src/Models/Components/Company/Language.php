<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06.
 */

namespace Economic\Models\Components\Company;

class Language
{
    /** @var int $languageNumber */
    public $languageNumber;
    /** @var string $name */
    public $name;
    /** @var string $self */
    public $self;

    public function __construct(int $languageNumber, string $name, string $self)
    {
        $this->languageNumber = $languageNumber;
        $this->name = $name;
        $this->self = $self;
    }
}
