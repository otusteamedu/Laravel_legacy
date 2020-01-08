<?php


namespace App\Helpers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SavedValue
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Request
     */
    private $request;

    public function __construct(string $name) {
        $this->name = $name;
        $this->request = app('request');
    }
    public function getDomain() {
        $value = $this->request->getHttpHost();
        if(strpos($value, 'www.') === 0)
            $value = substr($value, 4);
        $pos = strpos($value, ':');
        if($pos > 0)
            $value = substr($value, 0, $pos);

        return $value;
    }

    public function get($arValues, $default = 0, $offset = 2592000, $path = false)
    {
        $bSave = $this->request->has($this->name);
        $value = $bSave ?
            intval($this->request->get($this->name)) :
            intval($this->request->cookie($this->name, -1));

        if(!array_key_exists($value, $arValues))
            $value = $default;

        if($bSave) {
            if(empty($path))
                $path = $this->request->getUri();
            Cookie::queue(
                Cookie::make(
                    $this->name,
                    $value,
                    Carbon::now()->addSeconds($offset)->timestamp,
                    $path, $this->getDomain(), null, false
                )
            );
        }

        return $value;
    }
}
