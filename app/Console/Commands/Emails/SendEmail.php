<?php

namespace App\Console\Commands\Emails;

use App\Mail\BaseMail;
use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send
                            { template_name : Название шаблона письма }
                            { --id= : id пользователя, который получит письмо }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Рассылка писем пользователям.';

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * Create a new command instance.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // получи параметры команды из консоли
        // шаблон письма
        $template_name = $this->argument('template_name');

        // id пользователя - получателя письма
        $id = $this->option('id');

        if($id == 'all')
        {
            $users = $this->userRepository->all();//User::all();

            $bar = $this->output->createProgressBar(count($users));
            $bar->start();

            foreach($users as $user)
            {
                $this->sendEmailToUser($user, $template_name);
                $bar->advance();
            }
            $bar->finish();

            echo PHP_EOL;
            echo "Все письма отправлены.".PHP_EOL;
        }
        else
        {
            $user = $this->userRepository->get($id);
            $this->sendEmailToUser($user, $template_name);
            echo "Письмо [".$user->name."] отправлено.".PHP_EOL;
        }
    }

    /**
     * Отправка письма пользователю
     * @param User $user пользователь - получатель письма
     * @param string $template_name шаблон письма
     */
    private function sendEmailToUser(User $user, $template_name)
    {
        Mail::to($user->email)
            ->send(new BaseMail($user, $template_name));

        // теперь пометь в таблице emails, что данное письмо больше не нужно отправлять

    }
}
