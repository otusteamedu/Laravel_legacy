<?php


namespace App\Services\Planner\SocialNetworkAccount;


use App\Services\Planner\Proxy\Handlers\CreateSocialNetworkAccountHandler;
use App\Services\Planner\Proxy\Handlers\DeleteSocialNetworkAccountHandler;
use App\Services\Planner\Proxy\Handlers\UpdateSocialNetworkAccountHandler;

class PlannerSocialNetworkAccountService
{
    /**
     * @var DeleteSocialNetworkAccountHandler
     */
    public $deleteSocialNetworkAccountHandler;

    /**
     * @var UpdateSocialNetworkAccountHandler
     */
    public $updateSocialNetworkAccountHandler;

    /**
     * @var CreateSocialNetworkAccountHandler
     */
    public $createSocialNetworkAccountHandler;

    public function __construct(
        DeleteSocialNetworkAccountHandler $deleteSocialNetworkAccountHandler,
        UpdateSocialNetworkAccountHandler $updateSocialNetworkAccountHandler,
        CreateSocialNetworkAccountHandler $createSocialNetworkAccountHandler
    )
    {
        $this->deleteSocialNetworkAccountHandler = $deleteSocialNetworkAccountHandler;
        $this->updateSocialNetworkAccountHandler = $updateSocialNetworkAccountHandler;
        $this->createSocialNetworkAccountHandler = $createSocialNetworkAccountHandler;
    }

    public function storeProxy(StoreProxyRequest $request)
    {
        $validated = $request->validated();

        $id = $request->get('id');

        if(intval($id) > 0) {
            $this->updateProxy(PlannerProxy::find($id), $request->toArray());
        } else {
            $this->createAuthor($request->toArray());
        }
    }

    public function updateProxy(PlannerProxy $proxy, array $data): PlannerProxy
    {
        return $this->updateProxyHandler->handle($proxy, $data);
    }

    public function createAuthor(array $data): PlannerProxy
    {
        return $this->createProxyHandler->handle($data);
    }

    public function deleteProxy(PlannerProxy $plannerProxy)
    {
        return $this->deleteProxyHandler->handle($plannerProxy);
    }
}
