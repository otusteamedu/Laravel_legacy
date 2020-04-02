<?php
/**
 * Description of InvoiceRepositoryInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Repositories;


use App\Models\Invoice;
use App\Services\Invoices\Exceptions\InvoiceNotFoundException;

interface InvoiceRepositoryInterface
{
    public function findById(int $id): Invoice;
    public function create(Invoice $invoice): Invoice;

    public function update(Invoice $invoice): Invoice;
}
