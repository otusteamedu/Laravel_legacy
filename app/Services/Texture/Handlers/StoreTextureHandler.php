<?php


namespace App\Services\Texture\Handlers;


use App\Models\Texture;
use App\Services\Texture\Repositories\CmsTextureRepository;
use Illuminate\Support\Arr;

class StoreTextureHandler
{
    private CmsTextureRepository $repository;

    public function __construct(CmsTextureRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $storeData
     * @return Texture
     */
    public function handle(array $storeData): Texture
    {
        $thumbAttributes = uploader()->upload($storeData['thumb']);
        $sampleAttributes = uploader()->upload($storeData['sample']);
        $backgroundAttributes = uploader()->upload($storeData['background']);

        $storeData = Arr::collapse([
            Arr::except($storeData, ['thumb', 'sample', 'background']),
            [
                'thumb_path' => $thumbAttributes['path'],
                'sample_path' => $sampleAttributes['path'],
                'background_path' => $backgroundAttributes['path'],
            ]
        ]);

        return $this->repository->store($storeData);
    }
}
