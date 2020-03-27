<?php

namespace App\Services\Uploader;

use App\Services\Format\FormatService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class Uploader
{
    private $fileProps = [];
    private $baseStoragePath;
    private $uploadRules;

    /**
     * @var ImageValidationBuilder
     */
    private $imageValidationBuilder;

    /**
     * Image formats
     * @var FormatService
     */
    private $formatService;

    public function __construct(
        ImageValidationBuilder $imageValidationBuilder,
        FormatService $formatService
    ) {
        $this->imageValidationBuilder = $imageValidationBuilder;
        $this->formatService = $formatService;
        $this->baseStoragePath = ltrim(config('uploads.image_upload_path', ''));
        $this->uploadRules = config('uploads.image_upload_rules', '');
    }

    protected function setProps($name, $value)
    {
        $this->fileProps[$name] = $value;
    }

    /**
     * @param int $width
     * @param int $height
     * @param Collection $formats
     * @return int|void
     */
    protected function getFormatId(int $width, int $height, Collection $formats)
    {
        return $height != 0
            ? $this->defineImageFormat($width, $height, $formats)
            : abort(422, trans('image_validation.wrong_proportions', ['file_name' => $this->fileProps['original_name']]));
    }

    /**
     * @param int $width
     * @param int $height
     * @param Collection $formats
     * @return int
     */
    protected function defineImageFormat(int $width, int $height, Collection $formats): int
    {
        $ratio = $width / $height;
        foreach($formats as $format) {
            if(($ratio >= $format->min) && ($ratio < $format->max)) {

                return $format->id;
            }
        }
    }

    /**
     * @param UploadedFile $uploadFile
     * @return bool
     */
    public function validate(UploadedFile $uploadFile): bool
    {
        if (!$uploadFile->isValid()) {
            abort(422, trans('image_validation.loading_failed', [
                'file_name' => $this->getOriginalName($uploadFile)
            ]));
        }

        $this->setValidatedProps($uploadFile);

        return $this->imageValidationBuilder
            ->init($this->fileProps, $this->uploadRules)
            ->isAllowExtension()
            ->isAllowMime()
            ->isAllowMinSize()
            ->isAllowMaxSize()
            ->isAllow();
    }

    /**
     * @param UploadedFile $uploadFile
     * @param null $pathStorage
     * @return array|void
     */
    public function upload(UploadedFile $uploadFile, $pathStorage = null)
    {
        $this->clearState();

        $this->validate($uploadFile);

        $storagePath = $pathStorage ?? $this->baseStoragePath;

        $this->setQuantitativeProps($uploadFile, $storagePath);

        $this->makeDirectory($this->fileProps['path']);

        $uploadFile->move($this->fileProps['path'], $this->fileProps['name']);

        return File::exists($this->fileProps['path'] . '/' . $this->fileProps['name'])
            ? $this->getArrayOfAttributesForRecord()
            : abort(422, trans('image_validation.error_image_upload'));
    }

    public function register($uploadModel, array $recordAttributes)
    {
        return $uploadModel
            ->create($recordAttributes);
    }

    public function store(UploadedFile $uploadFile, $uploadModel, $pathStorage = null)
    {
        $recordAttributes = $this->upload($uploadFile, $pathStorage);

        return $this->register($uploadModel, $recordAttributes);
    }

    /**
     * @param $uploadModel
     * @param array $recordAttributes
     * @return mixed
     */
    public function update($uploadModel, array $recordAttributes)
    {
        return $uploadModel
            ->fill($recordAttributes)
            ->save();
    }

    protected function clearState()
    {
        unset($this->request, $this->fileProps);
    }

    /**
     * @param string $uploadPath
     * @param string|null $pathStorage
     * @return bool
     */
    public function remove(string $uploadPath, string $pathStorage = null): bool
    {
        $storagePath = $pathStorage ?? $this->baseStoragePath;
        $dir = substr($uploadPath, 0, 1) . '/' . substr($uploadPath, 0, 3);
        $pathToDelete = $storagePath . $dir . '/' . $uploadPath;

        return File::delete($pathToDelete);
    }

    /**
     * @param string $imagePath
     * @param UploadedFile $image
     * @param null $pathStorage
     * @return array|void
     */
    public function refresh(string $imagePath, UploadedFile $image, $pathStorage = null): array
    {
        $this->remove($imagePath, $pathStorage);

        return $this->upload($image, $pathStorage);
    }

    /**
     * Returns the original name of uploaded file
     *
     * @param UploadedFile $uploadFile
     * @return string|string[]|null
     */
    protected function getOriginalName(UploadedFile $uploadFile) : string
    {
        return preg_replace('/\.' . $uploadFile->getClientOriginalExtension() . '$/', '', $uploadFile->getClientOriginalName());
    }

    /**
     * Sets the properties of the uploaded image file that will be validated
     *
     * @param UploadedFile $uploadFile
     */
    protected function setValidatedProps(UploadedFile $uploadFile)
    {
        $this->setProps('original_name', $this->getOriginalName($uploadFile));
        $this->setProps('size', $uploadFile->getSize());
        $this->setProps('extension', mb_strtolower($uploadFile->getClientOriginalExtension()));
        $this->setProps('mime', $uploadFile->getMimeType());
    }

    /**
     * Set the quantitative properties of the uploaded image file
     *
     * @param UploadedFile $uploadFile
     * @param string $pathStorage
     */
    protected function setQuantitativeProps(UploadedFile $uploadFile, string $pathStorage)
    {
        $this->setProps('width', getImageSize($uploadFile)[0]);
        $this->setProps('height', getImageSize($uploadFile)[1]);
        $this->setProps('format_id', $this->getFormatId(getImageSize($uploadFile)[0], getImageSize($uploadFile)[1], $this->formatService->index()));
        $this->setProps('name', sha1($this->fileProps['original_name'] . microtime(true)) . '.' . $this->fileProps['extension']); // 3e89bc7b416ccce075e0fca2f2cc1172feb6dc24.jpg
        $this->setProps('directory', substr($this->fileProps['name'], 0, 1) . '/' . substr($this->fileProps['name'], 0, 3)); // 3/3e8
        $this->setProps('path', $pathStorage . $this->fileProps['directory']);
    }

    /**
     * Checks if it is possible to create a file or directory and make directory
     *
     * @param string $path
     * @return bool
     */
    protected function makeDirectory(string $path): bool
    {
        if (!File::exists($path) && !File::makeDirectory($path, config('uploads.storage_permissions', 0755), true)) {
            abort(500, trans('image_validation.can_not_create_directory', ['path' => $path]));
        }

        return $this->isWritableDirectory($path);
    }

    /**
     * Check if the directory is writable
     *
     * @param string $path
     * @return bool
     */
    protected function isWritableDirectory(string $path): bool
    {
        if (!File::isDirectory($path) || !File::isWritable($path)) {
            abort(500, trans('image_validation.not_writable_directory', ['path' => $path]));
        }

        return true;
    }

    /**
     * @return array
     */
    protected function getArrayOfAttributesForRecord(): array
    {
        return [
            'path' => $this->fileProps['name'],
            'extension' => $this->fileProps['extension'],
            'mime' => $this->fileProps['mime'],
            'width' => $this->fileProps['width'],
            'height' => $this->fileProps['height'],
            'format_id' => $this->fileProps['format_id']
        ];
    }
}
