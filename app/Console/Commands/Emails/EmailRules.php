<?php


namespace App\Console\Commands\Emails;

use App\Models\User;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class EmailRules Набор правил, определяющих отправлять определённый тип письма пользователю или нет
 * @package App\Console\Commands\Emails
 */
class EmailRules
{

    public static function qualifiesForNewActionEmail(User $user):bool
    {
        // код, который определит : отправлять этому пользователю
        // письмо о новых акциях или нет
        // ...
        return true;
    }

    public static function qualifiesForOrderAcceptedEmail(User $user):bool
    {
        // код, который определит : отправлять этому пользователю
        // письмо о том, что заказ принят или нет
        // ...
        return true;
    }

    public static function qualifiesForOrderShippedEmail(User $user):bool
    {
        // код, который определит : отправлять этому пользователю
        // письмо о том, что заказ отправлен или нет
        // ...
        return true;
    }
}
