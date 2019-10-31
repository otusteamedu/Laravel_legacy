<?php

namespace App\Traits\Auth;

use App\Helpers\Models;
use App\Helpers\Requests;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

trait HasAuthorizationPolicy
{
    /**
     * Ger current user
     *
     * @return User
     */
    public function getCurrentUser(): User
    {
        return Auth::user();
    }
    
    /**
     * Authorize user with ability
     *
     * @param  string  $ability
     *
     * @param  Model|null  $model
     *
     * @return bool
     */
    public function authorizeUserAbility(string $ability, Model $model = null): bool
    {
        $authResponse = true;
        $modelToCheck = $model ?: $this->modelClass;
        
        try {
            $this->authorize(Str::camel($ability), $modelToCheck);
        } catch (AuthorizationException $exception) {
            $authResponse = false;
            $this->logUserRequestError();
        }
        
        return $authResponse;
    }
    
    /**
     * Log message if user tried to view page without permission
     */
    public function logUserRequestError(): void
    {
        $request = request();
        $requestHeaders = Requests::getRequestHeaders($request);
        $requestData = $request->toArray();
        $message = sprintf(
            "User #%s tried to view page \"%s\" without permission.\nRequest headers: %s.",
            $this->getCurrentUser()->id,
            $request->getRequestUri(),
            json_encode($requestHeaders, true)
        );
        
        if (is_array($requestData)) {
            $message .= sprintf("\nRequest data: %s", json_encode($requestData, true));
        }
        
        Log::error($message);
    }
    
    /**
     * Redirect request if user doesn't have permission to view page
     *
     * @param  string  $route
     * @param  string  $ability
     *
     * @return RedirectResponse
     */
    public function redirectIfNoPermission(string $route, string $ability): RedirectResponse
    {
        return redirect()->route($route)->with('error', $this->getRedirectMessage($ability));
    }
    
    /**
     * Get redirection error message
     *
     * @param  string  $ability
     *
     * @return array|Translator|string|null
     */
    public function getRedirectMessage(string $ability)
    {
        $translationString = sprintf('auth.policies.%s.%s', Models::getTableName($this->modelClass), Str::snake($ability));
        
        return __($translationString);
    }
    
    /**
     * Share data across views within controller methods
     */
    public function viewShareData(): void
    {
        View::share([
            'modelClass' => $this->modelClass
        ]);
    }
}
