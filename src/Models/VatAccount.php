<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\Account;
use Economic\Models\Components\ContraAccount;

class VatAccount
{
    /** @var Account $account */
    private $account;
    /** @var bool $barred */
    private $barred;
    /** @var ContraAccount $contraAccount */
    private $contraAccount;
    /** @var string $name */
    private $name;
    /** @var int $ratePercentage */
    private $ratePercentage;
    /** @var string $vatCode */
    private $vatCode;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * VatAccount constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into VatAccount.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return VatAccount
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $vatAccount = new self($economic);

        return $vatAccount;
    }

    /**
     * Retrieves a collection of VatAccounts.
     * @param Filter $filter
     * @return VatAccount
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/vat-accounts?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/vat-accounts?', $this);
        }
    }

    /**
     * Retrieves a single VatAccount by its id.
     * @param int $id
     * @return VatAccount
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/vat-accounts/'.$id));
    }

    // Setters & Getters

    /**
     * @return Account|null
     */
    public function getAccount() : ?Account
    {
        return $this->account;
    }

    /**
     * @param \stdClass $stdClass
     * @return VatAccount
     */
    public function setAccount(\stdClass $stdClass)
    {
        $this->account = new Account($stdClass->accountNumber, $stdClass->self);

        return $this;
    }

    public function getBarred() : ?bool
    {
        return $this->barred;
    }

    public function setBarred(bool $barred = null)
    {
        $this->barred = $barred;

        return $this;
    }

    public function getContraAccount() : ?ContraAccount
    {
        return $this->contraAccount;
    }

    public function setContraAccount(\stdClass $stdClass)
    {
        $this->contraAccount = new ContraAccount($stdClass->accountNumber, $stdClass->self);

        return $this;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getRatePercentage() : ?int
    {
        return $this->ratePercentage;
    }

    public function setRatePercentage(int $ratePercentage)
    {
        $this->ratePercentage = $ratePercentage;

        return $this;
    }

    public function getVatCode() : ?string
    {
        return $this->vatCode;
    }

    public function setVatCode(string $vatCode)
    {
        $this->vatCode = $vatCode;

        return $this;
    }

    public function getSelf() : ?string
    {
        return $this->self;
    }

    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
