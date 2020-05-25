<?php
/**
 * Description of StylesService.php
 *
 *
 */
namespace App\Services\Styles;

use App\Models\Style;

use App\Services\Styles\Repositories\StyleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StyleService
{

    /** @var StyleRepositoryInterface */
    private $styleRepository;

    private $createStyleHandler;

    public function __construct(

        StyleRepositoryInterface $styleRepository
    )
    {
        $this->styleRepository = $styleRepository;
    }

    /**
     * @param int $id
     * @return Style|null
     */
    public function findStyle(int $id)
    {
        // return $this->styleRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchStyles()
    {
        return $this->styleRepository->search();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchStylesToArray()
    {
        return $this->styleRepository->searchToArray();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchStylePermissions(Style $style)
    {
        return $this->styleRepository->permissions($style);

    }

    /**
     * @param array $data
     * @return Style
     */
    public function storeStyle(array $data): Style
    {
        $style = $this->styleRepository->create($data);
        return $style;
    }

    /**
     * @param Style $style
     * @param array $data
     * @return Style
     */
    public function updateStyle(Style $style, array $data)
    {
        return $this->styleRepository->updateFromArray($style, $data);
    }

    public function deleteStyle(int $id)
    {
        return $this->styleRepository->delete($id);
    }


}