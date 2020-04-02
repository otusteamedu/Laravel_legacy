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
use Faker\Provider\Uuid;

class InvoiceController
{

    public function create()
    {
        $client = new Client(
            \Ramsey\Uuid\Uuid::uuid1(),
            new Name('Фамилия', 'Имя', 'Отчество'),
            new Address('Украина', 'Киев', '01001', ['ул. Кодеров, д. 0xFF']),
            new Phone('380', '44', '1234567')
        );

        $item = new Item();
        $quantity = 1;
        $invoice = new Invoice(Uuid::uuid(), $client);

        $invoice->addLineItem(new LineItem($item, $quantity));
        $invoice->changeStatus(new NewStatus());

        // Save invoice
    }




}
