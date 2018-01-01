<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06.
 */

namespace Economic\Models\Components\Company;

class Details
{
    /** @var string $addressLine1 */
    public $addressLine1;
    /** @var string $addressLine2 */
    public $addressLine2;
    /** @var string $attention */
    public $attention;
    /** @var string $city */
    public $city;
    /** @var string $companyIdentificationNumber */
    public $companyIdentificationNumber;
    /** @var string $country */
    public $country;
    /** @var string $email */
    public $email;
    /** @var string $name */
    public $name;
    /** @var string $phoneNumber */
    public $phoneNumber;
    /** @var string $vatNumber */
    public $vatNumber;
    /** @var string $website */
    public $website;
    /** @var string $zip */
    public $zip;

    public function __construct(string $addressLine1 = null, string $addressLine2 = null, string $attention = null, string $city = null, string $companyIdentificationNumber = null, string $country = null, string $email = null, string $name = null, string $phoneNumber = null, string $vatNumber = null, string $website = null, string $zip = null)
    {
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->attention = $attention;
        $this->city = $city;
        $this->companyIdentificationNumber = $companyIdentificationNumber;
        $this->country = $country;
        $this->email = $email;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->vatNumber = $vatNumber;
        $this->website = $website;
        $this->zip = $zip;
    }
}
