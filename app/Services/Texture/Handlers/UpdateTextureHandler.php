<?php


namespace App\Services\Texture\Handlers;


use App\Models\Texture;
use App\Services\Texture\Repositories\TextureRepositoryCms;
use Illuminate\Support\Arr;

class UpdateTextureHandler
{
    /**
     * @var TextureRepositoryCms
     */
    private $repository;

    /**
     * UpdateTextureHandler constructor.
     * @param TextureRepositoryCms $repository
     */
    public function __construct(TextureRepositoryCms $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @param Texture $item
     * @return Texture
     */
    public function handle(array $data, Texture $item): Texture
    {
        if (isset($data['thumb'])) {
            $thumbAttributes = uploader()->refresh($item['thumb_path'], $data['thumb']);
            $data['thumb_path'] = $thumbAttributes['path'];
        }

        if (isset($data['sample'])) {
            $sampleAttributes = uploader()->refresh($item['sample_path'], $data['sample']);
            $data['sample_path'] = $sampleAttributes['path'];
        }

        if (isset($data['background'])) {
            $backgroundAttributes = uploader()->refresh($item['background_path'], $data['background']);
            $data['background_path'] = $backgroundAttributes['path'];
        }

        return $this->repository->update(Arr::except($data, ['thumb', 'sample', 'background']), $item);
    }
}
