<?php
/**
 * Description of ClientsService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Clients\Services;


use App\Services\Clients\DTO\AddressDTO;
use App\Services\Clients\Entities\Address;
use App\Services\Invoices\Repositories\ClientRepositoryInterface;

class ClientsService implements ClientsServiceInterface
{

    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    public function __construct(
        ClientRepositoryInterface $clientRepository
    )
    {

        $this->clientRepository = $clientRepository;
    }

    public function findById($clientId)
    {
        return $this->clientRepository->findById($clientId);
    }

    public function changeAddress($id, AddressDTO $addressDTO)
    {
        $client = $this->clientRepository->findById($id);

        $address = new Address(
            $addressDTO->country,
            $addressDTO->city,
            $addressDTO->zip,
            $addressDTO->lines
        );
        $client->changeAddress($address);

        $this->clientRepository->update($client);
    }
}
