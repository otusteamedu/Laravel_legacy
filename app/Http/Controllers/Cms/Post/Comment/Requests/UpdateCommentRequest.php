<?php

namespace App\Http\Controllers\Cms\Post\Comment\Requests;

use Arr;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePageRequest
 * @package App\Http\Controllers\Cms\Page\Requests
 */
class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'action' => 'required|in:published,unpublished',
        ];
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        $data = $this->request->all();

        switch ($data['action']) {
            case 'published':
                $data['published_at'] = Carbon::now();
                break;
            case 'unpublished':
                $data['published_at'] = null;
                break;
        }

        $data = Arr::except($data, [
            '_token', '_method', 'action',
        ]);

        return $data;
    }
}
