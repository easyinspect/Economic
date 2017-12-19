<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06.
 */

namespace Economic\Models\Components\Company;

class User
{
    /** @var int $agreementNumber */
    public $agreementNumber;
    /** @var string $email */
    public $email;
    /** @var Language $language */
    public $language;
    /** @var string $loginId */
    public $loginId;
    /** @var string $name */
    public $name;

    public function __construct(int $agreementNumber = null, string $email = null, $language = null, string $loginId = null, string $name = null)
    {
        $this->agreementNumber = $agreementNumber;
        $this->email = $email;
        $this->language = new Language($language->languageNumber ?? null, $language->culture ?? null, $language->name ?? null, $language->self ?? null);
        $this->loginId = $loginId;
        $this->name = $name;
    }
}
