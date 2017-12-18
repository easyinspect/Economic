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
    /** @var string $culture */
    public $culture;
    /** @var string $name */
    public $name;
    /** @var string $self */
    public $self;

    public function __construct(int $languageNumber = null, string $culture = null, string $name = null, string $self = null)
    {
        $this->languageNumber = $languageNumber;
        $this->culture = $culture;
        $this->name = $name;
        $this->self = $self;
    }
}
