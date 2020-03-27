<?php

namespace App\Http\Controllers\Crm;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrmController extends Controller
{
    public function index(Request $request)
    {
        return view('crm.admin', ['leftNav' => $this->getLeftNav()]);
    }

    public function getLeftNav() : array
    {
        $user = Auth::user();
        $data = [];

        if ($user->hasRole(Role::ADMIN)) {
            $data = ['transports' => ['Новый' => 'crm.trucks.create', 'Все' => 'crm.trucks.index'],
                'clients' => ['Новый' => 'crm.clients.create', 'Все' => 'crm.clients.index'],
                'schedule' => ['Показать расписание' => 'crm.schedule.index'],
                'orders' => ['Все' => 'crm.orders.index']];
        }

        if ($user->hasRole(Role::CLIENT)) {
            $data = ['transports' => ['Все' => 'crm.trucks.index'],
                'clients' => ['Все' => 'crm.clients.index'],
                'schedule' => ['Показать расписание' => 'crm.schedule.index'],
                'orders' => ['Все' => 'crm.orders.index']];
        }

        if ($user->hasRole(Role::MANAGER)) {
            $data = ['transports' => ['Все' => 'crm.trucks.index'],
                'clients' => ['Новый' => 'crm.clients.create', 'Все' => 'crm.clients.index'],
                'schedule' => ['Показать расписание' => 'crm.schedule.index'],
                'orders' => ['Все' => 'crm.orders.index']];
        }

        return $data;
    }
}
