<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\UserGroup;

class FillUserGroupTable extends Migration
{
    private $groups = [
        'admin' => [
            'code' => 'admin',
            'description' => 'Application administrator'
        ],
        'master' => [
            'code' => 'master',
            'description' => 'Master'
        ],
        'client' => [
            'code' => 'client',
            'description' => 'Just client'
        ]
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        foreach ($this->groups as $groupCode => $groupData) {
            $groupObj = new UserGroup();
            $groupObj->code = $groupCode;
            $groupObj->description = $groupData['description'];

            $groupObj->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        UserGroup::where('code', '=', array_keys($this->groups))->delete();
    }
}
