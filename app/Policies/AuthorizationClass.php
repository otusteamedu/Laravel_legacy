<?php


namespace App\Policies;


class AuthorizationClass
{
    public function getRoles() {
        return [
            'admin' => [
                'create-country',
                'create-city',
                'create-user',
                'create-tariff',
                'create-segment',
                'create-category',
                'create-project',
                'create-offer',

                'update-country',
                'update-city',
                'update-user',
                'update-tariff',
                'update-segment',
                'update-category',
                'update-project',
                'update-offer',

                'delete-country',
                'delete-city',
                'delete-user',
                'delete-tariff',
                'delete-segment',
                'delete-category',
                'delete-project',
                'delete-offer',

            ],
            'marketing' => [
                'create-tariff',
                'create-segment',
                'create-category',
                'create-project',
                'create-offer',

                'update-tariff',
                'update-segment',
                'update-category',
                'update-project',
                'update-offer',

                'delete-tariff',
                'delete-segment',
                'delete-category',
                'delete-project',
                'delete-offer',

            ],
            'user' => [

            ],
        ];
    }
}
