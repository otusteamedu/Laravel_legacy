<?php

namespace App\Http\Controllers;

use App\Services\Cache\CacheService;
use Illuminate\Http\Request;
use DB;

class CacheController extends Controller
{
    protected $cacheService;

    public function __construct(
        CacheService $cacheService
    )
    {
        $this->cacheService = $cacheService;
    }

    public function index()
    {
        return view('cache');
    }

    public function clear()
    {
        $this->cacheService->clear();
        return 'Кэш очищен';
    }

    public function clearGrammarDetail()
    {
        $this->cacheService->clearGrammarDetail();
        return 'Страницы грамматики удалены из кэша';
    }

    public function clearKey(Request $request)
    {
        $this->cacheService->clearKey($request->key);
        return 'Ключ <u>' . $request->key . '</u> удален';
    }

    public function heating()
    {
        $this->cacheService->heating();
        return 'Кэш прогрет';
    }
}
