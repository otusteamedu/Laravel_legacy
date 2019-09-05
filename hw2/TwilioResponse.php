<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Twilio\Twiml;
use Twilio\TwiML\VoiceResponse;

/**
 * С помощью объекта этого класса можно генерировать действия для автоответчика:
 * сказать голосом, перевести звонок, проиграть аудио файл
 *
 * Переделано с помощью Fluent Interface
 */
class TwilioResponse {
    const ROBOT_VOICE = 'alice';
    const ROBOT_VOICE_LANG = 'en-EN';

    private $response;
    private $robotVoiceSettings;

    public function __construct()
    {
        $this->robotVoiceSettings = [
            'voice'    => self::ROBOT_VOICE,
            'language' => self::ROBOT_VOICE_LANG
        ];

        // нарушает SRP, но тут жесткая зависимость от вендора, не уверен, что нужна абстракция
        $this->response = new Twiml();
    }

    /**
     * Cказать голосом сообщение
     *
     * @param $message
     *
     * @return $this
     */
    public function say($message)
    {
        $this->response->say(
            $message,
            $this->robotVoiceSettings
        );

        return $this;
    }

    /**
     * Dial number
     *
     * @param $number
     *
     * @return $this
     */
    public function dial($number)
    {
        $dial = $this->response->dial('', []);
        $dial->number( $number, []);

        return $this;
    }

    /**
     * Play audio file
     *
     * @param $audioFile
     * @param $loop
     *
     * @return $this
     */
    public function play($audioFile, $loop)
    {
        $this->response->play($audioFile, ['loop' => $loop]);

        return $this;
    }

}
