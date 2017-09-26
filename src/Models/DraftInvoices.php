<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:09
 */

namespace Economic\Models;

use Economic\Models\Components\Customer;
use Economic\Models\Components\Layout;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\Recipient;
use Economic\Models\Components\SalesPerson;
use Economic\Models\Components\VatZone;
use Economic\Models\Components\VendorReference;

class DraftInvoices
{

    private $currency;
    private $customer;
    private $date;
    private $layout;
    private $paymentTerms;
    private $recipient;
    private $references;

    private $listener;

    public function __construct(RespondToSchema $listener)
    {
        $this->listener = $listener;
    }

    public function processObject($object)
    {
        foreach ($object as $key => $value)
        {
            if (method_exists($this, 'set'.ucfirst($key)))
            {
                $this->{'set' . ucfirst($key)}($value);
            }
        }
        return $this;
    }

    public function get($id)
    {
        $invoice = $this->listener->retrieve('/invoices/drafts/' . $id);
        $this->processObject($invoice);
        return $this;
    }

    // Getters & Setters

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomerNumber()
    {
        if (isset($this->customer)) {
            return $this->customer->customerNumber;
        }
        return null;
    }

    /**
     * @param int $customerNumber
     * @return $this
     */

    public function setCustomerNumber(int $customerNumber)
    {
        if (isset($this->customer)) {
            $this->customer->customerNumber = $customerNumber;
        } else {
            $this->customer = new Customer($customerNumber);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Layout
     */
    public function getLayout() : Layout
    {
        return $this->layout;
    }

    /**
     * @param Layout $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function getLayoutNumber()
    {
        if (isset($this->layout)) {
            return $this->layout->layoutNumber;
        }
        return null;
    }

    public function setLayoutNumber(int $layoutNumber)
    {
        if (isset($this->layout)) {
            $this->layout->layoutNumber = $layoutNumber;
        } else {
            $this->layout = new Layout($layoutNumber);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @param mixed $paymentTerms
     * @return $this
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    public function getPaymentTermsNumber()
    {
        if (isset($this->paymentTerms)) {
            return $this->paymentTerms->paymentTermsNumber;
        }
        return null;
    }

    public function setPaymentTermsNumber(int $paymentTermsNumber)
    {
        if (isset($this->paymentTerms)) {
            $this->paymentTerms->paymentTermsNumber = $paymentTermsNumber;
        } else {
            $this->paymentTerms =  new PaymentTerms($paymentTermsNumber);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    public function getRecipientName()
    {
        if (isset($this->recipient)) {
            return $this->recipient->name;
        }
        return null;
    }

    public function setRecipientName(string $name)
    {
        if (isset($this->recipient)) {
            $this->recipient->name = $name;
        } else {
            $this->recipient = new Recipient($name);
        }
        return $this;
    }

    public function getRecipientVatZoneNumber()
    {
        if (isset($this->recipient->vatZone)) {
            return $this->recipient->vatZone->vatZoneNumber;
        }
        return null;
    }

    public function setRecipientVatZoneNumber(int $vatZoneNumber)
    {
        if (isset($this->recipient->vatZone)) {
            $this->recipient->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->recipient->vatZone = new VatZone($vatZoneNumber);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * @param mixed $references
     * @return $this
     */
    public function setReferences($references)
    {
        $this->references = $references;
        return $this;
    }

    public function getSalesPersonNumber()
    {
        if (isset($this->references->salesPerson)) {
            return $this->references->salesPerson->employeeNumber;
        }
        return null;
    }

    public function setSalesPersonNumber(int $employeeNumber)
    {
        if (isset($this->references->salesPerson)) {
            $this->references->salesPerson->employeeNumber = $employeeNumber;
        } else {
            $this->references->salesPerson = new SalesPerson($employeeNumber);
        }
        return $this;
    }

    public function getVendorReferenceNumber()
    {
        if (isset($this->references->vendorReference)) {
            return $this->references->vendorReference->employeeNumber;
        }
        return null;
    }

    public function setVendorReferenceNumber(int $employeeNumber)
    {
        if (isset($this->references->vendorReference)) {
            $this->references->vendorReference->employeeNumber = $employeeNumber;
        } else {
            $this->references->vendorReference = new VendorReference($employeeNumber);
        }
        return $this;
    }

}