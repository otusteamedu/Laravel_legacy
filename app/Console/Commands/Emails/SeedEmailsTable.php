<?php

namespace App\Console\Commands\Emails;

use App\Mail\BaseMail;
use App\Models\Email;
use App\Models\User;
use App\Services\Emails\EmailsService;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class SeedEmailsTable
 * Консольная команда, чтобы генерировать задания для email-рассылки.
 * Сгенерированное задание = строка в таблице emails, где указано какому пользователю какой шаблон письма отправить.
 * @package App\Console\Commands\Emails
 */
class SeedEmailsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:seed
                            { campaign : кампания/причина для email-рассылки }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сгенерируй данные для email-рассылки.';

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var EmailsService
     */
    protected $emailsService;

    /**
     * Create a new command instance.
     *
     * @param UserRepositoryInterface $userRepository
     * @param EmailsService $emailsService
     */
    public function __construct(UserRepositoryInterface $userRepository, EmailsService $emailsService)
    {
        $this->userRepository = $userRepository;
        $this->emailsService = $emailsService;
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
        // кампания/причина для email-рассылки
        $campaign = $this->argument('campaign');

        if(!$this->validate($campaign))
        {
            // ошибка
            echo PHP_EOL;
            echo "Кампания указана неверно. Выберите что-то из : ".Email::TEMPLATE_NEW_ACTION.", ".Email::TEMPLATE_ORDER_ACCEPTED.", ".Email::TEMPLATE_ORDER_SHIPPED;
            echo PHP_EOL;
            $this->error("Выполнение команды прервано.");
        }

        $users = $this->userRepository->all();

        $bar = $this->output->createProgressBar(count($users));
        $bar->start();

        foreach($users as $user)
        {
            if($campaign == Email::TEMPLATE_NEW_ACTION && EmailRules::qualifiesForNewActionEmail($user))
            {
                $this->emailsService->createEmail($user, $campaign);
            }
            if($campaign == Email::TEMPLATE_ORDER_ACCEPTED && EmailRules::qualifiesForOrderAcceptedEmail($user))
            {
                $this->emailsService->createEmail($user, $campaign);
            }
            if($campaign == Email::TEMPLATE_ORDER_SHIPPED && EmailRules::qualifiesForOrderShippedEmail($user))
            {
                $this->emailsService->createEmail($user, $campaign);
            }

           $bar->advance();
        }
         $bar->finish();
         echo PHP_EOL;
         echo "Email-рассылка сгенерирована.".PHP_EOL;
        return ;
    }

    /**
     * @param string $campaign название e-mail рассылки = название шаблона письма
     * @return bool если в списке разрёшённых значений, вернёт true
     */
    private function validate(string $campaign):bool
    {
        $valid_campaigns = [Email::TEMPLATE_NEW_ACTION, Email::TEMPLATE_ORDER_ACCEPTED, Email::TEMPLATE_ORDER_SHIPPED];
        $campaign_is_valid = in_array($campaign, $valid_campaigns);
        return $campaign_is_valid;
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
    }
}
