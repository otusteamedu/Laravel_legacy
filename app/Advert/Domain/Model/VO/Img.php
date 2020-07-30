<?php


namespace App\Advert\Domain\Model\VO;


class Img
{

    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {

        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


}
