<?php
/**
 * Description of InvoicesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Services;


use App\Services\Invoices\Entities\Invoice;
use App\Services\Invoices\Entities\Statuses\NewStatus;
use App\Services\Invoices\Events\InvoiceStatusChangedEvent;
use App\Services\Invoices\Exceptions\InvoiceNotFoundException;
use App\Services\Invoices\Exceptions\ModificationProhibitedException;
use App\Services\Invoices\Repositories\ClientRepositoryInterface;
use App\Services\Invoices\Repositories\InvoiceRepositoryInterface;
use Ramsey\Uuid\Uuid;

class InvoicesService implements InvoicesServiceInterface
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;
    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;

    public function __construct(
        ClientRepositoryInterface $clientRepository,
        InvoiceRepositoryInterface $invoiceRepository
    ) {

        $this->clientRepository = $clientRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function create($clientId)
    {
        $client = $this->clientRepository->findById($clientId);

        $invoice = new Invoice(Uuid::uuid1(), $client);
        $invoice->changeStatus(new NewStatus());

        $this->invoiceRepository->create($invoice);

        return $invoice->getId();
    }

    public function addLineItem($id, $itemId, $quantity)
    {
        // TODO: Implement addLineItem() method.
    }

    /**
     * @param $invoiceId
     * @return bool
     * @throws InvoiceNotFoundException
     * @throws ModificationProhibitedException
     * @throws \App\Services\Invoices\Exceptions\WrongStatusChangeDirectionException
     */
    public function reject($invoiceId): bool
    {
        $invoice = $this->invoiceRepository->findById($invoiceId);
        if (!$invoice) {
            throw new InvoiceNotFoundException();
        }

        $invoice->changeStatus(new RejectedStatus());

        if ($this->invoiceRepository->update($invoice) === false) {
            throw new ModificationProhibitedException();
        }

        return true;
    }

    public function process($id)
    {
        $this->invoiceProcesshandler->id($id);
    }

}
