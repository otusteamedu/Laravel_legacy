<?php

namespace App\Repositories;


use App\Models\UserSocial;

class UserSocialRepository
{
    public function getUserBySocial($id)
    {
        $userSocial = UserSocial::where('social_id', $id)->first();
        return $userSocial ? $userSocial->user : null;
    }
}
