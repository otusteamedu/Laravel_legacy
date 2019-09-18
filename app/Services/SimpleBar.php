<?php
/**
 * Description of SimpleFoo.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services;

class SimpleBar
{
    protected $appName;

    public function __construct(
        string $appName
    )
    {
        $this->appName = $appName;
    }

    public function getAppName()
    {
        \Log::info($this->appName);
    }
    
}