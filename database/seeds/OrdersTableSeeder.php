<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;//понадобится

class OrdersTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\Models\User::all();
  
        // $faker = Faker\Factory::create();
        // ОШИБКА : Class 'Faker\Generator\Factory' not found
        
        // Для каждого созданного пользователя
        foreach($users as $user)
        {          
            
            // Создай заказы
            $number_of_orders = rand(0,5);//число заказов от 0 до 5
            $delivery_types = ['самовывоз','курьер','постамат','почта'];
            $delivery_types = collect($delivery_types); // convert array to Eloquent collection
            $operators = ['Галина', 'Денис'];
            $operators = collect($operators); // convert array to Eloquent collection

            if($number_of_orders>0)
            {
                $order_min_date = $user->date; // заказ может быть создан не раньше пользователя

                for ($i = 1; $i <= $number_of_orders; $i++) 
                {
                    factory(App\Models\Order::class)->create([
                        'user_id'=>$user->id,                        
                        
                        // нужно 
                        // 'date'=>$faker->date($format = 'Y-m-d', $min = $order_min_date), 
                        // но т.к. Faker не завёлся, для простоты использую :
                        'date'=>$user->date,
                        
                        // по хорошему, нужно рандомно "набросать" товаров в корзину, 
                        // чтобы правильно посчитать сумму заказа, но для упрощения и так пойдёт :
                        'sum'=>rand(100,500),

                        'number'=>'Z'.rand(100,999),
                        
                        // нужно
                        // 'delivery_type'=>$faker->randomElement($delivery_types),
                        // но т.к. Faker не завёлся, для простоты использую метод Laravel-коллекции:
                        'delivery_type'=>$delivery_types->random(),
                        
                        'address'=>$user->address,
                        
                        // нужно
                        // 'processed_by'=>$faker->randomElement($processed_by),
                        // но т.к. Faker не завёлся, для простоты использую метод Laravel-коллекции:
                        'processed_by'=>$operators->collect()
                    ]);
                }
            }

        }        
    }   
}
