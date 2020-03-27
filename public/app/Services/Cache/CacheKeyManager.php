<?php

namespace App\Services\Cache;

use Illuminate\Http\Request;

class CacheKeyManager
{
    public function getClientKey(Request $request)
    {
        return Keys::CLIENTS_KEY . $request->get('page');
    }
}
