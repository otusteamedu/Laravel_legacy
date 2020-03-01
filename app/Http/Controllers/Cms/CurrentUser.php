<?php

namespace App\Http\Controllers\Cms;

use App\Models\User\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait CurrentUser
{
    /**
     * @return User|null
     */
    protected function getCurrentUser(): ?User
    {
        return \Auth::user();
    }

    /**
     * @param Request $request
     * @param string $ability
     * @param $arguments
     */
    protected function checkAbility(Request $request, string $ability, $arguments): void
    {
        try {
            $this->authorize($ability, $arguments);
        } catch (AuthorizationException $exception) {
            Log::notice(
                __('log.notice.accessDenied'),
                [
                    'userId' => $this->getCurrentUser()->id,
                    'userName' => $this->getCurrentUser()->name,
                    'page' => $request->url(),
                    'data' => $request->all(),
                    'exception' => $exception->getMessage(),
                ]
            );
            abort(404);
        }
    }
}
