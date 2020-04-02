<?php
/**
 * Description of SqlInvoiceRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Repositories;

use App\Services\Invoices\Entities\Invoice\Invoice;
use Illuminate\Database\Connection;

class SqlInvoiceRepository implements InvoiceRepositoryInterface
{

    public function create(Invoice $invoice)
    {
        \DB::transactionBegin();

        \DB::insert('invoices', [
            'id' => $invoice->getId(),
            'client_id' => $invoice->getClient()->getId(),
            'status' => $invoice->getStatus()
        ]);

        foreach ($invoice->getLineItems() as $lineItem) {
            \DB::insert('invoice_lines', [
                'invoice_id' => $invoice->getId(),
                'item_id' => $lineItem->getItem()->getId(),
                'quantity' => $lineItem->getQuantity(),
            ]);
        }

        \DB::commit();
    }

    public function findById(int $id): Invoice
    {
        // TODO: Implement findById() method.
    }

    public function add(Invoice $invoice): Invoice
    {
        // TODO: Implement add() method.
    }

    public function update(Invoice $invoice): Invoice
    {
        // TODO: Implement update() method.
    }


}
