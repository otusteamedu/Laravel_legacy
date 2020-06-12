<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\StoreProxyRequest;
use App\Models\Planner\PlannerSocialNetworkAccount;
use App\Services\Planner\SocialNetworkAccount\PlannerSocialNetworkAccountService;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PlannerSocialNetworkAccountController extends Controller
{
    /**
     * @var PlannerSocialNetworkAccountService
     */
    public $plannerSocialNetworkAccountService;

    public function __construct(PlannerSocialNetworkAccountService $plannerSocialNetworkAccountService)
    {
        $this->plannerSocialNetworkAccountService = $plannerSocialNetworkAccountService;
    }

    public function index(Request $request)
    {
        \View::share(Array(
            'accounts' => \Auth::getUser()->plannerSocialNetworkAccounts()->paginate(10)
        ));

        return view('main.planner.index');
    }

    public function create()
    {
        return view('main.socialNetworkAccount.create');
    }

    public function delete(PlannerSocialNetworkAccount $account)
    {
        $this->plannerSocialNetworkAccountService->deleteAccountHandler->handle($account);
        return redirect(route('proxy'));
    }

    public function edit(PlannerSocialNetworkAccount $proxy)
    {
//        if($proxy->user()->get()->first()->id == \Auth::user()->id) {
//            \View::share(Array(
//                'proxy' => $proxy
//            ));
//            return view('main.socialNetworkAccount.create');
//        } else {
//            abort(403);
//        }
    }

    public function store(StoreProxyRequest $request)
    {
        $this->plannerSocialNetworkAccountService->storeProxy($request);

        return redirect(route('proxy'));
    }
}
