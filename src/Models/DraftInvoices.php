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
use Economic\Models\Components\Notes;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\Pdf;
use Economic\Models\Components\Project;
use Economic\Models\Components\Recipient;
use Economic\Models\Components\References;
use Economic\Models\Components\SalesPerson;
use Economic\Models\Components\Templates;
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
    /** @var References $references*/
    private $references;
    /** @var array $lines*/
    private $lines = [];
    /** @var int $costPriceInBaseCurrency */
    private $costPriceInBaseCurrency;
    /** @var string $dueDate */
    private $dueDate;
    /** @var int $exchangeRate */
    private $exchangeRate;
    /** @var int $grossAmount */
    private $grossAmount;
    /** @var int $grossAmountInBaseCurrency */
    private $grossAmountInBaseCurrency;
    /** @var int $marginInBaseCurrency */
    private $marginInBaseCurrency;
    /** @var int $marginPercentage */
    private $marginPercentage;
    /** @var int $netAmount */
    private $netAmount;
    /** @var int $netAmountInBaseCurrency */
    private $netAmountInBaseCurrency;
    /** @var Notes $notes */
    private $notes;
    /** @var Pdf $pdf */
    private $pdf;
    /** @var Project $project */
    private $project;
    /** @var Templates $templates */
    private $templates;
    /** @var int $roundingAmount */
    private $roundingAmount;
    /** @var string $self */
    private $self;
    /** @var int $vatAmount */
    private $vatAmount;

    /** @var Economic $api*/
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
        $this->references = new \stdClass();
    }

    public static function parse($api, $object)
    {
        $draftInvoices = new DraftInvoices($api);

        $draftInvoices->setDraftInvoiceNumber($object->draftInvoiceNumber);
        $draftInvoices->setCurrency($object->currency);
        $draftInvoices->setCustomer($object->customer);
        $draftInvoices->setDate($object->date);
        $draftInvoices->setLayout($object->layout);
        $draftInvoices->setPaymentTerms($object->paymentTerms);
        $draftInvoices->setDeliveryLocation(isset($object->deliveryLocation) ? $object->deliveryLocation : null);
        $draftInvoices->setRecipient($object->recipient);
        $draftInvoices->setReferences($object->references);
        $draftInvoices->setCostPriceInBaseCurrency($object->costPriceInBaseCurrency);
        $draftInvoices->setDueDate($object->dueDate);
        $draftInvoices->setExchangeRate($object->exchangeRate);
        $draftInvoices->setGrossAmount($object->grossAmount);
        $draftInvoices->setGrossAmountInBaseCurrency(isset($object->grossAmountInBaseCurrency) ? $object->grossAmountInBaseCurrency : null);
        $draftInvoices->setMarginInBaseCurrency($object->marginInBaseCurrency);
        $draftInvoices->setMarginPercentage($object->marginPercentage);
        $draftInvoices->setNetAmount($object->netAmount);
        $draftInvoices->setNetAmountInBaseCurrency($object->netAmountInBaseCurrency);
        $draftInvoices->setNotes(isset($object->notes) ? $object->notes : null);
        $draftInvoices->setPdf($object->pdf);
        $draftInvoices->setProject(isset($object->project) ? $object->project : null);
        $draftInvoices->setTemplate(isset($object->templates) ? $object->templates : null);
        $draftInvoices->setRoundingAmount($object->roundingAmount);
        $draftInvoices->setSelf($object->self);
        $draftInvoices->setVatAmount($object->vatAmount);

        return $draftInvoices;
    }

    public function all(Filter $filter = null, $pageSize = 20, $skipPages = 0, $recursive = true)
    {
        if (is_null($filter)) {
            $invoices = $this->api->retrieve('/invoices/drafts?skippages='.$skipPages.'&pagesize='.$pageSize.'');
        } else {
            $invoices = $this->api->retrieve('/invoices/drafts'.$filter->filter() .'&pagesize='. $pageSize);
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
     * @return Notes
     */
    public function getNotes() : ?Notes
    {
        return $this->notes;
    }

    /**
     * @param $notes
     * @return $this
     */
    public function setNotes($notes = null)
    {
        if (isset($notes)) {
            $this->notes = new Notes(
                isset($notes->heading) ? $notes->heading : null,
                isset($notes->textLine1) ? $notes->textLine1 : null,
                isset($notes->textLine2) ? $notes->textLine2 : null);
        } else {
            return null;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getNoteHeading() : ?string
    {
        if (isset($this->notes)) {
            return $this->notes->heading;
        }

        return null;
    }

    /**
     * @param string $heading
     * @return $this
     */
    public function setNoteHeading(string $heading)
    {
        if (isset($this->notes)) {
            $this->notes->heading = $heading;
        } else {
            $this->notes = new Notes($heading, null, null);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getNoteTextLine1() : ?string
    {
        if (isset($this->notes)) {
            return $this->notes->textLine1;
        }

        return null;
    }

    /**
     * @param string $textLine1
     * @return $this
     */
    public function setNoteTextLine1(string $textLine1)
    {
        if (isset($this->notes)) {
            $this->notes->textLine1 = $textLine1;
        } else {
            $this->notes = new Notes(null, $textLine1, null);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getNoteTextLine2() : ?string
    {
        if (isset($this->notes)) {
            return $this->notes->textLine2;
        }

        return null;
    }

    /**
     * @param string $textLine2
     * @return $this
     */
    public function setNoteTextLine2(string $textLine2)
    {
        if (isset($this->notes)) {
            $this->notes->textLine1 = $textLine2;
        } else {
            $this->notes = new Notes(null, null, $textLine2);
        }

        return $this;
    }

    /**
     * @return Pdf
     */
    public function getPdf() : ?Pdf
    {
        return $this->pdf;
    }

    /**
     * @param $pdf
     * @return $this
     */
    public function setPdf($pdf)
    {
        $this->pdf = new Pdf($pdf->download);

        return $this;
    }

    /**
     * @return Project
     */
    public function getProject() : ?Project
    {
        return $this->project;
    }

    /**
     * @param $project
     * @return $this
     */
    public function setProject($project = null)
    {
        if (isset($project)) {
            $this->project = new Project($project->projectNumber);
        } else {
            return null;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getProjectNumber() : ?int
    {
        if (isset($this->project)) {
            return $this->project->projectNumber;
        }

        return null;
    }

    /**
     * @param int $projectNumber
     * @return $this
     */
    public function setProjectNumber(int $projectNumber)
    {
        if (isset($this->project)) {
            $this->project->projectNumber = $projectNumber;
        } else {
            $this->project = new Project($projectNumber);
        }

        return $this;
    }

    /**
     * @return Templates
     */
    public function getTemplate() : ?Templates
    {
        return $this->templates;
    }

    /**
     * @param $template
     * @return $this
     */
    public function setTemplate($template = null)
    {
        if (isset($template)) {
            $this->templates = new Templates($template->self);
        } else {
            return null;
        }

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
    public function getSelf() : ?string
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

    /**
     * @return int
     */
    public function getMarginInBaseCurrency() : ?int
    {
        return $this->marginInBaseCurrency;
    }

    /**
     * @param int $marginInBaseCurrency
     * @return $this
     */
    public function setMarginInBaseCurrency(int $marginInBaseCurrency)
    {
        $this->marginInBaseCurrency = $marginInBaseCurrency;

        return $this;
    }

    /**
     * @return int
     */
    public function getMarginPercentage() : ?int
    {
        return $this->marginPercentage;
    }

    /**
     * @param int $marginPercentage
     * @return $this
     */
    public function setMarginPercentage(int $marginPercentage)
    {
        $this->marginPercentage = $marginPercentage;

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
    public function getCostPriceInBaseCurrency() : ?int
    {
        return $this->costPriceInBaseCurrency;
    }

    /**
     * @param int $costPriceInBaseCurrency
     * @return $this
     */
    public function setCostPriceInBaseCurrency(int $costPriceInBaseCurrency)
    {
        $this->costPriceInBaseCurrency = $costPriceInBaseCurrency;

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
     * @return $this
     */
    public function setDueDate(string $dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getExchangeRate() : ?int
    {
        return $this->exchangeRate;
    }

    /**
     * @param int $exchangeRate
     * @return $this
     */
    public function setExchangeRate(int $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    /**
     * @return int
     */
    public function getGrossAmount() : ?int
    {
        return $this->grossAmount;
    }

    /**
     * @param int $grossAmount
     * @return $this
     */
    public function setGrossAmount(int $grossAmount)
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getGrossAmountInBaseCurrency() : ?int
    {
        return $this->grossAmountInBaseCurrency;
    }

    /**
     * @param int $grossAmountInBaseCurrency
     * @return $this
     */
    public function setGrossAmountInBaseCurrency(?int $grossAmountInBaseCurrency)
    {
        $this->grossAmountInBaseCurrency = $grossAmountInBaseCurrency;

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
        $this->customer = new Customer($customer->customerNumber);
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
        $this->layout = new Layout($layout->layoutNumber);
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
        $this->paymentTerms = new PaymentTerms($paymentTerms->paymentTermsNumber);
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
        $this->recipient = new Recipient($recipient->name, isset($recipient->vatZone) ? $recipient->vatZone : null);
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
        if (isset($this->recipient->vatZone)) {
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
        if (isset($this->recipient->vatZone)) {
            $this->recipient->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->recipient->vatZone = new VatZone($vatZoneNumber);
        }
        return $this;
    }

    /**
     * @return References
     */
    public function getReferences() : ?References
    {
        return $this->references;
    }

    /**
     * @param References $reference
     * @return $this
     */
    public function setReferences($reference = null)
    {
        if (isset($reference)) {
            $this->references = new References($reference->vendorReference, $reference->salesPerson);
        } else {
            return null;
        }

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
     * @param $deliveryLocation
     * @return $this;
     */
    public function setDeliveryLocation($deliveryLocation = null)
    {
        if (isset($deliveryLocation)) {
            $this->deliveryLocation = new DeliveryLocation($deliveryLocation->deliveryLocationNumber);
        } else {
            return null;
        }

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

    public function setDeliveryLocationNumber(?int $deliveryLocationNumber)
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