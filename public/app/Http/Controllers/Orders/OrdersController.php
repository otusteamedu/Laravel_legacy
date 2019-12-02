<?php

namespace App\Http\Controllers\Orders;

use App\Models\Orders\Order;
use App\Services\OrdersService;
use Illuminate\Http\Request;
use App\Http\Controllers\Crm\CrmController;
use Illuminate\Support\Facades\Gate;

class OrdersController extends CrmController
{
    private $ordersService;

    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = $this->ordersService->index();

        return view('crm.orders.index', [
            'items' => $items,
            'leftNav' => $this->getLeftNav(),
            'add' => Gate::allows('add-order')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('crm.orders.create', ['leftNav' => $this->getLeftNav()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->ordersService->store($request);

        return redirect(route('crm.orders.index'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        return view('crm.orders.edit', ['model' => $order, 'leftNav' => parent::getLeftNav()]);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Order $order)
    {
        return view('crm.orders.edit', ['model' => $order, 'leftNav' => parent::getLeftNav()]);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Order $order)
    {
        $this->ordersService->update($request, $order);

        return redirect(route('crm.orders.index'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */

    public function destroy(Order $order)
    {
        $this->ordersService->destroy($order);

        return redirect(route('crm.orders.index'));
    }
}
