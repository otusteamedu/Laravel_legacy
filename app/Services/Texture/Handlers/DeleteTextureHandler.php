<?php


namespace App\Services\Texture\Handlers;


use App\Models\Texture;
use App\Services\Texture\Repositories\TextureRepository;

class DeleteTextureHandler
{
    /**
     * @var TextureRepository
     */
    private $repository;

    public function __construct(TextureRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Texture $item
     * @return int
     * @throws \Exception
     */
    public function handle(Texture $item): int
    {
        uploader()->remove($item['thumb_path']);
        uploader()->remove($item['sample_path']);
        uploader()->remove($item['background_path']);

        return $this->repository->destroy($item);
    }
}
