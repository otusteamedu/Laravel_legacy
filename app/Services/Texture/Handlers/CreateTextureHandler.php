<?php


namespace App\Services\Texture\Handlers;


use App\Models\Texture;
use App\Services\Texture\Repositories\TextureRepository;
use Illuminate\Support\Arr;

class CreateTextureHandler
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
