<?php

namespace App\Http\Controllers\Api\Cms\Films\Resources;

use App\Models\Film;
use App\Services\Api\Cms\Films\FilmsService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CountryResource
 * @package App\Http\Controllers\Api\Countries\Resources
 * @mixin Country
 */
class FilmResource extends JsonResource
{

    private function getFilmsService(): FilmsService
    {
        return app(FilmsService::class);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status'=>$this->status,
            'slug'=>$this->slug,
            'created_at'=>$this->created_at
        ];

        if ($request->get('withCommentsCount')) {
            $data['comments_count'] = $this->comments()->count();
        }

        return $data;
    }
}
