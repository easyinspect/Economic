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

    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function parse($api, $object)
    {
        $billingContacts = new self($api);

        $billingContacts->setCustomerContactNumber($object->customerContactNumber);
        $billingContacts->setCustomer($object->customer);
        $billingContacts->setEInvoiceId($object->eInvoiceId ?? null);
        $billingContacts->setEmail($object->email ?? null);
        $billingContacts->setEmailNotifications($object->emailNotifications ?? null);
        $billingContacts->setName($object->name);
        $billingContacts->setNote($object->notes ?? null);
        $billingContacts->setPhone($object->phone ?? null);
        $billingContacts->setSelf($object->self);

        return $billingContacts;
    }

    public function all(int $customerNumber, $pageSize = 20, $skipPages = 0, $recursive = true)
    {
        $contacts = $this->api->retrieve('/customers/'.$customerNumber.'/contacts?skippages='.$skipPages.'&pagesize='.$pageSize.'');

        if ($recursive && isset($contacts->pagination->nextPage)) {
            $collection = $this->all($customerNumber, $pageSize, $skipPages + 1);
            $contacts->collection = array_merge($contacts->collection, $collection);
        }

        $contacts->collection = array_map(function ($item) {
            return self::parse($this->api, $item);
        }, $contacts->collection);

        return $contacts->collection;
    }

    public function get(int $customerContactNumber, int $customerNumber)
    {
        $contact = $this->api->retrieve('/customers/'.$customerNumber.'/contacts/'.$customerContactNumber);
        return self::parse($this->api, $contact);
    }

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

        $this->api->cleanObject($data);

        $contact = $this->api->create('/customers/'.$customerNumber.'/contacts', $data);
        return self::parse($this->api, $contact);
    }

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

        $this->api->cleanObject($data);
        $this->api->update('/customers/'.$this->getCustomerNumber().'/contacts/'.$this->getCustomerContactNumber(), $data);

        return $this;
    }

    public function delete()
    {
        $this->api->delete('/customers/'.$this->getCustomerNumber().'/contacts/'.$this->getCustomerContactNumber());

        return $this;
    }

    public function setCustomer($customer)
    {
        $this->customer = new Customer($customer->customerNumber, $customer->self);

        return $this;
    }

    public function getCustomer() : ?Customer
    {
        return $this->customer;
    }

    public function setCustomerNumber(int $customerNumber)
    {
        if (isset($this->customer)) {
            $this->customer->customerNumber = $customerNumber;
        } else {
            $this->customer = $this->api->setClass('Customer', 'customerNumber');
            $this->customer->customerNumber = $customerNumber;
        }

        return $this;
    }

    public function getCustomerNumber() : ?int
    {
        if (isset($this->customer)) {
            return $this->customer->customerNumber;
        }

        return null;
    }

    public function setCustomerContactNumber(int $customerContactNumber)
    {
        $this->customerContactNumber = $customerContactNumber;

        return $this;
    }

    public function getCustomerContactNumber() : ?int
    {
        return $this->customerContactNumber;
    }

    public function setEInvoiceId(?string $eInvoiceId)
    {
        $this->eInvoiceId = $eInvoiceId;

        return $this;
    }

    public function getEInvoiceId() : ?string
    {
        return $this->eInvoiceId;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmailNotifications(?array $notifications)
    {
        $this->emailNotifications = $notifications;

        return $this;
    }

    public function getEmailNotifications() : ?array
    {
        return $this->emailNotifications;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setNote(?string $note)
    {
        $this->notes = $note;

        return $this;
    }

    public function getNote() : ?string
    {
        return $this->notes;
    }

    public function setPhone(?string $number)
    {
        $this->phone = $number;

        return $this;
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }

    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }

    public function getSelf() : string
    {
        return $this->self;
    }
}
