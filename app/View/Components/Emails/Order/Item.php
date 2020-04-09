<?php

namespace App\View\Components\Emails\Order;

use Illuminate\View\Component;

class Item extends Component
{
    public array $item;

    /**
     * Item constructor.
     * @param array $item
     */
    public function __construct(array $item)
    {
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.emails.order.item');
    }
}
