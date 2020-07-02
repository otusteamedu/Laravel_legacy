<?php

namespace App\Console\Commands\Messages;

use App\Services\Messages\Handler\AddMessageToAnyAdvertsHandler;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class MessageToAdverts extends Command
{
    const USER = 2;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:send 
                           {adverts* : id adverts} 
                           {--a | admin : admin on default user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add message to any adverts';
    /**
     * @var AddMessageToAnyAdvertsHandler
     */
    private $addMessageToAnyAdvertsHandler;

    /**
     * Create a new command instance.
     *
     * @param AddMessageToAnyAdvertsHandler $addMessageToAnyAdvertsHandler
     */


    public function __construct(AddMessageToAnyAdvertsHandler $addMessageToAnyAdvertsHandler)
    {

        parent::__construct();

        $this->addMessageToAnyAdvertsHandler = $addMessageToAnyAdvertsHandler;
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws Exception
     */

    public function handle()
    {
        $message = $this->ask("write message");
        $adverts = $this->argument('adverts');
        $isAdmin = $this->option('admin');

        if ($isAdmin==0)  $isAdmin = self::USER ;

        $this->validate($message, $adverts, $isAdmin );

        $this->addMessageToAnyAdvertsHandler->handle($message, $adverts, $isAdmin);

    }

    private function validate($message, $adverts, $isAdmin )
    {
        $input = [
            'message'  => $message,
            'adverts' => $adverts,
            'isAdmin' => $isAdmin,
        ];

        $rules = [
            'message'  => 'required|max:200',
            'adverts' => 'array|required',
            'adverts.*'=>'integer',
            'isAdmin' => 'in:0,1',
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            throw new Exception('Not valid command params'.PHP_EOL);
        }
    }

}
