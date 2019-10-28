<?php

namespace App\Console\Commands;

use App\Helpers\QRHelper;
use App\Services\Company\Generators\CompanyTemplatedQRGenerator;
use Illuminate\Console\Command;

class CompanyQRGenerator extends Command
{
    const COMPANY_QR_TEMPLATE = 'company-qr-%d.png';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:company-qr
                           {company* : Company Id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create company qr with image template';

    /** @var CompanyTemplatedQRGenerator */
    private $companyTemplatedQRGenerator;

    /**
     * CompanyQRGenerator constructor.
     * @param CompanyTemplatedQRGenerator $companyTemplatedQRGenerator
     */
    public function __construct(
        CompanyTemplatedQRGenerator $companyTemplatedQRGenerator
    )
    {
        parent::__construct();
        $this->companyTemplatedQRGenerator = $companyTemplatedQRGenerator;
    }

    public function handle()
    {
        $companies = $this->argument('company');
        foreach ($companies as $company) {
            $this->handleCompany($company);
        }
    }

    /**
     * @param int $company_id
     */
    private function handleCompany(int $company_id): void
    {
        try {
            $qrFilename = $this->generateCompanyQR($company_id);
            $this->companyTemplatedQRGenerator->generate($company_id, $qrFilename);
        } catch (\ImagickException $e) {

        }
    }

    /**
     * @param int $company_id
     * @return string
     */
    private function generateCompanyQR(int $company_id): string
    {
        $filename = $this->generateCompanyQRFilename($company_id);
        $this->call('make:qr', [
            '--link' => $this->createCompanyLink($company_id),
            '--output' => $filename,
            '--size' => 600,
        ]);
        return $filename;
    }

    /**
     * @param int $company_id
     * @return string
     */
    private function generateCompanyQRFilename(int $company_id): string
    {
        $filename = sprintf(self::COMPANY_QR_TEMPLATE, $company_id);
        return QRHelper::getQRFilePath($filename);
    }

    /**
     * @param int $company_id
     * @return string
     */
    private function createCompanyLink(int $company_id): string
    {
        return route('home', [
            'company_id' => $company_id
        ]);
    }

}
