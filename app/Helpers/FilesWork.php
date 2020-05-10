<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class FilesWork
{

    /**
     * Метод возвращает путь к папке (директории)
     * в которой должен храниться файл, прикрепленный к id
     * записи в БД. Т к в одной папке не должно быть вложенность
     * больше 1000 папок, то путь дробится по 3 символа, таким образом,
     * если в этот метод передавать только положительные числа,
     * то в папках с файлами вложенность будет меньше 1000 папок
     *
     * @param  string $num - число (обычно id)
     * @return string      - путь вида "1" или "12" или "123"
     *                             или "123/4" или "123/45" или "123/456"
     *                             или "123/456/7"
     */
    public static function path($num): string
    {
        return trim(chunk_split($num, 3, '/'), '/');
    }

    /**
     * Запись файла в указанную директорию.
     *
     * @param UploadedFile $file
     * @param [type] $path
     * @param [type] $id
     * @param string $disc
     * @return string|false
     */
    public static function storeFile(UploadedFile $file=null, string $path, int $id, $disc = 'public')
    {
        if($file){
            $fileName = $file->getClientOriginalName();
            return $file->storeAs($path.self::path($id), $fileName,$disc);
        }
        return false;
    }

    /**
     * Полный путь до файла.
     *
     * @param string $path
     * @param integer $id
     * @param string $name
     * @return string
     */
    public static function getPath(string $path, int $id, string $name): string
    {
        $fullPath = $path.self::path($id).'/'.$name;
        return $fullPath;
    }
}