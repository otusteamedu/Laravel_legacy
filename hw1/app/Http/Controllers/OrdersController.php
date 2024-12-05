<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('manager');
	}

	public function index()
	{
		$orders = Order::latest()->get();
		return view('orders.index', compact('orders'));
	}

	public function show(Order $order)
	{
		return view('orders.show', compact('order'));
	}

	public function create()
	{
		$statusList = Order::statusList();
		return view('orders.create', compact('statusList'));
	}

	public function edit(Order $order) {
		$statusList = Order::statusList();
		return view('orders.edit', compact('order', 'statusList'));
	}

	public function update(Order $order, Request $request)
	{
		$this->validate(request(), [
			'customer_name' => 'required',
			'customer_phone' => 'required',
			'research_area' => 'required',
			'comment' => 'required',
			'status' => 'required',
		]);

		$order->update($request->all());

		session()->flash('flash_message', 'Заявка успешно обновлена!');

		return redirect('/orders/' . $order->id);
	}


	public function store()
	{
		$this->validate(request(), [
			'customer_name' => 'required',
			'customer_phone' => 'required',
			'research_area' => 'required',
			'comment' => 'required',
			'status' => 'required',
		]);

		auth()->user()->publish(
			new Order(request(['customer_name', 'customer_phone', 'research_area', 'comment', 'status']))
		);

		session()->flash('flash_message', 'Заявка успешно создана!');

		return redirect('/orders');
	}

	public function destroy(Order $order)
    {
        $order->delete();

        session()->flash('flash_message', 'Заявка успешно удалена!');

        return redirect('/orders');
    }
}
