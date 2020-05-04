<?php

namespace App\Console\Commands;

use App\Models\Reason;
use App\Models\Transaction;
use Illuminate\Console\Command;

class ShowDebt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:debt {--u|user_id= : User ID} {reason_name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'shows the user\'s debt';


    private $reason;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        Reason $reason
    )
    {
        $this->reason = $reason;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->option('user_id');
        $allReasonsAmount = $this->reason->getTotalAmount();

        $paid = Transaction::where('user_id', $user)->pluck('amount')->sum();
        $debt = $allReasonsAmount - $paid;
        $this->info('Users full debt is ' . $debt);


        if (null !== $this->argument('reason_name')) {
            $certainReason = $this->reason->where('name', $this->argument('reason_name'))->first();

            $paidInReason = Transaction::where('reason_id', $certainReason['id'])->where('user_id', $user)->pluck('amount')->sum();

            $this->info($certainReason['name'] . ' paid ' . $paidInReason . ' / ' . $certainReason['amount']);
        } else {
            $reasons = $this->reason->all('name')->pluck('name')->toArray();
            $ucReason = $this->choice('choose certain reason:', $reasons, 0);
            $this->call('show:debt', [
                '--user_id' => $user, 'reason_name' => $ucReason
            ]);
        }


    }
}
