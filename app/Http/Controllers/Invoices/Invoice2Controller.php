<?php
/**
 * Description of InvoiceController.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\Invoices;


use App\Models\Client;
use App\Services\Invoices\Services\InvoicesServiceInterface;

class Invoice2Controller
{

    /**
     * @var InvoicesServiceInterface
     */
    private $invoicesService;

    public function __construct(
        InvoicesServiceInterface $invoicesService
    )
    {
        $this->invoicesService = $invoicesService;
    }

    public function create(Client $client)
    {
        return $this->invoicesService->create($client);
    }

    public function reject(int $client_id)
    {
        return $this->invoicesService->reject($client_id);
    }

}
