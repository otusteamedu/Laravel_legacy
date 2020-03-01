<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\Cache\Users\UsersCacheService;

/**
 * Class WarmupUsersProfilesCommand
 * Команда для кэширования профилей пользователей
 * @package App\Console\Commands
 */
class WarmupUsersProfilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'warmup:users-profiles {id?* : The array of users id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Кэширует данные пользователей с переданными id, или всех, если команда вызвана без параметров';

    /**
     * @var UsersCacheService
     */
    private $userCacheService;
    /**
     * Create a new command instance.
     *
     * @param UsersCacheService $usersCacheService
     */
    public function __construct(UsersCacheService $usersCacheService)
    {
        parent::__construct();

        $this->userCacheService = $usersCacheService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parameters = $this->argument('id');
        $message = '';
        $users = [];
        if ($parameters) {
            foreach ($parameters as $parameter) {
                $id = intval($parameter);
                if ($id && $user = User::find($id)) {
                    $users[] = $user;
                } else {
                    $message = "Некорректное значение id - $parameter";
                }
            }
        } else {
            $users = User::all();
        }

        $bar = $this->output->createProgressBar(count($users));
        $bar->start();

        if ($message) {
            $this->info($message);
        } else {
            foreach ($users as $user) {
                $this->userCacheService->putUserDataToCache($user->id, $user);
                $bar->advance();
            }
        }
        $bar->finish();
    }
}
