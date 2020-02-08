<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Record;

class UsersRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->state('master')->create()->each(static function ($master) {
            /** @var User $master */
            $master->clients()->saveMany(
                factory(User::class, 20)->state('client')->create()->each(static function ($client) use ($master) {
                    /** @var User $client */
                    $client->clientRecords()->saveMany(
                        factory(Record::class, 20)->make([
                            'master_id' => $master->id
                        ])
                    );
                })
            );
        });
    }
}
