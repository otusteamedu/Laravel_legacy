<?php


namespace App\Services;


use Illuminate\Http\Request;

class ValidationService
{
    public function validate(Request $request, $rules = [])
    {
        return $request->validate($rules);
    }
}
