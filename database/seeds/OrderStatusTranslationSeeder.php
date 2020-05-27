<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\OrderStatusTranslation;

class OrderStatusTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status_translations')->truncate();

        $ost = new OrderStatusTranslation();
        $ost->order_status_id = 1;
        $ost->attribute = 'name';
        $ost->value = 'В процессе';
        $ost->save();

        $ost = new OrderStatusTranslation();
        $ost->order_status_id = 2;
        $ost->attribute = 'name';
        $ost->value = 'Собирается';

        $ost->save();
        $ost = new OrderStatusTranslation();
        $ost->order_status_id = 3;
        $ost->attribute = 'name';
        $ost->value = 'Ожидает отправки';
        $ost->save();

        $ost = new OrderStatusTranslation();
        $ost->order_status_id = 4;
        $ost->attribute = 'name';
        $ost->value = 'В пути';
        $ost->save();

        $ost = new OrderStatusTranslation();
        $ost->order_status_id = 5;
        $ost->attribute = 'name';
        $ost->value = 'Доставлен';
        $ost->save();
    }
}
