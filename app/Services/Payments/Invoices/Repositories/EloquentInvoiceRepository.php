<?php
/**
 * Description of EloquentInvoiceRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Payments\Invoices\Repositories;


use App\Models\Invoice;
use App\Services\Invoices\Repositories\InvoiceRepositoryInterface;

class EloquentInvoiceRepository implements InvoiceRepositoryInterface
{

    public function findById(int $id): Invoice
    {
        // TODO: Implement findById() method.
    }

    public function create(Invoice $invoice): Invoice
    {
        // TODO: Implement create() method.
    }

    public function update(Invoice $invoice): Invoice
    {
        // TODO: Implement update() method.
    }
}
