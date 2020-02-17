<?php

use Illuminate\Database\Seeder;
use App\Models\Organization;
class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('organizations')->insert(
            array('id' => '1077','country_id' => '1','name' => 'Группа компаний Cbonds','name_eng' => 'Cbonds Group','org_type_id' => '1','org_group_id' => '295','org_branch_id' => '25')
        );
        */
        factory(Organization::class, 100)->create();
    }
}
