<?php
/**
 * Description of Invoice.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Entities;

use App\Services\Clients\Entities\Client;

class Invoice
{

    protected $id;
    protected $client;
    protected $lineItems = [];
    protected $status;

    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    public function getId() {}
    public function getClient() {}

    public function getLineItems() {}
    public function setLineItems() {}

    public function getStatus() {}
    public function setStatus($status) {}

}
