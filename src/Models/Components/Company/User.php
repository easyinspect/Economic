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

    public function __construct(int $agreementNumber, string $email, $language, string $loginId, string $name)
    {
        $this->agreementNumber = $agreementNumber;
        $this->email = $email;
        $this->language = new Language($language->languageNumber, $language->name, $language->self);
        $this->loginId = $loginId;
        $this->name = $name;
    }
}
