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
use Economic\Models\Components\EmployeeGroup;

class Employee
{
    /** @var bool $barred */
    private $barred;
    /** @var string $bookedInvoices */
    private $bookedInvoices;
    /** @var string $customers */
    private $customers;
    /** @var string $draftInvoices */
    private $draftInvoices;
    /** @var string $email */
    private $email;
    /** @var EmployeeGroup $employeeGroup */
    private $employeeGroup;
    /** @var int $employeeNumber */
    private $employeeNumber;
    /** @var string $name */
    private $name;
    /** @var string $phone */
    private $phone;
    /** @var string */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * Employee constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Employee.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Employee
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $employee = new self($economic);

        $employee->setBarred($stdClass->barred ?? null);
        $employee->setBookedInvoices($stdClass->bookedInvoices);
        $employee->setCustomers($stdClass->customers);
        $employee->setDraftInvoices($stdClass->draftInvoices);
        $employee->setEmail($stdClass->email ?? null);
        $employee->setEmployeeGroup($stdClass->employeeGroup);
        $employee->setEmployeeNumber($stdClass->employeeNumber);
        $employee->setName($stdClass->name);
        $employee->setPhone($stdClass->phone ?? null);
        $employee->setSelf($stdClass->self);

        return $employee;
    }

    /**
     * Retrieves a collection of Employees.
     * @param Filter $filter
     * @return Employee
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/employees?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/employees?', $this);
        }
    }

    /**
     * Retrieves a single Employee by its employeeNumber.
     * @param int $employeeNumber
     * @return Employee
     */
    public function get(int $employeeNumber)
    {
        return self::transform($this->economic, $this->economic->get('/employees/'.$employeeNumber));
    }

    /**
     * Retrieves a collection of Customers that belongs to the given Employee.
     * @return Customer
     */
    public function customers()
    {
        return $this->economic->collection('/employees/'.$this->getEmployeeNumber().'/customers?', new Customer($this->economic));
    }

    // Setters & Getters

    /**
     * @return bool|null
     */
    public function getBarred() : ?bool
    {
        return $this->barred;
    }

    /**
     * @param bool $barred
     * @return Employee
     */
    public function setBarred(bool $barred = null)
    {
        $this->barred = $barred;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBookedInvoices() : ?string
    {
        return $this->bookedInvoices;
    }

    /**
     * @param string $bookedInvoices
     * @return Employee
     */
    public function setBookedInvoices(string $bookedInvoices)
    {
        $this->bookedInvoices = $bookedInvoices;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomers() : ?string
    {
        return $this->customers;
    }

    /**
     * @param string $customers
     * @return Employee
     */
    public function setCustomers(string $customers)
    {
        $this->customers = $customers;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDraftInvoices() : ?string
    {
        return $this->draftInvoices;
    }

    /**
     * @param string $draftInvoices
     * @return Employee
     */
    public function setDraftInvoices(string $draftInvoices)
    {
        $this->draftInvoices = $draftInvoices;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Employee
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return EmployeeGroup|null
     */
    public function getEmployeeGroup() : ?EmployeeGroup
    {
        return $this->employeeGroup;
    }

    /**
     * @param \stdClass $stdClass
     * @return Employee
     */
    public function setEmployeeGroup(\stdClass $stdClass)
    {
        $this->employeeGroup = new EmployeeGroup($stdClass->employeeGroupNumber, $stdClass->self);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEmployeeNumber() : ?int
    {
        return $this->employeeNumber;
    }

    /**
     * @param int $employeeNumber
     * @return Employee
     */
    public function setEmployeeNumber(int $employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Employee
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone() : ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Employee
     */
    public function setPhone(string $phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return Employee
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
