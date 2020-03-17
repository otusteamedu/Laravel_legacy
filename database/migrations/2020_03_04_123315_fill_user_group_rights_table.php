<?php

use App\Models\UserGroupRight;
use App\Services\UserGroup\UserGroupService;
use Illuminate\Database\Migrations\Migration;

class FillUserGroupRightsTable extends Migration
{
    protected const USER_GROUP_RIGHTS = [
        'master' => [
            [
                'code' => 'record.create',
                'description' => 'Create new records',
            ],
            [
                'code' => 'client.create',
                'description' => 'Create new clients',
            ],
            [
                'code' => 'client.list',
                'description' => 'Watch list of client',
            ],
            [
                'code' => 'record.list',
                'description' => 'Watch list of client',
            ],
        ]
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $userGroupService = app(UserGroupService::class);

        foreach (self::USER_GROUP_RIGHTS as $groupCode => $rights) {
            $groupId = $userGroupService->getIdByCode($groupCode);

            foreach ($rights as $right) {
                $rightObject = new UserGroupRight();
                $rightObject->group_id = $groupId;
                $rightObject->code = $right['code'];
                $rightObject->description = $right['description'];

                $rightObject->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $userGroupRightCodes = [];
        foreach (self::USER_GROUP_RIGHTS as $userGroupRights) {
            foreach ($userGroupRights as $userGroupRight) {
                $userGroupRightCodes[] = $userGroupRight['code'];
            }
        }

        UserGroupRight::whereIn('code', $userGroupRightCodes, 'or')->delete();
    }
}
