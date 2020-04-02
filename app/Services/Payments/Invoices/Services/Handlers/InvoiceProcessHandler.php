<?php

use App\Services\Invoices\Events\InvoiceStatusChangedEvent;

/**
 * Description of InvoiceProcessHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

class InvoiceProcessHandler
{

    /**
     * @var \App\Services\Invoices\Repositories\InvoiceRepositoryInterface
     */
    private $invoiceRepository;

    public function __construct(
        \App\Services\Invoices\Repositories\InvoiceRepositoryInterface $invoiceRepository
    )
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function handle($id)
    {
        $invoice = $this->invoiceRepository->findById($id);
        $invoice->changeStatus(new ProcessingStatus());

        $this->invoiceRepository->update($invoice);
        InvoiceStatusChangedEvent::dispatch($id);
    }

}
