<?php
/**
 * Description of Item.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Item\Entities;


use App\Services\Invoices\Item\Entities\Money;

class Item
{

    private $id;
    private $name;
    /**
     * @var Money
     */
    private $price;

    public function __construct($id, $name, Money $price)
    {

        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

}
