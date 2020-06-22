<?php

namespace App\Models\Traits;

trait GetPage
{
    public static function getPage(int $page = 1, int $perPage = 20, string $search = null)
    {
        if ($search && strlen($search) >= 3) {
            $page = self::where('name', 'like', '%' . $search . '%')
                ->paginate($perPage, ['*'], 'page', $page)->toArray();
        } else {
            $page = self::paginate($perPage, ['*'], 'page', $page)
                ->toArray();
        }

        if (!$page) {
            return [
                'entities' => [],
                'is_next_page_exist' => false,
                'is_prev_page_exist' => false
            ];
        }

        return [
            'entities' => $page["data"],
            'is_next_page_exist' => $page["next_page_url"] ? true : false,
            'is_prev_page_exist' => $page["prev_page_url"] ? true : false
        ];
    }
}
