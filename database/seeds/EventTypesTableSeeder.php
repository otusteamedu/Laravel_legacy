<?php

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    private function getAvailableEventTypeList () {
        return [
            'meeting', 'traditional', 'without_coordinates',
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
