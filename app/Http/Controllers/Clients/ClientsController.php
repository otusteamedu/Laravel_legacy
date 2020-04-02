<?php
/**
 * Description of ClientsController.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\Clients;


use App\Http\Controllers\Controller;
use App\Services\Clients\DTO\AddressDTO;
use App\Services\Clients\Services\ClientsServiceInterface;
use Illuminate\Http\Request;

class ClientsController extends Controller
{

    private $clientsService;

    public function __construct(
        ClientsServiceInterface $clientsService
    )
    {
        $this->clientsService = $clientsService;
    }

    public function changeAddress(Request $request, $client_id)
    {
        $dto = AddressDTO::fromArray($request->all());
        $this->clientsService->changeAddress($client_id, $dto);

        return $client_id;
    }

}
