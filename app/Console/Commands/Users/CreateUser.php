<?php

namespace App\Console\Commands\Users;

use App\Http\Services\Roles\RolesService;
use App\Http\Services\Users\UsersService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user for any role';


    protected $rolesService;
    protected $usersService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        RolesService $rolesService,
        UsersService $usersService
    )
    {
        $this->rolesService = $rolesService;
        $this->usersService = $usersService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $roleCollect = $this->rolesService->getRoles();
        $roleResult = [];
        foreach($roleCollect AS $role){
            $roleResult[] = $role->type;
        }
        $name = $this->ask('Enter username');
        $email = $this->ask('Enter email');
        $this->validateEmail($email);

        $role = $this->choice('RoleUser', $roleResult);
        $password = $this->secret('Enter password');

        $roleSelect = $roleCollect->where('type', $role)->first();
        $createUser = [
            'name'=>$name,
            'email'=>$email,
            'role_id'=>$roleSelect->id,
            'password'=>Hash::make($password)
        ];
        if($this->confirm('Want to create a user?')){
            $this->usersService->createUser($createUser);
            $this->info('User created');
        };
    }

    /**
     * Проверка валидности ввода электронной почты
     *
     * @param string $email
     * @return void
     */
    protected function validateEmail(string $email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('The string is not email');exit();
        }
        $checkUserEmail = $this->usersService->searchParamUsers('email', $email);
        if(!$checkUserEmail->isEmpty()){
            $this->error('Email already registered');exit();
        }
    }
}
