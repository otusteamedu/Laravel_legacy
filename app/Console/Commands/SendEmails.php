<?php

namespace App\Console\Commands;

use App\Services\Countries\CountriesService;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send
                            {user?* : user id}
                            {--email=* : email of person to send}
                            {--A|--all : send all new mails}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle sending all new mails';

    public function handle(CountriesService $countriesService)
    {
        dd($this->options());
    }
}
