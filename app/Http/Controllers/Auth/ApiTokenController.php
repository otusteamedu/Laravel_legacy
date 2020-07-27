<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{

    /**
     * Update the authenticated user's API token.
     *
     * @param Request $request
     * @return array
     */
    public function update(Request $request)
    {
        $token = Str::random(80);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }

    // незабыть поменять в auth.php в 'guards'-->'api' --> 'hash' => true,


}
