<?php

namespace Feature\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ParceTCXTest extends TestCase
{
    /**
     * Test if Artisan command exists.
     */
    public function testArtisanCommandExists()
    {
        $this->assertTrue(array_key_exists('activity:parse-tcx', Artisan::all()));
    }
}
