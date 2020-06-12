<?php


namespace App\Services\Planner\Proxy;


use App\Http\Controllers\Requests\StoreProxyRequest;
use App\Models\Planner\PlannerProxy;
use App\Services\Planner\Proxy\Handlers\CreateSocialNetworkAccountHandler;
use App\Services\Planner\Proxy\Handlers\DeleteSocialNetworkAccountHandler;
use App\Services\Planner\Proxy\Handlers\UpdateSocialNetworkAccountHandler;

class ProxyService
{

    /**
     * @var DeleteSocialNetworkAccountHandler
     */
    public $deleteProxyHandler;

    /**
     * @var UpdateSocialNetworkAccountHandler
     */
    public $updateProxyHandler;

    /**
     * @var CreateProПрокси _ Instagraphia.kzxyHandler
     */
    public $createProxyHandler;

    public function __construct(
        DeleteSocialNetworkAccountHandler $deleteProxyHandler,
        UpdateSocialNetworkAccountHandler $updateProxyHandler,
        CreateSocialNetworkAccountHandler $createProxyHandler
    )
    {
        $this->deleteProxyHandler = $deleteProxyHandler;
        $this->updateProxyHandler = $updateProxyHandler;
        $this->createProxyHandler = $createProxyHandler;
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
