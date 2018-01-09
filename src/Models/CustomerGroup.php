<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Validations\CustomerGroupValidator;
use Economic\Models\Components\CustomerGroup\Account;

class CustomerGroup
{
    /** @var Account $account */
    private $account;
    /** @var int $customerGroupNumber */
    private $customerGroupNumber;
    /** @var string $customers */
    private $customers;
    /** @var Layout $layout */
    private $layout;
    /** @var string $name */
    private $name;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * CustomerGroup constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into CustomerGroup.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return CustomerGroup
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $customerGroup = new self($economic);

        $customerGroup->setCustomerGroupNumber($stdClass->customerGroupNumber);
        $customerGroup->setCustomers($stdClass->customers);
        $customerGroup->setLayout($stdClass->layout ?? null);
        $customerGroup->setAccount($stdClass->account);
        $customerGroup->setName($stdClass->name);
        $customerGroup->setSelf($stdClass->self);

        return $customerGroup;
    }

    /**
     * Retrieves a collection of CustomerGroups.
     * @param Filter $filter
     * @return CustomerGroup
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/customer-groups?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/customer-groups?', $this);
        }
    }

    /**
     * Retrieves a single CustomerGroup by ID.
     * @param int $id
     * @return CustomerGroup
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/customer-groups/'.$id));
    }

    /**
     * Retrieves a collection of Customers that belongs to the given CustomerGroup.
     * @return CustomerGroup
     */
    public function customers()
    {
        return $this->economic->collection('/customer-groups/'.$this->getCustomerGroupNumber().'/customers?', new Customer($this->economic));
    }

    /**
     * Deletes a CustomerGroup
     * Requires CustomerGroups's get(id) method in order to perform this.
     */
    public function delete()
    {
        return $this->economic->delete('/customer-groups/'.$this->getCustomerGroupNumber());
    }

    /**
     * Updates a CustomerGroup by its ID.
     * @return CustomerGroup
     */
    public function update()
    {
        $data = (object) [
            'account' => $this->getAccount(),
            'customerGroupNumber' => $this->getCustomerGroupNumber(),
            'layout' => $this->getLayout(),
            'name' => $this->getName(),
        ];

        return self::transform($this->economic, $this->economic->update('/customer-groups/'.$this->getCustomerGroupNumber(), $data));
    }

    /**
     * Creates a CustomerGroup.
     * @return CustomerGroup
     */
    public function create()
    {
        $data = (object) [
            'account' => $this->getAccount(),
            'customerGroupNumber' => $this->getCustomerGroupNumber(),
            'layout' => $this->getLayout(),
            'name' => $this->getName(),
        ];

        $validator = CustomerGroupValidator::getValidator();

        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->create('/customer-groups', $data));
    }

    // Getters & Setters

    /**
     * @return int
     */
    public function getCustomerGroupNumber() : ?int
    {
        return $this->customerGroupNumber;
    }

    /**
     * @param int $customerGroupNumber
     * @return CustomerGroup
     */
    public function setCustomerGroupNumber(int $customerGroupNumber)
    {
        $this->customerGroupNumber = $customerGroupNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomers() : ?string
    {
        return $this->customers;
    }

    /**
     * @param string $customers
     * @return CustomerGroup
     */
    public function setCustomers(string $customers)
    {
        $this->customers = $customers;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CustomerGroup
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return CustomerGroup
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }

    /**
     * @return Layout
     */
    public function getLayout() : ?Layout
    {
        return $this->layout;
    }

    /**
     * @param \stdClass $layout
     * @return CustomerGroup
     */
    public function setLayout(\stdClass $layout = null)
    {
        if (isset($layout)) {
            $this->layout = Layout::transform($this->economic, $layout);
        }

        return $this;
    }

    /**
     * @return Account
     */
    public function getAccount() : ?Account
    {
        return $this->account;
    }

    /**
     * @param \stdClass $account
     * @return CustomerGroup
     */
    public function setAccount(\stdClass $account = null)
    {
        if (isset($account)) {
            $this->account = new Account($account->accountingYears, $account->accountNumber, $account->accountType, $account->balance, $account->blockDirectEntries, $account->debitCredit, $account->name, $account->self);
        }

        return $this;
    }

    /**
     * @return int
     * */
    public function getAccountNumber() : ?int
    {
        if (isset($this->account)) {
            return $this->account->accountNumber;
        }

        return null;
    }

    /**
     * @param int $accountNumber
     * @return CustomerGroup
     */
    public function setAccountNumber(int $accountNumber)
    {
        if (isset($this->account)) {
            $this->account->accountNumber = $accountNumber;
        } else {
            $this->account = $this->economic->setClass('CustomerGroup\Account', 'accountNumber');
            $this->account->accountNumber = $accountNumber;
        }

        return $this;
    }
}
