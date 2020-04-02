<?php
/**
 * Description of InvoicesServiceInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Clients\Services;

use App\Services\Clients\DTO\AddressDTO;
use App\Services\Clients\Entities\Address;

interface ClientsServiceInterface
{
    public function findById($clientId);
    public function changeAddress(int $id, AddressDTO $dto);
}
