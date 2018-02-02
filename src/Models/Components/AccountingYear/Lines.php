<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\AccountingYear;

use Economic\Models\Components\ProductGroup\VatAccount;
use Economic\Models\Components\DepartmentalDistribution;

class Lines
{
    /** @var Accruals $accruals */
    public $accruals;
    /** @var int $amount */
    public $amount;
    /** @var int $amountInBaseCurrency */
    public $amountInBaseCurrency;
    /** @var bool $booked */
    public $booked;
    /** @var ContraAccount $contraAccount */
    public $contraAccount;
    /** @var ContraVatAccount $contraVatAccount */
    public $contraVatAccount;
    /** @var int $contraVatAmount */
    public $contraVatAmount;
    /** @var int $contraVatAmountInBaseCurrency */
    public $contraVatAmountInBaseCurrency;
    /** @var string $currency */
    public $currency;
    /** @var Department $department */
    public $department;
    /** @var DepartmentalDistribution $departmentalDistribution */
    public $departmentalDistribution;
    /** @var string $document */
    public $document;
    /** @var int $entryNumber */
    public $entryNumber;
    /** @var int $exchangeRate */
    public $exchangeRate;
    /** @var RemittanceInformation $remittanceInformation */
    public $remittanceInformation;
    /** @var Supplier $supplier */
    public $supplier;
    /** @var string $text */
    public $text;
    /** @var VatAccount $vatAccount */
    public $vatAccount;
    /** @var int $vatAmount */
    public $vatAmount;
    /** @var int $vatAmountInBaseCurrency */
    public $vatAmountInBaseCurrency;

    public static function convert(\stdClass $stdClass)
    {
        $line = new self();

        $line->setAccruals($stdClass->accruals);
        $line->setAmount($stdClass->amount);
        $line->setAmountInBaseCurrency($stdClass->amountInBaseCurrency);
        $line->setBooked($stdClass->booked);
        $line->setContraAccount($stdClass->contraAccount);
        $line->setContraVatAccount($stdClass->contraVatAccount);
        $line->setContraVatAmount($stdClass->contraVatAmount);
        $line->setContraVatAmountInBaseCurrency($stdClass->contraVatAmountInBaseCurrency);
        $line->setCurrency($stdClass->currency);
        $line->setDepartment($stdClass->department);
        $line->setDepartmentalDistribution($stdClass->departmentalDistribution);
        $line->setDocument($stdClass->document);
        $line->setEntryNumber($stdClass->entryNumber);
        $line->setExchangeRate($stdClass->exchangeRate);
        $line->setRemittanceInformation($stdClass->remittanceInformation);
        $line->setSupplier($stdClass->supplier);
        $line->setText($stdClass->text);
        $line->setVatAccount($stdClass->vatAccount);
        $line->setVatAmount($stdClass->vatAmount);
        $line->setVatAmountInBaseCurrency($stdClass->vatAmountInBaseCurrency);

        return $line;
    }

    // Setters

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setAccruals(\stdClass $stdClass)
    {
        $this->accruals = new Accruals($stdClass->account, $stdClass->endDate, $stdClass->startDate, $stdClass->self);

        return $this;
    }

    /**
     * @param int $amount
     * @return Lines
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param int $amountInBaseCurrency
     * @return Lines
     */
    public function setAmountInBaseCurrency(int $amountInBaseCurrency)
    {
        $this->amountInBaseCurrency = $amountInBaseCurrency;

        return $this;
    }

    /**
     * @param bool $booked
     * @return Lines
     */
    public function setBooked(bool $booked)
    {
        $this->booked = $booked;

        return $this;
    }

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setContraAccount(\stdClass $stdClass)
    {
        $this->contraAccount = new ContraAccount($stdClass->accountNumber, $stdClass->accountType, $stdClass->self);

        return $this;
    }

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setContraVatAccount(\stdClass $stdClass)
    {
        $this->contraVatAccount = new ContraVatAccount($stdClass->vatCode, $stdClass->self);

        return $this;
    }

    /**
     * @param int $contraVatAmount
     * @return Lines
     */
    public function setContraVatAmount(int $contraVatAmount)
    {
        $this->contraVatAmount = $contraVatAmount;

        return $this;
    }

    /**
     * @param int $contraVatAmountInBaseCurrency
     * @return Lines
     */
    public function setContraVatAmountInBaseCurrency(int $contraVatAmountInBaseCurrency)
    {
        $this->contraVatAmountInBaseCurrency = $contraVatAmountInBaseCurrency;

        return $this;
    }

    /**
     * @param string $currency
     * @return Lines
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setDepartment(\stdClass $stdClass)
    {
        $this->department = new Department($stdClass->departmentNumber, $stdClass->self);

        return $this;
    }

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setDepartmentalDistribution(\stdClass $stdClass)
    {
        $this->departmentalDistribution = new DepartmentalDistribution($stdClass->departmentalDistributionNumber, null, $stdClass->self);

        return $this;
    }

    /**
     * @param string $document
     * @return Lines
     */
    public function setDocument(string $document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @param int $entryNumber
     * @return Lines
     */
    public function setEntryNumber(int $entryNumber)
    {
        $this->entryNumber = $entryNumber;

        return $this;
    }

    /**
     * @param int $exchangeRate
     * @return Lines
     */
    public function setExchangeRate(int $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setRemittanceInformation(\stdClass $stdClass)
    {
        $this->remittanceInformation = new RemittanceInformation($stdClass->creditorId, $stdClass->creditorInvoiceId, $stdClass->paymentType, $stdClass->self);

        return $this;
    }

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setSupplier(\stdClass $stdClass)
    {
        $this->supplier = new Supplier($stdClass->supplierNumber, $stdClass->supplierInvoiceNumber, $stdClass->self);

        return $this;
    }

    /**
     * @param string $text
     * @return Lines
     */
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param \stdClass $stdClass
     * @return Lines
     */
    public function setVatAccount(\stdClass $stdClass)
    {
        $this->vatAccount = new VatAccount($stdClass->vatCode, $stdClass->self);

        return $this;
    }

    /**
     * @param int $vatAmount
     * @return Lines
     */
    public function setVatAmount(int $vatAmount)
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }

    /**
     * @param int $vatAmountInBaseCurrency
     * @return Lines
     */
    public function setVatAmountInBaseCurrency(int $vatAmountInBaseCurrency)
    {
        $this->vatAmountInBaseCurrency = $vatAmountInBaseCurrency;

        return $this;
    }
}
