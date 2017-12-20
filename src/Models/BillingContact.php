<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-11-2017
 * Time: 15:39.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\Customer;
use Economic\Validations\BillingContactValidator;

class BillingContact
{
    /** @var int $customerContactNumber */
    private $customerContactNumber;
    /** @var Customer $customer */
    private $customer;
    /** @var string $eInvoiceId */
    private $eInvoiceId;
    /** @var string $email */
    private $email;
    /** @var array $emailNotifications */
    private $emailNotifications;
    /** @var string $name */
    private $name;
    /** @var string $notes */
    private $notes;
    /** @var string $phone */
    private $phone;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * BillingContact constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass into BillingContact
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return BillingContact
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $billingContacts = new self($economic);

        $billingContacts->setCustomerContactNumber($stdClass->customerContactNumber);
        $billingContacts->setCustomer($stdClass->customer);
        $billingContacts->setEInvoiceId($stdClass->eInvoiceId ?? null);
        $billingContacts->setEmail($stdClass->email ?? null);
        $billingContacts->setEmailNotifications($stdClass->emailNotifications ?? null);
        $billingContacts->setName($stdClass->name);
        $billingContacts->setNote($stdClass->notes ?? null);
        $billingContacts->setPhone($stdClass->phone ?? null);
        $billingContacts->setSelf($stdClass->self);

        return $billingContacts;
    }

    /**
     * Retrieves a collection of BillingContact(s)
     * @param int $customerNumber
     * @return BillingContact
     */
    public function all(int $customerNumber)
    {
        return $this->economic->collection('/customers/'.$customerNumber.'/contacts?', $this);
    }

    /**
     * Retrieve a single BillingContact by customerNumber & customerContactNumber
     * @param int $customerNumber
     * @param int $customerContactNumber
     * @return BillingContact
     */
    public function get(int $customerContactNumber, int $customerNumber)
    {
        return self::transform($this->economic, $this->economic->get('/customers/'.$customerNumber.'/contacts/'.$customerContactNumber));
    }

    /**
     * Creates a BillingContact
     * @param int $customerNumber
     * @return BillingContact
     */
    public function create(int $customerNumber)
    {
        $data = (object) [
            'customer' => $this->getCustomer(),
            'eInvoiceId' => $this->getEInvoiceId(),
            'email' => $this->getEmail(),
            'emailNotifications' => $this->getEmailNotifications(),
            'name' => $this->getName(),
            'notes' => $this->getNote(),
            'phone' => $this->getPhone(),
        ];

        $this->economic->cleanObject($data);

        $validator = BillingContactValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->create('/customers/'.$customerNumber.'/contacts', $data));
    }

    /**
     * Updates a BillingContact
     * @return BillingContact
     */
    public function update()
    {
        $data = (object) [
            'customer' => $this->getCustomer(),
            'customerContactNumber' => $this->getCustomerContactNumber(),
            'eInvoiceId' => $this->getEInvoiceId(),
            'email' => $this->getEmail(),
            'emailNotifications' => $this->getEmailNotifications(),
            'name' => $this->getName(),
            'notes' => $this->getNote(),
            'phone' => $this->getPhone(),
        ];

        $this->economic->cleanObject($data);

        return self::transform($this->economic, $this->economic->update('/customers/'.$this->getCustomerNumber().'/contacts/'.$this->getCustomerContactNumber(), $data));
    }

    /**
     * Deletes a BillingContact
     * Required the get(id) method in order to perform this.
     */
    public function delete()
    {
        return $this->economic->delete('/customers/'.$this->getCustomerNumber().'/contacts/'.$this->getCustomerContactNumber());
    }

    // Getters & Setters

    /**
     * @param \stdClass $customer
     * @return BillingContact
     */
    public function setCustomer($customer)
    {
        $this->customer = new Customer($customer->customerNumber, $customer->self);

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer() : ?Customer
    {
        return $this->customer;
    }

    /**
     * @param int $customerNumber
     * @return BillingContact
     */
    public function setCustomerNumber(int $customerNumber)
    {
        if (isset($this->customer)) {
            $this->customer->customerNumber = $customerNumber;
        } else {
            $this->customer = $this->economic->setClass('Customer', 'customerNumber');
            $this->customer->customerNumber = $customerNumber;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerNumber() : ?int
    {
        if (isset($this->customer)) {
            return $this->customer->customerNumber;
        }

        return null;
    }

    /**
     * @param int $customerContactNumber
     * @return BillingContact
     */
    public function setCustomerContactNumber(int $customerContactNumber)
    {
        $this->customerContactNumber = $customerContactNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerContactNumber() : ?int
    {
        return $this->customerContactNumber;
    }

    /**
     * @param string $eInvoiceId
     * @return BillingContact
     */
    public function setEInvoiceId(string $eInvoiceId = null)
    {
        $this->eInvoiceId = $eInvoiceId;

        return $this;
    }

    /**
     * @return string
     */
    public function getEInvoiceId() : ?string
    {
        return $this->eInvoiceId;
    }

    /**
     * @param string $email
     * @return BillingContact
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param array $notifications
     * @return BillingContact
     */
    public function setEmailNotifications(array $notifications = null)
    {
        $this->emailNotifications = $notifications;

        return $this;
    }

    /**
     * @return array
     */
    public function getEmailNotifications() : ?array
    {
        return $this->emailNotifications;
    }

    /**
     * @param string $name
     * @return BillingContact
     */
    public function setName(string $name)
    {
        $this->name = $name;

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
     * @param string $note
     * @return BillingContact
     */
    public function setNote(string $note = null)
    {
        $this->notes = $note;

        return $this;
    }

    /**
     * @return string
     */
    public function getNote() : ?string
    {
        return $this->notes;
    }

    /**
     * @param string $number
     * @return BillingContact
     */
    public function setPhone(string $number = null)
    {
        $this->phone = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone() : ?string
    {
        return $this->phone;
    }

    /**
     * @param string $self
     * @return BillingContact
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf() : string
    {
        return $this->self;
    }
}
