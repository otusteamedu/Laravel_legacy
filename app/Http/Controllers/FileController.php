<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class FileController extends Controller
{
    public function index()
    {
        return view('file.index');
    }

    public function store(Request $request)
    {
        $path = $request->file('file')
            ->store('/file');
        Log::info('Внимание! Добавлен файл');

        return $path . ' add file';
    }
}
