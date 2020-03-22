<?php

namespace App\Http\Services\News;

use App\Http\Handlers\News\CreateNewsHandler;
use App\Http\Handlers\News\DeleteNewsHandler;
use App\Http\Handlers\News\UpdateNewsHandler;
use App\Models\News;

class NewsService{

    protected $createCategoryHandler;

    protected $updateCategoryHandler;

    protected $deleteCategoryHandler;

    protected $categoryRepository;

    public function __construct(
        CreateNewsHandler $createNewsHandler,
        UpdateNewsHandler $updateNewsHandler,
        DeleteNewsHandler $deleteNewsHandler
    ) {
        $this->createNewsHandler = $createNewsHandler;
        $this->updateNewsHandler = $updateNewsHandler;
        $this->deleteNewsHandler = $deleteNewsHandler;
    }

    public function createNews(array $data){
        $result = $this->createNewsHandler->handle($data);
        return $result;
    }

    public function updateNews(News $news, array $data){
        $result = $this->updateNewsHandler->handle($news, $data);
        return $result;
    }

    public function deleteNews(News $news){
        $result = $this->deleteNewsHandler->handle($news);
        return $result;
    }
}
