<?php


namespace App\Services\Offers\Generators;


use Imagick;

class OfferTemplateQRGenerator
{

    const QR_X = 76;
    const QR_Y = 332;

    const TEXT_X = 76;
    const TEXT_Y = 1000;

    /**
     * @param int $offer_id
     * @param string $offerQRFilename
     * @throws \ImagickException
     */
    public function generate(
        int $offer_id,
        string $offerQRFilename
    )
    {
        $offerImage = $this->generateOfferTemplateWithQRImage($offerQRFilename);
        $this->addOfferLink($offerImage, $offer_id);
        $this->storeOfferImage($offerImage, $offerQRFilename);
    }

    /**
     * @param string $offerQRFilename
     * @return Imagick
     * @throws \ImagickException
     */
    private function generateOfferTemplateWithQRImage(string $offerQRFilename): Imagick
    {
        $templateImage = $this->getTemplateImage();
        $offerQRImage = $this->getOfferQRImage($offerQRFilename);

        $templateImage->compositeImage(
            $offerQRImage,
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
     * @param string $offerQRFilename
     * @return Imagick
     * @throws \ImagickException
     */
    private function getOfferQRImage(string $offerQRFilename): Imagick
    {
        $image = new Imagick();
        $image->readImage($offerQRFilename);

        return $image;
    }

    /**
     * @return string
     */
    private function getTemplateFilename(): string
    {
        return public_path('images/black_background.png');
    }

    /**
     * @param Imagick $offerImage
     * @param int $offer_id
     */
    private function addOfferLink(Imagick $offerImage, int $offer_id): void
    {
        $draw = new \ImagickDraw();
        $draw->setStrokeWidth(1);
        $draw->setFontSize(56);

        $text = $this->createOfferLink($offer_id);

        $offerImage->annotateimage(
            $draw,
            self::TEXT_X,
            self::TEXT_Y,
            0,
            $text
        );
    }

    /**
     * @param int $offer_id
     * @return string
     */
    private function createOfferLink(int $offer_id): string
    {
        return 'badum.ru/offer/'.$offer_id;
/*        return route('home', [
            'id' => $offer_id
        ]);*/
    }

    /**
     * @param Imagick $offerImage
     * @param string $offerQRFilename
     */
    private function storeOfferImage(Imagick $offerImage, string $offerQRFilename)
    {
        $offerImage->writeImage($offerQRFilename);
    }

}
