<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test {id*} {--flag} {--size=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ids = $this->argument('id');


//        $clients = DB::select('select * from `clients` limit 5 offset 0');
//        $clients = DB::select('select * from `clients` limit 5 offset 5');
//        $clients = DB::select('select * from `clients` limit 5 offset 10');
        $clients = DB::select('select * from `clients` limit 5 offset 15');

        dd($clients);




    }
}
