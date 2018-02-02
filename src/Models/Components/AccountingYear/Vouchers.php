<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models\Components\AccountingYear;

use Economic\Economic;
use Economic\Models\Components\NumberSeries;

class Vouchers
{
    /** @var string $attachment */
    public $attachment;
    /** @var bool $booked */
    public $booked;
    /** @var string $date */
    public $date;
    /** @var string $dueDate */
    public $dueDate;
    /** @var array $lines */
    public $lines = [];
    /** @var NumberSeries $numberSeries */
    public $numberSeries;
    /** @var int $remainder */
    public $remainder;
    /** @var int $remainderInDefaultCurrency */
    public $remainderInDefaultCurrency;
    /** @var int $voucherId */
    public $voucherId;
    /** @var VoucherNumber $voucherNumber */
    public $voucherNumber;
    /** @var string $voucherType */
    public $voucherType;
    /** @var string $self */
    public $self;

    /** @var Economic $economic */
    public $economic;

    /**
     * Vouchers constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Voucher.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Vouchers
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $vouchers = new self($economic);

        $vouchers->setAttachment($stdClass->attachment);
        $vouchers->setBooked($stdClass->booked);
        $vouchers->setDate($stdClass->date);
        $vouchers->setDueDate($stdClass->dueDate);
        $vouchers->setLines($stdClass->lines);
        $vouchers->setNumberSeries($stdClass->numberSeries);
        $vouchers->setRemainder($stdClass->remainder);
        $vouchers->setRemainderInDefaultCurrency($stdClass->remainderInDefaultCurrency);
        $vouchers->setVoucherId($stdClass->voucherId);
        $vouchers->setVoucherNumber($stdClass->voucherNumber);
        $vouchers->setVoucherType($stdClass->voucherType);
        $vouchers->setSelf($stdClass->self);

        return $vouchers;
    }

    // Getters & Setters

    /**
     * @return string|null
     */
    public function getAttachment() : ?string
    {
        return $this->attachment;
    }

    /**
     * @param string $attachment
     * @return Vouchers
     */
    public function setAttachment(string $attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getBooked() : ?bool
    {
        return $this->booked;
    }

    /**
     * @param bool $booked
     * @return Vouchers
     */
    public function setBooked(bool $booked)
    {
        $this->booked = $booked;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate() : ?string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Vouchers
     */
    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDueDate() : ?string
    {
        return $this->dueDate;
    }

    /**
     * @param string $dueDate
     * @return Vouchers
     */
    public function setDueDate(string $dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getLines() : ?array
    {
        return $this->lines;
    }

    /**
     * @param array $lines
     * @return Vouchers
     */
    public function setLines(array $lines)
    {
        foreach ($lines as $line) {
            $this->lines[] = Lines::convert($line);
        }

        return $this;
    }

    /**
     * @return NumberSeries|null
     */
    public function getNumberSeries() : ?NumberSeries
    {
        return $this->numberSeries;
    }

    /**
     * @param \stdClass $stdClass
     * @return Vouchers
     */
    public function setNumberSeries(\stdClass $stdClass)
    {
        $this->numberSeries = new NumberSeries($stdClass->numberSeriesNumber, $stdClass->self);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemainder() : ?int
    {
        return $this->remainder;
    }

    /**
     * @param int $remainder
     * @return Vouchers
     */
    public function setRemainder(int $remainder)
    {
        $this->remainder = $remainder;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemainderInDefaultCurrency() : ?int
    {
        return $this->remainderInDefaultCurrency;
    }

    /**
     * @param int $remainderInDefaultCurrency
     * @return Vouchers
     */
    public function setRemainderInDefaultCurrency(int $remainderInDefaultCurrency)
    {
        $this->remainderInDefaultCurrency = $remainderInDefaultCurrency;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVoucherId() : ?int
    {
        return $this->voucherId;
    }

    /**
     * @param int $voucherId
     * @return Vouchers
     */
    public function setVoucherId(int $voucherId)
    {
        $this->voucherId = $voucherId;

        return $this;
    }

    /**
     * @return VoucherNumber|null
     */
    public function getVoucherNumber() : ?VoucherNumber
    {
        return $this->voucherNumber;
    }

    /**
     * @param \stdClass $stdClass
     * @return Vouchers
     */
    public function setVoucherNumber(\stdClass $stdClass)
    {
        $this->voucherNumber = new VoucherNumber($stdClass->displayVoucherNumber, $stdClass->prefix, $stdClass->voucherNumber);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVoucherType() : ?string
    {
        return $this->voucherType;
    }

    /**
     * @param string $voucherType
     * @return Vouchers
     */
    public function setVoucherType(string $voucherType)
    {
        $this->voucherType = $voucherType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return Vouchers
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
