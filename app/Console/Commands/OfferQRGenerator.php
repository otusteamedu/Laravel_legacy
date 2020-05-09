<?php

namespace App\Console\Commands;

use App\Helpers\QRHelper;
use App\Services\Offers\Generators\OfferTemplateQRGenerator;
use Illuminate\Console\Command;

class OfferQRGenerator extends Command
{
    const COMPANY_QR_TEMPLATE = 'offer-offer-qr-%d.png';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:offer-qr
                           {offer* : Offer Id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create offer qr with image template';

    /** @var OfferTemplateQRGenerator */
    private $OfferTemplateQRGenerator;

    /**
     * OfferQRGenerator constructor.
     * @param OfferTemplateQRGenerator $offerTemplateQRGenerator
     */
    public function __construct(
        OfferTemplateQRGenerator $offerTemplateQRGenerator
    )
    {
        parent::__construct();
        $this->OfferTemplateQRGenerator = $offerTemplateQRGenerator;
    }

    public function handle()
    {
        $companies = $this->argument('offer');
        foreach ($companies as $offer) {
            $this->handleOffer($offer);
        }
    }

    /**
     * @param int $offer_id
     */
    private function handleOffer(int $offer_id): void
    {
        try {
            $qrFilename = $this->generateOfferQR($offer_id);
            $this->OfferTemplateQRGenerator->generate($offer_id, $qrFilename);
        } catch (\ImagickException $e) {

        }
    }

    /**
     * @param int $offer_id
     * @return string
     */
    private function generateOfferQR(int $offer_id): string
    {
        $filename = $this->generateOfferQRFilename($offer_id);
        $this->call('make:qr', [
            '--link' => $this->createOfferLink($offer_id),
            '--output' => $filename,
            '--size' => 600,
        ]);
        return $filename;
    }

    /**
     * @param int $offer_id
     * @return string
     */
    private function generateOfferQRFilename(int $offer_id): string
    {
        $filename = sprintf(self::COMPANY_QR_TEMPLATE, $offer_id);
        return QRHelper::getQRFilePath($filename);
    }

    /**
     * @param int $offer_id
     * @return string
     */
    private function createOfferLink(int $offer_id): string
    {
        return route('home', [
            'offer_id' => $offer_id
        ]);
    }

}
