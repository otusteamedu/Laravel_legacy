<?php

namespace App\Services;

use App\Models\Proportion;
use Illuminate\Support\Facades\File;
use App\Http\Resources\Proportion as ProportionResource;

class Uploader
{
    protected $upload,
              $props,
              $uploadPath,
              $newUploadName,
              $validationFailed = false,
              $proportions,
              $proportionId;

    public function __construct(Proportion $proportions) {
        $this->proportions = ProportionResource::collection($proportions->all());
    }

    protected function setProps($name, $value)
    {
        $this->props[$name] = $value;
    }

    public function getProps()
    {
        return $this->props;
    }

    protected function setValidationFailed($value) {
        $this->validationFailed = $value;
    }

    public function getValidationFailed() {
        return $this->validationFailed;
    }


    protected function setProportionId($w, $h) {
        if($h != 0) {
            $ratio = $w / $h;
            foreach($this->proportions as $proportion) {
                if($ratio >= $proportion->min && $ratio < $proportion->max) {
                    $this->proportionId = $proportion->id;
                    return;
                }
            }
        }
        $this->setValidationFailed(true);
        abort(422, 'Пропорции изображения ' . $this->props['originalName'] . ' не входят в допустимые пределы!');
    }

    public function getProportionId() {
        return $this->proportionId;
    }

    public function validate($upload, array $rules = [])
    {
        $this->clearState();
        if ($upload->isValid()) {
            $this->upload = $upload;

            $this->setProps('size', $this->upload->getSize());
            $this->setProps('originalName', preg_replace('/\.' . $this->upload->getClientOriginalExtension() . '$/', '', $this->upload->getClientOriginalName()));
            $this->setProps('extension', mb_strtolower($this->upload->getClientOriginalExtension()));
            $this->setProps('mime', $this->upload->getMimeType());

            if (is_array($rules) && count($rules) > 0) {

                if(isset($rules['allowedExt']) && is_array($rules['allowedExt']) && count($rules['allowedExt']) > 0) {
                    if (!in_array($this->props['extension'], $rules['allowedExt'])) {
                        $this->setValidationFailed(true);
                        abort(422, 'Файл «' . $this->props['originalName'] . '» имеет недопустимое расширение. Разрешены только следующие расширения: ' . implode(', ', $rules['allowedExt']) . '!');
                    }
                }

                if(isset($rules['allowedMime']) && is_array($rules['allowedMime']) && count($rules['allowedMime']) > 0) {
                    if (!in_array($this->props['mime'], $rules['allowedMime'])) {
                        $this->setValidationFailed(true);
                        abort(422, 'Файл «' . $this->props['originalName'] . '» недопустимого типа. Разрешены только следующие MIME типы: ' . implode(', ', $rules['allowedMime']) . '!');
                    }
                }

                if(isset($rules['minSize'])) {
                    if ($this->props['size'] < $rules['minSize']) {
                        $this->setValidationFailed(true);
                        abort(422, 'Файл «' . $this->props['originalName'] . '» имеет недопустимый размер. Минимальный размер загружаемого файла - ' . round($rules['minSize'] / 1024, 1) . 'КБ!');
                    }
                }

                if(isset($rules['maxSize'])) {
                    if ($this->props['size'] > $rules['maxSize']) {
                        $this->setValidationFailed(true);
                        abort(422, 'Файл «' . $this->props['originalName'] . '» имеет недопустимый размер. Максимальный размер загружаемого файла - ' . round($rules['maxSize'] / 1048576, 1) . 'МБ!');
                    }
                }
            }
        } else {
            $this->setValidationFailed(true);
            abort(422, 'Загрузка файла «' . $this->props['originalName'] . '» не удалась или файл поврежден!');
        }

        $this->setProportionId(getImageSize($this->upload)[0], getImageSize($this->upload)[1]);
        $this->setProps('width', getImageSize($this->upload)[0]);
        $this->setProps('height', getImageSize($this->upload)[1]);
        $this->setProps('proportion_id', $this->getProportionId());

        return !$this->getValidationFailed();
    }

    public function upload($basePath = null)
    {
        if ($this->getValidationFailed()) return false;
        $basePath = $basePath ?? ltrim(config('uploads.imageUploadPath', ''));
        $this->newUploadName = sha1($this->props['originalName'] . microtime(true)) . '.' . $this->props['extension'];
        $newDir = substr($this->newUploadName, 0, 1) . '/' . substr($this->newUploadName, 0, 3);

        $this->uploadPath = str_replace('/', '.', $newDir . '/' . $this->newUploadName);
        $newPath = $basePath . '/' . $newDir;

        if (!File::exists($newPath)) {
            if (!File::makeDirectory($newPath, config('uploads.storagePermissions', 0755), true)) {
                abort(422, 'Не могу создать директорию «' . $newPath . '»!');
            }
        }

        if (File::isDirectory($newPath) && File::isWritable($newPath)) {

            $this->upload->move($newPath, $this->newUploadName);

        } else {
            abort(422, 'Директория «' . $newPath . '» недоступна для записи!');
        }

        return File::exists($newPath . '/' . $this->newUploadName) ? $this->newUploadName : false;
    }

    public function register($uploadModel)
    {
        return $uploadModel->create([
            'path' => $this->newUploadName,
            'extension' => $this->props['extension'],
            'mime' => $this->props['mime'],
            'width' => $this->props['width'],
            'height' => $this->props['height'],
            'proportion_id' => $this->props['proportion_id']
        ]);
    }

    public function update($uploadModel)
    {
        return $uploadModel->fill([
            'path' => $this->newUploadName,
            'extension' => $this->props['extension'],
            'mime' => $this->props['mime'],
            'width' => $this->props['width'],
            'height' => $this->props['height'],
            'proportion_id' => $this->props['proportion_id']
        ])->save();
    }

    protected function clearState()
    {
        unset($this->upload, $this->request, $this->props);
    }

    public function remove($uploadPath, $basePath = null)
    {
        $basePath = $basePath ?? ltrim(config('uploads.imageUploadPath', ''));
        $dir = substr($uploadPath, 0, 1) . '/' . substr($uploadPath, 0, 3);
        $pathToDelete = $basePath . $dir . '/' . $uploadPath;
        return File::delete($pathToDelete);
    }
}

// Написать необходимые комментарии для свойств и методов
// Убрать из тела метода setProportionId $this (добавить еще один параметр $proportions)
