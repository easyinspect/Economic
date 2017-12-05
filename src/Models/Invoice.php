<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 12-10-2017
 * Time: 17:05.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\Pdf;
use Economic\Models\Components\Layout;
use Economic\Models\Components\VatZone;
use Economic\Models\Components\Customer;
use Economic\Models\Components\Recipient;
use Economic\Models\Components\References;
use Economic\Models\Components\SalesPerson;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\VendorReference;

class Invoice
{
    /** @var string $currency */
    private $currency;
    /** @var string $date */
    private $date;
    /** @var string $dueDate */
    private $dueDate;
    /** @var int $netAmount */
    private $netAmount;
    /** @var int $netAmountInBaseCurrency */
    private $netAmountInBaseCurrency;
    /** @var int $remainder */
    private $remainder;
    /** @var int $remainderInBaseCurrency */
    private $remainderInBaseCurrency;
    /** @var int $roundingAmount */
    private $roundingAmount;
    /** @var string $self */
    private $self;
    /** @var Customer $customer */
    private $customer;
    /** @var PaymentTerms $paymentTerms */
    private $paymentTerms;
    /** @var Pdf $pdf */
    private $pdf;
    /** @var Recipient $recipient */
    private $recipient;
    /** @var References $references */
    private $references;
    /** @var Layout $layout */
    private $layout;
    /** @var float $grossAmount */
    private $grossAmount;
    /** @var int $bookedInvoiceNumber */
    private $bookedInvoiceNumber;
    /** @var int $vatAmount */
    private $vatAmount;
    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function parse($api, $object)
    {
        $invoice = new self($api);

        $invoice->setCustomer($object->customer);
        $invoice->setCurrency($object->currency);
        $invoice->setDate($object->date);
        $invoice->setDueDate($object->dueDate);
        $invoice->setGrossAmount($object->grossAmount);
        $invoice->setLayout($object->layout);
        $invoice->setNetAmount($object->netAmount);
        $invoice->setNetAmountInBaseCurrency($object->netAmountInBaseCurrency);
        $invoice->setPaymentTerms($object->paymentTerms);
        $invoice->setPdf($object->pdf);
        $invoice->setRecipient($object->recipient);
        $invoice->setReferences($object->references);
        $invoice->setRemainder($object->remainder);
        $invoice->setRemainderInBaseCurrency($object->remainderInBaseCurrency);
        $invoice->setRoundingAmount($object->roundingAmount);
        $invoice->setSelf($object->self);
        $invoice->setVatAmount($object->vatAmount);
        $invoice->setBookedInvoiceNumber($object->bookedInvoiceNumber);

        return $invoice;
    }

    public function all(Filter $filter = null, $pageSize = 20, $skipPages = 0, $recursive = true)
    {
        if (is_null($filter)) {
            $invoices = $this->api->retrieve('/invoices/booked?skippages='.$skipPages.'&pagesize='.$pageSize.'');
        } else {
            $invoices = $this->api->retrieve('/invoices/booked?'.$filter->filter().'&skippages='.$skipPages.'&pagesize='.$pageSize.'');
        }

        if ($recursive && isset($invoices->pagination->nextPage)) {
            $collection = $this->all($filter, $pageSize, $skipPages + 1);
            $invoices->collection = array_merge($invoices->collection, $collection);
        }

        $invoices->collection = array_map(function ($item) {
            return self::parse($this->api, $item);
        }, $invoices->collection);

        return $invoices->collection;
    }

    public function get($id)
    {
        $invoice = $this->api->retrieve('/invoices/booked/'.$id);

        return self::parse($this->api, $invoice);
    }

    public function downloadPdf()
    {
        $pdf = $this->api->download('/invoices/booked/'.$this->getBookedInvoiceNumber().'/pdf');

        return $pdf;
    }

    // Getters & Setters

    /**
     * @return Layout
     */
    public function getLayout() : Layout
    {
        return $this->layout;
    }

    /**
     * @return int
     */
    public function getLayoutNumber() : int
    {
        if (isset($this->layout)) {
            return $this->layout->layoutNumber;
        }

        return null;
    }

    /**
     * @param Layout $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->layout = new Layout($layout->layoutNumber, $layout->self);

        return $this;
    }

    /**
     * @return References
     */
    public function getReferences() : References
    {
        return $this->references;
    }

    /**
     * @return SalesPerson
     */
    public function getReferencesSalesPerson() : SalesPerson
    {
        if (isset($this->references)) {
            return $this->references->salesPerson;
        }

        return null;
    }

    /**
     * @return VendorReference
     */
    public function getReferencesVendorReference() : VendorReference
    {
        if (isset($this->references)) {
            return $this->references->vendorReference;
        }

        return null;
    }

    /**
     * @return int
     */
    public function getReferencesSalesPersonEmployeeNumber() : int
    {
        if (isset($this->references->salesPerson)) {
            return $this->references->salesPerson->employeeNumber;
        }

        return null;
    }

