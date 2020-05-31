<?php


namespace App\Services\File;


use App\Services\DataTransfer\DataTransferInterface;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use App\Models\File as FileModel;


/**
 * Данные файла по пути
 *
 * Class FileDataFromRequest
 * @package App\Services\File
 */
class FileData implements DataTransferInterface
{
    /**
     * @var string
     */
    public $fileName;

    /**
     * @var string
     */
    public $mimeType;

    /**
     * @var integer
     */
    public $size;

    /**
     * @var integer
     */
    public $width;

    /**
     * @var integer
     */
    public $height;

    /**
     * @var string
     */
    public $fileType;

    /**
     * @var integer
     */
    public $usage;

    /**
     * @var int
     */
    public $source;

    /**
     * @var string
     */
    public $subDir;

    /**
     * FileData constructor.
     * @param string $fileName
     * @param string $mimeType
     * @param int $size
     * @param string $subDir
     * @param int|null $source
     * @param int $fileType
     * @param int $usage
     * @param int $width
     * @param int $height
     */
    public function __construct(
        string $fileName,
        string $mimeType,
        int $size,
        string $subDir,
        int $source = null,
        int $fileType = \App\Models\File::FILE_TYPE,
        int $usage = \App\Models\File::USAGE,
        int $width = 0,
        int $height = 0
    )
    {
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->size = $size;
        $this->fileType = $fileType;
        $this->source = $source;
        $this->usage = $usage;
        $this->width = $width;
        $this->height = $height;
        $this->subDir = $subDir;
    }

    public function toArray()
    {
        return Array(
            "file_name" => $this->fileName,
            "mime_type" => $this->mimeType,
            "size" => $this->size,
            "source_id" => $this->source,
            "width" => $this->width,
            "height" => $this->height,
            "file_type" => $this->fileType,
            "usage" => $this->usage,
            "subdir" => $this->subDir
        );
    }
}
