<?php
/**
 * Description of InvoiceRepositoryInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Clients\Repositories;


use App\Models\Client;

interface ClientRepositoryInterface
{
    public function findById(int $id): Client;

    public function create(Client $client): Client;

    public function update(Client $invoice): Client;
}
