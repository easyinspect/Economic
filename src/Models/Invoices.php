<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 12-10-2017
 * Time: 17:05
 */

namespace Economic\Models;

use Economic\Economic;

class Invoices
{

    /** @var float $grossAmount */
    private $grossAmount;
    /** @var int $bookedInvoiceNumber */
    private $bookedInvoiceNumber;
    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function get($id)
    {
        $invoice = $this->api->retrieve('/invoices/booked/' . $id);
        $this->api->setObject($invoice, $this);
        return $this;
    }

    public function downloadPdf()
    {
        $pdf = $this->api->download('/invoices/booked/'.$this->getBookedInvoiceNumber().'/pdf');
        return $pdf;
    }

    // Getters & Setters

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

}