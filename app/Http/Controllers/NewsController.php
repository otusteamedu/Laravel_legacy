<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\News\NewsService;
use Illuminate\Http\Request;
use Cache;
use App\Http\Controllers\Cms\Requests;

class NewsController extends Controller
{
    private $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getAll()
    {
        $data = $this->newsService->getCachedNews();

        return view('news', compact('data'));
    }

    public function getId($id)
    {
        $data = $this->newsService->getCachedId($id);
        return view('newsid', compact('data'));
    }

    public function clearCache()
    {
        Cache::flush();
    }


}
