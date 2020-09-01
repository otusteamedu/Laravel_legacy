<?php


namespace App\Services\Elastic;


trait Searchable
{
    public static function bootSearchable()
    {
        // Это облегчает переключение флага поиска.
        if (config('services.search.enabled')) {
            static::observe(ElasticsearchObserver::class);
        }
    }
    public function getSearchIndex()
    {
        return $this->getTable();
    }
    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }
    public function toSearchArray()
    {
        // Наличие пользовательского метода
        // преобразования модели в поисковый массив
        // позволит нам настраивать данные
        // которые будут доступны для поиска
        // по каждой модели.
        return $this->toArray();
    }
}
