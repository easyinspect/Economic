<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 13:59
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\Journals\Entries;
use Economic\Models\Components\Journals\Entry;

class Journals
{
    /** @var array $entries */
    private $entries = [];
    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function get($id)
    {
        $journal = $this->api->retrieve('/journals-experimental/'.$id.'/vouchers');
        return $journal;
    }

    public function create($id)
    {

        $entry = $this->api->create('/journals-experimental/'.$id.'/vouchers', $this->getEntries());
        $this->api->setObject($entry, $this);
        return $this;
    }

    public function getEntries() : array
    {
        return $this->entries;
    }

    public function setEntries(string $year, int $voucherNumber, Entries $entries)
    {
        $this->entries[] = new Entry($year, $voucherNumber, $entries);
        return $this;
    }



}