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
use Economic\Models\Components\Journals\Voucher;
use Economic\Models\Components\Settings;
use Economic\Models\Components\Templates;
use Economic\Models\Components\AccountingYear;

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
    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function transformVoucher($api, $object) {


        if (isset($object->collection)) {

            $voucher = array_map(function ($item) use ($api) {

                $voucher = new Voucher($api);

                $voucher->setAccountingYear($item->accountingYear);
                $voucher->setEntries($item->entries);
                $voucher->setJournal($item->journal);
                $voucher->setVoucherNumber($item->voucherNumber);
                $voucher->setAttachment($item->attachment);
                $voucher->setSelf($item->self);

                return $voucher;

            }, $object->collection);

        } else {

            $voucher = array_map(function ($item) use ($api) {

                $voucher = new Voucher($api);

                $voucher->setAccountingYear($item->accountingYear);
                $voucher->setEntries($item->entries);
                $voucher->setJournal($item->journal);
                $voucher->setAttachment($item->attachment);
                $voucher->setVoucherNumber($item->voucherNumber);
                $voucher->setSelf($item->self);

                return $voucher;

            }, $object);
        }

        return $voucher;
    }

    public static function transform($api, $object)
    {
        $journal = new self($api);

        $journal->setName($object->name);
        $journal->setSelf($object->self);
        $journal->setJournalNumber($object->journalNumber);
        $journal->setVouchers($object->vouchers);
        $journal->setTemplates($object->templates);
        $journal->setEntries($object->entries);
        $journal->setSettings($object->settings);


        return $journal;
    }

    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('/journals-experimental?'.$filter->filter().'&', $this);
        } else {
            return $this->api->collection('/journals-experimental?', $this);
        }
    }

    public function get($journalNumber)
    {
        return self::transform($this->api, $this->api->get('/journals-experimental/'.$journalNumber));
    }

    public function vouchers()
    {
        return self::transformVoucher($this->api, $this->api->get('journals-experimental/'.$this->getJournalNumber().'/vouchers'));
    }

    public function create($journalNumber)
    {
        $this->api->cleanObject($this->getEntries());

        return self::transformVoucher($this->api, $this->api->create('/journals-experimental/'.$journalNumber.'/vouchers', $this->getEntries()));

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

    public function getSettings() : ?Settings
    {
        return $this->settings;
    }

    public function setSettings($settings = null)
    {
        if (isset($settings)) {
            $this->settings = new Settings($settings->contraAccounts ?? null, $settings->entryTypeRestrictedTo ?? null, $settings->voucherNumbers ?? null);
        }

        return $this;
    }

    public function getAttachment() : ?string
    {
        return $this->attachment;
    }

    public function setAttachment(string $attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }
}
