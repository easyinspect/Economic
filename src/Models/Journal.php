<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 13:59.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\Entries;
use Economic\Models\Components\Settings;
use Economic\Models\Components\Templates;
use Economic\Models\Components\Journals\Voucher;

class Journal
{
    /** @var int $journalNumber */
    private $journalNumber;
    /** @var Entries $entries */
    private $entries;
    /** @var string $name */
    private $name;
    /** @var Templates $templates */
    private $templates;
    /** @var Settings $settings */
    private $settings;
    /** @var string $vouchers */
    private $vouchers;
    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * Journal constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Journal
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Journal
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $journal = new self($economic);

        $journal->setName($stdClass->name);
        $journal->setSelf($stdClass->self);
        $journal->setJournalNumber($stdClass->journalNumber);
        $journal->setVouchers($stdClass->vouchers);
        $journal->setTemplates($stdClass->templates);
        $journal->setEntries($stdClass->entries);
        $journal->setSettings($stdClass->settings);

        return $journal;
    }

    /**
     * Retrieves a collection of Journals
     * @param Filter $filter
     * @return Journal
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/journals-experimental?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/journals-experimental?', $this);
        }
    }

    /**
     * Retrieves a single Journal by its ID
     * @param int $journalNumber
     * @return Journal
     */
    public function get(int $journalNumber)
    {
        return self::transform($this->economic, $this->economic->get('/journals-experimental/'.$journalNumber));
    }

    /**
     * Retrieves a collection of all vouchers that belongs to the given Journal
     * @return Voucher
     */
    public function vouchers()
    {
        return $this->economic->collection('/journals-experimental/'.$this->getJournalNumber().'/vouchers?', new Voucher($this->economic));
    }

    /**
     * Creates a Journal voucher
     * @param int $journalNumber
     * @return Voucher
     */
    public function create(int $journalNumber)
    {
        $this->economic->cleanObject($this->getEntries());

        $voucher = array_map(function ($item) {

            $voucher = new Voucher($this->economic);

            $voucher->setAccountingYear($item->accountingYear);
            $voucher->setJournal($item->journal);
            $voucher->setVoucherNumber($item->voucherNumber);
            $voucher->setAttachment($item->attachment);
            $voucher->setEntries($item->entries);
            $voucher->setSelf($item->self);

            return $voucher;

        }, $this->economic->create('/journals-experimental/'.$journalNumber.'/vouchers', $this->getEntries()));

        return $voucher;
    }

    // Getters & Setters

    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getVouchers() : ?string
    {
        return $this->vouchers;
    }

    /**
     * @param string $vouchers
     * @return $this
     */
    public function setVouchers(string $vouchers = null)
    {
        $this->vouchers = $vouchers;

        return $this;
    }

    /**
     * @return int
     */
    public function getJournalNumber() : ?int
    {
        return $this->journalNumber;
    }

    /**
     * @param int $journalNumber
     * @return $this
     */
    public function setJournalNumber(int $journalNumber = null)
    {
        $this->journalNumber = $journalNumber;

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
    public function setSelf(string $self = null)
    {
        $this->self = $self;

        return $this;
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function setEntries($entries, $year = null)
    {
        if (is_string($entries)) {
            $this->entries = $entries;
        } else {
            $this->entries[] = new Entries($year, $entries);
        }

        return $this;
    }

    /**
     * @return Templates
     */
    public function getTemplates() : ?Templates
    {
        return $this->templates;
    }

    /**
     * @param Templates $template
     * @return $this
     */
    public function setTemplates($template = null)
    {
        if (isset($template)) {
            $this->templates = new Templates($template->financeVoucher, $template->manualCustomerInvoice, $template->self);
        }

        return $this;
    }

    /**
     * @return Settings
     */
    public function getSettings() : ?Settings
    {
        return $this->settings;
    }

    /**
     * @param \stdClass $settings
     * @return Journal
     */
    public function setSettings($settings = null)
    {
        if (isset($settings)) {
            $this->settings = new Settings($settings->contraAccounts ?? null, $settings->entryTypeRestrictedTo ?? null, $settings->voucherNumbers ?? null);
        }

        return $this;
    }
}
