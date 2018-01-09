<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:09.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\Pdf;
use Economic\Models\Components\Line;
use Economic\Models\Components\Notes;
use Economic\Models\Components\Layout;
use Economic\Models\Components\Project;
use Economic\Models\Components\VatZone;
use Economic\Models\Components\Customer;
use Economic\Models\Components\Recipient;
use Economic\Models\Components\References;
use Economic\Models\Components\SalesPerson;
use Economic\Models\Components\PaymentTerms;
use Economic\Models\Components\VendorReference;
use Economic\Validations\DraftInvoiceValidator;

class DraftInvoice
{
    /** @var int $draftInvoiceNumber */
    private $draftInvoiceNumber;
    /** @var string $currency */
    private $currency;
    /** @var Customer $customer */
    private $customer;
    /** @var string $date */
    private $date;
    /** @var Layout $layout */
    private $layout;
    /** @var PaymentTerms $paymentTerms */
    private $paymentTerms;
    /** @var Recipient $recipient */
    public $recipient;
    /** @var References $references */
    public $references;
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
    /** @var array $lines */
    private $lines = [];
    /** @var int $roundingAmount */
    private $roundingAmount;
    /** @var string $self */
    private $self;
    /** @var int $vatAmount */
    private $vatAmount;

    /** @var Economic $economic */
    private $economic;

