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

        $roleResult = $this->rolesService->getRoleType();
        
        $name = $this->ask('Enter username');
        $email = $this->ask('Enter email');
        $email = $this->validateEmail($email);        

        $role = $this->choice('RoleUser', $roleResult);
        $password = $this->secret('Enter password');

        $roleSelect = $this->getRole('type', $role);
        
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
     * Рекурсивно проверяет валидность электронной почты.
     *
     * @param string $email
     * @return string
     */
    protected function validateEmail(string $email): string
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('The string is not email');
            $email = $this->ask('Enter email');
            $this->validateEmail($email);
        }
        $checkUserEmail = $this->usersService->searchParamUsers('email', $email);
        if(!$checkUserEmail->isEmpty()){
            $this->error('User with this email is already registered');
            $email = $this->ask('Enter email');
            $this->validateEmail($email);
        }
        return $email;
    }
}
