<?php
/**
 * Description of Invoices.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers;

use App\Services\Invoices\Entities\Client\Address;
use App\Services\Invoices\Entities\Client\Name;
use App\Services\Invoices\Entities\Client\Phone;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use View;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;

class InvoiceController extends Controller
{
    public function create(int $client_id, array $item_ids)
    {
        $client = Client::findOrFail($client_id);
        $items = Item::whereIdIn($item_ids)->get();
        if ($items->isEmapty()) {
            abort(404);
        }
        $invoice = new Invoice();
        $invoice->client_id = $client->id;
        $invoice->status = 'new';
        $invoice->attach($items);
        $invoice->save();

        Mail::send('emails.invoice', [
            'invoice' => $invoice,
        ]);

        View::share([
            'invoice' => $invoice,
        ]);
        return view('invoice');
    }





    public function addItem(Invoice $invoice, Item $item)
    {
        if ($invoice->status !== 'new') {
            abort(403);
        }
        $invoice->attach($item);
        $invoice->save();

        View::share([
            'invoice' => $invoice,
        ]);
        return view('invoice');
    }
}
