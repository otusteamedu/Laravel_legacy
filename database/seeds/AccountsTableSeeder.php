<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $users = App\Models\User::all();
  
        // Для каждого созданного пользователя
        foreach($users as $user)
        {
            // Создай новый акаунт
            // Переопредели параметры, заданные в фабрике акаунта
            factory(App\Models\Account::class)->create([
                'user_id'=>$user->id,
                'source'=>$user->source                
            ]);
        }        
    }
    
}
