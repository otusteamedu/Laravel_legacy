<?php

namespace App\Console\Commands\Users;

use App\Console\Commands\SendEmails;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Command
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
    protected $description = 'System command to create user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('Name:');
        $email = $this->ask('Email:');

        $this->info('Sorry user already exists');
        die();
        $password = $this->secret('Password:');
        $level = $this->choice(
            'Level:',
            [User::LEVEL_USER, User::LEVEL_MODERATOR, User::LEVEL_ADMIN,],
            0);



        $this->call('emails:send', [
            'user' => 1,
            '--email' => [
                'yyy@tt.com',
            ],
        ]);
        if ($this->confirm('Are you sure?')) {
            factory(User::class)->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'level' => $level,
            ]);
            $this->info('Users Successfully created');
        }


    }
}
