<?php

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    private function getAvailableEventTypeList () {
        return [
            'towing_required', 'need_to_push', 'need_tool',
            'need_fuel', 'charge_battery', 'tire_fitting',
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getAvailableEventTypeList() as $eventType) {
            DB::table('event_types')->insert([
                ['name' => $eventType]
            ]);
        }
    }
}
