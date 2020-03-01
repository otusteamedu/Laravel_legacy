<?php

namespace App\Http\Controllers\API\Client\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{
    public function index(FormRequest $request)
    {
        $data = $request->all();

        $key = md5('images_' . $data['current_page'] . '_' . $data['per_page'] . '_' . $data['sort_order'] ?? 'asc');

        $images = Cache::tags('images')->remember($key, 600, function () use ($data) {
            return Image::where('publish', 1)
                ->orderBy('id', $data['sort_order'] ?? 'asc')
                ->paginate($data['per_page'], ['*'], '', $data['current_page']);
        });

//        $images = Image::where('publish', 1)
//                ->orderBy('id', $data['sort_order'] ?? 'asc')
//                ->paginate($data['per_page'], ['*'], '', $data['current_page']);

        return response()->json($images);
    }
}
