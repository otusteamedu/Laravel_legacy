<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ReviewsService;

class AddReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'review:add 
                            {user_id : The ID of the User}
                            {text : Review text}
                            {--active}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add review from user';
    protected $reviewsService;

    /**
     * Create a new command instance.
     *
     * AddReview constructor.
     * @param ReviewsService $reviewsService
     */
    public function __construct(ReviewsService $reviewsService)
    {
        parent::__construct();
        $this->reviewsService = $reviewsService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->reviewsService->storeReview([
            'user_id' => $this->argument('user_id'),
            'text' => $this->argument('text'),
            'active' => $this->option('active')
        ]);
    }
}
