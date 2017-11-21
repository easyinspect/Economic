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

class BillingContacts
{
    /** @var Customer $customer */
    private $customer;
    /** @var int $customerContactNumber */
    private $customerContactNumber;
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

    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function all(int $customerNumber)
    {
        $contacts = $this->api->retrieve('/customers/'.$customerNumber.'/contacts');
        $this->api->setObject($contacts, $this);

        return $contacts;
    }

    public function get(int $customerContactNumber, int $customerNumber)
    {
        $contact = $this->api->retrieve('/customers/'.$customerNumber.'/contacts/'.$customerContactNumber);
        $this->api->setObject($contact, $this);

        return $this;
    }

    public function create(int $customerNumber)
    {
        $data = [
            'customer' => $this->getCustomer(),
            'eInvoiceId' => $this->getEInvoiceId(),
            'email' => $this->getEmail(),
            'emailNotifications' => $this->getEmailNotifications(),
            'name' => $this->getName(),
            'notes' => $this->getNote(),
            'phone' => $this->getPhone(),
        ];

        $contact = $this->api->create('/customers/'.$customerNumber.'/contacts', array_filter($data));
        $this->api->setObject($contact, $this);

        return $this;
    }

    public function update()
    {
        $data = [
            'customer' => $this->getCustomer(),
            'customerContactNumber' => $this->getCustomerContactNumber(),
            'eInvoiceId' => $this->getEInvoiceId(),
            'email' => $this->getEmail(),
            'emailNotifications' => $this->getEmailNotifications(),
            'name' => $this->getName(),
            'notes' => $this->getNote(),
            'phone' => $this->getPhone(),
        ];

        $contact = $this->api->update('/customers/'.$this->getCustomerNumber().'/contacts/'.$this->getCustomerContactNumber(), array_filter($data));
        $this->api->setObject($contact, $this);

        return $this;
    }

    public function delete()
    {
        $this->api->delete('/customers/'.$this->getCustomerNumber().'/contacts/'.$this->getCustomerContactNumber());

        return $this;
    }

    public function setCustomer($customer)
    {
        $this->customer = new Customer($customer->customerNumber);

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
            $this->customer = new Customer($customerNumber);
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

    public function setEInvoiceId(string $eInvoiceId)
    {
        $this->eInvoiceId = $eInvoiceId;

        return $this;
    }

    public function getEInvoiceId() : ?string
    {
        return $this->eInvoiceId;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmailNotifications(array $notifications)
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

    public function setNote(string $note)
    {
        $this->notes = $note;

        return $this;
    }

    public function getNote() : ?string
    {
        return $this->notes;
    }

    public function setPhone(string $number)
    {
        $this->phone = $number;

        return $this;
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }
}
