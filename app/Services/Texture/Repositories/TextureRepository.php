<?php


namespace App\Services\Texture\Repositories;

use App\Models\Texture;
use App\Services\Resource\Repositories\ResourceRepository;

class TextureRepository extends ResourceRepository
{
    /**
     * TextureRepository constructor.
     * @param Texture $model
     */
    public function __construct(Texture $model)
    {
        $this->model = $model;
    }
}
