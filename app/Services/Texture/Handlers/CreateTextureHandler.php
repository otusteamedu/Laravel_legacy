<?php


namespace App\Services\Texture\Handlers;


use App\Models\Texture;
use App\Services\Texture\Repositories\TextureRepositoryCms;
use Illuminate\Support\Arr;

class CreateTextureHandler
{
    /**
     * @var TextureRepositoryCms
     */
    private $repository;

    public function __construct(TextureRepositoryCms $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Texture
     */
    public function handle(array $data): Texture {
        $thumbAttributes = uploader()->upload($data['thumb']);
        $sampleAttributes = uploader()->upload($data['sample']);
        $backgroundAttributes = uploader()->upload($data['background']);

        $data = Arr::collapse([
            Arr::except($data, ['thumb', 'sample', 'background']),
            [
                'thumb_path' => $thumbAttributes['path'],
                'sample_path' => $sampleAttributes['path'],
                'background_path' => $backgroundAttributes['path'],
            ]
        ]);

        return $this->repository->store($data);
    }
}
