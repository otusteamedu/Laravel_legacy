<?php

namespace App\Jobs;

use App\Mail\MaterialAddEmail;
use App\Models\Material;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MaterialAdd implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $material;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Material $material, array $data = []) {
        $this->material = $material;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $users = User::all();

        /** @var User $user */
        foreach ($users as $user) {
            if (!$user->email) {
                continue;
            }
            Mail::to($user->email)->send(new MaterialAddEmail($this->material));
        }
    }
}
