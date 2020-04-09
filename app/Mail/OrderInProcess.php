<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInProcess extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * OrderInProcess constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.process')
            ->with([
                'number' => $this->order->number,
                'price' => $this->order->price,
                'deliveryPrice' => json_decode($this->order->delivery, true)['price'],
                'items' => json_decode($this->order->items, true),
                'delivery' => json_decode($this->order->delivery, true),
                'customer' => json_decode($this->order->customer, true),
                'comment' => $this->order->comment,
                'status' => OrderStatus::findOrFail($this->order->status_id),
                'date' => $this->order->created_at->format('d.m.Y')
            ]);
    }
}
