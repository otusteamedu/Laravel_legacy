<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingRunRequest extends FormRequest
{
    public function getRequestedUrl(): ?string
    {
        return $this->get('url', '');
    }

    public function rules()
    {
        return [];
    }
}
