<?php

namespace App\Services\Portal\Menu;

/**
 * Class UserMenuService
 * @package App\Services\Portal\Menu
 */
final class UserMenuService extends AbstractMenuService
{
    /** @var string  */
    protected $menuName = 'userMenu';

    /**
     * @return array
     */
    protected function getTree(): array
    {
        return [
            [
                'name'  => __('messages.profile'),
                'url' => route('portal.user.profile'),
            ],
            [
                'name'  => __('messages.edit_profile'),
                'url' => route('portal.user.edit'),
            ],
            [
                'name'  => __('messages.change_password'),
                'url' => route('portal.user.change.password'),
            ],
        ];
    }
}