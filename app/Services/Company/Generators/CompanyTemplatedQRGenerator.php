<?php
/**
 * Description of CompanyTemplatedQRGenerator.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Company\Generators;

use Imagick;

class CompanyTemplatedQRGenerator
{

    const QR_X = 76;
    const QR_Y = 332;

    const TEXT_X = 76;
    const TEXT_Y = 1000;

    /**
     * @param int $company_id
     * @param string $companyQRFilename
     * @throws \ImagickException
     */
    public function generate(
        int $company_id,
        string $companyQRFilename
    )
    {
        $companyImage = $this->generateCompanyTemplateWithQRImage($companyQRFilename);
        $this->addCompanyLink($companyImage, $company_id);
        $this->storeCompanyImage($companyImage, $companyQRFilename);
    }

    /**
     * @param string $companyQRFilename
     * @return Imagick
     * @throws \ImagickException
     */
    private function generateCompanyTemplateWithQRImage(string $companyQRFilename): Imagick
    {
        $templateImage = $this->getTemplateImage();
        $companyQRImage = $this->getCompanyQRImage($companyQRFilename);

        $templateImage->compositeImage(
            $companyQRImage,
            Imagick::COMPOSITE_OVER,
            self::QR_X,
            self::QR_Y
        );
        return $templateImage;
    }

    /**
     * @return Imagick
     * @throws \ImagickException
     */
    private function getTemplateImage(): Imagick
    {
        $image = new Imagick();
        $image->readImage($this->getTemplateFilename());

        return $image;
    }

    /**
     * @param string $companyQRFilename
     * @return Imagick
     * @throws \ImagickException
     */
    private function getCompanyQRImage(string $companyQRFilename): Imagick
    {
        $image = new Imagick();
        $image->readImage($companyQRFilename);

        return $image;
    }

    /**
     * @return string
     */
    private function getTemplateFilename(): string
    {
        return public_path('images/temp_ma.png');
    }

    /**
     * @param Imagick $companyImage
     * @param int $company_id
     */
    private function addCompanyLink(Imagick $companyImage, int $company_id): void
    {
        $draw = new \ImagickDraw();
        $draw->setStrokeWidth(1);
        $draw->setFontSize(36);

        $text = $this->createCompanyLink($company_id);

        $companyImage->annotateimage(
            $draw,
            self::TEXT_X,
            self::TEXT_Y,
            0,
            $text
        );
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

    /**
     * @param Imagick $companyImage
     * @param string $companyQRFilename
     */
    private function storeCompanyImage(Imagick $companyImage, string $companyQRFilename)
    {
        $companyImage->writeImage($companyQRFilename);
    }

}