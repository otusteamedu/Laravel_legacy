<?php

namespace App\Http\Middleware;

use Closure;

class CmdRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $returnTo = $request->get('_returnTo', '');
        $cmd = $request->get('_cmd', '');
        if((strlen($cmd) > 0) && (strlen($returnTo) <= 0))
            $returnTo = $request->getUri();

        if(strlen($returnTo) > 0) {
            //$request->request->remove('_returnTo');
            //$request->request->remove('_cmd');

            return redirect($returnTo, 302)->withInput()->exceptInput(['_returnTo', '_cmd']);
        }

        return $next($request);
    }
}
