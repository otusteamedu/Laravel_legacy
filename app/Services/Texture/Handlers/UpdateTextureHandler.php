<?php


namespace App\Services\Texture\Handlers;


use App\Models\Texture;
use App\Services\Texture\Repositories\CmsTextureRepository;
use Illuminate\Support\Arr;

class UpdateTextureHandler
{
    private CmsTextureRepository $repository;

    /**
     * UpdateTextureHandler constructor.
     * @param CmsTextureRepository $repository
     */
    public function __construct(CmsTextureRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $updateData
     * @param Texture $item
     * @return Texture
     */
    public function handle(Texture $item, array $updateData): Texture
    {
        if (isset($updateData['thumb'])) {
            $thumbAttributes = uploader()->refresh($item['thumb_path'], $updateData['thumb']);
            $updateData['thumb_path'] = $thumbAttributes['path'];
        }

        if (isset($updateData['sample'])) {
            $sampleAttributes = uploader()->refresh($item['sample_path'], $updateData['sample']);
            $updateData['sample_path'] = $sampleAttributes['path'];
        }

        if (isset($updateData['background'])) {
            $backgroundAttributes = uploader()->refresh($item['background_path'], $updateData['background']);
            $updateData['background_path'] = $backgroundAttributes['path'];
        }

        return $this->repository->update($item, Arr::except($updateData, ['thumb', 'sample', 'background']));
    }
}
