<?php


namespace App\Services\Filters\Resolvers;


use Auth;

class FilterAdditionalDataResolver
{
    /**
     * @param array $data
     * @return array
     */
    public function resolve(array $data) : array
    {
        $data['quota_id'] = $data['quota_id'] ?? rand(1,3);
//        $data['created_user_id'] = Auth::user()->id; //Spetial for Error generation in Job
        $data['created_user_id'] = (Auth::user() === null) ? 1 : Auth::user()->id;
        return $data;
    }


}
