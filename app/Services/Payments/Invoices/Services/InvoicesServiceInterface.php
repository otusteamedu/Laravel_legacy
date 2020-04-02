<?php
/**
 * Description of InvoicesServiceInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Services;

interface InvoicesServiceInterface
{
    public function create($clientId);
    public function addLineItem($id, $itemId, $quantity);
    public function reject($id);
    public function process($id);
}
