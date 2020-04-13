<?php


namespace App\Services\Filters\Resolvers;


class FilterAdditionalSataResolver
{

    public function resolve(array $data) : array
    {
        $data['quota_id'] = $data['quota_id'] ?? rand(1,3);
        return $data;
    }


}
