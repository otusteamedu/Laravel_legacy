<?php

namespace App\Console\Commands;

use App\Services\QR\QRLinkGenerator;
use Illuminate\Console\Command;

class QRGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:qr
                           {--l|--link= : Target link to generate QR (e.g. https://badum.ru)}
                           {--o|--output=qr.png : Output filename with what QR will be generated (e.g. qr-offer-1.png)}
                           {--s|--size=300 : QR required size, defined in pixels}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new QR code';

    /**
     * @var QRLinkGenerator
     */
    private $QRLinkGenerator;

    /**
     * QRGenerator constructor.
     * @param QRLinkGenerator $QRLinkGenerator
     */
    public function __construct(
        QRLinkGenerator $QRLinkGenerator
    )
    {
        parent::__construct();
        $this->QRLinkGenerator = $QRLinkGenerator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->isValidInput()) {
            return 1;
        }
        $qrLink = $this->option('link');
        $qrOutputFilename = $this->option('output');
        $qrSize = $this->option('size');

        $this->QRLinkGenerator->generate($qrLink, $qrOutputFilename, $qrSize);

    }

    /**
     * @return bool
     */
    private function isValidInput(): bool
    {
        $isValid = true;

        if (!$this->option('link')) {
            $this->error('Link option is required');
            $isValid = false;
        }

        if (!$this->option('output')) {
            $this->error('Output option is required');
            $isValid = false;
        }

        if (!$this->option('size')) {
            $this->error('Size option is required');
            $isValid = false;
        }

        return $isValid;
    }
}
