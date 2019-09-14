<?php

use App\Models\Company;
use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Company::with('widgets', 'users', 'leads')->get() as $company) {
            foreach ($company->widgets as $widget) {
                foreach ($company->users as $user) {
                    foreach ($company->leads as $lead) {
                        factory(Conversation::class, 1)->create([
                            'company_id' => $company->id,
                            'widget_id' => $widget->id,
                            'manager_id' => $user->id,
                            'lead_id' => $lead->id
                        ]);
                    }
                }
            }
        }
    }
}
