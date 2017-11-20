<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:09
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Filter;
use Economic\Models\Components\Customer;
use Economic\Models\Components\Layout;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\Recipient;
use Economic\Models\Components\SalesPerson;
use Economic\Models\Components\VatZone;
use Economic\Models\Components\VendorReference;
use Economic\Models\Components\DeliveryLocation;
use Economic\Models\Components\Line;

class DraftInvoices
{
    /** @var int $draftInvoiceNumber*/
    private $draftInvoiceNumber;
    /** @var string $currency*/
    private $currency;
    /** @var Customer $customer*/
    private $customer;
    /** @var string $date*/
    private $date;
    /** @var Layout $layout*/
    private $layout;
    /** @var PaymentTerms $paymentTerms*/
    private $paymentTerms;
    /** @var DeliveryLocation $deliveryLocation*/
    private $deliveryLocation;
    /** @var Recipient $recipient*/
    private $recipient;
    /** @var object $references*/
    private $references;
    /** @var array $lines*/
    private $lines = [];

    /** @var Economic $api*/
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
        $this->references = new \stdClass();
    }

    public function all(Filter $filter = null, $pagesize = 1000)
    {
        if (is_null($filter)) {
            $invoices = $this->api->retrieve('/invoices/drafts?pagesize='. $pagesize);
        } else {
            $invoices = $this->api->retrieve('/invoices/drafts'.$filter->filter() .'&pagesize='. $pagesize);
        }

        return $invoices;
    }

    public function get($id)
    {
        $invoice = $this->api->retrieve('/invoices/drafts/' . $id);
        $this->api->setObject($invoice, $this);
        return $this;
    }

    public function create()
    {
        $data = [
            'currency' => $this->getCurrency(),
            'customer' => $this->getCustomer(),
            'date' => $this->getDate(),
            'layout' => $this->getLayout(),
            'paymentTerms' => $this->getPaymentTerms(),
            'recipient' => $this->getRecipient(),
            'references' => $this->getReferences(),
            'deliveryLocation' => $this->getDeliveryLocation(),
            'lines' => $this->getLines()
        ];

        $invoice = $this->api->create('/invoices/drafts', $data);
        $this->api->setObject($invoice, $this);
        return $this;
    }

    public function bookInvoice()
    {
       $data = [
           'draftInvoice' => [
               'draftInvoiceNumber' => $this->getDraftInvoiceNumber()
           ],
           'bookWithNumber' => $this->getDraftInvoiceNumber()
       ];

       $bookInvoice = $this->api->create('/invoices/booked', $data);
       $this->api->setObject($bookInvoice, $this);
       return $this;
    }

    // Getters & Setters

    /**
     * @return mixed
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
     * @return Customer
     */
    public function getCustomer() : ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /** @return int */

    public function getCustomerNumber() : ?int
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
     * @return Layout
     */
    public function getLayout() : ?Layout
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

    /** @return int */

    public function getLayoutNumber() : ?int
    {
        if (isset($this->layout)) {
            return $this->layout->layoutNumber;
        }
        return null;
    }

    /**
     * @param int $layoutNumber
     * @return $this
     */

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
     * @return PaymentTerms
     */
    public function getPaymentTerms() : ?PaymentTerms
    {
        return $this->paymentTerms;
    }

    /**
     * @param PaymentTerms $paymentTerms
     * @return $this
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    /** @return int */

    public function getPaymentTermsNumber() : ?int
    {
        if (isset($this->paymentTerms)) {
            return $this->paymentTerms->paymentTermsNumber;
        }
        return null;
    }

    /**
     * @param int $paymentTermsNumber
     * @return $this
     */

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
     * @return Recipient
     */
    public function getRecipient() : ?Recipient
    {
        return $this->recipient;
    }

    /**
     * @param Recipient $recipient
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /** @return string */

    public function getRecipientName() : ?string
    {
        if (isset($this->recipient)) {
            return $this->recipient->name;
        }
        return null;
    }

    /**
     * @param string $name
     * @return $this
     */

    public function setRecipientName(string $name)
    {
        if (isset($this->recipient)) {
            $this->recipient->name = $name;
        } else {
            $this->recipient = new Recipient($name);
        }
        return $this;
    }

    /** @return int */

    public function getRecipientVatZoneNumber() : ?int
    {
        if (isset($this->recipient)) {
            return $this->recipient->vatZone->vatZoneNumber;
        }
        return null;
    }

    /**
     * @param int $vatZoneNumber
     * @return $this
     */

    public function setRecipientVatZoneNumber(int $vatZoneNumber)
    {
        if (isset($this->recipient)) {
            $this->recipient->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->recipient->vatZone = new VatZone($vatZoneNumber);
        }
        return $this;
    }

    /**
     * @return \stdClass
     */
    public function getReferences() : ?\stdClass
    {
        return $this->references;
    }

    /**
     * @param \stdClass $references
     * @return $this
     */
    public function setReferences($references)
    {
        $this->references = $references;
        return $this;
    }

    /** @return int */

    public function getSalesPersonNumber() : ?int
    {
        if (isset($this->references->salesPerson)) {
            return $this->references->salesPerson->employeeNumber;
        }
        return null;
    }

    /**
     * @param int $employeeNumber
     * @return $this
     */

    public function setSalesPersonNumber(int $employeeNumber)
    {
        if (isset($this->references->salesPerson)) {
            $this->references->salesPerson->employeeNumber = $employeeNumber;
        } else {
            $this->references->salesPerson = new SalesPerson($employeeNumber);
        }
        return $this;
    }

    /** @return int */

    public function getVendorReferenceNumber() : ?int
    {
        if (isset($this->references->vendorReference)) {
            return $this->references->vendorReference->employeeNumber;
        }
        return null;
    }

    /**
     * @param int $employeeNumber
     * @return $this
     */

    public function setVendorReferenceNumber(int $employeeNumber)
    {
        if (isset($this->references->vendorReference)) {
            $this->references->vendorReference->employeeNumber = $employeeNumber;
        } else {
            $this->references->vendorReference = new VendorReference($employeeNumber);
        }
        return $this;
    }

    /**
     * @return DeliveryLocation
     */
    public function getDeliveryLocation() : ?DeliveryLocation
    {
        return $this->deliveryLocation;
    }

    /**
     * @param DeliveryLocation $deliveryLocation
     * @return $this;
     */
    public function setDeliveryLocation($deliveryLocation)
    {
        $this->deliveryLocation = $deliveryLocation;
        return $this;
    }

    /** @return int */

    public function getDeliveryLocationNumber() : ?int
    {

        if (isset($this->deliveryLocation)) {
            return $this->deliveryLocation->deliveryLocationNumber;
        }

        return null;
    }

    /**
     * @param int $deliveryLocationNumber
     * @return $this
     */

    public function setDeliveryLocationNumber(int $deliveryLocationNumber)
    {
        if (isset($this->deliveryLocation)) {
            $this->deliveryLocation->deliveryLocationNumber = $deliveryLocationNumber;
        } else {
            $this->deliveryLocation = new DeliveryLocation($deliveryLocationNumber);
        }

        return $this;
    }

    /** @return int */
    public function getDraftInvoiceNumber()
    {
        return $this->draftInvoiceNumber;
    }

    /**
     * @param int $draftInvoiceNumber
     * @return $this
     */
    public function setDraftInvoiceNumber($draftInvoiceNumber)
    {
        $this->draftInvoiceNumber = $draftInvoiceNumber;
        return $this;
    }

    /**
     * @return array
     */
    public function getLines() : array
    {
        return $this->lines;
    }

    /**
     * @param array $lines
     * @return $this
     */
    public function setLines($lines)
    {
        $this->lines = $lines;
        return $this;
    }

    public function setInvoiceLine(string $productNumber, string $name, int $quantity, float $price, float $discountPercentage = 0)
    {
        $this->lines[] = new Line($productNumber, $name, $quantity, $price, $discountPercentage);

        return $this;
    }
}