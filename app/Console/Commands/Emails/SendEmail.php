<?php

namespace App\Console\Commands\Emails;

use App\Mail\BaseMail;
use App\Models\Email;
use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendEmail Это консольная команда, которая запускает email-рассылку.
 * @package App\Console\Commands\Emails
 */
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
                $email = $user->emails()
                               ->where('type',$template_name)
                               ->where('need_to_send',true)
                               ->first();

                if($email !=null) // если для данного пользователя есть письмо, которое нужно ему отправить
                {
                    $this->sendEmailToUser($email, $template_name);
                    $bar->advance();
                }
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
     * @param Email $email строка в таблице emails, где указано какому пользователю - какое письмо отправить
     * @param string $template_name шаблон письма
     */
    private function sendEmailToUser(Email $email, $template_name)
    {
        // хозяин - получатель этого письма
        $user = $email->user;

        // отправь письмо
        Mail::to($user->email)
            ->send(new BaseMail($user, $template_name));

        // теперь пометь в таблице emails, что данное письмо больше не нужно отправлять
        $email->need_to_send = false;
        $email->save();
    }
}