    /**
     * @return int
     */
    public function getReferencesVendorReferenceEmployeeNumber() : int
    {
        if (isset($this->references->vendorReference)) {
            return $this->references->vendorReference->employeeNumber;
        }

        return null;
    }

    /**
     * @param References $references
     * @return $this
     */
    public function setReferences($references)
    {
        $this->references = new References($references->salesPerson, $references->vendorReference);

        return $this;
    }

    /**
     * @return Recipient
     */
    public function getRecipient() : Recipient
    {
        return $this->recipient;
    }

    /**
     * @return string
     */
    public function getRecipientName() : ?string
    {
        if (isset($this->recipient)) {
            return $this->recipient->name;
        }

        return null;
    }

    /**
     * @return VatZone
     */
    public function getRecipientVatZone() : ?VatZone
    {
        if (isset($this->recipient)) {
            return $this->recipient->vatZone;
        }

        return null;
    }

    /**
     * @return int
     */
    public function getRecipientVatZoneNumber() : ?int
    {
        if (isset($this->recipient->vatZone)) {
            return $this->recipient->vatZone->vatZoneNumber;
        }

        return null;
    }

    /**
     * @param Recipient $recipient
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = new Recipient($recipient->name, $recipient->vatZone ?? null);

        return $this;
    }

    /**
     * @return Pdf
     */
    public function getPdf() : Pdf
    {
        return $this->pdf;
    }

    /**
     * @param Pdf $pdf
     * @return $this
     */
    public function setPdf($pdf)
    {
        $this->pdf = new Pdf($pdf->download);

        return $this;
    }

    /**
     * @return PaymentTerms
     */
    public function getPaymentTerms() : PaymentTerms
    {
        return $this->paymentTerms;
    }

    /**
     * @param PaymentTerms $paymentTerms
     * @return $this
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = new PaymentTerms($paymentTerms->paymentTermsNumber, $paymentTerms->self);

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer() : Customer
    {
        return $this->customer;
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
     * @param Customer $customer
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = new Customer($customer->customerNumber, $customer->self);

        return $this;
    }

    /**
     * @return int
     */
    public function getBookedInvoiceNumber(): ?int
    {
        return $this->bookedInvoiceNumber;
    }

    /**
     * @param int $bookedInvoiceNumber
     * @return $this
     */
    public function setBookedInvoiceNumber(int $bookedInvoiceNumber)
    {
        $this->bookedInvoiceNumber = $bookedInvoiceNumber;

        return $this;
    }

    /**
     * @return float
     */
    public function getGrossAmount(): ?float
    {
        return $this->grossAmount;
    }

    /**
     * @param float $grossAmount
     * @return $this
     */
    public function setGrossAmount(float $grossAmount)
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() : ?string
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
     * @return string
     */
    public function getDate() : ?string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getDueDate() : ?string
    {
        return $this->dueDate;
    }

    /**
     * @param string $dueDate
     * @return $this;
     */
    public function setDueDate(string $dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getNetAmount() : ?int
    {
        return $this->netAmount;
    }

    /**
     * @param int $netAmount
     * @return $this
     */
    public function setNetAmount(int $netAmount)
    {
        $this->netAmount = $netAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getNetAmountInBaseCurrency() : ?int
    {
        return $this->netAmountInBaseCurrency;
    }

    /**
     * @param int $netAmountInBaseCurrency
     * @return $this
     */
    public function setNetAmountInBaseCurrency(int $netAmountInBaseCurrency)
    {
        $this->netAmountInBaseCurrency = $netAmountInBaseCurrency;

        return $this;
    }

    /**
     * @return int
     */
    public function getRemainder() : ?int
    {
        return $this->remainder;
    }

    /**
     * @param int $remainder
     * @return $this
     */
    public function setRemainder(int $remainder)
    {
        $this->remainder = $remainder;

        return $this;
    }

    /**
     * @return int
     */
    public function getRemainderInBaseCurrency() : ?int
    {
        return $this->remainderInBaseCurrency;
    }

    /**
     * @param int $remainderInBaseCurrency
     * @return $this
     */
    public function setRemainderInBaseCurrency(int $remainderInBaseCurrency)
    {
        $this->remainderInBaseCurrency = $remainderInBaseCurrency;

        return $this;
    }

    /**
     * @return int
     */
    public function getRoundingAmount() : ?int
    {
        return $this->roundingAmount;
    }

    /**
     * @param int $roundingAmount
     * @return $this
     */
    public function setRoundingAmount(int $roundingAmount)
    {
        $this->roundingAmount = $roundingAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return $this
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }

    /**
     * @return int
     */
    public function getVatAmount() : ?int
    {
        return $this->vatAmount;
    }

    /**
     * @param int $vatAmount
     * @return $this
     */
    public function setVatAmount(int $vatAmount)
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }
}
