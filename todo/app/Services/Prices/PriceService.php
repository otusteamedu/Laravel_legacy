<?php
/**
 * Description of PricesService.php
 *
 *
 */
namespace App\Services\Prices;

use App\Models\Price;

use App\Services\Prices\Repositories\PriceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PriceService
{

    /** @var PriceRepositoryInterface */
    private $priceRepository;

    private $createPriceHandler;

    public function __construct(

        PriceRepositoryInterface $priceRepository
    )
    {
        $this->priceRepository = $priceRepository;
    }

    /**
     * @param int $id
     * @return Price|null
     */
    public function findPrice(int $id)
    {
        // return $this->priceRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPrices()
    {
        return $this->priceRepository->search();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPricesToArray()
    {
        return $this->priceRepository->searchToArray();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPricePermissions(Price $price)
    {
        return $this->priceRepository->permissions($price);

    }

    /**
     * @param array $data
     * @return Price
     */
    public function storePrice(array $data): Price
    {
        $price = $this->priceRepository->create($data);
        return $price;
    }

    /**
     * @param Price $price
     * @param array $data
     * @return Price
     */
    public function updatePrice(Price $price, array $data)
    {
        return $this->priceRepository->updateFromArray($price, $data);
    }

    public function deletePrice(int $id)
    {
        return $this->priceRepository->delete($id);
    }


}