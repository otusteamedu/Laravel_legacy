<?php


namespace App\Services\Filters\Resolvers;


class FilterAdditionalDataResolver
{
    /**
     * @param array $data
     * @return array
     */
    public function resolve(array $data) : array
    {
        $data['quota_id'] = $data['quota_id'] ?? rand(1,3);
        return $data;
    }


}
