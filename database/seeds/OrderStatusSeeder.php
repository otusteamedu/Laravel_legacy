<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->truncate();

        $os = new OrderStatus();
        $os->name = 'In process';
        $os->position = 100000;
        $os->name_ru = 'В процессе';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'In assembly';
        $os->position = 200000;
        $os->name_ru = 'Собирается';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Whaiting shipment';
        $os->position = 300000;
        $os->name_ru = 'Ожидается отгрузки';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'On the way';
        $os->position = 400000;
        $os->name_ru = 'В пути';
        $os->save();

        $os = new OrderStatus();
        $os->name = 'Delivered';
        $os->position = 500000;
        $os->name_ru = 'Доставлен';
        $os->save();
    }
}
