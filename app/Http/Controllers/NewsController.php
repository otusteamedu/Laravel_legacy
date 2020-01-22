<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Cache;

class NewsController extends Controller
{
    public function getAll(Request $request)
    {
        $key = $request->fullUrl();

        if (!Cache::has($key)) {
            $data = News::all();
            Cache::put($key, $data, 180);
        } else {
            $data = Cache::get($key);
        }

        return view('news', compact('data'));
    }

    public function clearCache()
    {
        Cache::flush();
    }




}
