<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Upload;

/**
 * Поддерживает работу загрузкой файлов в формах
 * Interface IUploadedRepository
 * @package App\Repositories\Interfaces
 */
interface IUploadRepository extends IBaseRepository
{
    /**
     * Получаем устаревшие файлы. Либо просроченные по времени,
     * либо привязанные к несуществующих пользователям
     *
     * @return Collection
     */
    public function getOldUploads(): Collection;
    /**
     * Получить привязанные к пользователю или посетителю
     * @param string $path
     * @param string $session_id
     * @param int $user_id
     * @return Collection
     */
    public function getUploads(string $path, string $session_id, int $user_id = 0) : Collection;
    /**
     * Получить привязанные к пользователю или посетителю, разделенные на поля
     * @param string $path
     * @param string $session_id
     * @param int $user_id
     * @return array
     */
    public function getByFieldsUploads(string $path, string $session_id, int $user_id = 0) : array;
    /**
     * @param string $path
     * @param string $field
     * @return int
     */
    public function getNewSort(string $path, string $field): int;
}
