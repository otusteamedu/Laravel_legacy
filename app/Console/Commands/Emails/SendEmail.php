<?php

namespace App\Console\Commands\Emails;

use App\Mail\BaseMail;
use App\Models\Email;
use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
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
                            { --all : сделать рассылку всем пользователям, кто удовлетворяет критериям рассылки }
                            { --id=* : id пользователя, который удовлетворяет критериям рассылки и кому будет отправлено письмо }';

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
     * @var bool есть получатели рассылки
     */
    private $has_recipients = true;

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
        echo PHP_EOL."Получено задание : разослать письма.".PHP_EOL;
        // получи параметры команды из консоли
        // шаблон письма
        $template_name = $this->argument('template_name');

        $users = $this->getUsers();

        // Проверь : существуют ли пользователи с указанными id  ?
        if($this->allElementsAreNull($users))
        {
            // в коллекции одни null
            $this->has_recipients = false;
            echo PHP_EOL."Предупреждение : нет пользователей с указанными id.".PHP_EOL;
        }

        // если пользователи существуют
        if($this->has_recipients)
        {
            $bar = $this->output->createProgressBar(count($users));
            $bar->start();

            foreach ($users as $user) {
                if ($user != null) {
                    $email = $user->emails()
                        ->where('type', $template_name)
                        ->where('need_to_send', true)
                        ->first();

                    if ($email != null) // если для данного пользователя есть письмо, которое нужно ему отправить
                    {
                        $this->sendEmail($email, $template_name);
                        $bar->advance();
                    }
                }
            }
            $bar->finish();
            echo PHP_EOL;
            echo "Задание выполнено." . PHP_EOL;
        }
    }

    /**
     * Отправка письма пользователю
     * @param Email $email строка в таблице emails, где указано какому пользователю - какое письмо отправить
     * @param string $template_name шаблон письма
     */
    private function sendEmail(Email $email, $template_name)
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

    /**
     * @return Collection коллекция пользователей, чьи id были получены из опций в консоли
     */
    private function getUsers():Collection
    {
        $users = []; // массив пользователей, кому нужно будет отправить письмо

        if($this->option('all'))
        {
            $users = $this->userRepository->all();
            echo PHP_EOL."Получена опция all".PHP_EOL;
        }

        if($this->option('id'))
        {
            $user_ids = $this->option('id');

            foreach($user_ids as $id)
            {
                //при получении несуществующих id, вернёт null
                $users[] = $this->userRepository->get((int)$id);
            }
            echo PHP_EOL."Получены индивидуальные id".PHP_EOL;
        }

        // конвертация array->Collection
        $users = collect($users);

        return $users;
    }

    /**
     * Передумал использовать этот метод. Но пусть сохранится, возможно на будущее использование.
     * @param Collection $collection
     * @return bool вернёт true, если в коллекции все элементы null
     */
    private function allElementsAreNull(Collection $collection):bool
    {
        $result = false;
        $count_nulls = 0;
        if($collection!=null)
        {
            foreach($collection as $item)
            {
                if($item == null)
                {
                    $count_nulls++;
                }
            }
        }
        if(count($collection) == $count_nulls)
        {
            $result = true;
        }
        return $result;
    }

}
