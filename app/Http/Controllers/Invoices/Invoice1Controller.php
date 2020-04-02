<?php
/**
 * Description of InvoiceController.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\Invoices;


use App\Models\Client;
use App\Services\Invoices\Entities\Client\Address;
use App\Services\Invoices\Entities\Client\Name;
use App\Services\Invoices\Entities\Client\Phone;
use App\Services\Invoices\Entities\Invoice\Invoice;
use App\Services\Invoices\Entities\Item\Item;
use App\Services\Invoices\Repositories\ClientRepositoryInterface;
use App\Services\Invoices\Repositories\InvoiceRepositoryInterface;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class Invoice1Controller
{

    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        ClientRepositoryInterface $clientRepository
    )
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->clientRepository = $clientRepository;
    }

    public function create(int $client_id)
    {
        $client = $this->clientRepository->findById($client_id);

        $invoice = new Invoice(Uuid::uuid(), $client);
        $invoice->changeStatus(new NewStatus());
        $this->invoiceRepository->add($invoice);

        return $invoice->getId();
    }




}
