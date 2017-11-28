<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 12:58
 */

namespace Economic\Models\Components;

class Recipient
{
    /** @var string $address */
    public $address;
    /** @var Attention $attention */
    public $attention;
    /** @var string $city */
    public $city;
    /** @var string $country */
    public $country;
    /** @var string $ean */
    public $ean;
    /** @var string $name */
    public $name;
    /** @var string $publicEntryNumber */
    public $publicEntryNumber;
    /** @var VatZone $vatZone */
    public $vatZone;
    /** @var string $zip */
    public $zip;

    public function __construct(string $address = null, $attention = null, string $city = null, string $country = null, string $ean = null, string $name = null, string $publicEntryNumber = null, $vatZone = null, string $zip = null)
    {
        $this->address = $address;
        $this->attention = new Attention($attention->customerContactNumber, $attention->self);
        $this->city = $city;
        $this->country = $country;
        $this->ean = $ean;
        $this->name = $name;
        $this->publicEntryNumber = $publicEntryNumber;
        $this->vatZone = new VatZone($vatZone->vatZoneNumber, $vatZone->self);
        $this->zip = $zip;

    }


}