<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use League\Flysystem\Plugin\AbstractPlugin;

/**
 * Class BaseMail Просто строит письмо по заданному шаблону.
 * @package App\Mail
 */
class BaseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User передаём пользователя в шаблон письма $template_name
     */
    public $user;

    /**
     * @var string шаблон письма. Название файла.
     */
    private $template_name;

    /**
     * resources/views/TEMPLATE_FOLDER - название папки, где хранятся шаблоны писем
     */
    const TEMPLATE_FOLDER = 'emails';

    /**
     * Create a new message instance.
     *
     * @param User $user пользователь - получатель письма
     * @param string $template_name шаблон письма
     */
    public function __construct(User $user, string $template_name)
    {
        $this->user = $user;
        $this->template_name = $template_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template_file = self::TEMPLATE_FOLDER.".".$this->template_name;
        return $this->markdown($template_file);
    }
}
