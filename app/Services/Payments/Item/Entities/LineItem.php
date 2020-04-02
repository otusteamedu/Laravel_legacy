<?php
/**
 * Description of LineItem.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Item\Entities;


class LineItem
{

    /**
     * @var Item
     */
    private $item;
    /**
     * @var int
     */
    private $quantity;

    public function __construct(Item $item, int $quantity = 1)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

}
