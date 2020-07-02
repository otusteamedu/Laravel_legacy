<?php


namespace App\Services\Adverts\Handler;


use Mail;

class SendEmailHandler
{

    public function handle($advert)
    {

        $data = ['name'=>"Laravel"];

        Mail::send(['text'=>'mail'], $data, function($message) use ($advert) {
            $message
                ->to($advert->user->email, 'User')
                ->subject('Advert '.$advert->title.'- published.');
            $message
                ->from('vetalm1@gmail.com','Laravel');
        });



        \Log::channel('daily')->info(': advert has been create ');
    }

}
