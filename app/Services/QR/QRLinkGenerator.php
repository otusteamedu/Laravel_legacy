<?php
/**
 * Description of QRLinkGenerator.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\QR;


use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QRLinkGenerator
{

    /**
     * @param string $link
     * @param string $outputFilename
     * @param int $size
     */
    public function generate(string $link, string $outputFilename, int $size): void
    {
        $writer = $this->createWriter($size);
        $writer->writeFile($link, $outputFilename);
    }

    /**
     * @param int $size
     * @return Writer
     */
    private function createWriter(int $size): Writer
    {
        $renderer = $this->createRenderer($size);
        return new Writer($renderer);
    }

    /**
     * @param int $size
     * @return ImageRenderer
     */
    private function createRenderer(int $size): ImageRenderer
    {
        return new ImageRenderer(
            new RendererStyle($size),
            new ImagickImageBackEnd()
        );
    }


}