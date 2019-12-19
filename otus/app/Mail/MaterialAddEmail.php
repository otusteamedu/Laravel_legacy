<?php

namespace App\Mail;

use App\Models\Material;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaterialAddEmail extends Mailable {
    use Queueable, SerializesModels;

    protected $material;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Material $material) {
        $this->material = $material;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from(getenv('DEFAULT_EMAIL_FROM'))
                    ->view('mails.material_add', ['material' => $this->material]);
    }
}
