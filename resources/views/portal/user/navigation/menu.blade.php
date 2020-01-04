@php
$pages = [
        [
            'name' => __('messages.profile'),
            'is_active' => false,
            'slug' => '/user'
        ],
        [
            'name' => __('messages.edit_profile'),
            'is_active' => false,
            'slug' => '/user/edit'
        ],
        [
            'name' => __('messages.change_password'),
            'is_active' => false,
            'slug' => '/user/changepassword'
        ],
    ];
@endphp
@include('portal.blocks.navigation.menu', ['pages' => $pages, 'class' => ''])