    /**
     * DraftInvoice constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transforms stdClass object into DraftInvoice.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return DraftInvoice
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $draftInvoices = new self($economic);

        $draftInvoices->setDraftInvoiceNumber($stdClass->draftInvoiceNumber);
        $draftInvoices->setCurrency($stdClass->currency);
        $draftInvoices->setCustomer($stdClass->customer);
        $draftInvoices->setDate($stdClass->date);
        $draftInvoices->setLayout($stdClass->layout);
        $draftInvoices->setPaymentTerms($stdClass->paymentTerms);
        $draftInvoices->setRecipient($stdClass->recipient);
        $draftInvoices->setReferences($stdClass->references ?? null);
        $draftInvoices->setCostPriceInBaseCurrency($stdClass->costPriceInBaseCurrency);
        $draftInvoices->setDueDate($stdClass->dueDate);
        $draftInvoices->setExchangeRate($stdClass->exchangeRate);
        $draftInvoices->setGrossAmount($stdClass->grossAmount);
        $draftInvoices->setGrossAmountInBaseCurrency($stdClass->grossAmountInBaseCurrency ?? null);
        $draftInvoices->setMarginInBaseCurrency($stdClass->marginInBaseCurrency);
        $draftInvoices->setMarginPercentage($stdClass->marginPercentage);
        $draftInvoices->setNetAmount($stdClass->netAmount);
        $draftInvoices->setNetAmountInBaseCurrency($stdClass->netAmountInBaseCurrency);
        $draftInvoices->setNotes($stdClass->notes ?? null);
        $draftInvoices->setPdf($stdClass->pdf);
        $draftInvoices->setProject($stdClass->project ?? null);
        $draftInvoices->setLines($stdClass->lines ?? null);
        $draftInvoices->setRoundingAmount($stdClass->roundingAmount);
        $draftInvoices->setSelf($stdClass->self);
        $draftInvoices->setVatAmount($stdClass->vatAmount);

        return $draftInvoices;
    }

    /**
     * Retrieves a collection of DraftInvoice(s).
     * @param Filter $filter
     * @return DraftInvoice
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/invoices/drafts?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/invoices/drafts?', $this);
        }
    }

    /**
     * Retrieves a single DraftInvoice by its ID.
     * @param int $id
     * @return DraftInvoice
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/invoices/drafts/'.$id));
    }

    /**
     * Creates a DraftInvoice.
     * @return DraftInvoice
     */
    public function create()
    {
        $data = (object) [
            'currency' => $this->getCurrency(),
            'customer' => $this->getCustomer(),
            'date' => $this->getDate(),
            'dueDate' => $this->getDueDate(),
            'exchangeRate' => $this->getExchangeRate(),
            'grossAmount' => $this->getGrossAmount(),
            'layout' => $this->getLayout(),
            'notes' => $this->getNotes(),
            'project' => $this->getProject(),
            'paymentTerms' => $this->getPaymentTerms(),
            'recipient' => $this->getRecipient(),
            'references' => $this->getReferences(),
            'lines' => $this->getLines(),
        ];

        $this->economic->cleanObject($data);

        $validator = DraftInvoiceValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->create('/invoices/drafts', $data));
    }

    /**
     * Updates a DraftInvoice.
     * @return DraftInvoice
     */
    public function update()
    {
        $data = (object) [
            'costPriceInBaseCurrency' => $this->getCostPriceInBaseCurrency(),
            'currency' => $this->getCurrency(),
            'customer' => $this->getCustomer(),
            'date' => $this->getDate(),
            'dueDate' => $this->getDueDate(),
            'exchangeRate' => $this->getExchangeRate(),
            'grossAmount' => $this->getGrossAmount(),
            'grossAmountInBaseCurrency' => $this->getGrossAmountInBaseCurrency(),
            'lines' => $this->getLines(),
            'marginInBaseCurrency' => $this->getMarginInBaseCurrency(),
            'marginPercentage' => $this->getMarginPercentage(),
            'netAmountInBaseCurrency' => $this->getNetAmountInBaseCurrency(),
            'notes' => $this->getNotes(),
            'paymentTerms' => $this->getPaymentTerms(),
            'project' => $this->getProject(),
            'recipient' => $this->getRecipient(),
            'references' => $this->getReferences(),
            'roundingAmount' => $this->getRoundingAmount(),
            'vatAmount' => $this->getVatAmount(),
        ];

        $this->economic->cleanObject($data);

        return self::transform($this->economic, $this->economic->update('/invoices/drafts/'.$this->getDraftInvoiceNumber(), $data));
    }

    /**
     * Books a DraftInvoice, and convert it to a regular Invoice.
     * @return Invoice
     */
    public function bookInvoice() : Invoice
    {
        $data = [
           'draftInvoice' => [
               'draftInvoiceNumber' => $this->getDraftInvoiceNumber(),
           ],
        ];

        return Invoice::transform($this->economic, $this->economic->create('/invoices/booked', $data));
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
     * @param Notes $notes
     * @return $this
     */
    public function setNotes($notes = null)
    {
        if (isset($notes)) {
            $this->notes = new Notes($notes->heading, $notes->textLine1, $notes->textLine2);
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
            $this->notes = $this->economic->setClass('Notes', 'heading');
            $this->notes->heading = $heading;
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
            $this->notes = $this->economic->setClass('Notes', 'textLine1');
            $this->notes->textLine1 = $textLine1;
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
            $this->notes = $this->economic->setClass('Notes', 'textLine2');
            $this->notes->textLine2 = $textLine2;
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
     * @param Project $project
     * @return $this
     */
    public function setProject($project = null)
    {
        if (isset($project)) {
            $this->project = new Project($project->projectNumber, $project->self);
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
            $this->project = $this->economic->setClass('Project', 'projectNumber');
            $this->project->projectNumber = $projectNumber;
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
        $this->customer = new Customer($customer->customerNumber, $customer->self);

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
            $this->customer = $this->economic->setClass('Customer', 'customerNumber');
            $this->customer->customerNumber = $customerNumber;
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
        $this->layout = new Layout($layout->layoutNumber, $layout->self);

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
            $this->layout = $this->economic->setClass('Layout', 'layoutNumber');
            $this->layout->layoutNumber = $layoutNumber;
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
        $this->paymentTerms = new PaymentTerms($paymentTerms->paymentTermsNumber, $paymentTerms->self);

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
            $this->paymentTerms = $this->economic->setClass('PaymentTerms', 'paymentTermsNumber');
            $this->paymentTerms->paymentTermsNumber = $paymentTermsNumber;
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
        $this->recipient = new Recipient($recipient->name, $recipient->vatZone);

        return $this;
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
    public function getRecipientVatZone() :?VatZone
    {
        if (isset($this->recipient->vatZone)) {
            return $this->recipient->vatZone;
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
            $this->recipient = $this->economic->setClass('Recipient', 'name');
            $this->recipient->name = $name;
        }

        return $this;
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
     * @param int $vatZoneNumber
     * @return $this
     */
    public function setRecipientVatZoneNumber(int $vatZoneNumber)
    {
        if (isset($this->recipient->vatZone)) {
            $this->recipient->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->recipient = $this->economic->setClass('Recipient', 'vatZone', $this);
            $this->recipient->vatZone->vatZoneNumber = $vatZoneNumber;
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
     * @return SalesPerson
     */
    public function getReferencesSalesPerson() : ?SalesPerson
    {
        if (isset($this->references->salesPerson)) {
            return $this->references->salesPerson;
        }

        return null;
    }

    /**
     * @return VendorReference
     */
    public function getReferencesVendorReference() : ?VendorReference
    {
        if (isset($this->references->vendorReference)) {
            return $this->references->vendorReference;
        }

        return null;
    }

    /**
     * @param References $reference
     * @return $this
     */
    public function setReferences($reference = null)
    {
        if (isset($reference)) {
            $this->references = new References($reference->vendorReference, $reference->salesPerson);
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
            $this->references = $this->economic->setClass('References', 'salesPerson', $this);
            $this->references->salesPerson->employeeNumber = $employeeNumber;
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
            $this->references = $this->economic->setClass('References', 'vendorReference', $this);
            $this->references->vendorReference->employeeNumber = $employeeNumber;
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
    public function setLines($lines = null)
    {
        if (isset($lines)) {
            foreach ($lines as $line) {
                $this->lines[] = new Line($line->product->productNumber, $line->description, $line->quantity, $line->unitNetPrice, $line->discountPercentage);
            }
        }

        return $this;
    }

    /**
     * @param string $productNumber
     * @param string $name
     * @param int $quantity
     * @param float $price
     * @param float $discountPercentage
     * @return $this
     */
    public function setInvoiceLine(string $productNumber, string $name, int $quantity, float $price, float $discountPercentage = 0)
    {
        $this->lines[] = new Line($productNumber, $name, $quantity, $price, $discountPercentage);

        return $this;
    }
}
