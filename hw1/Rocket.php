<?php

namespace App;

use App\Widget;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Основная модель. В ней содержатся все-все настройки касательно внешнего вида виджета и поведения.
 * Уже из-за этого этот класс нарушает принцип SRP, т.к. он и настраивает, и валидирует, и даже звонки инициирует.
 *
 * Нужно раздробить эту модель на мелкие модели, которые будут отвечать только за себя.
*/
class Rocket extends Model
{
    /**
     * Валидация перед обновлением виджета
     * Надо перенести в отдельный класс для валидации
     */
    public function rocketCheck() {}

    /**
     * Совершает звонок через оператора Sipgate
     */
    public function makeSipgateCall($callee) {}

    /**
     * Совершает звонок через оператора Twilio
     */
    public function makeTwilioCall($callee) {}

    /**
     * Общий метод для совершения звонка - в зависимости от текущего оператора или один, или другой метод
     * Нарушает принцип открытости-закрытости, надо разделить на несколько классов - родителя и для каждого оператора
     * И вообще убрать звонки из этого класса
     */
    public function makeCall($callee)
    {
        switch (AppSetting::getCallOperator()) {
            case 'Twilio':
                return $this->makeTwilioCall($callee);
            case 'Sipgate':
                return $this->makeSipgateCall($callee);
        }

        return null;
    }
}